<?php
require_once "main/db_config.php";
include_once "main/MysqlQuery.php";
?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>应用limit子句实现分页显示</title>
	<link rel="stylesheet" type="text/css" href="static/mystyle.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
</head>
<!--<body oncontextmenu=self.event.returnValue=false>-->
<body>
<center>
	<table width="798" border="0" cellpadding="0" cellspacing="0">
		<tr>
			<td height="112" background="static/images/banner.jpg">&nbsp;</td>
		</tr>
		<tr>
			<td>
				<table width="100%" height="38" border="0" cellpadding="0" cellspacing="0" background="static/images/link.jpg">
					<tr>
						<td width="193" align="center" valign="middle">
							<b id="date"><?php echo date("Y-m-d"); ?></b></td>
						<td width="101" align="center" valign="middle"><a id="homepage" href="index.php" class="a">浏览目录</a></td>
						<td width="102" align="center" valign="middle"><a href="#">添加图书</a></td>
						<td width="101" align="center" valign="middle"><a id="search" href="search.php">简单查询</a></td>
						<td width="101" align="center" valign="middle"><a href="#">高级查询</a></td>
						<td width="101" align="center" valign="middle"><a href="#">分组统计</a></td>
						<td width="99" align="center" valign="middle"><a href="login.php">退出系统</a></td>
					</tr>
				</table>
			</td>
		</tr>
	</table>