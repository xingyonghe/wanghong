<!--sidebar start-->
<aside>
    <div id="sidebar"  class="nav-collapse ">

        <!-- sidebar menu start-->
        <ul class="sidebar-menu">
            @foreach($menus['child'] as $key=>$menu)

                <li class="sub-menu">
                    <a href="javascript:void(0);" class="">
                        <i class="icon-tags"></i>
                        <span>{{ $key }}</span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub">
                        @foreach($menu as $m)
                        <li><a  href="{{ url($m['url']) }}">{{ $m['title'] }}</a></li>
                        @endforeach
                    </ul>
                </li>
                {{--<a class="navbar-brand {{ $menu->current }}" href="{{ url($menu->url) }}"><i class="{{ $menu->class }}"></i> {{ $menu->title }}</a>--}}
            @endforeach
        </ul>
        <!-- sidebar menu end-->
    </div>
</aside>
<!--sidebar end-->