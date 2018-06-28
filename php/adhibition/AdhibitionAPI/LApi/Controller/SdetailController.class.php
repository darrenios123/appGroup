<?php
namespace LApi\Controller;
use Think\Controller;
class SdetailController extends Controller {
	/*
	*	本地应用店铺详情页接口
	*	请求方式 get
	* 	@param sid-店铺id
	*   return json
	*   	成功：
	*   	失败：  
	 */
    public function Sdetail(){
      if($_GET['sid']){
        $sid = $_GET['sid'];
      }else{
        $sid = "";
      }
    try
 		{
    	//活动详情页
      if($sid){
        $Model = M("lshop");
        $shop_data = $Model->field("shop_name,shop_img,shop_address,shop_phone,activity_detail,create_time,location")->where("id={$sid}")->find();

        $result = array('code'=>'1','msg'=>"请求成功！",'data'=>$shop_data);
      }else{
        $result = array('code'=>'-1','msg'=>"请求失败，请传id！");
      }

		}
		//捕获异常
		catch(Exception $e)
 		{
			$result = array('code'=>'-1','msg'=>"系统异常！");
 		}
 		//调试==============
 		    // $ip = $_SERVER['REMOTE_ADDR'];
       //      date_default_timezone_set('PRC');
       //      $time = date("Y-m-d H:i:s",time());
       //      $url = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'];

       //      $arr = array('time'=>$time,'url'=>$url,'ios_data'=>$sid,'return_data'=>json_encode($result));
       //      $Model = M('history');
       //      $Model->add($arr);
        //=================end
 		echo json_encode($result);	
    // dump($result); 	
    }

}

