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
            $('.message-btn').click(function(){
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
                                    <button url="{{ url('admin/message/add') }}" class="btn btn-primary message-btn">
                                        新增 <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                                <div class="btn-group">
                                    <button url="{{ url('admin/message/category') }}" class="btn btn-primary message-btn">
                                        分类管理
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
                                    <th>标题</th>
                                    <th>分类</th>
                                    <th>发送时间</th>
                                    <th>状态</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($datas as $data)
                                    <tr>
                                        <td>{{ $data->id }}</td>
                                        <td>{{ $data->title }}</td>
                                        <td>{{ $data->category }}</td>
                                        <td>{{ $data->send_time }}</td>
                                        <td>{{ $data->statusText }}</td>
                                        <td>
                                            <a href="{{ url('admin/message/show',[$data->id])}}" class="btn btn-default">
                                                <i class="fa fa-book"></i> 查看
                                            </a>
                                            <a href="{{ url('admin/message/destroy',[$data->id])}}" class="btn btn-default" confirm>
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