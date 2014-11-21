<?php
/*
**Author:tianling
**createTime:14-11-19 下午4:07
**geohash操作
*/

class Geohash extends Eloquent{
    protected $table = 'shop_geohash';

    public $timestamps = false;

    protected $primaryKey = 'shop_id';

    public function shop()
    {
        return $this->belongsTo('Shop','shop_id','id');
    }


    /*
     **设置和生成店铺坐标对应geohash信息
     */
    public function geohashSet($x,$y,$shop_id = null,$b_uid = null){

        if(!$this->coordCheck($x,$y)){
            return array(
                'status'=>'error',
                'msg'=>'坐标格式不合法'
            );
        }

        $geohash = App::make('GeohashClass');//引入geohash扩展库

        $hash = $geohash->encode($x, $y);//生成geohash字符串

        //判断，若geohash地址记录已存在，则修改为新信息，否则生成新记录
        $hashData = $this->find($shop_id);
        if(!empty($hashData)){

            $hashData->x = $x;
            $hashData->y = $y;
            $hashData->geohash = $hash;
            $hashData->update_time = time();

            if($hashData->save()){
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

        }else{
            if(!is_int($shop_id) || !is_int($b_uid)){
                return array(
                    'status'=>'error',
                    'msg'=>'用户id或者商铺id格式不合法'
                );
            }

            $this->shop_id = $shop_id;
            $this->b_uid = $b_uid;
            $this->x = $x;
            $this->y = $y;
            $this->geohash = $hash;
            $this->update_time = time();
        }

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


    /*
     **根据坐标对geohash进行查询，查询对应范围内的商铺
     */
    public function geohashGet($x,$y){

        if(!$this->coordCheck($x,$y)){
            return array(
                'status'=>'error',
                'msg'=>'坐标格式不合法'
            );
        }

        $geohash = App::make('GeohashClass');//引入geohash扩展库

        $hash = $geohash->encode($x,$y);
        //取前缀，前缀约长范围越小
        $prefix = substr($hash, 0, 6);

        //取出相邻8个区域
        $neighbors = $geohash->neighbors($prefix);
        array_push($neighbors, $prefix);

        $shopArray = array();
        $i = 0;

        //分别按八个区域的geohash前缀，去查询对应的shop
        foreach($neighbors as $value){
            $shopData = $this->where('geohash','like',$value.'%')->get();
            $dataArray = $shopData->toArray();
            if(empty($dataArray)){
                continue;
            }

            foreach($shopData as  $data){
                $shopArray[$i]['geohash'] = $data->toArray();
                $shopArray[$i]['shopData'] = $data->shop->toArray();
                $i++;
            }

        }

        return array(
            'status'=>'ok',
            'msg'=>'查询成功',
            'data'=>$shopArray
        );

    }


    /*
     **坐标数据格式验证
     */
    private function coordCheck($x,$y){
        if(!is_numeric($x) || !is_numeric($y)){
            return false;
        }else{
            return true;
        }
    }

}