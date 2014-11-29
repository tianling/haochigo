

<div class="collection-modal">
    <div class="collection-header">
        <span class="title">收藏你喜欢的餐厅</span>
        <a class="set close">×</a>
    </div>

    <div class="collection-row">

        <div class="modal-body">

            <ul>
                <li class="new">
                    <p class="p_new action">新餐厅</p>
                </li>
                <li class="hot">
                    <p class="p_hot">热门餐厅</p>
                </li>
                <div class="ui-helper-clearfix"></div>
            </ul>

            <div class="pill-content new-res">
                {{-- 获取新餐厅的列表 --}}
                @include("widget/shop_alert_sec/shop_alert_sec", array("shops" => $my_store_alert['data']['new_shop']))
            </div>
            <div class="pill-content hot-res">
                {{-- 获取热门餐厅的列表 --}}
                @include("widget/shop_alert_sec/shop_alert_sec", array("shops" => $my_store_alert['data']['hot_shop']))
            </div>
        </div>
    </div>
    <div class="collection-footer">
        <a href="##" class="btn btn-yellow">完成收藏</a>
    </div>
</div>

@section("css")
	@parent
	{{HTML::style("/css/widget/my_collection_alert/my_collection_alert.css")}}
@stop
