@extends('layouts.main')

@section('content')

    {{--CSRF token field--}}
    <input type="hidden" name="_token" value="{{ csrf_token() }}" title="_token">

    {{--Post id--}}
    <input class="hidden" name="post-id" value="{{ $post->id }}" title="post-id">

    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">

                <div class="panel panel-default">

                    <div class="panel-heading">{{ $post->title }}</div>

                    <div class="panel-body">

                        <div>Posted at {{ $post->created_at }}</div>
                        <div class="image-container">
                            <img class="img-responsive" alt="{{ $post->title }}" src="/image/{{ $post->image }}">
                        </div>
                        <div>
                            <span>{{ $post->views }} views</span> .
                            <span id="up-votes">{{ $post->up }} ups</span> .
                            <span id="down-votes">{{ $post->down }} downs</span>
                        </div>
                        <div>
                            <a id="up-vote" class="btn btn-default btn-lg{{ $allowVote ? '' : ' disabled' }}">
                                <i class="fa fa-thumbs-up"></i> Up</a>
                            <a id="down-vote" class="btn btn-default btn-lg{{ $allowVote ? '' : ' disabled' }}">
                                <i class="fa fa-thumbs-down"></i> Down</a>
                        </div>

                        <div class="comments-container">

                            @include('comments')

                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
