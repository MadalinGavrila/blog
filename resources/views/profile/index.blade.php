@extends('layouts.home')

@section('title', 'Profile')

@section('navbar')
    @include('includes.front.navbar')
@endsection

@section('content')

    <div class="col-md-12">

        @if(session('profile_status'))
            <div class="alert alert-success text-center">
                {{session('profile_status')}}
            </div>
        @endif

        <div class="panel panel-default">
            <div class="panel-heading">
                <div>
                    <span class="profile">Profile</span>

                    <a class="pull-right btn btn-primary btn-xs" href="{{route('user.profile.settings')}}"><span class="glyphicon glyphicon-cog"></span> Settings</a>
                </div>
            </div>
            <div class="panel-body">
                <div class="col-md-4">
                    <img alt="image" src="{{$user->photo ? $user->photo->file : $user->photoPlaceholder()}}" class="img-circle img-responsive">
                </div>

                <div class="col-md-8">
                    <div>
                        <h2>{{$user->name}}</h2>
                        <p>{{$user->role->name}}</p>
                    </div>
                    <hr>
                    <ul class="list-unstyled">
                        <li><p><span class="glyphicon glyphicon-user"></span> {{$user->username}}</p></li>
                        <li><p><span class="glyphicon glyphicon-envelope"></span> {{$user->email}}</p></li>
                    </ul>
                    <hr>
                    <div>Date Of Joining: {{$user->created_at->toFormattedDateString()}}</div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('footer')
    @include('includes.front.footer')
@endsection