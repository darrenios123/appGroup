<?php
namespace FApi\Controller;
use Think\Controller;
class FdownloadController extends Controller {
	/*
	*	下载接口
	*	请求方式 get
	* 	@param 文件id-fid 类型int 设备号-did 类型string
	*   return json
	*   	成功：{"code":"1","msg":"下载成功"}
	*   	失败：{"code":"-1","msg":"下载失败,失败原因"}
	 */
	public function Download(){
		try
 		{	
                  $fid = $_GET['fid'];//获取文件存在数据库的唯一的id。需要IOS那边带过来
                  $Model = M('fiction_info');
                  $res = $Model->where("id = '%s'",$fid)->field('file_path')->find();
                  if($res){
                        $dow_file_path = $res['file_path'];

                  	$http = new \Org\Net\Http;//实例化tp的下载类
                  	$upload_file = C('UPLOAD_FILE');//写在配置文件中的文件上传路径'UPLOAD_FILE' => '/var/www/html/obsec/Public/Uploads/', //上传文件路径
                  	$filename = $upload_file.$dow_file_path; //下载文件的绝对路径

                  	$Model_h = M('download_history');//下载成功。插下载记录表
                  	$time = time();
                  	$arr = array('fid'=>$fid,'download_time'=>$time,'device_id'=>$_GET['did']);
                  	$flag = $Model_h->add($arr);
                  	if($flag){
                  		$result = array('code'=>'1','msg'=>"下载成功");
                  		$http->download($filename, $dow_file_path);   //执行下载
                  	}else{
                  		$result = array('code'=>'-1','msg'=>"系统异常！");
                  	}
                  }else{
                  	$result = array('code'=>'-1','msg'=>"下载失败，文件不存在！");
                  }
            
 		}
		//捕获异常
		catch(Exception $e)
 		{
			$result = array('code'=>'-1','msg'=>"系统异常！");
 		}
 		echo json_encode($result);
            // dump($result);      
    }
}