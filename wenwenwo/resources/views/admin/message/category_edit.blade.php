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
            新增消息分类
        </header>

        <div class="panel-body">
            {!! Form::open(['url' => 'admin/message/postMessageCategory','class'=>'form-horizontal adminex-form']) !!}
                <input name="id" value="{{ $info->id }}" type="hidden">
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">分类名称</label>
                    <div class="col-sm-10">
                        {!! Form::text('name', $info->name, array('class' => 'form-control','placeholder'=>'请填写分类名称')) !!}
                        @if ($errors->has('name'))
                            <p class="help-block">{{ $errors->first('name') }}</p>
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