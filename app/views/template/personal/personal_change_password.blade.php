@extends("layout.personal")

@section("header")
	@include("widget.userBar.userBar")
@stop

@section("nav")
    @include("widget.nav.nav")
@stop

@section("sidebar")
    @include("widget.sideBar.sideBar", array("active" => "change_password"))
@stop

@section("rightContent")
    @include("widget.personal_change_password.personal_change_password")
@stop

@section("footer")
	@include("widget.footer.footer")
@stop

@section("css")
    {{HTML::style("/css/lib/jquery-ui.css")}}
    {{HTML::style("/css/template/lib/normalize.css")}}
	{{HTML::style("/css/template/personal/personal.css")}}
@stop

@section("script")
    {{HTML::script("/js/lib/require.js", ["data-main" => url("js/template/personal/personal_change_password.js")])}}
@stop

