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
                </tr>
                </thead>
                <tbody>
                @foreach($posts as $post)

                    <tr>
                        <td>{{$post->id}}</td>
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