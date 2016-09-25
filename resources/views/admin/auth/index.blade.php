@extends('admin.public.base')
@section('style')
@stop
@section('script')
    <script type="text/javascript">
        $(function () {
            highlight_subnav("{{ url('admin/menu/index') }}");

            //新增菜单
            $('.ajax-add-menu').click(function(){
                layer.closeAll();
                var target = $(this).attr('href');
                var that = this;
                $.get(target).success(function(data){
                    layer.open({
                        type    : 1,
                        skin    : 'layer-ext-admin',
                        closeBtn: 1,
                        title   : '新增菜单',
                        area    : ['650px'],
                        btn     : ['确定', '取消'],
                        shade   : false,
                        content : data,
                        yes     : function(index){
                            var form = $('.form-datas');
                            var url = form.get(0).action;
                            var query = form.serialize();
                            $.post(url,query,function(datas){
                                if(datas.status==1){
                                    updateAlert(datas.success + ' 页面即将自动跳转~','alert-success',datas.url);
                                }else{
                                    updateAlert(datas.error);
                                }
                            });
                        }
                    });
                });
                return false;
            });

            $('body').on('click','.ajax-edit-menu',function () {
                layer.closeAll();
                var target = $(this).attr('href');
                var that = this;
                $.get(target).success(function(data){
                    layer.open({
                        type    : 1,
                        skin    : 'layer-ext-admin',
                        closeBtn: 1,
                        title   : '编辑菜单',
                        area    : ['650px'],
                        btn     : ['确定', '取消'],
                        shade   : false,
                        content : data,
                        yes     : function(index){
                            var form = $('.form-datas');
                            var url = form.get(0).action;
                            var query = form.serialize();
                            $.post(url,query,function(datas){
                                if(datas.status==1){
                                    updateAlert(datas.success + ' 页面即将自动跳转~','alert-success',datas.url);
                                }else{
                                    updateAlert(datas.error);
                                }
                            });
                        }
                    });
                });
                return false;
            });

        })
    </script>
@stop
@section('body')
    <!-- page start-->
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    用户组管理
                </header>
                <div class="panel-body">
                    <div class="clearfix">
                        <div class="btn-group">
                            <a href="{{ url('admin/auth/addGroup') }}" class="btn btn-primary ajax-add">
                                新增 <i class="fa icon-plus"></i>
                            </a>
                        </div>
                        <div class="btn-group">
                            <a href="{{ url('admin/menu/batch') }}" class="btn btn-info ajax-delete confirm">
                                导入 <i class="fa icon-skype"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div id="sample_1_wrapper" class="dataTables_wrapper form-inline" role="grid">
                    <table class="table table-striped border-top" id="sample_1">
                        <thead>
                        <tr>
                            <th style="width:8px;">
                                <input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes"/>
                            </th>
                            <th class="hidden-phone">用户组</th>
                            <th class="hidden-phone">描述</th>
                            <th class="hidden-phone">状态</th>
                            <th class="hidden-phone">操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($datas as $data)
                            <tr class="odd gradeX">
                                <td><input type="checkbox" class="checkboxes" value="{{ $data->id }}"/></td>
                                <td>{{ $data->title }}</td>
                                <td class="hidden-phone">{{ $data->description }}</td>
                                <td class="hidden-phone">{{ $data->status_text }}</td>
                                <td class="hidden-phone">
                                    <a class="btn btn-primary btn-xs ajax-edit-menu" href="{{ url('admin/menu/edit',[$data->id]) }}"><i class="icon-pencil"></i> 授权</a>
                                    <a class="btn btn-primary btn-xs ajax-edit-menu" href="{{ url('admin/menu/edit',[$data->id]) }}"><i class="icon-pencil"></i> 修改</a>
                                    <a class="btn btn-danger btn-xs ajax-confirm" href="{{ url('admin/menu/destroy',[$data->id]) }}"><i class="icon-trash "></i> 删除</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="dataTables_info" id="sample_1_info">共 25 条记录</div>
                        </div>
                        <div class="col-sm-6" style="text-align: right;position: relative;top:-25px;height: 39px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <!-- page end-->
@stop