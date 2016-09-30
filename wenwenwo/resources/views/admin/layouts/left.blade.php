<!-- left side start-->
<div class="left-side sticky-left-side">

    <!--logo and iconic logo start-->
    <div class="logo">
        <a href="index.html"><img src="/assets/images/logo.png" alt=""></a>
    </div>

    <div class="logo-icon text-center">
        <a href="index.html"><img src="/assets/images/logo_icon.png" alt=""></a>
    </div>
    <!--logo and iconic logo end-->

    <div class="left-side-inner">

        <!-- visible to small devices only -->
        <div class="visible-xs hidden-sm hidden-md hidden-lg">
            <div class="media logged-user">
                <img alt="" src="/assets/images/photos/user-avatar.png" class="media-object">
                <div class="media-body">
                    <h4><a href="#">John Doe</a></h4>
                    <span>"Hello There..."</span>
                </div>
            </div>

            <h5 class="left-nav-title">Account Information</h5>
            <ul class="nav nav-pills nav-stacked custom-nav">
                <li><a href="#"><i class="fa fa-user"></i> <span>Profile</span></a></li>
                <li><a href="#"><i class="fa fa-cog"></i> <span>Settings</span></a></li>
                <li><a href="#"><i class="fa fa-sign-out"></i> <span>Sign Out</span></a></li>
            </ul>
        </div>

        <!--sidebar nav start-->
        <ul class="nav nav-pills nav-stacked custom-nav">
            <li><a href=""><i class="fa fa-home"></i> <span>Dashboard</span></a></li>


            {{--@foreach ($admin_nav_list['node_list'] as $ka=>$va)
            <li class="menu-list"><a href=""><i class="fa fa-laptop"></i> <span>{{$va['name']}}</span></a>
                @if(!empty($va['child']))
                <ul class="sub-menu-list">
                    @foreach($va['child'] as $kc=>$vc)
                    <li class="three-menu-list">
                        <a href="javascript:;"><i class="fa fa-plus-square"></i> {{$vc['name']}}</a>
                        @if(!empty($vc['child']))
                        <ul class="sub-menu-list" data-id="5">
                            @foreach($vc['child'] as $ktc=>$vtc)
                            <li><a href="{{url($vtc['name'])}}">  {{$vtc['name']}}</a></li>
                            @endforeach
                        </ul>
                        @endif
                    </li>
                    @endforeach
                </ul>
                @endif
            </li>
            @endforeach--}}

            {{--@foreach ($admin_nav_list['node_list'] as $ka=>$va)
                <li class="menu-list"><a href=""><i class="fa {{$va['class_name']}}"></i> <span>{{$va['name']}}</span></a>
                    @if(!empty($va['child']))
                        <ul class="sub-menu-list two-custom-nav">
                            @foreach($va['child'] as $kc=>$vc)
                                <li class="three-menu-list">
                                    <a href="javascript:;"><i class="fa fa-plus-square"></i> {{$vc['name']}}</a>
                                    @if(!empty($vc['child']))
                                        <ul class="sub-menu-list">
                                            @foreach($vc['child'] as $ktc=>$vtc)
                                                <li><a href="{{url('admin/'.$vtc['code'])}}">  {{$vtc['name']}}</a></li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </li>
            @endforeach--}}
            @foreach ($admin_nav_list['node_list'] as $ka=>$va)
                @if($ka == 2)
                    <li class="menu-list nav-active" id="menu_{{$ka}}"><a href=""><i class="fa {{$va['class_name']}}"></i> <span>{{$va['name']}}</span></a>
                    @else
                    <li class="menu-list" style="display: none"  id="menu_{{$ka}}"><a href=""><i class="fa {{$va['class_name']}}"></i> <span>{{$va['name']}}</span></a>
                @endif
                    @if(!empty($va['child']))
                        <ul class="sub-menu-list two-custom-nav">
                            @foreach($va['child'] as $kc=>$vc)
                                <li class="three-menu-list nav-active">
                                    <a href="javascript:;"><i class="fa fa-minus-square"></i> {{$vc['name']}}</a>
                                    @if(!empty($vc['child']))
                                        <ul class="sub-menu-list" style="display: block">
                                            @foreach($vc['child'] as $ktc=>$vtc)
                                                <li><a href="{{url($vtc['code'])}}">  {{$vtc['name']}}</a></li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </li>
            @endforeach
        </ul>
        <!--sidebar nav end-->

    </div>
</div>
<!-- left side end-->