<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <div class="panel-body">
                <div class=" form">
                    {!! Form::open(['url' => 'admin/menu/batchUpdate','class'=>'cmxform form-horizontal tasi-form form-datas']) !!}
                    <div class="form-group ">
                        <div class="col-lg-10" style="width: 98%;">
                            <textarea class="form-control" rows="6" placeholder="请按规则配置菜单" name="menus" />
                            </textarea>
                        </div>
                        <div class="col-lg-10" style="text-align: left;font-size: 14px;color:#797979">
                            菜单规则:<br/>
                            菜单名称|排序|链接|是否显示（1隐藏0显示）|分组<br/>
                            菜单名称|排序|链接|是否显示（1隐藏0显示）|分组<br/><br/>
                            规则说明:<br/>
                            一行一组菜单，新的菜单必须分行<br/>
                            该批量操作只针对同一父级有效
                        </div>
                    </div>
                    <input name="pid" value="{{ $pid }}" type="hidden">
                    {!!Form::close()!!}
                </div>
            </div>
        </section>
    </div>
</div>