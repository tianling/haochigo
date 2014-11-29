<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class FrontUser extends Eloquent implements UserInterface, RemindableInterface{

    use UserTrait, RemindableTrait;

    protected $table = 'front_user';

    protected $primaryKey = 'front_uid';//重定义主键名

    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo('User','uid','uid');
    }

    public function icon(){
        return $this->hasMany('FrontUserIcon','front_uid','front_uid');
    }

    public function collectShop(){
    	return $this->hasMany('CollectShop', 'uid', 'front_uid');
    }

    public function collectMenu(){
    	return $this->hasMany('collectMenu');
    }
}




?>