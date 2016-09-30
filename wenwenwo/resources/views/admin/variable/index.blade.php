@extends('admin.layouts.base')
@section('styles')
    <!--dynamic table-->
    <link rel="stylesheet" href="/assets/js/data-tables/DT_bootstrap.css" />
    <link href="/assets/css/style.css" rel="stylesheet">
    <link href="/assets/css/style-responsive.css" rel="stylesheet">
    <style type="text/css">
        .space15{height: 10px}
        .btn{color: #fff}
        .page{text-align: right;margin-right: 15px}
    </style>
@endsection
@section('scripts')
    <!--dynamic table-->
    <script type="text/javascript" language="javascript" src="/assets/js/advanced-datatable/js/jquery.dataTables.js"></script>
    <script type="text/javascript" src="/assets/js/data-tables/DT_bootstrap.js"></script>
    <!--dynamic table initialization -->
    <script src="/assets/js/dynamic_table_init.js"></script>
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
                        常用变量
                    </header>
                    <div class="panel-body">
                        <div class="adv-table editable-table ">
                            <div class="clearfix">
                                <div class="btn-group">
                                    <button id="editable-sample_new" url="{{ url('admin/variable/create') }}" class="btn btn-primary">
                                        新增 <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                            {!! Form::open(['url' => 'admin/variable','method'=>'get','class'=>'form-horizontal adminex-form']) !!}
                            <div id="editable-sample_wrapper" class="dataTables_wrapper form-inline" role="grid">
                                <div class="row">
                                    <div class="dataTables_length" id="editable-sample_length" style="min-height: 70px;">
                                        <div class="col-lg-2">
                                            <label for="" style="line-height: 30px"> <strong>信息总量：{{$datas->total()}}</strong></label>
                                        </div>
                                        <div style="float: right; padding-right: 15px;">
                                            <div class="col-lg-2" style="width:auto;">
                                                <label>变量名称: <input class="form-control" aria-controls="editable-sample" name="name" value="{{$name}}" type="text"></label>
                                            </div>
                                            <div class="col-lg-2" style="width:auto;">
                                                <label>变量标识: <input class="form-control" aria-controls="editable-sample" name="variable" value="{{$variable}}" type="text"></label>
                                            </div>
                                            <button class="btn btn-primary" type="submit"><i class="fa fa-search-minus"></i>搜索</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {!!Form::close()!!}
                            <table class="table table-striped table-hover table-bordered" id="editable-sample">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>变量名称</th>
                                    <th>变量标识</th>
                                    <th>应用范围</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($datas as $data)
                                    <tr>
                                        <td>{{$data->id}}</td>
                                        <td>{{ $data->name }}</td>
                                        <td>{{ $data->variable }}</td>
                                        <td>{{ $data->confines }}</td>
                                        <td>
                                            <a href="{{ url('admin/variable/'.$data->id.'/edit')}}" class="btn btn-default">
                                                <i class="fa fa-book"></i> 编辑
                                            </a>
                                            <a href="{{ url('admin/variable/destroy/'.$data->id)}}" class="btn btn-default">
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
                        {!! $datas->appends($params)->render() !!}
                    </div>
                </section>
            </div>
        </div>
    </div>
    <!--body wrapper end-->
@endsection