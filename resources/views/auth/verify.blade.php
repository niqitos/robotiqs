@extends('layouts.app')

@section('title', __("Verification" ))
@section('description', config('app.description'))
@section('author', config('app.author'))

@section('content')
    <div class="row justify-content-center">
        <div class="col-12 col-sm-8 col-lg-6">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-transparent border-0">
                    <h1 class="h2">{{ __('Verify Your Email Address') }}</h1>
                </div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </div>
                    @endif

                    {{ __('Before proceeding, please check your email for a verification link.') }}
                    {{ __('If you did not receive the email') }}, <a href="{{ route('verification.resend') }}">{{ __('click here to request another') }}</a>.
                </div>
            </div>
        </div>
    </div>
@endsection
