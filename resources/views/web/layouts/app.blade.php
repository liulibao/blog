<html>
<head>
    <meta http-equiv="Content-Type" content="text/html:charset=UTF-8">
    <title>LovYa - @yield('title', '个人博客')</title>
    <meta name="keywords" content="@yield('keywords','学习框架,laravel,php,java,mysql....')" />
    <meta name="description" content="@yield('description','LoaYa个人博客,技术分享,技术学习')" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link href="{{asset('css/font-awesome.css')}}" rel="stylesheet">
    <link href="{{asset('web/css/base.css')}}" rel="stylesheet">
    <link href="{{asset('web/css/index.css')}}" rel="stylesheet">
    <link href="{{asset('web/css/m.css')}}" rel="stylesheet">
    @yield('styles')

</head>

<body>

    @include('web.layouts._header')

    @yield('diary')
    <article>
        <main class="r_box">
            @yield('contents')
        </main>

        @if (getCurrentUrl() != 'diary')
        <aside class="l_box">
            @include('web.layouts._right')
        </aside>
        @endif
    </article>

    @include('web.layouts._footer')
</body>

<script type="text/javascript" src="{{asset('web/js/jquery.min.js')}}"></script>
<script type="text/javascript" src="{{asset('layui/layui.all.js')}}"></script>
<script type="text/javascript" src="{{asset('web/js/common.js')}}"></script>
<script type="text/javascript" src="{{asset('js/bootstrap.js')}}"></script>
<!--[if lt IE 9]>
<script src="{{asset('web/js/modernizr.js')}}"></script>
<![endif]-->
@yield('scripts')
</html>
