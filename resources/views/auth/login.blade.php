@extends('layouts.app')

@section('title', __("Login"))
@section('description', config('app.description'))
@section('author', config('app.author'))

@section('content')
    <div class="row justify-content-center">
        <div class="col-12 col-sm-10 col-md-8 col-lg-6">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-transparent border-0">
                    <h1 class="h2">{{ __('Login') }}</h1>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <div class="col-12 d-sm-flex flex-wrap justify-content-around">
                                <a class="btn btn-social btn-facebook d-block mr-0 mr-sm-3 mb-3" href="{{ route('socialite.redirect', 'facebook') }}">
                                    <i class="fab fa-facebook-f fa-fw"></i> 
                                    <span>Facebook</span>
                                </a>
                                
                                <a class="btn btn-social btn-google d-block mr-0 mr-sm-3 mb-3" href="{{ route('socialite.redirect', 'google') }}">
                                    <i class="fab fa-google fa-fw"></i>
                                    <span>Google</span>
                                </a>
                                
                                {{-- <a class="btn btn-social btn-twitter d-block mb-3" href="{{ route('socialite.redirect', 'twitter') }}">
                                    <i class="fab fa-twitter fa-fw"></i>
                                    <span>Twitter</span>
                                </a> --}}
                            </div>
                        </div>

                        <hr class="hr-text" data-content="{{ __('OR') }}">

                        <div class="form-group row">
                            <label for="email" class="col-12 col-form-label">{{ __('Email or Username') }}</label>

                            <div class="col-12">
                                <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-12 col-form-label">{{ __('Password') }}</label>

                            <div class="col-12">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-12">
                                <button type="submit" class="btn border rounded">
                                    {{ __('Log In') }}
                                </button>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-12">
                                {{ __('Don\'t have account yet?') }}
                                <a class="btn-link pl-0 pr-0" href="{{ route('register') }}">
                                    {{ __('Register') }}
                                </a>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-12">
                                <a class="btn-link pl-0 pr-0" href="{{ route('password.request') }}">
                                    {{ __('Forgot Password?') }}
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
