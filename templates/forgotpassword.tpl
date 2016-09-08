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
	if(document.getElementById('emailaddress').value=='')
	{
		document.getElementById('errmsg').innerHTML='Please enter email address';
		document.getElementById('emailaddress').focus();
		return false;
	}
var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
var email=document.getElementById('emailaddress').value;
		if(!re.test(email)){
			document.getElementById('errmsg').innerHTML='Please enter a valid email address';
		document.getElementById('emailaddress').focus();
		return false;
		}
}

</script>
{/literal}
<div id="main">
<div class="logo"><a href="http://www.rajasri.net/"><img src="img/rajasri.jpeg" alt="" style="width:50px; height:50px;"/></a></div>
<div style="clear:both;"></div>
<div id="login-panel">
		<div id="center-column"> 
			<div class="top-bar">
				<h1>Forgot password</h1>
			</div><br />
			<form name="login" action ="forgot_pwd.php" id="loginform" method="post" onsubmit="return loginSubmit();">
			<input type="hidden" name="hdAction" id="hdAction"></input>
			  <div class="login-table">
			  
			  <div class="Error" align="center" id="errmsg">{$errorMessage}</div>
			  <div class="success" align="center" id="successmsg">{$successMessage}</div>
					<table width="100%" align="center"cellpadding="5" cellspacing="3" class="listing-table">
						<tr>
						  <td class="first" width="41%" align="left">Email address</td>
						</tr>
						<tr>
							<td width="59%" class="last">
								<input type="text" class="textbox" name="emailaddress" id="emailaddress" />
							</td>
						</tr>
											
						
						<tr class="bg">
						
							
							<td align="right"><input type="submit"  class="btn-submit" align="center" value="Submit" name="submit" onsubmit="valemail()"/>
							<input type="button" class="btn-submit" align="left" value="login" name="submit" onclick="location.href='index.php'"/>
							 </td>
							 
							 
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
