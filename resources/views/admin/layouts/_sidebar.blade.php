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

    @if(!empty($userHasMenu))
    @foreach($userHasMenu as $item)
    <li class="treeview {{($item['path'] == $request_prefix) ? 'active' : ''}}">
        <a href="{{url($item['path'])}}">
            <i class="fa {{$item['icon']}}"></i>
            <span>{{$item['name']}}</span>
            @if($item['path'] != 'home')
            <i class="fa fa-angle-left pull-right"></i>
            @endif
        </a>
        @if($item['children'])
            <ul class="treeview-menu">
                @foreach($item['children'] as $val)
                <li class="{{($val['path'] == getCurrentUrl()) ? 'active' : ''}}">
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
</ul>
