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
            消息详情
        </header>

        <div class="panel-body">
            {!! Form::open(['url' => 'admin/message/post','class'=>'form-horizontal adminex-form']) !!}
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">分类</label>
                    <div class="col-sm-10">
                        {{ $info->category }}

                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">接收人</label>
                    <div class="col-sm-10">
                        {{ $info->username }}
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">标题</label>
                    <div class="col-sm-10">
                        {{ $info->title }}
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">内容</label>
                    <div class="col-sm-10">
                        {{ $info->content }}
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">状态</label>
                    <div class="col-sm-10">
                        {{ $info->statusText }}
                    </div>
                </div>
            {!!Form::close()!!}
        </div>
    </section>
@endsection