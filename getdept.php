<?php 
	include 'includes/common.php';
	include_once "includes/classes/class.report.php";
	include_once "includes/classes/class.rating.php";
    	$objUser	= new Report();
	echo $SelQuery	= "SELECT * FROM `resource`"
		             ." WHERE  	DepartmentId ='".$_REQUEST['departmentajax']."' order by DepartmentId asc";

	$res=mysql_query($SelQuery);
	$count=mysql_num_rows($res); 
	
?>
<select id="newresid" name="newresid" style="width: 120px;" onchange="return tbl_view();">
<option value="">--Resource--</option>
<?php 
if($count!='0')
{
while($view=mysql_fetch_array($res))
{
?>
<option value="<?php echo $view['ID'];?>"><?php echo $view['ResourceInitial'];?></option>
<?php 
} 
}?>

