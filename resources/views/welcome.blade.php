@extends('layouts.login_header')

@section('content')

        <div class="account-page">
            <div class="account-center">
                <div class="account-box">
                    <form  method="POST" action="{{ route('login') }}" class="form-signin">
                        @csrf 
                        <div class="account-logo">
                            <img src="{{ asset('assets/img/logo-dark.png')}}" alt="">
                        </div>
                        <div class="form-group">
                            <label> Email</label>
                            <input type="email" autofocus="" class="form-control" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="new-email">

                              @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password"  class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

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
                       
                    </form>
                </div>
            </div>
        </div>
   
@endsection
