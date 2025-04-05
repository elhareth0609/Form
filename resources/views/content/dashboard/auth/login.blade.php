@extends('layouts.app')

@php
    $isNavbar = false;
    $isSidebar = false;
    $isFooter = false;
    $isContainer = false;
@endphp

@section('title', __('Login'))

@section('content')
<style>

    .login-container {
        width: 400px;
        box-shadow: 0 0 20px rgba(0,0,0,0.1);
    }

</style>

<div class="d-flex justify-content-center align-items-center h-100">

    <div class="login-container bg-white rounded-3 p-3 mx-auto my-5 my-h-fit-content">
        <!-- Logo -->
        <a class="d-flex align-items-center justify-content-center text-black fs-4 my-3" href="{{ route('home') }}">
            <div><i class="mdi mdi-home-outline"></i></div>
            <div class="mx-3">{{ __('Form') }}</div>
        </a>

        <!-- Welcome Text -->
        <h5 class="mb-1">{{ __('Welcome To') }} {{ __('Form') }} 🎉</h5>
        <p class="text-muted mb-3">{{ __('Please login to your account') }}</p>
        <div class="alert alert-danger d-none" id="error-alert"></div>
        <!-- Login Form -->
        <form id="loginForm" action="{{ route('auth.login.action') }}" method="POST">
            @csrf
            <div class="mb-3">
                <div class="input-group">
                    <span class="input-group-text bg-transparent"><i class="mdi mdi-email-outline"></i></span>
                    <input type="email" name="email" value="admin@gmail.com" class="form-control border-start-0 p-0" placeholder="{{ __('Email address') }}" required>
                </div>
            </div>
            <div class="mb-3">
                <div class="input-group">
                    <span class="input-group-text bg-transparent"><i class="mdi mdi-lock-outline"></i></span>
                    <input type="password" name="password" value="123456789" class="form-control border-start-0 p-0" placeholder="Password" required>
                </div>
            </div>
            <div class="d-flex justify-content-between align-items-center my-4">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" name="remember" id="remember">
                    <label class="form-check-label" for="remember">{{ __('Remember me') }}</label>
                </div>
                <a href="{{ route('auth.forgot-password') }}" class="text-muted">{{ __('Forgot Password?') }}</a>
            </div>
            <button type="submit" class="btn btn-primary w-100">{{ __('Login') }}</button>
        </form>

        <!-- Social Login -->
        {{-- {{ dd(env('GOOGLE_LOGIN')) }} --}}

        @if(env('GOOGLE_LOGIN') == true || env('FACEBOOK_LOGIN') == true)
            <div class="mt-4">
                <div class="text-center">
                    <hr class="text-center border-1 border-secondary">
                    <div class="text-center position-relative" style="margin-top: -32px;">
                        <span class="bg-white text-secondary px-4 py-2">{{ __('Or') }}</span>
                    </div>
                </div>

                @if(env('GOOGLE_LOGIN') == true)
                    <button class="btn btn-outline-danger w-100 my-1 p-2">
                        <i class="mdi mdi-google me-2"></i>
                        {{ __('Login with Google') }}
                    </button>
                @endif
                @if(env('FACEBOOK_LOGIN') == true)
                    <button class="btn btn-outline-primary w-100 my-1 p-2">
                        <i class="mdi mdi-facebook me-2"></i>
                        {{ __('Login with Facebook') }}
                    </button>
                @endif
            </div>
        @endif
    </div>

</div>
<script>
$(document).ready(function() {
    $('#loginForm').submit(function(event) {
        event.preventDefault();

        $('#loading').show();
        var formData = $(this).serialize();

        $.ajax({
            url: $(this).attr('action'),
            type: $(this).attr('method'),
            data: formData,
            success: function(response) {
                $('#loading').hide();
                window.location.href = ("{{ route('home') }}");
            },
            error: function(xhr, textStatus, errorThrown) {
                $('#loading').hide();
                const response = JSON.parse(xhr.responseText);
                if ($('#error-alert').hasClass('d-none')) {
                    $('#error-alert').removeClass('d-none').text(response.message);
                } else {
                    $('#error-alert').text(response.message);
                }
            }
            });
    });
});
</script>
@endsection
