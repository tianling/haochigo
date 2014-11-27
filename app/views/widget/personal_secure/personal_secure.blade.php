<div class="content-header">
    <h2>安全设置</h2>
</div>
<div class="content-inner">
    <div class="alert">
        饿了么已经开放在线支付功能，将通过手机和邮箱作为你的安全保障。为了保障你的账户安全，请及时完成绑定操作。
    </div>

    <p class="gray-box">
        <span class="bold">安全等级：</span>
        <a class="user-safety-level low" href="/profile/security" title="绑定邮箱和手机后可以进行在线支付">
            低
        </a>
    </p>

    <table class="security-settings-wrapper">
        <colgroup>
            <col width="130">
            <col>
            <col width="110">
        </colgroup>

        <tbody>
        <tr><th>手机验证 <i class="icon-impt"></i></th>
            <td>
                <div class="info">
                    <p>绑定手机即可使用在线支付功能，省去找零麻烦，餐厅优先配送。</p>
                </div>
            </td>
            <td><a class="btn" href="/profile/bindmobile">绑定手机</a> </td>

        </tr>
        <tr>

            <th>邮箱激活 <i class="icon-impt"></i></th>
            <td><div class="info"><p>wssgcg****@qq.com尚未激活，请去邮箱查看激活邮件</p></div></td>
            <td>
                <a href="/profile/sendac">重发激活邮件</a><br>
                <a href="/profile/bindemail">更换邮箱</a>
            </td>


        </tr>

        <tr>

            <th>支付额度 <i class="icon-check"></i></th>
            <td>
                <div class="info">
                    <p class="limit">50 元</p>
                    <p class="sub-info">如果当日在线订餐金额超出支付额度，手机验证后才可以付款。</p>
                </div>
            </td>
            <td><a href="/profile/modify_payment_quota_step1">更改额度</a></td>

        </tr>

        </tbody>
    </table>
</div>
@section("css")
    @parent
    {{HTML::style("/css/widget/personal_secure/personal_secure.css")}}
@stop