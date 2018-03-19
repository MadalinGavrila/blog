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

                    <a class="profile-button pull-right btn btn-primary btn-xs" href="{{route('user.profile.settings')}}"><span class="glyphicon glyphicon-lock"></span> Settings</a>

                    <a class="pull-right btn btn-primary btn-xs" href="{{route('user.profile')}}"><span class="glyphicon glyphicon-user"></span> Profile</a>
                </div>
            </div>
            <div class="panel-body">
                <div class="col-md-4">
                    <img alt="image" src="{{$user->photo ? $user->photo->file : $user->photoPlaceholder()}}" class="img-circle img-responsive">
                </div>

                <div class="col-md-8">
                    <div class="col-md-6 col-md-offset-3">
                        {!! Form::model($user, ['method'=>'PATCH', 'action'=>['UserController@update', $user->id], 'files'=>true]) !!}

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