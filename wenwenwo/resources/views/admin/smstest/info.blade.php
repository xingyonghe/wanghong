@extends('admin.layouts.base')
@section('styles')
@endsection
@section('content')
    <div class="page-heading">
        <h3>
            短信测试详情
        </h3>
    </div>
    <div class="row">
        <div class="col-md-6">
            <section class="panel">
                <header class="panel-heading">
                    测试统计
                    <span class="tools pull-right">
                        <a class="fa fa-chevron-down" href="javascript:;"></a>
                        <a class="fa fa-times" href="javascript:;"></a>
                    </span>
                </header>
                <div class="panel-body">
                    <p>提交时间： <code>{{$info['create_at']}}</code></p>
                    <p>提交数量： <code>{{$test_temp['list']->total()}}</code></p>
                    <p>发送成功： <code>{{$test_temp['ycount']}} <strong>({{sprintf("%.2f", ($test_temp['ycount'] / ($test_temp['list']->total()))*100)}}%)</strong></code></p>
                    <p>发送失败： <code>{{$test_temp['ncount']}} <strong>({{sprintf("%.2f", ($test_temp['ncount'] / ($test_temp['list']->total()))*100)}}%)</strong></code></p>
                </div>
            </section>
        </div>
        <div class="col-md-6">
            <section class="panel">
                <header class="panel-heading">
                    测试概况
                    <span class="tools pull-right">
                        <a class="fa fa-chevron-down" href="javascript:;"></a>
                        <a class="fa fa-times" href="javascript:;"></a>
                    </span>
                </header>
                <div class="panel-body">
                    <p>模板名称： <code>{{$temp['title']}}</code></p>
                    <p>模板内容： <code>{{$temp['content']}}</code></p>
                    <p>字符统计： <code>{{mb_strlen ($temp['content'])}}</code></p>
                    <p>发送客户群：
                        <code>
                            @foreach($status_conf['base'] as $t=>$tv)
                                @if($t == $temp['client_base'])
                                    {{$tv}}
                                @endif
                            @endforeach
                        </code>
                    </p>
                </div>
            </section>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    发送列表
                </header>
                <div class="panel-body">
                    <div class="adv-table editable-table ">
                        <div id="editable-sample_wrapper" class="dataTables_wrapper form-inline" role="grid">
                            <table aria-describedby="editable-sample_info" class="table table-striped table-hover table-bordered dataTable">
                                <thead>
                                <tr role="row">
                                    <th>手机号码</th>
                                    <th>状态</th>
                                    <th>发送时间</th>
                                </tr>
                                </thead>
                                <tbody aria-relevant="all" aria-live="polite" role="alert">
                                @foreach($test_temp['list'] as $k=>$v)
                                    <?php $v = (array) $v;?>
                                    <tr class="odd">
                                        <td style="width: 180px">{{$v['mobile']}}</td>
                                        <td style="width: 180px">{{$v['status'] == 1 ? '成功' : '失败'}}</td>
                                        <td><a class="delete" href="javascript:;">{{$v['create_at']}}</a></td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="dataTables_paginate paging_bootstrap pagination">
                                        {!! $test_temp['list']->appends($where)->links() !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection