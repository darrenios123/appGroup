<?php
namespace ApP_AdMIn_AdhiBITIoN\Controller;
use Think\Controller;
class UploadsController extends Controller {
	/*
	*	自己用的上传类
	 */
	public function Upload(){
		$this->display();      
    }

    //执行用户登录
	public function doUpload(){
		$upload = new \Think\Upload();                  // 实例化上传Model类
		$upload->maxSize = '3145728';                   // 设置文件上传大小  单位：字节
		$upload->exts = array('txt');  					// 设置文件上传类型、后缀名
		$upload->rootPath = '/var/www/html/adhibition/Public/Uploads/';   			// 设置文件上传目录   
		//注意：需要手动创建，并修改权限为777。不然会报上传根目录不存在！请尝试手动创建
		$upload->savePath = '';                        // 设置文件上传（子）目录

		// 上传文件 执行上传
		$info = $upload->upload(); 

		if(!$info) {// 上传错误提示错误信息
		    $this->error($upload->getError());
		}else{// 上传成功
			$Model = M("fiction_info");
			$filenames = explode('.',$info['files']['name']);
			$fiction_title = $filenames[0];
			$file_path = $info['files']['savepath'].$info['files']['savename'];
			$path2 = '/var/www/html/adhibition/Public/Uploads/'.$file_path;

			$str = file_get_contents($path2);//将整个文件内容读入到一个字符串中
			$str = str_replace("\r\n","<br />",$str);
			if($_POST['lang'] == 1){
				$text_size = mb_strlen($str);
			}else if($_POST['lang'] == 2){
				$text_size = str_word_count($str,1);
				$text_size = count($text_size);
			}else if($_POST['lang'] == 3){
				$text_size = mb_strlen($str);
			}else{
				$text_size = str_word_count($str,1);
				$text_size = count($text_size);
			}

			if($text_size < 500){
				$time_type_id = 1;
			}else if($text_size >= 500 && $text_size < 1200){
				$time_type_id = 2;
			}else{
				$time_type_id = 3;
			}
			$arr = array("fiction_title"=>$fiction_title,'file_path'=>$file_path,"time_type_id"=>$time_type_id,"text_size"=>$text_size,"lang_type"=>$_POST['lang']);
			$Model->add($arr);
		    $this->success('上传成功！');
		}
        
    }
}