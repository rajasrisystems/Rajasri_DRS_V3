<?php 
	include 'includes/common.php';
	include_once "includes/classes/class.rating.php";
	include_once "includes/classes/class.index.php";
	$objRating = new Rating();
	$objLogin = new Login();
	$objLogin->chklogin();
	$objSmarty->assign('activePage',"2");
	if($_REQUEST['Hitaction']=='1')
	{
		$objRating->insertdetails();
		$objRating->display();
	}
	if($_REQUEST['update_rating']=='1')
	{
		$objLogin->Update_rating($_REQUEST['Rat_Id']);
	}
	if($_REQUEST['Rat_Id']!='')
	{
		$objLogin->get_RatingID($_REQUEST['Rat_Id']);
	}
	//objRating is in class.rating.php file
	//to display the records in the page
	$current_date=date('d/m/Y');
	$objRating->display();
	$objRating->getAllDepartment();
	$objRating->getAllResources();
	$objSmarty->assign('objRating', $objRating);
	$objSmarty->assign('current_date', $current_date);	
	$objSmarty->assign('IncludeTpl',"rating.tpl");
	$objSmarty->display("pagetemplate.tpl");
?>



