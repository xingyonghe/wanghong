@extends('admin.layouts.base')
@section('styles')
<!--dynamic table-->
<link href="/assets/js/advanced-datatable/css/demo_page.css" rel="stylesheet" />
<link href="/assets/js/advanced-datatable/css/demo_table.css" rel="stylesheet" />
<link rel="stylesheet" href="/assets/js/data-tables/DT_bootstrap.css" />
@endsection
@section('scripts')
<script src="/static/new_layer/layer.js"></script>
<script>
    {{--节点删除--}}
    $('.row').on('click','.del_btn',function(){
        var tourl = "{{url('admin/adminlist/admin_list_Del')}}";
        var _this = $(this);
        var _id = _this.parents('tr').attr('data-id');
        layer.confirm('确定删除该账号？删除后无法恢复！',function () {
            $.get(tourl,{id:_id},function(data){
                if(data['status'] > 0){
                    layer.msg(data['info'],{icon:1,time:100},function(){
                        window.location.reload();
                    })
                }else{
                    layer.alert(data['info'],{icon:2});
                }
            },'json').error(function(){
                layer.alert('请求失败',{icon:2});
            });
        });

    });
    {{--锁定、解锁--}}
    $('.row').on('click','.lock_btn',function(){
        var tourl = "{{url('admin/adminlist/save_admin_list_status')}}";
        var _this = $(this);
        var _id = _this.parents('tr').attr('data-id');

            $.get(tourl,{id:_id},function(data){
                if(data['status'] > 0){
                    layer.msg(data['info'],{icon:1,time:100},function(){
                        window.location.reload();
                    })
                }else{
                    layer.alert(data['info'],{icon:2});
                }
            },'json').error(function(){
                layer.alert('请求失败',{icon:2});
            });
    });
    {{--重置密码--}}
    $('.row').on('click','.reset_btn',function(){
        var tourl = "{{url('admin/adminlist/admin_password_reset')}}";
        var _this = $(this);
        var _id = _this.parents('tr').attr('data-id');

        $.get(tourl,{id:_id},function(data){
            if(data['status'] > 0){
                layer.msg(data['info'],{icon:1,time:100},function(){
                    window.location.reload();
                })
            }else{
                layer.alert(data['info'],{icon:2});
            }
        },'json').error(function(){
            layer.alert('请求失败',{icon:2});
        });
    });
</script>
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
                        员工列表
                        <div class="btn-group pull-right">
                            <a role="button"  class="btn btn-info" href="{{url('admin/adminlist/add')}}">
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
                                        <th>登录名</th>
                                        <th>工号</th>
                                        <th>权限组</th>
                                        <th>职位</th>
                                        <th>姓名全拼</th>
                                        <th>电话号码</th>
                                        <th>排序值</th>
                                        <th>上次登录ip</th>
                                        <th>是否锁定</th>
                                        <th>操作</th>
                                    </tr>
                            </thead>
                            <tbody>
                                @foreach($userinfo as $v)
                                <tr class="gradeA" data-id="{{$v['id']}}">
                                    <td>{{$v['id']}}</td>
                                    <td>{{$v['name']}}</td>
                                    <td>{{$v['code']}}</td>
                                    <td>{{$v['role_name']}}</td>
                                    <td>{{$v['position_name']}}</td>
                                    <td>{{$v['user_pin']}}</td>
                                    <td>{{$v['phone']}}</td>
                                    <td>{{$v['sort']}}</td>
                                    <td>{{$v['login_ip']}}</td>
                                    <td>{{get_adminlist_status_name($v['lock'])}}</td>
                                    <td style="width: 20%" class="center">
                                        <a href="{{url('admin/adminlist/edit',[$v['id']])}}" class="btn btn-default btn-sm"><i class="fa fa-edit"></i> 修改</a>
                                        <button type="button" class="btn btn-default btn-sm del_btn"><i class="fa fa-trash-o"></i> 删除</button>
                                        @if($v['lock'] == 1)
                                        <button type="button" class="btn btn-default btn-sm lock_btn"><i class="fa fa-lock"></i> 锁定</button>
                                            @elseif($v['lock'] == 2)
                                        <button type="button" class="btn btn-default btn-sm lock_btn"><i class="fa fa-unlock"></i> 解锁</button>
                                        @endif
                                        <button type="button" class="btn btn-default btn-sm reset_btn"><i class="fa fa-undo"></i> 重置密码</button>
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
                                    {{ $userinfo->links('admin.layouts.page_html') }}
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