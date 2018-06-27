<?php
namespace LApi\Controller;
use Think\Controller;
class LindexController extends Controller {
	/*
	*	达生活首页接口
	*	请求方式 post
	* 	@param 
	*   return json
	*   	成功：
	*   	失败：
	 */
    public function Lindex(){
    	try
 		{
    	//首页顶部最新3长轮播图以及相关信息
        $Model = M("lshop");
        $shop_data = $Model->field("id,shop_name,shop_img")->limit("3")->order("create_time desc")->select();
        // dump($shop_data);

        //中间部分常用分类列表
        $Model2 = M("ltype");
        $shop_typedata = $Model2->field("id,life_type,type_img")->select();
        // dump($shop_typedata);
        
		//热门推荐店铺列表
		$shop_list = $Model->field("id,shop_name,shop_img")->limit("3,100")->order("create_time desc")->select();
		// dump($shop_list);
		$res = array("headerImg"=>$shop_data,"type_data"=>$shop_typedata,"shopList"=>$shop_list);
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

