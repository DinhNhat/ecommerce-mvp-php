<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustomerOrderController extends Controller
{
    public function index(Request $request)
    {
        // dd(Request::routeIs('customer.home'));

        return view('customer.customer-orders');
    }
}
