<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <div class="panel-body">
                <div class=" form">
                    {!! Form::open(['url' => 'admin/admin/update','class'=>'cmxform form-horizontal tasi-form form-datas']) !!}
                    <div class="form-group ">
                        <label for="cname" class="control-label col-lg-2">用户名</label>
                        <div class="col-lg-10">
                            <input class=" form-control" placeholder="用于后台登陆的账号" name="username" type="text" value="" />
                        </div>
                    </div>
                    <div class="form-group ">
                        <label for="cemail" class="control-label col-lg-2">密码</label>
                        <div class="col-lg-10">
                            <input class="form-control " placeholder="用于后台登陆的密码"  type="password" name="password" />
                        </div>
                    </div>
                    <div class="form-group ">
                        <label for="curl" class="control-label col-lg-2">确认密码</label>
                        <div class="col-lg-10">
                            <input class="form-control " placeholder="确认密码" type="password" name="password_confirmation" />
                        </div>
                    </div>
                    <div class="form-group ">
                        <label for="curl" class="control-label col-lg-2">用户组</label>
                        <div class="col-lg-10">
                            <select class="form-control m-bot15" name="role_id">
                                <option value="0">请选择</option>
                                @foreach($groups as $group)
                                    <option value="{{ $group['id'] }}">{{ $group['title'] }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group ">
                        <label for="curl" class="control-label col-lg-2">状态</label>
                        <div class="col-lg-10 radios has-js">
                            <label class="label_radio r_on" for="radio-01">
                                <input name="status" id="radio-01" value="1" type="radio" checked /> 正常
                            </label>
                            <label class="label_radio" for="radio-02">
                                <input name="status" id="radio-02" value="0" type="radio" /> 禁用
                            </label>
                        </div>
                    </div>
                    {!!Form::close()!!}
                </div>
            </div>
        </section>
    </div>
</div>