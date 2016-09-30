@extends('admin.layouts.base')
@section('styles')
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    编辑模板  {{isset($username) ? $username : ''}}
                </header>
                <div class="panel-body">
                    <div class="form">
                        <form class="cmxform form-horizontal adminex-form bucket-form" id="commentForm" method="post" action="{{url('/admin/sms/save')}}">
                            {{ csrf_field() }}
                            @if($info) <input type="hidden" value="{{$info['id']}}" name="id"> @endif
                            <div class="form-group {{ $errors->has('title') ? ' has-error' : '' }}">
                                <label for="cname" class="control-label col-lg-2"><span class="text-danger">*</span> 模板名称</label>
                                <div class="col-lg-10">
                                    <input class=" form-control" id="cname" name="title" maxlength="50" type="text" value="@if(isset($info['title'])) {{$info['title']}}  @endif" required placeholder="例：测试"/>
                                    <span class="help-block"><strong>{{ $errors->first('title') }}</strong></span>
                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('client_base') ? ' has-error' : '' }}">
                                <label class="col-sm-2 control-label col-lg-2" for="inputSuccess"><span class="text-danger">*</span> 发送客户群</label>
                                <div class="col-lg-10">
                                    @foreach($statuc_conf['base'] as $k=>$v)
                                        <label class="checkbox-inline" style="padding-left: 0px">
                                            <input id="inlineCheckbox1" name="client_base" @if(isset($info['client_base'])) @if($info['client_base'] == $k) checked @endif @elseif($k == 0) checked @endif  value="{{$k}}" type="radio"> {{$v}}
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('typeid') ? ' has-error' : '' }} ">
                                <label for="cname" class="control-label col-lg-2"><span class="text-danger">*</span> 类目选择</label>
                                <div class="col-lg-10">
                                    @foreach($statuc_conf['typeid'] as $k=>$v)
                                        <label class="checkbox-inline">
                                            <input id="inlineCheckbox1" name="typeid[]"  @if(isset($info['typeid'])) @if(in_array($k, explode(',',$info['typeid']))) checked @endif @elseif($k == 0) checked @endif  value="{{$k}}" type="checkbox"> {{$v}}
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('content') ? ' has-error' : '' }}">
                                <label for="ccomment" class="control-label col-lg-2"><span class="text-danger">*</span> 模板内容</label>
                                <div class="col-lg-10">
                                    <textarea class="form-control " id="ccomment" name="content" maxlength="200" onkeyup="$('.font-number').text(200-value.length);" required>@if(isset($info['content'])) {{$info['content']}} @endif</textarea>
                                    <span class="help-block"><strong style="color: goldenrod;" class="font-number">{{isset($info['content']) ? (200-strlen($info['content'])) : '200'}}</strong>个字</span>
                                    <span class="help-block"><strong>{{ $errors->first('content') }}</strong></span>
                                </div>
                            </div>
                            <div class="form-group ">
                                <label for="cname" class="control-label col-lg-2">模板备注</label>
                                <div class="col-lg-10">
                                    <input class=" form-control" id="cname" name="remark" maxlength="50" type="text" value="@if(isset($info['remark'])) {{$info['remark']}} @endif" />
                                </div>
                            </div>
                            <div class="form-group ">
                                <label for="cname" class="control-label col-lg-2">是否启用</label>
                                <div class="col-lg-10">
                                    <label class="checkbox-inline">
                                        <input id="inlineCheckbox1" name="status" @if(isset($info['status'])) @if($info['status'] == 1) checked @endif @endif value="1" type="checkbox">
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-lg-offset-2 col-lg-10">
                                    <button class="btn btn-primary" type="submit">保存</button>
                                    <button class="btn btn-default" type="reset">重置</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection