<div class="shops">
        <div class="shops-header">
            <div class="ui-helper-clearfix">
               <span class="shops_func choice_click" data-label="ishot">
                    <input type="checkbox" class="sh_hot_shops"  name="hot_shops"/>
                    <label>热门餐厅</label>
               </span>
               <span class="shops_func choice_click" data-label="isonline">
                    <input type="checkbox" class="sh_hot_shops"  name="hot_shops" />
                   <label for="sh_running">营业中</label>
                </span>
                <span class="fliter"></span>
               <span class="shops_func choice_click" data-label="issupportpay">
                    <input type="checkbox"  class="sh_hot_shops" name="hot_shops" />
                    <label for="sh_online_pay">在线支付</label>
                </span>
                <div class="flavor_block" data-label="flavor">
                    <div class="drop_button"><a>口味</a></div>
                        <ul class="drop_list">
                            <li>全部</li>
                            <li>中式</li>
                            <li>西式</li>
                            <li>港式</li>
                            <li>奶茶</li>
                            <li>烧烤</li>
                            <li>日式</li>
                            <li>韩式</li>
                            <li>甜点</li>
                            <li>汉堡</li>
                        </ul>
                </div>
            </div>
        </div>
        <div class="shop_activities">
            <div class="ui-helper-clearfix">
            @foreach($shop_list['data']['activity'] as $key=>$value)
                    <span class="activities-btn" data-activity_id="{{$key}}">
                       <input class="sh_hot_shops" name="filter" type="checkbox">
                       <label>{{$value}}</label>
                   </span>
            @endforeach
            </div>
        </div>
        <table id="shop_container" class="shop_container">
            <tr>
                <td>
                    @include("widget/shop_info/shop_info" , array("shops" => $shop_list['data']['shops']))
                </td>
            </tr>
        </table>
</div>

<script type="text/template" id="shop_list_template">

<% for(var n = 0; n < Math.ceil(shops.length / 5); n++) { %>
    <div class="more_shops-row">
        <%  for (var i = n * 5 ; (i < n * 5 + 5) && (i < shops.length); i++){ %>
            <a href="<%= shops[i]['shop_url'] %>" class="restaurant-<%= shops[i]['shop_id'] %>">
            
             <% if(shops[i]['isonline']){ %>
                  <div class="more_shops-row-book more_shops-row-colse" data-support_activity="<%= shops[i]['support_activity'].join(',') %>" data-isHot="<%= Number(shops[i]['ishot']) %>" data-isOnline="<%= Number(shops[i]['isonline']) %>" data-isSupportPay="<%= Number(shops[i]['issupportpay']) %>" data-flavor="<%=  shops[i]['flavor'] %>" data-shop_id="<%= shops[i]['shop_id'] %>" data-place_id="<%= shops[i]['place_id'] %>">
            <% } else { %>
                  <div class="more_shops-row-book" data-support_activity="<%= shops[i]['support_activity'].join(',') %>" data-isHot="<%= Number(shops[i]['ishot']) %>" data-isOnline="<%= Number(shops[i]['isonline']) %>" data-isSupportPay="<%= shops[i]['issupportpay'] %>" data-flavor="<%= shops[i]['flavor'] %>" data-shop_id="<%= shops[i]['shop_id'] %>" data-place_id="<%= shops[i]['place_id'] %>">
            <% } %>


<% if(shops[i]['is_collected']){ %>
                    <div class="collect_star">

                    </div>
                    <div class="collect">
                        收藏
                    </div>
                    <div class="uncollect change">
                        取消收藏
                    </div>
            <% } else { %>
                    <div class="collect_star" style="display: none">

                    </div>
                    <div class="collect change">
                        收藏
                    </div>
                    <div class="uncollect">
                        取消收藏
                    </div>
            <% } %>
                    <div class="more_shops-row-book-left">
                        <div class="logo">

            <% if(shops[i]['shop_logo'] != "images/eleme_restaurant_logo.jpg"){ %>
                                    <img class="logo_flag" src="<%= shops[i]['shop_logo'] %>"/>
            <% } else { %>
                                    <img src='images/eleme_restaurant_logo.jpg'/>
            <% } %>

                        </div>
            <% if (!shops[i]['deliver_time']){ %>
                                <span title="该餐厅刚开张，暂无送餐时间数据"></span>
            <% } else if (shops[i]['deliver_time'] < 45){ %>
                                <span title="平均送餐时间<%= shops[i]['deliver_time'] %>分钟"><%= shops[i]['deliver_time'] %>分钟</span>
            <% } else { %>
                                <span class="long_time" title="当前餐厅送餐较慢">45+分钟</span>
            <% } %>
                    </div>
                    <div class="more_shops-row-book-right">
                        <div class="title">
                            <p><%= shops[i]['shop_name'] %></p>
                        </div>
            <% if(shops[i]['is_opening']){ %>
                        <div class="busy">
                <% if(shops[i]['is_opening'] == 1 ){ %>
                            <span>休息中</span>
                        </div>
                        <div class="time">
                            <span title="休息中，暂不接受订单">休息中暂不接受订单</span>
                        </div>
                <% } else{ %>
                            <span>太忙了</span>
                        </div>
                        <div class="time">
                            <span title="太忙了，暂不接受订单">太忙了暂不接受订单</span>
                        </div>
                <% } %>
            <%  } else { %>
                <% if(shops[i]['is_ready_for_order']){ %>
                            <div class="reserve">
                                <span>接受预定</span>
                            </div>
                            <div class="time">
                                <span title="接受预定，送餐时间<%= shops[i]['deliver_start'] %>开始">送餐时间<%= shops[i]['deliver_start'] %>开始</span>
                            </div>
                <% } %>
                            <div class="style">
                            <span><%= shops[i]['shop_type'] %></span>
                        </div>
                        <div class="remark">
                            <div class="star" title="餐厅评价：<%= shops[i]['shop_level'] %>星" style="background-position: -1px <%= -334+15.5*Math.ceil(shops[i]['shop_level']*2) %>px"></div>
                <% if(shops[i]['order_count']){ %>
                                        <span><%= shops[i]['order_count'] %>订单</span>
                <% } %>
                            </div>
                        <div class="icon">
                <% for(var m = 0; m < shops[i]['support_activity'].length ; m++) { %>
                                        <span title="<%= shop_activity[shops[i]['support_activity'][m]] %>" style="background-position: 0 <%= 20-shops[i]['support_activity'][m]*20 %>px %>" ></span>
                <% } %>
                        </div>
            <% } %>

                    </div>

                    <div class="more_info more_info_right">
                        <div class="tip"></div>
                        <div style="font-size:15px; margin-left:10px;margin-bottom: 10px;">
                            <%= shops[i]['shop_name'] %>
                        </div>
            <% if(shops[i]['is_opening']==1){ %>
                                <p class="close">已打烊，<%= shops[i]['deliver_start'] %>开始订餐</p>
            <% } else if(shops[i]['is_opening']==2){ %>
                                <p class="close">餐厅太忙，暂不接受订单</p>
            <% } %>
                        <ul>

            <% for(var m = 0; m < shops[i]['support_activity'].length; m++){ %>
                                    <li>
                                        <span class="icon" style="background-position: 0 <%= 20-shops[i]['support_activity'][m]*20 %>px"></span>
                                        <span><%= shop_activity[shops[i]['support_activity'][m]] %> </span>
                                    </li>
            <% } %> 
                        </ul>
                        <div class="divider">
                            <p class="ann"><strong>公告:</strong>&nbsp;<%= shops[i]['shop_announce'] %></p>
                            <p><strong>起送价:</strong>&nbsp;<%= shops[i]['deliver_state_start'] %></p>
                            <p><strong>地址:</strong>&nbsp;<%= shops[i]['shop_address'] %></p>
                            <p><strong>营业时间:</strong>&nbsp;<%= shops[i]['business_hours'] %></p>
                            <p><strong>简介:</strong>&nbsp;<%= shops[i]['shop_summary'] %></p>
                        </div>
                    </div>
                </div>
            </a>    

        <% } %>
    </div>
<% } %>

</script>

@section("css")
    @parent
    {{HTML::style("/css/widget/shop_list/shop_list.css")}}
@stop