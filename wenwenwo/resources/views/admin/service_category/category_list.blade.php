@extends('admin.layouts.base')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <section class="panel">
                <header class="panel-heading">
                    <div class="clearfix">
                        服务分类列表
                    </div>
                </header>
                <div class="panel-body">
                    <div class="adv-table">
                        <table aria-describedby="editable-sample_info"
                               class="table table-striped table-hover table-bordered dataTable">
                            <thead>
                            <tr>
                                <th class="col-md-1">ID</th>
                                <th class="col-md-2">类目名称</th>
                                <th class="col-md-3">简称</th>
                                <th></th>
                            </tr>
                            <form action="{{url('/admin/service_category/category_list')}}" method="get">
                                <tr>
                                    <th class="col-md-1">--</th>
                                    <th class="col-md-2"><input title="" type="text" name="category_name" class="form-control"></th>
                                    <th class="col-md-2"><input title="" type="text" name="short_name" class="form-control"></th>
                                    <th>
                                        <button class="btn btn-primary" type="submit"><i class="fa fa-search-minus"></i>搜索</button>
                                    </th>
                                </tr>
                            </form>
                            </thead>
                            <tbody>

                            @foreach($lists as $item)
                                <tr>
                                    <th>{{ $item['id'] }}</th>
                                    <th>{{ $item['category_name'] }}</th>
                                    <th>{{ $item['short_name'] }}</th>
                                    <th>

                                        <div class="btn-group">
                                            <a class="btn btn-default" href="/admin/service_category/category_edit/{{$item['id']}}" type="button">修改</a>
                                            <button data-toggle="dropdown" class="btn btn-default dropdown-toggle" type="button">
                                                <span class="caret"></span>
                                                <span class="sr-only">Toggle Dropdown</span>
                                            </button>
                                            <ul role="menu" class="dropdown-menu">
                                                <li><a href="javascript:alert('暂不支付删除,请联系开发')">删除</a></li>
                                            </ul>
                                        </div>
                                    </th>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection