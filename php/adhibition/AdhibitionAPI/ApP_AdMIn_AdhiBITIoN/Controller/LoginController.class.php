<?php
namespace ApP_AdMIn_AdhiBITIoN\Controller;
use Think\Controller;
class LoginController extends Controller {
	/*
	*	用户后台登录功能
	*	请求方式 post
	* 	@param 用户名-username
	*   @param 密 码-password
	*   return 
	 */
	public function UserLogin(){
		$this->display("login");      
    }

    //执行用户登录
	public function doUserLogin(){

		$admin_username = $_POST['username'] ? $_POST['username'] : "";	//用户名
		$admin_password = md5(trim($_POST['password'])) ? md5(trim($_POST['password'])) : "";//密码

		$Model = M("admin_users");
		$data = $Model->where("admin_username='{$admin_username}' && admin_password='{$admin_password}'")->find();

		if($data){
			session('username',$admin_username);
			$this->redirect('ApP_AdMIn_AdhiBITIoN/Applist/applists');
		}else{
			$this->assign("data","请输入正确的用户名或密码!");
			$this->display("login");
		}
        
    }
}

