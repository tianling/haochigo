@extends("layout.shop")

@section("header")
	@include("widget.userBar.userBar")
@stop

{{-- 商家顶部信息栏 --}}
@section("shop_details")
    @include("widget/shop_details/shop_details",array("active" => "comment"))
@stop

@section("shop_left")
    {{-- 商家评论 --}}
    @include("widget/shop_comment/shop_comment")
@stop

@section("shop_right")
    {{-- 商家评分 --}}
    @include("widget/shop_evaluate/shop_evaluate")
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
    {{HTML::script("/js/lib/require.js", ["data-main" => url("js/template/shop/shop_comment.js")])}}
@stop

