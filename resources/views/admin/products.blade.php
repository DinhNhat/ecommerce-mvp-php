@extends('layouts.master')

@section('content')

    <style>
        table {
            margin-top: 50px;
            border-collapse: collapse;
            border-spacing: 0;
            width: 100%;
        }

        th, td {
            text-align: left;
            padding: 16px; 
        }

        tr:nth-child(even) {background-color: #f2f2f2;}
    </style>

    <div class="w-75 d-flex justify-content-between align-items-center">
        <h2>Products page</h2>
        <a 
            href="{{ route('admin.products.create') }}" 
            class="btn btn-dark" 
            role="button"
        >Add Product</a>
    </div>

    <table>
        <tr>
            <th></th>
            <th>Name</th>
            <th>Price</th>
            <th>Orders</th>
        </tr>

        @if ($products->count() > 0)
            @foreach ($products as $product)
                <tr>
                    <td><i class="bi bi-check-circle" style="font-size: 1.2rem; color: cornflowerblue;"></i></td>
                    <td>{{ $product->name }}</td>
                    <td>{{ \Illuminate\Support\Number::currency(($product->price_in_cents / 100), 'CAD')  }}</td>
                    <td>{{ $product->orders_count }}</td>
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="3">No products found</td>
            </tr>
        @endif
    </table>

@endsection