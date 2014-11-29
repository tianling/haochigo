<div class="collection">
    <div class="collection-header">
        <span class="title">我的收藏</span>
            <a class="set" href="{{$my_store['url']}}">设置</a>
        </div>

        <div class="collection-row">
        {{-- 获取商店widget --}}
        @include("widget/shop_sec/shop_sec", array("shops" => $my_store['data']))
        {{-- 填充剩余的块 --}}
        @include("widget/shop_uncollected/shop_uncollected")
    </div>
</div>

@section("css")
    @parent
    {{HTML::style("/css/widget/my_collection/my_collection.css")}}
@stop