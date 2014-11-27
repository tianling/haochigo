<div class="content_header">
    <div class="ui-helper-clearfix">
        <h2>个人中心</h2>
    </div>
</div>
<div class="content_inner">
    <div class="account_state">
        <div class="ui-helper-clearfix">
            <div class="col_left">
                <div class="avatar">
                </div>
                <div class="ava_wrapper">
                    <h5>{{$personal['user_name']}}</h5>
                    <div>
                        <span>安全等级</span>
                        <a class="user-level <?php
                            if($personal['user_level'] == 0){ echo "low"; }
                            else if($personal['user_level'] == 1){ echo "middle"; }
                            else if($personal['user_level'] == 2){ echo "high";}
                            else if($personal['user_level' == 3]) {echo "full";}
                            ?>">较高</a>
                    </div>
                </div>
            </div>
            <div class="col_right">
                <div class="text_head">账户余额</div>
                <div class="account_balance ui-helper-clearfix">
                    <div class="balance">
                        <strong>{{$personal['user_balance']}}</strong>元
                    </div>
                    <div class="relative">
                        <a href="{{$personal['charge']}}" class="btn btn-yellow">立刻充值</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="relate_info ui-helper-clearfix">
            <ul>
                <li><i class="icon icon-order"></i> 完成订单: <a href="{{$sidebar['personal_recent_month']}}">{{$personal['user_order']}}</a>张(1个月内完成)</li>
                <li><i class="icon icon-star"></i> 收藏: <a href="{{$sidebar['personal_collection_shop']}}">{{$personal['user_collect']['restaurant']}}</a>家餐厅 <a href="{{$sidebar['personal_collection_goods']}}">{{$personal['user_collect']['cate']}}</a>份美食 </li>
            </ul>
        </div>
    </div>
    <div class="last_order">
        <ul class="tab_header ui-helper-clearfix">
            <li class="active recent_order">最近饿单</li>
            <li class="recent_deal">最近在线交易</li>
        </ul>
        <div class="tab_body">
            <a href="{{$sidebar['personal_details']}}" class="more_deal">更多在线交易>>></a>
            <table class="recent_ticket">
                <thead>
                    <tr>
                        <th>订单号</th>
                        <th>下单时间</th>
                        <th>餐厅</th>
                        <th>订单详情</th>
                        <th>订单状态</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($personal['recent_order'] as $key=>$value)
                    <tr>
                        <td class="sn"><a href="">{{$value['order_number']}}</a></td>
                        <td class="time">{{$value['order_time']}}</td>
                        <td class="restaurant">{{$value['order_restaurant']}}</td>
                        <td>{{$value['order_details']}}</td>
                        <td class="status">{{$value['order_state']}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <table class="recent_month" style="display: none;">
                 <thead>
                    <tr>
                        <th>创建时间</th>
                        <th>交易类型</th>
                        <th>交易详情</th>
                        <th>金额</th>
                        <th>交易状态</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($personal['recent_deal'] as $key=>$value)
                    <tr>
                        <td class="sn"><a href="">{{$value['deal_time']}}</a></td>
                        <td class="time">{{$value['deal_type']}}</td>
                        <td>{{$value['deal_details']}}</td>
                        <td class="{{$value['deal_money']['money_type'] == 0 ? "up" : "down"}}">{{$value['deal_money']['money_type'] == 0 ? "+" : "-"}}{{$value['deal_money']['money_sum']}}</td>
                        <td class="status">{{$value['deal_status']}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

    </div>
</div>

@section("css")
    @parent
    {{HTML::style("/css/widget/personal_center/personal_center.css")}}
@stop