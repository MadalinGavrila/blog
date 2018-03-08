@extends('layouts.home')

@section('title', 'Login')

@section('navbar')
    @include('includes.front.navbar')
@endsection

@section('content')

    <div class="col-md-6 col-md-offset-3">
        <h3 class="text-center">Login</h3>

        <div class="well">
            <form method="POST" action="{{route('login')}}">
                @csrf

                <div class="form-group">
                    <label for="username">Username:
                        <span class="errors">{{$errors->has('username') ? $errors->first('username') : ''}}</span>
                    </label>
                    <input type="text" name="username" class="form-control" id="username" placeholder="Enter username" />
                </div>

                <div class="form-group">
                    <label for="password">Password:
                        <span class="errors">{{$errors->has('password') ? $errors->first('password') : ''}}</span>
                    </label>
                    <input type="password" name="password" class="form-control" id="password" placeholder="Enter password" />
                </div>

                <div class="checkbox">
                    <label><input type="checkbox" name="remember" {{old('remember') ? 'checked' : ''}}> Remember me</label>
                </div>

                <div>
                    <button type="submit" class="btn btn-primary">Login</button>

                    <a class="pull-right btn btn-link" href="{{route('password.request')}}">Forgot Your Password?</a>
                </div>
            </form>
        </div>
    </div>

@endsection