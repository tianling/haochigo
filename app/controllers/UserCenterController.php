<?php
/*
**Author:tianling
**createTime:14-11-29 上午12:14
*/
class UserCenterController extends BaseController{

    /**
     * 个人中心主页
     **/
    public function index(){

    }


    /**
     * 用户头像上传
     **/
    public function portraitUpload(){

        $file = Input::file('photo');

        if($file && $file->isValid()) {
            $filename = $file->getClientOriginalName();//获取初始文件名

            //获取文件类型并进行验证
            $filetype = $file->getMimeType();
            $typeArray = explode('/', $filetype, 2);
            if($typeArray['0'] != 'image'){
                echo json_encode(array(
                    'status'=>'400',
                    'msg'=>'文件格式或类型违法!'
                ));
                exit();
            }
            $typeName =  $file->getClientOriginalExtension();

            $newFileName = $this->fileNameMake($filename,$typeName);

            $fileSave = $file -> move(app_path().'/storage/uploads',$newFileName);
            if($fileSave){
                
            }

        }

    }


    /**
     * 生成服务器端存储的新文件名
     **/
    private function fileNameMake($fileName,$fileType){
        $string = '';
        $strPol = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz";

        $max = strlen($strPol)-1;
        $length = strlen($fileName);
        for($i=0;$i<$length;$i++){
            $string.=$strPol[rand(0,$max)];//rand($min,$max)生成介于min和max两个数之间的一个随机整数
        }

        $newFileName = md5($fileName.time().$string).'.'.$fileType;

        return $newFileName;

    }
}