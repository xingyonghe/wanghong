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
            测试邮件
        </header>

        <div class="panel-body">
            {!! Form::open(['url' => 'admin/email/send','class'=>'form-horizontal adminex-form']) !!}
            <div class="form-group">
                <label class="col-sm-2 col-sm-2 control-label">测试账号</label>
                <div class="col-sm-10">
                    {!! Form::text('name', old('name'), array('class' => 'form-control','placeholder'=>'多个账户请用英文状态下分号(；)隔开')) !!}
                    @if ($errors->has('name'))
                        <p class="help-block">{{ $errors->first('name') }}</p>
                    @endif
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 col-sm-2 control-label">邮件内容</label>
                <div class="col-sm-10">
                    {!! Form::textarea('content', old('content'), array('class' => 'form-control wysihtml5','placeholder'=>'请填写邮件内容','rows'=>9)) !!}
                    @if ($errors->has('content'))
                        <p class="help-block">{{ $errors->first('content') }}</p>
                    @endif
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-2 col-sm-2 control-label"></label>
                <div class="col-lg-10">
                    <button type="submit" class="btn btn-primary">测试发送</button>
                </div>
            </div>
            {!!Form::close()!!}
        </div>
    </section>
@endsection