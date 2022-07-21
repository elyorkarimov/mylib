@extends('layouts.auth')

@section('content')

<div class="container d-flex align-items-center justify-content-center form-height-login pt-24px pb-24px">
    <div class="row justify-content-center">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-header bg-primary">
                    <div class="ec-brand">
                        <a href="/" title="Ekka">
                            <img class="ec-brand-icon" src="/logo.png" alt="" />
                            
                        </a>
                    </div>
                </div>
                <div class="card-body p-5">
                    <h4 class="text-dark mb-5"> {{ __('Login') }}</h4>
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    <form method="POST" action="{{ route('login', app()->getLocale()) }}">
                        @csrf
                        <div class="row">
                            <div class="form-group col-md-12 mb-4">
                                <label for="email" class="col-md-4 col-form-label text-md-start">{{ __('Email') }}</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="{{ __('Email') }}">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            
                            <div class="form-group col-md-12">
                                <label for="password" class="col-md-4 col-form-label text-md-start">{{ __('Password') }}</label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="{{ __('Password') }}">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <div class="d-flex my-2 justify-content-between">
                                    <div class="d-inline-block mr-3">
                                        <div class="control control-checkbox">
                                            <label class="form-check-label" for="remember">
                                                {{ __('Remember Me') }}
                                            </label>
                                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                            <div class="control-indicator"></div>
                                        </div>
                                    </div>

                                    <p>
                                        {{-- @if (Route::has('password.request'))
                                            <a class="text-blue" href="{{ route('password.request', app()->getLocale()) }}">
                                                {{ __('Forgot Your Password?') }}
                                            </a>
                                        @endif --}}
                                    </p>
                                </div>
                                <button type="submit" class="btn btn-primary btn-block mb-4">
                                    {{ __('Login') }}
                                </button>
                                <p class="sign-upp">                            
                                    {{ __("Don't have an account yet?") }}
                                    <a class="text-blue" href="{{ url(app()->getLocale() . '/register') }}">
                                        {{ __('Sign Up') }}
                                    </a>
                                </p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
 
@endsection
