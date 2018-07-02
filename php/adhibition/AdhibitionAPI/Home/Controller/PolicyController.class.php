<?php
namespace Home\Controller;
use Think\Controller;
class PolicyController extends Controller {
	/*
	*	假链接跳转的协议页面
	 */
	public function Policy(){
		$this->display();
    }


    public function Policys(){
    	$type = $_GET['type'];
    	if($type == 1){
    		$this->display();
    	}else if($type == 2){
    		$this->display("Policy2");
    	}else{
    		$this->display("Policy3");
    	}
		
    }

}

