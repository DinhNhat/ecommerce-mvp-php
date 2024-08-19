<div class="topnav d-flex justify-content-center">
    <a href="{{ route('customer.home') }}" class="{{ Request::routeIs('customer.home') ? 'active' : '' }}">Home</a>
    <a href="{{ route('customer.products') }}" class="{{ Request::routeIs('customer.products') ? 'active' : '' }}">Products</a>
    <a href="{{ route('customer.orders') }}" class="{{ Request::routeIs('customer.orders') ? 'active' : '' }}">My Orders</a>
</div>