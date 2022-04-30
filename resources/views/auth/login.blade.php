@extends('layouts.auth')

@section('main-content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-xl-10 col-lg-12 col-md-9">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="p-5">
                                <div class="text-center mb-4">
                                    <h1 class="h4 text-gray-900 mb-4">{{ __('Login') }}</h1>
                                    <img src="{{asset('img/logo.png')}}" width="200" alt="">
                                </div>
                                @if ($errors->any())
                                <div class="alert alert-danger border-left-danger" role="alert">
                                    <ul class="pl-4 my-2">
                                        @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                @endif
                                <form method="POST" action="{{ route('login') }}" class="user">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <div class="form-group">
                                        <input type="email" class="form-control form-control-user" name="email" placeholder="{{ __('Email') }}" value="{{ old('email') }}" required autofocus>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control form-control-user" name="password" placeholder="{{ __('Password') }}" required>
                                    </div>

                                    <div class="form-group mb-4">
                                        @if (Route::has('password.request'))
                                        <div class="text-center">
                                            <a class="text-warning" href="{{ route('password.request') }}">
                                                {{ __('Forgot Password?') }}
                                            </a>
                                        </div>
                                        @endif
                                    </div>

                                    <div class="form-group text-center">
                                        <button type="submit" class="btn btn-warning btn-user">
                                            {{ __('Login') }}
                                        </button>
                                    </div>
                                    <p style="text-align: center;">Don't have an account yet?</p>
                                    @if (Route::has('register'))
                                    <div class="text-center">
                                        <a class="text-warning" href="{{ route('register') }}">{{ __('Create an Account!') }}</a>
                                    </div>
                                    @endif
                                </form>

                                <!-- Divider -->
                                <hr class="sidebar-divider my-0">

                                <div class="text-center mt-2">
                                    <a class="text-warning" href="{{ route('welcome') }}">{{ __('back to landing page') }}</a>
                                    <p>v1.1.0</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
