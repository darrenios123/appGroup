<?php
namespace LApi\Controller;
use Think\Controller;
class LnewsController extends Controller {
	/*
	*	本地应用新闻列表接口
	*	请求方式 get
	* 	@param 
	*   return json
	*   	成功：
	*   	失败：  
	 */
    public function Lnews(){
    	try
 		{
    	//首页顶部最新要闻3长轮播图以及相关信息
        $Model = M("lnews");
        $news_data = $Model->field("id,news_title,news_img")->limit("3")->order("create_time desc")->select();

        //新闻列表
        $news_data_list = $Model->field("id,news_title,news_detail,news_pv,news_img")->limit("3,100")->order("create_time desc")->select();
        foreach ($news_data_list as $key => $value){
            $news_data_list[$key]['news_detail'] = mb_substr($news_data_list[$key]['news_detail'], 0,40);
        }

		    $res = array('headerImg'=>$news_data,'newsList'=>$news_data_list);
        $result = array('code'=>'1','msg'=>"请求成功！",'data'=>$res); 
        // dump($result);
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
    // dump($result);
 		echo json_encode($result);		
    }

}

