@extends('admin.layouts.app')

@section('style')
    {{--<link href="https://cdn.bootcss.com/jquery-confirm/3.2.3/jquery-confirm.min.css" rel="stylesheet">--}}
@stop

@section('contents')

<div class="row">
    <div class="col-xs-12">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">{{isset($page_title) ? $page_title : ''}}</h3>
            </div>

            <form action="{{url('article/category/store')}}" class="form-horizontal" id="postForm">
                <div class="box-body">
                    <div class="form-group">
                        <label for="input_name" class="col-sm-3 control-label">分类标题 :</label>
                        <div class="col-sm-6" style="padding-left: 0;">
                            <input type="text" name="name" class="form-control" id="input_name" placeholder="请填写分类标题">
                        </div>
                    </div>
                </div>

                <div class="box-footer" style="text-align: center">
                    <a href="javascript:void (0);" class="btn btn-info submitFormBtu" >立即提交</a>
                    <a href="javascript:history.go(-1);" class="btn btn-default"> 返回</a>
                </div>

            </form>
        </div>
    </div>
</div>

@stop

@section('script')
    <script src="{{asset('layui/layui.all.js')}}"></script>
    <script src="{{asset('js/admin/form.js')}}"></script>
    <script>
        //Demo
        layui.use('form', function(){
            var form = layui.form;
            //监听提交
            form.on('submit(formDemo)', function(data){
                layer.msg(JSON.stringify(data.field));
                return false;
            });
        });
    </script>

@stop