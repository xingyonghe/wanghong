@extends('admin.layouts.base')
@section('styles')
    <link rel="stylesheet" type="text/css" href="/assets/js/bootstrap-wysihtml5/bootstrap-wysihtml5.css" />
    <style type="text/css">
        .help-block{color: #a94442;}
    </style>
@endsection
@section('scripts')
    <script type="text/javascript" src="/assets/js/bootstrap-wysihtml5/wysihtml5-0.3.0.js"></script>
    <script type="text/javascript" src="/assets/js/bootstrap-wysihtml5/bootstrap-wysihtml5.js"></script>
    <script type="text/javascript">
        $(function(){
            $('.wysihtml5').wysihtml5();
        })
    </script>
@endsection
@section('content')

    <section class="panel">
        <header class="panel-heading">
            编辑常用变量
        </header>
        <div class="panel-body">
            {!! Form::open(['url' => 'admin/variable/'.$info->id,'method'=>'put','class'=>'form-horizontal adminex-form']) !!}
            <div class="form-group">
                <label class="col-sm-2 col-sm-2 control-label"><span style="color: red">*</span> 变量名称</label>
                <div class="col-sm-10">
                    <input type="text" placeholder="请填写变量名称" name="name" value="{{ $info->name }}" class="form-control">
                    @if ($errors->has('name'))
                        <p class="help-block">{{ $errors->first('name') }}</p>
                    @endif
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 col-sm-2 control-label"><span style="color: red">*</span> 变量标识</label>
                <div class="col-sm-10">
                    <input type="text" placeholder="请填写变量标识" name="variable" value="{{  $info->variable }}" class="form-control">
                    @if ($errors->has('variable'))
                        <p class="help-block">{{ $errors->first('variable') }}</p>
                    @endif
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 col-sm-2 control-label"><span style="color: red">*</span> 应用范围</label>
                <div class="col-sm-10">
                    <input type="text" placeholder="请填写应用范围" name="confines" value="{{  $info->confines }}" class="form-control">
                    @if ($errors->has('confines'))
                        <p class="help-block">{{ $errors->first('confines') }}</p>
                    @endif
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-2 col-sm-2 control-label"></label>
                <div class="col-lg-10">
                    <button type="submit" class="btn btn-primary">提 交</button>
                </div>
            </div>
            {!!Form::close()!!}
        </div>
    </section>
@endsection