@extends('layouts.home')

@section('title', '404')

@section('navbar')
    @include('includes.front.navbar')
@endsection

@section('content')

    <div class="col-md-8">
        <h3 class="alert alert-danger text-center">Sorry, the page you are looking for could not be found !</h3>
    </div>

@endsection

@section('sidebar')
    @include('includes.front.sidebar')
@endsection

@section('footer')
    @include('includes.front.footer')
@endsection