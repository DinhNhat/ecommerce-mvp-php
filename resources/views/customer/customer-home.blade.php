@extends('layouts.master')

@section('content')
    <style>
        .custom-flex {
            display: flex;
            height: 50px;
            align-items: center;
        }
    </style>

    <div class="custom-flex my-5">
        <p class="fs-2 fw-bold">Most Popular</p>
        <button type="button" class="btn btn-orange-600 ms-5">
            View All
            <i class="bi bi-arrow-right-short"></i>
        </button>
    </div>
    <x-customer-product-grid :products="$popularProducts" />
    <div class="custom-flex my-5">
        <p class="fs-2 fw-bold">
            Newest
        </p>
        <button type="button" class="btn btn-purple ms-5">
            View All
            <i class="bi bi-arrow-right-short"></i>
        </button>
    </div>
    <x-customer-product-grid :products="$newestProducts" />
    
@endsection