@extends('layouts.main')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">

                <div class="panel-heading">
                    <div class="title">{{ $title }}</div>
                    @if($hasSinceScopes)
                        <div class="since-scopes">
                            <a
                                class="since-scope@if($lastWeekScopeIsActive) active@endif"
                                href="{{ route($currentRoute, ['last-week']) }}">Last week</a> .
                            <a
                                class="since-scope@if($lastMonthScopeIsActive) active@endif"
                                href="{{ route($currentRoute, ['last-month']) }}">Last month</a> .
                            <a
                                class="since-scope@if($lastYearScopeIsActive) active@endif"
                                href="{{ route($currentRoute, ['last-year']) }}">Last year</a> .
                            <a
                                class="since-scope@if($allTimeScopeIsActive) active@endif"
                                href="{{ route($currentRoute, ['all-time']) }}">All time</a>
                        </div>
                    @endif
                </div>

                <div class="panel-body posts">

                    <div class="scroll">

                        @foreach($posts as $p)
                            <div><a href="/post/{{ $p->id }}">{{ $p->title }}</a></div>
                            <div>Posted at {{ $p->created_at }}</div>
                            <div class="image-container">
                                <a href="/post/{{ $p->id }}">
                                    <img class="img-responsive" alt="{{ $p->title }}" src="/image/{{ $p->image }}">
                                </a>
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
