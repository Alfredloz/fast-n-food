@extends('layouts.app')

@section('content')
<div class="login-container">
    <h1>Accedi a Fast n Food</h1>
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <!-- <label for="email" class="">{{ __('E-Mail Address') }}</label> -->
        <div class="input-container">
            <i class="far fa-envelope"></i><input placeholder="E-mail" id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <hr>

        <!-- <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label> -->
        <div class="input-container">
            <i class="fas fa-lock"></i><input placeholder="Password" id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <hr>

        <div>
            <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

            <label for="remember">
                {{ __('Remember Me') }}
            </label>
        </div>

        <div class="login-container">
            <button type="submit" class="login-button">
                {{ __('Login') }}
            </button>

            @if (Route::has('password.request'))
                <a class="btn btn-link" href="{{ route('password.request') }}">
                    {{ __('Forgot Your Password?') }}
                </a>
            @endif
        </div>
    </form>
</div>
@endsection
