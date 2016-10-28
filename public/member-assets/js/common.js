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


    $('body').on('click','.img-see',function () {
        layer.open({
            type: 1,
            title: false,
            closeBtn: 0,
            area: ['516'],
            skin: 'layer-ext-admin', //没有背景色
            shadeClose: true,
            content: '<img src="'+$(this).attr('src')+'">',
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

    //导航高亮
     window.highlight_subnav = function(url){
         $('.sidebar-menu').find('a[href="'+url+'"]').parents('.sub-menu').addClass('open active');
         $('.sidebar-menu').find('a[href="'+url+'"]').parent().closest('li').addClass('active');
    }
})