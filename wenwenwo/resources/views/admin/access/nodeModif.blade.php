{{--内容页开始--}}
<div class="col-lg-6">
    <section class="panel">
        <header class="panel-heading">
            修改
        </header>
        <div class="panel-body"  style="min-height:380px;">
            <form class="form-horizontal" role="form" action="{{url('admin/access/nodemodif')}}" method="post">
                {!! csrf_field() !!}
                <input type="hidden" name="id"  value="{{$info['id']}}">
                <input type="hidden" name="save" value="1">
                {{--修改表单--}}
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">ID</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" placeholder="ID" name="id" value="{{$info['id']}}" readonly>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">链接名称</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" placeholder="链接名称" name="name" value="{{$info['name']}}">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">链接地址</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" placeholder="后台/控制器/方法名" name="code" value="{{$info['code']}}">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">目录样式</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" placeholder="一级目录样式名称" name="class_name" value="{{$info['class_name']}}">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">排序</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" placeholder="排序" name="sort" value="{{$info['sort']}}">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">是否显示</label>
                    <div class="col-sm-5">
                        <label class="radio-inline">
                            <input type="radio" name="status"  value="1" @if($info['status'] == 1)checked @endif> 显示
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="status"  value="0" @if($info['status'] == 0)checked @endif> 隐藏
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="status"  value="-1" @if($info['status'] == -1)checked @endif> 冻结
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
                        &nbsp; &nbsp; &nbsp;
                        <button class="btn btn-danger" type="reset">
                            <i class="ace-icon fa fa-trash-o "></i>
                            <a class="mr-20 del_btn" style="color: #ffffff" href="javascript:;" data-id="{{$info['id']}}">删除</a>
                        </button>
                    </div>
                </div>
                {{--修改表单--}}
            </form>
        </div>
    </section>

</div>
{{--内容页结束--}}
