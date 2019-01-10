@extends('admin.layouts.app')

@section('style')
    <link rel="stylesheet" href="{{asset('admin/adminlet/bootstrap-fileinput/css/fileinput.min.css')}}">
@stop

@section('contents')
<div class="row">
    <div class="col-xs-12">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">{{isset($page_title) ? $page_title : ''}}</h3>
            </div>

            <form action="{{url('advert/store')}}" class="form-horizontal" id="postForm"  enctype="multipart/form-data">

                {{ csrf_field() }}

                <input type="hidden" name="id" value="{{isset($lists) ? $lists->id : ''}}">

                <div class="box-body">

                    <div class="form-group">
                        <label for="input_name" class="col-sm-3 control-label"><span>*</span>广告标题 :</label>
                        <div class="col-sm-5 no-padding">
                            <input type="text" name="title" value="{{isset($lists) ? $lists->title : ''}}"
                                   class="form-control" id="input_name" placeholder="请填写广告标题">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="input_name" class="col-sm-3 control-label"><span>*</span>广告类型 :</label>
                        <div class="col-sm-4 no-padding">
                            <select  class="form-control" style="width: 45%" name="type_id" id="" title="tags">
                                <option value="">请选择广告</option>
                                @if( isset($types))
                                @foreach($types as $key => $item)
                                    <option @if(isset($lists) && $lists->type_id == $key) {{"selected='selected'"}} @endif
                                            value="{{$key}}">{{$item}}</option>
                                @endforeach
                                @endif
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label"><span>*</span>广告图片 :</label>
                        <div class="col-md-5 no-padding">
                            <input type="hidden" id="attachment_id" name="attachment_id" value="{{isset($lists) &&  $lists->attachment_id  ? $lists->attachment_id : ''}}">
                            <div class="fileinput fileinput-new no-padding" >
                                <span class="btn default btn-file no-padding">
                                    <!--修改图片-->
                                    @if( isset($lists) && $lists->attachment )
                                    <div class="file-preview-thumbnails" style="margin-left:8px;position: relative;z-index: 99;">
                                        <div class="file-preview-frame krajee-default  kv-preview-thumb" style="margin-top: 17px;" data-template="image">
                                            <div class="kv-file-content">
                                                <img src="{{isset($lists) && $lists->attachment ? $lists->attachment->path : ''}}"
                                                     style="height: auto;width: auto; max-height: 100%;max-width: 100%" alt="">
                                            </div>
                                            <div class="file-thumbnail-footer">
                                                <div class="file-footer-caption" title="ba7a8dafcc83cd90!400x400_big.jpg">
                                                    <div class="file-caption-info">{{isset($lists) && $lists->attachment ? $lists->attachment->original : ''}}</div>
                                                    <div class="file-size-info"> <samp>({{isset($lists) && $lists->attachment ? $lists->attachment->size : ''}})</samp></div>
                                                </div>
                                                <div class="file-actions">
                                                    <div class="file-footer-buttons">
                                                       <button type="button" data-url="{{url('advert/deleteFile')}}" data-file_id="{{$lists->attachment_id}}" class="btn btn-sm btn-default deleteFiles" title="删除文件">
                                                           <i class="glyphicon glyphicon-trash"></i></button>
                                                        <button type="button" class="kv-file-zoom btn btn-sm btn-kv btn-default btn-outline-secondary" title="查看详情">
                                                            <i class="glyphicon glyphicon-zoom-in"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                    <input type="file" name="files" id="uploadImage" />
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label"><span>*</span>广告内容 :</label>
                        <div class="col-sm-5 no-padding">
                            <textarea name="remarks" class="form-control" style="height:100px;display: inline-block"
                                      title="广告内容"><?php echo isset($lists) ? $lists->remarks : ''?></textarea >
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="input_path" class="col-sm-3 control-label" >跳转的URL :</label>
                        <div class="col-sm-5 no-padding">
                            <input type="text" name="path" class="form-control" id="input_path"
                                   value="{{isset($lists) && $lists->path ? $lists->path : ''}}"  placeholder="http://www....">
                        </div>
                    </div>
                </div>

                <div class="box-footer" style="padding-right: 60%">
                    <a href="javascript:void (0);" data-back_url="{{route('admin.advert')}}" data-is_confirm="false"
                       class="btn btn-info submitFormBtu" >立即提交
                    </a>
                    <a href="javascript:history.go(-1);" class="btn btn-default"> 返回</a>
                </div>

            </form>
        </div>
    </div>
</div>

<div id="kvFileinputModal" class="file-zoom-dialog modal fade in" aria-labelledby="kvFileinputModalLabel" aria-hidden="false" style="display: none;">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">详细预览</h5>
                <span class="kv-zoom-title" title="beijing.jpg  (99.13 KB)">beijing.jpg  <samp>(99.13 KB)</samp></span>
                <div class="kv-zoom-actions">
                    <button type="button" class="btn btn-sm btn-kv btn-default btn-outline-secondary btn-close" title="关闭当前预览" data-dismiss="modal">
                        <i class="glyphicon glyphicon-remove"></i></button>
                </div>
            </div>
            <div class="modal-body">
                <div class="floating-buttons"></div>
                <div class="kv-zoom-body file-zoom-content krajee-default">
                    <img src="" class="file-preview-image kv-preview-data file-zoom-detail" title="beijing.jpg" alt="beijing.jpg" style="width:auto;height:auto;max-width:100%;max-height:100%;">
                </div>
            </div>
        </div>
    </div>
</div>

@stop

@section('script')
    <script src="{{asset('admin/adminlet/bootstrap-fileinput/js/fileinput.min.js')}}"></script>
    <script src="{{asset('admin/adminlet/bootstrap-fileinput/locales/zh.js')}}"></script>
    <script type="text/javascript">
        $("#uploadImage").fileinput({
            language : 'zh',
//            uploadUrl : location.pathname + '/uploadFile/',
            uploadUrl : "{{route('admin.advert.uploadFile')}}",
            showCaption : true,
            maxFileCount : 3, //表示允许同时上传的最大文件个数
            allowedFileExtensions : [ "jpg", "png", "gif","pdf" ], //可接收的文件后缀
            browseClass : "btn btn-primary", //按钮样式
            dropZoneEnabled : false, //是否显示拖拽区域
            showPreview : true, //是否显示预览
            enctype : 'multipart/form-data', //上传的文件格式
            showUpload : true,
            showRemove : true,
            showClose : false, //右上角的关闭按钮
            layoutTemplates : {
//                actionDelete : ''
            },
            previewClass : {

            },
            fileActionSettings : {
                showRemove: true,
                showUpload: true,
                showZoom: true, //预览btu
                removeIcon: '<i class="glyphicon glyphicon-trash text-danger"></i>',
                removeClass: 'btn btn-xs btn-default',
//                removeTitle: 'Remove file',
                uploadIcon: '<i class="glyphicon glyphicon-upload text-info"></i>',
                uploadClass: 'btn btn-xs btn-default',
//                uploadTitle: 'Upload file',
                zoomIcon: '<i class="glyphicon glyphicon-zoom-in"></i>',
                zoomClass: 'btn btn-xs btn-default',
//                zoomTitle: 'View Details',
//
            }, //  设置预览图片的显示样式
//            minImageWidth: 140, //图片的最小宽度
//            minImageHeight: 140, //图片的最小高度
//            maxImageWidth: 140, //图片的最大宽度
//            maxImageHeight: 140, //图片的最大高度
//            maxFileSize: 2048, //单位为kb，如果为0表示不限制文件大小
//            msgFilesTooMany: "选择上传的文件数量({n}) 超过允许的最大数值{m}！",
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
                console.log(msg.response);
                $('#attachment_id').val(msg.response.data.id);
//                alert(msg.response.message);
            } else if(msg.response.status === 0) {
                console.log(msg.response);
                alert(msg.response.message);
            }
        }).on('filepreupload', function(event, data) { //上传前
            console.log(data);
        });
    </script>
@stop