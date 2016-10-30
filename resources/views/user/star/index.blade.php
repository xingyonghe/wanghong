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
                <table class="table table-striped sortable">
                    <thead>
                    <tr>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Username</th>
                        <th>Status</th>
                        <th>Date Joined</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>John</td>
                        <td>Smith</td>
                        <td>jsmith@yahoo.com</td>
                        <td>jsmith</td>
                        <td><span class="label label-success">Active</span></td>
                        <td>2012-04-14</td>
                        <td>
                            <div class="btn-group">
                                <button class="btn">Approve</button>
                                <button data-toggle="dropdown" class="btn dropdown-toggle"><span class="caret"></span></button>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Edit Username</a><a href="#">Disable Account</a><a href="#">Destroy</a></li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Susan</td>
                        <td>Mestas</td>
                        <td>sm1268@gmail.com</td>
                        <td>maestromestas</td>
                        <td><span class="label">Inactive</span></td>
                        <td>2012-01-02</td>
                        <td>
                            <div class="btn-group">
                                <button class="btn">Approve</button>
                                <button data-toggle="dropdown" class="btn dropdown-toggle"><span class="caret"></span></button>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Edit Username</a><a href="#">Disable Account</a><a href="#">Destroy</a></li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Robert</td>
                        <td>Jetton</td>
                        <td>robbyjet@gmail.com</td>
                        <td>jetsetrob</td>
                        <td><span class="label label-inverse">Admin</span></td>
                        <td>2011-11-12</td>
                        <td>
                            <div class="btn-group">
                                <button class="btn">Approve</button>
                                <button data-toggle="dropdown" class="btn dropdown-toggle"><span class="caret"></span></button>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Edit Username</a><a href="#">Disable Account</a><a href="#">Destroy</a></li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <div class="pagination pagination-centered">
                    <ul>
                        <li class="disabled"><a href="#">&laquo;</a></li>
                        <li class="active"><a href="#">1</a></li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#">4</a></li>
                        <li><a href="#">5</a></li>
                        <li><a href="#">&raquo;</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection