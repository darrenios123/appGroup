<?php
namespace LApi\Controller;
use Think\Controller;
class ActivityController extends Controller {
	/*
	*	本地应用活动页接口
	*	请求方式 get
	* 	@param  tid-分类id
	*   return json
	*   	成功：
	*   	失败：  
	 */
    public function Activity(){
      if($_GET['tid']){
        $tid = $_GET['tid'];
      }else{
        $tid = "";
      }
    try
 		{
    	//活动页顶部轮播图数据
        $Model = M("lshop");
        if(!$tid){
        //   $shop_data = $Model->field("id,shop_name,shop_img,activity_detail")->limit("3")->where("shop_type={$tid}")->order("create_time desc")->select();
        // }else{
          $shop_data = $Model->field("id,shop_name,shop_img,activity_detail")->limit("3")->order("create_time desc")->select();
        }

        //最新活动列表
        if($tid){
          $shop_data_list = $Model->field("id,shop_name,shop_img,activity_detail")->limit("100")->where("shop_type={$tid}")->order("create_time desc")->select();
          $res = array('headerImg'=>$shop_data_list);
        }else{
          $shop_data_list = $Model->field("id,shop_name,shop_img,activity_detail")->limit("3,100")->order("create_time desc")->select();
          $res = array('headerImg'=>$shop_data,'shopList'=>$shop_data_list);
        }
	    
        $result = array('code'=>'1','msg'=>"请求成功！",'data'=>$res); 

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

       //      $arr = array('ip'=>$ip,'time'=>$time,'url'=>$url,'ios_data'=>$strjson,'return_data'=>json_encode($result));
       //      $Model = M('history');
       //      $Model->add($arr);
        //=================end
 		echo json_encode($result);	
    // dump($result);	
    }

}

