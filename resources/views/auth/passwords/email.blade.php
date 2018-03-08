@extends('layouts.home')

@section('title', 'Reset Password')

@section('navbar')
    @include('includes.front.navbar')
@endsection

@section('content')

    <div class="col-md-6 col-md-offset-3">
        <h3 class="text-center">Reset Password</h3>

        @if(session('status'))
            <div class="alert alert-success">
                {{session('status')}}
            </div>
        @endif

        <div class="well">
            <form method="POST" action="{{route('password.email')}}">
                @csrf

                <div class="form-group">
                    <label for="email">E-Mail Address:
                        <span class="errors">{{$errors->has('email') ? $errors->first('email') : ''}}</span>
                    </label>
                    <input type="text" name="email" value="{{old('email')}}" class="form-control" id="email" placeholder="Enter email" />
                </div>

                <button type="submit" class="btn btn-primary">Send Password Reset Link</button>
            </form>
        </div>
    </div>

@endsection