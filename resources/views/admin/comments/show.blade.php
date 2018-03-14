@extends('layouts.admin')

@section('title', 'Admin')

@section('content')

    <h1 class="page-header">
        Comments <small>List</small>
    </h1>

    @if(count($comments))

        @if(session('comments_status'))
            <div class="alert alert-success text-center">
                {{session('comments_status')}}
            </div>
        @endif

        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Author</th>
                    <th>Body</th>
                    <th>Post</th>
                    <th>Replies</th>
                    <th>Created</th>
                    <th>Updated</th>
                    <th>Approve</th>
                    <th>Delete</th>
                </tr>
                </thead>
                <tbody>
                @foreach($comments as $comment)

                    <tr>
                        <td>{{$comment->id}}</td>
                        <td>{{$comment->user->username}}</td>
                        <td>{{$comment->body}}</td>
                        <td><a href="{{route('home.post', $comment->post->slug)}}">View Post</a></td>
                        <td><a href="{{route('admin.comment.replies.show', $comment->id)}}">{{count($comment->replies)}}</a></td>
                        <td>{{$comment->created_at->diffForHumans()}}</td>
                        <td>{{$comment->updated_at->diffForHumans()}}</td>
                        <td>
                            @if($comment->is_active == 1)
                                {!! Form::open(['method'=>'PATCH', 'action'=>['PostCommentsController@update', $comment->id]]) !!}
                                <input type="hidden" name="is_active" value="0" />
                                <div class="form-group">
                                    {!! Form::submit('Un-approve', ['class'=>'btn btn-success btn-xs']) !!}
                                </div>
                                {!! Form::close() !!}
                            @else
                                {!! Form::open(['method'=>'PATCH', 'action'=>['PostCommentsController@update', $comment->id]]) !!}
                                <input type="hidden" name="is_active" value="1" />
                                <div class="form-group">
                                    {!! Form::submit('Approve', ['class'=>'btn btn-info btn-xs']) !!}
                                </div>
                                {!! Form::close() !!}
                            @endif
                        </td>
                        <td>
                            {!! Form::open(['method'=>'DELETE', 'action'=>['PostCommentsController@destroy', $comment->id]]) !!}
                            <div class="form-group">
                                {!! Form::submit('Delete', ['class'=>'btn btn-danger btn-xs']) !!}
                            </div>
                            {!! Form::close() !!}
                        </td>
                    </tr>

                @endforeach
                </tbody>
            </table>
        </div>

        <div class="row">
            <div class="col-sm-6 col-sm-offset-5">
                {{$comments->links()}}
            </div>
        </div>

    @else

        <div class="alert alert-success text-center">
            <p>No Comments</p>
        </div>

    @endif

@endsection