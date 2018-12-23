@extends('admin.layouts.app')

@section('title')
@parent
    文章详情
@stop

@section('contents')
    <div class="row">
        <div class="col-xs-12">
            <div class="box col-xs-11">

                <div class="box-header" style="padding-left: 0;">
                    <h3 class="box-title">{{isset($page_title) ? $page_title : ''}}</h3>
                    <div  style="text-align: right">
                        <a href="{{url('article/edit')}}" class="btn btn-info"><i class="fa fa-plus"></i> 添加文章</a>
                    </div>
                </div>

                <div class="box-body table-responsive no-padding">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th >ID</th>
                                <th >文章标题</th>
                                <th >阅读数</th>
                                <th >点赞数</th>
                                <th >评论数</th>
                                <th >文章归属</th>
                                <th >文章分类</th>
                                <th >是否评论</th>
                                <th >是否推荐</th>
                                <th >状态</th>
                                <th >创建时间</th>
                                <th>操作</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($lists as $item)
                            <tr role="row" class="odd">
                                <td class="sorting_1">{{$item->id}}</td>
                                <td>{{$item->title}}</td>
                                <td>{{$item->read_num}}</td>
                                <td>{{$item->like_num}}</td>
                                <td>{{$item->comment_num}}</td>
                                <td>{{$tags[$item->tag_id]}}</td>
                                <td>{{$category[$item->category_id]}}</td>
                                <td>{{$item->is_comment ? '是' : '否'}}</td>
                                <td>{{$item->is_recommend ? '是' : '否'}}</td>
                                <td>
                                    @if($item->deleted_at > 0)
                                        <span class="label label-danger">已删除</span>
                                    @else
                                        <span class="label label-success">正常</span>
                                    @endif
                                </td>
                                <td>{{$item->created_at}}</td>
                                <td>
                                    <a class="btn btn-default btn-sm"><i class="fa fa-edit"></i> 编辑</a>
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