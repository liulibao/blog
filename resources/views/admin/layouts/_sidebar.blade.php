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
    <li class="active treeview">
        <a href="#">
            <i class="fa fa-dashboard"></i> <span>文章管理</span>
            <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
            <li class="active">
                <a href="{{url('/article')}}">
                    <i class="fa fa-circle-o {{--text-red text-yellow text-aqua--}}"></i> 文章列表
                </a>
            </li>
            <li>
                <a href="{{url('/article/category')}}"><i class="fa fa-circle-o"></i> 文章分类</a>
            </li>
        </ul>
    </li>
    <li><a href="{{url('/icons')}}"><i class="fa fa-book"></i> <span>icon</span></a></li>
</ul>
