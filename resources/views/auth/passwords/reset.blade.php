@extends('layouts.home')

@section('title', 'Reset Password')

@section('navbar')
    @include('includes.front.navbar')
@endsection

@section('content')

    <div class="col-md-6 col-md-offset-3">
        <h3 class="text-center">Reset Password</h3>

        <div class="well">
            <form method="POST" action="{{route('password.request')}}">
                @csrf

                <input type="hidden" name="token" value="{{$token}}" />

                <div class="form-group">
                    <label for="email">E-Mail Address:
                        <span class="errors">{{$errors->has('email') ? $errors->first('email') : ''}}</span>
                    </label>
                    <input type="text" name="email" value="{{$email or old('email')}}" class="form-control" id="email" placeholder="Enter email" />
                </div>

                <div class="form-group">
                    <label for="password">Password:
                        <span class="errors">{{$errors->has('password') ? $errors->first('password') : ''}}</span>
                    </label>
                    <input type="password" name="password" class="form-control" id="password" placeholder="Enter password" />
                </div>

                <div class="form-group">
                    <label for="password_confirmation">Confirm Password:
                        <span class="errors">{{$errors->has('password_confirmation') ? $errors->first('password_confirmation') : ''}}</span>
                    </label>
                    <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" placeholder="Confirm password" />
                </div>

                <button type="submit" class="btn btn-primary">Reset Password</button>
            </form>
        </div>
    </div>

@endsection