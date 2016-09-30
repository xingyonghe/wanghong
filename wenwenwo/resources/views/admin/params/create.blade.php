@extends('admin.layouts.base')
@section('styles')
    <style type="text/css">
        .help-block{color: #a94442;}
        .m-bot15{
            width: 120px;
        }
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
            新增参数
        </header>
        <div class="panel-body">
            {!! Form::open(['url' => 'admin/parameter','class'=>'form-horizontal adminex-form']) !!}
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label"><span style="color: red">*</span> 参数类型</label>
                    <div class="col-sm-10">
                        {!! Form::select('type', $type, old('type'), array('class' => 'input-sm m-bot15')) !!}
                        @if ($errors->has('type'))
                            <p class="help-block">{{ $errors->first('type') }}</p>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label"><span style="color: red">*</span> 参数分类</label>
                    <div class="col-sm-10">
                        {!! Form::select('cate', $cate, old('cate'), array('class' => 'input-sm m-bot15')) !!}
                        @if ($errors->has('cate'))
                            <p class="help-block">{{ $errors->first('cate') }}</p>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label"><span style="color: red">*</span> 控件类型</label>
                    <div class="col-sm-10">
                        {!! Form::select('shape', $shape, old('shape'), array('class' => 'input-sm m-bot15')) !!}
                        @if ($errors->has('shape'))
                            <p class="help-block">{{ $errors->first('shape') }}</p>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label"><span style="color: red">*</span> 参数名称</label>
                    <div class="col-sm-10">
                        {!! Form::text('title', old('title'), array('class' => 'form-control','placeholder'=>'请填写参数名称')) !!}
                        @if ($errors->has('title'))
                            <p class="help-block">{{ $errors->first('title') }}</p>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label"><span style="color: red">*</span> 参数标识</label>
                    <div class="col-sm-10">
                        {!! Form::text('name', old('name'), array('class' => 'form-control','placeholder'=>'请填写参数标识')) !!}
                        @if ($errors->has('name'))
                            <p class="help-block">{{ $errors->first('name') }}</p>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label"><span style="color: red">*</span> 参数值</label>
                    <div class="col-sm-10">
                        {!! Form::textarea('content', old('content'), array('class' => 'form-control','placeholder'=>'请参考格式输入参数值','rows'=>6)) !!}
                        <label>格式说明：key-value 回车,key-value 回车,一行一个：参数值|参数值名称</label>
                        @if ($errors->has('content'))
                            <p class="help-block">{{ $errors->first('content') }}</p>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label"><span style="color: red">*</span> 备注说明</label>
                    <div class="col-sm-10">
                        {!! Form::text('note', old('note'), array('class' => 'form-control','placeholder'=>'请填写备注说明')) !!}
                        @if ($errors->has('note'))
                            <p class="help-block">{{ $errors->first('note') }}</p>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label"><span style="color: red">*</span> Title</label>
                    <div class="col-sm-10">
                        {!! Form::text('alt', old('alt'), array('class' => 'form-control','placeholder'=>'请填写参数Title')) !!}
                        @if ($errors->has('alt'))
                            <p class="help-block">{{ $errors->first('alt') }}</p>
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