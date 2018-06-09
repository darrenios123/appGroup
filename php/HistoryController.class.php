<?php
namespace FApi\Controller;
use Think\Controller;
class HistoryController extends Controller {
	/*
	====================	PHP调试IOS接口记录
	 */
	public function History(){
		$ip = $_SERVER['REMOTE_ADDR'];
		date_default_timezone_set('PRC');
		$time = date("Y-m-d H:i:s",time());
		$url = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'];
		// $strjson = '{"token": "j78m68430ofdk7out3faft5gq7/18","password": "123456789"}';
		$strjson = file_get_contents("php://input");
		$result = '123223432';

		$arr = array('ip'=>$ip,'time'=>$time,'url'=>$url,'ios_data'=>$strjson,'return_data'=>$result);
      	$Model = M('history');
      	$Model->add($arr);
    }
    public function Historylist(){
		$Model = M('history');
      	$data = $Model->order("time desc")->select();
      	dump($data);
    }

}

