{{-- login form structrue --}}

<div class="login-hd f-cb">
	<h2 class="title f-fl">登陆</h2>

	<a href="javascript:void(0)" id="switch-mobile" class="switch login-mobile f-fr">手机验证码登录</a>
	<a href="javascript:void(0)" id="switch-normal" class="switch login-normal f-fr f-dn">使用普通方式登陆</a>

</div>

<div class="login-bd">
	{{-- 普通方式表单 --}}
	<form class="m-login" novalidate="true" id="login-form" method="post" action="<?php echo url("login");?>">

		{{-- 普通方式登陆 --}}
		<div class="way-login-normal js-normal-wapper">

			{{-- 用户名 --}}
			<div class="u-input-item" id="login-user-name">
				<input type="text" name="account" id="" class="user-name box f-pr" placeholder="电子邮箱" minlength="5" required>
				<div class="u-error-tip f-dn">请填写正确邮箱</div>
			</div>
	        
	        {{-- 密码 --}}
			<div class="u-input-item" id="login-user-pwd">
				<input type="password" name="user-name" id="" class="user-name box f-pr" placeholder="密码" minlength="6" maxlength="20" required>
				<div class="u-error-tip f-dn">请填写正确密码格式</div>
			</div>
	        
	        {{-- 验证码 --}}
			<div class="u-input-item f-cb f-pr" id="login-user-auth1">
				<input type="text" class="box login-captcha" name="captcha" minlength="4" id="" maxlength="4" placeholder="验证码">
				<div class="u-error-tip f-dn">请填写验证码</div>
				<img src="{{ $auth_image }}" alt="验证码" class="captcha-img f-fr" title="请填写验证码">
			</div>
		</div>

        {{-- 手机验证方式登陆 --}}
		<div class="way-login-mobile f-dn js-mobile-wapper">
			{{-- 电话号码 --}}
			<div class="u-input-item" id="login-user-mobile">
		        <input id="user-mobile" class="box" name="user-mobile" type="text" placeholder="手机号码" maxlength="13" required="">
		        <div class="u-error-tip f-dn" id="">请填写正确手机号码</div>
            </div>

            {{-- 验证码 --}}
            <div id="login-user-auth2" class="u-input-item">
		        <button id="sms-btn" type="button" class="sms-btn">发送验证码</button>
		        <input id="verify-code-input" class="box" name="code" type="text" placeholder="短信验证码"minlength="6" maxlength="6" autocomplete="off" required="" id="login-user-auth2">
		        <div class="u-error-tip f-dn">请填写验证码</div>
            </div>
		</div>
        
        <div class="u-helper">
        	{{-- 自动登陆 --}}
        	<label for="auto-login" class="label-auto">
        		<input type="checkbox" name="rember" id="auto-login" class="login-rember">
        		下次自动登陆
        	</label>
        	<a href="{{ $find_password }}" class="forget-link f-fr">忘记密码了?</a>
        </div>

        <input type="submit" class="u-login-submit" value="登陆">
	</form>
</div>

{{-- 登陆底部 --}}
<div class="login-ft">
	{{-- sns links --}}
	<div class="way-login-sns">
		<a href="##" class="weibo sns" target="_blank" title="通过微博登陆"></a>
		<a href="##" class="renren sns" target="_blank" title="通过人人登陆"></a>
	</div>
	<a href="/register" class="register-link f-fr">免费注册</a>
</div>

@section("css")
    @parent
    {{HTML::style("/css/widget/login_form/login_form.css")}}
@stop