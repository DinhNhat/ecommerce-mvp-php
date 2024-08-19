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

        return view('customer.customer-home', [
            'popularProducts' => $popularProducts,
            'newestProducts' => $newestProducts
        ]);
    }
}
