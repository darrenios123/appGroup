<?php
namespace SApi\Controller;
use Think\Controller;
class WorldcupController extends Controller {
	/*
	*	世界杯列表接口
	*	请求方式 get
	*   @param 
	*   return json
	*   	成功：
	*   	失败：  
	 */
    public function Worldcup(){
    	try
 		{   
      $Model = M('world_cup');
      $data = $Model->field('one_team,competition_time,schedule,score,two_team,news')->select();
      if($data){
          $result = array('code'=>'1','msg'=>"获取世界杯列表成功！",'data'=>$data);
      }else{
          $result = array('code'=>'-1','msg'=>"获取世界杯列表失败，没有相关数据！");
      }
		}
		//捕获异常
		catch(Exception $e)
 		{
			$result = array('code'=>'-1','msg'=>"系统异常！");
 		}
 		//调试==============
		// $ip = $_SERVER['REMOTE_ADDR'];
  //       date_default_timezone_set('PRC');
  //       $time = date("Y-m-d H:i:s",time());
  //       $url = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'];

  //       $arr = array('ip'=>$ip,'time'=>$time,'url'=>$url,'ios_data'=>$limit,'return_data'=>json_encode($result));
  //       $Model2 = M('history');
  //       $Model2->add($arr);
		echo json_encode($result);	
        // dump($result);	
    }

} 




