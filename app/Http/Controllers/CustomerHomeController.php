<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CustomerHomeController extends Controller
{
    public function index(Request $request)
    {
        $popularProducts = Product::where('is_available_for_purchase', true)->orderBy('id', 'asc')->take(6)->get();

        $newestProducts = Product::where('is_available_for_purchase', true)->orderBy('id', 'desc')->take(6)->get();

        // If the request has the header popular-loading, or newest-loading then return the related view with the products
        if ($request->hasHeader('x-refresh-popular-loading')) {
            return view('components.customer-product-grid', [
                'products' => $popularProducts
            ]);
        } else if ($request->hasHeader('x-refresh-newest-loading')) {
            return view('components.customer-product-grid', [
                'products' => $newestProducts
            ]);
        }

        return view('customer.customer-home', [
            'popularProducts' => $popularProducts,
            'newestProducts' => $newestProducts
        ]);
    }
}
