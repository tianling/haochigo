@extends("layout.shop")

@section("header")
	@include("widget.userBar.userBar")
@stop

{{-- 商家顶部信息栏 --}}
@section("shop_details")
    @include("widget/shop_details/shop_details",array("active" => "meun"))
@stop

{{-- 美食分类 --}}
@section("cate_category")
    @include("widget/cate_category/cate_category")
@stop

{{-- 美食列表--}}
@section("cate_list")
    @include("widget/cate_list/cate_list")
@stop

 {{-- 餐厅公告 --}}
@section("restaurant_announcement")
    @include("widget/restaurant_announcement/restaurant_announcement")
@stop

{{-- 我的收藏(商品) --}}
@section("goods_collection")
    @include("widget/goods_collection/goods_collection")
@stop

{{-- 本周热卖 --}}
@section("hot_sails")
    @include("widget/hot_sails/hot_sails")
@stop

{{-- 商店地图 --}}
@section("shop_map")
    @include("widget/shop_map/shop_map")
@stop

{{-- 购物车 --}}
@section("shop_cart")
    @include('widget.shop_cart.shop_cart')
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
@stop

@section("script")
    {{HTML::script("/js/lib/require.js", ["data-main" => url("js/template/shop/shop.js")])}}
@stop

