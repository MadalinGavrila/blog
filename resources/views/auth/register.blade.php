@extends('layouts.home')

@section('title', 'Register')

@section('navbar')
    @include('includes.front.navbar')
@endsection

@section('content')

    <div class="col-md-6 col-md-offset-3">
        <h3 class="text-center">Register</h3>

        <div class="well">
            <form method="POST" action="{{route('register')}}">
                @csrf

                <div class="form-group">
                    <label for="name">Name:
                        <span class="errors">{{$errors->has('name') ? $errors->first('name') : ''}}</span>
                    </label>
                    <input type="text" name="name" value="{{old('name')}}" class="form-control" id="name" placeholder="Enter name" />
                </div>

                <div class="form-group">
                    <label for="username">Username:
                        <span class="errors">{{$errors->has('username') ? $errors->first('username') : ''}}</span>
                    </label>
                    <input type="text" name="username" value="{{old('username')}}" class="form-control" id="username" placeholder="Enter username" />
                </div>

                <div class="form-group">
                    <label for="email">E-Mail Address:
                        <span class="errors">{{$errors->has('email') ? $errors->first('email') : ''}}</span>
                    </label>
                    <input type="text" name="email" value="{{old('email')}}" class="form-control" id="email" placeholder="Enter email" />
                </div>

                <div class="form-group">
                    <label for="password">Password:
                        <span class="errors">{{$errors->has('password') ? $errors->first('password') : ''}}</span>
                    </label>
                    <input type="password" name="password" class="form-control" id="password" placeholder="Enter password" />
                </div>

                <div class="form-group">
                    <label for="password_confirmation">Confirm Password:</label>
                    <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" placeholder="Confirm password" />
                </div>

                <button type="submit" class="btn btn-primary">Register</button>
            </form>
        </div>
    </div>

@endsection