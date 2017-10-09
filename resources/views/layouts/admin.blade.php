<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin</title>

    <!-- Bootstrap Core CSS -->
    <link href="{{asset('css/libs.css')}}" rel="stylesheet">
    <link href="{{asset('css/app.css')}}" rel="stylesheet">
    <style type="text/css">
        #sidebar .list-group-item {
            border-radius: 0;
            background-color: #343a40;
            color: #ccc;
            border-left: 0;
            border-right: 0;
            border-color: #2c2c2c;
            white-space: nowrap;
        }

        /* highlight active menu */
        #sidebar .list-group-item:not(.collapsed) {
            background-color: #333;
        }

        /* closed state */
        #sidebar .list-group .list-group-item[aria-expanded="false"]::after {
            content: " \f0d7";
            font-family: FontAwesome;
            display: inline;
            text-align: right;
            padding-left: 5px;
        }

        /* open state */
        #sidebar .list-group .list-group-item[aria-expanded="true"] {
            background-color: #333;
        }
        #sidebar .list-group .list-group-item[aria-expanded="true"]::after {
            content: " \f0da";
            font-family: FontAwesome;
            display: inline;
            text-align: right;
            padding-left: 5px;
        }

        /* level 1*/
        #sidebar .list-group .collapse .list-group-item  {
            padding-left: 20px;
        }

        /* level 2*/
        #sidebar .list-group .collapse > .collapse .list-group-item {
            padding-left: 30px;
        }

        /* level 3*/
        #sidebar .list-group .collapse > .collapse > .collapse .list-group-item {
            padding-left: 40px;
        }

        @media (max-width:48em) {
            /* overlay sub levels on small screens */
            #sidebar .list-group .collapse.in, #sidebar .list-group .collapsing {
                position: absolute;
                z-index: 1;
                width: 190px;
            }
            #sidebar .list-group > .list-group-item {
                text-align: center;
                padding: .75rem .5rem;
            }
            /* hide caret icons of top level when collapsed */
            #sidebar .list-group > .list-group-item[aria-expanded="true"]::after,
            #sidebar .list-group > .list-group-item[aria-expanded="false"]::after {
                display:none;
            }
        }

        /* change transition animation to width when entire sidebar is toggled */
        #sidebar.collapse {
            -webkit-transition-timing-function: ease;
            -o-transition-timing-function: ease;
            transition-timing-function: ease;
            -webkit-transition-duration: .2s;
            -o-transition-duration: .2s;
            transition-duration: .2s;
        }

        #sidebar.collapsing {
            opacity: 0.8;
            width: 0;
            -webkit-transition-timing-function: ease-in;
            -o-transition-timing-function: ease-in;
            transition-timing-function: ease-in;
            -webkit-transition-property: width;
            -o-transition-property: width;
            transition-property: width;

        }
    </style>
    @yield('styles')
</head>

<body id="admin-page">
    <!-- Navigation -->
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark text-white" role="navigation">
        <div class="container">
            <a class="navbar-brand" href="/">Home</a>
            <!-- /.navbar-header -->
            <ul class="navbar-nav">
                <!-- /.dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>
                    </a>
                    <div class="dropdown-menu">
                        <a href="#" class="dropdown-item"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        <a href="#" class="dropdown-item"><i class="fa fa-gear fa-fw"></i> Settings</a>
                        <div class="dropdown-divider"></div>
                        <a href="{{ url('/logout') }}" class="dropdown-item"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                    </div>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->

            </ul>
        </div>
    </nav>
    <div class="container-fluid">
        <div class="row">
            <div id="sidebar" class="col-md-2 col-xs-1 px-0 collapse show">
                <div class="list-group card border-0">
                    <a href="/admin" class="list-group-item collapsed">
                        <i class="fa fa-dashboard"></i> <span class="hidden-sm-down">Dashboard</span>
                    </a>
                    <a href="#menu1" class="list-group-item collapsed" data-toggle="collapse" data-parent="#sidebar" aria-expanded="false">
                        <i class="fa fa-user fa-fw"></i> <span class="hidden-sm-down">Users</span>
                    </a>
                    <div class="collapse" id="menu1">
                        <a href="{{ route('admin.users.index') }}" class="list-group-item" data-parent="#menu1">All Users</a>
                        <a href="{{ route('admin.users.create') }}" class="list-group-item" data-parent="#menu1">Create User</a>
                    </div>
                    <a href="#menu2" class="list-group-item collapsed" data-toggle="collapse" data-parent="#sidebar" aria-expanded="false">
                        <i class="fa fa-pencil fa-fw"></i> <span class="hidden-sm-down">Posts</span>
                    </a>
                    <div class="collapse" id="menu2">
                        <a href="{{ route('admin.posts.index') }}" class="list-group-item" data-parent="#menu2">All Posts</a>
                        <a href="{{ route('admin.posts.create') }}" class="list-group-item" data-parent="#menu2">Create Post</a>
                        <a href="{{ route('admin.comments.index') }}" class="list-group-item" data-parent="#menu2">All Comments</a>
                    </div>
                    <a href="{{ route('admin.categories.index') }}" class="list-group-item collapsed" data-parent="#sidebar">
                        <i class="fa fa-list"></i> <span class="hidden-sm-down">Categories</span>
                    </a>
                    <a href="#menu3" class="list-group-item collapsed" data-toggle="collapse" data-parent="#sidebar" aria-expanded="false">
                        <i class="fa fa-pencil fa-fw"></i> <span class="hidden-sm-down">Media</span>
                    </a>
                    <div class="collapse" id="menu3">
                        <a href="{{ route('admin.media.index') }}" class="list-group-item" data-parent="#menu3">All Media</a>
                        <a href="{{ route('admin.media.create') }}" class="list-group-item" data-parent="#menu3">Upload Media</a>
                    </div>
                </div>
            </div>
            <div class="col-md-10 col-xs-11 pt-2">
                <a href="#sidebar" data-toggle="collapse"><i class="fa fa-navicon fa-lg"></i></a>
                <hr>
                @yield('content')
            </div>
        </div>
    </div>

<!-- jQuery -->
<script src="{{asset('js/libs.js')}}"></script>


@yield('footer')
@yield('scripts')
</body>
</html>
