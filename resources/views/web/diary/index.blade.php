@extends('web.layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{asset('web/css/about.css')}}">
    <style>
        .container{
            width: 100%;
            padding: 0;
            margin:0 auto 50px;
        }
    </style>
@endsection

@section('diary')
<div class="body-container">
    <div class="content-container">
        <div class="header-img">
            <div class="personal-feel" style="margin:200px 200px 50px 200px;width:350px;">
                <h3 style="background: none;">Some things are not to see to insist,but insisted the will sees hope.</h3>
                <p>有些事情不是看到希望才去坚持，而是坚持了才会看到希望。</p>
            </div>
            <div style="margin:100px 200px 50px 1055px;width:350px;">
                <h3 style="background: none;">Some things are not to see to insist,but insisted the will sees hope.</h3>
                <p>有些事情不是看到希望才去坚持，而是坚持了才会看到希望。</p>
            </div>
        </div>
        <div class="" style="background-color: transparent;"></div>
        <div class="container">
            <div class="container-title-box">
                <div class="container-title">個人简介</div>
            </div>
            <div class="container-content-text">
                人心是最难读懂的，有时候我们连自己的心都难以掌控，不知道为什么，写到这里，我的脆弱之心又开始翻江倒海了，想想以前的自己，
                看看曾经的自己，发现那些与现在的自己有许多的不相符，或许文字就是最好的说明，一切源于心，
                心态的变化，生活总是让我们的心在逐渐的发生的各异，变化之中我们也开始挣脱着稚嫩，就像N多年前的我和如今的我，
                生活的真实让我越来越靠近了，是累了的心想靠岸吗，身边的人都在说“你不小了，该结婚了，年纪大了生孩子容易老”当然，
                这样的话几乎男男女女都对我说过，即使是爱我的人也会说，很多时候身边的朋友总是认为我是一个没心没肺的人，认为我的单身生活应该是自由无限制的，真的是这样吗，为什么我到现在还没结婚的原因是什么，想了很多，的确，或许家庭造成了一半这样的后果，或许换了是别人就不一定是这样的结果了，在身边人的眼里，我总是一个坚强的人，现在想想，也是，只是不同的是，我没有软弱的理由，没有可以让我一直依靠且安心的肩膀，一直都是，曾经如此，现在依然，我不是没有眼泪，只是我眼泪落下的时候，都是你们看不到的，我不是没有心情不好的时候，只是我不想让你们看到我的不开心，我不是没有痛的说不出话来的时候，只是我将痛转变成了微笑，这就是我。
                自从2015年10月份开始接触互联网开发开始，始终感觉自己还是一个菜鸟，技术提升不是很大，有时候也看写视频想提升一下自己的能力。
            </div>
        </div>
        <div class="container-content-son"  id='scroll_here'>
            <div class="container-content-son-box">
                <div class="column_containter-title">
                    <span class="boke-font">博客日记</span>
                </div>
                <div class="column_containter-image">
                    <img width="100%"  src="{{asset('web/images/content-img.jpg')}}">
                </div>
            </div>
            <div class ="content-container-list" style="margin-top: 0;padding-top: 0;">
                <ul>
                    @if(isset($list))
                        @foreach($list as $val)
                            <li>
                                <div class="blog-content">
                                    <div class="post-title">
                                        <a style="color:#888888;font-size:18px;line-height:18px" title="博客日记#{{$val['title']}}">{{$val['title']}}</a>
                                    </div>
                                    <div class="post-comment">
                                        <div class="cbp_tmicon fa fa-calendar"></div>
                                        <time class="cbp_tmtime" datetime="2013-04-10 18:30">发布日期：
                                            <span>{{date('Y/m/d H:i', strtotime($val['created_at']))}}</span>
                                        </time>
                                    </div>
                                    <div class="entry-content" style="color:#999999;font-size:14px;">
                                        <p>{!! $val['contents'] !!}...</p>
                                    </div>
                                </div>
                                <div class="read_more_wrapper">
                                    {{--<a style=" color:#597d7f;font-size:12px;" class="vc_read_more" title="博客日记#{{$val->title}}">阅读正文</a>--}}
                                </div>
                                <div style="clear:both"></div>
                            </li>
                        @endforeach
                    @endif
                </ul>
            </div>
        </div>
    </div>
</div>
@stop

{{--<div id="hidden_box" style="width: 100%;text-align: center;--}}
{{--color: red;--}}
{{--margin-bottom:10px;--}}
{{--position: relative;--}}
{{--bottom: 200px;--}}
{{--padding:160px 0 20px;--}}
{{--background-image: linear-gradient(-180deg,rgba(255,255,255,0) 0%,#fff 70%)">--}}
{{--<a style="display:inline-block;border:1px solid red;padding:3px 5px;border-radius:5px;color: red;">更多内容</a>--}}
{{--</div>--}}




