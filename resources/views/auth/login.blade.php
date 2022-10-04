@extends('auth.authTemplate.template')

@section('content')

<body style="background-image: url('/storage/logo/Portfolio.png'); background-position: center; background-repeat: no-repeat;background-size: cover;">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <!--<div class="card" style="background-color: #22577A; border-color: #E7F8F0; border-width: 4px;">-->
                <div class="card" style="background-color: #CBCBCB; border-color: #E7F8F0; border-width: 1px;">
                    <div class="card-header"><h4><center style="color: black; font-weight: bold;">SI POS Login</center></h4></div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="email"
                                    class="col-md-4 col-form-label text-md-right" style="color: black;">{{ __('E-Mail Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password"
                                    class="col-md-4 col-form-label text-md-right" style="color: black;">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="current-password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <!--<div class="form-group row">-->
                            <!--    <div class="col-md-6 offset-md-4">-->
                            <!--        <div class="form-check">-->
                            <!--            <input class="form-check-input" type="checkbox" name="remember" id="remember"-->
                            <!--                {{ old('remember') ? 'checked' : '' }}>-->

                            <!--            <label class="form-check-label" for="remember">-->
                            <!--                {{ __('Remember Me') }}-->
                            <!--            </label>-->
                            <!--        </div>-->
                            <!--    </div>-->
                            <!--</div>-->

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-white" style="color: black; font-weight: bold;">
                                        {{ __('Login') }}
                                    </button>

                                    <!--@if (Route::has('password.request'))-->
                                    <!--<a class="btn btn-link" href="{{ route('password.request') }}">-->
                                    <!--    {{ __('Forgot Your Password?') }}-->
                                    <!--</a>-->
                                    <!--@endif-->
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

@endsection