@extends('layouts.home')

@section('title', 'Contact')

@section('navbar')
    @include('includes.front.navbar')
@endsection

@section('content')

    <div class="col-md-8">
        <h3 class="text-center">Contact</h3>

        <div class="col-md-8 col-md-offset-2">

            @if(session('contact_mail'))
                <div class="alert alert-success text-center">
                    {{session('contact_mail')}}
                </div>
            @endif

            <div class="well">
                <form method="POST" action="{{route('home.sendmail')}}">
                    @csrf

                    <div class="form-group">
                        <label for="name">Name:
                            <span class="errors">{{$errors->has('name') ? $errors->first('name') : ''}}</span>
                        </label>
                        <input type="text" name="name" value="{{old('name')}}" class="form-control" id="name">
                    </div>

                    <div class="form-group">
                        <label for="email">Email:
                            <span class="errors">{{$errors->has('email') ? $errors->first('email') : ''}}</span>
                        </label>
                        <input type="text" name="email" value="{{old('email')}}" class="form-control" id="email">
                    </div>

                    <div class="form-group">
                        <label for="message">Message:
                            <span class="errors">{{$errors->has('message') ? $errors->first('message') : ''}}</span>
                        </label>
                        <textarea name="message" class="form-control" rows="3" id="message">{{old('message')}}</textarea>
                    </div>

                    <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-send"></span> Send Message</button>
                </form>
            </div>
        </div>

    </div>

@endsection

@section('sidebar')
    @include('includes.front.sidebar')
@endsection

@section('footer')
    @include('includes.front.footer')
@endsection