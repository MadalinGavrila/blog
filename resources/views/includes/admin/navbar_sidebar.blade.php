<div class="collapse navbar-collapse navbar-ex1-collapse">
    <ul class="nav navbar-nav side-nav">
        <li class="{{Request::is('admin') ? 'active' : ''}}">
            <a href="{{route('admin')}}"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
        </li>
        <li>
            <a href=""><i class="fa fa-users"></i> Users</a>
        </li>
        <li>
            <a href=""><i class="fa fa-file-text"></i> Categories</a>
        </li>
        <li>
            <a href="javascript:;" data-toggle="collapse" data-target="#posts"><i class="fa fa-file"></i> Posts <i class="fa fa-fw fa-caret-down"></i></a>
            <ul id="posts" class="collapse">
                <li>
                    <a href="">All Posts</a>
                </li>
                <li>
                    <a href="">Create Posts</a>
                </li>
            </ul>
        </li>
        <li>
            <a href=""><i class="fa fa-comment"></i> Comments</a>
        </li>
        <li>
            <a href=""><i class="fa fa-camera"></i> Photos</a>
        </li>
    </ul>
</div>