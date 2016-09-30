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
            新增消息
        </header>

        <div class="panel-body">
            {!! Form::open(['url' => 'admin/message/post','class'=>'form-horizontal adminex-form']) !!}
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">分类</label>
                    <div class="col-sm-10">
                        {!! Form::select('message_catid', $category, old('message_catid'), array('class' => 'input-sm m-bot15')) !!}
                        @if ($errors->has('message_catid'))
                            <p class="help-block">{{ $errors->first('message_catid') }}</p>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">接收人</label>
                    <div class="col-sm-10">
                        {!! Form::text('name', old('name'), array('class' => 'form-control','placeholder'=>'接收人，多个请用；分开')) !!}
                        @if ($errors->has('name'))
                            <p class="help-block">{{ $errors->first('name') }}</p>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">标题</label>
                    <div class="col-sm-10">
                        {!! Form::text('title', old('title'), array('class' => 'form-control','placeholder'=>'请填写协议标题')) !!}
                        @if ($errors->has('title'))
                            <p class="help-block">{{ $errors->first('title') }}</p>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">内容</label>
                    <div class="col-sm-10">
                        {!! Form::textarea('content', old('content'), array('class' => 'form-control wysihtml5','placeholder'=>'请填写协议内容','rows'=>9)) !!}
                        @if ($errors->has('content'))
                            <p class="help-block">{{ $errors->first('content') }}</p>
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