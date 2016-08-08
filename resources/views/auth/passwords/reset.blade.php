@extends('layouts.main')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">

            <div class="panel panel-default">

                <div class="panel-heading">Reset Password</div>

                <div class="panel-body">

                    <form role="form" method="POST" action="{{ url('/password/reset') }}">

                        {{--CSRF token field--}}
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        {{--Reset password token--}}
                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <input id="email" type="email" class="form-control input-lg" name="email"
                                   placeholder="E-mail address"
                                   value="{{ $email or old('email') }}">
                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <input id="password" type="password" class="form-control input-lg" name="password"
                                   placeholder="Password">
                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <input id="password-confirm" type="password" class="form-control input-lg" name="password_confirmation"
                                   placeholder="Confirm password">
                            @if ($errors->has('password_confirmation'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-block btn-lg btn-primary">
                                <i class="fa fa-btn fa-refresh"></i> Reset password
                            </button>
                        </div>

                    </form>

                </div>

            </div>

        </div>
    </div>
</div>
@endsection
