<div class="recent_month">

    <div class="header">
        <h2>
            {{$title}}的订单 - 共{{$form['deal_count']}}张
        </h2>
    </div>

    <div class="inner">
@foreach($form['deal'] as $value)
        <div class="order_form">
            <div class="order_header">
                <div class="order_wrapper">
@if($value['deal_statue'] == 0)
                    <div class="order_title unfinish">付款失败</div>
@elseif($value['deal_statue'] == 1)
                    <div class="order_title unfinish">无效订单</div>
                    <div class="refund">
                        <span></span>
                        付款金额会在3-7个工作日内退回您支付时的账户。
                    </div>
@elseif($value['deal_statue'] == 2)
                    <div class="order_title finish">餐厅已确认</div>
                    <div class="retrun">
                        <a href="{{$value['deal_return']}}">我要退单</a>
                    </div>
@else
                    <div class="order_title finish">交易已完成</div>
                    <div class="same_again">
                        <a href="{{$value['same_again']}}">
                            <i></i>
                            <span>再来一份</span>
                        </a>
                    </div>
@endif
                </div>
@if($value['deal_is_pre'] && $value['deal_statue'] == 3)
                <div class="order_pre">
                    <p>此订单为预订单，送餐时间：{{$value['deal_pre_time']}}</p>
                </div>
@endif
                <div class="order_table">
                    <table>
                        <tbody>
                            <tr>
                                <td colspan="3">
                                    <span>餐厅名:</span>
                                    <a href="{{$value['deal_again']}}">{{$value['shop_name']}}</a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span>额单号:</span>
                                    {{$value['deal_number']}}
                                </td>
                                <td>
                                    <span>支付时间:</span>
                                    {{$value['deal_time']}}
                                </td>
                                <td>
                                    <span>餐厅电话:</span>
                                    {{$value['deal_phone']}}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span>饿单地址:</span>
                                    {{$value['deliver_address']}}
                                </td>
                                <td>
                                    <span>联系电话:</span>
                                    {{$value['deliver_phone']}}
                                </td>
                                <td>
                                    <span>饿单备注:</span>
                                    {{$value['deliver_remark']}}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>


            </div>


            <div class="order_evaluate">
@if($value['deal_statue'] > 1)

@if($value['deal_speed'])
                <div class="content">
                    <p>点评送餐速度：</p>
                    <p>已点评， 时间： {{$value['deal_speed']}}</p>
                </div>
@else
                <div class="content">
                    <p>点评送餐速度：</p>
                    <div class="content_speed">
                        <div class="col_content">
                            <div class="slider-wrapper pretty-slider">
@if($value['deal_is_pre'])
                                <div class="slider ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all" title="请打分" max="25" min="-25">
@else
                                <div class="slider ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all" title="请打分" max="25" min="1">
@endif
                                    <div class="ui-slider-range ui-widget-header ui-slider-range-min" style="width: 100%;"></div>
                                    <a class="ui-slider-handle ui-state-default ui-corner-all" style="left: 100%;"></a>
                                </div>
                            </div>
                        </div>
                        <div class="col_value">
                            <span>请点评</span>
                        </div>
                        <input class="shop_id" type="text" value="{{$value['shop_id']}}" style="display: none"/>
                        <input class="deal_id" type="text" value="{{$value['deal_id']}}" style="display: none"/>
                        <div class="col_btn" style="display:none">
                            <a class="btn">保存</a>
                        </div>
                    </div>
                </div>

@endif

@else
                <div class="content">
                    <p>点评送餐速度：</p>
                    <p>当前状态下不能点评</p>
                </div>
@endif

@if($value['deal_statue'] > 1)

@if($value['deal_satisfied'])
                <div class="content">
                    <p>您对餐厅的服务是否满意：</p>
                    <p>已点评，
@if($value['deal_satisfied']==1)
                        不满意
@elseif($value['deal_satisfied']==2)
                        一般般
@elseif($value['deal_satisfied']==3)
                        满意
@endif
                    </p>
                </div>
@else
                <div class="content">
                    <p>您对餐厅的服务是否满意：</p>
                    <div class="order_content">
                      <div class="order_label">
                        <form class="order_content_form">
                            <label>
                              <input class="order_radio" type="radio" title="满意" name="service-rate" value="3">
                              <i class="rank3"></i>满意
                            </label>
                            <label>
                              <input class="order_radio" type="radio" title="一般般" name="service-rate" value="2">
                              <i class="rank2"></i>一般般
                            </label>
                            <label>
                              <input class="order_radio" type="radio" title="不满意" name="service-rate" value="1">
                              <i class="rank1"></i>不满意
                            </label>
                        </form>
                      </div>
                      <div class="order_comment">
                        <textarea class="text" placeholder="再说点什么吧~"></textarea>
                        <input class="shop_id" type="text" value="{{$value['shop_id']}}"/>
                        <input class="deal_id" type="text" value="{{$value['deal_id']}}"/>
                        <a class="btn btn-yellow order_comment_save">保存</a>
                        <a class="btn order_comment_cancel" role="button">取消</a>
                      </div>
                    </div>
                </div>
@endif

@else
                <div class="content">
                    <p>您对餐厅的服务是否满意：</p>
                    <p>当前状态下不能点评</p>
                </div>
@endif
            </div>

            <div class="order_wrpper">
                <table>
                    <thead>
                        <tr>
                            <th class="name">
                                美食篮子
                            </th>
                            <th class="rating"></th>
                            <th class="price">
                                单价
                            </th>
                            <th class="num">
                                数量
                            </th>
                            <th class="sub">
                                小计
                            </th>
                        </tr>
                    </thead>
                    <tbody>
@foreach($value['good'] as $meun)
                        <tr>
                            <td class="name">
                                {{$meun['goods_name']}}
                            </td>

@if($value['deal_statue'] > 1)

@if($meun['good_atisfied'])

@if($meun['good_atisfied'] == 1)
                            <td class="rating">
                                <div class="comment">
                                    <div title="差评" class="mouseover">
                                        <div title="差点意思">
                                            <div title="一般般">
                                                <div title="有点滋味">
                                                    <div title="我的最爱">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="rating_text">差评</div>
@elseif($meun['good_atisfied'] == 2)
                            <td class="rating">
                                <div class="comment">
                                    <div title="差评">
                                        <div title="差点意思" class="mouseover">
                                            <div title="一般般">
                                                <div title="有点滋味">
                                                    <div title="我的最爱">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="rating_text">差点意思</div>
@elseif($meun['good_atisfied'] == 3)
                            <td class="rating">
                                <div class="comment">
                                    <div title="差评">
                                        <div title="差点意思">
                                            <div title="一般般" class="mouseover">
                                                <div title="有点滋味">
                                                    <div title="我的最爱">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="rating_text">一般般</div>
@elseif($meun['good_atisfied'] == 4)
                            <td class="rating">
                                <div class="comment">
                                    <div title="差评">
                                        <div title="差点意思">
                                            <div title="一般般">
                                                <div title="有点滋味" class="mouseover">
                                                    <div title="我的最爱">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="rating_text">有点滋味</div>
@else
                            <td class="rating">
                                <div class="comment">
                                    <div title="差评">
                                        <div title="差点意思">
                                            <div title="一般般">
                                                <div title="有点滋味">
                                                    <div title="我的最爱" class="mouseover">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="rating_text">我的最爱</div>
@endif

@else
                            <td class="rating rating_comment">
                                <div class="comment">
                                    <input class="shop_id" type="text" value="{{$value['shop_id']}}"/>
                                    <input class="deal_id" type="text" value="{{$value['deal_id']}}"/>
                                    <input class="goods_id" type="text" value="{{$meun['goods_id']}}"/>
                                    <div title="差评">1
                                        <div title="差点意思">2
                                            <div title="一般般">3
                                                <div title="有点滋味">4
                                                    <div title="我的最爱">5
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="rating_text"></div>
@endif

@else
                            <td class="content" style="color:#999;">
                                当前状态下不能点评
@endif
                            </td>
                            <td class="price">
                                ￥{{$meun['goods_value']}}
                            </td>
                            <td class="num">
                                {{$meun['goods_amount']}}
                            </td>
                            <td class="sub">
                                ￥{{$meun['goods_total']}}
                            </td>
                        </tr>
@endforeach
                    </tbody>
                    <thead>
                        <tr>
                            <th class="name">
                                其他费用
                            </th>
                            <th class="rating"></th>
                            <th class="price">
                                单价
                            </th>
                            <th class="num">
                                数量
                            </th>
                            <th class="sub">
                                小计
                            </th>
                        </tr>
                    </thead>
                    <tbody>
@foreach($value['others'] as $meun)
                        <tr>
                            <td class="name">
                                {{$meun['item_name']}}
                            </td>
                            <td class="rating"></td>
                            <td class="price">
                                ￥{{$meun['item_value']}}
                            </td>
                            <td class="num">
                                {{$meun['item_amount']}}
                            </td>
                            <td class="sub">
                                ￥{{$meun['item_total']}}
                            </td>
                        </tr>
@endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th class="name">
                                合计
                            </th>
                            <th class="rating"></th>
                            <th class="price"></th>
                            <th class="num"></th>
                            <th class="sub">
                                ￥{{$value['total']}}
                            </th>
                        </tr>
                    </tfoot>
                </table>
            </div>


        </div>
@endforeach
    </div>

</div>

@section("css")
    @parent
    {{HTML::style("/css/widget/order_form/order_form.css")}}
    {{HTML::style("/css/lib/ui-helper.css")}}
@stop
