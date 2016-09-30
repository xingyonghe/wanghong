@extends('admin.layouts.base')
@section('styles')
@endsection
@section('scripts')
    <script src="/static/new_layer/layer.js"></script>
    <script>
        {{--节点添加修改--}}
        $('.row').on('click','.submit_btn',function(){
            var tourl = $(this).parents('form').attr('action');
            $.post(tourl,$(this).parents('form').serialize(),function(data){
                if(data['status'] > 0){
                    layer.msg(data['info'],{icon:1,time:100},function(){
                        window.location.href = "{{url('admin/Public/logout')}}";
                    })
                }else{
                    layer.alert(data['info'],{icon:2});
                }
            },'json').error(function(){
                layer.alert('请求失败',{icon:2});
            })
        })
    </script>
@endsection

@section('content')
    <!--body wrapper start-->
    {{--内容页开始--}}
    <div class="wrapper">
        <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                        密码修改
                    </header>
                    <div class="panel-body">
                        <form role="form" class="form-horizontal adminex-form" method="post" action="{{url('admin/Access/password_save')}}">
                            {!! csrf_field() !!}
                            <div class="form-group">
                                <label class="col-sm-2 col-sm-2 control-label">旧密码</label>
                                <div class="col-sm-5">
                                    <input type="password" class="form-control" name="old_pass">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 col-sm-2 control-label">新密码</label>
                                <div class="col-sm-5">
                                    <input type="password" class="form-control" name="password">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 col-sm-2 control-label">确认密码</label>
                                <div class="col-sm-5">
                                    <input type="password" class="form-control" name="password_confirmation">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-lg-offset-2 col-lg-10">
                                    <button class="btn btn-info submit_btn" type="button">
                                        <i class="ace-icon fa fa-check bigger-110"></i>
                                        提交
                                    </button>
                                    &nbsp; &nbsp; &nbsp;
                                    <button class="btn" type="reset">
                                        <i class="ace-icon fa fa-undo bigger-110"></i>
                                        重置
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </section>
            </div>
        </div>
    </div>
    {{--内容页结束--}}
@endsection