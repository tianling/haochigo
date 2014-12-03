<?php
/*
**Author:tianling
**createTime:14-11-29 下午11:57
**前台用户头像model
*/
class FrontUserIcon extends Eloquent{

    protected $table = 'front_user_icon';

    protected $primaryKey = 'id';

    public $timestamps = false;

    public function frontUser(){
        return $this->belongsTo('FrontUser','front_uid','front_uid');
    }


}