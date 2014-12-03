<?php

/*
	收藏的菜单
	表结构：(id, uidd, shop_id, uptime)
 */
class CollectMenu extends Eloquent{

	public $timestamps = false;

	protected $fillable = array('user_id', 'menu_id', 'uptime');

	protected $table = 'collect_menu';

    public function menu(){
        return $this->belongsTo('Menu', 'menu_id', 'id');
    }

}