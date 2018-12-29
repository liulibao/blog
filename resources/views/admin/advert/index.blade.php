@extends('admin.layouts.app')

@section('contents')
    <div class="row">
        <div class="col-xs-12">
            <div class="box col-xs-11">
                <div class="box-header" style="padding-left: 0;">
                    <h3 class="box-title">{{isset($page_title) ? $page_title : ''}}</h3>
                    <form action="{{url('diary')}}" id="searchForm" method="get" class="search-form">
                        <div class="col-sm-3 search-box">
                            <label for="input_name" >广告标题</label>
                            <input type="text"  style="width: 60%" class="form-control" name="title"
                                   value="{{(null !== request('title')) ? request('title') : ''}}"  title="请填写标题">
                        </div>

                        <div class="col-sm-3 search-box">
                            <label for="input_name" >广告分类</label>
                            <select name="type_id" id="select_type" style="width: 60%" class="form-control" title="请选择广告分类">
                                <option value="0">请选择广告分类</option>
                                @foreach($types as $key=>$val)
                                    <option value="{{$key}}">{{$val}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="search-btu-box" >
                            <a href="javascript:void (0);" class="btn btn-info searchBtn"><i class="fa fa-search"></i> 搜 索 </a>
                            <a href="{{url('advert/edit')}}" class="btn btn-info"><i class="fa fa-plus"></i> 添加广告</a>
                        </div>
                    </form>
                </div>

                <div class="box-body table-responsive no-padding">
                    <table class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th >ID</th>
                            <th style="width: 70%">广告标题</th>
                            <th >状态</th>
                            <th >创建时间</th>
                            <th style="width: 12%;">操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($lists)
                        @foreach($lists as $item)
                            <tr role="row" class="odd">
                                <td class="sorting_1">{{$item->id}}</td>
                                <td>{{$item->title}}</td>
                                <td>
                                    @if($item->deleted_at > 0)
                                        <span class="label label-danger">已删除</span>
                                    @else
                                        <span class="label label-success">正常</span>
                                    @endif
                                </td>
                                <td>{{$item->created_at}}</td>
                                <td>
                                    <a href="{{url('diary/edit?id='.$item->id)}}"  class="btn btn-default btn-sm">
                                        <i class="fa fa-edit"></i> 编辑
                                    </a>

                                    <a href="javascript:void (0);"  class="btn btn-danger btn-sm submitDelete"
                                       data-url="{{url('diary/delete')}}" data-id="{{$item->id}}">
                                        <i class="fa  fa-trash"></i> 删除
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        @endif
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