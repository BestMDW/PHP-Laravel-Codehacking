@extends('layouts.blog-post')
@section('content')
    <h1 class="my-4">{{ $post->title }}</h1>

    <!-- Blog Post -->
    <div class="card mb-4">
        @if($post->photo)
            <img class="card-img-top" src="{{ $post->photo->path }}" alt="">
        @endif
        <div class="card-body">
            <p class="card-text">{{ $post->body }}</p>
        </div>
        <div class="card-footer text-muted">
            Posted on {{ $post->created_at->diffForHumans() }} by
            <a href="#">{{ $post->user->name }}</a>
        </div>
    </div>

    <hr>

    <!-- Blog Comments -->
    @if(Auth::check())
        @if(Session::has('comment_message'))
            <div class="alert alert-success">
                <strong>Success!</strong> {{ session('comment_message') }}
            </div>
        @endif

        <!-- Comments Form -->
        <div class="card mb-4" style="background-color: rgba(0, 0, 0, .03);">
            <h4 class="card-header">Leave a Comment:</h4>
            <div class="card-body">
                {!! Form::open(['method' => 'POST', 'action' => 'PostCommentsController@store']) !!}
                    <input type="hidden" name="post_id" value="{{ $post->id }}">
                    <div class="form-group">
                        {!! Form::textarea('body', null, ['class' => 'form-control', 'rows' => 3]) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::submit('Submit comment', ['class' => 'btn btn-primary pull-right']) !!}
                    </div>
                {!! Form::close() !!}
            </div>
        </div>

        <hr>
    @endif

    <!-- Posted Comments -->
    @if($comments->count() > 0)
        @foreach($comments as $comment)
            <div class="media mt-2 mb-2 p-2 border rounded bg-light">
                <img class="d-flex mr-3 rounded" style="width: 45px" src="{{ $comment->gravatar }}" alt="">
                <div class="media-body">
                    <h6 class="media-heading">
                        <!-- Reply button -->
                        <i class="toggle-reply fa fa-reply pull-right" style="cursor: pointer">&nbsp;</i>
                        {{ $comment->author }} <small><i>{{ $comment->created_at->diffForHumans() }}</i></small>
                    </h6>
                    <p>{{ $comment->body }}</p>
                    <!-- Reply form container -->
                    <div class="comment-reply">
                        {!! Form::open(['method' => 'POST', 'action' => 'CommentsRepliesController@createReply']) !!}
                        <input type="hidden" name="comment_id" value="{{ $comment->id }}">
                        <div class="input-group">
                            {!! Form::textarea('body', null, ['class' => 'form-control', 'rows' => 1, 'placeholder' => 'Reply Message']) !!}
                            <div class="input-group-btn">
                                {!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                    <!-- End reply form container -->
                    @if($comment->replies(1)->count() > 0)
                        @foreach($comment->replies(1)->get() as $reply)
                            <div class="media mt-2 mb-2 p-2 rounded bg-dark text-white">
                                <img class="d-flex mr-3 rounded" style="width: 45px" src="{{ $reply->gravatar }}" alt="">
                                <div class="media-body">
                                    <h6 class="media-heading">
                                        {{ $reply->author }} <small><i>{{ $reply->created_at->diffForHumans() }}</i></small>
                                    </h6>
                                    <p>{{ $reply->body }}</p>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        @endforeach
    @endif
@stop

@section('scripts')
    <script type="text/javascript">
        $(".media .toggle-reply").click(function() {
            $(this).parents(".media-body").children(".comment-reply").slideToggle("slow");
        });
    </script>
@stop