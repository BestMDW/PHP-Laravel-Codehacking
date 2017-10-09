@extends('layouts.blog-post')
@section('content')
    <h1 class="my-4">Latest Posts</h1>

    @if($posts->count() > 0)
        @foreach($posts as $post)
            <!-- Blog Post -->
            <div class="card mb-4">
                @if($post->photo)
                    <a href="{{ route('home.post', $post->slug) }}"><img class="card-img-top" src="{{ $post->photo->path }}" alt=""></a>
                @endif
                <div class="card-body">
                    <p class="card-text">{!! str_limit($post->body, 200) !!}</p>
                </div>
                <div class="card-footer text-muted">
                    Posted on {{ $post->created_at->diffForHumans() }} by
                    <a href="#">{{ $post->user->name }}</a>
                </div>
            </div>
        @endforeach

        {{ $posts->links('vendor.pagination.bootstrap-4') }}
    @else

    @endif
@stop