<?php

/**
 * 订单表
 *
 */
 
 class Order extends Eloquent{
 	
 	public $timestamps = false;

	protected $table = 'order';

	protected $primaryKey = 'id';

	protected $fillable = array('shop_id', 'front_user_id', 'ordertime', 'total', 'order_menus', 'total_pay', 'dispatch', 'beta', 'receive_address');
 }
