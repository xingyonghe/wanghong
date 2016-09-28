@extends('admin.public.base')
@section('style')
@stop
@section('script')
    <script type="text/javascript">
        $(function () {
            highlight_subnav("{{ url('admin/admin/index') }}");
        })
    </script>
@stop
@section('body')
    <!-- page start-->
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    管理员
                </header>
                <div class="panel-body">
                    <div class="clearfix">
                        <div class="btn-group">
                            <a href="{{ url('admin/admin/add') }}" class="btn btn-primary ajax-update">
                                新增 <i class="fa icon-plus"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div id="sample_1_wrapper" class="dataTables_wrapper form-inline" role="grid">
                    <div class="row">
                        <div class="col-sm-12">
                            {!! Form::open(['url' => 'admin/admin/index','method'=>'get']) !!}
                            <div class="dataTables_filter" id="sample_1_filter">
                                <button class="btn btn-primary" type="submit"><i class="fa icon-search"></i>搜索</button>
                            </div>
                            <div class="dataTables_filter" id="sample_1_filter">
                                <label>
                                    用户名：<input type="text" name="title" aria-controls="sample_1" value="" class="form-control">
                                </label>
                            </div>
                            {!!Form::close()!!}
                        </div>
                    </div>
                    <table class="table table-striped border-top" id="sample_1">
                        <thead>
                        <tr>
                            <th style="width:8px;">
                                <input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes"/></th>
                            <th>UID</th>
                            <th class="hidden-phone">用户名</th>
                            <th class="hidden-phone">昵称</th>
                            <th class="hidden-phone">用户组</th>
                            <th class="hidden-phone">注册时间</th>
                            <th class="hidden-phone">最近登录时间</th>
                            <th class="hidden-phone">最近登陆IP</th>
                            <th class="hidden-phone">状态</th>
                            <th class="hidden-phone">操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($datas as $data)
                            <tr class="odd gradeX">
                                <td><input type="checkbox" class="checkboxes" value="{{ $data->id }}"/></td>
                                <td>{{ $data->id }}</td>
                                <td>{{ $data->username }}</td>
                                <td>{{ $data->nickname }}</td>
                                <td>{{ $data->role_id_text }}</td>
                                <td class="hidden-phone">{{ $data->reg_time }}</td>
                                <td class="hidden-phone">{{ $data->login_time }}</td>
                                <td class="hidden-phone">{{ $data->login_ip }} </td>
                                <td class="hidden-phone">{!!  $data->status_text !!} </td>
                                <td class="hidden-phone">
                                    <!--正常状态-->
                                    @if($data->status == 1)
                                        <a class="btn btn-primary btn-xs ajax-update" href="{{ url('admin/admin/edit',[$data->id]) }}"><i class="icon-pencil"></i> 修改</a>
                                        <a class="btn btn-warning btn-xs ajax-confirm forbid" href="{{ url('admin/admin/forbid',[$data->id]) }}"><i class="icon-info-sign"></i> 禁用</a>
                                        <a class="btn btn-danger btn-xs ajax-confirm destroy" href="{{ url('admin/admin/destroy',[$data->id]) }}"><i class="icon-trash "></i> 删除</a>
                                    @endif
                                    <!--禁用状态-->
                                    @if($data->status == 0)
                                        <a class="btn btn-primary btn-xs ajax-update" href="{{ url('admin/admin/edit',[$data->id]) }}"><i class="icon-pencil"></i> 修改</a>
                                        <a class="btn btn-success btn-xs ajax-confirm resume" href="{{ url('admin/admin/resume',[$data->id]) }}"><i class=" icon-ok-circle"></i> 启用</a>
                                        <a class="btn btn-danger btn-xs ajax-confirm destroy" href="{{ url('admin/admin/destroy',[$data->id]) }}"><i class="icon-trash "></i> 删除</a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="dataTables_info" id="sample_1_info">共 {{ $datas->total() }} 条记录</div>
                        </div>
                        <div class="col-sm-6" style="text-align: right;position: relative;top:-25px;height: 39px">
                            {!! $datas->appends($pages)->render() !!}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <!-- page end-->
@stop