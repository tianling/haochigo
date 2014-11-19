<?php
/*
**Author:tianling
**createTime:14-11-19 下午4:07
**geohash操作
*/

class Geohash extends Eloquent{
    protected $table = 'v_shop_geohash';

    public $timestamps = false;

    /*
     **设置和生成店铺坐标对应geohash信息
     */
    public function geohashSet($x,$y,$shop_id,$b_uid){
        $geohash = App::make('GeohashClass');

        $hash = $geohash->encode($x, $y);//生成geohash字符串

        $this->shop_id = $shop_id;
        $this->b_uid = $b_uid;
        $this->x = $x;
        $this->y = $y;
        $this->geohash = $hash;
        $this->add_time = time();

        if($this->save()){
            return array(
                'status'=>'ok',
                'msg'=>'店铺geohash设置成功'
            );
        }else{
            return array(
                'status'=>'error',
                'msg'=>'店铺geohash设置失败'
            );
        }

    }

}