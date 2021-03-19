@extends('layouts.app')

@section('content')
<div class="login-container">
    <h1>Reset Password</h1>
    <div class="card-body">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="input-container">
                <!-- <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label> -->
                <i class="fas fa-envelope"></i><input placeholder="E-mail Address" id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <hr>

            <div class="login-container">
                <button type="submit" class="login-button">
                    {{ __('Reset') }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
