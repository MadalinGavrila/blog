@extends('layouts.admin')

@section('title', 'Admin')

@section('content')

    <h1 class="page-header">
        Categories <small>Create / List</small>
    </h1>

    <div class="col-md-6">
        <div class="col-md-8 col-md-offset-2">

            <div class="col-md-12">
                <div class="row">
                    @include('includes.form_error')
                </div>
            </div>

            {!! Form::open(['method'=>'POST', 'action'=>'AdminCategoriesController@store']) !!}

            <div class="form-group">
                {!! Form::label('name', 'Name:') !!}
                {!! Form::text('name', null, ['class'=>'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::submit('Create Category', ['class'=>'btn btn-primary']) !!}
            </div>

            {!! Form::close() !!}
        </div>
    </div>

    <div class="col-md-6">
        @if(count($categories))

            @if(session('categories_status'))
                <div class="alert alert-success text-center">
                    {{session('categories_status')}}
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Created</th>
                        <th>Updated</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($categories as $category)

                        <tr>
                            <td>{{$category->id}}</td>
                            <td><a href="{{route('admin.categories.edit', $category->id)}}">{{$category->name}}</a></td>
                            <td>{{$category->created_at->diffForHumans()}}</td>
                            <td>{{$category->updated_at->diffForHumans()}}</td>
                        </tr>

                    @endforeach
                    </tbody>
                </table>
            </div>

            <div class="row">
                <div class="col-sm-6 col-sm-offset-5">
                    {{$categories->links()}}
                </div>
            </div>

        @else

            <h1 class="text-center">No Categories</h1>

        @endif
    </div>

@endsection