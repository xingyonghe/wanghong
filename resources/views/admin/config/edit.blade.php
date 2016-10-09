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
                    编辑配置
                </header>
                <div class="panel-body">
                    <div class=" form">
                        {!! Form::open(['url' => 'admin/config/update','class'=>'cmxform form-horizontal tasi-form form-datas']) !!}
                        <input name="id" type="hidden" value="{{ $info->id }}">
                        <div class="form-group ">
                            <label for="cname" class="control-label col-lg-2">配置标题</label>
                            <div class="col-lg-10">
                                <input class=" form-control" placeholder="用于后台显示的配置标题" name="title" type="text" value="{{$info->title}}" />
                            </div>
                        </div>
                        <div class="form-group ">
                            <label for="cemail" class="control-label col-lg-2">配置标识</label>
                            <div class="col-lg-10">
                                <input class="form-control " placeholder="只能使用大写英文且不能重复"  type="text" name="name" value="{{$info->name}}"/>
                            </div>
                        </div>
                        <div class="form-group ">
                            <label for="cemail" class="control-label col-lg-2">排序</label>
                            <div class="col-lg-10">
                                <input class="form-control " placeholder="用于分组显示的顺序"  type="text" name="sort" value="{{$info->sort}}"/>
                            </div>
                        </div>
                        <div class="form-group ">
                            <label for="curl" class="control-label col-lg-2">配置类型</label>
                            <div class="col-lg-10">
                                {!! Form::select('type', $type, $info->type, array('class' => 'form-control m-bot15')) !!}
                            </div>
                        </div>
                        <div class="form-group ">
                            <label for="curl" class="control-label col-lg-2">配置分组</label>
                            <div class="col-lg-10">
                                {!! Form::select('group', $group, $info->group, array('class' => 'form-control m-bot15')) !!}
                            </div>
                        </div>
                        <div class="form-group ">
                            <label for="curl" class="control-label col-lg-2">配置值</label>
                            <div class="col-lg-10">
                                <textarea class="form-control " rows="6"  placeholder="配置值" type="text" name="value" />{{$info->value}}</textarea>
                            </div>
                        </div>
                        <div class="form-group ">
                            <label for="curl" class="control-label col-lg-2">配置项</label>
                            <div class="col-lg-10">
                                <textarea class="form-control " rows="6" placeholder="如果是枚举型 需要配置该项" type="text" name="extra" />{{$info->extra}}</textarea>
                            </div>
                        </div>
                        <div class="form-group ">
                            <label for="curl" class="control-label col-lg-2">配置说明</label>
                            <div class="col-lg-10">
                                <textarea class="form-control " rows="6" placeholder="配置备注说明" type="text" name="remark" />{{$info->remark}}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-offset-2 col-lg-10">
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