<?php

/**
 * 主页
 */
class MainController extends BaseController {

    /**
     * 取消收藏商品
     *
     * 测试完成
     *
     * 对应API：API/shop/取消收藏商品
     * @return [type] [description]
     */
    public function cancelMenu(){
    	if( !Auth::check() ){
			return Redirect::to('http://weibo.com');
		}

		$user = Auth::user();
		$rules = array(
			'uid'   => 'required | integer',
			'goods_id' => 'required | integer'
		);
		$new_collect = array(
			'uid' => $user->front_uid,
			'goods_id'  => Input::get('goods_id')
		);
		$v = Validator::make($new_collect, $rules);
		if( $v->fails() ){
			return Redirect::to('http://baidu.com');

			return Redirect::to('error')
				->with('user', Auth::user())
				->withErrors($v)
				->withInput();
		}

		if( CollectMenu::where('menu_id', Input::get('goods_id'))->where('user_id', $user->front_uid)->delete() ){
			$output = array();
			$output['success'] = 'true';
			$output['state'] = 200;
			$output['nextSrc'] = '';
			$output['errMsg'] = '';
			$output['no'] = 0;
			Response::json($output);
		}
    }
}