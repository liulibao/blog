@extends('web.layouts.app')

@section('title')
    @parent
    首页
@stop

@section('contents')
    <div class="box-body" style="height: 340px">
        <div class="picsbox">
            <div class="bodymodal"></div>
            <!--播放到第一张图的提示-->
            <div class="firsttop">
                <div class="firsttop_right">
                    <div class="close2"> <a class="closebtn1" title="关闭" href="javascript:void(0)"></a> </div>
                    <div class="replay">
                        <h2 id="div-end-h2"> 已到第一张图片了。 </h2>
                        <p> <a class="replaybtn1" href="javascript:;">重新播放</a> </p>
                    </div>
                </div>
            </div>
            <!--播放到最后一张图的提示-->
            <div class="endtop">
                <div class="firsttop_right">
                    <div class="close2"> <a class="closebtn2" title="关闭" href="javascript:void(0)"></a> </div>
                    <div class="replay">
                        <h2 id="H1"> 已到最后一张图片了。 </h2>
                        <p> <a class="replaybtn2" href="javascript:;">重新播放</a> </p>
                    </div>
                </div>
            </div>
            <!--弹出层结束-->
            <!--图片特效内容开始-->
            <div class="piccontext">
                <!--大图展示-->
                <div class="picshow">
                    <div class="picshowtop">
                        <a href="#">
                            <img src="" alt="" id="pic1" curindex="0" />
                        </a>
                        <a id="preArrow" href="javascript:void(0)" class="contextDiv" title="上一张">
                            <span id="preArrow_A"></span></a>
                        <a id="nextArrow" href="javascript:void(0)" class="contextDiv" title="下一张">
                            <span id="nextArrow_A"></span></a>
                    </div>

                    <div class="picshowtxt">
                        <div class="picshowtxt_left"> <span>1</span>/<i>{{count($advert)}}</i></div>
                        <div class="picshowtxt_right"></div>
                    </div>

                    <div class="picshowlist">
                        <div class="picshowlist_mid">
                            <div class="picmidleft">
                                <a href="javascript:void(0)" id="preArrow_B">
                                    <span class="sleft"></span>
                                </a>
                            </div>
                            <div class="picmidmid">
                                <ul>
                                    @foreach($advert as $item)
                                    <li>
                                        <a href="javascript:void(0);">
                                            <img src="{{$item['path']}}" alt="" bigimg="{{$item['path']}}" />
                                        </a>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="picmidright">
                                <a href="javascript:void(0)" id="nextArrow_B">
                                    <span class="sright"></span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="article-lists">
        @if(!empty($article['data']))
        @foreach($article['data'] as $item)
        <li>
            <h3><a href="{{url('article/detail', ['id' => $item['id']])}}">{{$item['title']}}</a></h3>
            <span>
                <a href="{{url('article/detail', ['id' => $item['id']])}}">
                    <img src="{{$item['image']}}">
                </a>
            </span>
            <p>{{$item['summary']}}</p>
            <div class="article-icons">
                <ul>
                    <li>
                        <a href="javascript:void(0);" title="创建时间: {{date('Y-m-d H:i', strtotime($item['created_at']))}}">
                            <i class="fa fa-calendar"></i>{{date('Y-m-d H:i', strtotime($item['created_at']))}}
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0);" title="作者: {{$item['username']}}">
                            <i class="fa fa-user"></i>{{$item['username']}}
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0);" title="已评论 {{$item['comment_num']}} 条">
                            <i class="fa fa-comment"></i>已评论({{$item['comment_num']}})条
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0);" title="已有 {{$item['read_num']}} 次浏览">
                            <i class="fa fa-eye"></i>已阅读 ({{$item['read_num']}})次
                        </a>
                    </li>
                    <li>
                        {{--<a href="javascript:void(0);" title="查看分类"><i class="fa fa-tag"></i>PHP</a>--}}
                    </li>
                </ul>
            </div>
        </li>
        @endforeach
        @endif
    </div>


    <div class="page-list">
        @if($article['last_page'] > 1)
            <a href="{{$article['first_page_url']}}" class="@if($article['current_page'] == 1) {{'curPage'}} @endif">第一页</a>&nbsp;&nbsp;
            @if(request('page') != 1)
                <a href="{{$article['prev_page_url']}}" >上一页</a>&nbsp;&nbsp;
            @endif

            @if(request('page') != $article['last_page'])
                <a href="{{$article['next_page_url']}}" >下一页</a>
            @endif
            <a href="{{$article['last_page_url']}}" class="@if($article['current_page'] == $article['last_page']) {{'curPage'}} @endif">最后一页</a>
        @endif
    </div>
@stop

{{--@section('scripts')--}}

{{--@stop--}}