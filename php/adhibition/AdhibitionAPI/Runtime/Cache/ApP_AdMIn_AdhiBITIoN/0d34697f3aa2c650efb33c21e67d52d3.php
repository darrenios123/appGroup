<?php if (!defined('THINK_PATH')) exit();?><html><head>
		<meta charset="UTF-8">
		<title></title>
		<link rel="stylesheet" type="text/css" href="/Public/Css/style.css">
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
					<?php if(($type == 1)): ?><a href="">服务器应用修改</a>
					<form action="<?php echo U('ApP_AdMIn_AdhiBITIoN/Applist/updateapp');?>" method="POST">
						<br>
						<br>
						<p>应用名：<input type="text" placeholder="<?php echo ($data["app_name"]); ?>" name="appname" disabled="disabled"></p>
						<br>
						<p>URL&nbsp;&nbsp;&nbsp;&nbsp;：<input type="text" placeholder="<?php echo ($data["true_url"]); ?>" name="url" value="<?php echo ($data["true_url"]); ?>"></p>
						<br>
						<input type="hidden" name="hid" value="<?php echo ($data["id"]); ?>">
						<input type="hidden" name="type" value="1">
						<input class="sx" type="reset" value="重置">
						<input class="sx" type="submit" value="修改">
					</form>
					<?php else: ?>
					<a href="">云服务器应用修改</a>
					<form action="<?php echo U('ApP_AdMIn_AdhiBITIoN/Applist/updateapp');?>" method="POST">
						<br>
						<br>
						<p>应用名 ：<input type="text" name="appName" value="<?php echo ($data["appName"]); ?>" placeholder="<?php echo ($data["appName"]); ?>" disabled="disabled"></p>
						<br>
						<p>URL&nbsp;&nbsp;&nbsp;&nbsp;：<input type="text" name="urlString" value="<?php echo ($data["urlString"]); ?>" placeholder="<?php echo ($data["urlString"]); ?>"></p>
						<br>
						<input type="hidden" name="hid" value="<?php echo ($data["id"]); ?>">
						<input type="hidden" name="type" value="2">
						<input class="sx" type="reset" value="重置">
						<input class="sx" type="submit" value="修改">
					</form><?php endif; ?>
				</div>
			</div>
		</section>

</body></html>