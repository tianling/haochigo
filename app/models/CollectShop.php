<?php

/*
	收藏的菜单
	表结构：(id, uidd, shop_id, uptime)
 */
class CollectShop extends Eloquent{

	public $timestamps = false;

	protected $fillable = array('uid', 'shop_id', 'uptime');

	protected $table = 'collect_shop';


}