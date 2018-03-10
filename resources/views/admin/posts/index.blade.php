@extends('layouts.admin')

@section('title', 'Admin')

@section('content')

    <h1 class="page-header">
        Posts <small>List</small>
    </h1>

    @if(count($posts))

        @if(session('posts_status'))
            <div class="alert alert-success text-center">
                {{session('posts_status')}}
            </div>
        @endif

        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Photo</th>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Category</th>
                    <th>Post</th>
                    <th>Comments</th>
                    <th>Created</th>
                    <th>Updated</th>
                    <th>Edit</th>
                </tr>
                </thead>
                <tbody>
                @foreach($posts as $post)

                    <tr>
                        <td>{{$post->id}}</td>
                        <td><img height="50" src="{{$post->photo ? $post->photo->file : $post->photoPlaceholder()}}" alt="image" /></td>
                        <td>{{$post->title}}</td>
                        <td>{{$post->user->username}}</td>
                        <td>{{$post->category ? $post->category->name : 'Uncategorized'}}</td>
                        <td><a href="{{route('home.post', $post->slug)}}">View Post</a></td>
                        <td><a href="">{{count($post->comments)}}</a></td>
                        <td>{{$post->created_at->diffForHumans()}}</td>
                        <td>{{$post->updated_at->diffForHumans()}}</td>
                        <td><a class="btn btn-primary btn-xs" href="{{route('admin.posts.edit', $post->id)}}">Edit</a></td>
                    </tr>

                @endforeach
                </tbody>
            </table>
        </div>

        <div class="row">
            <div class="col-sm-6 col-sm-offset-5">
                {{$posts->links()}}
            </div>
        </div>

    @else

        <h1 class="text-center">No Posts</h1>

    @endif

@endsection