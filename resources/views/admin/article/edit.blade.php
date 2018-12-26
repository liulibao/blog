@extends('admin.layouts.app')

@section('contents')

<div class="row">
    <div class="col-xs-12">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">{{isset($page_title) ? $page_title : ''}}</h3>
            </div>

            <form action="{{url('article/store')}}" class="form-horizontal" id="postForm">

                {{ csrf_field() }}

                <input type="hidden" name="id" value="{{isset($lists) ? $lists->id : ''}}">

                <div class="box-body">

                    <div class="form-group">
                        <label for="input_name" class="col-sm-3 control-label"><span>*</span>文章标题 :</label>
                        <div class="col-sm-4" style="padding-left: 0;">
                            <input type="text" name="title" value="{{isset($lists) ? $lists->title : ''}}" class="form-control" id="input_name"
                                   placeholder="请填写文章标题">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="input_name" class="col-sm-3 control-label"><span>*</span>文章类型 :</label>
                        <div class="col-sm-4" style="padding-left: 0;">
                            <select  class="form-control" style="width: 40%" name="type_id" id="" title="tags">
                                <option value="-1">请选择文章类型</option>
                                @foreach($types as $key => $item)
                                    <option @if(isset($lists) && $lists->tag_id == $key) {{"selected='selected'"}} @endif value="{{$key}}">{{$item}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="input_category" class="col-sm-3 control-label"><span>*</span>文章分类 :</label>
                        <div class="col-sm-4" style="padding-left: 0;">
                            <select  class="form-control" style="width: 40%" name="category_id" title="input_category">
                                <option value="0">请选择文章分类</option>
                                @foreach($category as $item)
                                    <option @if(isset($lists) && $lists->category_id == $item->id) {{"selected='selected'"}} @endif value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group" style="">
                        <label class="col-sm-3 control-label"><span>*</span>文章内容 :</label>
                        <textarea  id="editor" name="contents" style="width:75%;height:400px;display: inline-block" title="文章内容"><?php echo isset($lists) ? $lists->contents : ''?></textarea >
                        <div class="article_content"></div>
                    </div>


                    <div class="form-group">
                        <label for="input_sort" class="col-sm-3 control-label"><span>*</span>排序 :</label>
                        <input type="text" name="sort" class="form-control" style="width:20%;" id="input_sort"
                               value="{{isset($lists) ? $lists->sort : ''}}" placeholder="填写序号越小越靠前1-最靠前">
                    </div>


                    <div class="form-group">
                        <label for="input_keyword" class="col-sm-3 control-label">关键字 :</label>
                        {{--<input name="keyword" value="" type="hidden" id="keywords">--}}
                        <span data-save-id="keywords" data-limit-num="6">
                             <input type="text" name="keyword" class="form-control key-word" style="width: 30%;" id="input_keyword" placeholder="添加关键字">
                        </span>
                    </div>

                    <div class="form-group">
                        <label for="input_comment" class="col-sm-3 control-label"><span>*</span>是否评论 :</label>
                        <div class="radio">
                            <label>
                                <input type="radio" name="is_comment" value="0"
                                @if(!isset($lists)) {{'checked="checked"'}} @elseif($lists->is_comment == 0) {{'checked="checked"'}} @endif > 允 许
                            </label>
                            <label style="margin-left:25px;">
                                <input type="radio" name="is_comment" value="1"
                                @if(isset($lists) && $lists->is_comment == 1) {{'checked="checked"'}} @endif> 禁 止
                            </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="input_recommend" class="col-sm-3 control-label"><span>*</span>是否推荐 :</label>
                        <div class="radio">
                            <label><input type="radio" name="is_recommend" value="1"
                                @if(isset($lists) && $lists->is_recommend == 1) {{'checked="checked"'}} @endif> 推 荐</label>
                            <label style="margin-left:25px;"><input type="radio" name="is_recommend" value="0"
                                @if(!isset($lists)) {{'checked="checked"'}} @elseif($lists->is_recommend == 0) {{'checked="checked"'}} @endif> 不推荐</label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="input_path" class="col-sm-3 control-label" >关联文章的URL :</label>
                        <input type="text" name="path" class="form-control" style="width: 45%;" value="{{isset($lists) && $lists->path ? $lists->path : ''}}" id="input_path" placeholder="http://www....">
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
    <script type="text/javascript" charset="utf-8" src="{{asset('ueditor/ueditor.config.js')}}"></script>
    <script type="text/javascript" charset="utf-8" src="{{asset('ueditor/ueditor.all.min.js')}}"> </script>
    <script type="text/javascript" charset="utf-8" src="{{asset('ueditor/lang/zh-cn/zh-cn.js')}}"></script>
    <script type="text/javascript">
        // 创建编辑器
        var ue = UE.getEditor('editor');
    </script>
@stop