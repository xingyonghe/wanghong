@extends('user.public.base')
@section('style')
<style type="text/css">
    .col-nav .active{
        background: #EEE;
    }
    .span6 input{
        height: 30px;
        padding: 4px 6px;
        font-size: 14px;
        line-height: 20px;
        color: #555555;
        border-radius: 4px;
    }
    input[disabled], select[disabled], textarea[disabled], input[readonly], select[readonly], textarea[readonly] {
        background-color: #fff;
        cursor:default;
    }
</style>
@endsection
@section('script')
    <script type="text/javascript" src="{{ asset('public-static/plupload/plupload.full.min.js') }}"></script>
    <script type="text/javascript">
        $(function () {
            highlight_subnav("{{ route('user.star.add') }}");


            //头像上传
            var photo = new plupload.Uploader({
                browse_button : 'photo', //触发文件选择对话框的按钮，为那个元素id
                url : "{{ route('picture.avatar') }}", //服务器端的上传页面地址
                multipart_params:{
                    '_token' : "{{ csrf_token() }}",
                },
                filters : {
                    max_file_size : '4mb',
                    mime_types: [
                        {title : "Image files", extensions : "jpg,gif,png,jpeg"}
                    ],
                    prevent_duplicates:false //不允许选取重复文件
                },
                init: {
                    //添加
                    FilesAdded: function(up, files) {
                        $('.img').html("");
                        photo.start();
                    },
                    //每个队列上传完成
                    FileUploaded: function(up,file,resault) {
                        var res = $.parseJSON(resault.response);
                        console.log(res);
                        if(!res.status){
                            showError(res.info,'avatar',0);
                            uploader.removeFile(file.id);
                        }else{
                            var loading = "{{ asset('/public-static/loading.gif') }}";
                            $('.img').css("background","#d9d9d9 url("+loading+") no-repeat center");
                            $('.img').css("background-size","20px 20px").show();
                            setTimeout(function(){
                                $('.img').html("<img src='"+res.file.small+"'>");
                                $('.img').prev('input').val(res.file.id);
                            }, 1100);
                        }
                    },
                    Error : function(up, error) {
                        showError(error.message,'avatar',0);
                    },
                },
            });
            //在实例对象上调用init()方法进行初始化
            photo.init();
        })
    </script>
@endsection
@section('content')
    <div class="row">
        <div class="span3">
            <h4>个人中心</h4>
            <div class="sidebar">
                <ul class="col-nav span3">
                    <li>
                        <a href="{{ route('user.star.add') }}"><i class="pull-right icon-user"></i>新增网红</a>
                    </li>
                    <li>
                        <a href="{{ route('user.star.index') }}"> <i class="pull-right icon-cog"></i>网红管理</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="span9">
            <h4 class="header">新增网红</h4>
            <div id="d3" style="width: 100%; margin-top: -30px"></div><br />
            <div class="span6">
                <form class="form-horizontal data-form" action="{{ route('user.star.update') }}" metho="POST"/>
                    {{ csrf_field() }}
                    <div class="control-group">
                        <label for="inputCurrentPassword" class="control-label">头像： </label>
                        <div class="controls">
                            <input type="hidden" name="avatar" class="input-img" value="" id="avatar">
                            <div class="img" style="width: 60px;height: 60px;background: #d9d9d9 ;">
                                <img src="/member-assets/img/default.jpg" width="60" height="60" id="photo"/>
                            </div>
                            <strong class="wrong" id="error-avatar"></strong>
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="inputEmail" class="control-label">昵称： </label>
                        <div class="controls">
                            <input id="username" type="text" name="username" placeholder="请输入网昵称" value="" />
                            <strong class="wrong" id="error-username"></strong>
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="inputCurrentPassword" class="control-label">资源类别： </label>
                        <div class="controls">
                            {!! Form::radios("type", [1=>'直播',2=>'短视频'], 1,array('autocomplete'=>'off')) !!}
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="inputPassword" class="control-label">直播平台： </label>
                        <div class="controls">
                            {!! Form::select("platform_select", $mediaType, 0,array('autocomplete'=>'off','id'=>'platform')) !!}
                            <input id="platform" type="text" name="platform" placeholder="如果没有可选择的，可以在此输入" value="" />
                            <strong class="wrong" id="error-platform"></strong>
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="inputEmail" class="control-label">房间号： </label>
                        <div class="controls">
                            <input id="room_id" type="text" name="room_id" placeholder="请输入直播平台房间号" value=""/>
                            <strong class="wrong" id="error-room_id"></strong>
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="inputPasswordAgain" class="control-label">平台ID：</label>
                        <div class="controls">
                            <input id="homepage" type="text" name="homepage" placeholder="请输入直播平台平台ID号" value=""/>
                            <strong class="wrong" id="error-homepage"></strong>
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="inputPasswordAgain" class="control-label">展现形式及报价：</label>
                        <div class="controls">
                            <textarea name="form_money" id="form_money" placeholder="请输入展现形式及报价:线下活动:10000"></textarea>
                            <strong class="wrong" id="error-form_money"></strong>
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="inputEmail" class="control-label">粉丝数： </label>
                        <div class="controls">
                            <input id="fan" type="text" name="fan" placeholder="请输入粉丝数" value=""/>
                            <strong class="wrong" id="error-fan"></strong>
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="inputEmail" class="control-label">直播平均人数： </label>
                        <div class="controls">
                            <input id="online" type="text" name="online" placeholder="请输入直播平均人数" value=""/>
                            <strong class="wrong" id="error-online"></strong>
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="inputEmail" class="control-label">主播风格： </label>
                        <div class="controls">
                            <input id="manner" type="text" name="manner" placeholder="请输入主播风格" value=""/>
                            <strong class="wrong" id="error-manner"></strong>
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="controls">
                            <button class="btn ajax-post" type="submit" >保 存</button>
                            <button class="btn" onclick="javascript:history.back(-1);return false;" >返 回</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection