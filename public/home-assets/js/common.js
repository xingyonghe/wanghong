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
        // $(that).addClass('disabled').attr('autocomplete','off').prop('disabled',true);
        $.post(target,query).success(function(data){
            // $(that).removeClass('disabled').prop('disabled',false);
            if (data.status==1){

            }else{
                if(data.id){
                    showError(data.info,data.id,1);
                }
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

    //加入收藏
    $("#addFavorite").click(function (){
        var ctrl = (navigator.userAgent.toLowerCase()).indexOf('mac') != -1 ? 'Command/Cmd' : 'CTRL';
        try{
            window.external.addFavorite(window.location,document.title);
        }catch(e){
            try{
                window.sidebar.addPanel(document.title,window.location,"");
            }catch(e){
                alert('添加失败\n您可以尝试通过快捷键' + ctrl + ' + D 加入到收藏夹~');
            }
        }
    });

    //设置首页
    $("#setHome").click(function () {
        try{
            document.body.style.behavior='url(#default#homepage)';
            document.body.setHomePage(document.URL);
        }catch(e){
            if(window.netscape){
                try{
                    netscape.security.PrivilegeManager.enablePrivilege("UniversalXPConnect");
                }catch(e){
                    alert("抱歉，此操作被浏览器拒绝！\n\n请在浏览器地址栏输入“about:config”并回车然后将[signed.applets.codebase_principal_support]设置为'true'");
                }
            }else{
                alert("抱歉，您所使用的浏览器无法完成此操作。\n\n您需要手动设置为首页。");
            }
        }
    });


})