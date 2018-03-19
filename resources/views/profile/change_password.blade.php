@extends('layouts.home')

@section('title', 'Change Password')

@section('navbar')
    @include('includes.front.navbar')
@endsection

@section('content')

    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div>
                    <span class="profile">Change Password</span>

                    <a class="profile-button pull-right btn btn-primary btn-xs" href="{{route('profile.settings')}}"><span class="glyphicon glyphicon-lock"></span> Settings</a>

                    <a class="pull-right btn btn-primary btn-xs" href="{{route('profile')}}"><span class="glyphicon glyphicon-user"></span> Profile</a>
                </div>
            </div>
            <div class="panel-body">
                <div class="col-md-4">
                    <img alt="image" src="{{$user->photo ? $user->photo->file : $user->photoPlaceholder()}}" class="img-circle img-responsive">
                </div>

                <div class="col-md-8">
                    <div class="col-md-6 col-md-offset-3">
                        {!! Form::model($user, ['method'=>'PATCH', 'action'=>['ProfileController@update_password', $user->id], 'files'=>true]) !!}

                        <div class="form-group">
                            {!! Form::label('old_password', 'Old Password:') !!} <span class="errors">{{$errors->has('old_password') ? $errors->first('old_password') : ''}}</span>
                            {!! Form::password('old_password', ['class'=>'form-control']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('password', 'Password:') !!} <span class="errors">{{$errors->has('password') ? $errors->first('password') : ''}}</span>
                            {!! Form::password('password', ['class'=>'form-control']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('password_confirmation', 'Confirm Password:') !!}
                            {!! Form::password('password_confirmation', ['class'=>'form-control']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::submit('Change Password', ['class'=>'btn btn-danger col-md-12']) !!}
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