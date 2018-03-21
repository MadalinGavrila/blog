@extends('layouts.home')

@section('title', 'Post')

@section('navbar')
    @include('includes.front.navbar')
@endsection

@section('content')

    <div class="col-lg-8">

        @if(session('comment_message'))
            <div class="alert alert-success text-center">
                {{session('comment_message')}}
            </div>
        @endif

        <h1>{{$post->title}}</h1>
        <p class="lead">
            by <a href="{{route('home.user.post', $post->user->slug)}}">{{$post->user->username}}</a>
        </p>
        <hr>
        <p><span class="glyphicon glyphicon-time"></span> Posted {{$post->created_at->diffForHumans()}}</p>
        <hr>
        <img class="img-responsive" src="{{$post->photo ? $post->photo->file : $post->photoPlaceholder()}}" alt="image">
        <hr>
        <p>{!! str_limit($post->body, 300) !!}</p>
        <hr>

        <!-- Comments Form -->
        @if(Auth::check() && Auth::user()->isActive())

            <div class="well">
                <h4>Leave a Comment:
                    <span class="errors">{{$errors->has('body') ? $errors->first('body') : ''}}</span>
                </h4>

                {!! Form::open(['method'=>'POST', 'action'=>'PostCommentsController@store']) !!}

                    <input type="hidden" name="post_id" value="{{$post->id}}" />

                    <div class="form-group">
                        {!! Form::textarea('body', null, ['class'=>'form-control', 'rows'=>3]) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::submit('Submit', ['class'=>'btn btn-primary']) !!}
                    </div>

                {!! Form::close() !!}

            </div>

            <hr>

        @endif

        <!-- Comment -->
        @if(count($post->comments()->where('is_active', 1)->get()))

            @foreach($post->comments()->where('is_active', 1)->get() as $comment)

                <div class="media">
                    <a class="pull-left" href="#">
                        <img height="64" width="64" class="media-object" src="{{$comment->user->photo ? $comment->user->photo->file : $comment->user->photoPlaceholder()}}" alt="image">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading">{{$comment->user->name}}
                            <small>{{$comment->created_at->diffForHumans()}}</small>
                        </h4>
                        {{$comment->body}}

                        @if(count($comment->replies()->where('is_active', 1)->get()))

                            @foreach($comment->replies()->where('is_active', 1)->get() as $reply)
                                <!-- Nested Comment -->
                                <div class="media">
                                    <a class="pull-left" href="#">
                                        <img height="64" width="64" class="media-object" src="{{$reply->user->photo ? $reply->user->photo->file : $reply->user->photoPlaceholder()}}" alt="image">
                                    </a>
                                    <div class="media-body">
                                        <h4 class="media-heading">{{$reply->user->name}}
                                            <small>{{$reply->created_at->diffForHumans()}}</small>
                                        </h4>
                                        {{$reply->body}}
                                    </div>

                                    @if($loop->last)

                                        @if(Auth::check() && Auth::user()->isActive())
                                            <div class="reply-container">
                                                <button class="toggle-reply btn btn-primary btn-xs pull-right">Reply</button>

                                                <div class="reply-form">
                                                    {!! Form::open(['method'=>'POST', 'action'=>'CommentRepliesController@store']) !!}

                                                        <input type="hidden" name="comment_id" value="{{$comment->id}}" />

                                                        <div class="form-group">
                                                            {!! Form::textarea('body', null, ['class'=>'form-control', 'rows'=>1]) !!}
                                                        </div>

                                                        <div class="form-group">
                                                            {!! Form::submit('Submit', ['class'=>'btn btn-primary btn-xs']) !!}
                                                        </div>

                                                    {!! Form::close() !!}
                                                </div>
                                            </div>
                                        @endif

                                    @endif

                                </div>
                                <!-- End Nested Comment -->
                            @endforeach

                        @else

                            @if(Auth::check() && Auth::user()->isActive())
                                <div class="reply-container">
                                    <button class="toggle-reply btn btn-primary btn-xs pull-right">Reply</button>

                                    <div class="reply-form">
                                        {!! Form::open(['method'=>'POST', 'action'=>'CommentRepliesController@store']) !!}

                                            <input type="hidden" name="comment_id" value="{{$comment->id}}" />

                                            <div class="form-group">
                                                {!! Form::textarea('body', null, ['class'=>'form-control', 'rows'=>1]) !!}
                                            </div>

                                            <div class="form-group">
                                                {!! Form::submit('Submit', ['class'=>'btn btn-primary btn-xs']) !!}
                                            </div>

                                        {!! Form::close() !!}
                                    </div>
                                </div>
                            @endif

                        @endif

                    </div>
                </div>

            @endforeach

        @endif

    </div>

@endsection

@section('sidebar')
    @include('includes.front.sidebar')
@endsection

@section('footer')
    @include('includes.front.footer')
@endsection

@section('scripts')

    <script>

        $(".reply-container .toggle-reply").click(function(){

            $(this).next().slideToggle("slow");

        });

    </script>

@endsection