<?php
/*
**Author:tianling
**createTime:14-11-29 上午12:14
*/
class UserCenterController extends BaseController{

    private $uid;

    /**
     * 个人中心主页
     **/
    public function index(){
        $this->uid = Auth::user()->front_uid;

        $userData = FrontUser::find($this->uid);


        if($userData->nickname == ''){
            $userName = md5($userData->mobile);
        }else{
            $userName = $userData->nickname;
        }
        $data['personal']['user_name'] = $userName;

        if($userData->icon != ''){
            $icon = $userData->icon->icon_url;
        }else{
            $icon = '';
        }
        $data['personal']['user_image'] = $icon;

        if($userData->email_passed == 1){
            $data['personal']['user_level'] = 1;
        }else{
            $data['personal']['user_level'] = 3;
        }

        $data['personal']['user_balance'] = $userData->balance;

        $data['personal']['charge'] = '';

        $data['personal']['score'] = $userData->integral;

        $data['personal']['user_collect']['restaurant'] = $userData->collectShop->count();

        $data['personal']['user_collect']['cate'] = $userData->collectMenu->count();

        //查询该用户当月订单数据
        $now = time();
        $a_month_ago = $now-3600*24*30;//一个月之前的时间点
        $orderData = Order::where('front_user_id','=',$this->uid)->where('ordertime','<=',$now)
            ->where('ordertime','>=',$a_month_ago)->get();

        $orderNum = $orderData->count();
        $data['personal']['user_order'] = $orderNum;

        $data['personal']['recent_order'] = array();
        $i = 0;
        if(!empty($orderData)){
            foreach($orderData as $value){
                $data['personal']['recent_order'][$i]['order_number'] = $value->id;
                $data['personal']['recent_order'][$i]['order_time'] = $value->ordertime;
                $data['personal']['recent_order'][$i]['order_restaurant'] = $value->shop->name;

                $menuArray = explode(',',$value->order_menus);
                $menu = '';
                foreach($menuArray as $key){

                    $menu .= Menu::find($key)->title.',';
                }
                $data['personal']['recent_order'][$i]['order_details'] = $menu;

                $data['personal']['recent_order'][$i]['order_state'] = $this->orderStatusCheck($value->status);
                $i++;
            }
        }

        $data['personal']['recent_deal'] = array();

        $data['sidebar'] = $this->sideBar();

        $data['userbar']['url'] = $this->userBar();


        return View::make("template.personal.personal_center")->with($data);


    }


    /**
     * 最近一个月订单信息页面
     */
    public function recentMonth(){
        $this->uid = Auth::user()->front_uid;

        //查询该用户当月订单数据
        $now = time();
        $a_month_ago = $now-3600*24*30;//一个月之前的时间点
        $orderData = Order::where('front_user_id','=',$this->uid)->where('ordertime','<=',$now)
            ->where('ordertime','>=',$a_month_ago)->get();

        $orderNum = $orderData->count();

        $data['recent_month']['deal_count'] = $orderNum;

        $i = 0;
        foreach($orderData as $value){
            $data['recent_month']['deal'][$i] = array(
                'shop_id'=>$value->shop_id,
                'shop_name'=>$value->shop->name,
                'deal_id'=>$value->id,
                'deal_statue'=>$value->status,
                'deal_is_retrun'=>0,//订单退款设置功能暂未开发
                'deal_return'=>'',
                'deal_is_pre'=>0,//删除该数据
                'deal_pre_time'=>$value->arrivetime,
                'deal_again'=>'',
                'deal_number'=>$value->id,
                'deal_phone'=>$value->shop->linktel,
                'deal_time'=>$value->ordertime,
                'deliver_address'=>$value->receive_address,
                'deliver_phone'=>$value->receive_phone,
                'deliver_remark'=>$value->beta,
                'deal_speed '=>0,
                'deal_satisfied'=>0,

            );

            $menuArray = explode(',',$value->order_menus);
            $menu = array();
            $menuAmount = 0;
            foreach($menuArray as $key){

                $menu = Menu::find($key);
                $data['recent_month']['deal'][$i]['good'][] = array(
                    'goods_id'=>$menu->id,
                    'goods_name'=>$menu->title,
                    'goods_value'=>$menu->price,
                    'goods_amount'=>1,
                    'goods_total'=>$menu->price,
                    'good_atisfied'=>''
                );
                $menuAmount += $menu->price;
            }

            $data['recent_month']['deal'][$i]['others'][] = array(
                'item_name'=>'配送费',
                'item_value'=>$value->dispatch,
                'item_amount'=>1,
                'item_total'=>$value->dispatch,
            );

            $data['recent_month']['deal'][$i]['order_state'] = $this->orderStatusCheck($value->status);

            $data['recent_month']['deal'][$i]['total'] = $menuAmount + $value->dispatch;

            $i++;

        }

        $data['sidebar'] = $this->sideBar();

        $data['userbar']['url'] = $this->userBar();


        return View::make("template.personal.personal_recent_month")->with($data);


    }


    /**
     * 一个月前订单信息页面
     */
    public function afterMonth(){
        $this->uid = Auth::user()->front_uid;

        //查询该用户当月订单数据
        $now = time();
        $a_month_ago = $now-3600*24*30;//一个月之前的时间点
        $orderData = Order::where('front_user_id','=',$this->uid)->where('ordertime','<',$a_month_ago)->get();

        $orderNum = $orderData->count();

        $data['after_month']['deal_count'] = $orderNum;
        if($data['after_month']['deal_count'] == 0){
            $data['after_month']['deal'] = array();
        }

        $i = 0;
        foreach($orderData as $value){
            $data['after_month']['deal'][$i] = array(
                'shop_id'=>$value->shop_id,
                'shop_name'=>$value->shop->name,
                'deal_id'=>$value->id,
                'deal_statue'=>$value->status,
                'deal_is_retrun'=>0,//订单退款设置功能暂未开发
                'deal_return'=>'',
                'deal_is_pre'=>0,//删除该数据
                'deal_pre_time'=>$value->arrivetime,
                'deal_again'=>'',
                'deal_number'=>$value->id,
                'deal_phone'=>$value->shop->linktel,
                'deal_time'=>$value->ordertime,
                'deliver_address'=>$value->receive_address,
                'deliver_phone'=>$value->receive_phone,
                'deliver_remark'=>$value->beta,
                'deal_speed '=>0,
                'deal_satisfied'=>0,

            );

            $menuArray = explode(',',$value->order_menus);
            $menu = array();
            $menuAmount = 0;
            foreach($menuArray as $key){

                $menu = Menu::find($key);
                $data['after']['deal'][$i]['good'][] = array(
                    'goods_id'=>$menu->id,
                    'goods_name'=>$menu->title,
                    'goods_value'=>$menu->price,
                    'goods_amount'=>1,
                    'goods_total'=>$menu->price,
                    'good_atisfied'=>''
                );
                $menuAmount += $menu->price;
            }

            $data['after_month']['deal'][$i]['others'][] = array(
                'item_name'=>'配送费',
                'item_value'=>$value->dispatch,
                'item_amount'=>1,
                'item_total'=>$value->dispatch,
            );

            $data['after_month']['deal'][$i]['order_state'] = $this->orderStatusCheck($value->status);

            $data['after_month']['deal'][$i]['total'] = $menuAmount + $value->dispatch;

            $i++;

        }

        $data['sidebar'] = $this->sideBar();

        $data['userbar']['url'] = $this->userBar();

        return View::make("template.personal.personal_after_month")->with($data);

    }


    /*
     * 收藏的商家页面
     **/
    public function shopCollect(){
        $this->uid = Auth::user()->front_uid;

        $shopData = FrontUser::find($this->uid)->collectShop;

        $data["shops"]["now_area"] = "重庆";

        $data["shops"]["now_shop_count"] = $shopData->count();

        $data["shops"]["other_shop_count"] = 0;

        $i = 0;
        foreach($shopData as $value){
            $data["shops"]['now_place'][$i] = array(
                'shop_id'=>$value->shop_id,
                'shop_name'=>$value->shop->name,
                'shop_logo'=>$value->shop->pic,
                'shop_url'=>url('shop/'.$value->shop_id),
                'shop_type'=>$value->shop->type,
                'shop_level'=>'',
                'deliver_time'=>$value->shop->operation_time,
                'shop_statue'=>$value->shop->is_online,
                'goods_count'=>0

            );

            $i++;

        }

        $data["shops"]['other_place'] = array();

        $data['sidebar'] = $this->sideBar();

        $data['userbar']['url'] = $this->userBar();

        return View::make("template.personal.personal_collection_shop")->with($data);


    }


    /**
     * 收藏美食页面
     **/
    public function menuCollect(){
        $this->uid = Auth::user()->front_uid;

        $menuData = FrontUser::find($this->uid)->collectMenu;

        $data['good_count'] = $menuData->count();

        $data['goods'] = array();

        $i = 0;
        foreach($menuData as $value){
            $data['goods'][$i] = array(
                'good_id'=>$value->menu_id,
                'good_name'=>$value->menu->title,
                'shop_name'=>$value->menu->shop->name,
                'shop_id'=>$value->menu->shop->id,
                'shop_href'=>url('shop/'.$value->menu->shop->id),
                'order_href'=>'#',
                'good_price'=>$value->menu->price,
                'delete_good'=>url('cancelmenu'),
                'shop_hot'=>''

            );

            $i++;

        }

        $data['sidebar'] = $this->sideBar();

        $data['userbar']['url'] = $this->userBar();

        return View::make("template.personal.personal_collection_goods")->with($data);


    }


    /**
     * 用户头像上传
     **/
    public function portraitUpload(){

        $file = Input::file('photo');

        if($file && $file->isValid()) {
            $filename = $file->getClientOriginalName();//获取初始文件名

            //获取文件类型并进行验证
            $filetype = $file->getMimeType();
            $typeArray = explode('/', $filetype, 2);
            if($typeArray['0'] != 'image'){
                echo json_encode(array(
                    'status'=>'400',
                    'msg'=>'文件格式或类型违法!'
                ));
                exit();
            }
            $typeName =  $file->getClientOriginalExtension();//获取文件后缀名
            $uid = Auth::user()->front_uid;

            $newFileName = $this->fileNameMake($filename,$typeName);
            $directoryName = $uid%100;//根据用户id和100的模值，生成对应存储目录地址
            $savePath = public_path().'/uploads/frontUser/'.$directoryName.'/photo';

            $fileSave = $file -> move($savePath,$newFileName);

            if($fileSave){
                $Icon = new FrontUserIcon();
                $Icon->front_uid = $uid;
                $Icon->icon_url = asset('uploads/frontUser/'.$directoryName.'/photo/'.$newFileName);
                $Icon->update_time = time();

                if($Icon->save()){
                    echo json_encode(array(
                        'status'=>'200',
                        'msg'=>'upload finished'
                    ));

                }else{
                    echo json_encode(array(
                        'status'=>'400',
                        'msg'=>'save failed'
                    ));
                }

            }else{
                echo json_encode(array(
                    'status'=>'400',
                    'msg'=>'move failed'
                ));
            }

        }else{
            echo json_encode(array(
                'status'=>'400',
                'msg'=>'invalid file'
            ));
        }

    }


    /**
     * 生成服务器端存储的新文件名
     **/
    private function fileNameMake($fileName,$fileType){
        $string = '';
        $strPol = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz";

        $max = strlen($strPol)-1;
        $length = strlen($fileName);
        for($i=0;$i<$length;$i++){
            $string.=$strPol[rand(0,$max)];//rand($min,$max)生成介于min和max两个数之间的一个随机整数
        }

        $newFileName = md5($fileName.time().$string).'.'.$fileType;

        return $newFileName;

    }



    /**
     * 获取订单状态描述
     **/
    private function orderStatusCheck($status){
        switch($status){
            case 0:
                return '等待付款';
            case 1:
                return '等待配送';
            case 2:
                return '订单已完成';
            case 3:
                return '订单已取消';
        }
    }


    private function sideBar(){
        return array(
            "personal_center" => url("usercenter"),  // 个人中心的地址
            "personal_recent_month" => url("usercenter/recent_month"), // 最近一个月的地址
            "personal_after_month" => url("usercenter/after_month") , // 一个月之前
            "personal_uncomment" => "#" ,  // 未点评的订单
            "personal_return" => "#",     // 退单中的订单
            "personal_collection_shop" => url("usercenter/collect_shop"),// 我收藏的餐厅的地址
            "personal_collection_goods" => url("usercenter/collect_menu"), // 我收藏的商品的地址
            "personal_my_site" => url("personal_my_site") ,  // 我的地址
            "personal_change_password" => url("personal_change_password"), // 修改密码
            "personal_secure"=> url("personal_secure"),        // 安全设置
            "personal_details" => "#"       // 收支明细
        );
    }


    private function userBar(){
        return array(
            "my_place" => "这里是地址",
            "switch_palce" => "##",
            "logo" => "123" ,                         // 网站主页地址
            "mobile" => "123",                 // 跳转到下载手机APP的地址
            "my_ticket" => "123",                 // 我的饿单的地址
            "my_gift"  => "123",                // 礼品中心地址
            "feedback" => "123",                // 反馈留言地址
            "shop_chart" => "123",                // 购物车地址
            "user_mail" => "123",                // 用户提醒的地址
            "personal" => "123",                // 个人中心地址
            "my_collection" => "123",               // 我的收藏地址
            "my_secure" => "123",              // 安全设置的地址
            "loginout" => url("logout"),              // 退出登录的地址
            "switch_place" => "123"                  // 切换当前地址的地址
        );
    }
}