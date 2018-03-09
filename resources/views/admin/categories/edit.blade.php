@extends('layouts.admin')

@section('title', 'Admin')

@section('content')

    <h1 class="page-header">
        Category <small>Update</small>
    </h1>

    <div class="col-md-6">
        <div class="col-md-8 col-md-offset-2">

            <div class="col-md-12">
                <div class="row">
                    @include('includes.form_error')
                </div>
            </div>

            {!! Form::model($category, ['method'=>'PATCH', 'action'=>['AdminCategoriesController@update', $category->id]]) !!}

            <div class="form-group">
                {!! Form::label('name', 'Name:') !!}
                {!! Form::text('name', null, ['class'=>'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::submit('Update', ['class'=>'btn btn-primary col-md-6']) !!}
            </div>

            {!! Form::close() !!}


            {!! Form::open(['method'=>'DELETE', 'action'=>['AdminCategoriesController@destroy', $category->id]]) !!}

            <div class="form-group">
                {!! Form::submit('Delete', ['class'=>'btn btn-danger col-md-6']) !!}
            </div>

            {!! Form::close() !!}
        </div>
    </div>

@endsection