@extends('layouts.app')

@section('content')
<div class="main-wrapper account-wrapper">
    <div class="account-page">
        <div class="account-center">
            <div class="account-box">
                <form method="POST" action="{{ route('login') }}" class="form-signin">
                    @csrf
                    <div class="account-logo">
                        <a href="{{route('index')}}"><img src="{{asset('template/img/logo/logo.png')}}" alt=""></a>
                    </div>
                    <div class="form-group">
                        <label>Username or Email</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group text-right">
                        @if (Route::has('password.request'))
                        <a class="btn btn-link" href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a>
                    @endif
                    </div>
                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-primary account-btn">Login</button>
                    </div>
                    <div class="text-center register-link">
                        
                        @if (Route::has('register'))
                        Don’t have an account? <a href="{{ route('register') }}">{{ __('Register') }}</a>                            
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
