
<div class="menu_toolbar">
    <div class="toolbar_text" data-classify_id="">
        <span>{{$category['data']['classify_sec'][0]['classify_name']}}</span>
        <img class="icon-rst-badge" src="" alt="" title=""/>
    </div>
    <div class="menu_tool">
        <div class="toolbar_category element_drop_down">
            <a href="javascript:void(0)" class="toolBar_toggle caret">美食分类</a>
            <div class="drop_down_menu">
                <ul class="cate_drop_down ui-helper-clearfix">
                    @foreach($good_category['data']['goods_category'] as $key=>$value)
                    <li class="cate_item" data-classify_id="{{$value['classify_id']}}">
                    <a href="#" title="{{$value['classify_name']}}">{{$value['classify_name']}}
                        {{--<img class="icon-rst-badge" src="http://fuss10.elemecdn.com/c/12/d2b0ed6e994997099e86581009d3bjpeg.jpeg" title="1元秒杀爽到爆！" alt="1元秒杀爽到爆！">--}}
                    </a></li>
                    @endforeach
                </ul>
                <ul class="activity_drop_down">
                    @foreach($good_category['data']['good_activity'] as $key=>$value)
                    <li data-classify_id="{{$value['activity_id']}}">
                    {{--<img class="icon-rst-badge" src="http://fuss10.elemecdn.com/c/12/d2b0ed6e994997099e86581009d3bjpeg.jpeg" title="1元秒杀爽到爆！" alt="1元秒杀爽到爆！">--}}
                          {{$value['activity_name']}}
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <a href="" class="tool_item ui_on">默认排序</a>
        <a href="" class="tool_item">评分<i class="glyph-sort-down"></i></a>
        <a href="" class="tool_item">销量<i class="glyph-sort-down"></i></a>
        <a href="" class="tool_item">价格<i class="glyph-sort-down"></i></a>
    </div>
</div>

<div class="cate_view">
    @foreach($category['data']['classify_sec'] as $key=>$value)
    <section class="classify_sec" data-classify_id="{{$value['classify_id']}}">
        <h2 class="sec_title" title="{{$value['classify_name']}}"><span>{{$value['classify_name']}}</span></h2>
        {{--<p  class="ad_sec" title="">每天可享受两单优惠，每单可享受3份特价菜。</p>--}}
        <ul class="menu_list">
            @foreach($value['classify_goods'] as $good_name=>$good_value)
            <li class="menu_list_block js-get-good-id" data-good_id="{{$good_value['goods_id']}}">
                <div class="menu_sec_info">
                    <p class="menu_sec_title">
                        <a href="#" class="dish_flavor favor_btn">♥</a>
                        <a href="#" class="dish_title"></a>
                    </p>
                    <p class="menu_sec_desc" title="{{$good_value['goods_name']}}">{{$good_value['goods_name']}}</p>
                </div>
                <div class="menu_sec_note">
                    {{--<span class="rst-d-ordered dish_state">2</span>--}}
                </div>
                <div class="menu_sec_action">
                    <div class="dish_act act_btn">
                        <a href="" class="rst-d-act-add add_btn" title="点击一份">
                            <span class="rst-d-act-glyph"></span>
                            <span class="price symbol-rmb">{{$good_value['goods_price']}}</span>
                         </a>
                        {{--<a href="" class="rst-d-act-toggle caret add_main_btn"></a>--}}
                        <div class="rst-hint-modal clear-cart">
                            <p>篮子中已有「比格比萨」的美食，清空篮子后才能加入「土豆肉丝炒饭」</p>
                            <div class="btn-wrapper">
                                <a href="" class="ui-btn">再等等</a>
                                <a href="" class="ui-btn btn-confirm">清空并添加</a>
                            </div>
                        </div>
                        <div  class="rst-d-act-dropdown main_food_panel">
                            <span class="helper">添加到以下菜品中</span>
                            <span class="dish single_main_food">意大利皮塞</span>
                            <span class="dish single_main_food">皮蛋炒肉</span>
                        </div>
                    </div>
                </div>
                <div class="menu_sec_status">
                    <span class="rst-d-rating food_rating js-open-pop-window">
                        <i class="icon-d-star s{{$good_value['goods_level']}} i_s"></i>({{$good_value['comment_count']}})
                    </span>
                    <span class="rst-d-sales js-open-pop-window">月售{{$good_value['good_sails']}}份</span>
                </div>
            </li>
            @endforeach
        </ul>
    </section>
    @endforeach
</div>
@section("css")
    @parent
    {{HTML::style("/css/widget/cate_list/cate_list.css")}}
@stop