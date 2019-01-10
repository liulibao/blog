@extends('admin.layouts.app')

@section('contents')
    <div class="row">
        <div class="col-xs-12">
            <div class="box col-xs-11">
                <div class="box-header" style="padding-left: 0;">
                    <h3 class="box-title">{{isset($page_title) ? $page_title : ''}}</h3>
                    <form action="{{url('user/subscriber')}}" id="searchForm" method="get" class="search-form">
                        <div class="col-sm-3 search-box">
                            <label for="input_name" >用户名</label>
                            <input type="text"  style="width: 60%" class="form-control" name="name"
                                   value="{{(null !== request('name')) ? request('name') : ''}}"  title="请填写用户名">
                        </div>

                        <div class="search-btu-box" >
                            <a href="javascript:void (0);" class="btn btn-info searchBtn"><i class="fa fa-search"></i> 搜 索 </a>
                            {{--<a href="{{url('user/edit')}}" class="btn btn-info"><i class="fa fa-plus"></i> 添加管理员</a>--}}
                        </div>
                    </form>
                </div>

                <div class="box-body table-responsive no-padding">
                    <table class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th >ID</th>
                            <th >用户名</th>
                            <th >手机号</th>
                            <th >登陆IP</th>
                            <th >最新登陆时间</th>
                            <th >状态</th>
                            <th >创建时间</th>
                            <th style="width: 12%;">操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($lists as $item)
                            <tr role="row" class="odd">
                                <td class="sorting_1">{{$item->id}}</td>
                                <td>{{$item->name}}</td>
                                <td>{{$item->mobile}}</td>
                                <td>{{$item->login_ip}}</td>
                                <td>{{$item->login_at}}</td>
                                <td>
                                    @if($item->deleted_at > 0)
                                        <span class="label label-danger">已删除</span>
                                    @else
                                        <span class="label label-success">正 常</span>
                                    @endif
                                </td>
                                <td>{{$item->created_at}}</td>
                                <td>
                                    <a href="{{url('user/edit?id='.$item->id)}}"  class="btn btn-default btn-sm">
                                        <i class="fa fa-edit"></i> 编辑
                                    </a>

                                    <a href="javascript:void (0);"  class="btn btn-danger btn-sm submitDelete"
                                       data-url="{{url('user/delete')}}" data-id="{{$item->id}}">
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

@section('script')
    <script src="{{asset('admin/js/form.js')}}"></script>
@stop