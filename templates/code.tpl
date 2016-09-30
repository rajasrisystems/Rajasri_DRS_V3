{literal}
	<link rel="stylesheet" href="css/jquery-ui.css">
 	<link rel="stylesheet" href="/resources/demos/style.css">
  	<script src="js/jquery-1.12.4.js"></script>
  	<script src="js/jquery-ui.js"></script>
	<link rel="stylesheet" href="css/jquery-ui.css">
  	<script src="js/jquery-1.10.2.js"></script>
	<script src="js/jquery-ui1.js"></script>
	<script>
	function validfield()
	{
		document.getElementById('test').innerHTML ="";
		document.getElementById('test2').innerHTML ="";
		document.getElementById('test3').innerHTML ="";
		document.getElementById('errmsg').innerHTML="";
		var regexp = /^\S/;
		var codevalidation = /^[ 0-9]+/;	
		if(document.getElementById('codeshow').value=='')
		{
		document.getElementById('errmsg').innerHTML='Please select code category';
		document.getElementById('codeshow').focus();
		return false;
		}
		if(!document.getElementById('code').value.trim())
		{
		document.getElementById('errmsg').innerHTML='Please enter description';
		document.getElementById('code').focus();
		return false;
		}
		if(document.getElementById('points').value=='')
		{
		document.getElementById('errmsg').innerHTML='Please enter points';
		document.getElementById('points').focus();
		return false;
		}
		if(!document.getElementById('points').value.match(codevalidation))
		{
		document.getElementById('errmsg').innerHTML='Please enter valid points';
		document.getElementById('points').focus();
		return false;
		}
		if(document.getElementById('Id').value=='')
		{
		document.getElementById('Ident').value=1;
		}
		else
		{
			document.getElementById('update_rating').value='1';	
		}	
	}
	function disablefunc() 
	{
		document.getElementById("Select").disabled=true;
	}
	
	function myFunction() 
	{
		var x;
		if (confirm("Are you sure you want to delete this record?") ) 
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
	FormName = document.del_form;
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
	FormName = document.del_form;
	FormName.sortflag.value=flag;
	FormName.submit();
	}
	
	</script>
{/literal}

<div id="wrapper">
<div style="clear:both;"></div>
<div id="middle"> 
  <div id="center-column">
    <div class="top-bar-header">
      <h1>Code</h1>
      <div class="breadcrumbs"><a href="controlpanel.php" >Home</a> >> Code</div>
    </div>
    <br/>
    	<div class="manage-grid">
		<form name="rating_form" id="rating_form" method="post" onsubmit="return validfield(this);">
			<input type="hidden" name="Ident" id="Ident">
			<input type="hidden" name="Id" id="Id" value="{$smarty.request.Id}">
			<input type="hidden" name="update_rating" id="update_rating" value="" >
			<table border="0" cellpadding="0" cellspacing="0" class="grid-table">
				<th colspan="10" style="text-align:left">Code</th>
				<tr style="border-bottom:none;">
				<td style="border-bottom:none;" colspan="10">
				<div class="Error" align="center" id="errmsg"></div>
				<div class="success" id="test">{if $smarty.request.successmsg eq 1} Code has been added successfully {/if}
				</div>
				<div class="success" id="test2">{if $smarty.request.successmsg eq 2} Code has been updated successfully {/if}
				</div>
				<div class="success" id="test3">{if $smarty.request.successmsg eq 3}Code has been deleted successfully {/if}
				</div>
				</td>
				</tr>
				<tr style="border-bottom:none;">
				<td style="text-align:right;border-bottom:none;" valign="top">Code Category: <span style="color:red">*</span></td>
					<td id="" style="text-align:center;border-bottom:none;" width="5%" valign="top"> 
					<select id="codeshow" name="codeshow" style="width: 95px;" >
						<option value="">---Code---</option>
						<option {if $indcode.0.codetype eq 1} selected="selected" {/if} value="1">Good</option>
						<option {if $indcode.0.codetype eq 2} selected="selected" {/if} value="2">Bad</option>
					</select>
					</td>
				<td style="text-align:right;border-bottom:none;" valign="top"> Description: <span style="color:red">*</span></td>
					<td style="text-align:center;border-bottom:none;width:100px;" >
						<textarea id="code" style=" width:400px;" name="code" >{$indcode.0.Description}</textarea>
	                </td>
	           
	            <td style="text-align:right;border-bottom:none;" valign="top"> Points: <span style="color:red">*</span></td>
					<td style="text-align:left;border-bottom:none;" valign="top">
						<input type="text" id="points"  valign="top" name="points" value="{$indcode.0.Points|substr:1}">
	                </td>
	            </tr>
				<tr style="border-bottom:none;">
					<td colspan="10"> 		
	 					<input type=submit name="submit1" value="Submit"> 
					</td>
				</tr>
			</table>
		</form>
		<div class="submit"></div>
	 	<form name="del_form" id="del_form" method="post" >
		<input type="hidden" name="delaction" id="delaction">
		<input type="hidden" name="sortflag" id="sortflag" value="{$smarty.request.sortflag}">
		<table border="0" cellpadding="2" cellspacing="0" class="grid-table">
			<th colspan="7" style="text-align:left"> Code list </th>
			<tr>&nbsp;</tr>
			<th width="5%">
				<span style="cursor: pointer; text-decoration: underline;" onclick="sortsub1();">CodeID</span> 
			</th>
			<th width="25%">
				<span style="cursor: pointer; text-decoration: underline;" onclick="sortsub2();">Description</span>
			</th>
			<th width="5%">
				Points
			</th>
			<th width="5%">Action</th> 
			{section name=i loop=$codeval}
			   <tr>
			    <td>{$codeval[i].Code}</td>
				<td style="text-align:left;">{$codeval[i].Description}</td>
				<td >{$codeval[i].Points}</td>
				<td style="padding:8px">
				<a href="code.php?Id=1&Code_Id={$codeval[i].ID}"><img src="img/b_edit.png"></a>&nbsp;&nbsp;
				<a href="codedrop.php?Del_Id={$codeval[i].ID}"><img src="img/b_drop.png" onclick="return myFunction();" ></a>
				<input type="hidden" name="delvar" id="delvar" value="{$displaydet[i].RatingID}">
				</td>
			  </tr>
			 {sectionelse}
				 <tr><td colspan="5">No records found</td></tr>
			 {/section}
		</table>
		</form>
		<div class="submit"></div>
	</div>
  </div>
</div>
</div>	
