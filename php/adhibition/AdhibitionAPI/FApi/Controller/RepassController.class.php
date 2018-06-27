<?php
namespace FApi\Controller;
use Think\Controller;
class RepassController extends Controller {
	/*
	*	用户修改密码功能接口
	*	请求方式 post
	* 	@param token--session_id()./.用户id		repass--新密码
	*   return json
	*   	成功：{"code":"1","msg":"修改成功","data":用户数据}
	*   	失败：{"code":"-1","msg":"修改失败，失败原因！"}
	 */
	public function Resetpass(){
		// $strjson = '{"token": "j78m68430ofdk7out3faft5gq7/18","password": "123456789"}';
		$strjson = file_get_contents("php://input");
		$arrios = json_decode($strjson,1);

		$token_arr = explode('/',$arrios['token']);
		$uid = $token_arr[1];

		$user_password = md5(trim($arrios['password'])) ? md5(trim($arrios['password'])) : "";//密码

// file_put_contents('/var/www/html/adhibition/AdhibitionAPI/FApi/Controller/1.txt', $str);
// file_put_contents('/var/www/html/adhibition/AdhibitionAPI/FApi/Controller/2.txt', $strjson);
		try
 		{
        	$Model = M("fiction_user");
			$data = $Model->field("id")->where("id={$uid}")->find();

			if($data){
				$arr = array("user_password"=>$user_password);
				$Model->where("id={$uid}")->save($arr);
				$result = array('code'=>'1','msg'=>"修改成功");
			}else{
				$result = array('code'=>'-1','msg'=>"修改失败，找不到用户，请尝试重新登录！");  
			}			
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

