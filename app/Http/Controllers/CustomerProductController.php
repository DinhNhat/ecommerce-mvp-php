<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustomerProductController extends Controller
{
    public function index(Request $request)
    {
        // dd(Request::routeIs('customer.home'));

        return view('customer.customer-products');
    }
}
