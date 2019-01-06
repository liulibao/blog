@extends('admin.layouts.layer.app')

@section('contents')

<form action="{{url('system/role/storePermission')}}" class="form-horizontal" id="postForm">

    <input type="hidden" name="rid" value=" @if(isset($rid)){{$rid}}@endif">

    {{ csrf_field() }}

    @if(isset($menus))
    @foreach($menus as $item)
    <div class="box box-info">
        <div class="box-body with-border">
            <label>
                <input type="checkbox" value="{{$item['id']}}" name="permission[]" class="checkbox-parent checkbox-parent{{$item['id']}}" data-id="{{$item['id']}}">
                &nbsp;&nbsp;{{$item['name']}}
            </label>
        </div>

        @if(is_array($item['children']))
        <div class="box-body">
            @foreach($item['children'] as $key=>$val)
            @if($key > 0) <br /> @endif
            <label style="margin-right: 5px;">
                <input type="checkbox" value="{{$val['id']}}" name="permission[]" data-pid="{{$item['id']}}" class="checkbox-son checkbox-son{{$item['id']}}">
                &nbsp;&nbsp;{{$val['name']}}
            </label>
                @if(is_array($val['children']))
                @foreach($val['children'] as $v)
                    <label style="margin-right: 5px;">
                        <input type="checkbox" value="{{$v['id']}}" name="permission[]" data-pid="{{$item['id']}}" class="checkbox-son checkbox-son{{$item['id']}}">
                        &nbsp;&nbsp;{{$v['name']}}
                    </label>
                @endforeach
                @endif
            @endforeach
        </div>
        @endif
    </div>
    @endforeach
    @endif
    <div style="height: 35px; width: 100%;"></div>
    <div  style="margin-left: -15px;text-align: center;
    position: fixed;bottom: 0;z-index: 99;width: 100%;padding: 10px;background-color: #fff;">
        <a href="javascript:void (0);" data-back_url="{{route('admin.role')}}" data-is_confirm="false"
           class="btn btn-info submitFormBtu" >立即提交
        </a>
    </div>
</form>

@stop

@section('script')
     <script>
        //当改变全选值时
        $(".checkbox-parent").change(function(){
            var id = $(this).data('id');
            console.log(id);
            //如果全选被选中，则选中所有子选项;否则取消选中子选项
            if($(this).is(":checked")){
                $(".checkbox-son"+ id).prop("checked",true);
            }else{
                $(".checkbox-son"+ id).prop("checked",false);
            }
        });

        //当改变子选项时，那么父级被选中
        $(".checkbox-son").change(function(){
            var pid = $(this).data('pid');
            if($(this).is(":checked")){ //子级选中，父级被选中
                $(".checkbox-parent"+ pid).prop("checked",true);
            }else{ //子级全部取消，父级也被取消
                if($('.checkbox-son'+pid+':checked').length == 0){
                    $(".checkbox-parent"+ pid).prop("checked",false);
                }
            }
        });
    </script>
@stop


