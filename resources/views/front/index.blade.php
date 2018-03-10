@extends('layouts.home')

@section('title', 'Home')

@section('navbar')
    @include('includes.front.navbar')
@endsection

@section('content')

    <div class="col-md-8">

        @if(count($posts))

            @foreach($posts as $post)

                <h2>
                    <a href="{{route('home.post', $post->slug)}}">{{$post->title}}</a>
                </h2>
                <p class="lead">
                    by <a href="">{{$post->user->username}}</a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted {{$post->created_at->diffForHumans()}}</p>
                <hr>
                <img class="img-responsive" src="{{$post->photo ? $post->photo->file : $post->photoPlaceholder()}}" alt="image">
                <hr>
                <p>{!! str_limit($post->body, 300) !!}</p>
                <a class="btn btn-primary" href="{{route('home.post', $post->slug)}}">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>

            @endforeach

            <!-- Pagination -->
            <div class="row">
                <div class="col-sm-6 col-sm-offset-5">
                    {{$posts->links()}}
                </div>
            </div>

        @else

            <h1 class="text-center">No Posts</h1>

        @endif

    </div>

@endsection

@section('sidebar')
    @include('includes.front.sidebar')
@endsection

@section('footer')
    @include('includes.front.footer')
@endsection