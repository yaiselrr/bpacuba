<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{config('app.name')}}</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/bower_components/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="/bower_components/Ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="/bower_components/admin-lte/dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="/bower_components/admin-lte/dist/css/skins/skin-purple.min.css">
    <link rel="stylesheet" href="{{asset('css/admin.css')}}">
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- Google Font -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to get the
desired effect
|---------------------------------------------------------|
| SKINS         | skin-blue                               |
|               | skin-black                              |
|               | skin-purple                             |
|               | skin-yellow                             |
|               | skin-red                                |
|               | skin-green                              |
|---------------------------------------------------------|
|LAYOUT OPTIONS | fixed                                   |
|               | layout-boxed                            |
|               | layout-top-nav                          |
|               | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->
<body class="hold-transition skin-purple sidebar-mini">
<div class="wrapper">

    <!-- Main Header -->
    <header class="main-header">

        <!-- Logo -->
        <a href="{{route('admin.index')}}" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>{{config('app.name')}}</b></span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg">{{config('app.name')}}</span>
        </a>

        <!-- Header Navbar -->
        <nav class="navbar navbar-static-top" role="navigation">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>
            <!-- Navbar Right Menu -->
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <li class="dropdown user user-menu">

                        <!-- Menu Toggle Button -->
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <!-- The user image in the navbar-->
                            <img src="
                            @if(Auth::user()->avatar)
                            {{asset('/storage/'.Auth::user()->avatar)}}
                            @else
                            {{asset('/files/defaultuser.png')}}
                            @endif
                            " class="user-image" alt="User Image">
                            <!-- hidden-xs hides the username on small devices so only the image appears. -->
                            <span class="hidden-xs">{{ Auth::user()->name }}</span>
                        </a>
                        <ul class="dropdown-menu" style="width:inherit!important;">
                            <li>
                                <div>
                                    <a style="width:100%" class="btn btn-default btn-flat" href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    @include('admin.sidebar')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                @yield('header')
            </h1>
        </section>

        <!-- Main content -->
        <section class="content container-fluid">
            <!--------------------------
              | Your Page Content Here |
              -------------------------->
             @include('admin.session')
             @yield('content')
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Main Footer -->
    <footer class="main-footer">
        <!-- To the right -->
        <!-- Default to the left -->
        <strong>Copyright &copy; 2019 <a href="{{route('admin.index')}}">{{config('app.name')}}</a>.</strong> Todos los derechos reservados.
    </footer>
    <div class="control-sidebar-bg"></div>
</div>

<script src="/bower_components/jquery/dist/jquery.min.js"></script>
<script src="{{ asset('js/jquery.validate.js') }}" defer></script>
<script src="{{ asset('js/additional-methods.js') }}" defer></script>
<script src="{{ asset('js/messages_es.js') }}" defer></script>
<script src="/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="/bower_components/admin-lte/dist/js/adminlte.min.js"></script>
<script src="/bower_components/ckeditor/ckeditor.js"></script>
<script>
    $(function () {
        $('input[type=file]').on('change', function () {
            element = $(this);
            var files = this.files;
            var _URL = window.URL || window.webkitURL;
            var image, file;
            image = new Image();
            image.src = _URL.createObjectURL(files[0]);
            image.onload = function () {
                element.attr('uploadWidth', this.width);
                element.attr('uploadHeigth', this.height);
            }
        });
        // Replace the <textarea id="editor1"> with a CKEditor
        // instance, using default configuration.
        CKEDITOR.replace('editor', {
            // Define the toolbar groups as it is a more accessible solution.
            language: 'es',
            toolbarGroups: [
                {
                    "name": 'basicstyles',
                    "groups": [ 'basicstyles']
                },
                {
                    "name": "paragraph",
                    "groups": ["list", 'align']
                },
                {
                    "name": "document",
                    "groups": ["mode"]
                },
                {
                    "name": "styles",
                    "groups": ["styles"]
                }
            ],
            // Remove the redundant buttons from toolbar groups defined above.
            removeButtons: 'Strike,Subscript,Superscript,Anchor,Styles,Specialchar'
        });
        CKEDITOR.replace('editor1', {
            // Define the toolbar groups as it is a more accessible solution.
            language: 'es',
            toolbarGroups: [
                {
                    "name": 'basicstyles',
                    "groups": [ 'basicstyles']
                },
                {
                    "name": "paragraph",
                    "groups": ["list", 'align']
                },
                {
                    "name": "document",
                    "groups": ["mode"]
                },
                {
                    "name": "styles",
                    "groups": ["styles"]
                }
            ],
            // Remove the redundant buttons from toolbar groups defined above.
            removeButtons: 'Strike,Subscript,Superscript,Anchor,Styles,Specialchar'
        });
        CKEDITOR.replace('editor2', {
            // Define the toolbar groups as it is a more accessible solution.
            language: 'es',
            toolbarGroups: [
                {
                    "name": 'basicstyles',
                    "groups": [ 'basicstyles']
                },
                {
                    "name": "paragraph",
                    "groups": ["list", 'align']
                },
                {
                    "name": "document",
                    "groups": ["mode"]
                },
                {
                    "name": "styles",
                    "groups": ["styles"]
                }
            ],
            // Remove the redundant buttons from toolbar groups defined above.
            removeButtons: 'Strike,Subscript,Superscript,Anchor,Styles,Specialchar'
        });
    })
</script>
<script>
    // for sidebar menu entirely but not cover treeview
    $('ul.sidebar-menu a').filter(function() {
        return $(this).hasClass('active');
    }).parent().addClass('active');

    // for treeview
    $('ul.treeview-menu a').filter(function() {
        return $(this).hasClass('active');
    }).parentsUntil(".sidebar-menu > .treeview-menu").addClass('active');
</script>
<script>
    $('#modal-delete').on('show.bs.modal', function(e){
        var button = $(e.relatedTarget)
        var route = button.data('route')
        console.log('Opned Delete', route)

        var modal =$(this)
        modal.find('.modal-content #form_delete').attr('action',route);
    })
</script>
@yield('jscript')
</body>
</html>