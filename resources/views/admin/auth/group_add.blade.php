<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <div class="panel-body">
                <div class=" form">
                    {!! Form::open(['url' => 'admin/auth/updateGroup','class'=>'cmxform form-horizontal tasi-form form-datas']) !!}
                    <div class="form-group ">
                        <label for="cname" class="control-label col-lg-2">用户组</label>
                        <div class="col-lg-10">
                            <input class=" form-control" placeholder="用户组标题" name="title" type="text" value="" />
                        </div>
                    </div>
                    <div class="form-group ">
                        <label for="cemail" class="control-label col-lg-2">描述</label>
                        <div class="col-lg-10">
                            <input class="form-control " placeholder="用户分组简单描述"  type="text" name="description" />
                        </div>
                    </div>
                    <div class="form-group ">
                        <label for="curl" class="control-label col-lg-2">是否启用</label>
                        <div class="col-lg-10 radios has-js">
                            <label class="label_radio r_on" for="radio-01">
                                <input name="status" id="radio-01" value="1" type="radio" checked /> 启用
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