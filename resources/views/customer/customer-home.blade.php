@extends('layouts.master')

@section('content')
    <style>
        .custom-flex {
            display: flex;
            height: 50px;
            align-items: center;
        }

        .products-grid {
            margin-left: auto;
            margin-right: auto;
        }

        .products-grid > ul {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            grid-gap: 1rem;

            list-style: none;
            padding: 0;
            margin: 0;
        }

        .products-grid > ul > li {
            border: 1px solid #E2E2E2;
            border-radius: .5rem;
        }

        .products-grid > ul > li > figure {
            max-height: 220px;
            overflow: hidden;
            border-top-left-radius: .5rem;
            border-top-right-radius: .5rem;
        }

        /* .products-grid > ul > li > figure > img {
            width: 100%;
            height: auto;
        } */

        .products-grid > ul > li > figure > img {
            display: block;
            width: 100%; 
            height: 210px;
            box-shadow: 0 0 0 1px #000;
            object-fit: cover;
        }

        .custom-placeholder {
            position: relative;
        }

        .custom-placeholder::before, 
        .custom-placeholder::after {
            content: "";
            display: block;
            left: 0;
            top: 0;
            width: 100%;
            text-align: center;
        }

        .custom-placeholder::before {
            background: #a09e9e none repeat scroll 0 0;
            border-radius: 3px;
            height: 225px;
        }

        .custom-placeholder::after {
            font-size: 49px;
            opacity: 0.25;
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            font-family: bootstrap-icons;
        }

        .custom-placeholder.image::after {
            content: "\F429";
        }

    </style>

    <div class="custom-flex my-5" data="popular-products-view">
        <p class="fs-2 fw-bold">Most Popular</p>
        <button type="button" class="btn btn-emerald ms-5">
            View All
            <i class="bi bi-arrow-right-short"></i>
        </button>
    </div>
    <x-customer-product-grid-skeleton :products="$popularProducts" data="popular-products-loading" />

    <div class="custom-flex my-5" data="newest-products-view">
        <p class="fs-2 fw-bold">
            Newest
        </p>
        <button type="button" class="btn btn-emerald ms-5">
            View All
            <i class="bi bi-arrow-right-short"></i>
        </button>
    </div>
    <x-customer-product-grid-skeleton :products="$newestProducts" data="newest-products-loading" />

    <script>
        const GET_URL = "{{ route('customer.home') }}";
        function loadPopularProducts() {
            $.ajax({
                headers: {
                    'x-refresh-popular-loading': true
                },
                url: GET_URL,
                method: 'GET',
            }).done(function(response) {
                // console.log('response: ', response);
                $("[data=popular-products-view]").after(response);
            }).fail(function(error) {
                alert(error);
            });
        }

        function loadNewestProducts() {
            $.ajax({
                headers: {
                    'x-refresh-newest-loading': true
                },
                url: GET_URL,
                method: 'GET',
            }).done(function(response) {
                // console.log('response: ', response);
                $("[data=newest-products-view]").after(response);
            }).fail(function(error) {
                alert(error);
            });
        }
    
        setTimeout(() => {
            $("[data=popular-products-loading]").remove();
            loadPopularProducts();
        }, 2500);

        setTimeout(() => {
            $("[data=newest-products-loading]").remove();
            loadNewestProducts();
        }, 3000);
    </script>
    
@endsection