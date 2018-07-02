<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>应用后台登录</title>
		 <link rel="stylesheet" type="text/css" href="/Public/Css/style.css"/> 
	</head>
	<body id="show0">
		<section>
			<div class="top">应用后台管理系统</div>
			<div class="login">
			<form action="<?php echo U('ApP_AdMIn_AdhiBITIoN/Login/doUserLogin');?>" method="POST">
				<input type="text" id="username" name="username" value="" placeholder="用户名" /><br />
				<input type="password" id="password" name="password" value="" placeholder="密码" /><br />
				<input type="submit" id="login" value="登陆" />
				<div style="color:red"><?php echo ($data); ?></div>
			</form>
			</div>
			<div class="zz"></div>
		</section>
	</body>
</html>