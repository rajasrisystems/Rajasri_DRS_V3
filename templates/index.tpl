<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<title>Rajasri DRS</title>
	<meta http-equiv="X-UA-Compatible" content="IE=9" />
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
	<link rel="SHORTCUT ICON" href="img/rajasri.jpeg">
	<link rel="stylesheet" href="css/all.css">
</head>
<!--Design Prepared by Rajasri Systems-->   
<body>
{literal}
<script language="javascript" type="text/javascript">

function loginSubmit()
{
	var pass_val  = /[\W_]/;
	if(document.getElementById('username').value=='')
	{
		document.getElementById('errmsg').innerHTML='Please enter username';
		document.getElementById('username').focus();
		return false;
	}
	if(document.getElementById('password').value=='')
	{
		document.getElementById('errmsg').innerHTML='Please enter password';
		document.getElementById('password').focus();
		return false;
	}
	/*var pwd=document.getElementById('password');
	if(pass_val.test(pwd.value))
	{
		
		document.getElementById('errmsg').innerHTML = "Password must not contain special characters!";
		return false;
	}*/
	document.getElementById('hdAction').value=1;
}
</script>
{/literal}
<div id="main">
<div class="logo"><a href="http://www.rajasri.net/"><img src="img/rajasri.jpeg" alt="" style="width:50px; height:50px;"/></a></div>
<div style="clear:both;"></div>
<div id="login-panel">
		<div id="center-column"> 
			<div class="top-bar">
				<h1>LOGIN</h1>
			</div><br />
			<form name="login" id="login" method="post" onsubmit="return loginSubmit();">
			<input type="hidden" name="hdAction" id="hdAction">
			  <div class="login-table">
			  <div class="Error" align="center" id="errmsg">{$ErrorMessage}</div>
					<table width="100%" align="center"cellpadding="5" cellspacing="3" class="listing-table">
						<tr>
						  <td class="first" width="41%" align="left">Username</td>
						</tr>
						<tr>
							<td width="59%" class="last">
								<input type="text" class="textbox" name="username" id="username" />
							</td>
						</tr>
						<tr class="bg">
							<td class="first" align="left">Password</td>
						</tr>
						<tr>
							<td class="last"><input type="password" class="textbox" name="password" id="password" /></td>
						</tr>
						<tr>
						 	<td align="left"><a href="forgotpassword.php" class="forgot">Forgot Password?</a>&nbsp;</td>
						</tr>
						<tr class="bg">
							<td align="right"><input type="submit" class="btn-submit" value="LOGIN" name="submit"/></td>
						</tr>
				</table>
			  </div>
		    </form>
		</div>
	</div>
	<div style="clear:both;"></div>
	<div id="login-footer">Copyright &copy; 2016 Rajasri Systems Pvt Ltd. All rights reserved.</div>
	</div>
</body>
</html>
