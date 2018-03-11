@extends('layouts.home')

@section('title', '404')

@section('navbar')

    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{route('home')}}">Blog</a>
            </div>
        </div>
    </nav>

@endsection

@section('content')

    <div class="col-md-8 col-md-offset-2">
        <h3 class="alert alert-danger text-center">Sorry, the page you are looking for could not be found !</h3>
    </div>

@endsection