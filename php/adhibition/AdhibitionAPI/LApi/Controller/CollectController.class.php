<?php
namespace LApi\Controller;
use Think\Controller;
class CollectController extends Controller {
	/*
	*	本地应用收藏页接口
	*	请求方式 get
	* 	@param  cid-收藏ID列表id。以,号分割
	*   return json
	*   	成功：
	*   	失败：  
	 */
    public function Collect(){
      if($_GET['cid']){
        $cid = $_GET['cid'];
      }else{
        $cid = '';
      }
    try
 		{
    	//获取收藏页数据
        $Model = M("lshop");
        if($cid){
          $shop_data = $Model->field("id,shop_name,shop_img,activity_detail")->order("create_time desc")->select($cid);
          $result = array('code'=>'1','msg'=>"请求成功！",'data'=>$shop_data); 

        }else{
          $result = array('code'=>'-1','msg'=>"请求成功，您还没有收藏！");
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

