@extends('admin.layouts.base')
@section('styles')
    <link rel="stylesheet" type="text/css" href="/assets/js/bootstrap-datepicker/css/datepicker-custom.css" />
    <link rel="stylesheet" type="text/css" href="/assets/js/bootstrap-timepicker/css/timepicker.css" />
    <link rel="stylesheet" type="text/css" href="/assets/js/bootstrap-colorpicker/css/colorpicker.css" />
    <link rel="stylesheet" type="text/css" href="/assets/js/bootstrap-daterangepicker/daterangepicker-bs3.css" />
    <link rel="stylesheet" type="text/css" href="/assets/js/bootstrap-datetimepicker/css/datetimepicker-custom.css" />
@endsection
@section('scripts')
    <script type="text/javascript" src="/assets/js/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
    <script type="text/javascript" src="/assets/js/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js"></script>
    <script type="text/javascript" src="/assets/js/bootstrap-daterangepicker/moment.min.js"></script>
    <script type="text/javascript" src="/assets/js/bootstrap-daterangepicker/daterangepicker.js"></script>
    <script type="text/javascript" src="/assets/js/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>
    <script type="text/javascript" src="/assets/js/bootstrap-timepicker/js/bootstrap-timepicker.js"></script>
    <script src="/assets/js/pickers-init.js"></script>
    <script>
       function del (id) {
            if (parseInt(id)) {
                layer.confirm("是否确认删除该信息?",{icon:3},function(){
                    layer.load(3);
                    $.get("{{url('/admin/sms/del')}}",{ids:id},function(data){
                        layer.closeAll('loading');
                        if (data.status > 0){
                            layer.msg(data.info,{icon:1});
                            setTimeout("location.reload()",3000);
                            return false;
                        } else {
                            layer.msg(data.info,{icon:2});
                        }
                    },'json').error(function(){
                        layer.msg('请求异常',{icon:2});
                    });
                });
            } else {
                layer.msg('请求参数错误，删除失败',{icon:2});
            }
       }
    </script>
@endsection
@section('content')
    <div class="page-heading">
        <h3>
            提示语！！！！！
        </h3>
    </div>
    <div class="wrapper">
        <div class="row">
            <div class="col-sm-12">
                <section class="panel">
                    <header class="panel-heading">
                        信息列表
                    <span class="tools pull-right">
                        <a href="javascript:;" class="fa fa-chevron-down"></a>
                        <a href="javascript:;" class="fa fa-times"></a>
                     </span>
                    </header>
                    <div class="panel-body">
                        <div class="adv-table editable-table ">
                            <div class="clearfix">
                                <div class="btn-group">
                                    <a href="{{url('/admin/sms/edit')}}">
                                        <button id="editable-sample_new" class="btn btn-primary">
                                            添加模板 <i class="fa fa-plus"></i>
                                        </button>
                                    </a>
                                </div>
                                <div class="btn-group pull-right">
                                    <button class="btn btn-default dropdown-toggle" data-toggle="dropdown">工具 <i class="fa fa-angle-down"></i>
                                    </button>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="{{url($_SERVER['REQUEST_URI'])}}">刷新</a></li>
                                        <li><a href="javascript:;">导出PDF</a></li>
                                        <li><a href="javascript:;">导出Excel</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="space15"></div>
                            <div id="editable-sample_wrapper" class="dataTables_wrapper form-inline" role="grid">
                                <form action="" method="get">
                                    <div class="row">
                                        <div class="dataTables_length" id="editable-sample_length" style="min-height: 70px;">
                                            <div class="col-lg-2">
                                                <label for="" style="line-height: 30px"> <strong>信息总量：{{$data->total()}}</strong></label>
                                            </div>
                                            <div style="float: right; padding-right: 15px;">
                                                <div class="col-lg-2" style="width:auto;">
                                                    <label>模板名称: <input class="form-control" maxlength="20" aria-controls="editable-sample" name="title" value="{{isset($where['title']) ? $where['title'] : ''}}" type="text"></label>
                                                </div>
                                                <div class="col-lg-2" style="width:auto;">
                                                    <label>客户群体:
                                                        <select aria-controls="dynamic-table" class="form-control" style="width: auto"  name="base">
                                                            <option value="">请选择</option>
                                                            @foreach($status_conf['base'] as $k=>$v)
                                                                <option value="{{$k}}" @if(isset($where['base'])) @if($k == $where['base'] && $where['base'] !=='') selected @endif @endif>{{$v}}</option>
                                                            @endforeach
                                                        </select>
                                                    </label>
                                                </div>
                                                <div class="col-lg-2" style="width:auto;">
                                                    <label>状态:
                                                        <select aria-controls="dynamic-table" class="form-control" style="width: auto"  name="status">
                                                            <option value="">请选择</option>
                                                            @foreach($status_conf['status'] as $k=>$v)
                                                                <option value="{{$k}}" @if(isset($where['base'])) @if($k == $where['status']) selected @endif @endif>{{$v['name']}}</option>
                                                            @endforeach
                                                        </select>
                                                    </label>
                                                </div>
                                                <div class="col-md-4" style="width: auto">
                                                    <label>添加时间:
                                                        <input class="form-control dpd1" value="{{isset($where['begin_time']) ? $where['begin_time'] : ''}}" name="begin_time" type="text">
                                                        <input class="form-control dpd1" value="{{isset($where['end_time']) ? $where['end_time'] : ''}}" name="end_time" type="text">
                                                    </label>
                                                </div>
                                                <button class="btn btn-default" type="submit"><i class="fa fa-search-minus"></i>搜索</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <table aria-describedby="editable-sample_info" class="table table-striped table-hover table-bordered dataTable" id="editable-sample">
                                    <thead>
                                        <tr role="row">
                                            <th>id</th>
                                            <th>模板名称</th>
                                            <th>客户群</th>
                                            <th>发送类目</th>
                                            <th>内容</th>
                                            <th>备注</th>
                                            <th>字符数</th>
                                            <th>状态</th>
                                            <th>添加时间</th>
                                            <th>审核员</th>
                                            <th>操作</th>
                                        </tr>
                                    </thead>
                                    <tbody aria-relevant="all" aria-live="polite" role="alert">
                                        @foreach($data as $k=>$v)
                                            <tr class="odd">
                                                <td class="  sorting_1">{{$v['id']}}</td>
                                                <td class=" "> {{$v['title']}}</td>
                                                <td class=" ">
                                                    @foreach($status_conf['base'] as $kq=>$vq)
                                                        @if($kq == $v['client_base'])
                                                            {{$vq}}
                                                        @endif
                                                    @endforeach
                                                </td>
                                                <td class=" ">
                                                    @foreach($status_conf['typeid'] as $t=>$tv)
                                                        @if($t == $v['typeid'])
                                                            {{$tv}}
                                                        @endif
                                                    @endforeach
                                                </td>
                                                <td class="center "> {{$v['content']}}</td>
                                                <td class=" "><a class="edit" href="javascript:;">{{$v['remark']}}</a></td>
                                                <td class=" "><a class="delete" href="javascript:;">{{mb_strlen($v['content'])}}</a></td>
                                                <td class=" ">
                                                    @foreach($status_conf['status'] as $s=>$sv)
                                                        @if($s == $v['status'])
                                                            <span class="{{$sv['class']}}">{{$sv['name']}}</span>
                                                        @endif
                                                    @endforeach
                                                </td>
                                                <td class=" "><a class="delete" href="javascript:;">{{$v['create_at']}}</a></td>
                                                <td class=" "><a class="delete" href="javascript:;">Delete</a></td>
                                                <td class=" ">
                                                    @if($v['status'] == 1 || $v['status'] == 2)
                                                        <a href="javascript:del('{{$v['id']}}');"><button class="btn btn-danger btn-xs" type="button"><i class="fa fa-trash-o"></i> 删除</button></a>
                                                        <a href="{{url('/admin/sms/edit')}}?id={{$v['id']}}"><button class="btn btn-warning btn-xs" type="button"><i class="fa fa-pencil"></i> 修改</button></a>
                                                    @endif
                                                    {{--<a href=""><button class="btn btn-info btn-xs" type="button"><i class="fa fa-info"></i> 详情</button></a>--}}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="dataTables_paginate paging_bootstrap pagination">
                                            {!! $data->appends($where)->links() !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
@endsection