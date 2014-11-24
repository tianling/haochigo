@for ($i = 0; $i < count($shops); $i++)
    <a href="{{$shops[$i]['shop_url']}}">
        @if($shops[$i]['is_opening'])
            <div class="collection-row-book collection-row-colse" data-shop_id="{{$shops[$i]['shop_id']}}" data-place_id="{{$shops[$i]['place_id']}}">
        @else
            <div class="collection-row-book" data-shop_id="{{$shops[$i]['shop_id']}}" data-place_id="{{$shops[$i]['place_id']}}">
        @endif
                <div class="collection-row-book-close">
                    <i href="##" class="close"></i>
                </div>
                <div class="collection-row-book-left">
                    <div class="logo">
                        @if($shops[$i]['shop_logo'])
                            <img src="{{url($shops[$i]['shop_logo'])}}"/>
                        @else
                            <img src="{{url("images/eleme_restaurant_logo.jpg")}}"/>
                        @endif
                    </div>
                    @if (!$shops[$i]['deliver_time'])
                        <span title="该餐厅刚开张，暂无送餐时间数据"></span>
                    @elseif ($shops[$i]['deliver_time'] < 45)
                    <span title="平均送餐时间{{$shops[$i]['deliver_time']}}分钟">{{$shops[$i]['deliver_time']}}分钟</span>
                    @else
                        <span class="long_time" title="当前餐厅送餐较慢">45+分钟</span>
                    @endif
                </div>
            <div class="collection-row-book-right">
                <div class="title">
                    <p>{{$shops[$i]['shop_name']}}</p>
                </div>
                @if($shops[$i]['is_opening'])
                    <div class="busy">
                    @if($shops[$i]['is_opening']==1)
                            <span>休息中</span>
                        </div>
                        <div class="remark">
                            <span title="休息中，暂不接受订单">休息中暂不接受订单</span>
                        </div>
                    @else
                            <span>太忙了</span>
                        </div>
                        <div class="remark">
                            <span title="太忙了，暂不接受订单">太忙了暂不接受订单</span>
                        </div>
                    @endif
                @else
                    @if(isset($is_ready_for_order) ? $shops[$i]['is_ready_for_order'] : 0)
                        <div class="reserve">
                            <span>接受预定</span>
                        </div>
                        <div class="remark">
                            <span title="接受预定，送餐时间{{$shops[$i]['deliver_start']}}开始">送餐时间{{$shops[$i]['deliver_start']}}开始</span>
                        </div>
                    @else
                        <div class="style">
                            <span>{{$shops[$i]['shop_type']}}</span>
                        </div>
                        <div class="remark">
                            <div class="star" title="餐厅评价：{{$shops[$i]['shop_level']}}星" style="background-position: -1px {{-334+15.5*ceil($shops[$i]['shop_level']*2)}}px"></div>
                            <span>{{$shops[$i]['order_count']}}订单</span>
                        </div>
                    @endif
                @endif
                </div>
            </div>
        </a>

 @endfor

@section("css")
	@parent
	{{HTML::style("/css/widget/shop_sec/shop_sec.css")}}
@stop
