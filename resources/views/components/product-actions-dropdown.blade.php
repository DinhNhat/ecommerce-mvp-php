<div id="drop-download{{ $product->id }}" class="dropdown-content">
    <a href="#download">Download</a>
    <a href="{{ route('admin.products.edit', ['id' => $product->id]) }}">Edit</a>
    <a href="javascript:void(0);" onclick="$(this).next('[data-form-toggle-avail]').submit();">
        {{ ($product->is_available_for_purchase == true) ? 'Deactivate' : 'Activate' }}
    </a>
    <form action="{{ route('admin.products.toggleAvailability', ['id' => $product->id]) }}" method="POST" data-form-toggle-avail>
        @csrf
        @method('PUT')
    </form>
    <a href="javascript:void(0);" onclick="$(this).next('[data-form-delete]').submit();" class="destructive">Delete</a>
    <form action="{{ route('admin.products.destroy', ['id' => $product->id]) }}" method="POST" data-form-delete>
        @csrf
        @method('DELETE')
    </form>
</div>