@extends('admin.layouts.base')
@section('styles')
<link rel="stylesheet" href="/static/zTree/zTreeStyle.css" type="text/css">
<style type="text/css">
    .ztree li span.button.switch.level0 {visibility:hidden; width:1px;}
    .ztree li ul.level0 {padding:0; background:none;}
    .ztree li{margin:3px 0;}
</style>
@endsection
@section('scripts')
    <script src="/static/new_layer/layer.js"></script>
    <script type="text/javascript" src="/static/zTree/jquery.ztree.all-3.5.min.js"></script>
    <script>
        var setting = {
            view: {
                dblClickExpand: true
            },
            data: {
                simpleData: {
                    enable: true,
                    idKey: "id",
                    pIdKey: "pid"
                },
                key: {
                    name: "name"
                }
            },
            check: {
                enable: true,
                chkStyle: "checkbox",
                chkboxType: { "Y": "p", "N": "s" }
            },
            callback:{
                onCheck:onCheck
            }
        };
        setting.check.chkboxType = { "Y" : "ps", "N" : "ps" };

        var zNodes ={!! $nodeList !!};
        $(document).ready(function(){
            $.fn.zTree.init($("#treeAdv"), setting, zNodes);
        });

        function onCheck(e,treeId,treeNode) {
            var treeObj = $.fn.zTree.getZTreeObj("treeAdv"),
                    nodes = treeObj.getCheckedNodes(true),
                    authVal = '';
            for (var i = 0; i < nodes.length; i++) {
                authVal +=nodes[i].id+',';
            }
            authVal=authVal.substring(0,authVal.length-1);
            $('#authority').val(authVal);
        }

        {{--节点添加修改--}}
        $('.row').on('click','.submit_btn',function(){
            var tourl = $(this).parents('form').attr('action');
            $.post(tourl,$(this).parents('form').serialize(),function(data){
                if(data['status'] > 0){
                    layer.msg(data['info'],{icon:1,time:100},function(){
                        window.location.href = "{{url('admin/access/rolelist')}}";
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
            <div class="col-lg-6">
                <section class="panel">
                    <header class="panel-heading">
                        目录列表
                    </header>
                    <div class="panel-body">
                        {{----}}
                        <div class="widget-main padding-8" style="height:350px; overflow: scroll;">
                            <ul id="treeAdv" class="ztree"></ul>
                        </div>
                        {{----}}
                    </div>
                </section>
            </div>
            <span id="pageSave">
                {{--内容页开始--}}
                <div class="col-lg-6">
                    <section class="panel">
                        <header class="panel-heading">
                            修改
                        </header>
                        <div class="panel-body"  style="min-height:380px;">
                            <form class="form-horizontal" role="form" action="{{url('admin/access/saverole')}}" method="post">
                                {!! csrf_field() !!}
                                {{--修改表单--}}
                                <input id="authority" name="authority" value="" type="hidden"/>
                                <div class="form-group">
                                    <label class="col-sm-2 col-sm-2 control-label">角色名</label>
                                    <div class="col-sm-5">
                                        <input type="text" class="form-control" placeholder="权限组名称" name="name" value="">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 col-sm-2 control-label">备注</label>
                                    <div class="col-sm-5">
                                        <input type="text" class="form-control" placeholder="权限组的说明" name="remarks" value="">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 col-sm-2 control-label">排序</label>
                                    <div class="col-sm-5">
                                        <input type="text" class="form-control" placeholder="排序" name="sort" value="">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 col-sm-2 control-label">是否显示</label>
                                    <div class="col-sm-5">
                                        <label class="radio-inline">
                                            <input type="radio" name="status"  value="1"> 显示
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="status"  value="0"> 隐藏
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="status"  value="-1"> 冻结
                                        </label>
                                    </div>
                                </div>

                                <div class="clearfix form-actions">
                                    <div class="col-md-offset-3 col-md-9">
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
                                {{--修改表单--}}
                            </form>
                        </div>
                    </section>

                </div>
                {{--内容页结束--}}
            </span>
        </div>

    </div>
    {{--内容页结束--}}
@endsection