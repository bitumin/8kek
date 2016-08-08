@extends('layouts.main')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">

                <div class="panel-heading">Login</div>

                <div class="panel-body">
                    {{--Manual login form--}}
                    <form role="form" method="POST" action="{{ url('/login') }}" data-toggle="validator">

                        {{--CSRF token field--}}
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        {{--Trollname/e-mail (login) field--}}
                        <div class="form-group{{ $errors->has('login') ? ' has-error' : '' }}">
                            <input id="login" type="text" class="form-control input-lg" name="login"
                                   value="{{ old('login') }}"
                                   placeholder="Trollname or e-mail"
                                   required data-required-error="Trollname or e-mail required">
                            <span class="help-block with-errors">
                                @if ($errors->has('login'))
                                    {{ $errors->first('login') }}
                                @endif
                            </span>
                        </div>

                        <div class="row">
                            <div class="col-xs-12 col-right-offset-110">
                                {{--Password field--}}
                                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                    <input id="password" type="password" class="form-control input-lg" name="password"
                                           placeholder="Password"
                                           required data-required-error="Password required"
                                           maxlength="50">
                                    <span class="help-block with-errors">
                                        @if ($errors->has('password'))
                                            {{ $errors->first('password') }}
                                        @endif
                                    </span>
                                </div>
                            </div>
                            <div class="col-fixed-right-110">
                                <button type="submit" class="btn btn-lg btn-primary">
                                    <i class="fa fa-btn fa-sign-in"></i> Login
                                </button>
                            </div>
                        </div>


                        {{--Remember me checkbox--}}
                        <div class="form-group">
                            <div id="remember-me-checkbox" class="checkbox"><label><input type="checkbox" name="remember"> Remember me</label></div>
                            .
                            <a href="{{ url('/password/reset') }}">Forgot password?</a>
                        </div>

                    </form>

                    {{--Social login/registration providers--}}
                    <a href="{{ route('facebook.provider') }}" class="btn btn-block btn-social btn-facebook btn-lg">
                        <i class="fa fa-facebook"></i> Login with Facebook
                    </a>
                    <a href="{{ route('twitter.provider') }}" class="btn btn-block btn-social btn-twitter btn-lg">
                        <i class="fa fa-twitter"></i> Login with Twitter
                    </a>

                </div>

            </div>
        </div>
    </div>
</div>
@endsection
