<div class="more_shops">
    <div class="more_shops-header">
        <span class="title">更多餐厅</span>
    </div>

    {{-- 获取商店 --}}
    @include("widget/shop_info/shop_info", array("shops" => $more_shop['data']))

</div>


@section("css")
    @parent
    {{HTML::style("/css/widget/more_shops/more_shops.css")}}
@stop
