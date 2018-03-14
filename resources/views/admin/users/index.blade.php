@extends('layouts.admin')

@section('title', 'Admin')

@section('content')

    <h1 class="page-header">
        Users <small>List</small>
    </h1>

    @if(count($users))

        @if(session('users_status'))
            <div class="alert alert-success text-center">
                {{session('users_status')}}
            </div>
        @endif

        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Photo</th>
                    <th>Role</th>
                    <th>Name</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Created</th>
                    <th>Updated</th>
                    <th>Edit</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)

                    <tr>
                        <td>{{$user->id}}</td>
                        <td><img height="50" src="{{$user->photo ? $user->photo->file : $user->photoPlaceholder()}}" alt="image" /></td>
                        <td>{{$user->role->name}}</td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->username}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->is_active == 1 ? 'Active' : 'Not Active'}}</td>
                        <td>{{$user->created_at->diffForHumans()}}</td>
                        <td>{{$user->updated_at->diffForHumans()}}</td>
                        <td><a class="btn btn-primary btn-xs" href="{{route('admin.users.edit', $user->id)}}">Edit</a></td>
                    </tr>

                @endforeach
                </tbody>
            </table>
        </div>

        <div class="row">
            <div class="col-sm-6 col-sm-offset-5">
                {{$users->links()}}
            </div>
        </div>

    @else

        <div class="alert alert-success text-center">
            <p>No Users</p>
        </div>

    @endif

@endsection