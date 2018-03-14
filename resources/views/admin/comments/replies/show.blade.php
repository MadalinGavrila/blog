@extends('layouts.admin')

@section('title', 'Admin')

@section('content')

    <h1 class="page-header">
        Replies <small>List</small>
    </h1>

    @if(count($replies))

        @if(session('replies_status'))
            <div class="alert alert-success text-center">
                {{session('replies_status')}}
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
                    <th>Created</th>
                    <th>Updated</th>
                    <th>Approve</th>
                    <th>Delete</th>
                </tr>
                </thead>
                <tbody>
                @foreach($replies as $reply)

                    <tr>
                        <td>{{$reply->id}}</td>
                        <td>{{$reply->user->username}}</td>
                        <td>{{$reply->body}}</td>
                        <td><a href="{{route('home.post', $reply->comment->post->slug)}}">View Post</a></td>
                        <td>{{$reply->created_at->diffForHumans()}}</td>
                        <td>{{$reply->updated_at->diffForHumans()}}</td>
                        <td>
                            @if($reply->is_active == 1)
                                {!! Form::open(['method'=>'PATCH', 'action'=>['CommentRepliesController@update', $reply->id]]) !!}
                                    <input type="hidden" name="is_active" value="0" />
                                    <div class="form-group">
                                        {!! Form::submit('Un-approve', ['class'=>'btn btn-success btn-xs']) !!}
                                    </div>
                                {!! Form::close() !!}
                            @else
                                {!! Form::open(['method'=>'PATCH', 'action'=>['CommentRepliesController@update', $reply->id]]) !!}
                                    <input type="hidden" name="is_active" value="1" />
                                    <div class="form-group">
                                        {!! Form::submit('Approve', ['class'=>'btn btn-info btn-xs']) !!}
                                    </div>
                                {!! Form::close() !!}
                            @endif
                        </td>
                        <td>
                            {!! Form::open(['method'=>'DELETE', 'action'=>['CommentRepliesController@destroy', $reply->id]]) !!}
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
                {{$replies->links()}}
            </div>
        </div>

    @else

        <div class="alert alert-success text-center">
            <p>No Replies</p>
        </div>

    @endif

@endsection