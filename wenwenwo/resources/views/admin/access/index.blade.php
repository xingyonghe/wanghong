@extends('admin.layouts.base')
@section('styles')
<!--dynamic table-->
<link href="/assets/js/advanced-datatable/css/demo_page.css" rel="stylesheet" />
<link href="/assets/js/advanced-datatable/css/demo_table.css" rel="stylesheet" />
<link rel="stylesheet" href="/assets/js/data-tables/DT_bootstrap.css" />
@endsection
@section('scripts')
<!--dynamic table-->
<script type="text/javascript" language="javascript" src="/assets/js/advanced-datatable/js/jquery.dataTables.js"></script>
<script type="text/javascript" src="/assets/js/data-tables/DT_bootstrap.js"></script>
<!--dynamic table initialization -->
<script src="/assets/js/dynamic_table_init.js"></script>

<!--common scripts for all pages-->
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
                    Dynamic Table
                    <span class="tools pull-right">
                        <a href="javascript:;" class="fa fa-chevron-down"></a>
                        <a href="javascript:;" class="fa fa-times"></a>
                     </span>
                </header>
                <div class="panel-body">
                    <div class="adv-table">
                        {{--信息列表开始--}}
                        <table  class="display table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Rendering engine</th>
                                <th>Browser</th>
                                <th>Platform(s)</th>
                                <th class="hidden-phone">Engine version</th>
                                <th class="hidden-phone">CSS grade</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr class="gradeX">
                                <td>Trident</td>
                                <td>Internet
                                    Explorer 4.0</td>
                                <td>Win 95+</td>
                                <td class="center hidden-phone">4</td>
                                <td class="center hidden-phone">X</td>
                            </tr>
                            <tr class="gradeC">
                                <td>Trident</td>
                                <td>Internet
                                    Explorer 5.0</td>
                                <td>Win 95+</td>
                                <td class="center hidden-phone">5</td>
                                <td class="center hidden-phone">C</td>
                            </tr>
                            <tr class="gradeA">
                                <td>Trident</td>
                                <td>Internet
                                    Explorer 5.5</td>
                                <td>Win 95+</td>
                                <td class="center hidden-phone">5.5</td>
                                <td class="center hidden-phone">A</td>
                            </tr>
                            <tr class="gradeA">
                                <td>Trident</td>
                                <td>Internet
                                    Explorer 6</td>
                                <td>Win 98+</td>
                                <td class="center hidden-phone">6</td>
                                <td class="center hidden-phone">A</td>
                            </tr>
                            <tr class="gradeA">
                                <td>Trident</td>
                                <td>Internet Explorer 7</td>
                                <td>Win XP SP2+</td>
                                <td class="center hidden-phone">7</td>
                                <td class="center hidden-phone">A</td>
                            </tr>
                            <tr class="gradeA">
                                <td>Trident</td>
                                <td>AOL browser (AOL desktop)</td>
                                <td>Win XP</td>
                                <td class="center hidden-phone">6</td>
                                <td class="center hidden-phone">A</td>
                            </tr>
                            <tr class="gradeA">
                                <td>Gecko</td>
                                <td>Firefox 1.0</td>
                                <td>Win 98+ / OSX.2+</td>
                                <td class="center hidden-phone">1.7</td>
                                <td class="center hidden-phone">A</td>
                            </tr>
                            <tr class="gradeA">
                                <td>Gecko</td>
                                <td>Firefox 1.5</td>
                                <td>Win 98+ / OSX.2+</td>
                                <td class="center hidden-phone">1.8</td>
                                <td class="center hidden-phone">A</td>
                            </tr>
                            <tr class="gradeA">
                                <td>Gecko</td>
                                <td>Firefox 2.0</td>
                                <td>Win 98+ / OSX.2+</td>
                                <td class="center hidden-phone">1.8</td>
                                <td class="center hidden-phone">A</td>
                            </tr>
                            <tr class="gradeA">
                                <td>Gecko</td>
                                <td>Firefox 3.0</td>
                                <td>Win 2k+ / OSX.3+</td>
                                <td class="center hidden-phone">1.9</td>
                                <td class="center hidden-phone">A</td>
                            </tr>
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>aaaaaRendering engine</th>
                                <th>Browser</th>
                                <th>Platform(s)</th>
                                <th class="hidden-phone">Engine version</th>
                                <th class="hidden-phone">CSS grade</th>
                            </tr>
                            </tfoot>
                        </table>
                        {{--信息列表结束--}}
                        {{--分页html开始--}}
                        <div class="row-fluid">
                            <div class="span6">
                                <div id="dynamic-table_info" class="dataTables_info">Showing 1 to 10 of 10 entries</div>
                            </div>
                            <div class="span6">
                                <div class="dataTables_paginate paging_bootstrap pagination">
                                    <ul>
                                        <li><a href="#">«</a></li>
                                        <li><a href="#">1</a></li>
                                        <li><a href="#">2</a></li>
                                        <li class="active"><a href="#">3</a></li>
                                        <li><a href="#">4</a></li>
                                        <li><a href="#">5</a></li>
                                        <li><a href="#">»</a></li>
                                    </ul>
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