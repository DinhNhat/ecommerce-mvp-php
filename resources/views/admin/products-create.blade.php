@extends('layouts.master')

@section('content')

    <div>
        <h2>Create product page</h2>
        <form method="POST" action="{{ route('admin.products.store') }}" class="row g-3 w-75" enctype="multipart/form-data">
            @csrf

            <div class="col-12 position-relative">
                <label for="name" class="form-label">Name</label>
                <input data="product-name" type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}">
                @error('name')
                    <div class="invalid-tooltip mt-2">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-12 position-relative">
                <label for="priceInCents" class="form-label">Price in Cents</label>
                <input data="price-in-cents" type="number" class="form-control @error('priceInCents') is-invalid @enderror" id="priceInCents" name="priceInCents" value=0>
                <p data="price-in-cents-on-change" class="text-muted"></p>
                @error('priceInCents')
                    <div class="invalid-tooltip my-2">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-12 position-relative">
                <label for="description" class="form-label">Description</label>
                <textarea data="product-desc" class="form-control @error('description') is-invalid @enderror" id="description" rows="5" name="description">{{ old('description') }}</textarea>
                @error('description')
                    <div class="invalid-tooltip mt-2">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-12">
                <label for="file" class="form-label">File</label>
                <input data="product-file" class="form-control" type="file" id="file" name="file">
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
            </div>

            <div class="col-12">
                <button type="submit" class="btn btn-dark">Save</button>
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

            $("[data='product-file']").on('change', function() {
                console.log(123);
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
                        console.log(results);
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            });
        });
    </script>

@endsection