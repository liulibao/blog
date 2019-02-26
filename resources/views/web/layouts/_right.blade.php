<style>
    .data-info ul{
        width: 100%;
        height: auto;
        display: flex;
        padding:5px 0;
        flex-direction: row;
        font-size: 12px;
    }
    .data-info  ul li{
        height: 45px;
        flex: 1;
    }
    .data-info  ul li strong {
        display: block;
        text-align: center;
    }

    .data-info ul li span {
        display: block;
        text-align: center;
    }
    .lable {
        display: inline-block;
        background: #ff4200;
        height: 15px;
        line-height: 14px;
        font-size: 12px;
        padding: 2px 5px;
        color: #fff;
        border-radius: 5px;
        -webkit-border-radius: 5px;
        font-weight: normal;
    }
</style>
{{--<div class="web-author" style="animation-name: floatAll; animation-duration: 1.14286s;">--}}
    {{--<div class="author-tx">--}}
        {{--<a class="img-circle" href="" title="点击查看详细信息">--}}
            {{--<img class="img-circle" src="http://www.lovya.cn/static/web/images/tag.jpg">--}}
        {{--</a>--}}
    {{--</div>--}}
    {{--<div class="author-name"><span class="blue-text"> lovya </span><p>一位草根码农</p></div>--}}
{{--</div>--}}
<div class="about_me">
    <h2><i class="fa fa-hand-o-right"></i>关于我<small>About Me</small></h2>
    <ul>
        <li><span><img src="http://www.lovya.cn/static/web/images/tag.jpg"></span></li>
        <li>
            <p><b>杨青</b>，一个80后草根女站长！09年入行。一直潜心研究web前端技术，一边工作一边积累经验，分享一些个人博客模板，以及SEO优化等心得。</p>
        </li>
    </ul>
</div>

<div class="data-info">
    <h2><i class="fa fa-line-chart"></i>今日统计<small>Daily Count</small></h2>
    <ul>
        {{--<li>--}}
        {{--<strong>0</strong>--}}
        {{--<span>今日会员</span>--}}
        {{--</li>--}}
        <li>
            <strong>{{$system_count}}</strong>
            <span>累计访问量</span>
        </li>
        <li>
            <strong>{{$day_count}}</strong>
            <span>今日访客</span>
        </li>
    </ul>
</div>

{{--<div class="search">--}}
    {{--<form action="" method="post" name="searchform" id="searchform">--}}
        {{--<input name="keyboard" id="keyboard" class="input_text" title="" value="请输入关键字词" style="color: rgb(153, 153, 153);" onfocus="if(value=='请输入关键字词'){this.style.color='#000';value=''}" onblur="if(value==''){this.style.color='#999';value='请输入关键字词'}" type="text">--}}
        {{--<input name="show" value="title" type="hidden">--}}
        {{--<input name="tempid" value="1" type="hidden">--}}
        {{--<input name="tbname" value="news" type="hidden">--}}
        {{--<input name="Submit" class="input_submit" value="搜索" type="submit">--}}
    {{--</form>--}}
{{--</div>--}}

@if($last_article)
<div class="recommend">
    <h2><i class="fa fa-refresh"></i>最新更新<small>Close New</small></h2>
    <ul>
    @foreach($last_article as $k => $item)
        <li><a href="{{url('article/detail', ['id' => $item['id']])}}">{{$item['title']}}</a>
            @if($k == 0) <span class="lable">更新</span> @endif
        </li>
    @endforeach
    </ul>
</div>
@endif

{{--<div class="my-picture">--}}
    {{--<h2><i class="fa fa-picture-o"></i>我的相册<small>My Photo</small></h2>--}}
    {{--<ul>--}}
        {{--<li><a href="/"><img src="{{asset('web/images/7.jpg')}}"></a></li>--}}
        {{--<li><a href="/"><img src="{{asset('web/images/8.jpg')}}"></a></li>--}}
        {{--<li><a href="/"><img src="{{asset('web/images/9.jpg')}}"></a></li>--}}
        {{--<li><a href="/"><img src="{{asset('web/images/10.jpg')}}"></a></li>--}}
        {{--<li><a href="/"><img src="{{asset('web/images/11.jpg')}}"></a></li>--}}
        {{--<li><a href="/"><img src="{{asset('web/images/12.jpg')}}"></a></li>--}}
    {{--</ul>--}}
{{--</div>--}}

{{--<div class="article-type">--}}
    {{--<h2><i class="fa fa-flag"></i>文章分类 <small>Article Class</small></h2>--}}
    {{--<ul>--}}
        {{--<li><a href="/">学无止境（33）</a></li>--}}
        {{--<li><a href="/">日记（19）</a></li>--}}
        {{--<li><a href="/">慢生活（520）</a></li>--}}
        {{--<li><a href="/">美文欣赏（40）</a></li>--}}
    {{--</ul>--}}
{{--</div>--}}

@if($recommend_article)
<div class="recommend">
    <h2><i class="fa fa-list-alt"></i>站长推荐<small>Push Article</small></h2>
    <ul>
    @foreach($recommend_article as $k => $item)
        <li>
            <a href="{{url('article/detail', ['id' => $item['id']])}}">{{$item['title']}}</a>
        </li>
    @endforeach
    </ul>
</div>
@endif

{{--<div class="cloud">--}}
    {{--<h2><i class="fa fa-tags"></i>标签云</h2>--}}
    {{--<ul>--}}
        {{--<li><a href="/">陌上花开(5)</a></li>--}}
        {{--<li><a href="/">索尼</a></li>--}}
        {{--<li><a href="/">校园生活</a></li>--}}
        {{--<li><a href="/">html5</a></li>--}}
        {{--<li><a href="/">SumSung</a></li>--}}
        {{--<li><a href="/">三星</a></li>--}}
        {{--<li><a href="/">华维荣耀</a></li>--}}
        {{--<li><a href="/">青春</a></li>--}}
        {{--<li><a href="/">索尼</a></li>--}}
        {{--<li><a href="/">三星</a></li>--}}
        {{--<li><a href="/">阳光</a></li>--}}
        {{--<li><a href="/">温暖</a></li>--}}
    {{--</ul>--}}
{{--</div>--}}

{{--<div class="links">--}}
    {{--<h2><i class="fa fa-link"></i>友情链接 <small>Friend Links</small></h2>--}}
    {{--<ul>--}}
        {{--<a href="http://www.yangqq.com">杨青个人博客</a> <a href="http://www.yangqq.com">杨青博客</a>--}}
    {{--</ul>--}}
{{--</div>--}}

{{--<div class="attention">--}}
    {{--<h2><i class="fa fa-heart"></i>关注我<small>Focus Me</small></h2>--}}
    {{--<ul>--}}
        {{--<img src="{{asset('web/images/wx.jpg')}}">--}}
    {{--</ul>--}}
{{--</div>--}}
