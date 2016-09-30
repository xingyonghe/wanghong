<span class="select-box-span radius" style="margin-right:10px;">
    <select name="pid[]" class="myselect node_select" autocomplete="off">
        <option value="">--请选择--</option>
        @foreach($twoNode as $value)
            <option value="{{$value['id']}}">{{$value['name']}}</option>
        @endforeach
    </select>
</span>