<?php

/**
 */
class HomeController extends BaseController {

	public function test(){

		$minutes = 123;
		Cache::put('key', 'value', $minutes);
		echo Cache::get('key');
		/*
		$redis = Redis::connection();
		$redis->set('name', 'Taylor');
		$name = $redis->get('name');
		echo $name;
		//Cache::put('key', 'value', $minutes);
		*/
	}
}
