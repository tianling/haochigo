<div class="content_header">
    <h2>我收藏的餐厅</h2>
</div>
<div class="content_inner">
    <div class="favor-restaurants">
        <h3>当前区域({{$shops['now_area']}})的餐厅 - 共<span class="restaurant_count">{{$shops['now_shop_count']}}</span>个</h3>
        <table class="favor_table table">
            <tbody>
                <tr>
                @foreach($shops['now_place'] as $key=>$value)
                    <td data-shop_id="{{$value['shop_id']}}" class="restaurant-column">
                        <div class="restaurant-block {{ $value['shop_statue'] == 1 ? "closed"  : "" }}">
                            <div class="line-one">
                                <div class="logo-wrapper">
                                    <div class="logo"><a href="{{$value['shop_url']}}"><img src="{{$value['shop_logo']}}" alt=""/></a></div>
                                    <div class="deliver_time">{{$value['deliver_time']}}分钟</div>
                                </div>
                                <div class="info">
                                    <div class="name"><a href="">{{$value['shop_name']}}</a></div>
                                    @if($value['shop_statue'] == 1)
                                        <div class="status-label closed">
                                              <span>{{$value['shop_name']}}</span>
                                        </div>
                                        <div class="status-desc closed">
                                            <span title="">已打烊</span>
                                        </div>
                                    @else()
                                        <div class="status-label ui-helper-clearfix">
                                              <span>{{$value['shop_type']}}</span>
                                        </div>
                                        <div class="ratings">
                                            <span class="star rating-star r{{round(2 * $value['shop_level'])}}"></span>
                                            {{$value['goods_count']}}订单
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </td>
                    <td class="close">
                        <div class="close_box">
                            <a class="close_btn" href="#"><i class="icon icon-remove"></i></a>
                        </div>
                    </td>
                @endforeach
                </tr>
            </tbody>
        </table>
    </div>
    <div class="favor-restaurants">
        <h3>我收藏的其他地区的餐厅  - 共<span class="restaurant_count">{{$shops['other_shop_count']}}</span>个</h3>
        <table class="favor_table table">
            <tbody>
                   @foreach($shops['other_place'] as $key=>$value)
                   <tr>
                       <td data-shop_id="{{$value['shop_id']}}" class="restaurant-column">
                           <div class="restaurant-block {{ $value['shop_statue'] == 1 ? "closed"  : "" }}">
                               <div class="line-one">
                                   <div class="logo-wrapper">
                                       <div class="logo"><a href="{{$value['shop_url']}}"><img src="{{$value['shop_logo']}}" alt=""/></a></div>
                                       <div class="deliver_time">{{$value['deliver_time']}}分钟</div>
                                   </div>
                                   <div class="info">
                                       <div class="name"><a href="">{{$value['shop_name']}}</a></div>
                                       @if($value['shop_statue'] == 1)
                                           <div class="status-label closed">
                                                 <span>{{$value['shop_name']}}</span>
                                           </div>
                                           <div class="status-desc closed">
                                               <span title="">已打烊</span>
                                           </div>
                                       @else()
                                           <div class="status-label ui-helper-clearfix">
                                                 <span>{{$value['shop_type']}}</span>
                                           </div>
                                           <div class="ratings">
                                               <span class="star rating-star r{{round(2 * $value['shop_level'])}}"></span>
                                               {{$value['goods_count']}}订单
                                           </div>
                                       @endif
                                   </div>
                               </div>
                           </div>
                       </td>
                       <td class="close">
                           <div class="close_box">
                               <a class="close_btn" href=""><i class="icon icon-remove"></i></a>
                           </div>
                       </td>
                   </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@section("css")
    @parent
    {{HTML::style("/css/widget/personal_collection_shop/personal_collection_shop.css")}}
@stop