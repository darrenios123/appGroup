<?php
namespace SApi\Controller;
use Think\Controller;
class IntegrallistController extends Controller {
	/*
	*	足球积分列表接口
	*	请求方式 get
	*   @param   
	*   return json
	*   	成功：
	*   	失败：  
	 */
    //----------------------------------
    // 足球联赛调用
    // 在线接口文档：http://www.juhe.cn/docs/90
    //----------------------------------
    public function Integrallist(){
    	try
 		{   
            if($_GET['sid']){
                $sid = $_GET['sid'];
            }else{
                $sid = 1;
            }
            $Model = M('integral_list');
            $data = $Model->field("ranking,football_team,screening,victory,dogfall,defeated,goal,goals_against,goal_d,average_goal,average_a_goal,average_d,average_integral,integral")->where("sid={$sid}")->select();
            if($data){
                $result = array('code'=>'1','msg'=>"获取积分榜列表成功！",'data'=>$data);
            }else{
                $result = array('code'=>'-1','msg'=>"获取积分榜列表失败，没有相关数据！");
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




