<div class="row row-cols-4 g-2">
    @if ($products->count() > 0)
        @foreach ($products as $product)
            <div class="col">
                <div class="card text-bg-light border-dark" style="width:260px;">
                    <img src="{{ url('/') . $product->image_path }}" alt="" style="width: 100%; height: auto;">
                    <div class="card-body">
                        <h4 class="card-title">{{ $product->name }}</h4>
                        <p class="card-text">{{ \Illuminate\Support\Number::currency(($product->price_in_cents / 100), 'CAD')  }}</p>
                        <p class="card-text mt-3 text-truncate">
                            {{ $product->description }}
                        </p>
                        <div class="d-grid my-2">
                            <button class="btn btn-dark" type="button">Purchase</button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @else
        <div class="alert alert-danger" role="alert">
            Sorry there are no products to be shown!!!
        </div>
    @endif

</div>