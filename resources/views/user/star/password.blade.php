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
            highlight_subnav("{{ route('user.index.password') }}");
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
                        <a href="{{ route('user.index.index') }}"><i class="pull-right icon-user"></i>基本资料</a>
                    </li>
                    <li>
                        <a href="{{ route('user.index.password') }}"> <i class="pull-right icon-cog"></i>我的账户</a>
                    </li>
                    <li>
                        <a href="{{ route('user.index.password') }}"> <i class="pull-right icon-star"></i>修改密码</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="span9">
            <h4 class="header">修改密码</h4>
            <div id="d3" style="width: 100%; margin-top: -30px"></div><br />
            <div class="span6">
                <form class="form-horizontal data-form" action="{{ route('user.index.reset') }}" metho="POST"/>
                    {{ csrf_field() }}
                    <div class="control-group">
                        <label for="inputCurrentPassword" class="control-label">旧密码： </label>
                        <div class="controls">
                            <input id="password-old" type="password" name="password-old" placeholder="请输入旧密码" value=""/>
                            <strong class="wrong" id="error-password-old"></strong>
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="inputCurrentPassword" class="control-label">新密码： </label>
                        <div class="controls">
                            <input id="password" type="password" name="password" placeholder="请输入新密码" value=""/>
                            <strong class="wrong" id="error-password"></strong>
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="inputPassword" class="control-label">确认新密码： </label>
                        <div class="controls">
                            <input id="password-confirm" type="password" name="password_confirmation" placeholder="确认新密码" value=""/>
                        </div>
                    </div>

                    <div class="control-group">
                        <div class="controls">
                            <button class="btn ajax-post" type="submit" >提 交</button>
                            <button class="btn" onclick="javascript:history.back(-1);return false;" >返 回</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection