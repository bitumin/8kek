@extends('layouts.main')

<!-- Main Content -->
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">

                <div class="panel-heading">Reset Password</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form role="form" method="POST" action="{{ url('/password/email') }}">

                        {{--CSRF token field--}}
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <input id="email" type="email" class="form-control input-lg" name="email" value="{{ old('email') }}"
                                   placeholder="E-mail address">
                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-block btn-lg btn-primary">
                                <i class="fa fa-btn fa-envelope"></i> Send password reset link
                            </button>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
