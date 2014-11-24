
{{-- register form structrue --}}

<div class="register-hd f-cb">
	<h2 class="title f-fl">注册</h2>
</div>

<div class="register-bd">

	{{-- 普通注册表单 --}}
	<form class="m-register" novalidate="true" id="register-form">

		{{-- 用户名 --}}
		<div class="u-input-item">
			<input type="text" name="user-name" id="register-user-mobile" class="user-name box f-pr" placeholder="电话号码" minlength="5" required>
			<div class="u-error-tip f-dn">请填写电话号码</div>
		</div>

		{{-- 电子邮箱 --}}
		<div class="u-input-item">
			<input type="email" name="user-email" id="register-user-email" class="user-email box f-pr" placeholder="电子邮箱" minlength="5" required>
			<div class="u-error-tip f-dn">请填写正确邮箱地址</div>
		</div>
	        
	    {{-- 密码 --}}
		<div class="u-input-item">
			<input type="password" name="user-pwd" id="user-pwd" class="user-pwd box f-pr" placeholder="密码" minlength="6" maxlength="20" required>
			<div class="u-error-tip f-dn">请填写密码</div>
		</div>

		{{-- 重复密码 --}}
		<div class="u-input-item">
			<input type="password" name="user-re-pwd" id="user-re-pwd" class="user-re-pwd box f-pr" placeholder="确认密码" minlength="6" maxlength="20" required>
			<div class="u-error-tip f-dn">请填写确认密码</div>
		</div>
	        
	    {{-- 验证码 --}}
		<div class="u-input-item f-cb f-pr">
			<input type="text" class="box register-captcha" id="user-auth" name="captcha" minlength="4" maxlength="4" placeholder="验证码">
			<div class="u-error-tip f-dn">请填写验证码</div>
			<img src="{{ $auth_image }}" alt="验证码" class="captcha-img f-fr" title="请填写验证码">
		</div>
        
        {{-- 协议链接 --}}
		<a class="u-protocol-link f-tac f-db" target="_blank">使用条款协议</a>
        
        {{-- 提交按钮 --}}
        <input type="submit" class="u-register-submit" value="同意协议并注册">
	</form>
</div>

{{-- 登陆底部 --}}
<div class="register-ft">
	{{-- sns link --}}
	<div class="way-register-sns">
		<a href="##" class="weibo sns" target="_blank" title="通过微博登陆"></a>
		<a href="##" class="renren sns" target="_blank" title="通过人人登陆"></a>
	</div>
	{{-- 返回登陆链接 --}}
	<a href="/login" class="login-link f-fr">登陆</a>
</div>

@section("css")
    @parent
    {{HTML::style("/css/widget/register_form/register_form.css")}}
@stop