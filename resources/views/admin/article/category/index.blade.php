@extends('admin.layouts.app')

@section('contents')
    <div class="row">
        <div class="col-xs-12">
            <div class="box col-xs-11">
                <div class="box-header" style="padding-left: 0;">
                    <h3 class="box-title">{{isset($page_title) ? $page_title : ''}}</h3>
                    <div  style="text-align: right">
                        <a href="{{url('article/category/edit')}}" class="btn btn-info"><i class="fa fa-plus"></i> 添加分类</a>
                    </div>
                </div>

                <div class="box-body table-responsive no-padding">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th style="width:3%">ID</th>
                                <th >分类名称</th>
                                <th style="width: 15%;">创建时间</th>
                                <th style="width: 12%">操作</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($lists as $item)
                            <tr>
                                <td class="sorting_1">{{$item->id}}</td>
                                <td>{{$item->name}}</td>
                                <td>{{$item->created_at}}</td>
                                <td>
                                    <a href="{{url('article/category/edit?id='.$item->id)}}" class="btn btn-default btn-sm">
                                        <i class="fa fa-edit"></i> 编辑
                                    </a>

                                    <a href="javascript:void (0);"  class="btn btn-danger btn-sm submitDelete"
                                       data-url="{{url('article/category/delete')}}" data-id="{{$item->id}}">
                                        <i class="fa  fa-trash"></i> 删除
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="box-footer clearfix">
                    {{ $lists->links() }}
                </div>
            </div>
        </div>
    </div>
@stop
