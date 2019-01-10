<link href="{{asset('admin/adminlet/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('admin/adminlet/dist/css/AdminLTE.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('admin/css/form.css')}}" rel="stylesheet" type="text/css" />
<style>
    .box-body {
        font-size: 12px;
    }
    .with-border {
        border-bottom: 1px solid #f4f4f4;
    }
</style>

<div style="width: 100%;height: 100%;background-color: #f8f8f8;">
    <div class="col-xs-12" style="margin-top: 15px;">
    @yield('contents')
    </div>
</div>

<script src="{{asset('admin/adminlet/plugins/jQuery/jQuery-2.1.4.min.js')}}"></script>
<script src="{{asset('admin/adminlet/bootstrap/js/bootstrap.min.js')}}" type="text/javascript"></script>
<script src="{{asset('layui/layui.all.js')}}"></script>
<script src="{{asset('admin/js/form.js')}}"></script>
@yield('script')