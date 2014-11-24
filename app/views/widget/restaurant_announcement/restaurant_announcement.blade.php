<section class="rst-block restaurant-board">
    <h3 class="rst-aside-title">餐厅公告</h3>

    <p class="rst-notice-board"><i class="icon-rst-notice"></i>{{$announcement['data']['announce_content']}}</p>

    <p class="rst-deliver-detail">
        <i class="icon-rst-deliver"></i>起送价<span class="rst_deliver_amount">{{$announcement['data']['start_price']}}</span>元。
        （本店优先配送饿了么）
    </p>

    <ul class="rst-badge-list">
        @foreach ($announcement['data']['activities'] as $v)
            <li class="rst-badge-item"><i class="icon-rst-badge {{$v['activity_icon']}}"></i>{{$v['activity_name']}}</li>
        @endforeach
    </ul>
</section>

@section("css")
    @parent
    {{HTML::style("/css/widget/restaurant_announcement/restaurant_announcement.css")}}
@stop