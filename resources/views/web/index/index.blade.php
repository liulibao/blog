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
                        <div class="picshowtxt_left"> <span>1</span>/<i>12</i></div>
                        {{--<div class="picshowtxt_right"></div>--}}
                    </div>

                    <div class="picshowlist">
                        <div class="picshowlist_mid">
                            <div class="picmidleft"> <a href="javascript:void(0)" id="preArrow_B"><span class="sleft"></span></a> </div>
                            <div class="picmidmid">
                                <ul>
                                    <li> <a href="javascript:void(0);"><img src="{{asset('web/images/1.jpg')}}" alt="" bigimg="{{asset('web/images/1.jpg')}}" /></a></li>
                                    <li> <a href="javascript:void(0);"><img src="{{asset('web/images/2.jpg')}}" alt="" bigimg="{{asset('web/images/2.jpg')}}" text="《古剑》小师妹迪丽热巴清新写真宛若小仙女" /></a></li>
                                    <li> <a href="javascript:void(0);"><img src="{{asset('web/images/3.jpg')}}" alt="" bigimg="{{asset('web/images/3.jpg')}}" text="《古剑》小师妹迪丽热巴清新写真宛若小仙女" /></a></li>
                                    <li> <a href="javascript:void(0);"><img src="{{asset('web/images/4.jpg')}}" alt="" bigimg="{{asset('web/images/4.jpg')}}" text="《古剑》小师妹迪丽热巴清新写真宛若小仙女" /></a></li>
                                    <li> <a href="javascript:void(0);"><img src="{{asset('web/images/5.jpg')}}" alt="" bigimg="{{asset('web/images/5.jpg')}}" text="《古剑》小师妹迪丽热巴清新写真宛若小仙女" /></a></li>
                                    <li> <a href="javascript:void(0);"><img src="{{asset('web/images/6.jpg')}}" alt="" bigimg="{{asset('web/images/6.jpg')}}" text="《古剑》小师妹迪丽热巴清新写真宛若小仙女" /></a></li>
                                    <li> <a href="javascript:void(0);"><img src="{{asset('web/images/7.jpg')}}" alt="" bigimg="{{asset('web/images/7.jpg')}}" text="《古剑》小师妹迪丽热巴清新写真宛若小仙女" /></a></li>
                                    <li> <a href="javascript:void(0);"><img src="{{asset('web/images/8.jpg')}}" alt="" bigimg="{{asset('web/images/8.jpg')}}" text="《古剑》小师妹迪丽热巴清新写真宛若小仙女" /></a></li>
                                    <li> <a href="javascript:void(0);"><img src="{{asset('web/images/9.jpg')}}" alt="" bigimg="{{asset('web/images/9.jpg')}}" text="《古剑》小师妹迪丽热巴清新写真宛若小仙女" /></a></li>
                                    <li> <a href="javascript:void(0);"><img src="{{asset('web/images/10.jpg')}}" alt="" bigimg="{{asset('web/images/10.jpg')}}" text="《古剑》小师妹迪丽热巴清新写真宛若小仙女" /></a></li>
                                    <li> <a href="javascript:void(0);"><img src="{{asset('web/images/11.jpg')}}" alt="" bigimg="{{asset('web/images/11.jpg')}}" text="《古剑》小师妹迪丽热巴清新写真宛若小仙女" /></a></li>
                                    <li> <a href="javascript:void(0);"><img src="{{asset('web/images/12.jpg')}}" alt="" bigimg="{{asset('web/images/12.jpg')}}" text="《古剑》小师妹迪丽热巴清新写真宛若小仙女" /></a></li>
                                </ul>
                            </div>
                            <div class="picmidright"> <a href="javascript:void(0)" id="nextArrow_B"><span class="sright"></span></a> </div>
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
                <a href="/">
                    <img src="{{asset('web/images/1.jpg')}}">
                </a>
            </span>
            <p>{{strip_tags($item['contents'])}}</p>
            <div class="article-icons">
                <ul>
                    <li>
                        <a href="javascript:void(0);" title="创建时间: 2019-02-12 11:15">
                            <i class="fa fa-calendar"></i>{{date('Y-m-d H:i', strtotime($item['created_at']))}}
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0);" title="作者: admin">
                            <i class="fa fa-user"></i>admin
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
                        <a href="javascript:void(0);" title="查看分类"><i class="fa fa-tag"></i>PHP</a>
                    </li>
                </ul>
            </div>
        </li>
        @endforeach
        @endif
    </div>

@stop

{{--@section('scripts')--}}

{{--@stop--}}