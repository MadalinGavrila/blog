@extends('layouts.admin')

@section('title', 'Admin')

@section('content')

    @include('includes.delete_modal')

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


            @if(Auth::user()->checkRole('admin'))

                {!! Form::open(['method'=>'DELETE', 'action'=>['AdminCategoriesController@destroy', $category->id], 'class'=>'form-delete']) !!}

                    <div class="form-group">
                        {!! Form::submit('Delete', ['class'=>'btn btn-danger col-md-6']) !!}
                    </div>

                {!! Form::close() !!}

            @endif
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