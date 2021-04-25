<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>应用limit子句实现分页显示</title>
	<link rel="stylesheet" type="text/css" href="site/static/mystyle.css">
    <link type="image/x-icon" href="https://www.yiichina.com/favicon.ico?v=1528501659" rel="shortcut icon">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
</head>
<!--<body oncontextmenu=self.event.returnValue=false>-->
<body>
<center>
	<table width="798" border="0" cellpadding="0" cellspacing="0">
		<tr>
			<td height="112" background="site/static/images/banner.jpg">&nbsp;</td>
		</tr>
		<tr>
			<td>
				<table width="100%" height="38" border="0" cellpadding="0" cellspacing="0" background="site/static/images/link.jpg">
					<tr>
						<td width="193" align="center" valign="middle">
							<b id="date"><?php echo date("Y-m-d"); ?></b></td>
						<td width="101" align="center" valign="middle"><a id="homepage" href="index.php" class="a">浏览目录</a></td>
						<td width="102" align="center" valign="middle"><a href="?action=update">添加图书</a></td>
						<td width="101" align="center" valign="middle"><a href="?action=orderList">我的订单</a></td>
						<td width="101" align="center" valign="middle"><a href="?action=bookshelf">我的书架</a></td>
						<td width="101" align="center" valign="middle"><a href="?action=profile">Profile</a></td>
						<td width="99" align="center" valign="middle"><a href="?action=login" id="profile">登录系统</a></td>
					</tr>
				</table>
			</td>
		</tr>
	</table>