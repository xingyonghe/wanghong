@extends('admin.layouts.base')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <section class="panel">
                <header class="panel-heading">
                    <div class="clearfix">
                        缩微图列表
                        <div class="btn-group pull-right">
                            <a role="button" class="btn btn-info" href="{{url('/admin/thumbnail/rule_add')}}">
                                添加新尺寸 <i class="fa fa-plus"></i>
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
                                <th class="">ID</th>
                                <th class="col-md-2">名称</th>
                                <th class="col-md-2">宽度</th>
                                <th class="col-md-2">高度</th>
                                @foreach($types as $_key => $_typeName)
                                <th>{{$_typeName}}</th>
                                @endforeach
                                <th></th>
                            </tr>
                            <form action="/admin/thumbnail/rule_list" method="get">

                            <tr>
                                <th>--</th>
                                <th><input class="form-control col-md-1" title="" type="text" name="name" value="{{$name ?? ''}}"></th>
                                <th><input class="form-control" title="" type="text" name="width" value="{{$width ?? ''}}"></th>
                                <th><input class="form-control" title="" type="text" name="height" value="{{$height ?? ''}}"></th>
                                @foreach($types as $_key => $_typeName)
                                <th>
                                    <select name="types[{{$_key}}]" title="" class="form-control m-bot15">
                                        <option value="">--</option>
                                        <option value="0" @if(isset($selectedTypes[$_key]) && !$selectedTypes[$_key]) selected @endif>停用</option>
                                        <option value="1" @if(isset($selectedTypes[$_key]) && $selectedTypes[$_key]) selected @endif>启用</option>
                                    </select>
                                </th>
                                @endforeach
                                <th>
                                    <button type="submit" class="btn btn-primary">搜索</button>
                                </th>
                            </tr>

                            </form>
                            </thead>
                            <tbody>
                            @foreach($lists as $item)
                            <tr>
                                <th>{{$item->id}}</th>
                                <th>{{$item->name}}</th>
                                <th>{{$item->width}}</th>
                                <th>{{$item->height}}</th>
                                @foreach($types as $_key => $_typeName)
                                <th>@if($item->scope & $_key) <i class="fa fa-check"></i> @else <i class="fa fa-times"></i> @endif</th>
                                @endforeach
                                <th>

                                    <div class="btn-group">
                                        <a class="btn btn-default" href="/admin/thumbnail/rule_edit/{{$item->id}}" type="button">修改</a>
                                        <button data-toggle="dropdown" class="btn btn-default dropdown-toggle" type="button">
                                            <span class="caret"></span>
                                            <span class="sr-only">Toggle Dropdown</span>
                                        </button>
                                        <ul role="menu" class="dropdown-menu">
                                            <li><a href="javascript:alert('暂时不支持删除')">删除</a></li>
                                        </ul>
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