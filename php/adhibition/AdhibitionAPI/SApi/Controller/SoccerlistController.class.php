<?php
namespace SApi\Controller;
use Think\Controller;
class SoccerlistController extends Controller {
	/*
	*	足球列表接口
	*	请求方式 get
	*   @param    limit 页数
	*   return json
	*   	成功：
	*   	失败：  
	 */
    //----------------------------------
    // 足球联赛调用
    // 在线接口文档：http://www.juhe.cn/docs/90
    //----------------------------------
    public function Soccerlist(){
    	try
 		{   
            if($_GET['sid']){
                $sid = $_GET['sid'];
            }else{
                $sid = 1;
            }
            $Model = M('shooter_list');
            $data = $Model->field("ranking,chinese_name,english_name,football_team,position,goals_for,penalty_num")->where("sid={$sid}")->select();
            if($data){
                $result = array('code'=>'1','msg'=>"获取射手榜列表成功！",'data'=>$data);
            }else{
                $result = array('code'=>'-1','msg'=>"获取射手榜列表失败，没有相关数据！");
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




