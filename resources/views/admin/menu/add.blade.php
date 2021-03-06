<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <div class="panel-body">
                <div class=" form">
                    {!! Form::open(['url' => 'admin/menu/update','class'=>'cmxform form-horizontal tasi-form form-datas']) !!}
                    <div class="form-group ">
                        <label for="cname" class="control-label col-lg-2">标题</label>
                        <div class="col-lg-10">
                            <input class=" form-control" placeholder="用于后台显示的配置标题" name="title" type="text" value="" />
                        </div>
                    </div>
                    <div class="form-group ">
                        <label for="cemail" class="control-label col-lg-2">排序</label>
                        <div class="col-lg-10">
                            <input class="form-control " placeholder="用户分组显示的顺序"  type="text" name="sort" />
                        </div>
                    </div>
                    <div class="form-group ">
                        <label for="curl" class="control-label col-lg-2">链接</label>
                        <div class="col-lg-10">
                            <input class="form-control " placeholder="url函数解析的URL或者外链" type="text" name="url" />
                        </div>
                    </div>
                    <div class="form-group ">
                        <label for="curl" class="control-label col-lg-2">上级菜单</label>
                        <div class="col-lg-10">
                            <select class="form-control m-bot15" name="pid">
                                @foreach($menus as $menu)
                                    <option value="{{ $menu['id'] }}" @if($pid==$menu['id']) selected @endif>{{ $menu['title_show'] }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group ">
                        <label for="curl" class="control-label col-lg-2">是否隐藏</label>
                        <div class="col-lg-10 radios has-js">
                            <label class="label_radio r_on" for="radio-01">
                                <input name="hide" id="radio-01" value="0" type="radio" checked /> 显示
                            </label>
                            <label class="label_radio" for="radio-02">
                                <input name="hide" id="radio-02" value="1" type="radio" /> 隐藏
                            </label>
                        </div>
                    </div>
                    <div class="form-group ">
                        <label for="curl" class="control-label col-lg-2">分组</label>
                        <div class="col-lg-10 radios has-js">
                            <input class="form-control " placeholder="用于左侧分组的二级菜单" type="text" name="group" />
                        </div>
                    </div>
                    {!!Form::close()!!}
                </div>
            </div>
        </section>
    </div>
</div>