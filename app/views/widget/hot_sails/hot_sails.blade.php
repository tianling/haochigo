<section id="rec_food" class="rst-block">
    <h3 class="rst-aside-title">本周热卖</h3>
    <ul id="weekly_ranking" class="rst-aside-menu-list">
        @foreach($best_seller as $item)
        <li class="rst-aside-dish-item eleme_view" data-good_id="{{$item['goods_id']}}" data-shop_id="{{$item['shop_id']}}">
            <div class="rst-d-info">
                <p class="rst-d-main text-overflow">
                    <a class="rst-d-name food_name" title="{{$item['goods_name']}}">{{$item['goods_name']}}</a>
                </p>
                <span class="rst-d-rating food_rating">
                    <i class="icon-d-star s{{$item['goods_level']}} i_s"></i>
                    ({{$item['comment_count']}})
                </span>
            </div>
            <div class="rst-d-action r_d_a">
                <div class="rst-d-act narrow act_btns">
                    <a class="rst-d-act-add add_btn" title="点击饿一份" role="button"><span class="rst-d-act-glyph"></span><span class="price symbol-rmb">{{$item['goods_price']}}</span></a>

                </div>
            </div>
        </li>
        @endforeach
    </ul>
</section>


@section("css")
    @parent
    {{HTML::style("/css/widget/hot_sails/hot_sails.css")}}
@stop