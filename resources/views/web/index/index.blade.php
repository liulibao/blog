@extends('web.layouts.app')

@section('title')
    @parent
    首页
@stop

@section('contents')
    <div style="background-color: #fff;margin-bottom: 10px;padding:5px 5px 0 5px;">
        <div class="slideshow-container" >
            @foreach($advert as $item)
            <div class="mySlides fades">
                <img src="{{$item['path']}}" style="width:100%">
                <div class="text">{{$item['remarks']}}</div>
            </div>
            @endforeach
            <a class="prev" onclick="plusSlides(-1)">❮</a>
            <a class="next" onclick="plusSlides(1)">❯</a>
        </div>

        <div style="text-align:center;margin: 10px;padding-bottom: 10px;">
            @foreach($advert as $key => $item)
                <span class="dot" onclick="currentSlide({{$key}})"></span>
            @endforeach
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

@section('scripts')
    <script>
        var slideIndex = 1;
        showSlides(slideIndex);

        function plusSlides(n) {
            showSlides(slideIndex += n);
        }

        function currentSlide(n) {
            showSlides(slideIndex = n);
        }

        function showSlides(n) {
            var i;
            var slides = document.getElementsByClassName("mySlides");
            var dots = document.getElementsByClassName("dot");
            if (n > slides.length) {slideIndex = 1}
            if (n < 1) {slideIndex = slides.length}
            for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";
            }
            for (i = 0; i < dots.length; i++) {
                dots[i].className = dots[i].className.replace("active", "");
            }
            slides[slideIndex-1].style.display = "block";
            dots[slideIndex-1].className += " active";
        }
    </script>
@stop
