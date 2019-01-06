@extends('admin.layouts.app')

@section('contents')
    <div class="row">
        <div class="col-xs-12">
            <div class="box col-xs-11">
                <div class="box-header" style="padding-left: 0;">
                    <h3 class="box-title">{{isset($page_title) ? $page_title : ''}}</h3>
                    <div  style="text-align: right">
                        <a href="{{url('system/menu/edit')}}" class="btn btn-info"><i class="fa fa-plus"></i> 添加目录</a>
                    </div>
                </div>

                <div class="box-body table-responsive no-padding">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                {{--<th style="width:3%">ID</th>--}}
                                <th >目录名称</th>
                                <th >目录路由</th>
                                <th>ICON</th>
                                <th style="width: 8%">是否显示</th>
                                <th style="width: 5%;">排序</th>
                                <th style="width: 15%;">创建时间</th>
                                <th style="width: 12%">操作</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($lists)
                            @foreach($lists as $key=>$item)
                            <tr>
                                {{--<td class="sorting_1"></td>--}}
                                <td><i class="fa fa-folder-open"></i> {{$item->name}}</td>
                                <td>{{$item->path}}</td>
                                <td><i class="fa {{$item->icon}}"></i> {{$item->icon}}</td>
                                <td>
                                    @if($item->is_show)
                                        <span class="label label-success">显 示</span>
                                    @else
                                        <span class="label label-danger">隐 藏</span>
                                    @endif
                                </td>
                                <td>{{$item->sort}}</td>
                                <td>{{$item->created_at}}</td>
                                <td>
                                    <a href="{{url('system/menu/edit?id='.$item->id)}}" class="btn btn-default btn-sm">
                                        <i class="fa fa-edit"></i> 编辑
                                    </a>

                                    <a href="javascript:void (0);"  class="btn btn-danger btn-sm submitDelete"
                                       data-url="{{url('system/menu/delete')}}" data-id="{{$item->id}}">
                                        <i class="fa  fa-trash"></i> 删除
                                    </a>
                                </td>
                            </tr>
                            @if(is_array($item->children))
                            @foreach($item->children as $val)
                                <tr>
                                    {{--<td >{{$val->id}}</td>--}}
                                    <td><?php echo str_repeat("&nbsp;", 4);?><?php echo str_repeat('<i class="fa fa-angle-right"></i>', 2);?> {{$val->name}}</td>
                                    <td>{{$val->path}}</td>
                                    <td><i class="fa {{$val->icon}}"></i> {{$val->icon}}</td>
                                    <td>
                                        @if($val->is_show)
                                            <span class="label label-success">显 示</span>
                                        @else
                                            <span class="label label-danger">隐 藏</span>
                                        @endif
                                    </td>
                                    <td>{{ $val->sort }}</td>
                                    <td>{{ $val->created_at }}</td>
                                    <td style="width: 150px;">
                                        <a href="{{url('system/menu/edit?id='.$val->id)}}" class="btn btn-default btn-sm">
                                            <i class="fa fa-edit"></i> 编辑
                                        </a>

                                        <a href="javascript:void (0);"  class="btn btn-danger btn-sm submitDelete"
                                           data-url="{{url('system/menu/delete')}}" data-id="{{$val->id}}">
                                            <i class="fa  fa-trash"></i> 删除
                                        </a>
                                    </td>
                                </tr>
                                    @if(is_array($val->children))
                                    @foreach($val->children as $v)
                                        <tr>
                                            {{--<td>{{$v->id}}</td>--}}
                                            <td><?php echo str_repeat("&nbsp;", 8);?><?php echo str_repeat('<i class="fa fa-angle-right"></i>', 2);?> {{$v->name}}</td>
                                            <td>{{$v->path}}</td>
                                            <td><i class="fa {{$v->icon}}"></i> {{$v->icon}}</td>
                                            <td>
                                                @if($v->is_show)
                                                    <span class="label label-success">显 示</span>
                                                @else
                                                    <span class="label label-danger">隐 藏</span>
                                                @endif
                                            </td>
                                            <td>{{ $v->sort }}</td>
                                            <td>{{ $v->created_at }}</td>
                                            <td style="width: 150px;">
                                                <a href="{{url('system/menu/edit?id='.$v->id)}}" class="btn btn-default btn-sm">
                                                    <i class="fa fa-edit"></i> 编辑
                                                </a>

                                                <a href="javascript:void (0);"  class="btn btn-danger btn-sm submitDelete"
                                                   data-url="{{url('system/menu/delete')}}" data-id="{{$v->id}}">
                                                    <i class="fa  fa-trash"></i> 删除
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    @endif
                                @endforeach
                                @endif
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
                <div class="box-footer clearfix">
                    {{--{{ $lists->links() }}--}}
                </div>
            </div>
        </div>
    </div>
@stop
