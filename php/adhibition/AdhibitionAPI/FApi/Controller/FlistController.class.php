<?php
namespace FApi\Controller;
use Think\Controller;

class FlistController extends Controller {
      /*
      *     小说列表接口
      *     请求方式 get
      *     @param ttype-按时间分类   1、3、5分钟
      *     @param ltype-按语言分类   1=中文 2=英文 3= 中英文 4=英中文
      *   return json
      *     成功： {"code":"1","msg":"小说列表","data":"小说列表数据"}   
      *     失败： {"code":"-1","msg":"系统异常","data":""}     
       */
      public function Fictionlist(){
            if($_GET['ttype'] == 1){  //根据URL ttype参数获取小说分类
                  $ttype = 1;
            }else if($_GET['ttype'] == 2){
                  $ttype = 2;
            }else if($_GET['ttype'] == 3){
                  $ttype = 3;
            }else{
                  $ttype = 1;
            }

            if($_GET['ltype'] == 1){  //根据URL ltype参数获取小说语言分类
                  $ltype = 1;
            }else if($_GET['ltype'] == 2){
                  $ltype = 2;
            }else if($_GET['ltype'] == 3){
                  $ltype = 3;
            }else if($_GET['ltype'] == 4){
                  $ltype = 4;
            }else{
                  $ltype = 2;
            }

            try
            {     
                  $Model = M('time_type');
                  $data = $Model->field("id")->where("id={$ttype}")->find();
                  $Model2 = M('fiction_info');
                  $data2 = $Model2->field("id,fiction_title,text_size,grade")->where("time_type_id='{$data['id']}' && lang_type='{$ltype}'")->select();
                  $data['res'] = $data2;

                  $result = array('code'=>'1','msg'=>"小说列表！",'data'=>$data);
            }
            //捕获异常
            catch(Exception $e)
            {
                  $result = array('code'=>'-1','msg'=>"系统异常！");
            }
            // dump($result);
            echo json_encode($result);
    }
}
