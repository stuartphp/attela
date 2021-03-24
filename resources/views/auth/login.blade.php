@extends('layouts.app')
@section('content')

<div class="d-flex justify-content-center h-100 mt-5">
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between fs-3">
            <div>{{ __('Login') }}</div>
            <div>
                <a href=""><i class="bi bi-facebook"></i></a>
                <a href=""><i class="bi bi-google"></i></a>
                <a href=""><i class="bi bi-twitter"></i></a>
            </div></div>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="bi bi-person"></i></span>
                    </div>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                </div>
                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="bi bi-lock"></i></span>
                    </div>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                </div>

                <div class="form-check">
                    <input class="form-check-input" type="checkbox" {{ old('remember') ? 'checked' : '' }} id="remember">
                    <label class="form-check-label" for="remember">
                        {{ __('Remember Me') }}
                    </label>
                </div>
                <div class="mb-2 text-end">
                    <input type="submit" value="{{ __('Login') }}" class="btn btn-outline-primary btn-sm">
                </div>
            </form><div class="d-flex justify-content-center">
                <a href="{{ route('password.request') }}">{{ __('Forgot Your Password?') }}</a>
            </div>
        </div>
    </div>
</div>
@endsection
