<?php
include "includes/common.php";
include_once "includes/classes/class.rating.php";
/* all resource */
$objRating = new Rating();
global $config;

echo $SelQuery	= "SELECT * FROM `resource`"
		             ." WHERE  	DepartmentId ='".$_REQUEST['departmentajax']."' order by DepartmentId asc";

	$res=mysql_query($SelQuery);
	$count=mysql_num_rows($res); 
?>
<select id="newresid" name="newresid" style="width: 120px;"">
<option value="0">--Resource--</option>
<?php 
if($count!='0')
{
while($view=mysql_fetch_array($res))
{
?>
<option value="<?php echo $view['ID'];?>"><?php echo $view['ResourceInitial'];?></option>
<?php 
} 


/*echo "hihh"; exit;
if($_REQUEST['term'] != '')
{
	echo $select="select * from resource where DepartmentId = '".$_REQUEST['term']."'";
	$result=mysql_query($select);
	$num=mysql_num_rows($result);
	echo '<select id="resource" name="resource" style="width: 90px;"><option value="">--Select--</option>';
	if($num>0)
	{
		while($rows=mysql_fetch_array($result))
		{
			echo '<option value="'.$rows['ID'].'"> '.$rows['ResourceInitial'].'</option>';
		}
		echo '</select>';
	}
}*/
	
