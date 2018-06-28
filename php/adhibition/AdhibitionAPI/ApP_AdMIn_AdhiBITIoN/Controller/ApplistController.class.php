<?php
namespace ApP_AdMIn_AdhiBITIoN\Controller;
require_once "/var/www/html/adhibition/ThinkPHP/Library/Vendor/leancloud/testlen/src/autoload.php";
use LeanCloud\Client;
use LeanCloud\Object;
use LeanCloud\Query;
use Think\Controller;
class ApplistController extends Controller {
	/*
	*	后台应用列表
	 */
	// public function applist(){
	// 	$this->display("applist");    
 //    }

    //通过URL地址获取类型。并判断展示服务器应用还是云服务器应用
	public function applists(){
		if(empty($_SESSION['username'])){
			$this->redirect("ApP_AdMIn_AdhiBITIoN/Login/UserLogin");
		}
		$type = $_GET['type'] ? $_GET['type'] : "1";

		if($type == '1'){
			$Model = M("app_details");
			$data = $Model->select();
		}else{
			$Model = M("cloud_server");
			$data = $Model->select();
		}
		$this->assign('type',$type);
		$this->assign('data',$data);
		$this->display("Applist/applist");
    }

    //后台添加页面展示
    public function adda(){
    	if(empty($_SESSION['username'])){
			$this->redirect("ApP_AdMIn_AdhiBITIoN/Login/UserLogin");
		}
    	$type = $_GET['type'];
    	$this->assign('type',$type);
    	$this->display();
    }


    //后台添加应用展示
    public function addapps(){
    	if(empty($_SESSION['username'])){
			$this->redirect("ApP_AdMIn_AdhiBITIoN/Login/UserLogin");
		}
    	if(!empty($_POST['Class_name'])){
    		$flag1 = 1;
    		$Class_name = $_POST['Class_name'];
    	}else{
    		$data['error'] = "请输入Class_name";
    	}
    	if(!empty($_POST['appId'])){
    		$flag2 = 2;
    		$appId = $_POST['appId'];
    	}else{
    		$data['error'] = "请输入appId";
    	}
    	if(!empty($_POST['appKey'])){
    		$flag3 = 3;
    		$appKey = $_POST['appKey'];
    	}else{
    		$data['error'] = "请输入appKey";
    	}
    	if(!empty($_POST['masterKey'])){
    		$flag4 = 4;
    		$masterKey = $_POST['masterKey'];
    	}else{
    		$data['error'] = "请输入masterKey";
    	}
    	if(!empty($_POST['objectId'])){
    		$flag5 = 5;
    		$objectId = $_POST['objectId'];
    	}else{
    		$data['error'] = "请输入objectId";
    	}
    	if(!empty($_POST['appName'])){
    		$flag6 = 6;
    		$appName = $_POST['appName'];
    	}else{
    		$data['error'] = "请输入应用名";
    	}
    	if(!empty($_POST['urlString'])){
    		$flag7 = 7;
    		$urlString = $_POST['urlString'];
    	}else{
    		$data['error'] = "请输入url";
    	}
    	if(!empty($_POST['urlname'])){
    		$flag8 = 8;
    		$urlname = $_POST['urlname'];
    	}else{
    		$data['error'] = "请输入url对应的leancloud字段名";
    	}


    	if($flag1 && $flag2 && $flag3 && $flag4 && $flag5 && $flag6 && $flag7 && $flag8){
  	    	$Model = M("cloud_server");
  	    	$time = time();
	    	$arr = array("Class_name"=>$Class_name,"appId"=>$appId,"appKey"=>$appKey,"masterKey"=>$masterKey,"serverUrl"=>$serverUrl,"objectId"=>$objectId,"appName"=>$appName,"urlString"=>$urlString,"pageView"=>$pageView,"create_time"=>$time,"update_time"=>$time,"urlname"=>$urlname);
	    	$res = $Model->add($arr);

	    	if($res){
	    		$data['error'] = "添加成功！";
	    		$this->redirect("ApP_AdMIn_AdhiBITIoN/Applist/applists");
	    	}else{
	    		$data['error'] = "系统错误，请联系开发技术人员！";
	    	}
    	}
    	$this->assign('data',$data);
		$this->display('adda');

    }

    //后台修改页面展示
    public function updatea(){
    	if(empty($_SESSION['username'])){
			$this->redirect("ApP_AdMIn_AdhiBITIoN/Login/UserLogin");
		}
    	$type = $_GET['type'];
    	$id = $_GET['id'];
    	if($type == 1){
    		$Model = M('app_details');
    		$data = $Model->where("id={$id}")->find();
    	}else{
    		$Model = M('cloud_server');
    		$data = $Model->where("id={$id}")->find();
    	}
    	$this->assign('data',$data);
    	$this->assign('type',$type);
    	$this->assign('id',$id);
    	$this->display("Updatea/updatea"); 
    }

    //后台修改应用
    public function updateapp(){
    	if(empty($_SESSION['username'])){
			$this->redirect("ApP_AdMIn_AdhiBITIoN/Login/UserLogin");
		}
    	$type = $_POST['type'];
    	$hid = $_POST['hid'];
    	if($type == 1){
    		$Model = M("app_details");
    		$time = time();
    		$url = $_POST['url'];
    		$arr = array('true_url'=>$url,"update_time"=>$time);
    		$Model->where("id={$hid}")->save($arr);

    	}else{
    		$Model = M("cloud_server");
    		$time = time();
    		// $appName = $_POST['appName'];
    		$urlString = $_POST['urlString'];
    		$arr = array("urlString"=>$urlString,"update_time"=>$time);
    		$flag = $Model->where("id={$hid}")->save($arr);

    		if($flag){
    			$data = $Model->where("id={$hid}")->find();
    			// 参数依次为 App0Id, AppKey, MasterKey
				Client::initialize("{$data['appId']}", "{$data['appKey']}", "{$data['masterKey']}");
				Client::setServerUrl("https://ocbaipfz.api.lncld.net");
				$testObject = new Object("{$data['Class_name']}");

				// 更新数据
				// Query::doCloudquery("update {$data['Class_name']} set appName='{$appName}' where objectId='{$data['objectId']}'");
				Query::doCloudquery("update {$data['Class_name']} set {$data['urlname']}='{$urlString}' where objectId='{$data['objectId']}'");

    		}
    	}
    	$this->redirect("ApP_AdMIn_AdhiBITIoN/Applist/applists");
    }
}