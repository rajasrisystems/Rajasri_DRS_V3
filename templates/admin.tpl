{literal}
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>
<link rel="stylesheet" href="css/all.css">
<script type="text/javascript">
function validate_ad()
{
	document.getElementById('errmsg1').innerHTML='';
	document.getElementById('errmsg').innerHTML='';
	var spl_char = /[\W_]/;
	if(document.getElementById('ad_fname').value == "")
	{
		document.getElementById('errmsg1').innerHTML = 'Please enter name';
		document.getElementById('ad_fname').focus();
		return false;
	}
	
	if(document.getElementById('ad_txt').value == "")
	{
		
		document.getElementById('errmsg1').innerHTML = 'Please enter username';
		document.getElementById('ad_txt').focus();
		return false;
	}
	if(document.getElementById('ad_pass').value =="")
	{
		document.getElementById('errmsg1').innerHTML = 'Please enter password';
		document.getElementById('ad_pass').focus();
		return false;
	}
	/*var pwd = document.getElementById('ad_pass').value;
	
	if(spl_char.test(pwd))
	{
		document.getElementById('errmsg1').innerHTML = 'Special characters not allowed';
		return false;
	}*/
	if(document.getElementById('em_txt').value=='')
	{
		document.getElementById('errmsg1').innerHTML='Please enter email ';
		document.getElementById('em_txt').focus();
		return (false);
	}
	var emailRegex = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/;
	if(!document.getElementById('em_txt').value.match(emailRegex))
	{
		document.getElementById('errmsg1').innerHTML='Please enter valid email ';
		document.getElementById('em_txt').focus();
		return (false);
	}
	if(document.getElementById('AdminID').value=='')
	{
		document.getElementById("hdAction").value='1';
		return true;
	}else{
		document.getElementById("updateAction").value='1';
		return true;
	}
	
}
function myFunction() 
	{
		var x;
		if (confirm("Are you sure! you want to delete this record?")) 
		{
			return true;
		}
		else 
		{
			return false; 		
	   	}
	}
function sortsub1()
	{
	if((document.getElementById('sortflag').value!="1")&&(document.getElementById('sortflag').value!="2"))
	{
		flag=2;
	}else if(document.getElementById('sortflag').value=="1")
	{
		flag=2;
	}
	else if(document.getElementById('sortflag').value=="2")
	{
		flag=1;
	}	
	FormName = document.admin_form;
	FormName.sortflag.value=flag;
	FormName.submit();
	}
function sortsub2()
	{
	if((document.getElementById('sortflag').value!="3")&&(document.getElementById('sortflag').value!="4"))
	{
		flag=4;
	}else if(document.getElementById('sortflag').value=="3")
	{
		flag=4;
	}
	else if(document.getElementById('sortflag').value=="4")
	{
		flag=3;
	}
	FormName = document.admin_form;
	FormName.sortflag.value=flag;
	FormName.submit();
	}
function sortsub3()
	{
	if((document.getElementById('sortflag').value!="5")&&(document.getElementById('sortflag').value!="6"))
	{
		flag=6;
	}else if(document.getElementById('sortflag').value=="5")
	{
		flag=6;
	}
	else if(document.getElementById('sortflag').value=="6")
	{
		flag=5;
	}	
	FormName = document.admin_form;
	FormName.sortflag.value=flag;
	FormName.submit();
	}

</script>
{/literal}
<div id="middle"> 
  <div id="center-column">
    <div class="top-bar-header">
		<h1><b>Admin</b></h1>
		<div class="breadcrumbs"><a href="controlpanel.php">Home</a> >>Admin</div>
	</div>
		<br/>
		<div class = "manage-grid">
			<div class="report-page" style="text-align:left;">
			<form action="" name="rptpage" method="post" onsubmit="return validate_ad()">
						<input type="hidden" id="hdAction" name="hdAction" value="">
						<input type="hidden" id="AdminID" name="AdminID" value="{$smarty.request.Ad_Id}">
						<input type="hidden" id="updateAction" name="updateAction" value="">
			<table border="0" cellpadding="" cellspacing="0" class="grid-table">
				<th colspan="10" style="text-align:left">Admin</th>
				<tr >
				<td style="border-bottom:none;" colspan="10">
				
					<div class="Error" align="center" id="errmsg1">{$ErrorMessage}</div>
					<div class="success" align="center" id="errmsg">{if $smarty.request.successmsg eq 2}Admin details deleted successfully {else} {$SuccessMessage} {/if}</div>
					
				</td>
				</tr>
			<tr>
				
				<td nowrap="nowrap" style="text-align:left;border-bottom:none;width:5%;">Name: <span style="color:red">*</span></td>
				<td width="5%" style="border-bottom:none;"><input type ="text"  style="width: 130px;" id="ad_fname" name = "admin_fname" value="{$adminDetails.0.Name}"></td>
				
				<td style="text-align: right;border-bottom:none; width: 4%;" nowrap="nowrap">Designation:</td>
				<td width="5%" style="border-bottom:none;"><input type ="text"  style="width: 180px;" id="ad_des" name = "admin_des" value="{$adminDetails.0.Designation}"></td>
				
				<td style="text-align: right;border-bottom:none; width: 4%;" nowrap="nowrap">Username: <span style="color:red">*</span></td>
				<td width="5%" style="border-bottom:none;"><input type ="text" style="width: 100px;" id="ad_txt" name = "admin_text" value="{$adminDetails.0.Username}"></td>
				
				
				<td style="text-align: right;border-bottom:none; width: 4%;" nowrap="nowrap">Password: <span style="color:red">*</span></td>
				<td width="5%" style="border-bottom:none;"><input type ="password" style="width: 100px;" id="ad_pass" name = "admin_password" value="{$adminDetails.0.Password}" ></td>
				
				<td style="text-align: right;border-bottom:none; width: 4%;" nowrap="nowrap">Email : <span style="color:red">*</span></td>
				<td width="5%" style="border-bottom:none;"><input type ="text" style="width: 170px;" id="em_txt" name = "em_txt" value="{$adminDetails.0.Email}"></td>
			</tr>
			<tr>
				<td width="5%" colspan="10" style="border-bottom:none;"><input type ="submit" id="rs_btn" name = "admin_button" value="Submit" onclick="clear_field();"></td>
	       	</tr>
			<tr>
				<td height="0" style=" padding: 0px;" colspan="10">&nbsp;</td>
			</tr>
	        </table>
		</form>
		<div id = "res_tbl" >	
		<form name="admin_form" id="admin_form" method="post" >
		<input type="hidden" name="sortflag" id="sortflag" value="{$smarty.request.sortflag}">
			<table border="0" cellpadding="2" cellspacing="0" class="grid-table">
				<!--- <th colspan="6" style="text-align:left"> Admin Username List </th> -->
				<tr style="border-bottom:none;">&nbsp;</tr>
					<th width="8%"><span style="cursor: pointer; text-decoration: underline;" onclick="sortsub1();">Name</span></th>
					<th width="8%"><span style="cursor: pointer; text-decoration: underline;" onclick="sortsub3();">Designation</span></th>
					<th width="8%"><span style="cursor: pointer; text-decoration: underline;" onclick="sortsub2();">Username</span></th>
					<th width="8%">Action</th>
				</tr>
					{section name=R loop=$showval}
				<tr>
					<td  style="text-align:left">{$showval[R].Name}</td>
					<td  style="text-align:left">{$showval[R].Designation}</td>
					<td>{$showval[R].Username|upper}</td>
					<td style="padding:8px"><a href="#">
						<a href="admin.php?Ad_Id={$showval[R].ID}"> <img src="img/b_edit.png"></a>&nbsp;&nbsp;
							<a href="ad_drop.php?Del_Id={$showval[R].ID}"><img src="img/b_drop.png" onclick="return myFunction();" ></a>
					<!-- <input type="hidden" name="delvar" id="delvar" value="{$displaydet[i].RatingID}"> -->
							</td>
							</tr>
						{sectionelse}
						<tr>
							<td colspan="3">No Records Found</td>
						</tr>
						{/section}
				</table>
				</div>
			 
	      </div>	  
	</div>
</div>

