<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <div class="panel-body">
                <div class=" form">
                    {!! Form::open(['url' => 'admin/personal/postCustom','class'=>'cmxform form-horizontal tasi-form form-datas','autocomplete'=>'off']) !!}
                    <div class="form-group ">
                        <label for="cname" class="control-label col-lg-2">选择客服</label>
                        <div class="col-lg-10">
                            {!! Form::select('custom_id', $customs, old('custom_id'), array('class' => 'form-control m-bot15')) !!}
                        </div>
                    </div>
                    <input name="id" type="hidden" value="{{ $id }}">
                    {!!Form::close()!!}
                </div>
            </div>
        </section>
    </div>
</div>