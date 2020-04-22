@extends('layouts.app')

@section('content')
<div class="container" >
    <div class="row justify-content-center" style="margin-top: 30px;">
        <div class="col-md-12 text-center">
           <h1 style="color: white;">ยินดีต้อนรับเข้าสู่ระบบ</h1>
        </div>
        <div class="col-md-6">
            <div class="card">
                <!-- <div class="card-header" style="background-color: blue;color:cornsilk">{{ __('Login') }}</div> -->

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group row justify-content-center">
                            <img src="/img/login.png" width="150px" height="150px" >
                        </div>
                        <div class="form-group row justify-content-center">
                            <!-- <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail') }}</label> -->

                            <div class="col-md-8">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row justify-content-center">
                            <!-- <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label> -->

                            <div class="col-md-8">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div> -->

                        <div class="form-group row justify-content-center">
                            <!-- <div class="col-md-8 offset-md-5"> -->
                                <button type="submit" class="btn btn-primary col-md-3">
                                    <!-- {{ __('Login') }} -->
                                    เข้าสู่ระบบ
                                </button>

                                <!-- @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif -->
                            <!-- </div> -->
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
