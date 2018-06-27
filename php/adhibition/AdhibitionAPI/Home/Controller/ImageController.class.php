<?php
namespace Home\Controller;
use Think\Controller;
class ImageController extends Controller {
	/*
	*	图片加载接口
	 */
	public function Image(){
        if($_GET['imgpath']){
            $imagepath = $_GET['imgpath'];
        }
        $this->assign('imgpath',$imagepath);
		$this->display("Image/Image");
    }

}

