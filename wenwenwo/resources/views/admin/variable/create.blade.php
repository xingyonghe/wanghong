@extends('admin.layouts.base')
@section('styles')
    <style type="text/css">
        .help-block{color: #a94442;}
    </style>
@endsection
@section('scripts')
    <script type="text/javascript">
        $(function(){

        })
    </script>
@endsection
@section('content')

    <section class="panel">
        <header class="panel-heading">
            新增常用变量
        </header>
        <div class="panel-body">
            {!! Form::open(['url' => 'admin/variable','class'=>'form-horizontal adminex-form']) !!}
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label"><span style="color: red">*</span> 变量名称</label>
                    <div class="col-sm-10">
                        <input type="text" placeholder="请填写变量名称" name="name" value="{{ old('name') }}" class="form-control">
                        @if ($errors->has('name'))
                            <p class="help-block">{{ $errors->first('name') }}</p>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label"><span style="color: red">*</span> 变量标识</label>
                    <div class="col-sm-10">
                        <input type="text" placeholder="请填写变量标识" name="variable" value="{{ old('variable') }}" class="form-control">
                        @if ($errors->has('variable'))
                            <p class="help-block">{{ $errors->first('variable') }}</p>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label"><span style="color: red">*</span> 应用范围</label>
                    <div class="col-sm-10">
                        <input type="text" placeholder="请填写应用范围" name="confines" value="{{ old('confines') }}" class="form-control">
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