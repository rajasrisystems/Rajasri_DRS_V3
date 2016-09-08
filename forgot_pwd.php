<?php
	include "includes/common.php";
	include_once $config['SiteClassPath']."class.index.php";
	$objLogin 	= new Login();
	ini_set("display_errors", 0);
	
	//echo $_REQUEST['emailaddress'];
if($_REQUEST['emailaddress']!=''){
			$seltext 	= "select * from admin where Email='".trim($_REQUEST['emailaddress'])."'";
		 	$selEmail 	= $objLogin->ExecuteQuery($seltext, "select");
		//print_r($selEmail);
		$to_email=addslashes($_REQUEST['emailaddress']);
	if($selEmail)
	{
		
				$login_link = $config['SiteGlobalPath']."index.php";
				 $imgurl=$config['SiteGlobalPath']."/img/rajasri.jpeg";		
				 $message='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
				<html xmlns="http://www.w3.org/1999/xhtml">
				<head>
				<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
				<title>Password Retrival</title>
						<style>
				body{
					font-family:Arial, Helvetica, sans-serif;
					font-size:12px;
					color:#000000;
				}
				.left-header {
				float: left;
				width: 590px;
				}
				.left-header .logo {
				float: left;
				width: 220px;
				margin-top: 5px;
				}
				.logo-txt {
				float: left;
				width: 370px;
				text-align: center;
				margin-top: 55px;
			   }
				</style>
				</head>	
				<body>
				<table width="700" border="3" cellspacing="0" cellpadding="7">
				  <tr>
					<td><table width="100%" border="0" cellspacing="0" cellpadding="0">
					  <tr>
						<td><table width="100%" border="0" cellspacing="0" cellpadding="0">
						<tr>
						<td align="left"  class="normal_txt7"><div class="left-header">
	          		 	<div class="logo"><img src="'.$imgurl.'" /></div>           			         
	         			</div> </td>
	         		 	</tr>
	         		 						  
						  <tr>
							<td height="35" align="center" bgcolor="#FFFFFF" class="normal_txt7"><table width="97%"  cellspacing="0" cellpadding="0">
							  <tr>
								<td width="53%" height="8"></td>
								<td width="47%" height="8"></td>
								</tr>
								<tr>
								  <td height="25" colspan="2" align="left" valign="middle" class="title_1" >Hello '.$selEmail[0]['Name'].' ,</td>
								</tr>
								<tr>
								<td colspan="2" align="left" valign="middle" class="title_1">&nbsp;</td>
								</tr>
							<tr>
						  <td height="25" colspan="2" align="left" valign="middle" class="title_1" >Please find below the login credentials for Rajasri DRS</td>
				    		</tr>	
									
								<tr>
								<td colspan="2" align="left" valign="middle" class="title_1"><b>Email:</b> '.$selEmail[0]['Email'].'</td>
								</tr>						
								<tr>
								  <td height="25" colspan="2" align="left" valign="middle" class="title_1" ><b>Password:</b> '.$selEmail[0]['Password'].'</td>
								</tr>	
								<tr>
				  				<td height="25" colspan="2" align="left" valign="middle" class="title_1" ><a href="'.$login_link.'">Click Here</a> to login</td>
								</tr>	
								<tr>
								<td colspan="2" align="left" valign="middle" class="title_1">&nbsp;</td>
								</tr>					
								<tr>
								<td colspan="2" align="left" valign="middle" class="title_1">Thanks,</td>
					  			</tr>		
					 			<tr>
									<td colspan="2" align="left" valign="middle" class="title_1">Rajasri Team</td>
								</tr>											  
							</table></td>
						  </tr>
						</table></td>
					  </tr>
					</table></td>
				  </tr>
				</table>
				</body>
				</html>';	
				
			//echo $message;exit;
				$headers = 'From: hr@rajasri.net'."\r\n";
				$headers.= 'Reply-To: hr@rajasri.net'."\r\n";
				$headers.= "MIME-Version: 1.0\r\n";
				$headers.= "Content-type: text/html; charset=iso-8859-1\r\n";
				$subject=	"Rajasri DRS Password Retrival";	
				@mail($to_email,$subject,$message,$headers);
				header("Location:forgotpassword.php?smsg=Mail has been sent successfully");
				echo "@@@@yes";
		
	}else
	{
		
			header("Location:forgotpassword.php?msg=Invalid email address");
		
         
		
	}
	
	}
?>