@extends('admin.layouts.base')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    服务类目
                </header>
                <div class="panel-body">

                    <form class="form-horizontal adminex-form" method="post" action="{{url('/admin/service_category/category_save')}}">
                        {{ csrf_field() }}
                        <input type="hidden" name="id" value="{{ $id ?? 0 }}">

                        <div class="form-group {{ $errors->has('parent_id') ? ' has-error' : '' }}">

                            <label class="col-sm-2 col-lg-2 control-label"><span class="text-danger">*</span> 父级分类 </label>
                            <div class="col-lg-4">
                                <div class="row">
                                    <label class="col-lg-4">
                                        <input type="radio" name="parent_id" value="0" checked>
                                        顶级分类
                                    </label>
                                </div>

                                @foreach($lists as $item)
                                    <div class="row">
                                        <label class="col-lg-4">
                                            {{ str_repeat('　　',$item['depth'] ? $item['depth'] -1 : 1) }}
                                            <input type="radio" name="parent_id" value="{{ $item['id'] }}" @if(isset($id) && $item['id'] == $id) disabled @endif @if($item['id'] == $parent_id) checked @endif >
                                            {{ $item['category_name'] }}
                                        </label>
                                    </div>
                                @endforeach

                            </div>

                        </div>

                        <div class="form-group {{ $errors->has('category_name') ? ' has-error' : '' }}">
                            <label class="col-sm-2 col-lg-2 control-label"><span class="text-danger">*</span> 类目名称</label>
                            <div class="col-lg-4">
                                <div class="m-bot15">
                                    <input title="" name="category_name" type="text" class="form-control" value="{{ old('category_name') ?? $category_name ?? ''}}" required>
                                </div>
                                <span class="help-block">{{ $errors->first('category_name') }}</span>
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('short_name') ? ' has-error' : '' }}">
                            <label class="col-sm-2 col-lg-2 control-label"><span class="text-danger">*</span> 英文名称</label>
                            <div class="col-lg-4">
                                <div class="m-bot15">
                                    <input title="" name="short_name" type="text" class="form-control" value="{{ old('short_name') ?? $short_name ?? ''}}" required>
                                </div>
                                <span class="help-block">{{ $errors->first('short_name') }}</span>
                                <div class="has-error">
                                    <span class="help-block">{{ $errors->first('other_error') }}</span>
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