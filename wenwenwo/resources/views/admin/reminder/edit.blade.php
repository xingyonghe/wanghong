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
            新增提示语
        </header>

        <div class="form-group">
            {!! get_reminder('reminderupdate') !!}
        </div>
        <div class="panel-body">
            {!! Form::open(['url' => 'admin/reminder/'.$info->id,'method'=>'put','class'=>'form-horizontal adminex-form']) !!}
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">提示语名称</label>
                    <div class="col-sm-10">
                        {!! Form::text('title', $info->title, array('class' => 'form-control','placeholder'=>'请填写提示语名称')) !!}
                        @if ($errors->has('title'))
                            <p class="help-block">{{ $errors->first('title') }}</p>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">提示语标识</label>
                    <div class="col-sm-10">
                        {!! Form::text('name', $info->name, array('class' => 'form-control','placeholder'=>'请填写提示语标识，标识必须是由小写字母构成')) !!}
                        @if ($errors->has('name'))
                            <p class="help-block">{{ $errors->first('name') }}</p>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">提示内容</label>
                    <div class="col-sm-10">
                        {!! Form::textarea('content', $info->content, array('class' => 'form-control wysihtml5','placeholder'=>'请填写提示语内容','rows'=>9)) !!}
                        @if ($errors->has('content'))
                            <p class="help-block">{{ $errors->first('content') }}</p>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">是否启用</label>
                    <div class="col-sm-10">
                        {!! Form::radios('status', ['1'=>'是','0'=>'否'],$info->status) !!}
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