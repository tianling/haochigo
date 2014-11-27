<div class="content_header">
    <h2>我收藏的美食 - 共{{$good_count}}个</h2>
</div>
<div class="content_inner">
    <table class="favor_table table table-striped">
        <thead>
            <tr>
                <th>美食</th>
                <th>所属餐厅</th>
                <th>单价</th>
                <th>订购</th>
                <th>人气</th>
                <th>删除</th>
            </tr>
        </thead>
        <tbody>
        @foreach($goods as $key=>$value)
            <tr data-good_id="{{$value['good_id']}}" data-shop_id="{{$value['shop_id']}}">
                <td>{{$value['good_name']}}</td>
                <td><a href="{{$value['shop_href']}}">{{$value['shop_name']}}</a></td>
                <td>{{$value['good_price']}}元</td>
                <td><a class="btn order_btn" href="{{$value['order_href']}}">预定</a></td>
                <td>月售{{$value['shop_hot']}}份</td>
                <td><a href="{{$value['delete_good']}}">删除</a></td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@section("css")
    @parent
    {{HTML::style("/css/widget/personal_collection_goods/personal_collection_goods.css")}}
@stop