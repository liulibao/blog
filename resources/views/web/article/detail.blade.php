@extends('web.layouts.app')

@section('title')
@parent
    文章详情
@stop

@section('styles')
    <link href="{{asset('web/css/info.css')}}" rel="stylesheet">
@stop

@section('contents')
    <div class="infosbox">
        <div class="newsview">
            <h3 class="news_title">{{$article['title']}}</h3>
            <div class="bloginfo">
                <ul>
                    <li class="author">作者：<a href="/">杨青</a></li>
                    <li class="lmname"><a href="/">学无止境</a></li>
                    <li class="timer">时间：{{date('Y-m-d', strtotime($article['created_at']))}}</li>
                    <li class="view">{{$article['read_num']}}人已阅读</li>
                </ul>
            </div>

            <div class="tags">
                <a href="/" target="_blank">个人博客</a> &nbsp;
                <a href="/" target="_blank">小世界</a>
            </div>

            <div class="news_about"><strong>简介</strong>个人博客，用来做什么？我刚开始就把它当做一个我吐槽心情的地方，也就相当于一个网络记事本，写上一些关于自己生活工作中的小情小事，也会放上一些照片，音乐。每天工作回家后就能访问自己的网站，一边听着音乐，一边写写文章。</div>
            <div class="news_con"><?php echo isset($article) ? $article['contents'] :  '';?></div>
        </div>
        <div class="share">
            <p class="diggit"><a href="JavaScript:makeRequest('/e/public/digg/?classid=3&amp;id=19&amp;dotop=1&amp;doajax=1&amp;ajaxarea=diggnum','EchoReturnedText','GET','');"> 很赞哦！ </a>(<b id="diggnum"><script type="text/javascript" src="/e/public/ViewClick/?classid=2&id=20&down=5"></script>13</b>)</p>
        </div>
        <div class="nextinfo">
            <p>上一篇：<a href="/news/life/2018-03-13/804.html">作为一个设计师,如果遭到质疑你是否能恪守自己的原则?</a></p>
            <p>下一篇：<a href="/news/life/">返回列表</a></p>
        </div>
        <div class="news_pl">
            <h2>文章评论</h2>
            <div class="gbko">
                <script src="/e/pl/more/?classid=77&amp;id=106&amp;num=20"></script>
                <div class="fb">
                    <ul>
                        <p class="fbtime"><span>2018-07-24 11:52:38</span>dancesmile</p>
                        <p class="fbinfo">这才是我要的朋友圈</p>
                    </ul>
                </div>
                <div class="fb">
                    <ul>
                        <p class="fbtime"><span>2018-07-24 08:52:48</span> 卜野</p>
                        <p class="fbinfo"></p>
                        <div class="ecomment"><span class="ecommentauthor">网友 家蚂蚁 的原文：</span>
                            <p class="ecommenttext">坚持哟!看你每天都有写，请继续加油，再接再厉哦</p>
                        </div>
                    </ul>
                </div>

                <script>
                    function CheckPl(obj)
                    {
                        if(obj.saytext.value=="")
                        {
                            alert("您没什么话要说吗？");
                            obj.saytext.focus();
                            return false;
                        }
                        return true;
                    }
                </script>
                <form action="/e/pl/doaction.php" method="post" name="saypl" id="saypl" onsubmit="return CheckPl(document.saypl)">
                    <div id="plpost">
                        <p class="saying"><span><a href="/e/pl/?classid=77&amp;id=106">共有<script type="text/javascript" src="/e/public/ViewClick/?classid=77&amp;id=106&amp;down=2"></script>2条评论</a></span>来说两句吧...</p>
                        <p class="yname"><span>用户名:</span>
                            <input name="username" type="text" class="inputText" id="username" value="" size="16">
                        </p>
                        <p class="yzm"><span>验证码:</span>
                            <input name="key" type="text" class="inputText" size="16">
                        </p>
                        <input name="nomember" type="hidden" id="nomember" value="1" checked="checked">
                        <textarea name="saytext" rows="6" id="saytext"></textarea>
                        <input name="imageField" type="submit" value="提交">
                        <input name="id" type="hidden" id="id" value="106">
                        <input name="classid" type="hidden" id="classid" value="77">
                        <input name="enews" type="hidden" id="enews" value="AddPl">
                        <input name="repid" type="hidden" id="repid" value="0">
                        <input type="hidden" name="ecmsfrom" value="/joke/talk/2018-07-23/106.html">
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop