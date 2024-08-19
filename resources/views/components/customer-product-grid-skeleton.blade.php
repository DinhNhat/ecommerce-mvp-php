<div class="products-grid" {{ $attributes }}>
    @if ($products->count() > 0)
        <ul>
            @foreach ($products as $product)
                <li class="card text-bg-light border-dark" style="max-height: 400px;" aria-hidden="true">
                    <figure>
                        <div class="custom-placeholder image">
                            {{-- <i class="bi bi-card-image" style="font-size: 2rem; color: rgb(130, 133, 139);"></i> --}}
                        </div>
                    </figure>
                    <div class="card-body">
                        <h4 class="card-title placeholder-glow">
                            <span class="placeholder col-6"></span>
                        </h4>
                        <p class="card-text placeholder-glow">
                            <span class="placeholder col-3"></span>
                        </p>
                        <p class="card-text mt-3 text-truncate placeholder-glow">
                            <span class="placeholder col-8"></span>
                        </p>
                        <div class="d-grid my-2">
                            <button class="btn btn-dark disabled placeholder" type="button"></button>
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
    @else
        <div class="alert alert-danger" role="alert">
            Sorry there are no products to be shown!!!
        </div>
    @endif
</div>