<?php
namespace LApi\Controller;
use Think\Controller;
class NdetailController extends Controller {
	/*
	*	本地应用新闻详情页接口
	*	请求方式 get
	* 	@param nid-新闻id
	*   return json
	*   	成功：
	*   	失败：  
	 */
    public function Ndetail(){
      if($_GET['nid']){
        $nid = $_GET['nid'];
      }else{
        $nid = "";
      }
    try
 		{
    	//新闻详情页
      if($nid){
        $Model = M("lnews");
        $news_data = $Model->field("news_title,news_img,news_detail,create_time")->where("id={$nid}")->find();

        //获取新闻浏览量并加一
        if($news_data){
          $news_pv = $Model->field("news_pv")->where("id={$nid}")->find();
          $news_pv = $news_pv['news_pv'] += 1;

          $pv_arr = array('news_pv'=>$news_pv);
          $Model->where("id={$nid}")->save($pv_arr);
          $result = array('code'=>'1','msg'=>"请求成功！",'data'=>$news_data);
        }else{
          $result = array('code'=>'-1','msg'=>"请求失败，没有相关新闻");
        }
      }else{
        $result = array('code'=>'-1','msg'=>"请求失败，请传新闻id！");
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

       //      $arr = array('ip'=>$ip,'time'=>$time,'url'=>$url,'ios_data'=>$strjson,'return_data'=>json_encode($result));
       //      $Model = M('history');
       //      $Model->add($arr);
        //=================end
 		echo json_encode($result);	
    // dump($result); 	
    }

}

