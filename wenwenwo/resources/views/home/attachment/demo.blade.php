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




<div id="uploader" class="wu-example">
    <!--用来存放文件信息-->
    <div id="thelist" class="uploader-list"></div>
    <div class="btns">
        <div id="picker">选择文件</div>
        <button id="ctlBtn" class="btn btn-default">开始上传</button>
    </div>
</div>

<div id="lists">

</div>
<script src="//cdn.bootcss.com/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="//fex.baidu.com/webuploader/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/assets/webuploader/webuploader.js"></script>

<script>
    // 文件上传
    jQuery(function() {
        var $ = jQuery,
                $list = $('#thelist'),
                $btn = $('#ctlBtn'),
                state = 'pending',
                uploader;

        uploader = WebUploader.create({
            fileVal:"avatar",
            formData:{
                '_token':'{{ csrf_token() }}'
            },
            // 不压缩image
            resize: false,

            // swf文件路径
            swf: '/assets/webuploader/Uploader.swf',

            // 文件接收服务端。
            server: '/attachment-upload',

            // 选择文件的按钮。可选。
            // 内部根据当前运行是创建，可能是input元素，也可能是flash.
            pick: '#picker',
            accept:{
                title:'选择的类型',
                extensions:'gif,jpg,jpeg,png',
                mimeTypes: '.rar,.zip,.doc,.xls,.docx,.xlsx,.pdf'
            }
        });

        // 当有文件添加进来的时候
        uploader.on( 'fileQueued', function( file ) {
            $list.append( '<div id="' + file.id + '" class="item">' +
                    '<h4 class="info">' + file.name + '</h4>' +
                    '<p class="state">等待上传...</p>' +
                    '</div>' );
        });

        // 文件上传过程中创建进度条实时显示。
        uploader.on( 'uploadProgress', function( file, percentage ) {
            var $li = $( '#'+file.id ),
                    $percent = $li.find('.progress .progress-bar');

            // 避免重复创建
            if ( !$percent.length ) {
                $percent = $('<div class="progress progress-striped active">' +
                        '<div class="progress-bar" role="progressbar" style="width: 0%">' +
                        '</div>' +
                        '</div>').appendTo( $li ).find('.progress-bar');
            }

            $li.find('p.state').text('上传中');

            $percent.css( 'width', percentage * 100 + '%' );
        });

        uploader.on( 'uploadSuccess', function( file ,response) {
            console.log(response);
            for(var file_name in response.avatar){
                if(response.avatar[file_name].error){
                    alert(response.avatar[file_name].message);
                    $( '#'+file.id ).find('p.state').text('上传出错');
                }else{
                    alert("文件访问路径:" + response.avatar[file_name].url);
                    $( '#'+file.id ).find('p.state').text('已上传');
                }
            }
        });

        uploader.on( 'uploadError', function( file ) {
            $( '#'+file.id ).find('p.state').text('上传出错');
        });

        uploader.on( 'uploadComplete', function( file ) {
            $( '#'+file.id ).find('.progress').fadeOut();
        });

        uploader.on( 'all', function( type ) {
            if ( type === 'startUpload' ) {
                state = 'uploading';
            } else if ( type === 'stopUpload' ) {
                state = 'paused';
            } else if ( type === 'uploadFinished' ) {
                state = 'done';
            }

            if ( state === 'uploading' ) {
                $btn.text('暂停上传');
            } else {
                $btn.text('开始上传');
            }
        });

        $btn.on( 'click', function() {
            if ( state === 'uploading' ) {
                uploader.stop();
            } else {
                uploader.upload();
            }
        });
    });

</script>

</body>
</html>