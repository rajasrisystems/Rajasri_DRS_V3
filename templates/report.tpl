<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
{literal}
<script src="js/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>
<link rel="stylesheet" href="css/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script src="js/excellentexport.js"></script>
<script>

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
function getreport()
{
	var month=document.getElementById('month').value; 
	var year=document.getElementById('year').value; 	
	var department=document.getElementById('department').value; 
	var newresid=document.getElementById('newresid').value; 
	var radiocheck = document.getElementById("radio2").checked;
	var individualradio = document.getElementById("radio1").checked;
	if(month != '0' && year != '0' && department !='' && newresid !='' && individualradio == true )
	{
		//document.getElementById("sendmail").style.display = "block";
		var newname = document.getElementById('newresid').options[document.getElementById('newresid').selectedIndex].text;
		document.getElementById('optionname').value = newname;
		document.getElementById('getreshid').value ='2';
	}
	else
	{
		document.getElementById("radio1").checked==false;
		document.getElementById('newresid').value= "";
		document.getElementById('getreshid').value ='1';
	}
}
function tbl_view()
	{
		// Individual resource 
		if(document.getElementById("radio2").checked==false && document.getElementById("radio1").checked==false )
		{
			return false;
		}
		else
		{
			month = document.getElementById('month').value;
			year=document.getElementById('year').value;
			newresid=document.getElementById('newresid').value;
			optionname = document.getElementById('newresid').options[document.getElementById('newresid').selectedIndex].text;
			dataction=document.getElementById('dataction').value;
			resource=2;
			$.ajax({
				url:'getresource.php',
				type: "POST",
			  	  data: "month="+month+"&year="+year+"&newresid="+newresid+"&resource="+resource+"&optionname="+optionname,
				success:function(data){
					if(data  != ""){
						//alert(data);
			    		document.getElementById('mgrid').innerHTML=data;
			        	return true;
					}else{
					}
			    }
			    	    
			 });
		//$( "#radio1" ).prop( "checked", true ); 
    		document.getElementById("sendmail").style.display = "block";
		}
	}
function tbl_report()
	{
		// All resource 
			alert('ajax');
			month=document.getElementById('month').value;
			year=document.getElementById('year').value;
			dept=document.getElementById('department').value;
			document.getElementById('newresid').value='';
			dataction=document.getElementById('dataction').value;
			resource=1;
			$.ajax({
				url:'getresource.php',
				type: "POST",
			    	data: "month="+month+"&year="+year+"&resource="+resource+"&dept="+dept,
				success:function(data){
					if(data  != ""){
			        	data=data.split("@@@");
					//alert(data); 
			        	$('#numrec').val(data[0]);
			    		document.getElementById('mgrid').innerHTML=data[1];
			        	return true;
					}else{
					}
			    }
			 });
			 alert('last');
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
function tap(link)
{
	var mnth = document.getElementById('month');
	var op = mnth.options[mnth.selectedIndex];
	//alert(op.text);
	var month=op.text;
	var dpt=document.getElementById('department');
	var department=document.getElementById('department').value;	 
	var dp = dpt.options[dpt.selectedIndex];
	var deptv=dp.text;
	var year=document.getElementById('year').value;
	var newresid=document.getElementById('newresid').value;	
    	link.title = 'after click';
	if(document.getElementById('month').value != '0' && year != '0' && department !='' )
	{
		document.getElementById("exportnew").style.display = "block";
		document.getElementById("export").style.display = "none";
	}
	else
	{
		document.getElementById("exportnew").style.display = "none";
		document.getElementById("export").style.display = "block";
		departval();
	}
}
function tapp(link)
{
	var mnth = document.getElementById('month');
	var op = mnth.options[mnth.selectedIndex];
	//alert(op.text);
	var month=op.text;
	var dpt=document.getElementById('department');
	var department=document.getElementById('department').value;	 
	var dp = dpt.options[dpt.selectedIndex];
	var deptv=dp.text;
	var year=document.getElementById('year').value;
	var newresid=document.getElementById('newresid').value;
    	link.title = 'after click';
	if(document.getElementById('month').value != '0' && year != '0' && department !='' && newresid != '')
	{
	document.getElementById("exportnewone").style.display = "none";
	document.getElementById("export").style.display = "none";
	document.getElementById("exportnew").style.display = "block";
	}
	else
	{
		document.getElementById("exportnewone").style.display = "block";
		document.getElementById("export").style.display = "none";
		document.getElementById("exportnew").style.display = "none";
		departval();
	}
}
function tool(link) 
 {
	
 	var mnth = document.getElementById('month');
	var op = mnth.options[mnth.selectedIndex];
	//alert(op.text);
	var month=op.text;
	var dpt=document.getElementById('department');
	var department=document.getElementById('department').value;	 
	var dp = dpt.options[dpt.selectedIndex];
	var deptv=dp.text;
	var year=document.getElementById('year').value;
	var newresid=document.getElementById('newresid').value;	
    	link.title = 'after click';
	if(document.getElementById('radio2').value == 'all')
	{
	if(document.getElementById('month').value != '0' && year != '0' && department !='' )
	{
	document.getElementById("exportnew").style.display = "block";
	document.getElementById("export").style.display = "none";
    	if($('#radio2').is(':checked'))
	{
    		link.download = 'Report-All ('+deptv+')-'+month+'-'+year+'.xls';
	}
    	else
	{
    		var newresid = document.getElementById('newresid');
    		var opt = newresid.options[newresid.selectedIndex];
    		var option_value=opt.text;
   		link.download = 'Report-'+option_value+'('+deptv+')-'+month+'-'+year+'.xls';
	}
	}
	else
	{
		departval();
	}
	}
	else
	{
	if(document.getElementById('month').value != '0' && year != '0' && department !='' && newresid != '' )
	{
	document.getElementById("exportnew").style.display = "block";
	document.getElementById("export").style.display = "none";
    	if($('#radio2').is(':checked'))
	{
    		link.download = 'Report-All ('+deptv+')-'+month+'-'+year+'.xls';
	}
    	else
	{
    		var newresid = document.getElementById('newresid');
    		var opt = newresid.options[newresid.selectedIndex];
    		var option_value=opt.text;
   		link.download = 'Report-'+option_value+'('+deptv+')-'+month+'-'+year+'.xls';
	}
	}
	else
	{
		departval();
	}
	}
	
  }
function goExport(){
	
	var dpt=document.getElementById('department'); 
	var dp = dpt.options[dpt.selectedIndex];
	var deptv=dp.text;
	var idpt=document.getElementById('newresid'); 
	var idp = idpt.options[idpt.selectedIndex];
	var optione=idp.text;
	document.getElementById('optionname').value=optione;
	document.getElementById('deptname').value=deptv;
	var str = $("form").serialize();
	window.location="excel.php?"+str;
}

function check_all()
 {
	var month=document.getElementById('month').value; 
	var year=document.getElementById('year').value; 	
	var department=document.getElementById('department').value; 
	if(month != '0' && year != '0' && department !='' )
	{
		//alert('check_all');
		$( "#radio2" ).prop( "checked", true );	
		chkResource();
	}
 }
 function check_single()
 {
	var month=document.getElementById('month').value; 
	var year=document.getElementById('year').value; 
	var department=document.getElementById('department').value; 
	var newresid=document.getElementById('newresid').value; 
	if(month != '0' && year != '0' && department !='' && newresid !='' )
	{
		//alert('check_single');
		$( "#radio1" ).prop( "checked", true );	
		chkResource();
	}
	else
	{
		check_all();	
	}	 
 }
/*********** Sorting Month name with its option value***********/
 /*
 $(document).ready(function() {
        $("#month").html($('#month option').sort(function(x, y) {
            return $(x).val() < $(y).val() ? -1 : 1;
        }))
        e.preventDefault();
});
 */
 /************************/
</script>
{/literal}
<!--Design Prepared by Rajasri Systems-->   
<body>
<div id="wrapper">
	<div style="clear:both;"></div>	
		<div id="middle"> 
		  <div id="center-column">	
		    <div class="top-bar-header">
				<h1>Reports</h1>
				<div class="breadcrumbs"><a href="controlpanel.php" >Home</a> >> Reports</div>
			</div>
			<br/>
			<div class = "manage-grid">
			<form  name="rptpage"  method="post" onsubmit="return getreport();" accept-charset=utf-8>
				<div class="report-page" style="text-align:left;">
					<input type="hidden" name="sortflag" id="sortflag" value="{$smarty.request.sortflag}">
					<input type="hidden" name="deptname" id="deptname" value=" ">
					<input type="hidden" name="optionname" id="optionname" value=" ">
					<input type="hidden" name="dataction" id="dataction">
					<input type="hidden" name="getreshid" id="getreshid">
					<input type="hidden" name="numrec" id="numrec">
					<input type="hidden" name="singlerestemp" id="singlerestemp">
					<input type="hidden" name="resourceinital" id="resourceinital" value=" ">
					
					<table border="0" cellpadding="0" cellspacing="0" class="grid-table">
						<th colspan="11" style="text-align:left">Reports</th>
						<tr>
							<td colspan="11" style="border-bottom:none;"> <div class="success">{if $smarty.request.id eq 1} Email sent successfully {/if}</div> </td>	
						</tr>
						<tr>
							<div class="Error" align="center" id="errmsg"></div>
						 	<td width="5%" nowrap="nowrap" style="border-bottom:none;">From:</td>
				 			<td width="7%" style="text-align:left;border-bottom:none;">
								<select id="month" name="month" onchange="tap(this); return chkResource();">
								{foreach key=k item=v from=$months}	
								<option value='{$v|date_format:"%m"}' {if $v|date_format:"%m" eq $currentMonth}selected="selected"{/if} >{$v} </option>
 								{/foreach}
								</select>
							</td>
							<td nowrap="nowrap" style="border-bottom:none;">To:</td>
							<td width="10%" style="text-align:left;border-bottom:none;">
								<select id="year" name="year" onchange="return chkResource();">	
								{foreach key=yk item=yv from=$year}	
								<option value='{$yv}' {if $yv eq $currentYear}selected{/if}>{$yv}</option>
 								{/foreach}
								</select>
					 		</td>
							<td width="5%" nowrap="nowrap" style="text-align:left;border-bottom:none;">Department: <span style="color:red">*</span></td>
							<td style="text-align:left;border-bottom:none;" width="5%"> 
								<select id="department" name="department" style="width: 160px;"  onchange="return getresdep(this.value); ">
								<option value="0">All</option>
								{foreach item=dept from=$depdata}
								<p>
								<option value='{$dept.Id}' {if $smarty.request.department eq $dept.Id}Selected{/if}>
								{$dept.DepartmentName}
								</option>
								</p>
								{/foreach}	
								</select>
							</td>
							<td width="5%" nowrap="nowrap" style="text-align:left;border-bottom:none;">Resource:</td>
							<td width="5%"  style="text-align:left;border-bottom:none;">
								<input type ="radio" id="radio2" name = "radio"  value="all" {if $smarty.request.newresid eq ''} checked="checked" {/if}> 
	               				<span style="text-align:left" width="6%"valign="top">All</span>
	            			</td>
              				<td width="18%" style="text-align:left;border-bottom:none;">
								<input type ="radio" id="radio1" name = "radio"  value="sing" {if $smarty.request.newresid neq ''} checked="checked" {/if}> 
	             				<span style="text-align:left;" width="10%" valign="top" nowrap="nowrap" >Individual</span>
	          					<select id="newresid" name="newresid" style="width: 96px;" >
								<option value="">--Resource--</option>
								{if $smarty.request.department neq ''}
								{section name=C loop=$getresdep}
								<option value="{$getresdep[C].ID}" 
								{if $smarty.request.newresid  eq $getresdep[C].ID} selected="selected"{/if}>
								{$getresdep[C].ResourceInitial}</option>
								{/section}	
								{/if}
								{section name=R loop=$getresdept}
								<option value="{$getresdept[R].ID}">
								{$getresdept[R].ResourceInitial}
								</option>
								{/section}	
								</select>   
	           				</td>
               				
							<td {if $smarty.request.newresid eq ''} style="text-align:left; display:none;border-bottom:none;" {else} style="display:block;border-bottom:none;" {/if} id="sendmail" name="sendmail">
								<a  class="button" id="top"  href="javascript:void(0);" onclick="goExport();"><img src="img/mail_send.png" align="middle" height="30" width="30">Send mail</a>
							</td>
							
							<td style="text-align:right;border-bottom:none;">
								<div style="display:none;" id="export">
								<a class="button" id="top" href="javascript:void(0);" onclick="tool(this);"><img src="img/CSV.png" align="middle" height="30" width="30">Export to CSV1</a></div>
								<div style="display:block;" id="exportnew">
								<a class="button" id="top" href="javascript:void(0);" onclick="tool(this);return ExcellentExport.excel(this,'exporttable'); "><img src="img/CSV.png" align="middle" height="30" width="30">Export to CSV</a></div>
							</td>
	        		 	</tr>
	         			<tr >
							<td colspan="11"> 		
	 							<input type=submit name="submit1" value="Submit"> 
							</td>
						</tr>
	         		</table>
					
	      		</div>	  
				<br/>
			<div class="report_view" id="mgrid" >
			<table id="exporttable" border="0" cellpadding="2" cellspacing="0" class="grid-table">
			 	{section name=I loop=$table}
			 		{$table[I]}
				{/section}
				{section name=A loop=$table2}
					{$table2[A]}
				{/section}
			</table>
			</div>
			</form>
		 </div>
	</div>
</div>	
</body>
</html>
