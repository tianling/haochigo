<ul class="nav nav-list">
    <li class="{{{ $active=="center" ? 'active' : "" }}}"><a href="{{$sidebar['personal_center']}}"><i class="{{{$active=="center" ? "icon-white" : "icon"}}} icon-user"></i>个人中心</a></li>
    <li class="divider"></li>
    <li class="nav-header">订单中心</li>
    <li class="{{{ $active=="recent_month" ? 'active' : "" }}}"><a href="{{$sidebar['personal_recent_month']}}"><i class="{{{$active=="recent_month" ? "icon-white" : "icon"}}} icon-calendar"></i>最近一个月</a></li>
    <li class="{{{ $active=="after_month" ? 'active' : "" }}}"><a href="{{$sidebar['personal_after_month']}}"><i class="{{{$active=="after_month" ? "icon-white" : "icon"}}} icon-list-alt"></i>一个月之前</a></li>
    <li class="{{{ $active=="uncomment" ? 'active' : "" }}}"><a href="{{$sidebar['personal_uncomment']}}"><i class="{{{$active=="uncomment" ? "icon-white" : "icon"}}} icon-star-empty"></i>未点评订单</a></li>
    <li class="{{{ $active=="return" ? 'active' : "" }}}"><a href="{{$sidebar['personal_return']}}"><i class="{{{$active=="return" ? "icon-white" : "icon"}}} icon-file"></i>退单中的订单</a></li>
    <li class="divider"></li>
    <li class="nav-header">我的收藏</li>
    <li class="{{{ $active=="collection_shop" ? 'active' : "" }}}"><a href="{{$sidebar['personal_collection_shop']}}"><i class="{{{$active=="collection_shop" ? "icon-white" : "icon"}}} icon-heart"></i>我收藏的餐厅</a></li>
    <li class="{{{ $active=="collection_goods" ? 'active' : "" }}}"><a href="{{$sidebar['personal_collection_goods']}}"><i class="{{{$active=="collection_goods" ? "icon-white" : "icon"}}} icon-star"></i>我收藏的美食</a></li>
    <li class="divider"></li>
    <li class="nav-header">账户相关</li>
    <li class="{{{ $active=="my_site" ? 'active' : "" }}}"><a href="{{$sidebar['personal_my_site']}}"><i class="{{{$active=="my_site" ? "icon-white" : "icon"}}} icon-list"></i>我的地址</a></li>
    <li class="divider"></li>
    <li class="nav-header">安全中心</li>
    <li class="{{{ $active=="change_password" ? 'active' : "" }}}"><a href="{{$sidebar['personal_change_password']}}"><i class="{{{$active=="change_password" ? "icon-white" : "icon"}}} icon-cog"></i>修改密码</a></li>
    <li class="{{{ $active=="secure" ? 'active' : "" }}}"><a href="{{$sidebar['personal_secure']}}"><i class="{{{$active=="secure" ? "icon-white" : "icon"}}} icon-lock"></i>安全设置</a></li>
    <li class="divider"></li>
    <li class="nav-header">在线支付</li>
    <li class="{{{ $active=="details" ? 'active' : "" }}}"><a href="{{$sidebar['personal_details']}}"><i class="{{{$active=="details" ? "icon-white" : "icon"}}} icon-eye-open"></i>收支明细</a></li>
</ul>

@section("css")
    @parent
    {{HTML::style("/css/widget/sidebar/sidebar.css")}}
@stop