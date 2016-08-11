@extends('layouts.main')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">

                <div class="panel-heading">Last posts</div>

                <div class="panel-body posts">

                    <div class="scroll">

                        @foreach($posts as $p)
                            <div><a href="/post/{{ $p->id }}">{{ $p->title }}</a></div>
                            <div>Posted at {{ $p->created_at }}</div>
                            <div class="image-container">
                                <img class="img-responsive" alt="{{ $p->title }}" src="/image/{{ $p->image }}">
                            </div>
                            <div>
                                <span>{{ $p->views }} views</span> .
                                <span>{{ $p->up }} ups</span> .
                                <span>{{ $p->down }} downs</span>
                            </div>
                        @endforeach

                        <div class="pagination-controller">
                            <a class="next" href="{{ $posts->nextPageUrl() }}">More posts...</a>
                        </div>

                    </div>

                </div>

            </div>
        </div>
    </div>
</div>
@endsection
