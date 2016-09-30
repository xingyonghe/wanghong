@extends('admin.layouts.base')
@section('styles')
    <!--dynamic table-->
    <style type="text/css">
        .space15 {
            height: 10px
        }

        .btn {
            color: #ff585b
        }

        .page {
            text-align: right;
            margin-right: 15px
        }
    </style>
@endsection
@section('scripts')
    <script type="text/javascript">
        $(function(){
            $('#editable-sample_new').click(function(){
                window.location = $(this).attr('url');
            });
        })
    </script>
@endsection
@section('content')
    <!--body wrapper start-->
    <div class="wrapper">
        <div class="row">
            <div class="col-sm-12">
                <section class="panel">
                    <header class="panel-heading">
                        消息管理
                    </header>
                    <div class="panel-body">
                        <div class="adv-table editable-table ">
                            <div class="clearfix">
                                <div class="btn-group">
                                    <button id="editable-sample_new" url="{{ url('admin/message/addMessageCategory') }}" class="btn btn-primary">
                                        新增 <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                            {!! Form::open(['url' => 'admin/message/index','method'=>'get','class'=>'form-horizontal adminex-form']) !!}
                                <div id="editable-sample_wrapper" class="dataTables_wrapper form-inline" role="grid">
                                    <div class="row">
                                        <div class="dataTables_length" id="editable-sample_length" style="min-height: 70px;">
                                            <div class="col-lg-2">
                                                <label for="" style="line-height: 30px"> <strong>信息总量：{{$datas->total()}}</strong></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            {!!Form::close()!!}
                            <table class="table table-striped table-hover table-bordered" id="editable-sample">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>名称</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($datas as $data)
                                    <tr>
                                        <td>{{ $data->id }}</td>
                                        <td>{{ $data->name }}</td>
                                        <td>
                                            <a href="{{ url('admin/message/editMessageCategory',[$data->id])}}" class="btn btn-default">
                                                <i class="fa fa-book"></i> 编辑
                                            </a>
                                            <a href="{{ url('admin/message/destroyMessageCategory',[$data->id])}}" class="btn btn-default" confirm>
                                                <i class="fa fa-trash-o"></i> 删除
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="page">
                        {!! $datas->render() !!}
                    </div>
                </section>
            </div>
        </div>
    </div>
    <!--body wrapper end-->
@endsection