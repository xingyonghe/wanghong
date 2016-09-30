@extends('admin.layouts.base')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <section class="panel">
                <header class="panel-heading">
                    <div class="clearfix">
                        SEO列表
                        <div class="btn-group pull-right">
                            <a role="button" class="btn btn-info" href="{{url('/admin/seo/rule_add')}}">
                                添加新SEO <i class="fa fa-plus"></i>
                            </a>
                        </div>
                    </div>
                </header>
                <div class="panel-body">
                    <div class="adv-table">
                        <table aria-describedby="editable-sample_info"
                               class="table table-striped table-hover table-bordered dataTable">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th class="col-md-1">名称</th>
                                <th class="col-md-2">title</th>
                                <th class="col-md-3">keywords</th>
                                <th class="col-md-4">description</th>
                                <th class="col-md-1"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($lists as $item)
                                <tr>
                                    <th>{{$item->id}}</th>
                                    <th>{{$item->page_name}}</th>
                                    <th>{{$item->title}}</th>
                                    <th>{{$item->keywords}}</th>
                                    <th>{{$item->description}}</th>
                                    <th>

                                        <div class="btn-group">
                                            <a class="btn btn-default" href="/admin/seo/rule_edit/{{$item->id}}" type="button">修改</a>
                                        </div><!-- /btn-group -->

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