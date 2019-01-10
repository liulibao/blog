jQuery(document).ready(function() {
    //ajax 提议提交表单信息
    $('.submitBtu').click(function (e) {
        e.defaultPrevented = false;
        var _this = $(this);
        var back_url = $(this).attr('back_url');
        var elements = getElements('postForm');
        $.ajax({
            url : $(elements).attr('action'),
            type : 'POST',
            dataType : 'json',
            data : $(elements).serialize(),
            beforeSend : function () { //操作之前执行
                _this.children('i').addClass('fa-refresh fa-spin');
                _this.attr("disabled", true);
            },
            success : function (result) {
                if (result.code == 1) {
                    if (result.msg) {
                        alert(result.msg);
                    }
                    if (result.url) {
                        window.location.href=result.url;
                    }
                    if (back_url != null && back_url !== 'undefined') {
                        window.location.href = back_url;
                    }

                } else {
                    if (result.msg instanceof Object) {
                        $.each(result.msg , function (index, value) {
                            alert(value);
                        });
                    } else {
                        alert(result.msg);
                    }
                    return false;
                }
            },
            complete: function () {//完成响应之后操作
                _this.children('i').removeClass('fa-refresh fa-spin');
                _this.attr("disabled",false);
            },
            error : function () {
                alert('服务器繁忙');return false;
            }
        });
    });

    //获取表单所有信息
    function getElements(formId) {
        var form = document.getElementById(formId);
        if (!$(form).is('form')) {
            alert('非表单数据');
            return false;
        }

        return form;
    }

    //ajax get 提交
    $('.submitGet').click(function (){
        var url = $(this).attr('data-url');
        var id = $(this).attr('data-id');
        $.get(url,{'id':id},function (result){
            if (result.code == '1') {
                window.location.reload();
            } else {
                alert(result.msg);
            }
        },'json');
    });

    //AJAX  GET提交删除操作
    $('.submitDelGet').click(function (){
        var url = $(this).attr('data-url');
        var id = $(this).attr('data-id');
        if(confirm('你确定要删除该条(ID:'+id+')记录吗')){
            $.get(url,{'id':id},function (result){
                if (result.code == '1') {
                    window.location.reload();
                } else {
                    alert(result.msg);
                }
            },'json');
        }
    });

    // AJAX post 提交checked 数据
    $('.submitCheckedBtu').click(function(e){
        e.defaultPrevented = false;

        var checked_name = $(this).attr('data-checked-name');
        var back_url = $(this).attr('back_url');
        var elements = getElements('postForm');
        var select_id = $("input[name=select_id]").val();
        var csrf_token =  $('input[name=_token]').val();
        var ids=[];
        $("input[name='"+checked_name+"']:checked").each(function(){
            ids.push($(this).val());
        });
        var ids_str = ids.join(',');
        console.log(ids_str);
        $.ajax({
            url: $(elements).attr('action'),
            type: 'post',
            data: {'_token':csrf_token,post_ids:ids_str,sel_id:select_id},
            timeout: 15000,
            dataType: 'json',
            success: function (ret) {
                console.log(ret);
                if (ret.code == 1) {
                    if (back_url != null && back_url !== 'undefined') {
                        window.location.href = back_url;
                    } else {
                       window.location.reload();
                    }
                } else {

                    alert(ret.msg);
                }
            },
            error: function () {
                alert('服务器繁忙');
            }
        });
    });

    //添加关键字
    $('.key-word').blur(function(){
        createKeyword(this);
    });

    //enter键时触发
    $(document).keydown(function(event){
        if(event.keyCode==13){
            createKeyword('.key-word');
        }
    });

    //生成小标签
    createKeyword = function (ele){
        var saveIdName = $(ele).parent().attr('data-save-id');
        var limits = $(ele).parent().attr('data-limit-num');
        var keyword = document.getElementById("keywords").value;
        var value = $(ele).val().replace(/\s+/g,"");//去掉两边的空格
        if(value){
            var html =  '<span class="tag">'+
                '<span>' +value+'</span>'+
                '&nbsp;&nbsp;'+
                '<a href="javascript:void(0);" onclick="cancelObj(this)" data-id="'+ saveIdName +'" class="fa fa-close" style="color: #fff"></a>'+
                '</span>';
            var keyLength = 0;
            if(keyword){
                keyLength = keyword.split(',').length;
            }
            if(keyLength < limits){
                $(ele).parent().before(html).end().val('');
                if(keyLength == 0){
                    $('#'+saveIdName).val(value);
                }else{
                    $('#'+ saveIdName).val(keyword +','+ value);
                }
            } else {
                $(ele).val('');
                alert('最多就能生成'+ limits +'个标签');
            }

        }
    };

    //删除关键字
    cancelObj = function (ele){
        var saveIdName = $(ele).attr('data-id');
        var keyword = $('#'+ saveIdName).val();
        var str = $(ele).prev().html();
        var arr = keyword.split(',');
        var keyLength = arr.length;
        var reg;
        if(keyLength == 1){//只有一个的时候
            reg = new RegExp(str);
        }else{
            if(arr[0] == str){//第一个
                reg = new RegExp(str+',');
            }else if(keyLength){//最后一个
                reg = new RegExp(','+str);
            }else{//中间随意
                reg = new RegExp(str+',');
            }
        }
        var removeObj = keyword.replace(reg,'');
        $('#'+ saveIdName).val(removeObj);
        $(ele).parent().remove();
    };

    //js部分,点击占位图进行文件选择
    $('#uploadImg').on('click',function(){
        if($(this).is('img-btu')) {
            $(this).removeClass('img-marin');
        } else {
            $(this).parent().prev('div').addClass('show-box');
            $(this).addClass('img-marin');
        }
        $('#chooseFile').trigger('click');
        uploadImg('#chooseFile');
    });

    /**
     *上传照片
     * @param ele 触发对象
     */
    uploadImg = function(ele){
        $(ele).on('change', function (event) {
            var jump_url = $(this).attr('data-jump-url');
            var save_class = $(this).attr('data-save-class');
            var show_class = $(this).attr('data-show-class');
            var csrf_token = $('input[name=_token]').val();

            // 允许上传的图片类型
            var allowTypes = ['image/jpg', 'image/jpeg', 'image/png', 'image/gif'];
            var maxSize = 4096 * 4096; // 图片大小限制
            var maxWidth = 300; // 图片最大宽度
            var files = event.target.files;
            if (files.length === 0)  return; // 如果没有选中文件，直接返回
            for ( var i = 0, len = files.length; i < len; i++) {
                var file = files[i];
                var reader = new FileReader();
                // 如果类型不在允许的类型范围内
                if (allowTypes.indexOf(file.type) === -1) { alert('该类型不允许上传'); continue; }
                if (file.size > maxSize) { alert('图片太大,不允许上传'); continue;}

                reader.onload = function (e) {
                    var img = new Image();
                    img.onload = function () {
                        // 不要超出最大宽度
                        var w = Math.min(maxWidth, img.width);
                        // 高度按比例计算
                        var h = img.height * (w / img.width);
                        var canvas = document.createElement('canvas');
                        var ctx = canvas.getContext('2d');
                        // 设置 canvas 的宽度和高度
                        canvas.width = w;
                        canvas.height = h;
                        ctx.drawImage(img, 0, 0, w, h);
                        var base64 = canvas.toDataURL('image/png');
                        // 插入到预览区
                        $('.'+ show_class).attr('src', base64);
                        $.ajax({
                            url: jump_url,
                            type: 'post',
                            data: {'_token':csrf_token,images:base64},
                            timeout: 15000,
                            dataType: 'json',
                            success: function (ret) {
                                if (ret.code) {
                                    var new_url= ret.url;
                                    $('.'+ save_class).val(new_url);
                                } else {
                                    alert(ret.msg);
                                }
                            },
                            error: function () {
                                alert('服务器繁忙');
                            }
                        });
                    };

                    img.src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        });
    };

    //弹层显示
    $('.layerButton').click(function (){
        var select_id = $(this).attr('data-id');
        var $divLayer = $('div .layer');

        $("input[name=select_id]").val(select_id);
        if($divLayer.is('.layer-hidden')){
            $divLayer.removeClass('layer-hidden').addClass('layer-show');
        }
    });
    $('div .layer-close').click(function (){
        var $divLayer = $('div .layer');
        if($divLayer.is('.layer-show')){
            $divLayer.removeClass('layer-show').addClass('layer-hidden');
            window.location.reload();
        }
    });


    //实现全选与反选 checked
    $("#allAndNotAll").click(function() {
        var _this = $(this);
        var selectStatus = _this.attr('data-value');
        var checkedName = _this.attr('data-names');
        if (selectStatus == 'false'){
            _this.attr('data-value',"true");
            $("input[name='"+checkedName+"']:checkbox").each(function(){
                $(this).prop("checked", true);
            });
        } else {
            _this.attr('data-value','false');
            $("input[name='"+checkedName+"']:checkbox").each(function() {
                $(this).prop("checked", false);
            });
        }
    });

    /******************* 一下内容没有用的部分，可以作为学习******************************/
    //获取指定form中的所有的<input>对象
    function getElement(formId) {
        var form = document.getElementById(formId);
        var elements = new Array();
        var tagElements = form.getElementsByTagName('input');
        for (var j = 0; j < tagElements.length; j++){
            elements.push(tagElements[j]);
        }
        return form;
    }

    //获取单个input中的【name,value】数组
    function inputSelector(element) {
        if (element.checked)
            return [element.name, element.value];
    }

    function input(element) {
        switch (element.type.toLowerCase()) {
            case 'submit':
            case 'hidden':
            case 'password':
            case 'text':
                return [element.name, element.value];
            case 'checkbox':
            case 'radio':
                return inputSelector(element);
        }
        return false;
    }

    //组合URL
    function serializeElement(element) {
        var method = element.tagName.toLowerCase();
        var parameter = input(element);

        if (parameter) {
            var key = encodeURIComponent(parameter[0]);
            if (key.length == 0) return;

            if (parameter[1].constructor != Array)
                parameter[1] = [parameter[1]];

            var values = parameter[1];
            var results = [];
            for (var i=0; i<values.length; i++) {
                results.push(key + '=' + encodeURIComponent(values[i]));
            }
            return results.join('&');
        }
    }

    //调用方法
    function serializeForm(formId) {
        var elements = getElements(formId);

        var queryComponents = new Array();

        for (var i = 0; i < elements.length; i++) {
            var queryComponent = serializeElement(elements[i]);
            if (queryComponent)
                queryComponents.push(queryComponent);
        }

        return queryComponents.join('&');
    }

});
