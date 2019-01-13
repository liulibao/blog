jQuery(document).ready(function() {
    //获取表单所有信息
    function getElements(formId) {
        var form = document.getElementById(formId);
        if (!$(form).is('form')) {
            alert('非表单数据');
            return false;
        }

        return form;
    }

    //ajax 提议提交表单信息
    $('.submitBtu').click(function (e) {
        var _this = $(this);
        ajaxPostData(e, _this);
    });

    ajaxPostData = function (e, _this) {
        e.defaultPrevented = false;
        var back_url = $(_this).attr('back_url');
        var elements = getElements('postForm');
      // console.log(getCookie('username'));
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
                if (result.status == 1) {
                    // if (result.message) {
                    //     alert(result.message);
                    // }
                    // setCookie('username', $(elements).context.username.value, 1);
                    if (result.data['url']) {
                        window.location.href=result.data['url'];
                    }
                } else {
                    alert(result.message);
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
    };

    //enter键时触发
    $(document).keydown(function(event){
        if(event.keyCode==13){
            createKeyword('.key-word');
        }
    });

    function setCookie(name, value, timeout) {
        var d = new Date();
        d.setDate(d.getDate() + timeout);
        document.cookie = name + '=' + value + ';expires=' + d;
    }

    function getCookie(name) {
        var arr = document.cookie.split('; ');
        console.log(arr);
        for ( var i = 0; i < arr.length; i++) {
            var arr2 = arr[i].split('='); //['abc','cba']
            if (arr2[0] == name) {
                return arr2[1];
                console.log(arr2[1]);
            }
        }
        return '';
    }
});
