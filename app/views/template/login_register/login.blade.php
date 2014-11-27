@extends("layout.login")

@section("header")
	@include("widget.logo.logo")
@stop

@section("product_image")
    @include('widget.product_image.product_image')
@stop

@section("form")
    @include("widget.login_form.login_form")
@stop

@section("footer")
	@include("widget.footer.footer")
@stop

@section("css")
    {{HTML::style("/css/lib/jquery-ui.css")}}
    {{HTML::style("/css/template/lib/normalize.css")}}
    {{HTML::style("/css/template/lib/function.css")}}
	{{HTML::style("/css/template/login_register/login.css")}}
	{{HTML::style("/css/template/login_register/login.register.css")}}
@stop

@section("script")
    {{HTML::script("/js/lib/require.js", ["data-main" => url("js/template/login_register/login.js")])}}
@stop

