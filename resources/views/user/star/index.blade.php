@extends('user.public.base')
@section('style')
<style type="text/css">
    .col-nav .active{
        background: #EEE;
    }
    .span6 input{
        height: 30px;
        padding: 4px 6px;
        font-size: 14px;
        line-height: 20px;
        color: #555555;
        border-radius: 4px;
    }
    input[disabled], select[disabled], textarea[disabled], input[readonly], select[readonly], textarea[readonly] {
        background-color: #fff;
        cursor:default;
    }
</style>
@endsection
@section('script')
    <script type="text/javascript">
        $(function () {
            highlight_subnav("{{ route('user.star.index') }}");
        })
    </script>
@endsection
@section('content')
    <div class="row">
        <div class="span3">
            <h4>个人中心</h4>
            <div class="sidebar">
                <ul class="col-nav span3">
                    <li>
                        <a href="{{ route('user.star.add') }}"><i class="pull-right icon-user"></i>新增网红</a>
                    </li>
                    <li>
                        <a href="{{ route('user.star.index') }}"> <i class="pull-right icon-cog"></i>网红管理</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="span9">
            <h4 class="header">基本资料</h4>
            <div id="d3" style="width: 100%; margin-top: -30px"></div><br />
            <div class="span6">
                @if($lists->total())
                <table class="table table-striped sortable">
                    <thead>
                    <tr>
                        <th>头像</th>
                        <th>昵称</th>
                        <th>直播平台</th>
                        <th>平台ID</th>
                        <th>添加时间</th>
                        <th>状态</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($lists as $data)
                        <tr>
                            <td>
                                <div class="img" style="width: 60px;height: 60px;background: #d9d9d9 ;">
                                    <img src="{{ get_cover($data->avatar) }}" width="60" height="60"/>
                                </div>
                            </td>
                            <td>{{ $data->username }}</td>
                            <td>{{ $data->platform }}</td>
                            <td>{{ $data->homepage }}</td>
                            <td>{{ $data->created_at->format('Y-m-d') }}</td>
                            <td>{{ $data->status_text }}</td>
                            <td>
                                @if($data->status == 1 || $data->status == 3)
                                    <a href="{{ route('user.star.edit',[$data->id]) }}">编辑</a>
                                    <a class="ajax-confirm destroy" href="javascript:void(0)" url="{{ route('user.star.destroy',[$data->id]) }}">删除</a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="pagination pagination-centered">
                    {!! $lists->render() !!}
                </div>
                @else
                    <table class="table table-striped sortable">
                        <thead>
                            <tr>
                                <th>头像</th>
                                <th>昵称</th>
                                <th>直播平台</th>
                                <th>平台ID</th>
                                <th>添加时间</th>
                                <th>状态</th>
                                <th>操作</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="7">抱歉，您还没有添加任何媒体，赶紧<a href="{{ route('user.star.add') }}">添加</a></td>
                            </tr>
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
@endsection