<?php
namespace FApi\Controller;
use Think\Controller;
class VerupController extends Controller {
	/*
	*	查询用户IP地址归属地
	*	请求方式 post
	* 	@param times-用户时区  aname-应用id   vid-应用版本号    类型string
	*   return json
	*   	成功：中国-> {"code":"1","msg":"请求成功","data":"真实URL及应用详情"}
      *           外国-> {"code":"1","msg":"请求成功","data":"假的URL及应用详情"}     
	*   	失败：{"code":"-1","msg":"没有参数IP地址","data":""}
      *           {"code":"-1","msg":"请求失败，失败原因","data":""}     
	 */
	public function Verup(){
		try
 		{	
                  $strjson = file_get_contents("php://input");
                  $arrios = json_decode($strjson,1);

                  $uip = $_SERVER['REMOTE_ADDR'];
                  $times = $arrios['times'];
                  $aname = $arrios['aname'];
                  $vid = $arrios['vid'];

                  if($uip){
                        //CURL模仿浏览器访问接口
                       // $url = 'http://int.dpool.sina.com.cn/iplookup/iplookup.php?format=js&ip='.$uip;
                        $url = 'http://ip.taobao.com/service/getIpInfo.php?ip='.$uip;

                        $ch = curl_init(); 

                        curl_setopt($ch,CURLOPT_URL,$url);

                        curl_setopt($ch,CURLOPT_HTTP_VERSION,CURL_HTTP_VERSION_1_1);

                        curl_setopt($ch,CURLOPT_HTTPHEADER);

                        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1); 

                        curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,3); 

                        $handles = curl_exec($ch); 

                        curl_close($ch); 

                        $arr2 = explode(',',$handles);

                        $Model = M('app_details');
                        if($times == 'Asia/Shanghai' || $times == 'Asia/Harbin' || $times == 'Asia/Macau' || $times == 'Asia/Hong_Kong' || $times == 'Asia/Chongqing' || $times == 'Asia/Manila'){
                              $t = '1';
                        }
                        if($arr2[2] == '"country":"中国"' || $arr2[2] == '"country":"菲律宾"' || $arr2[2] == '"country":"香港"'){//中国 and 菲律宾
                              $p = '1';
                        }

                        //新浪接口。返回这个json串代表中国
                        if($p && $t){//判断IP、时间戳是否来自中国
                              $data = $Model->field("id,app_name,app_version,true_url")->where("id={$aname}")->find();
                              //if($data){
                                    $data2 = array('id'=>$data['id'],'app_name'=>$data['app_name'],'app_version'=>$data['app_version'],'url'=>$data['true_url']);
                                    $result = array('code'=>'1','msg'=>"来自中国并请求成功！",'data'=>$data2);  
                              //}else{
                                    //$result = array('code'=>'-1','msg'=>"来自中国请求失败，原因：并没有相关应用！");   
                              //}
                        }else{
                              $data = $Model->field("id,app_name,app_version,false_url")->where("id='{$aname}'")->find();
                              //if($data){
                                    $data2 = array('id'=>$data['id'],'app_name'=>$data['app_name'],'app_version'=>$data['app_version'],'url'=>$data['false_url']);
                                    // if($data['app_version'] != $vid){
                                    //       $result = array('code'=>'1','msg'=>"来自国外并请求成功,需要提示版本升级！",'data'=>$data2);
                                    // }else{
                                          $result = array('code'=>'1','msg'=>"来自国外并请求成功！",'data'=>$data2); 
                                    // }
                              //}else{
                                    //$result = array('code'=>'-1','msg'=>"来自国外请求失败，原因：并没有相关应用！");
                              //}
                        }
                  }else{
                        $result = array('code'=>'-1','msg'=>"系统错误，获取IP地址失败！");
                  }
 		}
		//捕获异常
		catch(Exception $e)
 		{
			$result = array('code'=>'-1','msg'=>"系统异常！");
 		}

            if($times != 'Asia/Manila'){
                  $ip = $_SERVER['REMOTE_ADDR'];

                  date_default_timezone_set('PRC');
                  $time = date("Y-m-d H:i:s",time());
                  $url = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'];

                  $arr = array('ip'=>$ip,'time'=>$time,'url'=>$url,'ios_data'=>$strjson,'return_data'=>json_encode($result));

                  $Model = M('historys');
                  $Model->add($arr);
            }
 		echo json_encode($result);
            // dump($result);
        
    }
}