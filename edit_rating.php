<?php
	include 'includes/common.php';
	include_once "includes/classes/class.index.php";
	$objLogin = new Login();
	
	print_r($_REQUEST);
echo $SelQry = "SELECT * FROM rating r,resource re,code c WHERE r.ResourceID=re.ID and r.CodeID=c.ID 
		and r.RatingID='".$_REQUEST['delvar']."' ";
			
			$ExeQry = $objLogin->ExecuteQuery($SelQry, "select");
			$resultCnt=$objLogin->ExecuteQuery($SelQry, "norows");
			