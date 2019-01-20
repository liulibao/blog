@extends('admin.layouts.app')

@section('style')
    <style>
        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
        }
        .f_select-box .icon-search{
            background: url({{asset('admin/images/select_point.gif')}}) no-repeat;
            width: 15px;
            height: 14px;
            position: absolute;
            top: 15px;
            left: 45%;
        }
        .f_select {
            list-style:none;
            width: 50%;
            max-height: 100px;
            overflow: auto;
            border:1px solid #d2d6de;
            display:none;
        }
        .f_select li {
            display:inline-block;
            width:100%;
            height:20px;
            line-height: 20px;
            text-decoration:none;
            color:#555;
            padding-left: 10px;
        }
        .f_select li:hover{
            background-color:#00c0ef;
            height:30px;
            line-height: 30px;
            color: #fff;
            z-index: 99;
        }
        .f_selected li{
            background-color:#00c0ef;
            height:30px;
            line-height: 30px;
            color: #fff;
            z-index: 99;
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

                <form action="{{url('system/menu/store')}}" class="form-horizontal" id="postForm">
                    <div class="box-body">
                        {{ csrf_field() }}
                        <input type="hidden" name="id" value="{{isset($data) ? $data->id : ''}}">

                        <div class="form-group">
                            <label for="input_name" class="col-sm-3 control-label"><span>*</span>目录名称 :</label>
                            <div class="col-sm-3 no-padding">
                                <input type="text" name="name" value="{{isset($data) ? $data->name : ''}}"
                                       class="form-control" id="input_name" autocomplete="off" placeholder="请填写目录名称">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="input_category" class="col-sm-3 control-label">上级目录 :</label>
                            <div class="col-sm-5 no-padding">
                                <select  class="form-control" style="width: 50%" name="pid" title="请填选择上级目录">
                                    <option value="0">请选择上级目录</option>
                                    @if(!empty($menu))
                                    @foreach($menu as $item)
                                        <option value="{{$item->id}}" @if(isset($data) && $data->pid == $item->id) {{"selected='selected'"}} @endif >
                                            {{$item->name}}
                                        </option>
                                        @if(is_array($item->children))
                                        @foreach($item->children as $val)
                                            <option value="{{$val->id}}"  @if(isset($data) && $data->pid == $val->id) {{"selected='selected'"}} @endif >
                                                <?php echo str_repeat(">>", 1)?>{{ $val->name}}
                                            </option>
                                        @endforeach
                                        @endif
                                    @endforeach
                                    @endif
                                </select>
                                <span>不选择表示顶级目录</span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="input_name" class="col-sm-3 control-label">
                                <span>*</span>目录路由 :
                            </label>
                            <div class="col-sm-3 no-padding">
                                <input type="text" name="path" value="{{isset($data) ? $data->path : ''}}" autocomplete="off"
                                       class="form-control" id="input_name" placeholder="请填写目录路由">
                                <span>路由格式如: admin/index</span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="input_category" class="col-sm-3 control-label">
                                <span class="icon-show">*</span>目录图标 :
                            </label>
                            <div class="col-sm-5 no-padding f_select-box">
                                <i class="icon-search"></i>
                                <input id="f_select_input" name="icon" value="@if(isset($data)){{$data->icon}}@endif" class="form-control" readonly="readonly"
                                       style="width: 50%;background-color: #fff;" type="text" placeholder="请选择目录图标"/>
                                <ul id="f_select_id" class="f_select">
                                    <li>请选择图标</li>
                                    @foreach($icons as $item)
                                    <li class="fa {{$item->name}}">
                                        &nbsp;&nbsp;{{$item->name}}
                                    </li>
                                    @endforeach
                                </ul>
                                <span>选择顶级目录时,必选图标</span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="input_name" class="col-sm-3 control-label"><span>*</span>显示状态 :</label>
                            <div class="col-sm-5 no-padding">
                                <div class="radio_box">
                                    <input type="radio" name="is_show" value="0" checked id="is_show_0"
                                          @if(isset($data) && $data->is_show == 0) {{'checked'}} @endif title="">
                                    <label for="is_show_0">隐藏</label>


                                    <input type="radio" name="is_show" value="1" id="is_show_1"
                                              @if(isset($data) && $data->is_show == 1) {{'checked'}} @endif title="">
                                    <label for="is_show_1">显示</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="input_sort" class="col-sm-3 control-label"><span>*</span>排序 :</label>
                            <div class="col-sm-5 no-padding">
                                <input type="text" name="sort" class="form-control" style="width:50%;" id="input_sort" autocomplete="off"
                                       value="{{isset($data) ? $data->sort : ''}}" placeholder="填写序号越小越靠前1-最靠前">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="input_name" class="col-sm-3 control-label">备注 :</label>
                            <div class="col-sm-5 no-padding">
                                <textarea class="form-control" id="input_name" placeholder="请填写备注" title="备注信息">
                                    {{isset($data) ? $data->remarks : ''}}
                                </textarea>
                            </div>
                        </div>
                    </div>

                    <div class="box-footer" style="padding-right: 60%">
                        <a href="javascript:void (0);" data-back_url="{{route('admin.menu')}}" data-is_confirm="false"
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
    <script>
        $(function () {
            //icon 是否显示的问题
            $('select[name="pid"]').change(function () {
                if($(this).val() != 0 ) {
                    $('.icon-show').addClass('hidden');
                } else {
                    $('.icon-show').removeClass('hidden');
                }
            });
        });

        //仿select
        var ipt=document.getElementById('f_select_input');
        var ul=document.getElementById('f_select_id');
        var lis=ul.children;
        ipt.onclick=function () {
            ul.style.display='block';
        };
        ipt.onfocus = function(){
            ul.style.display='block';
        };
        ipt.onblur = function(){
            setTimeout(function(){
                ul.style.display='none';
            },200)
        };
        ul.onmouseleave = function(){
            ul.style.display='none';
        };
        //模拟option点击事件
        for(var i=0;i<lis.length;i++){
            lis[i].onclick=function(){
                if( this.innerText.replace(/^\s+|\s+$/g,"") == '请选择图标'){
                    ipt.value = '';
                } else {
                    ipt.value = this.innerText.replace(/^\s+|\s+$/g,"");
                }
            }
        }
    </script>
@stop
