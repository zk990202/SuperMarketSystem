<html style="height: auto;"><head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>超市进销存系统</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="./../AdminLTE-2.3.11/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="./../AdminLTE-2.3.11/dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="./../AdminLTE-2.3.11/dist/css/skins/_all-skins.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
<body class="skin-blue layout-top-nav" style="height: auto;">
<div class="wrapper" style="height: auto;">

    <header class="main-header">
        <nav class="navbar navbar-static-top">
            <div class="container">
                <div class="navbar-header">
                    <a href="./../AdminLTE-2.3.11/index2.html" class="navbar-brand"><b>超市进销存</b>系统</a>
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                        <i class="fa fa-bars"></i>
                    </button>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                {{--<div class="collapse navbar-collapse pull-left" id="navbar-collapse">--}}
                    {{--<ul class="nav navbar-nav">--}}
                        {{--<li class="active"><a href="#">Link <span class="sr-only">(current)</span></a></li>--}}
                        {{--<li><a href="#">Link</a></li>--}}
                        {{--<li class="dropdown">--}}
                            {{--<a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <span class="caret"></span></a>--}}
                            {{--<ul class="dropdown-menu" role="menu">--}}
                                {{--<li><a href="#">Action</a></li>--}}
                                {{--<li><a href="#">Another action</a></li>--}}
                                {{--<li><a href="#">Something else here</a></li>--}}
                                {{--<li class="divider"></li>--}}
                                {{--<li><a href="#">Separated link</a></li>--}}
                                {{--<li class="divider"></li>--}}
                                {{--<li><a href="#">One more separated link</a></li>--}}
                            {{--</ul>--}}
                        {{--</li>--}}
                    {{--</ul>--}}
                    {{--<form class="navbar-form navbar-left" role="search">--}}
                        {{--<div class="form-group">--}}
                            {{--<input type="text" class="form-control" id="navbar-search-input" placeholder="Search">--}}
                        {{--</div>--}}
                    {{--</form>--}}
                {{--</div>--}}
                <!-- /.navbar-collapse -->
                <!-- Navbar Right Menu -->
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <!-- Messages: style can be found in dropdown.less-->
                        {{--<li class="dropdown messages-menu">--}}
                            {{--<!-- Menu toggle button -->--}}
                            {{--<a href="#" class="dropdown-toggle" data-toggle="dropdown">--}}
                                {{--<i class="fa fa-envelope-o"></i>--}}
                                {{--<span class="label label-success">4</span>--}}
                            {{--</a>--}}
                            {{--<ul class="dropdown-menu">--}}
                                {{--<li class="header">You have 4 messages</li>--}}
                                {{--<li>--}}
                                    {{--<!-- inner menu: contains the messages -->--}}
                                    {{--<div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 200px;"><ul class="menu" style="overflow: hidden; width: 100%; height: 200px;">--}}
                                            {{--<li><!-- start message -->--}}
                                                {{--<a href="#">--}}
                                                    {{--<div class="pull-left">--}}
                                                        {{--<!-- User Image -->--}}
                                                        {{--<img src="./../AdminLTE-2.3.11/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">--}}
                                                    {{--</div>--}}
                                                    {{--<!-- Message title and timestamp -->--}}
                                                    {{--<h4>--}}
                                                        {{--Support Team--}}
                                                        {{--<small><i class="fa fa-clock-o"></i> 5 mins</small>--}}
                                                    {{--</h4>--}}
                                                    {{--<!-- The message -->--}}
                                                    {{--<p>Why not buy a new awesome theme?</p>--}}
                                                {{--</a>--}}
                                            {{--</li>--}}
                                            {{--<!-- end message -->--}}
                                        {{--</ul><div class="slimScrollBar" style="background: rgb(0, 0, 0); width: 3px; position: absolute; top: 0px; opacity: 0.4; display: block; border-radius: 7px; z-index: 99; right: 1px;"></div><div class="slimScrollRail" style="width: 3px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(51, 51, 51); opacity: 0.2; z-index: 90; right: 1px;"></div></div>--}}
                                    {{--<!-- /.menu -->--}}
                                {{--</li>--}}
                                {{--<li class="footer"><a href="#">See All Messages</a></li>--}}
                            {{--</ul>--}}
                        {{--</li>--}}
                        {{--<!-- /.messages-menu -->--}}

                        {{--<!-- Notifications Menu -->--}}
                        {{--<li class="dropdown notifications-menu">--}}
                            {{--<!-- Menu toggle button -->--}}
                            {{--<a href="#" class="dropdown-toggle" data-toggle="dropdown">--}}
                                {{--<i class="fa fa-bell-o"></i>--}}
                                {{--<span class="label label-warning">10</span>--}}
                            {{--</a>--}}
                            {{--<ul class="dropdown-menu">--}}
                                {{--<li class="header">You have 10 notifications</li>--}}
                                {{--<li>--}}
                                    {{--<!-- Inner Menu: contains the notifications -->--}}
                                    {{--<div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 200px;"><ul class="menu" style="overflow: hidden; width: 100%; height: 200px;">--}}
                                            {{--<li><!-- start notification -->--}}
                                                {{--<a href="#">--}}
                                                    {{--<i class="fa fa-users text-aqua"></i> 5 new members joined today--}}
                                                {{--</a>--}}
                                            {{--</li>--}}
                                            {{--<!-- end notification -->--}}
                                        {{--</ul><div class="slimScrollBar" style="background: rgb(0, 0, 0); width: 3px; position: absolute; top: 0px; opacity: 0.4; display: block; border-radius: 7px; z-index: 99; right: 1px;"></div><div class="slimScrollRail" style="width: 3px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(51, 51, 51); opacity: 0.2; z-index: 90; right: 1px;"></div></div>--}}
                                {{--</li>--}}
                                {{--<li class="footer"><a href="#">View all</a></li>--}}
                            {{--</ul>--}}
                        {{--</li>--}}
                        {{--<!-- Tasks Menu -->--}}
                        {{--<li class="dropdown tasks-menu">--}}
                            {{--<!-- Menu Toggle Button -->--}}
                            {{--<a href="#" class="dropdown-toggle" data-toggle="dropdown">--}}
                                {{--<i class="fa fa-flag-o"></i>--}}
                                {{--<span class="label label-danger">9</span>--}}
                            {{--</a>--}}
                            {{--<ul class="dropdown-menu">--}}
                                {{--<li class="header">You have 9 tasks</li>--}}
                                {{--<li>--}}
                                    {{--<!-- Inner menu: contains the tasks -->--}}
                                    {{--<div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 200px;"><ul class="menu" style="overflow: hidden; width: 100%; height: 200px;">--}}
                                            {{--<li><!-- Task item -->--}}
                                                {{--<a href="#">--}}
                                                    {{--<!-- Task title and progress text -->--}}
                                                    {{--<h3>--}}
                                                        {{--Design some buttons--}}
                                                        {{--<small class="pull-right">20%</small>--}}
                                                    {{--</h3>--}}
                                                    {{--<!-- The progress bar -->--}}
                                                    {{--<div class="progress xs">--}}
                                                        {{--<!-- Change the css width attribute to simulate progress -->--}}
                                                        {{--<div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">--}}
                                                            {{--<span class="sr-only">20% Complete</span>--}}
                                                        {{--</div>--}}
                                                    {{--</div>--}}
                                                {{--</a>--}}
                                            {{--</li>--}}
                                            {{--<!-- end task item -->--}}
                                        {{--</ul><div class="slimScrollBar" style="background: rgb(0, 0, 0); width: 3px; position: absolute; top: 0px; opacity: 0.4; display: block; border-radius: 7px; z-index: 99; right: 1px;"></div><div class="slimScrollRail" style="width: 3px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(51, 51, 51); opacity: 0.2; z-index: 90; right: 1px;"></div></div>--}}
                                {{--</li>--}}
                                {{--<li class="footer">--}}
                                    {{--<a href="#">View all tasks</a>--}}
                                {{--</li>--}}
                            {{--</ul>--}}
                        {{--</li>--}}
                        <!-- User Account Menu -->
                        <li class="dropdown user user-menu">
                            <!-- Menu Toggle Button -->
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <!-- The user image in the navbar-->
                                <span class="hidden-xs"> {{ $user->name }} </span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- The user image in the menu -->
                                <li class="user-header">
                                    <p>
                                        {{ $user->name }} -
                                        @if($user->role == '1')
                                            管理员
                                        @elseif($user->role == '2')
                                            管理部门
                                        @elseif($user->role == '3')
                                            采购部门
                                        @elseif($user->role == '4')
                                            顾客
                                        @endif
                                    </p>
                                </li>
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-right">
                                        <a href="{{ route('logout') }}" class="btn btn-default btn-flat"
                                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"  >登出</a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <!-- /.navbar-custom-menu -->
            </div>
            <!-- /.container-fluid -->
        </nav>
    </header>
    <!-- Full Width Column -->
    <div class="content-wrapper" style="min-height: 633px;">
        <div class="container">
            <!-- Content Header (Page header) -->
            {{--<section class="content-header">--}}
                {{--<h1>--}}
                    {{--Top Navigation--}}
                    {{--<small>Example 2.0</small>--}}
                {{--</h1>--}}
                {{--<ol class="breadcrumb">--}}
                    {{--<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>--}}
                    {{--<li><a href="#">Layout</a></li>--}}
                    {{--<li class="active">Top Navigation</li>--}}
                {{--</ol>--}}
            {{--</section>--}}

            <!-- Main content -->
            <main class="py-4">
                @yield('content')
            </main>

        </div>
        <!-- /.container -->
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
        <div class="container">
            <div class="pull-right hidden-xs">
                <b>Version</b> 1.0.0
            </div>
            <strong>Copyright © 2018 <a target="_Blank" href="http://www.kaisir.top">Kaisir's Web</a>.</strong> All rights
            reserved.
        </div>
        <!-- /.container -->
    </footer>
</div>
<!-- ./wrapper -->

<!-- jQuery 2.2.3 -->
<script src="./../AdminLTE-2.3.11/plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="./../AdminLTE-2.3.11/bootstrap/js/bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="./../AdminLTE-2.3.11/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="./../AdminLTE-2.3.11/plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="./../AdminLTE-2.3.11/dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="./../AdminLTE-2.3.11/dist/js/demo.js"></script>


</body></html>