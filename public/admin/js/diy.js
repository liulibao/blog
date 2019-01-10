var DiyJs = function() {
    //添加关键字
    addKeyword = function () {
        $('.add-keyword input').blur(function(){
            var keyword = $('input[name=keyword]').val();
            var value = $(this).val();
            if(value){
                var html =  '<span class="tag">'+
                    '<span>' +value+'</span>'+
                    '&nbsp;&nbsp;<a href="javascript:void(0);" onclick="cancelObj(this)" class="fa fa-times cancleSpan" style="color: #fff"></a>'+
                    '</span>';
                $(this).parent().before(html).end().val('');
                var keyLength = 0;
                if(keyword){
                    keyLength = keyword.split(',').length;
                }
                if(keyLength == 0){
                    $('input[name=keyword]').val(value);
                }else{
                    $('input[name=keyword]').val(keyword +','+ value);
                }
            }
        })
    };

    cancelObj = function (ele){
        var keyword = $('input[name=keyword]').val();
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
        $('input[name=keyword]').val(removeObj);
        $(ele).parent().remove();
    };

    //编辑器样式
    wangEditorStyle = function(){
        $('.w-e-text-container').css('z-index','1');
        $('.w-e-menu').css('z-index','1');
    };

    return {
        init: function () {
            addKeyword();
            wangEditorStyle();
        }
    };
}();
jQuery(function(){ DiyJs.init(); });
