<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ecommerce MVP</title>
    
    <link rel="stylesheet" href="<?php echo url('/'),'/css/bootstrap.min.css'.'?v='.filemtime('css/bootstrap.min.css') ?>">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

    <link rel="stylesheet" href="<?php echo url('/'),'/css/master.css'.'?v='.filemtime('css/master.css') ?>">
</head>
<body>
    @if (collect(['customer.home', 'customer.products', 'customer.orders'])->contains(Route::currentRouteName()))
        @include('layouts.customer-header')
    @else
        @include('layouts.header')
    @endif
    

    <div class="container mt-5">
        @yield('content')
    </div>

    <script src="<?php echo url('/'),'/js/bootstrap.bundle.min.js'.'?v='.filemtime('js/bootstrap.bundle.min.js') ?>"></script>
</body>
</html>