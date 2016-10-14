@extends('admin.public.base')
@section('style')
@stop
@section('script')
    <script type="text/javascript">
        $(function () {
            highlight_subnav("{{ url('admin/personal/index') }}");
        })
    </script>
@stop
@section('body')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                编辑用户信息
            </header>
            <div class="panel-body">
                <div class=" form">
                    {!! Form::open(['url' => 'admin/personal/post','class'=>'cmxform form-horizontal tasi-form form-datas','autocomplete'=>'off']) !!}
                    <div class="form-group ">
                        <label for="cname" class="control-label col-lg-2">用户名</label>
                        <div class="col-lg-10">
                            <input name="username" value="{{ $info->username }}" type="hidden"/>
                            {{ $info->username }}
                        </div>
                    </div>
                    <div class="form-group ">
                        <label for="cname" class="control-label col-lg-2">联系人</label>
                        <div class="col-lg-10">
                            <input class=" form-control" placeholder="联系人名称" name="nickname" type="text" value="{{ $info->nickname }}" />
                        </div>
                    </div>
                    <div class="form-group ">
                        <label for="curl" class="control-label col-lg-2">QQ号码</label>
                        <div class="col-lg-10">
                            <input class="form-control " placeholder="QQ账号" type="text" name="qq" value="{{ $info->qq }}" />
                        </div>
                    </div>
                    <div class="form-group ">
                        <label for="curl" class="control-label col-lg-2">微信号</label>
                        <div class="col-lg-10">
                            <input class="form-control " placeholder="微信账号" type="text" name="weixin" value="{{ $info->weixin }}" />
                        </div>
                    </div>
                    <div class="form-group ">
                        <label for="curl" class="control-label col-lg-2">Email</label>
                        <div class="col-lg-10">
                            <input class="form-control " placeholder="输入邮箱账户" type="text" name="email" value="{{ $info->email }}" />
                        </div>
                    </div>
                    <div class="form-group ">
                        <label for="curl" class="control-label col-lg-2">资源媒体</label>
                        <div class="col-lg-10">
                            {{ $info->medias }}
                        </div>
                    </div>
                    <div class="form-group ">
                        <label for="curl" class="control-label col-lg-2">所属客服</label>
                        <div class="col-lg-10">
                            {{ $info->custom_name }}
                        </div>
                    </div>
                    <div class="form-group ">
                        <label for="curl" class="control-label col-lg-2">注册时间</label>
                        <div class="col-lg-10">
                            {{ $info->reg_time }}
                        </div>
                    </div>
                    <div class="form-group ">
                        <label for="curl" class="control-label col-lg-2">注册IP</label>
                        <div class="col-lg-10">
                            {{ $info->reg_ip }}
                        </div>
                    </div>
                    <div class="form-group ">
                        <label for="curl" class="control-label col-lg-2">最后登录时间</label>
                        <div class="col-lg-10">
                            {{ $info->login_time }}
                        </div>
                    </div>
                    <div class="form-group ">
                        <label for="curl" class="control-label col-lg-2">最后登录IP</label>
                        <div class="col-lg-10">
                            {{ $info->login_ip }}
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-offset-2 col-lg-10">
                            <input   name="id" value="{{ $info->id }}" type="hidden"/>
                            <button class="btn btn-danger" type="submit" style="margin:0px 25px">保存</button>
                            <button class="btn btn-default" type="button" onclick="javascript:history.back(-1);return false;">返回</button>
                        </div>
                    </div>
                    {!!Form::close()!!}
                </div>
            </div>
        </section>
    </div>
</div>
@stop