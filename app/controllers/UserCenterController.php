<?php
/*
**Author:tianling
**createTime:14-11-29 上午12:14
*/
class UserCenterController extends BaseController{

    private $uid;

    /**
     * 个人中心主页
     **/
    public function index(){
        $this->uid = Auth::user()->front_uid;

        

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
            $typeName =  $file->getClientOriginalExtension();//获取文件后缀名
            $uid = Auth::user()->front_uid;

            $newFileName = $this->fileNameMake($filename,$typeName);
            $directoryName = $uid%100;//根据用户id和100的模值，生成对应存储目录地址
            $savePath = public_path().'/uploads/frontUser/'.$directoryName.'/photo';

            $fileSave = $file -> move($savePath,$newFileName);

            if($fileSave){
                $Icon = new FrontUserIcon();
                $Icon->front_uid = $uid;
                $Icon->icon_url = asset('uploads/frontUser/'.$directoryName.'/photo/'.$newFileName);
                $Icon->update_time = time();

                if($Icon->save()){
                    echo json_encode(array(
                        'status'=>'200',
                        'msg'=>'upload finished'
                    ));

                }else{
                    echo json_encode(array(
                        'status'=>'400',
                        'msg'=>'save failed'
                    ));
                }

            }else{
                echo json_encode(array(
                    'status'=>'400',
                    'msg'=>'move failed'
                ));
            }

        }else{
            echo json_encode(array(
                'status'=>'400',
                'msg'=>'invalid file'
            ));
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