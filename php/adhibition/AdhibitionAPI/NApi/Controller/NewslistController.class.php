<?php
namespace NApi\Controller;
use Think\Controller;
class NewslistController extends Controller {
	/*
	*	新闻列表接口
	*	请求方式 get
	* 	@param    limit 页数
	*   return json
	*   	成功：
	*   	失败：  
	 */
    public function Newslist(){
    	try
 		{   
            if($_GET['limit']){
                $limit = ($_GET['limit']-1)*30;
            }else{
                $limit = '0';
            }
            $Model = M("news_lists");
            $news_data = $Model->limit("{$limit},30")->field("title,date,thumbnail_pic_s,url,category")->order("date desc")->select();
            $data = array("data"=>$news_data);
            $result = array('code'=>'1','msg'=>"获取新闻列表成功","result"=>$data);

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



