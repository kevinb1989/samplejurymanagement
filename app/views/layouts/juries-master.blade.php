<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
   "http://www.w3.org/TR/html4/strict.dtd">
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="Mosaddek">
        <meta name="keyword" content="FlatLab, Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

        <link rel="shortcut icon" href="img/favicon.png">

        

        <!-- Latest compiled and minified CSS -->
        {{ HTML::style('css/bootstrap.min.css') }}

        <!-- bootstrap-reset -->
        {{ HTML::style('css/bootstrap-reset.css') }}

        <!-- Optional theme -->
        <!-- {{ HTML::style('css/bootstrap-theme.min.css') }} -->

        <!--external css-->
        {{ HTML::style('assets/font-awesome/css/font-awesome.css') }}

        {{ HTML::style('assets/jquery-easy-pie-chart/jquery.easy-pie-chart.css') }}

        {{ HTML::style('css/owl.carousel.css') }}

        <!-- Custom styles for Flat Lab template -->
        {{ HTML::style('css/style.css') }}

        {{ HTML::style('css/style-responsive.css') }}

        <!-- DataTables css -->
        <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.4/css/jquery.dataTables.min.css">

        <!-- basic image slider -->
        {{ HTML::style('css/bjqs.css') }}

        <!-- loading styles for any ajax request -->
        {{ HTML::style('css/loading-style.css') }}

        @section('pagetitle')
            <title>FlatLab - Flat and Responsive Bootstrap Admin Template</title>
        @show
    </head>
    <body>
        <!--header start-->

  <header class="header white-bg">

    <div class="sidebar-toggle-box">

        <div data-original-title="Toggle Navigation" data-placement="right" class="icon-reorder tooltips"></div>

    </div>

    <!--logo start-->

    <a href="#" class="logo">Jury<span>Management</span></a>

    <!--logo end-->

    <div class="nav notify-row" id="top_menu">

        <!--  notification goes here -->

    </div>

    <div class="top-nav ">

        <!--search & user info goes here-->
        <ul class = "nav pull-right top-menu">
            <li class="drop-down">
                <a class="dropdown-toggle" href="#" data-toggle="dropdown">
                    @if(Auth::check())
                        <span class="username">{{ Auth::user() -> fullname }}</span>
                        |
                        
                    @else
                        {{Redirect::to('login')}}
                    @endif
                    <b class="caret"></b>
                </a>
                <ul class="dropdown-menu extended logout">
                    <span class="username">{{link_to('logout', 'logout')}}</span>
                </ul>
            </li>
        </ul>

    </div>

</header>

<!--header end--> 

<!--sidebar start-->

    <aside>

        <div id="sidebar"  class="nav-collapse ">
             <!-- sidebar menu goes here-->
            <ul id="nav-accordion" class="sidebar-menu"> 
                <li>
                    {{link_to_route('juries.index', 'ALL JURIES')}}
                </li>
                <li>
                    {{link_to_route('juries.create', 'ADD A NEW JURY')}}
                </li>
                <li>
                    {{link_to('app-search', 'SEARCH FOR AN APP')}}
                </li>
                <li>
                    {{link_to('subscribe', 'BECOME A SPONSORED PROFESSIONAL')}}
                </li>
                <li>
                    {{link_to('account-settings', 'ACCOUNT SETTINGS')}}
                </li>
            </ul>
        </div>

    </aside>

<!--sidebar end-->

        <section id="main-content">
            <section class="wrapper">
                @yield('content')
            </section>
        </section>
        @show

        <div class="modal"><!-- This element is to show when ajax request is made with a loading animation --></div>
    </body>
    <!-- js placed at the end of the document so the pages load faster -->
    {{ HTML::script('js/jquery.js') }}

    {{ HTML::script('js/bootstrap.min.js') }}

    {{ HTML::script('js/jquery.dcjqaccordion.2.7.js') }}

    {{ HTML::script('js/jquery.scrollTo.min.js') }}

    {{ HTML::script('js/jquery.nicescroll.js') }}

    {{ HTML::script('js/jquery.sparkline.js') }}

    {{ HTML::script('assets/jquery-easy-pie-chart/jquery.easy-pie-chart.js') }}

    {{ HTML::script('js/owl.carousel.js') }}

    <!--common script for all pages-->
    {{ HTML::script('js/common-scripts.js') }}

    <!--script for this page only-->
    {{ HTML::script('js/sparkline-chart.js') }}

    {{ HTML::script('js/easy-pie-chart.js') }}


    <!-- jQuery validator -->
    <script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.1/jquery.validate.js"></script>

    <!-- DataTables js -->
    <script type="text/javascript" src="//cdn.datatables.net/1.10.4/js/jquery.dataTables.min.js"></script>

    <!-- create RESTful delete link -->
    {{ HTML::script('js/laravel.js') }}

    <!-- create RESTful delete link -->
    {{ HTML::script('js/datatables.jnfilterclear.js') }}



    <!-- create basic image slider -->
    {{ HTML::script('js/bjqs-1.3.js') }}
    
        @section('customscript')
            <script type="text/javascript"></script>
        @show       
        
        {{ HTML::script('js/form-component.js') }}


</html>