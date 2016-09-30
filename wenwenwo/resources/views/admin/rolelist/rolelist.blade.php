@extends('admin.layouts.base')
@section('styles')
<!--dynamic table-->
<link href="/assets/js/advanced-datatable/css/demo_page.css" rel="stylesheet" />
<link href="/assets/js/advanced-datatable/css/demo_table.css" rel="stylesheet" />
<link rel="stylesheet" href="/assets/js/data-tables/DT_bootstrap.css" />
@endsection
@section('scripts')

@endsection

@section('content')
<!--body wrapper start-->
{{--内容页开始--}}
<div class="wrapper">
    <div class="row">
        <div class="col-md-12">
            <!--breadcrumbs start -->
            <ul class="breadcrumb panel">
                <li><a href="#"><i class="fa fa-home"></i> Home</a></li>
                <li><a href="#">Dashboard</a></li>
                <li class="active">Current page</li>
            </ul>
            <!--breadcrumbs end -->
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <section class="panel">
                <header class="panel-heading">
                    <div class="clearfix">
                        权限组列表
                        <div class="btn-group pull-right">
                            <a role="button"  class="btn btn-info" href="{{url('admin/access/roleadd')}}">
                                添加 <i class="fa fa-plus"></i>
                            </a>
                        </div>
                    </div>
                </header>
                <div class="panel-body">
                    <div class="adv-table">
                        {{--信息列表开始--}}
                        <table  class="display table table-bordered table-striped">
                            <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>名称</th>
                                        <th>备注</th>
                                        <th>排序</th>
                                        <th>状态</th>
                                        <th>操作</th>
                                    </tr>
                            </thead>
                            <tbody>
                                @foreach($roleList as $v)
                                <tr class="gradeA">
                                    <td>{{$v['id']}}</td>
                                    <td>{{$v['name']}}</td>
                                    <td>{{$v['remarks']}}</td>
                                    <td>{{$v['sort']}}</td>
                                    <td>{{get_rolelist_status_name($v['status'])}}</td>
                                    <td style="width: 20%" class="center">
                                        <a role="button" href="{{url('admin/access/roleedit',[$v['id']])}}" class="btn btn-info">编辑</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{--信息列表结束--}}
                        {{--分页html开始--}}
                        {{--{{ $roleList->links() }}--}}
                        <div class="row-fluid">

                            <div class="span6">
                                <div class="dataTables_paginate paging_bootstrap pagination">
                                    {{ $roleList->links('admin.layouts.page_html') }}
                                </div>
                            </div>
                        </div>
                        {{--分页html结束--}}
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
{{--内容页结束--}}
@endsection