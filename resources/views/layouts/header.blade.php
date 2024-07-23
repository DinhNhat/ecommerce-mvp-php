<div class="topnav d-flex justify-content-center">
    <a href="{{ route('admin.dashboard') }}" class="{{ Request::routeIs('admin.dashboard') ? 'active' : '' }}">Dashboard</a>
    <a href="{{ route('admin.products') }}" class="{{ Request::routeIs('admin.products') ? 'active' : '' }}">Products</a>
    <a href="{{ route('admin.customers') }}" class="{{ Request::routeIs('admin.customers') ? 'active' : '' }}">Customers</a>
    <a href="{{ route('admin.sales') }}" class="{{ Request::routeIs('admin.sales') ? 'active' : '' }}">Sales</a>
</div>