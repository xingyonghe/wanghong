<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible"content="IE=10; IE=9; IE=8; IE=7; IE=EDGE">
    <title>jQuery File Upload Example</title>

    <link rel="stylesheet" type="text/css" href="//fex.baidu.com/webuploader/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="//fex.baidu.com/webuploader/css/bootstrap-theme.min.css">
    <link rel="stylesheet" type="text/css" href="//fex.baidu.com/webuploader/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="//fex.baidu.com/webuploader/css/syntax.css">
    <link rel="stylesheet" type="text/css" href="//fex.baidu.com/webuploader/css/style.css">

    <!--common-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="/assets/js/html5shiv.js"></script>
    <script src="/assets/js/respond.min.js"></script>
    <![endif]-->

    <link rel="stylesheet" type="text/css" href="/assets/webuploader/webuploader.css">
</head>
<body>

<div id="uploader-demo">
    <!--用来存放item-->
    <div id="fileList" class="uploader-list"></div>
    <div id="filePicker">选择图片</div>
</div>

<div id="lists">

</div>
<script src="//cdn.bootcss.com/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="//fex.baidu.com/webuploader/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/assets/webuploader/webuploader.js"></script>

<script>
    // 图片上传demo
    jQuery(function() {
        var $ = jQuery,
                $list = $('#fileList'),
                // 优化retina, 在retina下这个值是2
                ratio = window.devicePixelRatio || 1,

                // 缩略图大小
                thumbnailWidth = 100 * ratio,
                thumbnailHeight = 100 * ratio,

                // Web Uploader实例
                uploader;

        // 初始化Web Uploader
        uploader = WebUploader.create({
            fileVal:"avatar",
            formData:{
                '_token':'{{ csrf_token() }}'
            },
            // 自动上传。
            auto: true,

            // swf文件路径
            swf: '/assets/webuploader/Uploader.swf',

            // 文件接收服务端。
            server: '/admin/upload/upload',

            // 选择文件的按钮。可选。
            // 内部根据当前运行是创建，可能是input元素，也可能是flash.
            pick: '#filePicker',

            // 只允许选择文件，可选。
            accept: {
                title: 'Images',
                extensions: 'gif,jpg,jpeg,bmp,png',
                mimeTypes: 'image/*'
            }
        });

        // 当有文件添加进来的时候
        uploader.on( 'fileQueued', function( file ) {
            var $li = $(
                            '<div id="' + file.id + '" class="file-item thumbnail">' +
                            '<img>' +
                            '<div class="info">' + file.name + '</div>' +
                            '</div>'
                    ),
                    $img = $li.find('img');

            $list.append( $li );

            // 创建缩略图
            uploader.makeThumb( file, function( error, src ) {
                if ( error ) {
                    $img.replaceWith('<span>不能预览</span>');
                    return;
                }

                $img.attr( 'src', src );
            }, thumbnailWidth, thumbnailHeight );
        });

        // 文件上传过程中创建进度条实时显示。
        uploader.on( 'uploadProgress', function( file, percentage ) {
            var $li = $( '#'+file.id ),
                    $percent = $li.find('.progress span');

            // 避免重复创建
            if ( !$percent.length ) {
                $percent = $('<p class="progress"><span></span></p>')
                        .appendTo( $li )
                        .find('span');
            }

            $percent.css( 'width', percentage * 100 + '%' );
        });

        // 文件上传成功，给item添加成功class, 用样式标记上传成功。
        uploader.on( 'uploadSuccess', function( file ,response) {
            console.log(response);
            for(var file_name in response.avatar){
                if(response.avatar[file_name].error){
                    alert(response.avatar[file_name].message);
                    $( '#'+file.id ).find('p.state').text('上传出错');
                }else{
                    alert("文件访问路径:" + response.avatar[file_name].url);
                    $( '#'+file.id ).addClass('upload-state-done');
                }
            }
        });

        // 文件上传失败，现实上传出错。
        uploader.on( 'uploadError', function( file ) {
            var $li = $( '#'+file.id ),
                    $error = $li.find('div.error');

            // 避免重复创建
            if ( !$error.length ) {
                $error = $('<div class="error"></div>').appendTo( $li );
            }

            $error.text('上传失败');
        });

        // 完成上传完了，成功或者失败，先删除进度条。
        uploader.on( 'uploadComplete', function( file ) {
            $( '#'+file.id ).find('.progress').remove();
        });
    });

</script>

</body>
</html>