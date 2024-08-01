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
            background-color: #f1ebeb;
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

        .dropdown-content a:hover {background-color: #cac9c9;}

        .dropdown-content a.destructive { color: #ef4444; }

        .dropdown-content a.destructive:hover {background-color: #f87171; color:white;}

        .avatar {
            vertical-align: middle;
            width: 90px;
            height: auto;
            border-radius: 20%;
        }
    </style>

    <div class="w-75 d-flex justify-content-between align-items-center">
        <h2>Products page</h2>
        <a 
            href="{{ route('admin.products.create') }}" 
            class="btn bs-btn-indigo" 
            role="button"
        >Add Product</a>
    </div>

    <table>
        <tr>
            <th></th>
            <th>Image</th>
            <th>Name</th>
            <th>Price</th>
            <th>Orders</th>
            <th></th>
        </tr>

        @if ($products->count() > 0)
            @foreach ($products as $product)
                <tr>
                    <td>
                        @if ($product->is_available_for_purchase)
                            <i class="bi bi-check-circle" style="font-size: 1.7rem; color: cornflowerblue;"></i>
                        @else
                            <i class="bi bi-x-circle" style="font-size: 1.7rem; color: red;"></i>
                        @endif
                    </td>
                    <td>
                        <a href="{{ url('/') . $product->image_path }}" target="_blank">
                            <img src="{{ url('/') . $product->image_path }}" alt="Avatar" class="avatar">
                        </a>
                    </td>
                    <td>{{ $product->name }}</td>
                    <td>{{ \Illuminate\Support\Number::currency(($product->price_in_cents / 100), 'CAD')  }}</td>
                    <td>{{ $product->orders_count }}</td>
                    <td>
                        <i class="bi bi-three-dots-vertical dropbtn" style="font-size: 1.2rem; color: black; cursor: pointer"></i>
                        <x-product-actions-dropdown :product="$product" />
                    </td>
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="5" class="text-center">No products found</td>
            </tr>
        @endif
    </table>

    <script>
        $(function() {
            $(".dropbtn").each(function() {
                $(this).on("click", function() {
                    $(this).next().show();
                });
            });
        });

        // Close the dropdown if the user clicks outside of it or on other dropbtns

        window.onclick = function(event) {
            if (!event.target.matches(".dropbtn")) { // click outside of the dropbtn
                var dropdowns = document.getElementsByClassName("dropdown-content");
                for (let i = 0; i < dropdowns.length; i++) {
                    var openDropdown = dropdowns[i];
       
                    if ($(openDropdown).is(":visible")) {
                        $(openDropdown).hide();
                    }
                }
            } else {
                // check if there are other dropdowns open then close them
                var dropdowns = document.getElementsByClassName("dropdown-content");
                for (let i = 0; i < dropdowns.length; i++) {
                    var openDropdown = dropdowns[i];
       
                    if ($(openDropdown).is(":visible") && openDropdown !== event.target.nextElementSibling) {
                        $(openDropdown).hide();
                    }
                }
            }
        }
    </script>

@endsection