<link href="{{asset('adminLET/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('adminLET/dist/css/AdminLTE.min.css')}}" rel="stylesheet" type="text/css" />
<style>
    .box-body {
        font-size: 12px;
    }
    .with-border {
        border-bottom: 1px solid #f4f4f4;
    }
    input[type=checkbox]:after  {
        content: "";
        display:block;
        width: 16px;
        height: 16px;
        text-align: center;
        line-height: 13px;
        font-size: 12px;
        color: #fff;
        border: 2px solid #ddd;
        background-color: #fff;
        box-sizing:border-box;
        cursor: pointer;
    }

    input[type=checkbox]:checked:before   {
        /*content: '\2714';*/
        /*content: '\2713';*/
        border: 1px solid #5774FF;
        /*color: #5774FF;*/
    }

    input[type=checkbox]:checked:after  {
        content: '\2714';
        /*content: '\2713';*/
        /*border: 2px solid #5774FF;*/
        color: #5774FF;
        font-weight: bold;
    }
    .minimals{
        margin-right: 2px;
    }
</style>

<div style="width: 100%;height: 100%;background-color: #f8f8f8;">
    <div class="col-xs-12" style="margin-top: 15px;">
    @yield('contents')
    </div>
</div>

<script src="{{asset('adminLET/plugins/jQuery/jQuery-2.1.4.min.js')}}"></script>
<script src="{{asset('adminLET/bootstrap/js/bootstrap.min.js')}}" type="text/javascript"></script>
<script src="{{asset('layui/layui.all.js')}}"></script>
<script src="{{asset('js/admin/form.js')}}"></script>
@yield('script')