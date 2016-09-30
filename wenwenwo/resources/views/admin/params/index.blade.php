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
                        参数列表
                    </header>
                    <div class="panel-body">
                        <div class="adv-table editable-table ">
                            <div class="clearfix">
                                <div class="btn-group">
                                    <button id="editable-sample_new" url="{{ url('admin/parameter/create') }}" class="btn btn-primary">
                                        新增 <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                            {!! Form::open(['url' => 'admin/parameter','method'=>'get','class'=>'form-horizontal adminex-form']) !!}
                            <div id="editable-sample_wrapper" class="dataTables_wrapper form-inline" role="grid">
                                <div class="row">
                                    <div class="dataTables_length" id="editable-sample_length" style="min-height: 70px;">
                                        <div class="col-lg-2">
                                            <label for="" style="line-height: 30px"> <strong>信息总量：{{$datas->total()}}</strong></label>
                                        </div>
                                        <div style="float: right; padding-right: 15px;">
                                            <div class="col-lg-2" style="width:auto;">
                                                <label>
                                                    参数名称:{!! Form::text('title', $params['title'], array('class' => 'form-control','placeholder'=>'参数名称')) !!}
                                                </label>
                                            </div>
                                            <div class="col-lg-2" style="width:auto;">
                                                <label>
                                                    参数标识:{!! Form::text('name', $params['name'], array('class' => 'form-control','placeholder'=>'参数标识')) !!}
                                                </label>
                                            </div>
                                            <div class="col-lg-2" style="width:auto;">
                                                <label>
                                                    控件类型: {!! Form::select('shape', $shapeHtml, $params['shape'], array('class' => 'input-sm m-bot15')) !!}
                                                </label>
                                            </div>
                                            <div class="col-lg-2" style="width:auto;">
                                                <label>
                                                    参数类型:{!! Form::text('type', $params['type'], array('class' => 'form-control','placeholder'=>'参数类型')) !!}
                                                </label>
                                            </div>
                                            <div class="col-lg-2" style="width:auto;">
                                                <label>
                                                    参数类目:{!! Form::text('cate', $params['cate'], array('class' => 'form-control','placeholder'=>'参数类目')) !!}
                                                </label>
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
                                    <th>参数名称</th>
                                    <th>参数标识</th>
                                    <th>控件类型</th>
                                    <th>备注说明</th>
                                    <th>参数类型</th>
                                    <th>参数类目</th>
                                    <th>调用方式</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($datas as $data)
                                    <tr>
                                        <td>{{$data->id}}</td>
                                        <td>{{ $data->title }}</td>
                                        <td>{{ $data->name }}</td>
                                        <td>{{ $data->shape }}</td>
                                        <td>{{ $data->note }}</td>
                                        <td>{{ $data->type }}</td>
                                        <td>{{ $data->cate }}</td>
                                        <td><pre>{!! '{!!' !!}get_params('{{$data->name}}')!!}</pre></td>
                                        <td>
                                            <a href="{{ url('admin/parameter/'.$data->id.'/edit')}}" class="btn btn-default">
                                                <i class="fa fa-book"></i> 编辑
                                            </a>
                                            <a href="{{ url('admin/parameter/destroy/'.$data->id)}}" class="btn btn-default">
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