<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>应用列表页</title>
		<link rel="stylesheet" type="text/css" href="/Public/Css/style.css"/>
	</head>
	<body>
		<header>
<!-- 			<div class="right">
				<a href="#">修改密码</a>
				<a href="#">退出</a>
			</div> -->
		</header>
		<section class="content">
			<!--左侧列表内容-->
			<div class="left">
				<div class="title">应用后台管理系统</div>
				<?php if(($type == 1)): ?><a class="active" href="<?php echo U('ApP_AdMIn_AdhiBITIoN/Applist/applists/type/1');?>"><h3>服务器应用</h3></a>
				<a href="<?php echo U('ApP_AdMIn_AdhiBITIoN/Applist/applists/type/2');?>"><h3>云服务器应用</h3></a>
				<?php else: ?>
				<a href="<?php echo U('ApP_AdMIn_AdhiBITIoN/Applist/applists/type/1');?>"><h3>服务器应用</h3></a>
				<a class="active" href="<?php echo U('ApP_AdMIn_AdhiBITIoN/Applist/applists/type/2');?>"><h3>云服务器应用</h3></a><?php endif; ?>
			</div>
			<!--右侧功能内容-->
			<div class="right">
				<div class="ctn">
					<!--功能切换页-->
					<?php if(($type == 1)): ?><a href="###">本地应用列表</a>
					<table class="altrowstable" id="alternatecolor">
						<tr>
						    <th>应用名</th><th>URL</th>
						    <!-- <th>URL</th><th>添加时间</th><th>修改时间</th> -->
						    <th>操作</th>
						</tr>
						<?php if(is_array($data)): foreach($data as $key=>$res): ?><tr>
						    <td class="name"><?php echo ($res["app_name"]); ?></td>
						    <td class="url"><?php echo ($res["true_url"]); ?></td>
						    <td class="cz"><a href="<?php echo U('ApP_AdMIn_AdhiBITIoN/Applist/updatea/type/1/',array('id' => $res['id']));?>">修改</a></td>
						</tr><?php endforeach; endif; ?>
					<?php else: ?>
					<a href="<?php echo U('ApP_AdMIn_AdhiBITIoN/Applist/adda/type/2');?>">添加云服务器应用</a>
					<table class="altrowstable" id="alternatecolor">
						<tr>
						    <th>应用名</th><th>URL</th><th>操作</th>
						</tr>
						<?php if(is_array($data)): foreach($data as $key=>$res): ?><tr>
						    <td class="name"><?php echo ($res["appName"]); ?></td>
						    <td class="url"><?php echo ($res["urlString"]); ?></td>
						    <td class="cz"><a href="<?php echo U('ApP_AdMIn_AdhiBITIoN/Applist/updatea/type/2/',array('id' => $res['id']));?>">修改</a></td>
						</tr><?php endforeach; endif; endif; ?>

					</table>
					<!-- <iframe src="<?php echo U('ApP_AdMIn_AdhiBITIoN/Applist/applists/type/2');?>" width="84%" height="1000px" frameborder="0" scrolling="no"></iframe> -->
				</div>
			</div>
		</section>
	</body>
</html>

<!-- 表格样式js -->
<script type="text/javascript">
function altRows(id){
    if(document.getElementsByTagName){  
        
        var table = document.getElementById(id);  
        var rows = table.getElementsByTagName("tr"); 
         
        for(i = 0; i < rows.length; i++){          
            if(i % 2 == 0){
                rows[i].className = "evenrowcolor";
            }else{
                rows[i].className = "oddrowcolor";
            }      
        }
    }
}

window.onload=function(){
    altRows('alternatecolor');
}
</script>