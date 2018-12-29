@extends('admin.layouts.app')

@section('style')
    <link rel="stylesheet" href="{{asset('adminLet/bootstrap-fileinput/css/fileinput.min.css')}}">
@stop

@section('contents')
<div class="row">
    <div class="col-xs-12">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">{{isset($page_title) ? $page_title : ''}}</h3>
            </div>

            <form action="{{url('article/store')}}" class="form-horizontal" id="postForm"  enctype="multipart/form-data">

                {{ csrf_field() }}

                <input type="hidden" name="id" value="{{isset($lists) ? $lists->id : ''}}">

                <div class="box-body">

                    <div class="form-group">
                        <label for="input_name" class="col-sm-3 control-label"><span>*</span>广告标题 :</label>
                        <div class="col-sm-4 no-padding">
                            <input type="text" name="title" value="{{isset($lists) ? $lists->title : ''}}"
                                   class="form-control" id="input_name" placeholder="请填写广告标题">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="input_name" class="col-sm-3 control-label"><span>*</span>广告类型 :</label>
                        <div class="col-sm-4 no-padding">
                            <select  class="form-control" style="width: 40%" name="type_id" id="" title="tags">
                                <option value="-1">请选择广告</option>
                                @foreach($types as $key => $item)
                                    <option @if(isset($lists) && $lists->tag_id == $key) {{"selected='selected'"}} @endif
                                            value="{{$key}}">{{$item}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label"><span>*</span>广告图片 :</label>
                        <div class="col-md-4 no-padding">
                            <div class="fileinput fileinput-new no-padding" >
                                <span class="btn default btn-file no-padding">
                                    <input type="file" name="files" id="uploadImage" />
                                </span>
                            </div>
                            <div id="titleImageError" style="color: #a94442"></div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label"><span>*</span>广告内容 :</label>
                        <div class="col-sm-4 no-padding">
                            <textarea name="contents" class="form-control" style="height:100px;display: inline-block"
                                      title="广告内容"><?php echo isset($lists) ? $lists->contents : ''?></textarea >
                            <div class="article_content"></div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="input_sort" class="col-sm-3 control-label"><span>*</span>排序 :</label>
                        <div class="col-sm-4 no-padding">
                            <input type="text" name="sort" class="form-control" style="width:40%;" id="input_sort"
                               value="{{isset($lists) ? $lists->sort : ''}}" placeholder="填写序号越小越靠前1-最靠前">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="input_path" class="col-sm-3 control-label" >跳转的URL :</label>
                        <div class="col-sm-4 no-padding">
                            <input type="text" name="path" class="form-control" id="input_path"
                                   value="{{isset($lists) && $lists->path ? $lists->path : ''}}"  placeholder="http://www....">
                        </div>
                    </div>
                </div>

                <div class="box-footer" style="text-align: center">
                    <a href="javascript:void (0);" data-back_url="{{route('admin.article')}}" data-is_confirm="false"
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
    <script src="{{asset('adminLet/bootstrap-fileinput/js/fileinput.min.js')}}"></script>
    <script src="{{asset('adminLet/bootstrap-fileinput/locales/zh.js')}}"></script>
    <script type="text/javascript">
        $("#uploadImage").fileinput({
            language : 'zh',
//            uploadUrl : location.pathname + '/uploadFile/',
            uploadUrl : "{{route('admin.advert.uploadFile')}}",
            showCaption : true,
            maxFileCount : 1, //表示允许同时上传的最大文件个数
            allowedFileExtensions : [ "jpg", "png", "gif","pdf" ], //可接收的文件后缀
            browseClass : "btn btn-primary", //按钮样式
            dropZoneEnabled : false, //是否显示拖拽区域
            showPreview : true, //是否显示预览
            enctype : 'multipart/form-data', //上传的文件格式
//            previewFileIcon : "<i class='glyphicon glyphicon-king'></i>",
            showUpload : true,
            showRemove : true,
            showClose : false, //右上角的关闭按钮
            layoutTemplates : {
                actionDelete : ''
            },
            uploadExtraData : function () {
            // 注意这里，传参是json格式,后台直接使用对象属性接收，比如employeeCode，我在RatingQuery 里面直接定义了employeeCode属性，然后最重要的也是
            // 最容易忽略的，传递多个参数时，不要忘记里面大括号{}后面的分号，这里可以直接return {a:b}; 或者{a:b}都可以，但必须要有大括号包裹
                return {
                    _token : $('input[name="_token"]').val()
                };
            }
        }).on("fileuploaded", function(event, msg) { //异步上传返回结果处理
            console.log(msg.response);
            if (msg.response.status === 1) {
//                console.log(msg.response);
                alert(msg.response.message);
            } else if(msg.response.status === 0) {
                alert(msg.response);
            }
        }).on('filepreupload', function(event, data) { //上传前
            console.log(data);
        });
    </script>
@stop