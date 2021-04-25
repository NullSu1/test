
<table width="798" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td height="48" background="site/static/images/bottom.jpg">&nbsp;</td>
	</tr>
</table>
</center>
</body>
<script type="text/javascript" src="site/static/javascript.js"></script>
<script>
    function logChange(){
        var myName = '<?= $_SESSION['user']; ?>';
        if(myName != '')
            $("#profile").html("退出登录("+ myName +")");
    }
    logChange()
</script>
</html>
