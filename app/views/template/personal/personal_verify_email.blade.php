@extends("layout.personal")

@section("header")
	@include("widget.userBar.userBar")
@stop

@section("nav")
    @include("widget.nav.nav")
@stop

@section("sidebar")
    @include("widget.sideBar.sideBar", array("active" => "verify_email"))
@stop

@section("rightContent")
    @include("widget.personal_verify_email.personal_verify_email")
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
    {{HTML::script("/js/lib/require.js", ["data-main" => url("js/template/personal/personal_verify_email.js")])}}
@stop

