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
                        提示语
                    </header>
                    <div class="panel-body">
                        <div class="adv-table editable-table ">
                            <div class="clearfix">
                                <div class="btn-group">
                                    <button id="editable-sample_new" url="{{ url('admin/reminder/create') }}" class="btn btn-primary">
                                        新增 <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                            {!! Form::open(['url' => 'admin/reminder','method'=>'get','class'=>'form-horizontal adminex-form']) !!}
                                <div id="editable-sample_wrapper" class="dataTables_wrapper form-inline" role="grid">
                                    <div class="row">
                                        <div class="dataTables_length" id="editable-sample_length" style="min-height: 70px;">
                                            <div class="col-lg-2">
                                                <label for="" style="line-height: 30px"> <strong>信息总量：{{$datas->total()}}</strong></label>
                                            </div>
                                            <div style="float: right; padding-right: 15px;">
                                                <div class="col-lg-2" style="width:auto;">
                                                    <label>提示语名称: <input class="form-control" aria-controls="editable-sample" name="title" value="{{$title}}" type="text"></label>
                                                </div>
                                                <div class="col-lg-2" style="width:auto;">
                                                    <label>提示语标识: <input class="form-control" aria-controls="editable-sample" name="name" value="{{$name}}" type="text"></label>
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
                                    <th>名称</th>
                                    <th>标识</th>
                                    <th>调用方式</th>
                                    <th>状态</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($datas as $data)
                                    <tr>
                                        <td>{{$data->id}}</td>
                                        <td>{{ $data->title }}</td>
                                        <td>{{ $data->name }}</td>
                                        <td><pre>{!! '{!!' !!}get_reminder('{{$data->name}}')!!}</pre></td>
                                        <td>
                                            @if($data['status'] == 1)
                                                <span class="label label-warning label-mini">启用</span>
                                            @else
                                                <span class="label label-danger label-mini">禁用</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ url('admin/reminder/'.$data->id.'/edit')}}" class="btn btn-default">
                                                <i class="fa fa-book"></i> 编辑
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