@extends('admin.layouts.base')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    附件上传
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

                    <form class="form-horizontal adminex-form" method="post" action="/admin/attachment/save">
                        {{ csrf_field() }}

                        <div class="form-group {{ $errors->has('max_one_size') ? ' has-error' : '' }}">
                            <label class="col-sm-2 col-lg-2 control-label"><span class="text-danger">*</span> 单个附件最大尺寸</label>
                            <div class="col-lg-4">
                                <div class="input-group m-bot15">
                                    <input title="" name="max_one_size" type="text" class="form-control" value="{{ old('max_one_size') ?? $max_one_size ?? ''}}" required autofocus>
                                    <span class="input-group-addon">MB</span>
                                </div>
                                <span class="help-block">{{ $errors->first('max_one_size') }}</span>
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('max_total_size') ? ' has-error' : '' }}">
                            <label class="col-sm-2 col-lg-2 control-label"><span class="text-danger">*</span> 每天最大附件总尺寸</label>
                            <div class="col-lg-4">
                                <div class="input-group m-bot15">
                                    <input title="" name="max_total_size" type="text" class="form-control" value="{{ old('max_total_size') ?? $max_total_size ?? ''}}" required>
                                    <span class="input-group-addon">MB</span>
                                </div>
                                <span class="help-block">{{ $errors->first('max_total_size') }}</span>
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('max_total_num') ? ' has-error' : '' }}">
                            <label class="col-sm-2 col-lg-2 control-label"><span class="text-danger">*</span> 每天最大附件数量</label>
                            <div class="col-lg-4">
                                <div class="input-group m-bot15">
                                    <input title="" name="max_total_num" type="text" class="form-control" value="{{ old('max_total_num') ?? $max_total_num ?? ''}}" required>
                                    <span class="input-group-addon">个</span>
                                </div>
                                <span class="help-block">{{ $errors->first('max_total_num') }}</span>
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('allow_type') ? ' has-error' : '' }}">
                            <label class="col-sm-2 col-lg-2 control-label"><span class="text-danger">*</span> 允许的附件类型</label>
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
@endsection