<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<title>用户协议列表页</title>
	<meta charset="utf-8">
	<style type="text/css">
		*{
			padding: 0;
			margin: 0;
			background: rgb(235,235,235);
			background-image: url('/Public/Image/2.gif');
			text-decoration: none;
		}
		.body{
			width:100%;
			height:100%;
		}
		.header{
			height:50px;
			text-align:center;
			font:bold small-caps 30px '楷体';
			margin-top:25px; 
		}
		.bottom{
			margin-top:50px;
			margin-left:80px;
		}
		.prolist{
			margin:30px;
			font: small-caps 16px '楷体';
			color:#000;
		}
	</style>
</head>
<body>
	<div class="body">
	<div style="text-align:center;margin-top:50px"><img src="/Public/Image/user.jpg" width="100" height="100"></div>
		<div class="header">
			用户隐私协议
			<br/>
			User Privacy Policy
		</div>
		<div class="bottom">
			<div class="list">
				<a href="<?php echo U('Home/Policy/Policys/type/1');?>"><div class="prolist"><span style="color:red">*&nbsp;&nbsp;&nbsp;</span>用户隐私协议<br><span>　　User Privacy Policy</span></div></a>
				<a href="<?php echo U('Home/Policy/Policys/type/2');?>"><div class="prolist"><span style="color:red">*&nbsp;&nbsp;&nbsp;</span>用户服务协议<br><span>　　User Service Policy</span></div></a></a>
				<a href="<?php echo U('Home/Policy/Policys/type/3');?>"><div class="prolist"><span style="color:red">*&nbsp;&nbsp;&nbsp;</span>应用使用条款<br><span>　　APP Use Clause</span></div></a>
			</div>
		</div>
	</div>
</body>
</html>