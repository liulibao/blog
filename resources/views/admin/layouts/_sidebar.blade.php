<?php
/**
 * Created by PhpStorm.
 * User: hf-li
 * Date: 2018/12/6
 * Time: 22:41
 */
?>

<ul class="sidebar-menu">
    <li class="header">MAIN NAVIGATION</li>

    <li class="treeview ">
        <a href="{{url('/')}}">
            <i class="fa fa-dashboard"></i>
            <span>首页</span>
        </a>
    </li>

    <li class="treeview ">
        <a href="#">
            <i class="fa  fa-users"></i>
            <span>用户管理</span>
            <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
            <li>
                <a href="{{url('user')}}">
                    <i class="fa fa-circle-o"></i> 管理员列表
                </a>
            </li>
            <li>
                <a href="{{url('user/subscriber')}}">
                    <i class="fa fa-circle-o"></i> 用户列表
                </a>
            </li>
        </ul>
    </li>

    <li class="treeview ">
        <a href="#">
            <i class="fa  fa-key"></i>
            <span>权限管理</span>
            <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
            <li>
                <a href="{{url('role')}}">
                    <i class="fa fa-circle-o"></i> 角色管理
                </a>
            </li>
            <li>
                <a href="{{url('menu')}}">
                    <i class="fa fa-circle-o"></i> 目录管理
                </a>
            </li>
        </ul>
    </li>

    <li class="active treeview">
        <a href="#">
            {{--<i class="fa fa-dashboard"></i> <span>文章管理</span>--}}
            <i class="fa fa-book"></i> <span>文章管理</span>
            <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
            <li class="active">
                <a href="{{url('/article')}}">
                    <i class="fa fa-circle-o"></i> 文章列表
                </a>
            </li>
            <li>
                <a href="{{url('/article/category')}}"><i class="fa fa-circle-o"></i> 文章分类</a>
            </li>
        </ul>
    </li>

    <li class="active treeview">
        <a href="#">
            <i class="fa fa-bookmark"></i> <span>日记管理</span>
            <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
            <li>
                <a href="{{url('diary')}}">
                    <i class="fa fa-circle-o"></i> 随心记录
                </a>
            </li>
        </ul>
    </li>

    <li class="treeview ">
        <a href="#">
            <i class="fa fa-send"></i>
            <span>广告管理</span>
            <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
            <li>
                <a href="{{url('advert')}}">
                    <i class="fa fa-circle-o"></i> 幻灯片管理
                </a>
            </li>
        </ul>
    </li>

    <li class="treeview ">
        <a href="#">
            <i class="fa  fa-wrench"></i>
            <span>测试管理</span>
            <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
            <li>
                <a href="{{url('/icons')}}">
                    <i class="fa fa-circle-o"></i> 小图标
                </a>
            </li>
        </ul>
    </li>
</ul>
