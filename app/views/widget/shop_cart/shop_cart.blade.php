<i class="aside-icon-cart"></i>
<div class="aside-cart-dock">
    <span class="rcart-info basket_food_info"><span id="cartTotalItems">0</span>份 <span id="cartTotalPrice" class="symbol-rmb">0</span></span>
    <a class="aside-cart-btn disabled" href="##">篮子是空的</a>
</div>
<div id="cartScroll" class="aside-cart-dropup">
    <p class="rcart-empty">篮子是空的</p>
    {{--<h4 class="rcart-title">购物车<a class="rcart-clear basket_clear_btn">[清空]</a></h4>--}}
    {{--<ul class="rcart-list basket_list">--}}
        {{--<li class="rcart-dish" data-good_id="12321" data-shop_id="124214">--}}
            {{--<div class="rcart-d-name">平菇牛肉小份</div>--}}
            {{--<div class="rcart-d-modify">--}}
                {{--<a class="rcart-d-act minus d_btn">-</a>--}}
                {{--<input class="rcart-d-qty set_num_in" type="text" value="1">--}}
                {{--<a class="rcart-d-act add i_btn">+</a>--}}
            {{--</div>--}}
            {{--<div class="rcart-d-total symbol-rmb">10</div>--}}
            {{--<a class="rcart-d-del r_btn">×</a>--}}
        {{--</li>--}}
        {{--<li class="rcart-dish" data-good_id="4535" data-shop_id="34535">--}}
            {{--<div class="rcart-d-name">餐盒费</div>--}}
            {{--<div class="rcart-d-modify">--}}
                {{--<a class="rcart-d-act minus d_btn">-</a>--}}
                {{--<input class="rcart-d-qty set_num_in" type="text" value="1">--}}
                {{--<a class="rcart-d-act add i_btn">+</a>--}}
            {{--</div>--}}
            {{--<div class="rcart-d-total symbol-rmb">1</div>--}}
            {{--<a class="rcart-d-del r_btn">×</a>--}}
        {{--</li>--}}
    {{--</ul>--}}
</div>
<script type="text/template" id="tpl-cart-item">
    <li class="rcart-dish" data-good_id="<%= data.id %>" data-shop_id="<%= data.shop_id %>">
        <div class="rcart-d-name"><%= data.title %></div>
        <div class="rcart-d-modify">
            <a class="rcart-d-act minus d_btn">-</a>
            <input class="rcart-d-qty set_num_in" type="text" value="<%= data.count %>">
            <a class="rcart-d-act add i_btn">+</a>
        </div>
        <div class="rcart-d-total symbol-rmb"><%= data.price %></div>
        <a class="rcart-d-del r_btn">×</a>
    </li>
</script>
@section("css")
    @parent
    {{HTML::style("/css/widget/shop_cart/shop_cart.css")}}
@stop