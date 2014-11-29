<section class="rst-block rst-aside-map rst_aside_distance">
    <div class="rst-map-distance">距离<span id="r_d_v" class="distance-value">{{$shop_map['data']['distance']}}</span>米</div>
    <img class="rst_map rst-map-img" src="{{$shop_map['data']['map_url']}}" alt="餐厅距离示意图">
</section>

@section("css")
    @parent
    {{HTML::style("/css/widget/shop_map/shop_map.css")}}
@stop