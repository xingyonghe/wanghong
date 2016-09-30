@extends('admin.layouts.base')

@section('styles')
    <!--ios7-->
    <link rel="stylesheet" type="text/css" href="/assets/js/ios-switch/switchery.css" />
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    缩略图规则
                </header>
                <div class="panel-body">

                    @if (Session::has('message'))
                        <div class="alert alert-success alert-block fade in">
                            <button type="button" class="close close-sm" data-dismiss="alert">
                                <i class="fa fa-times"></i>
                            </button>
                            <h4>
                                <i class="icon-ok-sign"></i>
                                {{ Session::get('message')['content'] }}
                            </h4>
                        </div>
                    @endif

                    <form class="form-horizontal adminex-form" method="post" action="{{ url('/admin/thumbnail/config_save') }}">
                        {{ csrf_field() }}

                        <div class="form-group {{ $errors->has('compress_rate') ? ' has-error' : '' }}">
                            <label class="col-sm-2 col-lg-2 control-label"><span class="text-danger">*</span> 图片压缩比例</label>
                            <div class="col-lg-4">
                                <div class="m-bot15">
                                    <input name="compress_rate" type="text" class="form-control" value="{{ old('compress_rate') ?? $compress_rate ?? ''}}" required title="">
                                </div>
                                <span class="help-block">{{ $errors->first('compress_rate') }}</span>
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('rule') ? ' has-error' : '' }}">
                            <label class="col-sm-2 col-lg-2 control-label"><span class="text-danger">*</span> 图片缩微规则</label>
                            <div class="col-lg-4">
                                <div class="m-bot15">
                                    <select name="rule" class="form-control input-sm m-bot15" title="">
                                        @foreach($rules as $_key => $_ruleName)
                                            <option value="{{ $_key }}" @if($_key == $rule) selected @endif>{{$_ruleName}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <span class="help-block">{{ $errors->first('rule') }}</span>
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('max_size_num') ? ' has-error' : '' }}">
                            <label class="col-sm-2 col-lg-2 control-label"><span class="text-danger">*</span> 用户上传图片最大</label>
                            <div class="col-lg-4">
                                <div class="input-group m-bot15">
                                    <input name="max_size_num" type="text" class="form-control" value="{{ old('max_size_num') ?? $max_size_num ?? ''}}" required title="">
                                    <span class="input-group-addon">MB</span>
                                </div>
                                <span class="help-block">{{ $errors->first('max_size_num') }}</span>
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('min_width') ? ' has-error' : '' }}">
                            <label class="col-sm-2 col-lg-2 control-label"><span class="text-danger">*</span> 上传图片最小宽度</label>
                            <div class="col-lg-4">
                                <div class="input-group m-bot15">
                                    <input title="" name="min_width" type="text" class="form-control" value="{{ old('min_width') ?? $min_width ?? ''}}" required>
                                    <span class="input-group-addon">px</span>
                                </div>
                                <span class="help-block">{{ $errors->first('min_width') }}</span>
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('min_height') ? ' has-error' : '' }}">
                            <label class="col-sm-2 col-lg-2 control-label"><span class="text-danger">*</span> 上传图片最小高度</label>
                            <div class="col-lg-4">
                                <div class="input-group m-bot15">
                                    <input title="" name="min_height" type="text" class="form-control" value="{{ old('min_height') ?? $min_height ?? ''}}" required>
                                    <span class="input-group-addon">px</span>
                                </div>
                                <span class="help-block">{{ $errors->first('min_height') }}</span>
                            </div>
                        </div>


                        <div class="form-group {{ $errors->has('allow_type') ? ' has-error' : '' }}">
                            <label class="col-sm-2 col-lg-2 control-label"><span class="text-danger">*</span> 图片扩展名</label>
                            <div class="col-lg-4">
                                <div class=" m-bot15">
                                    <input name="allow_type" type="text" class="form-control" value="{{ old('allow_type') ?? $allow_type ?? ''}}" required placeholder="例: jpg,jpeg,png,gif">
                                </div>
                                <span class="help-block">{{ $errors->first('allow_type') }}</span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 col-lg-2 control-label"></label>
                            <div class="col-lg-4"><button type="submit" class="btn btn-primary">保存</button></div>
                        </div>
                    </form>

                </div>
            </section>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    生成缩微图
                </header>
                <div class="panel-body">

                    <form id="regenerate" class="form-horizontal adminex-form" method="post" action="{{ url('/admin/thumbnail/regenerate') }}">
                        {{ csrf_field() }}

                        <div class="form-group {{ $errors->has('type') ? ' has-error' : '' }}">
                            <label class="col-sm-2 col-lg-2 control-label"><span class="text-danger">*</span> 选择图像分类</label>
                            <div class="col-lg-4">
                                <div class="m-bot15">
                                    <select name="type" class="form-control input-sm m-bot15" title="">
                                        <option value="0" >全部</option>
                                        @foreach($types as $_key => $_typeName)
                                            <option value="{{ $_key }}" >{{$_typeName}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <span class="help-block">{{ $errors->first('type') }}</span>
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('type') ? ' has-error' : '' }}">
                            <label class="col-sm-2 col-lg-2 control-label"><span class="text-danger">*</span> 删除之前的图片</label>
                            <div class="col-lg-4">
                                <div class="m-bot15">
                                    <div class="slide-toggle">
                                        <input name="is_delete" title="" value="1" type="checkbox" class="js-switch" checked/>
                                    </div>
                                </div>
                                <span class="help-block">{{ $errors->first('type') }}</span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 col-lg-2 control-label"></label>
                            <div class="col-lg-4"><button type="submit" class="btn btn-danger" @if($is_running) disabled="disabled" @endif>生成缩略图</button></div>

                        </div>
                        <div class="form-group has-error @if(!$is_running) hidden @endif " id="is_running"><label class="col-sm-2 col-lg-2 control-label"></label>
                            <span class="help-block">已发出生成缩微图指令.系统将自动处理.你可以关闭该页面处理其它事务...</span>
                        </div>
                    </form>

                </div>
            </section>
        </div>
    </div>
@endsection

@section('scripts')
    <!--ios7-->
    <script src="/assets/js/ios-switch/switchery.js" ></script>
    <script src="/assets/js/ios-switch/ios-init.js" ></script>

    <script>
        $(function(){
            $("#regenerate").submit(function(){
                $.post($(this).attr("action"),$(this).serialize(),function(data){
                    if(data.code){
                        $("#is_running").children(".help-block").text(data.message);
                    }else{
                        $("#is_running").children(".help-block").text("执行完毕");
                    }
                    $("#is_running").removeClass("hidden");
                },"json");
                $(this).find("button[type='submit']").attr("disabled","disabled").text("生成中");
                $("#is_running").removeClass("hidden");
                return false;
            });
        });
    </script>
@endsection