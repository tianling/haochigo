<?php

/*
	商业用户表，继承用户总表
	表结构：(b_uid, uid, email, realname, mobile, identity_id, address, email_passed, mobile_passed)
 */
use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class BUser extends Eloquent implements UserInterface, RemindableInterface{

    use UserTrait, RemindableTrait;

    protected $table = 'business_user';

    protected $primaryKey = 'b_uid';

    public $timestamps = false;

}