$(function(){
    /**
     * 管理后台公用JS
     */
    //自定义弹出层样式
    layer.config({
        extend:'../../public-static/layer/skin/admin/style.css'
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
            if (data.status==1){
                $(that).removeClass('disabled').prop('disabled',false);
                layer.open({
                    type    : 1,
                    skin    : 'layer-ext-admin',
                    closeBtn: 1,
                    title   : '消息提醒',
                    area    : ['650px'],
                    btn     : ['确定', '取消'],
                    shade   : false,
                    content : data.info,
                    time    : 3000,
                    yes     : function (index) {
                        window.location = data.url;
                    },
                    end     : function (index) {
                        window.location = data.url;
                    }
                });
            }else{
                $(that).removeClass('disabled').prop('disabled',false);
                showError(data.info,data.id,1);
            }
        });
        return false;
    });

    //删除确认
    $('body').on('click','.ajax-confirm',function(){
        layer.closeAll();
        var target = $(this).attr('url');
        if($(this).hasClass('destroy')){
            confirmDialog('确认要删除该信息吗?',target);
        }
        return false;
    });


    /**
     * 确认提示弹出层(上下架信息)
     * @author xingyonghe
     * @param msg 提示语
     * @param url 交互跳转地址
     */
    window.confirmDialog = function(msg,target){
        layer.open({
            type    : 1,
            skin    : 'layer-ext-admin',
            closeBtn: 1,
            title   : '消息提醒',
            area    : ['450px'],
            btn     : ['确定', '取消'],
            shade   : false,
            content : msg,
            yes     : function(index){
                layer.close(index);
                $.get(target,function(data){
                    layer.open({
                        type    : 1,
                        skin    : 'layer-ext-admin',
                        closeBtn: 1,
                        title   : '消息提醒',
                        area    : ['650px'],
                        btn     : ['确定', '取消'],
                        shade   : false,
                        content : data.info,
                        time    : 3000,
                        yes     : function(index){
                            layer.close(index);
                            if(data.url){
                                window.location = data.url;
                            }
                        },
                        end     : function(index){
                            layer.close(index);
                            if(data.url){
                                window.location = data.url;
                            }
                        }
                    });
                },'json');
            }
        });
    }

    //导航高亮
     window.highlight_subnav = function(url){
         $('.col-nav').find('a[href="'+url+'"]').parents('li').addClass('active');
    }

    /**
     * 提示错误信息
     * @param msg 错误信息内容
     * @param obj 生成错误的HTML元素对象，如果生成错误对象的是一个input,textarea，需要聚焦，其他都根据对象定位
     * @param scroll 是否滚动定位/聚焦 1:是0:非
     */
    window.showError = function(msg,obj,scroll){
        var nodeName,Obj,ErrorObj;
        // alert(obj);return false;
        Obj      = $('#'+obj);//html对象
        ErrorObj = $('#error-'+obj);//提示html对象
        nodeName = Obj.get(0).nodeName;
        scroll   = scroll ? scroll : 1;

        $('.wrong').html('');//清空页面所有错误信息
        ErrorObj.html(msg);//显示最新的错误信息

        //判断是否是日期插件
        if(Obj.hasClass('date_pick_input')){
            if(scroll == 1){
                //页面自动滚动到提示错误的对象的偏移量的top处
                $('body,html').animate({scrollTop: Obj.offset().top-250},500,'swing',function(){});
            }
        }else{
            if(scroll == 1){
                if( nodeName == 'INPUT' || nodeName == 'TEXTAREA'){
                    //自动聚焦
                    Obj.focus();
                }else{
                    //页面自动滚动到提示错误的对象的偏移量的top处
                    $('body,html').animate({scrollTop: Obj.offset().top-250},500,'swing',function(){});
                }
            }
        }
    }
})