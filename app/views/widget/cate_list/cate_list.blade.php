
@foreach($category['data']['classify_sec'] as $key=>$value)
<div class="menu_toolbar">
    <div class="toolbar_text" data-classify_id="{{$value['classify_id']}}">
        <span>{{$value['classify_name']}}</span>
        <img class="icon-rst-badge" src="{{$value['classify_icon']}}" alt="" title="{{isset($value['activity_ads']) ? $value['activity_ads']['activity_name'] : "" }}" />
    </div>
    <div class="menu_tool">
        <div class="toolbar_category element_drop_down">
            <a href="#" class="toolBar_toggle caret">美食分类</a>
            <div class="drop_down_menu">
                <ul class="cate_drop_down ui-helper-clearfix">
                    <li class="cate_item"><a href="#">点餐就有红包拿(0)
                        <img class="icon-rst-badge" src="http://fuss10.elemecdn.com/c/12/d2b0ed6e994997099e86581009d3bjpeg.jpeg" title="1元秒杀爽到爆！" alt="1元秒杀爽到爆！">
                    </a></li>
                    <li class="cate_item activity"><a href="#">一元秒杀</a></li>
                    <li class="cate_item"><a href="#">强烈推荐</a></li>
                </ul>
                <ul class="activity_drop_down">
                    <li> <img class="icon-rst-badge" src="http://fuss10.elemecdn.com/c/12/d2b0ed6e994997099e86581009d3bjpeg.jpeg" title="1元秒杀爽到爆！" alt="1元秒杀爽到爆！">
                          1元秒杀（限新用户）重庆：1元秒杀爽到爆！  </li>

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
    <section>
        <h2 title="套餐类">套餐类</h2>
        <p  class="ad_sec" title="每天可享受两单优惠，每单可享受3份特价菜。">每天可享受两单优惠，每单可享受3份特价菜。</p>
        <ul class="menu_list">
            <li class="menu_list_block">
                <div class="menu_sec_info">
                    <p class="menu_sec_title">
                        <a href="#" class="dish_flavor favor_btn">♥</a>
                        <a href="#" class="dish_title">意大利披萨</a>
                    </p>
                    <p class="menu_sec_desc" title="麻辣李素">麻辣李素</p>
                </div>
                <div class="menu_sec_note">
                    <span class="rst-d-ordered dish_state">2</span>
                </div>
                <div class="menu_sec_action">
                    <div class="dish_act act_btn">
                        <a href="" class="rst-d-act-add add_btn" title="点击一份">
                            <span class="rst-d-act-glyph"></span>
                            <span class="price symbol-rmb">28</span>
                        </a>
                        <a href="" class="rst-d-act-toggle caret add_main_btn"></a>
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
                    <span class="rst-d-rating food_rating">
                        <i class="icon-d-star s2 i_s"></i>(1)
                    </span>
                    <span class="rst-d-sales">月售2份</span>
                </div>
            </li>
        </ul>
    </section>
</div>
@endforeach

@section("css")
    @parent
    {{HTML::style("/css/widget/cate_list/cate_list.css")}}
@stop