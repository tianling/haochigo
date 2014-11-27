
<div class="content-header">
    <h2>修改手机号码</h2>
</div>
<div class="content-inner">
    <div class="alert">
        为了保障你的账户安全，请及时绑定手机。
    </div>
    <form class="form-horizontal" method="post">
        <div class="control-group clear-fix">
            <label class="control-label" for=""><span class="required">*</span>原手机号:</label>
            <div class="controls">
                <input id="oriPhone" name="ori_phone" type="text">
            </div><!--end input-->
        </div><!--end clearfix-->

        <div class="control-group">
            <label class="control-label" for=""><span class="required">*</span>绑定新手机号:</label>
            <div class="controls">
                <input id="newPhone" name="new_phone" type="text">
            </div><!--end input-->
        </div><!--end clearfix-->

        <div class="form-actions">
            <button type="button" id="sendVerifyCode" class="btn btn-yellow">发送验证码</button>
        </div>
    </form>
    <form class="form-horizontal" method="post">
        <div class="control-group clear-fix">
            <label class="control-label" for=""><span class="required">*</span>手机验证码:</label>
            <div class="controls">
                <input id="verifyPhone" name="verify_phone" type="text">
            </div><!--end input-->
        </div><!--end clearfix-->

        <div class="form-actions">
            <button type="submit" class="btn btn-yellow" id="verifyBtn">验证</button>
        </div>
    </form>
</div>







@section("css")
    @parent
    {{HTML::style("/css/widget/personal_change_phone/personal_change_phone.css")}}
@stop