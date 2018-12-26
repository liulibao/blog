@extends('admin.layouts.app')

@section('contents')
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">{{isset($page_title) ? $page_title : ''}}</h3>
                </div>

                <form action="{{url('article/category/store')}}" class="form-horizontal" id="postForm">

                    {{ csrf_field() }}

                    <input type="hidden" name="id" value="{{isset($data) ? $data->id : ''}}">

                    <div class="box-body">
                        <div class="form-group">
                            <label for="input_name" class="col-sm-3 control-label"><span>*</span>分类标题 :</label>
                            <div class="col-sm-6" style="padding-left: 0;">
                                <input type="text" name="name" value="{{isset($data) ? $data->name : ''}}" class="form-control" id="input_name" placeholder="请填写分类标题">
                            </div>
                        </div>
                    </div>

                    <div class="box-footer" style="text-align: center">
                        <a href="javascript:void (0);" data-back_url="{{route('admin.article.category')}}" data-is_confirm="false"
                           class="btn btn-info submitFormBtu" >立即提交
                        </a>
                        <a href="javascript:history.go(-1);" class="btn btn-default"> 返回</a>
                    </div>

                </form>
            </div>
        </div>
    </div>
@stop
