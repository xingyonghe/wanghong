@extends('admin.public.base')
@section('style')
@stop
@section('script')
    <script type="text/javascript">
        $(function () {
            highlight_subnav("{{ url('admin/personal/index') }}");
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
                            <a href="{{ url('admin/personal/add') }}" class="btn btn-primary ajax-update">
                                新增 <i class="fa icon-plus"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div id="sample_1_wrapper" class="dataTables_wrapper form-inline" role="grid">
                    <div class="row">
                        <div class="col-sm-12">
                            {!! Form::open(['url' => 'admin/personal/index','method'=>'get']) !!}
                            <div class="dataTables_filter" id="sample_1_filter">
                                <button class="btn btn-primary" type="submit"><i class="fa icon-search"></i>搜索</button>
                            </div>
                            <div class="dataTables_filter" id="sample_1_filter">
                                <label>
                                    用户名：<input type="text" name="username" aria-controls="sample_1" value="{{ $pages['username'] }}" class="form-control">
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
                            <th class="hidden-phone">联系人</th>
                            <th class="hidden-phone">QQ号码</th>
                            <th class="hidden-phone">资源媒体</th>
                            <th class="hidden-phone">待结算金额</th>
                            <th class="hidden-phone">已结算金额</th>
                            <th class="hidden-phone">余额</th>
                            <th class="hidden-phone">所属客服</th>
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
                                <td>{{ $data->qq }}</td>
                                <td>{{ $data->medias }}</td>
                                <td>{{ $data->wait_account }}</td>
                                <td>{{ $data->finish_account }}</td>
                                <td>{{ $data->balance }} </td>
                                <td>
                                    @if($data->custom_id)
                                        <a href="{{ url('admin/admin/show',[$data->custom_id]) }}">{{ $data->custom_name }}</a>
                                    @else
                                        <a href="{{ url('admin/personal/addCustom',[$data->id]) }}" class="btn btn-info btn-xs ajax-update">
                                            <i class="icon-plus-sign"></i> 添加
                                        </a>
                                    @endif
                                </td>
                                <td class="hidden-phone">{!!  $data->status_text !!} </td>
                                <td class="hidden-phone">
                                    <!--正常状态-->
                                    @if($data->status == 1)
                                        <a class="btn btn-primary btn-xs" href="{{ url('admin/personal/edit',[$data->id]) }}"><i class="icon-pencil"></i> 修改</a>
                                        <a class="btn btn-warning btn-xs ajax-confirm forbid" href="{{ url('admin/personal/forbid',[$data->id]) }}"><i class="icon-info-sign"></i> 禁用</a>
                                        <a class="btn btn-danger btn-xs ajax-confirm destroy" href="{{ url('admin/personal/destroy',[$data->id]) }}"><i class="icon-trash "></i> 删除</a>
                                    @endif
                                    <!--禁用状态-->
                                    @if($data->status == 0)
                                        <a class="btn btn-primary btn-xs" href="{{ url('admin/personal/edit',[$data->id]) }}"><i class="icon-pencil"></i> 修改</a>
                                        <a class="btn btn-success btn-xs ajax-confirm resume" href="{{ url('admin/personal/resume',[$data->id]) }}"><i class=" icon-ok-circle"></i> 启用</a>
                                        <a class="btn btn-danger btn-xs ajax-confirm destroy" href="{{ url('admin/personal/destroy',[$data->id]) }}"><i class="icon-trash "></i> 删除</a>
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