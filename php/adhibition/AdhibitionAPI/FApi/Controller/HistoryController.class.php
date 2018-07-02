<?php
namespace FApi\Controller;
use Think\Controller;
class HistoryController extends Controller {
	/*
	*	PHP调试IOS接口记录
	*	
	 */
	public function History(){
		$ip = $_SERVER['REMOTE_ADDR'];
		date_default_timezone_set('PRC');
		$time = date("Y-m-d H:i:s",time());
		$url = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'];

		$strjson = file_get_contents("php://input");

		$arr = array('ip'=>$ip,'time'=>$time,'url'=>$url,'ios_data'=>$strjson,'return_data'=>$result);
      	$Model = M('history');
      	$Model->add($arr);
    }
    public function Historylist(){
		$Model = M('historys');
      	$data = $Model->order("time desc")->select();

      	foreach ($data as $key => $value) {
      		 $res = json_decode($value['ios_data'],1);
      		 if($res['language'] == "zh-Hans-CN"){
      		 	$res['language'] = "简体中文";
      		 }else if($res['language'] == "en-CN"){
      		 	$res['language'] = "英文";
      		 }else if($res['language'] == "zh-Hant-CN"){
      		 	$res['language'] = "繁体中文";
      		 }else if($res['language'] == "zh-Hant-TW"){
      		 	$res['language'] = "中国台湾";
      		 }else if($res['language'] == "zh-Hant-HK"){
      		 	$res['language'] = "中国香港";
      		 }else if($res['language'] == "zh-Hant-MO"){
      		 	$res['language'] = "中国澳门";
      		 }

      		 $return_url = json_decode($value['return_data'],1);
      		 $res['return_url'] = $return_url['data']['url'];
      		 $Model2 = M('app_details');
      		 $res['app_name'] = $Model2->field('app_name')->where("id={$res['aname']}")->find();

      		$str = substr($value['time'],5);
      		$str = substr($str,0,11);
      		$res['time'] = $str;
      		$data[$key]['ios_data'] = $res;

      	}

      	$this->assign('data',$data);
      	$this->display("History/history");
    }

}

