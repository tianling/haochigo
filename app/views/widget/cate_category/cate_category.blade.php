<div class="res_block">
    <h2>美食分类</h2>
@if($good_category['data']['goods_category'])
    <ul class="res-cate-list">
@foreach($good_category['data']['goods_category'] as $list)
        <li>
            <a data-cateid="{{$list['classify_id']}}" title="{{$list['classify_name']}}" class="{{{$list['classify_icon']?"red":""}}}">{{$list['classify_name_abbr']}}</a>
@if($list['classify_icon'])
            <img src="{{$list['classify_icon']}}"/>
@endif
            <span>({{$list['classify_count']}})</span>
        </li>
@endforeach
        <div class="ui-helper-clearfix"></div>
    </ul>
@endif
@if($good_category['data']['good_activity'])
    <ul class="res-activity-list">
@foreach($good_category['data']['good_activity'] as $list)
        <li>
@if($list['activity_icon'])
            <img src="{{$list['activity_icon']}}"/>
@endif
            <span>{{$list['activity_name']}}： {{$list['activity_statement']}}</span>
        </li>
@endforeach
        <div class="ui-helper-clearfix"></div>
    </ul>
@endif
</div>

@section("css")
    @parent
    {{HTML::style("/css/widget/cate_category/cate_category.css")}}
@stop