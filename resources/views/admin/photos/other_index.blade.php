@extends('layouts.admin')

@section('title', 'Admin')

@section('content')

    <h1 class="page-header">
        Photos <small>List</small>
    </h1>

    @if(count($posts_photo))

        @if(session('photos_status'))
            <div class="alert alert-success text-center">
                {{session('photos_status')}}
            </div>
        @endif

        <form action="{{route('admin.photos.deletePhoto')}}" method="POST" class="form-inline">

            {{csrf_field()}}

            {{method_field('delete')}}

            <div class="form-group">
                <select name="options" class="form-control">
                    <option value="delete">Delete</option>
                </select>
            </div>

            <div class="form-group">
                <input type="submit" name="submit" value="Submit" class="btn btn-primary" />
            </div>

            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th><input type="checkbox" id="select_photos" /></th>
                        <th>Id</th>
                        <th>Photo</th>
                        <th>Owner</th>
                        <th>Created</th>
                        <th>Updated</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($posts_photo as $post)

                        <tr>
                            <td><input class="checkBoxes" type="checkbox" name="checkBoxArray[]" value="{{$post->photo->id}}" /></td>
                            <td>{{$post->photo->id}}</td>
                            <td><img height="50" src="{{$post->photo->file}}" alt="image" /></td>
                            <td>{{$post->title}}</td>
                            <td>{{$post->photo->created_at->diffForHumans()}}</td>
                            <td>{{$post->photo->updated_at->diffForHumans()}}</td>
                        </tr>

                    @endforeach
                    </tbody>
                </table>
            </div>
        </form>

        <div class="row">
            <div class="col-sm-6 col-sm-offset-5">
                {{$posts_photo->links()}}
            </div>
        </div>

    @else

        <div class="alert alert-success text-center">
            <p>No Photos</p>
        </div>

    @endif

@endsection

@section('scripts')

    <script>

        $(document).ready(function(){

            $('#select_photos').click(function(){
                if(this.checked){
                    $('.checkBoxes').each(function(){
                        this.checked = true;
                    });
                } else {
                    $('.checkBoxes').each(function(){
                        this.checked = false;
                    });
                }
            });

        });

    </script>

@endsection