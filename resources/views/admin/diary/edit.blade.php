@extends('admin.layouts.app')

@section('contents')

    <div class="row">
        <div class="col-xs-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">{{isset($page_title) ? $page_title : ''}}</h3>
                </div>

                <form action="{{url('diary/store')}}" class="form-horizontal" id="postForm">

                    {{ csrf_field() }}

                    <input type="hidden" name="id" value="{{isset($lists) ? $lists->id : ''}}">

                    <div class="box-body">

                        <div class="form-group">
                            <label for="input_name" class="col-sm-3 control-label"><span>*</span>日记标题 :</label>
                            <div class="col-sm-4 no-padding">
                                <input type="text" name="title" value="{{isset($lists) ? $lists->title : ''}}" class="form-control" id="input_name"
                                       placeholder="请填写日记标题">
                            </div>
                        </div>

                        <div class="form-group" style="">
                            <label class="col-sm-3 control-label"><span>*</span>日记内容 :</label>
                            <div class="col-sm-6 no-padding">
                                <textarea  id="editor" name="contents" style="height:400px;display: inline-block" title="日记内容"><?php echo isset($lists) ? $lists->contents : ''?></textarea >
                                <div class="article_content"></div>
                            </div>
                        </div>

                    </div>

                    <div class="box-footer" style="padding-right: 60%">
                        <a href="javascript:void (0);" data-back_url="{{route('admin.diary')}}" data-is_confirm="false"
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
    <script type="text/javascript" charset="utf-8" src="{{asset('ueditor/ueditor.config.js')}}"></script>
    <script type="text/javascript" charset="utf-8" src="{{asset('ueditor/ueditor.all.min.js')}}"> </script>
    <script type="text/javascript" charset="utf-8" src="{{asset('ueditor/lang/zh-cn/zh-cn.js')}}"></script>
    <script type="text/javascript">
        // 创建编辑器
        var ue = UE.getEditor('editor');
    </script>
@stop