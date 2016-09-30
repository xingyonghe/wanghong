@extends('admin.layouts.base')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    敏感词库
                </header><br/>
                <div class="panel-body">
                    <form class="form-horizontal bucket-form" method="post" action="{{url('/admin/sensitive/edit')}}">
                        {{ csrf_field() }}
                        <div class="form-group {{ $errors->has('sensitive_name') ? ' has-error' : '' }}">
                            <label class="col-sm-2 col-lg-2 control-label"><span class="text-danger">*</span>
                                敏感词
                                <br/>
                                <label for="" style="color: red">={MOD}此内容不可删除</label>
                            </label>
                            <div class="col-lg-4">
                                <div class="col-sm-10">
                                    <textarea rows="6" style="width: 900px;height:350px" name="sensitive_name" class="form-control" required  placeholder="例: 敏感词">{{$data}}</textarea>
                                    @if ($errors->has('sensitive_name'))
                                        <strong>{{ $errors->first('sensitive_name') }}</strong>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 col-lg-2 control-label"></label>
                            <div class="col-lg-4"><button type="submit" class="btn btn-primary">保存</button></div>
                        </div>
                    </form>
                </div>
            </section>
        </div>
    </div>
@endsection