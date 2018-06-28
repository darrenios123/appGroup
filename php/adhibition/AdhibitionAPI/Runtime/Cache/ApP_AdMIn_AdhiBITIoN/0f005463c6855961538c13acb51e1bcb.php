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
					<?php if(($type == 1)): ?><a href="">服务器应用添加</a>
					<form action="" method="POST">
						<br>
						<br>
						<div class="info">
						<p>应用名&nbsp;&nbsp;&nbsp;&nbsp;：<input type="text" placeholder="例如：速阅"></p>
						<br>
						<p>真实URL：<input type="text" placeholder="例如：http://www.baidu.com"></p>
						<br>
						<p>URL&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;：<input type="text" placeholder="例如：http://www.false_baidu.com"></p>
						<br>
						<a href="#">提交</a>
						<a href="index.html">返回</a>
					</form>
					<?php else: ?>
					<a href="">云服务器应用添加</a>
					<form action="<?php echo U('ApP_AdMIn_AdhiBITIoN/Applist/addapps');?>" method="POST">
						<br>
						<br>
						<p>应用名&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;：<input type="text" name="appName" value=""></p>
						<br>
						<p>表名&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;：<input type="text" name="Class_name" value=""></p>
						<br>
						<p>app Id&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;：<input type="text" name="appId" value=""></p>
						<br>
						<p>app Key&nbsp;&nbsp;&nbsp;&nbsp;：<input type="text" name="appKey" value=""></p>
						<br>
						<p>masterKey：<input type="text" name="masterKey" value=""></p>
						<br>
						<p>object Id&nbsp;&nbsp;&nbsp;：<input type="text" name="objectId" value=""></p>
						<br>
						<p>URL字段名&nbsp;：<input type="text" name="urlname" value=""></p>
						<br>
						<p>URL&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;：<input type="text" name="urlString" value=""></p>
						<br>
						<input class="sx" type="reset" value="重置">
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<input class="submit" type="submit" value="提交">

					</form><?php endif; ?>
					<div style="color:red;margin-left:450"><?php echo ($data["error"]); ?></div>
				</div>
			</div>
		</section>

</body></html>