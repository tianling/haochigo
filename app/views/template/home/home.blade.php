@extends("layout.home")

@section("header")
	@include("widget.userBar.userBar")
@stop

{{-- 地点与切换地区 --}}
@section("nav")
    @include("widget.nav.nav")
@stop

{{-- 广告图片轮播 --}}
@section("swipe")
    @include("widget.swipe.swipe")
@stop


{{-- 我的收藏弹出框 --}}
@section("my_collection_alert")
    @include("widget/my_collection_alert/my_collection_alert")
@stop

{{-- 我的收藏 --}}
@section("my_collection")
    @include("widget/my_collection/my_collection")
@stop


  {{-- 餐厅列表 --}}
@section("shop_list")
    @include("widget/shop_list/shop_list")
@stop

  {{-- 5个广告图片 --}}
@section("ads")
    @include("widget/ads/ads")
@stop

  {{-- 更多餐厅 --}}
@section("more_shops")
    @include("widget/more_shops/more_shops")
@stop

@section("footer")
	@include("widget.footer.footer")
@stop

@section("css")
    {{HTML::style("/css/lib/jquery-ui.css")}}
    {{HTML::style("/css/template/lib/normalize.css")}}
	{{HTML::style("/css/template/home/home.css")}}
@stop

@section("script")
    {{HTML::script("/js/lib/require.js", ["data-main" => url("js/template/home/home.js")])}}
@stop

