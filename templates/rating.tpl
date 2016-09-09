{literal}
	<link rel="stylesheet" href="css/jquery-ui.css">
 	<link rel="stylesheet" href="/resources/demos/style.css">
  	<script src="js/jquery-1.12.4.js"></script>
  	<script src="js/jquery-ui.js"></script>
	<link rel="stylesheet" href="css/jquery-ui.css">
  	<script src="js/jquery-1.10.2.js"></script>
	<script src="js/jquery-ui1.js"></script>
	<script>
	$( function() {
		$( "#ratingdate" ).datepicker({
			dateFormat:"dd/mm/yy",
			 maxDate: 0
				})
				//.datepicker("setDate", new Date());
		});
		jQuery(document).ready(function($)
		
	{
		$("#code").autocomplete({
			source: function(request, response) {
				$.ajax({
					url: "get_code.php",
				        data: {  term: $("#code").val()},
				        dataType: "json",
				        type: "GET",
				        success: function(data){
							response(data);
						}
				});
		    },scroll:true,
			minLength: 0
			
		}).bind('focus', function(){ $(this).autocomplete("search"); } );           
            // The following works only once.
            // $(this).trigger('keydown.autocomplete');
            // As suggested by digitalPBK, works multiple times
			//$( ".selector" ).on( "autocompletefocus", function( event, ui ) {} );
            //$(this).data("autocomplete").search($(this).val());
        //});
		/*$("#code").on('change mouseover focusIn', function(){
			var val=this.value;
			valArr=val.split('-');
			if(valArr[1]!=''){
				document.getElementById("code").value=valArr[0].trim();
				document.getElementById("notes").value=valArr[1].trim();
			}
		});*/
	});

function getresdep(val){
	
	$.ajax({
		url: 'getdept.php',
		type: "POST", 
		data:"departmentajax="+val,
		success: function(data) {
			if(data  != ""){
					//alert(data);
					document.getElementById("newresid").innerHTML=data;
					return true;
					}
		}
	});
}
	
	
	function validfield()
	{
		if(document.getElementById('ratingdate').value=='')
		{
		document.getElementById('errmsg').innerHTML='Please select date';
		document.getElementById('ratingdate').focus();
		return false;
		}
		
		if(document.getElementById('department').value=='')
		{
		alert("Please select department");
		//document.getElementById('errmsg').innerHTML='Please select resource';
		//document.getElementById('resource').focus();
		return false;
		}
		
		if(document.getElementById('newresid').value=='')
		{
		
		alert("Please select resource");
		//document.getElementById('errmsg').innerHTML='Please select resource';
		//document.getElementById('resource').focus();
		return false;
		}
		if(document.getElementById('code').value=='')
		{
			
		document.getElementById('errmsg').innerHTML='Please enter code';
		document.getElementById('code').focus();
		return false;
		}
		if(document.getElementById('RatId').value=='')
		{
		document.getElementById('Hitaction').value=1;
		}
		else
		{
			document.getElementById('update_rating').value='1';	
		}	
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
	FormName = document.del_form;
	FormName.sortflag.value=flag;
	FormName.submit();
	}
	function sortsub4()
	{
	if((document.getElementById('sortflag').value!="7")&&(document.getElementById('sortflag').value!="8"))
	{
		flag=8;
	}else if(document.getElementById('sortflag').value=="7")
	{
		flag=8;
	}
	else if(document.getElementById('sortflag').value=="8")
	{
		flag=7;
	}	
	FormName = document.del_form;
	FormName.sortflag.value=flag;
	FormName.submit();
	}
	function sortsub5()
	{
	if((document.getElementById('sortflag').value!="9")&&(document.getElementById('sortflag').value!="10"))
	{
		flag=10;
	}else if(document.getElementById('sortflag').value=="9")
	{
		flag=10;
	}
	else if(document.getElementById('sortflag').value=="10")
	{
		flag=9;
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
      <h1>Rating</h1>
      <div class="breadcrumbs"><a href="controlpanel.php" >Home</a> >> Rating</div>
    </div>
    <br/>
    	<div class="manage-grid">
		<form name="rating_form" id="rating_form" method="post" onsubmit="return validfield(this);">
			<input type="hidden" name="Hitaction" id="Hitaction">
			<input type="hidden" name="RatId" id="RatId" value="{$smarty.request.Rat_Id}">
			<input type="hidden" name="update_rating" id="update_rating" value="" >
			<table border="0" cellpadding="0" cellspacing="0" class="grid-table">
				<th colspan="10" style="text-align:left">Rating</th>
				<tr> 
				<td style="border-bottom:none;" colspan="10"> <div class="Error" align="center" id="errmsg"></div>
					<div class="success">{if $smarty.request.successmsg eq 3} Rating has been added successfully {/if}
					</div>
					<div class="success">{if $smarty.request.successmsg eq 1} Rating has been updated successfully {/if}
					</div>
					<div class="success">{if $smarty.request.successmsg eq 2}Rating has been deleted successfully {/if}
					</div>
				</td>
				</tr>
				<tr style="border-bottom:none;">
					<td style="text-align:right;border-bottom:none;" width="5%" valign="top" nowrap="nowrap">Rating Date: <span style="color:red;">*</span></td>
					<td style="text-align:left;border-bottom:none;" width="5%" valign="top">
						<input type="text" name="ratingdate" style="width:80px;" id="ratingdate" size="12" readonly="readonly" 
						value="{if $getRating.0.RatingDate neq ''}{$getRating.0.RatingDate|date_format:'%d/%m/%Y'}{else}{$current_date}{/if}">
					</td>
					
					<!-- Department Field -->
					
					<td style="text-align:right;border-bottom:none;" width="9%"valign="top">Department: <span style="color:red;">*</span>  </td>
					<td style="text-align:left;border-bottom:none;" id="deptshow" width="5%"valign="top">
					<select id="department" name="department" style="width:100px;" onchange="getresdep(this.value);">
						<option value="">--Select--</option>
							{foreach item=department from=$dept}
								<option value='{$department.Id}' {if $getRating.0.DepartmentId eq $department.Id} selected="selected" {/if}>{$department.DepartmentName}</option>
							{/foreach}
					</select>
					</td>
					<!-- Resource Field -->
					
					<td style="text-align:right;border-bottom:none;" width="8%"valign="top">Resource: <span style="color:red">*</span></td>
					<td id="deptshow" style="text-align:left;border-bottom:none;" width="5%"valign="top"> 
					<select id="newresid" name="newresid" style="width: 95px;" >
						<option value="">--Resource--</option>
						{if $smarty.request.DepartmentID neq '' && $smarty.request.Res_Id neq ''}
						{section name=C loop=$getresdep}
						<option value="{$getresdep[C].ID}" 
						{if $getRating.0.ResourceID  eq $getresdep[C].ID} selected="selected"{/if}>
						{$getresdep[C].ResourceInitial}</option>
						{/section}	
						{/if}
					</select>
					</td>
					<td style="text-align:right;border-bottom:none;" width="6%"valign="top">Code: <span style="color:red">*</span></td>
					<td style="text-align:left;border-bottom:none;" width="15%"valign="top">
						<input type="text" id="code" style="text-align:left;" name="code" style="width:183px;" value="{$getRating.0.Code}">
	                        	</td>
					<td style="text-align:left;border-bottom:none; vertical-align:top">Notes:</td>
					<td style="text-align:left;border-bottom:none;">
						<textarea rows="3" cols="25" id="notes" name="notes">{if $getRating.0.Notes neq '-'}{$getRating.0.Notes}{else} {/if}</textarea>
					</td>
					<tr style="border-bottom:none;">
					<td colspan="10"> 		
	 					<input type=submit name="submit1" value="Submit"> 
					</td></tr>
				</tr>
			</table>
		</form>
		<div class="submit"></div>
	 	<form name="del_form" id="del_form" method="post" >
		<input type="hidden" name="delaction" id="delaction">
		<input type="hidden" name="sortflag" id="sortflag" value="{$smarty.request.sortflag}">
		<table border="0" cellpadding="2" cellspacing="0" class="grid-table">
			<th colspan="7" style="text-align:left"> Report </th>
			<tr>&nbsp;</tr>
			<th width="8%">
				<span style="cursor: pointer; text-decoration: underline;" onclick="sortsub4();">Date</span> 
			</th>
			<th width="8%">
				<span style="cursor: pointer; text-decoration: underline;" onclick="sortsub1();">Resource</span>
			</th>
			<th width="12%">
				<span style="cursor: pointer; text-decoration: underline;" onclick="sortsub2();">Code</span>
			</th>
			<th>
				<span style="cursor: pointer; text-decoration: underline;" onclick="sortsub3();">Notes</span>  
			</th>
			<th> 
				<span style="cursor: pointer; text-decoration: underline;" onclick="sortsub5();">Manager</span>
			</th>
			<th width="12%">Action</th> 
			{assign var=number value=1}
			  {section name=i loop=$displaydet}
			   <tr>
			    <td>{$displaydet[i].RatingDate|date_format:'%d/%m/%Y'}</td>
				<td>{$displaydet[i].ResourceInitial}</td>
				<td>{$displaydet[i].Code}</td>
				<td  style="text-align:left">{if $displaydet[i].Notes neq ''}{$displaydet[i].Notes}{else} - {/if} </td>
				<td>{$objRating->managername($displaydet[i].CreatedBy)}</td>
				<td style="padding:8px"><a href="#">
				<a href="rating.php?Rat_Id={$displaydet[i].RatingID}&Res_Id={$displaydet[i].ResourceID}&DepartmentID={$displaydet[i].DepartmentID}"> <img src="img/b_edit.png"></a>&nbsp;&nbsp;
				<a href="drop.php?Del_Id={$displaydet[i].RatingID}"><img src="img/b_drop.png" onclick="return myFunction();" ></a>
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
