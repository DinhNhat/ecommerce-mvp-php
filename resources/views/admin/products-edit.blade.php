@extends('layouts.master')

@section('content')

    <div>
        <h2>Edit product page</h2>
        <form method="POST" action="{{ route('admin.products.update', ['id' => $product->id]) }}" class="row g-3 w-75" enctype="multipart/form-data">
            @method('PUT')
            @csrf

            <div class="col-12 position-relative">
                <label for="name" class="form-label">Name</label>
                <input data="product-name" type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ $product->name }}">
                @error('name')
                    <div class="invalid-tooltip mt-2">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-12 position-relative">
                <label for="priceInCents" class="form-label">Price in Cents</label>
                <input data="price-in-cents" type="number" class="form-control @error('priceInCents') is-invalid @enderror" id="priceInCents" name="priceInCents" value={{ $product->price_in_cents }}>
                <p data="price-in-cents-on-change" class="text-muted">{{ number_format($product->price_in_cents / 100, 2, '.', ',') }}</p>
                @error('priceInCents')
                    <div class="invalid-tooltip my-2">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-12 position-relative">
                <label for="description" class="form-label">Description</label>
                <textarea data="product-desc" class="form-control @error('description') is-invalid @enderror" id="description" rows="5" name="description">{{ $product->description }}</textarea>
                @error('description')
                    <div class="invalid-tooltip mt-2">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-12">
                <label for="file" class="form-label">File</label>
                <input data="product-file" class="form-control" type="file" id="file" name="file">
                @if (\Illuminate\Support\Facades\Storage::disk('public')->exists($product->file_path_without_storage))
                    <div class="mt-2">
                        {{-- <a href="{{ url('/').$product->file_path }}">{{ $product->last_file_name }}</a> --}}
                        <p class="text-muted">{{ $product->last_file_name }}</p>
                    </div>
                @endif
                @error('file')
                    <div class="d-block invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-12">
                <label for="image" class="form-label">Image</label>
                <input data="product-image" class="form-control" type="file" id="image" name="image">
                @error('image')
                    <div class="d-block invalid-feedback">{{ $message }}</div>
                @enderror
                <div class="mt-2" id="image-show">
                    <a href="{{ url('/').$product->image_path }}" target="_blank">
                        <img class="img-thumbnail" src="{{ url('/').$product->image_path }}" width="250">
                    </a>
                </div>
                <input type="hidden" name="imageSave" id="image-save">
            </div>

            <div class="col-12">
                <button type="submit" class="btn btn-dark">Update</button>
            </div>
        </form>
    </div>

    <script>
        $(function() {

            $("[data='price-in-cents']").on('input', function() {
                let value = ($(this).val() == 0) ? '' : $(this).val();
                $("[data='price-in-cents-on-change']").text(`$${value / 100}`);
            });

            // Handling the product name and product description input fields to toggle error message
            $("input[data='product-name'], textarea[data='product-desc']").on('input', function() {
                let value = $(this).val();
                if (value && $(this).next().hasClass('invalid-tooltip')) {
                    $(this).next().remove(); // Remove the error message
                    $(this).removeClass('is-invalid'); // Remove the red border
                }
            });


            $("[data='product-image']").on('change', function() {
                const form = new FormData();
                form.append('image', $(this)[0].files[0]);

                $.ajax({
                    contentType: false,
                    processData: false,
                    dataType: 'JSON',
                    data: form,
                    url: "{{ route('admin.products.uploadImage') }}",
                    method: 'POST',
                    success: function(results) {
                        if (results.error == false) {
                            const rootURL = "{{ url('/') }}";
                            const imageShowHtml = `<a href="${rootURL}/${results.url}" target="_blank"><img src="${rootURL}/${results.url}" width="100px"></a>`;
                            $("#image-show").html(imageShowHtml);

                            // $("#image-show").html('<a href="' + results.url + '" target="_blank">' + '<img src="'+ results.url +'" width="100px"></a>');
                            console.log(`image path: ${results.url}`);
                            $("#image-save").val(`${results.url}`);
                        } else {
                            alert('Uploading image error');
                        }
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            });
        });
    </script>

@endsection