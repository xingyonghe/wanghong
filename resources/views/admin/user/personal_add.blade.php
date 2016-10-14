<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <div class="panel-body">
                <div class=" form">
                    {!! Form::open(['url' => 'admin/personal/update','class'=>'cmxform form-horizontal tasi-form form-datas','autocomplete'=>'off']) !!}
                    <div class="form-group ">
                        <label for="cname" class="control-label col-lg-2">用户名</label>
                        <div class="col-lg-10">
                            <input class=" form-control" placeholder="用于登陆的手机号码" name="username" type="text" value="{{ old('username') }}" />
                        </div>
                    </div>
                    <div class="form-group ">
                        <label for="cemail" class="control-label col-lg-2">密码</label>
                        <div class="col-lg-10">
                            <input class="form-control " placeholder="初始登陆的密码"  type="password" name="password" />
                        </div>
                    </div>
                    <div class="form-group ">
                        <label for="cname" class="control-label col-lg-2">联系人</label>
                        <div class="col-lg-10">
                            <input class=" form-control" placeholder="联系人名称" name="nickname" type="text" value="{{ old('nickname') }}"/>
                        </div>
                    </div>
                    <div class="form-group ">
                        <label for="curl" class="control-label col-lg-2">QQ号码</label>
                        <div class="col-lg-10">
                            <input class="form-control " placeholder="QQ账号" type="text" name="qq" value="{{ old('qq') }}"/>
                        </div>
                    </div>
                    <div class="form-group ">
                        <label for="curl" class="control-label col-lg-2">微信号</label>
                        <div class="col-lg-10">
                            <input class="form-control " placeholder="微信账号" type="text" name="weixin" value="{{ old('weixin') }}"/>
                        </div>
                    </div>
                    <div class="form-group ">
                        <label for="curl" class="control-label col-lg-2">Email</label>
                        <div class="col-lg-10">
                            <input class="form-control " placeholder="输入邮箱账户" type="text" name="email" value="{{ old('email') }}"/>
                        </div>
                    </div>
                    {!!Form::close()!!}
                </div>
            </div>
        </section>
    </div>
</div>