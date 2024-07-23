@extends('layouts.master')

@section('content')

    <div>
        <h2>Create product page</h2>
        <form method="POST" action="{{ route('admin.products.store') }}" class="row g-3 w-75" enctype="multipart/form-data">
            @csrf

            <div class="col-12">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}">
                @error('name')
                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-12">
                <label for="priceInCents" class="form-label">Price in Cents</label>
                <input data="price-in-cents" type="number" class="form-control" id="priceInCents" name="priceInCents" min=0 value=0 required>
                <p data="price-in-cents-on-change" class="text-muted"></p>
            </div>
            <div class="col-12">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control @error('description') is-invalid @enderror" id="description" rows="5" name="description">{{ old('description') }}</textarea>
                @error('description')
                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-12">
                <label for="file" class="form-label">File</label>
                <input class="form-control" type="file" id="file" name="file">
                @error('file')
                    <div class="d-block invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-12">
                <label for="image" class="form-label">Image</label>
                <input class="form-control" type="file" id="image" name="image">
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

        });
    </script>

@endsection