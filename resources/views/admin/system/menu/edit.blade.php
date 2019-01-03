@extends('admin.layouts.app')

@section('style')
    <link href="{{asset('adminLET/select2/dist/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
    <style>
        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
        }
        .f_select {
            list-style:none;
            width: 50%;
            max-height: 100px;
            overflow: auto;
            border:1px solid #d2d6de;
            display:none;
        }
        li a {
            display:inline-block;
            width:100%;
            height:100%;
            line-height: 30px;
            text-decoration:none;
            color:#555;
            padding-left: 10px;
        }
        li a:hover{
            background-color:#00c0ef;
            line-height: 25px;
            color: #fff;
        }
    </style>
@stop

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

                    <div class="form-group">
                        <label for="input_category" class="col-sm-3 control-label"><span>*</span>上一级目录 :</label>
                        <div class="col-sm-5 no-padding">
                            <select  class="form-control" style="width: 50%" name="category_id" title="input_category">
                                <option value="0">请选择目录</option>
                                <option selected="selected">Alabama</option>
                                {{--@foreach($category as $item)--}}
                                    {{--<option @if(isset($lists) && $lists->category_id == $item->id) {{"selected='selected'"}} @endif value="{{$item->id}}">{{$item->name}}</option>--}}
                                {{--@endforeach--}}
                            </select>
                        </div>
                    </div>

                    <div class="box-body">
                        <div class="form-group">
                            <label for="input_name" class="col-sm-3 control-label"><span>*</span>目录名称 :</label>
                            <div class="col-sm-5 no-padding">
                                <input type="text" name="name" value="{{isset($data) ? $data->name : ''}}" class="form-control" id="input_name" placeholder="请填写分类标题">
                            </div>
                        </div>
                    </div>

                    <div class="box-body">
                        <div class="form-group">
                            <label for="input_name" class="col-sm-3 control-label"><span>*</span>目录路由 :</label>
                            <div class="col-sm-5 no-padding">
                                <input type="text" name="path" value="{{isset($data) ? $data->name : ''}}" class="form-control" id="input_name" placeholder="请填写分类标题">
                            </div>
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="input_category" class="col-sm-3 control-label"><span>*</span>目录图标 :</label>
                        <div class="col-sm-5 no-padding">
                            <input id="f_select_input" class="form-control" style="width: 50%" type="text" placeholder="请选择目录图标"/>
                            <ul id="f_select" class="f_select">
                                @foreach($icons as $item)
                                <li><a href="javascript:void (0);" class="fa {{$item->name}}">  &nbsp;&nbsp;{{$item->name}}</a> </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    {{--<div class="form-group">--}}
                        {{--<label>Minimal</label>--}}
                        {{--<label>--}}
                            {{--<select class="form-control select2 select2-hidden-accessible" style="width: 100%;"--}}
                                    {{--tabindex="-1" aria-hidden="true">--}}
                                {{--<option selected="selected">Alabama</option>--}}
                                {{--<option>Alaska</option>--}}
                                {{--<option>California</option>--}}
                                {{--<option>Delaware</option>--}}
                                {{--<option>Tennessee</option>--}}
                                {{--<option>Texas</option>--}}
                                {{--<option>Washington</option>--}}
                            {{--</select>--}}
                        {{--</label>--}}
                        {{--<span class="select2 select2-container select2-container--default" dir="ltr" style="width: 100%;">--}}
                            {{--<span class="selection">--}}
                                {{--<span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-labelledby="select2-23s5-container">--}}
                                    {{--<span class="select2-selection__rendered" id="select2-23s5-container" title="Alabama">Alabama</span>--}}
                                    {{--<span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span>--}}
                                {{--</span>--}}
                            {{--</span>--}}
                            {{--<span class="dropdown-wrapper" aria-hidden="true"></span>--}}
                        {{--</span>--}}
                    {{--</div>--}}


                    <div class="box-body">
                        <div class="form-group">
                            <label for="input_name" class="col-sm-3 control-label"><span>*</span>是否显示 :</label>
                            <div class="col-sm-5 no-padding">
                                <input type="text" name="is_show" value="{{isset($data) ? $data->name : ''}}" class="form-control" id="input_name" placeholder="请填写分类标题">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="input_sort" class="col-sm-3 control-label"><span>*</span>排序 :</label>
                        <div class="col-sm-5 no-padding">
                            <input type="text" name="sort" class="form-control" style="width:50%;" id="input_sort"
                                   value="{{isset($lists) ? $lists->sort : ''}}" placeholder="填写序号越小越靠前1-最靠前">
                        </div>
                    </div>

                    <div class="box-body">
                        <div class="form-group">
                            <label for="input_name" class="col-sm-3 control-label"><span>*</span>备注 :</label>
                            <div class="col-sm-5 no-padding">
                                <input type="text" name="is_show" value="{{isset($data) ? $data->name : ''}}" class="form-control" id="input_name" placeholder="请填写分类标题">
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

@section('script')
    <script src="{{asset('adminLET/select2/dist/js/select2.min.js')}}" type="text/javascript"></script>
    <script>
        var ipt=document.getElementById('f_select_input');
        var ul=document.getElementById('f_select');
        var lis=ul.children;
        ipt.onfocus=function(){
            ul.style.display='block';
        };
        ipt.onblur=function(){
            setTimeout(function(){
                ul.style.display='none';
            },200)

        };
        //模拟option点击事件
        for(var i=0;i<lis.length;i++){
            lis[i].onclick=function(){
                ipt.value=this.innerText.replace(/^\s+|\s+$/g,"");
            }
        }
    </script>
@stop
