<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use KHQR\BakongKHQR;
use KHQR\Helpers\KHQRData;
use KHQR\Models\IndividualInfo;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Http;

use Resend\Laravel\Facades\Resend;

class CheckoutController extends Controller
{

    public function generateQR(Request $request)
    {
        $user = Auth::user();

        $cartItems = Cart::with('product')->where('user_id', $user->id)->get();

        $totalAmount = $cartItems->sum(function ($item) {
            return round($item->quantity * $item->product->price);
        });

        try {

            $individualInfo = new IndividualInfo(
                bakongAccountID: 'sopheaktra_peng@aclb',
                merchantName: 'Tak Tou',
                merchantCity: 'PHNOM PENH',
                currency: KHQRData::CURRENCY_KHR,
                amount: $totalAmount
            );

            $response = BakongKHQR::generateIndividual($individualInfo);

            // Failed response
            if ($response->status['code'] !== 0) {
                return response()->json([
                    'error' => 'Failed to generate QR code',
                    'details' => $response->status
                ], 500);
            }

            // Success
            $qrString = $response->data['qr'];
            $qrUrl = 'https://quickchart.io/qr?text=' . urlencode($qrString) . '&size=250';
            $md5 = $response->data['md5'];

            // Store in session if needed

            return response()->json([
                'qrUrl' => $qrUrl,
                'amount' => $totalAmount,
                'md5' => $md5
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Exception occurred',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function checkPayment(Request $request)
    {

        // Get MD5 from session
        $md5 = $request->md5;

        if (!$md5) {
            return response()->json(['paid' => false]);
        }

        // $md5 = 'e4dfcfcc58ea6488e2642764f0602a15';

        $bakong = new BakongKHQR(env('BAKONG_API_TOKEN'));

        try {
            $response = $bakong->checkTransactionByMD5($md5);
        } catch (\Exception $e) {
            return response()->json(['paid' => false, 'error' => $e->getMessage()], 500);
        }

        if (($response['responseMessage'] ?? '') !== "Success") {
            return response()->json(['paid' => false, 'test' => $response]);
        }


        $order = $this->createOrderFromCartSimple()->id;
        $this->sendMail($order);
        $this->sendTelegram($order);

        return response()->json(['paid' => true, 'test' => $response], 200);
    }

    public function sendMail($orderId)
    {
        $order = Order::find($orderId);
        $user = Auth::user();

        // Example: $order can have details like products, totalAmount, etc.
        $productDetails = '';

        foreach ($order->products as $product) {
            $quantity = $product->pivot->quantity;
            $price = $product->pivot->price;
            $total = $quantity * $price;

            $productDetails .= "- {$product->name} - {$quantity} x (\${$price}) = \${$total}\n";
        }

        $totalAmount = $order->total ?? 0;

        $response = Resend::emails()->send([
            'from' => env('MAIL_FROM_ADDRESS'),
            'to' => $user->email, // send to the logged-in freelancer/buyer
            'subject' => '🎉 Payment Successful!',
            'html' => "
            <h1>Hello {$user->name}</h1>
            <p>Thank you for your purchase! ✅</p>
            <p>Here are the details of your order:</p>
            <pre>{$productDetails}</pre>
            <p><strong>Total Paid:</strong> \${$totalAmount}</p>
            <p>We hope you enjoy your product/service! 🌐</p>
        ",
        ]);

        return $response;
    }

    public function sendTelegram($orderId)
    {
        $order = Order::find($orderId);
        $user = Auth::user();

        $botToken = env('TELEGRAM_BOT_TOKEN');
        $chatId = env('TELEGRAM_CHAT_ID');

        $ownerMessage = "💼 New Order Received!\n\n";
        $ownerMessage .= "👤 User: {$user->name} ({$user->email})\n";
        $ownerMessage .= "🛒 Order ID: {$order->id}\n";
        $ownerMessage .= "💰 Total Paid: $" . $order->total . "\n\n";
        $ownerMessage .= "📦 Products:\n";

        foreach ($order->products as $product) {
            $quantity = $product->pivot->quantity;
            $price = $product->pivot->price;
            $total = $quantity * $price;

            $ownerMessage .= "- {$product->name} - {$quantity} x (\${$price}) = \${$total}\n";
        }

        $ownerMessage .= "\n✅ Payment confirmed via Bakong.\n";
        $ownerMessage .= "🌐 Check dashboard for details.";


        $response = Http::post("https://api.telegram.org/bot{$botToken}/sendMessage", [
            'chat_id' => $chatId,
            'text' => $ownerMessage,
        ]);

        return $response->json();
    }

    public function createOrderFromCartSimple()
    {
        $user = Auth::user();

        $cartItems = Cart::with('product')->where('user_id', $user->id)->get();
        if ($cartItems->isEmpty()) {
            return null;
        }

        // Create order
        $order = Order::create([
            'user_id' => $user->id,
            'total' => $cartItems->sum(fn($item) => $item->quantity * $item->product->price),
        ]);

        // Create order items
        foreach ($cartItems as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'price' => $item->product->price,
            ]);
        }

        // Clear the cart
        Cart::where('user_id', $user->id)->delete();

        return $order;
    }

    public function manualPayment(Request $request)
    {

        $order = $this->createOrderFromCartSimple()->id;
        $this->sendMail($order);
        $this->sendTelegram($order);

        return response()->json(['paid' => true], 200);
    }



    public function testBakong()
    {
        try {
            $totalAmount = 100; // or calculate dynamically from cart

            $individualInfo = new IndividualInfo(
                bakongAccountID: 'sopheaktra_peng@aclb',
                merchantName: 'Rin Pheara',
                merchantCity: 'PHNOM PENH',
                currency: KHQRData::CURRENCY_KHR,
                amount: $totalAmount
            );

            $response = BakongKHQR::generateIndividual($individualInfo);

            // Failed response
            if ($response->status['code'] !== 0) {
                return response()->json([
                    'error' => 'Failed to generate QR code',
                    'details' => $response->status
                ], 500);
            }

            // Success
            $qrString = $response->data['qr'];
            $qrUrl = 'https://quickchart.io/qr?text=' . urlencode($qrString) . '&size=250';
            $md5 = $response->data['md5'];

            // Store in session if needed
            session(['checkout_md5' => $md5]);

            return response()->json([
                'qrUrl' => $qrUrl,
                'amount' => $totalAmount,
                'md5' => $md5
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Exception occurred',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
