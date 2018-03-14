<div class="col-md-4">

    <!-- Blog Search Well -->
    <div class="well">
        <h4>Blog Search
            <span class="errors search-error">{{$errors->has('search') ? $errors->first('search') : ''}}</span>
        </h4>
        <form action="{{route('home.search')}}" method="GET">
            <div class="input-group">
                <input type="text" name="search" class="form-control">
                <span class="input-group-btn">
                    <button class="btn btn-default" type="submit">
                        <span class="glyphicon glyphicon-search"></span>
                    </button>
                </span>
            </div>
        </form>
        <!-- /.input-group -->
    </div>

    <!-- Blog Categories Well -->
    <div class="well">
        <h4>Blog Categories</h4>
        <div class="row">
            <div class="col-lg-12">
                <ul class="list-unstyled">
                    @foreach($categories as $category)
                        <li><a href="{{route('home.category.post', $category->slug)}}">{{$category->name}}</a> <span class="badge pull-right">{{count($category->posts)}}</span></li>
                    @endforeach
                </ul>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
    </div>

</div>