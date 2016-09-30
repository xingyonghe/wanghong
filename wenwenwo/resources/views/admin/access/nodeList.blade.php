@extends('admin.layouts.base')
@section('styles')
<!--dynamic table-->
<link href="/assets/js/advanced-datatable/css/demo_page.css" rel="stylesheet" />
<link href="/assets/js/advanced-datatable/css/demo_table.css" rel="stylesheet" />
<link rel="stylesheet" href="/assets/js/data-tables/DT_bootstrap.css" />
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
    $(function(){
        /**
         *获取子集目录
         */
        $('#node_change_box').on('change', '.node_select', function(){
            var obj = this;
            $.get("{{url('admin/access/getsecondnode')}}",{id:$(obj).val()},function(data){
                $(obj).parent().nextAll().remove();
                if (data) {
                    $(obj).parent().after(data);
                }
            });
        });
    });
    {{--目录列表--}}
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
        callback: {
            onMouseDown: onMouseDown
        }
    };
    setting.check.chkboxType = { "Y" : "ps", "N" : "ps" };

    var zNodes = {!!$nodeList!!};

    $(document).ready(function(){
        $.fn.zTree.init($("#treeAdv"), setting, zNodes);
    });

    function onMouseDown(event, treeId, treeNode) {
        if (treeNode && treeNode.id > 1) {
            $.ajax({
                type:'get',async:false,url:"{{url('admin/access/nodemodif')}}?id="+treeNode.id,
                success:function(data){
                    if(data['status'] == -1){
                        layer.alert(data['info'],{icon:2});
                    }else{
                        $("#pageSave").empty().append(data);
                    }
                }
            });
        }
    }
    {{--节点添加修改--}}
    $('.row').on('click','.submit_btn',function(){
        var tourl = $(this).parents('form').attr('action');
        $.post(tourl,$(this).parents('form').serialize(),function(data){
            if(data['status'] > 0){
                layer.msg(data['info'],{icon:1,time:100},function(){
                    window.location.reload();
                })
            }else{
                layer.alert(data['info'],{icon:2});
            }
        },'json').error(function(){
            layer.alert('请求失败',{icon:2});
        })
    })
    {{--节点删除--}}
    $('.row').on('click','.del_btn',function(){
        var tourl = "{{url('admin/access/nodedel')}}";
        $.get(tourl,{id:$(this).attr('data-id')},function(data){
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
        <div class="col-lg-12">
            <section class="panel">
                <div class="panel-body">
                    <form id="addNodeForm" action="{{url('admin/access/nodeadd')}}" method="post">
                        {!! csrf_field() !!}
                        <strong>名称：</strong>
                        <span class="">
                            <input type="text"  class="nav-search-input" required="" autocomplete="off" name="name"/>
                        </span>
                        <strong>链接：</strong>
                    <span class="">
                        <input type="text"  class="nav-search-input"  autocomplete="off" name="code"/>
                    </span>
                        <strong>排序：</strong>
                    <span class="">
                        <input type="text"  class="nav-search-input"  autocomplete="off" name="sort"/>
                    </span>
                        <strong>显示状态：</strong>
                        <select name="status">
                            <option value="1">显示</option>
                            <option value="0">隐藏</option>
                            <option value="-1">冻结</option>
                        </select>
                        <label id="node_change_box"  style="margin-bottom: 10px;">
                            <strong class="pl-40 pr-10">父类:</strong>
                            <span class="select-box-span radius" style="margin-right:10px;">
                                <select name="pid[]" class="myselect node_select" autocomplete="off">
                                    @foreach($firstNode as $value)
                                        <option value="{{$value['id']}}">{{$value['name']}}</option>
                                    @endforeach
                                </select>
                            </span>
                        </label>
                        <input type="button"   style="margin-top: -2px;" value="提交" class="btn radius btn-primary submit_btn">　
                        <input type="reset"  style="margin-top: -2px;" value="重置" class="btn">　
                    </form>
                </div>
            </section>
        </div>
    </div>


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
        <span id="pageSave"></span>
    </div>

</div>
{{--内容页结束--}}
@endsection