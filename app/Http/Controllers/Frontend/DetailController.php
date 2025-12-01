<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Controllers\Controller;

class DetailController extends Controller
{
    public function show($id)
    {
        $product = Product::findOrFail($id); // Get product or 404
        return view('frontend.detail.index', compact('product'));
    }
}
