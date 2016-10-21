@extends('admin.public.base')
@section('style')
@stop
@section('script')
    <!-- 配置文件 -->
    <script type="text/javascript" src="{{ asset('public-static/ueditor1.4.3.3/ueditor.config.js') }}"></script>
    <!-- 编辑器源码文件 -->
    <script type="text/javascript" src="{{ asset('public-static/ueditor1.4.3.3/ueditor.all.js') }}"></script>
    <script type="text/javascript">
        $(function () {
            highlight_subnav("{{ url('admin/article/index') }}");
            //编辑器
            window.UEDITOR_CONFIG.initialFrameHeight = parseInt('250');
            window.UEDITOR_CONFIG.toolbars = [[
                'bold', 'italic', 'underline', 'fontborder', 'strikethrough',
                'forecolor', 'backcolor', 'insertorderedlist', 'insertunorderedlist','|',
                'rowspacingtop', 'rowspacingbottom', 'lineheight', '|',
                'customstyle', 'paragraph', 'fontfamily', 'fontsize', '|',
                'justifyleft', 'justifycenter', 'justifyright', 'justifyjustify', '|',
                'simpleupload','insertimage', 'emotion', 'insertvideo', 'music', 'attachment', 'map', 'gmap', '|',
                'inserttable', 'deletetable', 'insertparagraphbeforetable', 'insertrow', 'deleterow', 'insertcol', 'deletecol', 'mergecells', 'mergeright', 'mergedown', 'splittocells', '|','help'
            ]]
            UE.getEditor('content');

        })
    </script>
@stop
@section('body')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    @if(isset($info['id']))编辑文章@else新增文章@endif
                </header>
                <div class="panel-body">
                    <div class=" form">
                        {!! Form::open(['url' => 'admin/article/update','class'=>'cmxform form-horizontal tasi-form form-datas','autocomplete'=>'off']) !!}
                        <div class="form-group ">
                            <label for="cname" class="control-label col-lg-2">标题</label>
                            <div class="col-lg-10">
                                <input class=" form-control" placeholder="请填写标题" name="title" type="text" value="{{ $info['title'] ?? old('title') }}" />
                            </div>
                        </div>
                        <div class="form-group ">
                            <label for="curl" class="control-label col-lg-2">描述</label>
                            <div class="col-lg-10">
                                <textarea class="form-control " rows="6" placeholder="请填写描述，不填从内容中默认生成" name="descrition" />{{ $info['descrition'] ?? old('descrition') }}</textarea>
                            </div>
                        </div>
                        <div class="form-group ">
                            <label for="curl" class="control-label col-lg-2">内容</label>
                            <div class="col-lg-10">
                                <textarea  id="content" name="content" />{{ $info['content'] ?? old('content') }}</textarea>
                            </div>
                        </div>
                        <div class="form-group ">
                            <label for="curl" class="control-label col-lg-2">作者</label>
                            <div class="col-lg-10">
                                <input class="form-control " placeholder="作者姓名" type="text" name="author" value="{{ $info['author'] ?? old('author') }}" />
                            </div>
                        </div>
                        <div class="form-group ">
                            <label for="curl" class="control-label col-lg-2">来源</label>
                            <div class="col-lg-10">
                                <input class="form-control " placeholder="文章来源" type="text" name="quote" value="{{ $info['quote'] ?? old('quote') }}" />
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-offset-2 col-lg-10">
                                <input   name="id" value="{{ $info['id'] ?? '' }}" type="hidden"/>
                                <button class="btn btn-danger" type="submit" style="margin:0px 25px">保存</button>
                                <button class="btn btn-default" type="button" onclick="javascript:history.back(-1);return false;">返回</button>
                            </div>
                        </div>
                        {!!Form::close()!!}
                    </div>
                </div>
            </section>
        </div>
    </div>
@stop