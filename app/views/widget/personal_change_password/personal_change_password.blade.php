<div class="content-header">
    <h2>修改密码</h2>
</div>
<div class="content-inner">
    <div class="alert">
        这里是提示语...........
    </div>
    <form class="form-horizontal" method="post">
        <div class="control-group clear-fix">
            <label class="control-label" for=""><span class="required">*</span>原密码:</label>
            <div class="controls">
                <input id="oriPwd" name="original_password" type="text" required>
            </div><!--end input-->
        </div><!--end clearfix-->

        <div class="control-group">
            <label class="control-label" for=""><span class="required">*</span>新密码:</label>
            <div class="controls">
                <input id="newPwd" name="new_password" type="text" required>
            </div><!--end input-->
        </div><!--end clearfix-->

        <div class="control-group clear-fix">
            <label class="control-label" for=""><span class="required">*</span>验证密码:</label>
            <div class="controls">
                <input id="verifyPwd" name="verify_password" type="text" required>
            </div><!--end input-->
        </div><!--end clearfix-->

        <div class="form-actions">
            <button type="submit" class="btn btn-yellow" id="changePwd">修改密码</button>
        </div>
    </form>
</div>
@section("css")
    @parent
    {{HTML::style("/css/widget/personal_change_password/personal_change_password.css")}}
@stop