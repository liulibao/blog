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
                    <h3 class="box-title">文章列表</h3>
                    <div class="box-tools">
                        <div class="input-group">
                            <input type="text" name="table_search" class="form-control input-sm pull-right" style="width: 150px;" placeholder="Search">
                            <div class="input-group-btn">
                                <button class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </div>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th >ID</th>
                                <th >标题</th>
                                <th >关键字</th>
                                <th >是否推荐</th>
                                <th >状态</th>
                                <th >创建时间</th>
                                <th>操作</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr role="row" class="odd">
                                <td class="sorting_1">Gecko</td>
                                <td>Firefox 1.0</td>
                                <td>Firefox 1.0</td>
                                <td>Firefox 1.0</td>
                                <td>Firefox 1.0</td>
                                <td><span class="label label-success  label-warning  label-primary label-danger">Approved</span></td>
                                <td>
                                    <a class="btn btn-default btn-sm"><i class="fa fa-edit"></i> 编辑</a>
                                </td>
                            </tr>
                            <tr role="row" class="even">
                                <td class="sorting_1">Gecko</td>
                                <td>Firefox 1.5</td>
                                <td>Firefox 1.5</td>
                                <td>Firefox 1.5</td>
                                <td>Firefox 1.5</td>
                                <td><span class="label  label-warning  label-primary label-danger">Approved</span></td>
                                <td>
                                    <a class="btn btn-default btn-sm"><i class="fa fa-edit"></i> 编辑</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="box-footer clearfix">
                    <ul class="pagination pagination-sm no-margin pull-right">
                        <li><a href="#">«</a></li>
                        <li><a href="#">1</a></li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#">»</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@stop