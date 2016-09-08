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
function alldepartval()
{
	if(document.getElementById('department').value =="")
	{
		alert('Please select department');
		document.getElementById('department').focus();
		document.getElementById('radio2').checked = false;
		return false;
	}
	else
	{	
		tbl_report();
	}
}

function departval()
{
	if(document.getElementById('department').value =="")
		{
			alert('Please select department');
			document.getElementById('department').focus();
			document.getElementById('radio1').checked = false;
			return false;
		}
	if(document.getElementById('newresid').value=='')
		{
			alert('Please select initial');
			document.getElementById('newresid').focus();
			document.getElementById('radio1').checked = false;
			return false;
		}
		else
		{
		tbl_view();
		return true;
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
			month=document.getElementById('month').value;
			year=document.getElementById('year').value;
			newresid=document.getElementById('newresid').value;
			optionname= document.getElementById('newresid').options[document.getElementById('newresid').selectedIndex].text;
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
		$( "#radio1" ).prop( "checked", true ); /*individual*/
    		document.getElementById("sendmail").style.display = "block";
		}
	}
function tbl_report()
	{
		// All resource 
		if(document.getElementById("radio2").checked==false && document.getElementById("radio1").checked==false)
		{
			return false;	
		}
		else
		{
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
		$( "#radio2" ).prop( "checked", true );	
		}
	}	

function chkResource()
{
		if(document.getElementById("radio2").checked==true)
		{
			tbl_report();
		}
		else
		{
			tbl_view();
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
		<div class="report-page" style="text-align:left;">
		<form action="report.php" name="rptpage" method="post" accept-charset=utf-8>
			<table border="0" cellpadding="0" cellspacing="0" class="grid-table">
				<th colspan="9" style="text-align:left">Reports</th>
				<tr>
				<td colspan="9" style="border-bottom:none;"> <div class="success">{if $smarty.request.id eq 1} Email sent successfully {/if}</div> </td>	
				</tr>
				<tr>
				<div class="Error" align="center" id="errmsg"></div>
				 <td width="10%" nowrap="nowrap" style="border-bottom:none;">Select Month & Year:</td>
				 <td width="16%" style="text-align:left;border-bottom:none;">
					<select id="month" name="month" onchange="tap(this); return chkResource();">
					{foreach key=k item=v from=$months}	
					<option value='{$k}' {if $k eq $currentMonth}selected{/if}>{$v} </option>
 					{/foreach}
					</select>
					<select id="year" name="year" onchange="return chkResource();">	
					{foreach key=yk item=yv from=$year}	
					<option value='{$yv}' {if $yv eq $currentYear}selected{/if}>{$yv} </option>
 					{/foreach}
					</select>
				 </td>
				<td width="5%" nowrap="nowrap" style="text-align:left;border-bottom:none;">Department: <span style="color:red">*</span></td>
				<td style="text-align:left;border-bottom:none;" width="5%"> 
				<select id="department" name="department" style="width: 160px;"  onchange=" tap(this); check_single(); return getresdep(this.value); ">
					<option value="">--Select--</option>
					{foreach item=dept from=$depdata}
					<p>
					<option value='{$dept.Id}' {if $resourceDetails.0.DepartmentId eq $dept.Id} selected="selected" {/if}>
						{$dept.DepartmentName}
					</option>
					</p>
					{/foreach}	
				</select>
				<input type="hidden" name="deptname" id="deptname" value=" ">
				<input type="hidden" name="optionname" id="optionname" value=" ">

				
				</td>
				<input type="hidden" name="dataction" id="dataction">
				<input type="hidden" name="numrec" id="numrec">
				<input type="hidden" name="singlerestemp" id="singlerestemp">
				<td width="5%" nowrap="nowrap" style="text-align:left;border-bottom:none;">Resource:</td>
				<td width="5%"  style="text-align:left;border-bottom:none;">
				<input type ="radio" id="radio2" name = "radio" onclick="alldepartval(); check_all();" value="all"> 
	               		<span style="text-align:left" width="6%"valign="top">All</span>
	            		</td>
              			<td width="18%" style="text-align:left;border-bottom:none;">
				<input type ="radio" id="radio1" name = "radio"  onclick="departval();check_single();" value="sing"> 
	             		<span style="text-align:left;" width="10%" valign="top" nowrap="nowrap" >Individual</span>
	          		<select id="newresid" name="newresid" style="width: 96px;" onchange=" check_single(); tapp(this); return tbl_view(); ">
						<option value="">--Resource--</option>
						<!--  {foreach item=resource from=$tabresdata}
						<option value='{$resource.ID}'>{$resource.ResourceInitial}</option>
						{/foreach}	-->
				</select>   
	           		</td>
               			<!--<td style="text-align:right;"> 

	                	<input type="hidden" id="exportQuery" name="exportQuery" value="">
	                	<input type="hidden" id="reportType" name="reportType" value="Transactions">
				 <button id="exportBtn" download="Report.xls" class="btn btn-lg btn-warning custom-btn-01 hover_effect pull-right pull-right-to-left">Export to CSV</button>
				</td> -->
				
				<td style="text-align:left; display:none;border-bottom:none;" id="sendmail" name="sendmail">
				<a  class="button" id="top"  href="javascript:void(0);" onclick="goExport();"><img src="img/mail_send.png" align="middle" height="30" width="30">Send mail</a>
				</td>
				<input type="hidden" name="resourceinital" id="resourceinital" value=" ">
				<td style="text-align:right;border-bottom:none;">
				<div style="display:block;" id="export">
<a class="button" id="top" href="javascript:void(0);" onclick="tool(this);"><img src="img/CSV.png" align="middle" height="30" width="30">Export to CSV</a></div>
				<div style="display:none;" id="exportnew">
<a class="button" id="top" href="javascript:void(0);" onclick="tool(this);return ExcellentExport.excel(this,'exporttable'); "><img src="img/CSV.png" align="middle" height="30" width="30">Export to CSV</a></div>
				
				</td>
	         		</tr>
	         		<tr>
				<td style="border-bottom:none;">&nbsp;</td>
				</tr>
	         	</table>
		</form>
	      </div>	  
	<br/>
		<input type="hidden" name="sortflag" id="sortflag" value="{$smarty.request.sortflag}">
		<div class="report_view" id="mgrid" >
			<table id="exporttable" border="0" cellpadding="2" cellspacing="0" class="grid-table">
			<tr>
				<th>Resource</th>
				<th>Beginning Rate</th>
				<th>End Rate</th>
			</tr> 
			 <tr><td colspan="5">No records found</td></tr>
			</table>
		</div>
 </div>
</div>
</div>	
</body>
</html>
