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
                        信息测试列表
                    <span class="tools pull-right">
                        <a href="javascript:;" class="fa fa-chevron-down"></a>
                        <a href="javascript:;" class="fa fa-times"></a>
                     </span>
                    </header>
                    <div style="height: 300px;">
                        <form action="{{url('/admin/smstest/send')}}" method="post">
                            {{csrf_field()}}
                            <div class="form-group{{ $errors->has('template_id') ? ' has-error' : '' }}" style="padding-top: 20px;">
                                <label for="ccomment" class="control-label col-lg-2" style="width: 150px;"><span class="text-danger">*</span> 选择发送模板：</label>
                                <div style="">
                                    <select aria-controls="dynamic-table" class="form-control" style="width: auto;"  name="template_id">
                                        <option value="">请选择</option>
                                        @foreach($template  as $k=>$v)
                                            <option value="{{$v}}">{{$k}}</option>
                                        @endforeach
                                    </select>
                                    <span class="help-block" style="margin-left: 150px"><strong>{{ $errors->first('template_id') }}</strong></span>
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('content') ? ' has-error' : '' }}">
                                <label for="ccomment" class="control-label col-lg-2" style="width: 135px;"><span class="text-danger">*</span> 模板内容：</label>
                                <div class="col-lg-11">
                                    <textarea class="form-control " style="height: 150px;" id="ccomment" name="content" required maxlength="200" ></textarea>
                                    <span class="help-block"><strong style="color: goldenrod;" class="font-number">测试手机号输入，每个手机号之间请以小写的（,）逗号隔开。一次最多发送100个手机号</strong></span>
                                    <span class="help-block"><strong>{{ $errors->first('content') }}</strong></span>
                                </div>
                            </div>
                            <div style="text-align: right; padding-right: 18px;"><input type="submit" class="btn" value="发送测试短信"></div>
                        </form>
                    </div>
                    <div class="panel-body">
                        <div class="adv-table editable-table ">
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
                                            <th>内容</th>
                                            <th>客户群</th>
                                            <th>添加时间</th>
                                            <th>操作</th>
                                        </tr>
                                    </thead>
                                    <tbody aria-relevant="all" aria-live="polite" role="alert">
                                        @foreach($data as $k=>$v)
                                            <?php $v = (array) $v;?>
                                            <tr class="odd">
                                                <td class="  sorting_1">{{$v['id']}}</td>
                                                <td class=" "> {{$v['title']}}</td>
                                                <td class="center "> {{$v['content']}}</td>
                                                <td class=" ">
                                                    @foreach($status_conf['base'] as $t=>$tv)
                                                        @if($t == $v['client_base'])
                                                            {{$tv}}
                                                        @endif
                                                    @endforeach
                                                </td>
                                                <td class=" "><a class="delete" href="javascript:;">{{$v['create_at']}}</a></td>
                                                <td class=" ">
                                                    <a href="{{url('admin/smstest/info')}}?id={{$v['id']}}"><button class="btn btn-info btn-xs" type="button"><i class="fa fa-info"></i> 详情</button></a>
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