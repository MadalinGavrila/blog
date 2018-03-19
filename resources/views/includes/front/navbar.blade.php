<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{route('home')}}">Blog</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="{{Request::is('contact') ? 'active' : ''}}">
                    <a href="{{route('home.contact')}}">Contact</a>
                </li>
            </ul>

            <ul class="nav navbar-nav navbar-right">
                @guest
                    <li class="{{Request::is('register') ? 'active' : ''}}">
                        <a href="{{route('register')}}"><span class="glyphicon glyphicon-user"></span> Register</a>
                    </li>
                    <li class="{{Request::is('login') ? 'active' : ''}}">
                        <a href="{{route('login')}}"><span class="glyphicon glyphicon-log-in"></span> Login</a>
                    </li>
                @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span> {{Auth::user()->username}} <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            @if(Auth::user()->role->name == 'admin')
                                <li>
                                    <a href="{{route('admin')}}"><span class="glyphicon glyphicon-dashboard"></span> Admin</a>
                                </li>
                            @endif
                            <li>
                                <a href="{{route('profile')}}"><span class="glyphicon glyphicon-user"></span> Profile</a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="{{route('logout')}}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><span class="glyphicon glyphicon-off"></span> Log Out</a>
                            </li>
                            <form id="logout-form" action="{{route('logout')}}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </ul>
                    </li>
                @endguest
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>