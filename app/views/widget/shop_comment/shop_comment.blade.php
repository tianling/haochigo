{{-- 店铺评论 --}}

{{-- 导航 --}}
<div id="" class="rst-block f-cb">
    <a class="rst-subnav u-active" href="/cq-jgmx/rating">全部评价</a>
    <a class="rst-subnav" href="/cq-jgmx/rating/mine">我的评价</a>
</div>

<div id="" class="rst-rating f-cb">
	<div class="rst-rating-wrapper">

    @for($i = 0, $len = count($shop_comments); $i < $len; $i++)
      <div class="rst-rating-block">
          <p class="rst-rating-dish">
                <a class="link" href="/cq-jgmx#food/11302021" title="{{ $shop_comments[$i]['good_name'] }}">
                {{ $shop_comments[$i]["good_name"] }}
                <span class="symbol-rmb">{{ $shop_comments[$i]["good_price"] }}</span>
              </a>
              
                <i class="icon-d-star" style=" background-image:url({{ $shop_comments[$i]['star_url'] }}); "></i>
          </p>
          <p class="rst-rating-text">{{ $shop_comments[$i]["content"] }}</p>
          <p class="rst-rating-info">
              <span class="username">{{ $shop_comments[$i]["user_name"] }}</span>
              {{ $shop_comments[$i]["time"] }}
          </p>
      </div>
    @endfor

	</div>
</div>
@section("css")
    @parent
    {{HTML::style("/css/widget/shop_comment/shop_comment.css")}}
@stop