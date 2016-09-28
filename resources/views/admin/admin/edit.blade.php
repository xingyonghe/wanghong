<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <div class="panel-body">
                <div class=" form">
                    {!! Form::open(['url' => 'admin/admin/editUpdate','class'=>'cmxform form-horizontal tasi-form form-datas','autocomplete'=>'off']) !!}
                    <input  type="hidden" name="id" value="{{ $info->id }}"/>
                    <div class="form-group ">
                        <label for="cname" class="control-label col-lg-2">用户名</label>
                        <div class="col-lg-10">
                            <input class=" form-control" disabled type="text" value="{{ $info->username }}" />
                        </div>
                    </div>
                    <div class="form-group ">
                        <label for="curl" class="control-label col-lg-2">昵称</label>
                        <div class="col-lg-10">
                            <input class="form-control " placeholder="填写管理员的昵称" type="text" name="nickname" value="{{ $info->nickname }}"/>
                        </div>
                    </div>
                    <div class="form-group ">
                        <label for="curl" class="control-label col-lg-2">用户组</label>
                        <div class="col-lg-10">
                            <select class="form-control m-bot15" name="role_id">
                                <option value="0">请选择</option>
                                @foreach($groups as $group)
                                    <option @if($info->role_id==$group['id']) selected @endif value="{{ $group['id'] }}">{{ $group['title'] }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group ">
                        <label for="curl" class="control-label col-lg-2">状态</label>
                        <div class="col-lg-10 radios has-js">
                            <label class="label_radio @if($info->status==1) r_on @endif" for="radio-01">
                                <input name="status" id="radio-01" value="1" type="radio" @if($info->status==1) checked @endif /> 正常
                            </label>
                            <label class="label_radio @if($info->status==0) r_on @endif" for="radio-02">
                                <input name="status" id="radio-02" value="0" type="radio" @if($info->status==0) checked @endif/> 禁用
                            </label>
                        </div>
                    </div>
                    {!!Form::close()!!}
                </div>
            </div>
        </section>
    </div>
</div>