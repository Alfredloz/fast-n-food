@extends('layouts.app')

@section('content')
<div class="login-container">
    <h1>Registrati a Fast n Food</h1>
    <!-- <div class="">{{ __('Register') }}</div> -->

    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
        @csrf

        <div class="input-container">
            <!-- <label for="full_name" class="col-md-4 col-form-label text-md-right">{{ __('Full Name') }}</label> -->
            <i class="far fa-user"></i><input placeholder="Full Name" id="full_name" type="text" class="form-control @error('full_name') is-invalid @enderror" name="full_name" value="{{ old('full_name') }}" required autocomplete="full_name" autofocus>
            @error('full_name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <hr>

        <div class="input-container">
            <!-- <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label> -->
            <i class="fas fa-envelope"></i><input placeholder="E-mail" id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <hr>

        <div class="input-container">
            <!-- <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label> -->
            <i class="fas fa-key"></i><input placeholder="Password" id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <hr>

        <div class="input-container">
            <!-- <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label> -->
            <i class="far fa-check-circle"></i> <input placeholder="Confirm Password" id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
        </div>
        <hr>

        <div class="input-container">
            <!-- <label for="piva" class="col-md-4 col-form-label text-md-right">{{ __('Partita IVA') }}</label> -->
            <i class="fas fa-address-book"></i><input placeholder="Partita IVA" id="piva" type="text" class="form-control @error('piva') is-invalid @enderror" name="piva" value="{{ old('piva') }}" required autocomplete="piva" autofocus>
            @error('piva')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <hr>

        <div class="input-container">
            <!-- <label for="restaurant_name" class="col-md-4 col-form-label text-md-right">{{ __('Restaurant Name') }}</label> -->
            <i class="fas fa-utensils"></i><input placeholder="Restaurant Name" id="restaurant_name" type="text" class="form-control @error('restaurant_name') is-invalid @enderror" name="restaurant_name" value="{{ old('restaurant_name') }}" required autocomplete="restaurant_name" autofocus>
            @error('restaurant_name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <hr>

        <div class="input-container">
            <!-- <label for="restaurant_description" class="col-md-4 col-form-label text-md-right">{{ __('Restaurant Description') }}</label> -->
            <i class="fas fa-pencil-alt"></i><input placeholder="Restaurant Description" id="restaurant_description" type="text" class="form-control @error('restaurant_description') is-invalid @enderror" name="restaurant_description" value="{{ old('restaurant_description') }}" required autocomplete="restaurant_description" autofocus>

            @error('restaurant_description')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <hr>

        <div class="input-container">
            <i class="far fa-list-alt"></i><h2>Select Categories</h2>
            <!-- <label for="typologies" class="col-md-4 col-form-label text-md-right">{{ __('Select Typologies') }}</label> -->
            <select name="typologies[]" id="typologies" multiple>
                @foreach($typologies as $typology)
                    <option value="{{ $typology->id }}">{{ $typology->name }}</option>
                @endforeach
            </select>
            @error('typologies')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <hr>

        <div class="input-container">
            <i class="fas fa-sign-in-alt"></i><label for="restaurant_logo" class="col-md-4 col-form-label text-md-right">{{ __('Restaurant Logo') }}</label>
            <input id="restaurant_logo" type="file" class="form-control @error('restaurant_logo') is-invalid @enderror" name="restaurant_logo"  autocomplete="restaurant_logo" autofocus>
            @error('restaurant_logo')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <hr>

        <div class="input-container">
            <i class="fas fa-sign-in-alt"></i><label for="restaurant_banner" class="col-md-4 col-form-label text-md-right">{{ __('Restaurant Banner') }}</label>
            <input id="restaurant_banner" type="file" class="form-control @error('restaurant_banner') is-invalid @enderror" name="restaurant_banner" autocomplete="restaurant_banner" autofocus>
            @error('restaurant_banner')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <hr>

        <div class="input-container">
            <!-- <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('Address') }}</label> -->
            <i class="fas fa-map-marker-alt"></i><input placeholder="Address" id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}" required autocomplete="address" autofocus>
            @error('address')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <hr>

        <div class="input-container">
            <!-- <label for="phone_number" class="col-md-4 col-form-label text-md-right">{{ __('Phone Number') }}</label> -->
            <i class="fas fa-phone"></i><input placeholder="Phone Number" id="phone_number" type="text" class="form-control @error('phone_number') is-invalid @enderror" name="phone_number" value="{{ old('phone_number') }}" required autocomplete="phone_number" autofocus>
            @error('phone_number')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <hr>

        <div class="login-container">
            <button type="submit" class="login-button">
                {{ __('Register') }}
            </button>
        </div>
    </form>
</div>
@endsection
