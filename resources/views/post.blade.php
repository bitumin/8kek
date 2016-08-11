@extends('layouts.main')

@section('content')

    <input class="hidden" name="post-id" id="post-id" value="{{ $post->id }}">

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
                            <span>{{ $post->up }} ups</span> .
                            <span>{{ $post->down }} downs</span>
                        </div>
                        <div>
                            Comments
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
