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

    {{--<li class="treeview ">--}}
        {{--<a href="{{url('home')}}">--}}
            {{--<i class="fa fa-dashboard"></i>--}}
            {{--<span>首页</span>--}}
        {{--</a>--}}
    {{--</li>--}}

    @if(!empty($userHasMenu))
    @foreach($userHasMenu as $item)
    <li class="treeview {{($item['path'] == $request_prefix)?'active':''}}">
        <a href="{{url($item['path'])}}">
            <i class="fa {{$item['icon']}}"></i>
            <span>{{$item['name']}}</span>
            @if($item['path'] != 'home')
            <i class="fa fa-angle-left pull-right"></i>
            @endif
        </a>
        @if($item['children'])
            <ul class="treeview-menu active">
                @foreach($item['children'] as $val)
                <li>
                    <a href="{{url($val['path'])}}">
                        <i class="fa fa-circle-o"></i> {{$val['name']}}
                    </a>
                </li>
                @endforeach
            </ul>
        @endif
    </li>
    @endforeach
    @endif

    {{--<li class="treeview ">--}}
        {{--<a href="#">--}}
            {{--<i class="fa fa-cogs"></i>--}}
            {{--<span>系统设置</span>--}}
            {{--<i class="fa fa-angle-left pull-right"></i>--}}
        {{--</a>--}}
        {{--<ul class="treeview-menu">--}}
            {{--<li>--}}
                {{--<a href="{{url('system/role')}}">--}}
                    {{--<i class="fa fa-circle-o"></i> 角色管理--}}
                {{--</a>--}}
            {{--</li>--}}
            {{--<li>--}}
                {{--<a href="{{url('system/menu')}}">--}}
                    {{--<i class="fa fa-circle-o"></i> 目录管理--}}
                {{--</a>--}}
            {{--</li>--}}
        {{--</ul>--}}
    {{--</li>--}}

    {{--<li class="active treeview">--}}
        {{--<a href="#">--}}
            {{--<i class="fa fa-dashboard"></i> <span>文章管理</span>--}}
            {{--<i class="fa fa-book"></i> <span>文章管理</span>--}}
            {{--<i class="fa fa-angle-left pull-right"></i>--}}
        {{--</a>--}}
        {{--<ul class="treeview-menu">--}}
            {{--<li class="active">--}}
                {{--<a href="{{url('/article')}}">--}}
                    {{--<i class="fa fa-circle-o"></i> 文章列表--}}
                {{--</a>--}}
            {{--</li>--}}
            {{--<li>--}}
                {{--<a href="{{url('/article/category')}}"><i class="fa fa-circle-o"></i> 文章分类</a>--}}
            {{--</li>--}}
        {{--</ul>--}}
    {{--</li>--}}

    {{--<li class="active treeview">--}}
        {{--<a href="#">--}}
            {{--<i class="fa fa-bookmark"></i> <span>日记管理</span>--}}
            {{--<i class="fa fa-angle-left pull-right"></i>--}}
        {{--</a>--}}
        {{--<ul class="treeview-menu">--}}
            {{--<li>--}}
                {{--<a href="{{url('diary')}}">--}}
                    {{--<i class="fa fa-circle-o"></i> 随心记录--}}
                {{--</a>--}}
            {{--</li>--}}
        {{--</ul>--}}
    {{--</li>--}}

    {{--<li class="treeview ">--}}
        {{--<a href="#">--}}
            {{--<i class="fa fa-send"></i>--}}
            {{--<span>广告管理</span>--}}
            {{--<i class="fa fa-angle-left pull-right"></i>--}}
        {{--</a>--}}
        {{--<ul class="treeview-menu">--}}
            {{--<li>--}}
                {{--<a href="{{url('advert')}}">--}}
                    {{--<i class="fa fa-circle-o"></i> 幻灯片管理--}}
                {{--</a>--}}
            {{--</li>--}}
        {{--</ul>--}}
    {{--</li>--}}

    {{--<li class="treeview ">--}}
        {{--<a href="#">--}}
            {{--<i class="fa  fa-wrench"></i>--}}
            {{--<span>测试管理</span>--}}
            {{--<i class="fa fa-angle-left pull-right"></i>--}}
        {{--</a>--}}
        {{--<ul class="treeview-menu">--}}
            {{--<li>--}}
                {{--<a href="{{url('/icons')}}">--}}
                    {{--<i class="fa fa-circle-o"></i> 小图标--}}
                {{--</a>--}}
            {{--</li>--}}
        {{--</ul>--}}
    {{--</li>--}}
</ul>
