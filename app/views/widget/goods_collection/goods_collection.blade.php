<section id="favor_food" class="rst-block">
    <h3 class="rst-aside-title">我的收藏</h3>
    {{--<div class="rst-aside-empty empty_favor">--}}
        {{--<i class="glyph-fav glyph-icon"></i>--}}
        {{--收藏过的美食在这里--}}
    {{--</div>--}}
    <ul class="rst-aside-menu-list favor_list">
        <li class="rst-aside-dish-item">
            <div class="rst-d-info">
                <p class="rst-d-main text-overflow">
                    <a class="rst-d-name food_name" title="土豆丝牛肉盖饭">土豆丝牛肉盖饭</a>
                </p>
            </div>
            <div class="rst-d-action r_d_a">
                <div class="rst-d-act narrow act_btns">
                    <a class="rst-d-act-add add_btn" title="点击饿一份" role="button"><span class="rst-d-act-glyph"></span><span class="price symbol-rmb">1</span></a>
                </div>
            </div>
        </li>
        <li class="rst-aside-dish-item">
                    <div class="rst-d-info">
                        <p class="rst-d-main text-overflow">
                            <a class="rst-d-name food_name" title="土豆丝牛肉盖饭">土豆丝牛肉盖饭</a>
                        </p>
                    </div>
                    <div class="rst-d-action r_d_a">
                        <div class="rst-d-act narrow act_btns">
                            <a class="rst-d-act-add add_btn" title="点击饿一份" role="button"><span class="rst-d-act-glyph"></span><span class="price symbol-rmb">1</span></a>
                        </div>
                    </div>
                </li>
                <li class="rst-aside-dish-item">
                            <div class="rst-d-info">
                                <p class="rst-d-main text-overflow">
                                    <a class="rst-d-name food_name" title="土豆丝牛肉盖饭">土豆丝牛肉盖饭</a>
                                </p>
                            </div>
                            <div class="rst-d-action r_d_a">
                                <div class="rst-d-act narrow act_btns">
                                    <a class="rst-d-act-add add_btn" title="点击饿一份" role="button"><span class="rst-d-act-glyph"></span><span class="price symbol-rmb">1</span></a>
                                </div>
                            </div>
                        </li>
    </ul>
</section>
<script type="text/template" id="tpl-rst-dish-item">
<% data.forEach(function(d){ %>
    <li class="rst-aside-dish-item">
        <div class="rst-d-info">
            <p class="rst-d-main text-overflow">
                <a class="rst-d-name food_name" title="<%= d.title %>"><%= d.title %></a>
            </p>
        </div>
        <div class="rst-d-action r_d_a">
            <div class="rst-d-act narrow act_btns">
                <a class="rst-d-act-add add_btn" title="点击加一份" role="button"><span class="rst-d-act-glyph"></span><span class="price symbol-rmb"><%= d.price %></span></a><a class="rst-d-act-toggle caret add_main_btn" role="button"></a>
            </div>
        </div>
    </li>
<% }); %>
</script>
@section("css")
    @parent
    {{HTML::style("/css/widget/goods_collection/goods_collection.css")}}
@stop