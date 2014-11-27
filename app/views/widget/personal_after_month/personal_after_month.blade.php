@include("widget/order_form/order_form", array("form" => $after_month, "title" => "一个月之前"))

@section("css")
    @parent
    {{HTML::style("/css/widget/personal_after_month/personal_after_month.css")}}
@stop