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

        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropbtn:hover, .dropbtn:focus {
            background-color: rgb(241, 236, 236);
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f1f1f1;
            min-width: 160px;
            overflow: auto;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
        }

        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .dropdown a:hover {background-color: #ddd;}
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
            <th></th>
        </tr>

        @if ($products->count() > 0)
            @foreach ($products as $product)
                <tr>
                    <td><i class="bi bi-check-circle" style="font-size: 1.2rem; color: cornflowerblue;"></i></td>
                    <td>{{ $product->name }}</td>
                    <td>{{ \Illuminate\Support\Number::currency(($product->price_in_cents / 100), 'CAD')  }}</td>
                    <td>{{ $product->orders_count }}</td>
                    <td>
                        <i class="bi bi-three-dots-vertical dropbtn" style="font-size: 1.2rem; color: black; cursor: pointer"></i>
                        <div id="drop-download{{ $product->id }}" class="dropdown-content">
                            <a href="#home">Home</a>
                            <a href="#about">About</a>
                            <a href="#contact">Contact</a>
                        </div>
                    </td>
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="3">No products found</td>
            </tr>
        @endif
    </table>

    <script>
        $(function() {
            $(".dropbtn").each(function() {
                $(this).on("click", function() {
                    
                });
            });
        });
    </script>

@endsection