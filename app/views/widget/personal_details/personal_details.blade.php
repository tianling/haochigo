<div class="content-header">
    <h2>查看交易明细</h2>
</div>
<div class="content-inner">
    <div id="trade_record_filter" class="trade-record-filter">
        <p>分类：
            <span class="trade-record-filter-lineone"><a class="active" href="
    {{{$personal_details['url']['all']}}}">全部</a></span>
            <span><a href="
    {{{$personal_details['url']['takeout']}}}">叫外卖</a></span>
            <span><a href="
    {{{$personal_details['url']['charge']}}}">充值</a></span>
            <span><a href="
    {{{$personal_details['url']['refund']}}}">退单</a></span>
        </p>
        <p>日期：
            <span class="trade-record-filter-lineone"><a href="{{{$personal_details['url']['today']}}}">今天</a></span>
            <span><a class="active" href="{{{$personal_details['url']['sevenday']}}}">近7天</a></span>
            <span><a href="{{{$personal_details['url']['fifteenday']}}}">近15天</a></span>
            <span><a href="{{{$personal_details['url']['onemonth']}}}">1个月</a></span>
        </p>
        <p>状态：
            <span class="trade-record-filter-lineone"><a class="active" href="{{{$personal_details['url']['state_all']}}}">全部</a></span>
            <span><a href="{{{$personal_details['url']['state_ing']}}}">进行中</a></span>
            <span><a href="{{{$personal_details['url']['state_success']}}}">成功</a></span>
            <span><a href="{{{$personal_details['url']['state_fail']}}}">失败</a></span>
        </p>
    </div><!--end trade_record_filter-->

    <table class="table table-striped records-table">
        <thead>
        <tr>
            <th>创建时间</th>
            <th width="15%">交易类型</th>
            <th width="35%">交易详情</th>
            <th class="amount">金额</th>
            <th>交易状态</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($personal_details['data'] as $i => $item)
            <tr>
                <td>{{{$item['create_time']}}}</td>
                <td>{{{$item['deal_type']}}}</td>
                <td>{{$item['deal_details']}}</td>
                @if (mb_substr($item['deal_money'], 0, 1) == "+")
                <td class="green amount">{{{$item['deal_money']}}}</td>
                @else
                <td class="orange amount">{{{$item['deal_money']}}}</td>
                @endif
                <td>
                    {{{$item['deal_state']}}}             <br>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

</div>

<div>
    <div class="pagination">
        <ul>
            <li class="prev disabled"><a href="#">← 上一页</a></li>
            <li class="active"><a href="/profile/records/date/7days/page/1">1</a></li>
            <li><a href="/profile/records/date/7days/page/2">2</a></li>
            <li class="next"><a href="/profile/records/date/7days/page/2">下一页 →</a></li>
        </ul>
    </div>
</div>
@section("css")
    @parent
    {{HTML::style("/css/widget/personal_details/personal_details.css")}}
@stop
