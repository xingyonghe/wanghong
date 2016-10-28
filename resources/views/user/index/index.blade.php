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
</style>
@endsection
@section('script')
    <script type="text/javascript">
        $(function () {
            //ajax post请求
            $('body').on('click','.ajax-login',function(){
                var form,that,target,query;
                form = $('.data-form');
                target = form.get(0).action;
                that = this;
                query = form.serialize();
                $(that).addClass('disabled').attr('autocomplete','off').prop('disabled',true);
                $.post(target,query).success(function(data){
                    if (data.status==1){
                        $(that).removeClass('disabled').prop('disabled',false);
                        window.location = data.url;
                    }else{
                        $(that).removeClass('disabled').prop('disabled',false);
                        showError(data.info,data.id,1);
                    }
                });
                return false;
            });
        })
    </script>
@endsection
@section('content')
    <div class="row">
        <div class="span3">
            <h4>个人中心</h4>
            <div class="sidebar">
                <ul class="col-nav span3">
                    <li class="active">
                        <a href="/profile.html"><i class="pull-right icon-user"></i>基本资料</a>
                    </li>
                    <li>
                        <a href="#"> <i class="pull-right icon-cog"></i>我的账户</a>
                    </li>
                    <li>
                        <a href="#"> <i class="pull-right icon-star"></i>修改密码</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="span9">
            <h4 class="header">基本资料</h4>
            <div id="d3" style="width: 100%; margin-top: -30px"></div><br />
            <div class="span6">
                <form class="form-horizontal" />
                <div class="control-group">
                    <label for="inputEmail" class="control-label">Email </label>
                    <div class="controls">
                        <input id="inputEmail" type="text" placeholder="Email" />
                    </div>
                </div>
                <div class="control-group">
                    <label for="inputCurrentPassword" class="control-label">Current Password </label>
                    <div class="controls">
                        <input id="inputCurrentPassword" type="password" placeholder="Current Password" />
                    </div>
                </div>
                <div class="control-group">
                    <label for="inputPassword" class="control-label">Password </label>
                    <div class="controls">
                        <input id="inputPassword" type="password" placeholder="Password" />
                    </div>
                </div>
                <div class="control-group">
                    <label for="inputPasswordAgain" class="control-label">Password Again</label>
                    <div class="controls">
                        <input id="inputPasswordAgain" type="password" placeholder="Password Again" />
                    </div>
                </div>
                <div class="control-group">
                    <div class="controls">
                        <button type="submit" class="btn">Save Changes</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
@endsection


</body>
<script src="js/d3-setup.js"></script><script>protocol = window.location.protocol === 'http:' ? 'ws://' : 'wss://'; address = protocol + window.location.host + window.location.pathname + '/ws'; socket = new WebSocket(address);
    socket.onmessage = function(msg) { msg.data == 'reload' && window.location.reload() }</script>
</html>