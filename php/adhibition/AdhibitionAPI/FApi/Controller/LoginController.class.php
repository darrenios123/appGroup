<?php
namespace FApi\Controller;
use Think\Controller;
class LoginController extends Controller {
	/*
	*	用户登录功能接口
	*	请求方式 post
	* 	@param 用户名-username or 邮箱-email or 手机号-mobile  类型string
	*   @param 密 码-password
	*   return json
	*   	成功：{"code":"1","msg":"登陆成功","data":用户数据}
	*   	失败：{"code":"-1","msg":"登陆失败，用户名或密码错误！"}
	*   签名：暂时没使用=============================================================			
	*   	ksort($_POST);
			$_POST['sign'] = urldecode(http_build_query($_POST, '', '&', PHP_QUERY_RFC3986) ).'fj432%&$#@($&';
	 */
	public function UserLogin(){
		$strjson = file_get_contents("php://input");
		$arrios = json_decode($strjson,1);

		$fiction_username = trim($arrios['username']) ? trim($arrios['username']) : "";	//用户名
		$user_email = trim($arrios['email']) ? trim($arrios['email']) : "";				//邮箱
		$user_mobile = trim($arrios['mobile']) ? trim($arrios['mobile']) : "";			//手机
		$user_password = md5(trim($arrios['password'])) ? md5(trim($arrios['password'])) : "";//密码

// file_put_contents('/var/www/html/adhibition/AdhibitionAPI/FApi/Controller/1.txt', $str);
// file_put_contents('/var/www/html/adhibition/AdhibitionAPI/FApi/Controller/2.txt', $strjson);

		//接收客户端发来的sign签名
    	//$sign = md5(trim($_POST['sign'])) ? md5(trim($_POST['sign'])) : "";//sign
		try
 		{
 			// //验证sign签名
    //     	$slat = 'fj432%&$#@($&';  //这个要保密只给接口调用方   盐
    //     	$params = $_POST;
    //     	unset($params['sign']);
    //     	ksort($params);

    //     	$str = urldecode(http_build_query($params, '', '&', PHP_QUERY_RFC3986) ).$slat;
    //     	$calcsign = md5($str);

        	// if($calcsign != $sign){
        	// 	$result = array('code'=>'-1','msg'=>"签名不对",'data'=>[]);
        	// }else{
        		$Model = M("fiction_user");
				$data = $Model->field("id,fiction_username,user_email,user_mobile")->where("fiction_username='{$fiction_username}' or user_email='{$user_email}' or user_mobile='{$user_mobile}' && user_password='{$user_password}'")->find();

				if($data){
					//生成token，存储，并返回给client, 以后的接口请求带着token即可
                	$sessionId = session_id().'/'.$data['id'];
                	$redis = new \Redis();
    				$redis->connect('localhost',6379);
   					$auth = $redis->auth('eric-@%F');//redis改为你的redis密码

        			$redis->set($sessionId,'1');
    				$redis->expire($sessionId,6000);  //5分钟的过期时间

                	$data['token'] = $sessionId;

					$result = array('code'=>'1','msg'=>"登陆成功",'data'=>$data);
				}else{
					$result = array('code'=>'-1','msg'=>"登陆失败，用户名或密码错误！");  
				}
        	//} 			
 		}
		//捕获异常
		catch(Exception $e)
 		{
			$result = array('code'=>'-1','msg'=>"系统异常！");
 		}
 		echo json_encode($result);
        
    }

}

