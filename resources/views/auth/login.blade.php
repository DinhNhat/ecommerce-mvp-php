@extends('layouts.master')

@section('content')

<style>
    .login-form {
        width: 100%;
        max-width: 500px;
        padding: 15px;
        margin: auto;
    }
</style>

<form class="login-form" action="{{ route('login.attempt') }}" method="POST">
    @csrf

    @if ($errors->any())
        <div class="alert alert-danger" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @enderror

    <div class="my-3">
        <label for="myEmail" class="form-label">Email</label>
        <input type="email" class="form-control" name="myEmail" id="myEmail">
    </div>
    <div class="my-3">
        <label for="myPassword" class="form-label">Password</label>
        <input type="password" class="form-control" name="myPassword" id="myPassword">
    </div>

    <div class="my-3">
        <button type="submit" class="btn btn-primary">Sign in</button>
      </div>
</form>

@endsection