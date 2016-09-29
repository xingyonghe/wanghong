@extends('admin.public.base')
@section('style')
@stop
@section('script')
    <script type="text/javascript">
        $(function () {
            highlight_subnav("{{ url('admin/config/index') }}");
        })
    </script>
@stop
@section('body')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                网站设置
            </header>
            <div class="panel-body">
                <div class=" form">
                    {!! Form::open(['url' => 'admin/channel/update','class'=>'cmxform form-horizontal tasi-form form-datas']) !!}
                    <div class="form-group ">
                        <label for="cname" class="control-label col-lg-2">网站标题</label>
                        <div class="col-lg-10">
                            <input class=" form-control" placeholder="请填写导航标题" name="title" type="text" value="" />
                        </div>
                    </div>
                    <div class="form-group ">
                        <label for="cemail" class="control-label col-lg-2">网站地址</label>
                        <div class="col-lg-10">
                            <input class="form-control " placeholder="导航显示的顺序"  type="text" name="sort" />
                        </div>
                    </div>
                    <div class="form-group ">
                        <label for="curl" class="control-label col-lg-2">网站LOGO</label>
                        <div class="col-lg-10">
                            <input class="form-control " placeholder="url函数解析的URL或者外链" type="text" name="url" />
                        </div>
                    </div>
                    <div class="form-group ">
                        <label for="curl" class="control-label col-lg-2">网站所属</label>
                        <div class="col-lg-10 radios has-js">
                            <label class="label_radio r_on" for="radio-01">
                                <input name="status" id="radio-01" value="1" type="radio" checked /> 显示
                            </label>
                            <label class="label_radio" for="radio-02">
                                <input name="status" id="radio-02" value="0" type="radio" /> 隐藏
                            </label>
                        </div>
                    </div>
                    <div class="form-group ">
                        <label for="curl" class="control-label col-lg-2">版权信息</label>
                        <div class="col-lg-10 radios has-js">
                            <label class="label_radio r_on" for="radio-01">
                                <input name="target" id="radio-01" value="0" type="radio" checked /> 否
                            </label>
                            <label class="label_radio" for="radio-02">
                                <input name="target" id="radio-02" value="1" type="radio" /> 是
                            </label>
                        </div>
                    </div>
                    <div class="form-group ">
                        <label for="curl" class="control-label col-lg-2">备案信息</label>
                        <div class="col-lg-10">
                            <input class="form-control " placeholder="额外的导航备注说明" type="text" name="remark" />
                        </div>
                    </div>
                    {!!Form::close()!!}
                </div>
            </div>
        </section>
    </div>
</div>
@stop