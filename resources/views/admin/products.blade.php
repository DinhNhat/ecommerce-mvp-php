@extends('layouts.master')

@section('content')

    <style>
        table {
            margin-top: 50px;
            border-collapse: collapse;
            border-spacing: 0;
            width: 100%;
            border: 1px solid #ddd;
        }

        th, td {
            text-align: left;
            padding: 16px; 
        }
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
            <th>Name</th>
            <th>Price</th>
            <th>Orders</th>
        </tr>
    </table>

@endsection