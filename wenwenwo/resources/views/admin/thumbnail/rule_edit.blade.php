@extends('admin.layouts.base')
@section('styles')
    <!--ios7-->
    <link rel="stylesheet" type="text/css" href="/assets/js/ios-switch/switchery.css"/>
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">缩微图编辑</header>
                <div class="panel-body">

                    <form class="form-horizontal adminex-form" method="post"
                          action="{{ url('/admin/thumbnail/rule_save') }}">
                        {{ csrf_field() }}
                        <input type="hidden" name="id" value="{{$id ?? 0}}">
                        <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                            <label class="col-sm-2 col-lg-2 control-label"><span class="text-danger">*</span>名称</label>
                            <div class="col-lg-4">
                                <div class="m-bot15">
                                    <input title="" name="name" type="text" class="form-control"
                                           value="{{ old('name') ?? $name ?? ''}}" required autofocus>
                                </div>
                                <span class="help-block">{{ $errors->first('name') }}</span>
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('width') ? ' has-error' : '' }}">
                            <label class="col-sm-2 col-lg-2 control-label"><span class="text-danger">*</span>宽度</label>
                            <div class="col-lg-4">
                                <div class="input-group m-bot15">
                                    <input title="" name="width" type="text" class="form-control"
                                           value="{{ old('width') ?? $width ?? ''}}" required autofocus>
                                    <span class="input-group-addon">px</span>
                                </div>
                                <span class="help-block">{{ $errors->first('width') }}</span>
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('height') ? ' has-error' : '' }}">
                            <label class="col-sm-2 col-lg-2 control-label"><span class="text-danger">*</span>高度</label>
                            <div class="col-lg-4">
                                <div class="input-group m-bot15">
                                    <input title="" name="height" type="text" class="form-control"
                                           value="{{ old('height') ?? $height ?? ''}}" required autofocus>
                                    <span class="input-group-addon">px</span>
                                </div>
                                <span class="help-block">{{ $errors->first('height') }}</span>
                            </div>
                        </div>

                        @foreach($types as $_key => $_typeName)
                            <div class="form-group">
                                <label class="col-sm-2 col-lg-2 control-label">{{ $_typeName }}</label>
                                <div class="col-lg-4">
                                    <div class="m-bot15">
                                        <div class="slide-toggle">
                                            <input name="types[]" title="" value="{{ $_key }}" type="checkbox"
                                                   class="js-switch"
                                                   @if(empty(old('types')) and isset($scope))
                                                        @if($_key & $scope) checked @endif
                                                   @else
                                                        @if(in_array($_key,(array)old('types'))) checked @endif
                                                   @endif
                                            />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        <div class="form-group">
                            <label class="col-sm-2 col-lg-2 control-label"></label>
                            <div class="col-lg-4">
                                <button type="submit" class="btn btn-danger">保存</button>
                            </div>

                        </div>

                    </form>

                </div>
            </section>
        </div>
    </div>
@endsection
@section('scripts')
    <!--ios7-->
    <script src="/assets/js/ios-switch/switchery.js"></script>
    <script src="/assets/js/ios-switch/ios-init.js"></script>

@endsection