@extends('admin.layouts.app')

@section('contents')
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">{{isset($page_title) ? $page_title : ''}}</h3>
                </div>

                <form action="{{url('system/role/store')}}" class="form-horizontal" id="postForm">

                    {{ csrf_field() }}

                    <input type="hidden" name="id" value="{{isset($data) ? $data->id : ''}}">

                    <div class="box-body">
                        <div class="form-group">
                            <label for="input_name" class="col-sm-3 control-label"><span>*</span>角色名称 :</label>
                            <div class="col-sm-5 no-padding">
                                <input type="text" name="name" value="{{isset($data) ? $data->name : ''}}" class="form-control" id="input_name" placeholder="请填写分类标题">
                            </div>
                        </div>
                    </div>

                    <div class="box-body">
                        <div class="form-group">
                            <label for="input_name" class="col-sm-3 control-label"><span>*</span>排序 :</label>
                            <div class="col-sm-3 no-padding">
                                <input type="text" name="sort" class="form-control" style="width:80%;" id="input_sort" autocomplete="off"
                                       value="{{isset($data) ? $data->sort : ''}}" placeholder="填写序号越小越靠前1-最靠前">
                            </div>
                        </div>
                    </div>

                    <div class="box-body">
                        <div class="form-group">
                            <label for="input_name" class="col-sm-3 control-label">备注 :</label>
                            <div class="col-sm-5 no-padding">
                                <textarea name="remarks" class="form-control" id="" cols="30" rows="2"  placeholder="请填写分类标题" title="">{{isset($data) ? $data->remarks : ''}}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="box-footer" style="padding-right: 60%">
                        <a href="javascript:void (0);" data-back_url="{{route('admin.role')}}" data-is_confirm="false"
                           class="btn btn-info submitFormBtu" >立即提交
                        </a>
                        <a href="javascript:history.go(-1);" class="btn btn-default"> 返回</a>
                    </div>

                </form>
            </div>
        </div>
    </div>
@stop
