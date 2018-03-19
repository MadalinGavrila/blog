@extends('layouts.home')

@section('title', 'Settings')

@section('navbar')
    @include('includes.front.navbar')
@endsection

@section('content')

    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div>
                    <span class="profile">Settings</span>

                    <a class="profile-button pull-right btn btn-danger btn-xs" href="{{route('profile.change_password')}}"><span class="glyphicon glyphicon-lock"></span> Change Password</a>

                    <a class="pull-right btn btn-primary btn-xs" href="{{route('profile')}}"><span class="glyphicon glyphicon-user"></span> Profile</a>
                </div>
            </div>
            <div class="panel-body">
                <div class="col-md-4">
                    <img alt="image" src="{{$user->photo ? $user->photo->file : $user->photoPlaceholder()}}" class="img-circle img-responsive">
                </div>

                <div class="col-md-8">
                    <div class="col-md-6 col-md-offset-3">
                        {!! Form::model($user, ['method'=>'PATCH', 'action'=>['ProfileController@update', $user->id], 'files'=>true]) !!}

                        <div class="form-group">
                            {!! Form::label('name', 'Name:') !!} <span class="errors">{{$errors->has('name') ? $errors->first('name') : ''}}</span>
                            {!! Form::text('name', null, ['class'=>'form-control']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('email', 'Email:') !!} <span class="errors">{{$errors->has('email') ? $errors->first('email') : ''}}</span>
                            {!! Form::text('email', null, ['class'=>'form-control']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('photo_id', 'Photo:') !!}
                            {!! Form::file('photo_id', null, ['class'=>'form-control']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::submit('Edit Profile', ['class'=>'btn btn-primary col-md-12']) !!}
                        </div>

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('footer')
    @include('includes.front.footer')
@endsection