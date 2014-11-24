<div class="content_header">
    <h2>管理我的地址</h2>
</div>
<div class="content_inner">
    <h3>已经保存的送餐地址</h3>

    <table class="address-table table table-bordered">
        <thead>
            <tr>
                <th class="col-address">地址</th>
                <th>手机号码</th>
                <th>备选电话</th>
                <th class="col_action">操作</th>
            </tr>
        </thead>
        <tbody>
        @foreach($deliver_address['sites'] as $key=>$value)
            <tr>
                <td>{{$value['address_details']}}</td>
                <td>{{$value['deliver_phone']}}</td>
                <td>{{$value['spare_phone']}}</td>
                @if($value['address_state'] == 0)
                <td><span>默认地址</span>  | <a href="{{$value["edit_address"]}}">编辑</a> | <a href="{{$value["delete_address"]}}">删除</a></td>
                @else
                <td><span><a href="{{$value['set_default']}}">设为默认地址</a></span> | <a href="{{$value["edit_address"]}}">编辑</a> | <a href="{{$value["delete_address"]}}">删除</a></td>
                @endif
            </tr>
        @endforeach
        </tbody>

    </table>

    <h3>新增/编辑送餐地址</h3>


    {{ Form::open(array('url' => 'foo/bar', "method" => "post", "id" => "order_form")) }}
         <div class="form_block">
            <label for="address_details"><span class="required_mark">*</span>详细地址</label>
            <input type="text" class="input_box" id="address_details" name="address_details" value="{{$deliver_address['form_address_details']}}"/>
            <span class="error_box">请填写订单地址</span>
            <p>（请填写真实详细的送餐地址）</p>
        </div>
        <div class="form_block">
            <label for="deliver_phone"><span class="required_mark">*</span>手机号码</label>
            <input type="text" class="input_box" name="deliver_phone" id="deliver_phone" value="{{$deliver_address['form_deliver_phone']}}" />
            <span class="error_box"> 请填写手机号</span>
            <p>（请保证外卖员能打通该号码）</p>
        </div>
        <div class="form_block">
            <label for="spare_phone">备用电话</label>
            <input type="text" class="input_box" name="spare_phone" id="spare_phone" value="{{$deliver_address['form_deliver_spare_phone']}}" />
            <p>（备用电话方便外卖员能联系到您）</p>
        </div>
        <div class="form_block form_submit">
            <input type="submit" name="submit" class="btn btn-yellow" value="保存"/>
        </div>
    {{ Form::close() }}


</div>

@section("css")
    @parent
    {{HTML::style("/css/widget/personal_my_site/personal_my_site.css")}}
@stop