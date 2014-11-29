@extends("layout.shop")

@section("header")
	@include("widget.userBar.userBar")
@stop

{{-- 商家顶部信息栏 --}}
@section("shop_details")
    @include("widget/shop_details/shop_details",array("active" => "meun"))
@stop

@section("shop_left")
    {{-- 美食分类 --}}
    @include("widget/cate_category/cate_category")
    {{-- 美食列表--}}
    @include("widget/cate_list/cate_list")
@stop

@section("shop_right")
    {{-- 餐厅公告 --}}
    @include("widget/restaurant_announcement/restaurant_announcement")
    {{-- 我的收藏(商品) --}}
    @include("widget/goods_collection/goods_collection")
    {{-- 本周热卖 --}}
    @include("widget/hot_sails/hot_sails")
    {{-- 商店地图 --}}
    @include("widget/shop_map/shop_map")
@stop


{{-- 购物车 --}}
@section("shop_cart")
    @include('widget.shop_cart.shop_cart')
@stop

{{-- 左侧滑出的评论框 --}}

@section("pop_window")
    @include("widget.pop_window.pop_window")
@stop


{{-- 最右侧收藏按钮 --}}
@section("shop_collect_bar")
    @include("widget.shop_collect_bar.shop_collect_bar")
@stop


@section("footer")
	@include("widget.footer.footer")
@stop

@section("css")
    {{HTML::style("/css/lib/jquery-ui.css")}}
    {{HTML::style("/css/template/lib/normalize.css")}}
	{{HTML::style("/css/template/shop/shop.css")}}
	{{HTML::style("/css/lib/jquery-ui.min.css")}}
	{{HTML::style("/css/lib/ui-btn.css")}}
	{{HTML::style("/css/lib/font.css") }}
    {{HTML::style("/css/template/lib/function.css") }}
@stop

@section("script")
    {{HTML::script("/js/lib/require.js", ["data-main" => url("js/template/shop/shop.js")])}}
@stop

