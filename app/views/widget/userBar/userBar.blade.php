<div class="tb-container">
    <a class="logo" href="/" title="饿了么" alt="饿了么" role="logo">
        <i class="default-logo"></i>
    </a>
    <a class="m-apps" href="{{{$userbar['url']['mobile']}}}"><i class="icon-mobile"></i>手机客户端</a>
    <div class="tb-search" role="search">
        <form class="tb-search-form">
            <i class="icon-search"></i>
            <input class="tb-search-input" type="text" name="keyword" autocomplete="off" placeholder="搜索餐厅，美食…">
            <i class="icon-loading hide"></i>
            <a class="icon-clear hide"></a>
        </form>
        <div class="search-result">
            <div class="search-no-result">没有找到相关美食和餐厅，请换个关键字。</div>
        </div>
    </div>
    <nav class="tb-nav">
        <ul class="tb-site-nav" role="navigation">
            <li><a class="tb-site-nav-link" href="{{{$userbar['url']['my_ticket']}}}">我的饿单</a></li>
            <li><a class="tb-site-nav-link" href="{{{$userbar['url']['my_gift']}}}">礼品中心</a></li>
            <li><a class="tb-site-nav-link" href="{{{$userbar['url']['feedback']}}}">反馈留言</a></li>
            <li class="tb-hr"><a class="tb-site-nav-link last" href="##">附近团购</a></li>
        </ul>
        <div class="tb-cart">
            <a href="##" class="tb-cart-link">
                <i class="icon-cart"></i>
            </a>
            <div class="tb-cart-dropdown-wrapper">
                <div class="tb-cart-dropdown">
                    <div class="f-loading"></div>
                </div>
            </div>
        </div>
        <div class="tb-msg">
            <a href="##" class="tb-msg-link">
               <i class="icon-msg"></i>
            </a>
            <div class="tb-msg-dropdown-wrapper">
               <div class="tb-msg-dropdown">
                   <div class="f-loading"></div>
               </div>
            </div>
        </div>
        <div class="topbar-user-nav">
            <a href="##" class="tb-username">这是用户名<i class="caret"></i></a>
            <ul class="tb-user-dropdown">
                <li><a rel="nofollow" href="{{{$userbar['url']['personal']}}}"><i class="icon-profile"></i>个人中心</a></li>
                <li><a rel="nofollow" href="{{{$userbar['url']['my_collection']}}}"><i class="icon-fav"></i>我的收藏</a></li>
                <li><a rel="nofollow" href="{{{$userbar['url']['my_place']}}}"><i class="icon-address"></i>我的地址</a></li>
                <li><a rel="nofollow" href="{{{$userbar['url']['my_secure']}}}"><i class="icon-config"></i>安全设置</a></li>
                <li class="divider"></li>
                <li><a rel="nofollow" href="{{{$userbar['url']['loginout']}}}"><i class="icon-logout"></i>退出登录</a></li>
            </ul>
        </div>
    </nav>
</div>


<script type="text/template" id="tpl-tb-search">
    <div class="tb-search-autocomplete">
        <% data.forEach(function(val){ %>
        <div class="clearfix">
            <span class="search-cate"><%= val.goods_category %></span>
            <ul class="search-list">
                <% val.shop_result.forEach(function(_val){ %>
                <li class="search-item">
                    <img class="sr-logo" src="<%= _val.img_url %>" alt="<%= _val.goods_name %>">
                    <a class="sr-name" href="<%= _val.goods_url %>" target="_blank"><%= _val.goods_name %></a>

                    <span class="sr-price"><span class="symbol-rmb">¥</span> <%= _val.goods_value %></span>
                </li>
                <% }) %>
            </ul>
        </div>
        <% }) %>
    </div>
</script>
<script type="text/template" id="tpl-tb-cart-empty">
    <div class="tb-widget-empty">篮子空空，肚子空空，快去订餐吧~</div>
</script>

<script type="text/template" id="tpl-tb-msg-empty">
    <div class="tb-widget-empty">没有新信息~</div>
</script>

<script type="text/template" id="tpl-tb-cart">
<div class="twidget-dropdown">
          <div id="tcart_wrapper">
          <h3 class="tcart-title clearfix">
             <a class="tcart-restaurant" href="<%= data.url.shop_url %>"><%= data.shop_name %></a>
             <span class="tcart-cost"><span class="symbol-rmb">¥ </span><%= data.all_value %></span>
             <span id="tcart_total_hidden" class="hide">1</span>
          </h3>

    <div class="tcart-content">

    <ul class="tcart-list">
    <% data.goods.forEach(function(item){ %>
        <li class="tcart-item">
             <span class="tcart-dish"><%= item.good_name %></span>
             <span class="tcart-amount">× <%= item.good_count %></span>
             <span class="tcart-price"><span class="symbol-rmb">¥ </span><%= item.good_value %></span>
         </li>

    <% }); %>

     </ul>
  </div>

<div class="twidget-footer">
    <a id="tcart_checkout" class="twidget-btn" href="/cart2/checkout">去结算</a>
  </div>
</div>
        </div>
</script>
@section("css")
    @parent
    {{HTML::style("/css/widget/userBar/userBar.css")}}
@stop
