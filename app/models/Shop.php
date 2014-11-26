<?php
/*     
	店铺表     
	表结构：(id, name, user, addtime, intro, linkname, linktel, tel, address, area_id, area_all_id, least_price,
			dispatch_price, state, pic, pic_small, ticket, hits, menu_num, pinyin, pinjian, sold_num, weixin, pay_method)  
*/
class Shop extends Eloquent{

	public $timestamps = false;

	protected $table = 'shop';

    public function geohash()
    {
        return $this->hasOne('Geohash','id','shop_id');
    }

    public function menus(){
    	return $this->hasMany('Menu', 'shop_id', 'id');
    }

    public function comments(){
    	return $this->hasManyThrough('CommentMenu', 'Menu', 'shop_id', 'menu_id');
    }

    public function groups(){
        return $this->hasMany('MenuGroup', 'shop_id', 'id');
    }    

}