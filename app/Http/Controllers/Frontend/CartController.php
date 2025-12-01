<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class CartController extends Controller
{
    // Display cart items
    public function index()
    {
        $cartItems = Cart::with('product')->where('user_id', Auth::id())->get();
        return view('frontend.cart.index', compact('cartItems'));
    }

    // Add product to cart
    public function add(Request $request, $productId)
    {
        $product = Product::findOrFail($productId);
        $cartItem = Cart::firstOrCreate(
            [
                'user_id' => Auth::id(),
                'product_id' => $product->id
            ],
            [
                'quantity' => 1
            ]
        );

        if (!$cartItem->wasRecentlyCreated) {
            $cartItem->increment('quantity');
        }

        return redirect()->back()->with('success', 'Product added to cart!');
    }

    // Increase quantity
    public function increase($id)
    {
        $cartItem = Cart::findOrFail($id);
        $cartItem->increment('quantity');
        return redirect()->back()->with('success', 'Quantity increased!');
    }

    // Decrease quantity
    public function decrease($id)
    {
        $cartItem = Cart::findOrFail($id);

        if ($cartItem->quantity > 1) {
            $cartItem->decrement('quantity');
        } else {
            $cartItem->delete(); // optionally remove if quantity reaches 0
        }

        return redirect()->back()->with('success', 'Quantity updated!');
    }


    // Remove product from cart
    public function remove($id)
    {
        $cartItem = Cart::findOrFail($id);
        $cartItem->delete();

        return redirect()->back()->with('success', 'Product removed from cart!');
    }
}
