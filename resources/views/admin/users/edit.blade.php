@extends('layouts.admin')

@section('title', 'Admin')

@section('content')

    <h1 class="page-header">
        User <small>Update</small>
    </h1>

    <div class="col-md-3">
        <img src="{{$user->photo ? $user->photo->file : $user->photoPlaceholder()}}" alt="image" class="img-responsive img-rounded" />
    </div>

    <div class="col-md-9">
        <div class="col-md-8 col-md-offset-2">

            <div class="col-md-12">
                <div class="row">
                    @include('includes.form_error')
                </div>
            </div>

            {!! Form::model($user, ['method'=>'PATCH', 'action'=>['AdminUsersController@update', $user->id], 'files'=>true]) !!}

            <div class="form-group">
                {!! Form::label('name', 'Name:') !!}
                {!! Form::text('name', null, ['class'=>'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('role_id', 'Role:') !!}
                {!! Form::select('role_id', $roles, null, ['class'=>'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('is_active', 'Status:') !!}
                {!! Form::select('is_active', [0 => 'Not Active', 1 => 'Active'], null, ['class'=>'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('photo_id', 'Photo:') !!}
                {!! Form::file('photo_id', null, ['class'=>'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::submit('Update', ['class'=>'btn btn-primary col-md-6']) !!}
            </div>

            {!! Form::close() !!}


            {!! Form::open(['method'=>'DELETE', 'action'=>['AdminUsersController@destroy', $user->id]]) !!}

            <div class="form-group">
                {!! Form::submit('Delete', ['class'=>'btn btn-danger col-md-6']) !!}
            </div>

            {!! Form::close() !!}
        </div>
    </div>

@endsection