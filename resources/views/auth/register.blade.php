@extends('layouts.main')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">

                <div class="panel-heading">Register</div>

                <div class="panel-body">

                    {{--Manual registration form--}}

                    <form role="form" method="POST" action="{{ url('/register') }}" data-toggle="validator">

                        {{--CSRF token field--}}
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        {{--Nickname field--}}
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }} has-feedback">
                            <input id="name" type="text" class="form-control input-lg" name="name" value="{{ old('name') }}"
                                   placeholder="Trollname / Nom de guerre"
                                   data-remote="{{ route('api.available.name') }}" data-remote-error="Trollname already taken"
                                   pattern="^[A-Za-z0-9_]{1,20}$" data-pattern-error="Does not follow the pattern [A-Za-z0-9_]{1,20}"
                                   required data-required-error="Trollname required"
                                   maxlength="20">
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                            <span class="help-block with-errors">
                                @if ($errors->has('name'))
                                    {{ $errors->first('name') }}
                                @endif
                            </span>
                        </div>

                        {{--Email address field--}}
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }} has-feedback">
                            <input id="email" type="email" class="form-control input-lg" name="email" value="{{ old('email') }}"
                                   placeholder="E-mail address"
                                   data-remote="{{ route('api.available.email') }}" data-remote-error="An account with this e-mail already exists"
                                   required data-required-error="E-mail required"
                                   data-error="Doesn't even look like an e-mail address, try harder"
                                   maxlength="255">
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                            <span class="help-block with-errors">
                                @if ($errors->has('email'))
                                    {{ $errors->first('email') }}
                                @endif
                            </span>
                        </div>

                        {{--New password field--}}
                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }} has-feedback">
                            <div id="pwd-strength-bar">
                                <div id="pwd-strength-viewport-progress"></div>
                            </div>
                            <input id="password-register" type="password" class="form-control input-lg" name="password"
                                   placeholder="Password"
                                   data-minlength="6" data-minlength-error="At least 6 characters"
                                   required data-required-error="Password required"
                                   maxlength="50">
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                            <span class="help-block with-errors">
                                @if ($errors->has('password'))
                                    {{ $errors->first('password') }}
                                @endif
                            </span>
                        </div>

                        {{--Password confirmation field--}}
                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }} has-feedback">
                            <input id="password-confirm" type="password" class="form-control input-lg" name="password_confirmation"
                                   placeholder="Confirm password"
                                   data-match="#password-register" data-match-error="Not the same"
                                   required data-required-error="Password confirmation required"
                                   maxlength="50">
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                            <span class="help-block with-errors">
                                @if ($errors->has('password_confirmation'))
                                    {{ $errors->first('password_confirmation') }}
                                @endif
                            </span>
                        </div>

                        {{--Recaptcha--}}
                        {!! Recaptcha::render() !!}

                        {{--Cancel and register button--}}
                        <div class="form-group" align="right">
                            <button type="submit" class="btn btn-lg btn-block btn-primary">
                                <i class="fa fa-btn fa-user-plus"></i> Sign up
                            </button>
                        </div>
                    </form>

                    {{--Social login/registration providers--}}
                    <a href="{{ route('facebook.provider') }}" class="btn btn-block btn-social btn-facebook btn-lg">
                        <i class="fa fa-facebook"></i> Sign up with Facebook
                    </a>
                    <a href="{{ route('twitter.provider') }}" class="btn btn-block btn-social btn-twitter btn-lg">
                        <i class="fa fa-twitter"></i> Sign up with Twitter
                    </a>

                </div>

            </div>

        </div>
    </div>
</div>
@endsection
