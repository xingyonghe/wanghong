@extends('home.public.base')
@section('style')

@endsection
@section('script')
    <script type="text/javascript">
        $(function(){
            //发送短信验证码
            {{--$('#get-code').click(function(){--}}
                {{--var target = "{{ url('user/demand/sendSMS') }}";--}}
                {{--var mobile = $('#mobile').val();--}}
                {{--if(!mobile){--}}
                    {{--showError('请输入你要验证的手机号码','mobile');--}}
                    {{--return false;--}}
                {{--}--}}
                {{--if (!/^1[34578]{1}\d{9}$/.test(mobile)){--}}
                    {{--showError('手机号码格式错误','mobile');--}}
                    {{--return false;--}}
                {{--}--}}
                {{--var codeIntVal = 59;--}}
                {{--var timename='';--}}
                {{--var that = this;--}}
                {{--var _token = "{{csrf_token()}}";--}}
                {{--var query = {'mobile':mobile,'_token':_token};--}}
                {{--$.post(target,query).success(function(data){--}}
                    {{--if (data.status==1) {--}}
                        {{--$(that).val("重新获取(60)");--}}
                        {{--$(that).attr("disabled", true);--}}
//                        timename = setInterval(function(){
//                            $(that).val("重新获取(" + codeIntVal + ")");
//                            codeIntVal--;
//                            if (codeIntVal < 0) {
//                                codeIntVal = 59;
//                                $(that).val("获取短信验证码");
//                                $(that).removeAttr("disabled");
//                                clearInterval(timename);
//                            }
//                        }, "1000");
                    {{--}else{--}}
                        {{--showError(data.info,'mobile');--}}
                    {{--}--}}
                {{--}).error(function() {--}}
                    {{--$(that).prop('disabled',false);--}}
                    {{--alert("请求超时，请稍后再试");--}}
                {{--});--}}
                {{--return false;--}}
            {{--});--}}

            //广告主显示公司名称
            $("input[name='type']").click(function(){
                if($(this).val() == 2){
                    $('.form-company').show();
                }else{
                    $('.form-company').hide();
                }
            });

            //ajax post请求
            $('body').on('click','.ajax-register',function(){
                var form,that,target,query;
                form = $('.data-form');
                target = form.get(0).action;
                that = this;
                query = form.serialize();
                // $(that).addClass('disabled').attr('autocomplete','off').prop('disabled',true);
                $.post(target,query).success(function(data){
                    // $(that).removeClass('disabled').prop('disabled',false);
                    if (data.status==1){
                        var endtime = 5;
                        var _title = endtime+'秒后即将跳转';
                        layer.open({
                            type    : 1,
                            skin    : 'layer-ext-admin',
                            title   :  _title,
                            area    : ['450px','120px'],
                            closeBtn: 0,
                            shade   : false,
                            content : data.info,
                        });
                        timename = setInterval(function(){
                            endtime--;
                            if (endtime < 1) {
                                console.log(endtime);
                                clearInterval(timename);
                                window.location = data.url;
                                return false;
                            }
                            layer.title(endtime+'秒后即将跳转');
                        }, "1000");
                    }else{
                        if(data.id){
                            showError(data.info,data.id,1);
                        }
                    }
                });
                return false;
            });
        })
    </script>
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">注 册</div>
                <div class="panel-body">
                    <form class="form-horizontal data-form" role="form" method="POST" action="{{ route('home.register') }}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="name" class="col-md-4 control-label">注册类型</label>
                            <div class="col-md-6">
                                {!! Form::radios("type", $type, $checkd,array('autocomplete'=>'off')) !!}
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="name" class="col-md-4 control-label">手机号</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="username" id="username" autofocus autocomplete="off">
                                <input type="button" name="code" id="get-code" value="获取验证码" style="margin-top: 10px">
                                <br/>
                                <strong class="wrong" id="error-username"></strong>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="name" class="col-md-4 control-label">验证码</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="code" id="code" autocomplete="off">
                                <strong class="wrong" id="error-code"></strong>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password" class="col-md-4 control-label">密码</label>
                            <div class="col-md-6">
                                <input type="password" class="form-control" name="password" id="password" autocomplete="off">
                                <strong class="wrong" id="error-password"></strong>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">确认密码</label>
                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="off">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label">联系人</label>
                            <div class="col-md-6">
                                <input  type="email" class="form-control" name="nickname" id="nickname" autocomplete="off">
                                <strong class="wrong" id="error-nickname"></strong>
                            </div>
                        </div>

                        <div class="form-group form-company" style="display: none">
                            <label for="email" class="col-md-4 control-label">公司名称</label>
                            <div class="col-md-6">
                                <input id="company" type="text" class="form-control" name="company" autocomplete="off">
                                <strong class="wrong" id="error-nickname"></strong>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label">QQ号</label>
                            <div class="col-md-6">
                                <input id="qq" type="text" class="form-control" name="qq" autocomplete="off">
                                <strong class="wrong" id="error-qq"></strong>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label">微信号</label>
                            <div class="col-md-6">
                                <input id="weixin" type="text" class="form-control" name="weixin" autocomplete="off">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label"></label>
                            <div class="col-md-6">
                                <input type="checkbox" name="protocol" id="protocol" value="1" autocomplete="off">注册协议
                                <br/>
                                <strong class="wrong" id="error-protocol"></strong>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary ajax-register">
                                    注册
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
