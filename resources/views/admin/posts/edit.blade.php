@extends('layouts.admin')

@section('title', 'Admin')

@section('content')

    @include('includes.delete_modal')

    <h1 class="page-header">
        Post <small>Update</small>
    </h1>

    <div class="col-md-3">
        <img src="{{$post->photo ? $post->photo->file : $post->photoPlaceholder()}}" alt="image" class="img-responsive img-rounded" />
    </div>

    <div class="col-md-9">
        <div class="col-md-8 col-md-offset-2">

            <div class="col-md-12">
                <div class="row">
                    @include('includes.form_error')
                </div>
            </div>

            {!! Form::model($post, ['method'=>'PATCH', 'action'=>['AdminPostsController@update', $post->id], 'files'=>true]) !!}

                <div class="form-group">
                    {!! Form::label('title', 'Title:') !!}
                    {!! Form::text('title', null, ['class'=>'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('category_id', 'Category:') !!}
                    {!! Form::select('category_id', $categories, null, ['class'=>'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('photo_id', 'Photo:') !!}
                    {!! Form::file('photo_id', null, ['class'=>'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('body', 'Description:') !!}
                    {!! Form::textarea('body', null, ['class'=>'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::submit('Update', ['class'=>'btn btn-primary col-md-6']) !!}
                </div>

            {!! Form::close() !!}


            {!! Form::open(['method'=>'DELETE', 'action'=>['AdminPostsController@destroy', $post->id], 'class'=>'form-delete']) !!}

                <div class="form-group">
                    {!! Form::submit('Delete', ['class'=>'btn btn-danger col-md-6']) !!}
                </div>

            {!! Form::close() !!}
        </div>
    </div>

@endsection

@section('scripts')

    <script>

        $(document).ready(function(){

            $(".form-delete").on('click', function(e){

                e.preventDefault();

                var form = $(this);

                $("#delete_modal").modal({ backdrop: 'static', keyboard: false }).on('click', '#delete-btn', function(){

                    form.submit();

                });

            });

        });

    </script>

@endsection