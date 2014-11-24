
@include("widget/order_form/order_form", array("form" => $recent_month, "title" => "最近一个月"))

@section("css")
    @parent
    {{HTML::style("/css/widget/personal_recent_month/personal_recent_month.css")}}
@stop