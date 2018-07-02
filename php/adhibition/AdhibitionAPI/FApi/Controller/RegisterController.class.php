<?php
namespace FApi\Controller;
use Think\Controller;
class RegisterController extends Controller {
	/*
	*	用户注册接口
	*	请求方式 post
	* 	@param 用户名-username or 邮箱-email or 手机号-mobile  类型string
	*   @param 密 码-password
	*   return json
	*   	成功：{"code":"1","msg":"注册成功","data":""}
	*   	失败：{"code":"-1","msg":"注册失败,失败原因"}
	*   签名：	暂时没使用==========================================================		
	*   	ksort($_POST);
	*		$_POST['sign'] = urldecode(http_build_query($_POST, '', '&', PHP_QUERY_RFC3986) ).'fj432%&$#@($&';
	 */
	public function Register(){
		//接收客户端发来的sign签名
    	//$sign = md5(trim($_POST['sign'])) ? md5(trim($_POST['sign'])) : "";//sign
        $strjson = file_get_contents("php://input");
        $arrios = json_decode($strjson,1);
		try
 		{
 			//验证sign签名
        	// $slat = 'fj432%&$#@($&';  //这个要保密只给接口调用方   盐
        	// $params = $_POST;
        	// unset($params['sign']);
        	// ksort($params);

        	// $str = urldecode(http_build_query($params, '', '&', PHP_QUERY_RFC3986) ).$slat;

        	// $calcsign = md5($str);
        	//if($calcsign != $sign){
        		//$result = array('code'=>'-1','msg'=>"签名不对",'data'=>[]);
        	//}else{
        		$Model = M("fiction_user");

        		//用户名长度及特殊字符、邮箱正则、电话号正则不用管了。IOS那边处理
        		if(!empty($arrios['username'])){
        			$fiction_username = trim($arrios['username']) ? trim($arrios['username']) : "";	//用户名
        			// echo mb_strlen($fiction_username);
        			$flag = 1;	//加一个开关。如果用户名、手机号。邮箱都没输入的话不让注册
        		}else if(!empty($arrios['email'])){
        			$user_email = trim($arrios['email']) ? trim($arrios['email']) : "";				//邮箱	
        			$flag = 1;	
        		}else if(!empty($arrios['mobile'])){
        			$user_mobile = trim($arrios['mobile']) ? trim($arrios['mobile']) : "";			//手机
        			$flag = 1;
        		}else{
        			$result = array('code'=>'-1','msg'=>"注册失败，请输入正确的用户名、邮箱或手机号！");
        		}

                if(!empty($arrios['password'])){
                    $flag2 = 2;
                    $user_password = md5(trim($arrios['password'])) ? md5(trim($arrios['password'])) : "";//密码
                }else{
                    $result = array('code'=>'-1','msg'=>"注册失败，密码不能为空！");
                }

                if(!empty($arrios['uuid'])){
                    $flag3 = 3;
                    $uuid = trim($arrios['uuid']) ? trim($arrios['uuid']) : "";//密码
                }else{
                    $result = array('code'=>'-1','msg'=>"注册失败，请携带设备号！");
                }

        		if($flag && $flag2 && $flag3){	//检测开关。查看用户是否输入用户名、手机号、邮箱
        			$data = $Model->field('id')->where("fiction_username='{$fiction_username}' or user_email='{$user_email}' or user_mobile='{$user_mobile}'")->find();
        			if(empty($data)){	//检测是否已经注册过了
        				$time = time();
        				$arr = array('fiction_username'=>$fiction_username,'user_email'=>$user_email,'user_mobile'=>$user_mobile,'user_password'=>$user_password,'creation_time'=>$time,'uuid'=>$uuid);
        				$resu = $Model->add($arr);
        				if($resu){
                            //生成token，存储，并返回给client, 以后的接口请求带着token即可
                            $sessionId = session_id().'/'.$resu;
                            $redis = new \Redis();
                            $redis->connect('localhost',6379);
                            $auth = $redis->auth('eric-@%F');//redis改为你的redis密码

                            $redis->set($sessionId,'1');
                            $redis->expire($sessionId,6000);  //5分钟的过期时间

                            $data['token'] = $sessionId;

                            $result = array('code'=>'1','msg'=>"注册成功",'data'=>$data);
        				}else{
                            $result = array('code'=>'-1','msg'=>"注册失败，系统错误");
                        }
        			}else{
        				$result = array('code'=>'-1','msg'=>"注册失败，用户已存在！");
        			}
        		}
        	//} 			
 		}
		//捕获异常
		catch(Exception $e)
 		{
			$result = array('code'=>'-1','msg'=>"系统异常！");
 		}

 		echo json_encode($result);
        // dump($result); 
        
    }
}
