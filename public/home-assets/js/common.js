$(function(){
    /**
     * 前台公用JS
     */
    //自定义弹出层样式
    layer.config({
        extend:'../../public-static/layer/skin/admin/style.css'
    });


    //删除确认
    $('body').on('click','.ajax-confirm',function(){
        layer.closeAll();
        var target = $(this).attr('href');
        if($(this).hasClass('destroy')){
            confirmDialog('确认要删除该信息吗?',target);
        }
        if($(this).hasClass('forbid')){
            confirmDialog('确认要禁用该信息吗?',target);
        }
        if($(this).hasClass('resume')){
            confirmDialog('确认要启用该信息吗?',target);
        }

        return false;
    });

    //ajax get请求
    $('.ajax-get').click(function(){
        var target = $(this).attr('href');
        var that = this;
        $.get(target).success(function(data){
            layer.open({
                type    : 1,
                skin    : 'layer-ext-admin',
                closeBtn: 1,
                title   : '消息提醒',
                area    : ['650px'],
                btn     : ['确定', '取消'],
                shade   : false,
                content : data.info,
            });
            // console.log(data);
            // if (data.status==1) {
            //     if (data.url) {
            //         updateAlert(data.info + ' 页面即将自动跳转~','alert-success');
            //     }else{
            //         updateAlert(data.info,'alert-success');
            //     }
            //     setTimeout(function(){
            //         if (data.url) {
            //             location.href=data.url;
            //         }else if( $(that).hasClass('no-refresh')){
            //             $('#top-alert').find('button').click();
            //         }else{
            //             location.reload();
            //         }
            //     },1500);
            // }else{
            //     updateAlert(data.info);
            //     setTimeout(function(){
            //         if (data.url) {
            //             location.href=data.url;
            //         }else{
            //             $('#top-alert').find('button').click();
            //         }
            //     },1500);
            // }
        });
        return false;
    });

    //ajax post请求
    $('body').on('click','.ajax-post',function(){
        var form,that,target,query;
        form = $('.data-form');
        target = form.get(0).action;
        that = this;
        query = form.serialize();
        $(that).addClass('disabled').attr('autocomplete','off').prop('disabled',true);
        $.post(target,query).success(function(data){
            $(that).removeClass('disabled').prop('disabled',false);
            if (data.status==1){

            }else{

            }
        });
        return false;
    });




    /**
     * 确认提示弹出层(上下架信息)
     * @author xingyonghe
     * @param msg 提示语
     * @param url 交互跳转地址
     */
    window.confirmDialog = function(msg,url){
        layer.open({
            type    : 1,
            skin    : 'layer-ext-admin',
            closeBtn: 1,
            title   : '消息提醒',
            area    : ['450px'],
            btn     : ['确定', '取消'],
            shade   : false,
            content : msg,
            time    : 20000,
            yes     : function(){
                window.location = url;
            }
        });
    }


})