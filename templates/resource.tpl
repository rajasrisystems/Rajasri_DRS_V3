{literal}
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>
<script type="text/javascript">
function validate_rs()
{
	document.getElementById('errmsg1').innerHTML='';
	document.getElementById('errmsg').innerHTML='';
	var spl_char = /[\W_]/;
	if(document.getElementById('rs_txt').value == "")
	{
		document.getElementById('errmsg1').innerHTML = 'Please enter resource name';
		document.getElementById('rs_txt').focus();
		return false;
	}
	if(document.getElementById('rs_ini').value =="")
	{
		document.getElementById('errmsg1').innerHTML = 'Please enter resource initial';
		document.getElementById('rs_ini').focus();
		return false;
	}
	var rsin = document.getElementById('rs_ini').value;
	if(spl_char.test(rsin))
	{
		document.getElementById('errmsg1').innerHTML = 'Special characters not allowed';
		return false;
	}
	if(document.getElementById('department').value =="")
	{
		document.getElementById('errmsg1').innerHTML = 'Please select department';
		document.getElementById('department').focus();
		return false;
	}
	var emailRegex = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/;
	if(document.getElementById('em_txt').value=='')
	{
		document.getElementById('errmsg1').innerHTML='Please enter email ';
		document.getElementById('em_txt').focus();
		return (false);
	}
	if(!document.getElementById('em_txt').value.match(emailRegex))
	{
		document.getElementById('errmsg1').innerHTML='Please enter valid email ';
		document.getElementById('em_txt').focus();
		return (false);
	}
	if(document.getElementById('ResID').value=='')
	{
		document.getElementById("hdAction").value='1';
		return true;
	}
	else{
		document.getElementById("updateAction").value='1';
		return true;
	}
}
function myFunction() 
	{
		var x;
		if (confirm("Are you sure! you want to delete this record?") ) 
		{
			return true;
		}
		else 
		{
			return false; 		
	   	}
	}
function sortfunction()
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
	FormName = document.res_sort;
	FormName.sortflag.value=flag;
	FormName.submit();
	}
function ressortsub2()
{
	if((document.getElementById('sortflag').value!="3")&&(document.getElementById('sortflag').value!="4")){
		flag=3;
	}else if(document.getElementById('sortflag').value=="3")
	{
		flag=4;
	}
	else if(document.getElementById('sortflag').value=="4"){
		flag=3;
	}	
	FormName = document.res_sort;
	FormName.sortflag.value=flag;
	FormName.submit();
}
function ressortsub3()
{
	if((document.getElementById('sortflag').value!="5")&&(document.getElementById('sortflag').value!="6")){
		flag=5;
	}else if(document.getElementById('sortflag').value=="5")
	{
		flag=6;
	}
	else if(document.getElementById('sortflag').value=="6"){
		flag=5;
	}	
	FormName = document.res_sort;
	FormName.sortflag.value=flag;
	FormName.submit();
}
</script>
{/literal}
<div id="middle"> 
  <div id="center-column">
    <div class="top-bar-header">
		<h1>Resource</h1>
		<div class="breadcrumbs"><a href="controlpanel.php" >Home</a> >> Resource</div>
		</div>
		<br/>
		<div class = "manage-grid">
			<div class="report-page" style="text-align:left;">
				<form action="" name="rptpage" method="post" onsubmit ="return validate_rs();">
				<input type="hidden" id="hdAction" name="hdAction" value=""> 
				<input type="hidden" id="ResID" name="ResID" value="{$smarty.request.Rs_Id}">   <!--- used for taking the temp value/data which is not going to store in db
																										/show to user-this will store and display-->
				<input type="hidden" id="updateAction" name="updateAction" value="">
				
				<table border="0" cellpadding="0" cellspacing="0" class="grid-table">
				<th colspan="10" style="text-align:left">Resource</th>
				<tr>
				<td style="border-bottom:none;" colspan="8">
					<div class="Error" align="center" id="errmsg1"></div>
					<div class="Error" align="center" id="errmsg1">{$ErrorMessage}</div>
					<div class="success" align="center" id="errmsg">{$SuccessMessage}</div>
					<div class="success">{if $smarty.request.successmsg eq 1}Resource details updated successfully{/if}</div>
					<div class="success">{if $smarty.request.successmsg eq 2}Resource details deleted successfully {/if}
				</td>
				</tr>
			<tr style="border-bottom:none;">
				<!---- Resource Name Text Box ---->
				<td width="10%" nowrap="nowrap" style="text-align:left; border-bottom:none;" >Resource: <span style="color:red">*</span></td>
				<td width="5%" style="border-bottom:none;"><input type ="text" id="rs_txt" name = "resource_text" style="width: 200px;" value="{$resourceDetails.0.ResourceName}"></td>
				
				<!---- Resource Initial Text ---->
				
				<td width="10%" nowrap="nowrap" style="text-align:right; border-bottom:none;">Resource Initial: <span style="color:red">*</span></td>
				<td width="5%" style="border-bottom:none;"><input type ="text" style="width:100px"id="rs_ini" name = "resource_initial" style="width: 200px;" value="{$resourceDetails.0.ResourceInitial}" onkeyup ="caps()" ></td>
				
				<!---- Department ---->
				<td width="10%" nowrap="nowrap" style="text-align:right; border-bottom:none;">Department: <span style="color:red">*</span></td>
				<td style="text-align:left;border-bottom:none;" width="5%"valign="top"> 
				<select id="department" name="department" style="width: 180px;">
					<option value="">--Select--</option>
					{foreach item=dept from=$depdata}
					<p>
					<option value='{$dept.Id}' {if $resourceDetails.0.DepartmentId eq $dept.Id} selected="selected" {/if}>
						{$dept.DepartmentName}
					</option>
					</p>
					{/foreach}	
				</select>
				</td>
				
				
				
				<!---- email ---->
				<td style="text-align: right;border-bottom:none; width: 4%;" nowrap="nowrap">Email : <span style="color:red">*</span></td>
				<td width="5%" style="border-bottom:none;"><input type ="text" style="width: 170px;" id="em_txt" name = "em_txt" value="{$resourceDetails.0.Email}"></td>

				
				<!---- Submit Button ---->
				
				<td width="5%" style="border-bottom:none;" ><input type ="submit" id="rs_btn" name = "resource_button"  value="Submit" onsubmit="validate_rs()"></td>
	        </tr>
			<tr><td  style=" padding: 0px;" colspan="10">&nbsp;</td></tr>
	        </table>
		</form>
		<div id = "res_tbl" >	
		<form name="res_sort" id="res_sort" method="post">
		<input type="hidden" name="sortflag" id="sortflag" value="{$smarty.request.sortflag}">
			<table border="0" cellpadding="2" cellspacing="0" class="grid-table">
				<tr>&nbsp;</tr>
					<th width="8%">
					<span style="cursor: pointer; text-decoration: underline;" onclick="sortfunction();">Resource
					</span>
					</th>
					<th width="8%">
					<span style="cursor: pointer; text-decoration: underline;" onclick="ressortsub2();">Resource Initial
					</span>	
					</th>
					<th width="8%">
					<span style="cursor: pointer; text-decoration: underline;" onclick="ressortsub3();">Department
					</span>	
					</th>
					<th width="8%">Action</th>
				</tr>
				{assign var=number value=1}
				{section name=R loop=$showres}
				<tr>
					<td align="left">{$showres[R].ResourceName|ucfirst}</td>
					<td>{$showres[R].ResourceInitial|upper}</td>
					<td align="left">{$showres[R].DepartmentName}</td>
					<td style="padding:8px"><a href="#">
						<a href="resource.php?Rs_Id={$showres[R].ID}"> <img src="img/b_edit.png"></a>&nbsp;&nbsp;
						<a href="rs_drop.php?Del_Id={$showres[R].ID}"><img src="img/b_drop.png" onclick="return myFunction();" ></a>
					</td>
				</tr>
				{sectionelse}
				<tr>
					<td colspan="3">No Records Found</td>
				</tr>
				{/section}
			</table>
			</form>
		</div>
		
	      </div>	  
	</div>
</div>

