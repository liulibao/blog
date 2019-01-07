<?php
/**
 * Created by PhpStorm.
 * User: hf-li
 * Date: 2018/12/6
 * Time: 21:59
 */
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'lovya@管理后台')</title>
    <meta name="description" content="@yield('description','个人博客')">
    <meta name="keywords" content="@yield('keywords','学习框架,laravel,php,java')">
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <meta http-equiv="content-type" content="text/html; charset=gb2312">
    <meta http-equiv="content-language" content="zh-cn">
    <!-- Bootstrap 3.3.4 -->
    <link href="{{asset('adminLET/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- FontAwesome 4.3.0 -->
    <link href="{{asset('adminLET/dist/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- Ionicons 2.0.0 -->
    <link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="{{asset('adminLET/dist/css/AdminLTE.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('adminLET/dist/css/skins/_all-skins.min.css')}}" rel="stylesheet" type="text/css" />
    <!--自定义表单样式-->
    <link href="{{asset('css/form.css')}}" rel="stylesheet" type="text/css" />

    <style>
        body {
            font-family: 微軟正黑體, Helvetica, Arial, Verdana, sans-serif !important;
        }
        .box-footer {
            text-align: right;
        }
        .box-footer ul{
            margin: 0;
            border-radius: 4px;
        }
        .form-group label span{
            color: red;
            font-size: 15px;
        }
        .form-group .no-padding span:last-child{
            font-size: 12px;
            color: red;
        }
        .search-form{
             margin-top: 10px;
        }
        .search-box label{
            float: left;
            line-height: 35px;
            margin-right: 10px;
        }
        .search-btu-box{
            text-align: right
        }
        .table>tbody>tr>td{
            padding: 4px;
        }
    </style>

    @yield('style')

</head>
<body class="skin-purple sidebar-mini">
<div class="wrapper">

    <header class="main-header">
        <!-- Logo -->
        <a href="javascript:void(0)" style="background: no-repeat;" class="logo">
            <span class="logo-mini">Lovya</span>
            <span class="logo-lg"><b>Lovya</b>后台管理</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" style="background: no-repeat;" role="navigation">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <!-- User Account: style can be found in dropdown.less -->
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle"  data-toggle="dropdown">
                            <img src="{{asset('adminLET/dist/img/user2-160x160.jpg')}}" class="user-image" alt="User Image"/>
                            <span class="hidden-xs">Alexander Pierce</span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- User image -->
                            <li class="user-header" style="background: #222d32;">
                                <img src="{{asset('adminLET/dist/img/user2-160x160.jpg')}}" class="img-circle" alt="User Image" />
                                <p>
                                    Alexander Pierce - Web Developer
                                    <small>Member since Nov. 2012</small>
                                </p>
                            </li>
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="#" class="btn btn-default btn-flat">Profile</a>
                                </div>
                                <div class="pull-right">
                                    <a href="#" class="btn btn-default btn-flat">Sign out</a>
                                </div>
                            </li>
                        </ul>
                    </li>

                </ul>
            </div>
        </nav>
    </header>

    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
        <section class="sidebar">
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="{{asset('adminLET/dist/img/user2-160x160.jpg')}}" class="img-circle" alt="User Image" />
                </div>
                <div class="pull-left info">
                    <p>Alexander Pierce</p>
                    <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                </div>
            </div>

            @include('admin.layouts._sidebar')
        </section>
    </aside>


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                首页
                <small>首页列表</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Dashboard</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content body">
            @yield('contents')
        </section>
    </div>

    @include('admin.layouts._footer')
</div>



<!-- AdminLTE App -->
<script src="{{asset('adminLET/plugins/jQuery/jQuery-2.1.4.min.js')}}"></script>
<script src="{{asset('adminLET/bootstrap/js/bootstrap.min.js')}}" type="text/javascript"></script>
<script src="{{asset('adminLET/dist/js/app.min.js')}}" type="text/javascript"></script>
<script src="{{asset('layui/layui.all.js')}}"></script>
<script src="{{asset('js/admin/form.js')}}"></script>
@yield('script')
</body>
</html>
