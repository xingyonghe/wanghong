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
                        协议管理
                    </header>
                    <div class="panel-body">
                        <div class="adv-table editable-table ">
                            <div class="clearfix">
                                <div class="btn-group">
                                    <button id="editable-sample_new" url="{{ url('admin/protocol/add') }}" class="btn btn-primary">
                                        新增 <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                            {!! Form::open(['url' => 'admin/protocol/index','method'=>'get','class'=>'form-horizontal adminex-form']) !!}
                                <div id="editable-sample_wrapper" class="dataTables_wrapper form-inline" role="grid">
                                    <div class="row">
                                        <div class="dataTables_length" id="editable-sample_length" style="min-height: 70px;">
                                            <div class="col-lg-2">
                                                <label for="" style="line-height: 30px"> <strong>信息总量：{{$datas->total()}}</strong></label>
                                            </div>
                                            <div style="float: right; padding-right: 15px;">
                                                <div class="col-lg-2" style="width:auto;">
                                                    <label>协议标题: <input class="form-control" aria-controls="editable-sample" name="title" value="{{$params['title']}}" type="text"></label>
                                                </div>
                                                <div class="col-lg-2" style="width:auto;">
                                                    <label>操作员: <input class="form-control" aria-controls="editable-sample" name="name" value="{{$params['name']}}" type="text"></label>
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
                                    <th>标题</th>
                                    <th>新增时间</th>
                                    <th>修改时间</th>
                                    <th>操作员</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($datas as $data)
                                    <tr>
                                        <td>{{ $data->id }}</td>
                                        <td>{{ $data->title }}</td>
                                        <td>{{ $data->created_at }}</td>
                                        <td>{{ $data->updated_at }}</td>
                                        <td>{{ $data->name }}</td>
                                        <td>
                                            <a href="{{ url('admin/protocol/edit/'.$data->id)}}" class="btn btn-default">
                                                <i class="fa fa-book"></i> 编辑
                                            </a>
                                            <a href="{{ url('admin/protocol/destroy/'.$data->id)}}" class="btn btn-default" confirm>
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