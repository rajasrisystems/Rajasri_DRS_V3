<?php 
	include 'includes/common.php';
	include_once "includes/classes/class.admin.php";
	$objAdmin = new Admin();
	if(isset($_REQUEST['hdAction']) && $_REQUEST['hdAction']!='')
	{
		$objAdmin -> Admin_newuser();
	}
	if($_REQUEST['updateAction']=='1')
	{
		$objAdmin->Admin_updateuser($_REQUEST['AdminID']);
	}
	if($_REQUEST['Ad_Id']!='')
	{
		$objAdmin->getAdminbyId($_REQUEST['Ad_Id']);
	}
	$objAdmin->show_adminuser();
	$objSmarty->assign('objReport',$objAdmin);
	$objSmarty->assign('activePage',"5");
	$objSmarty->assign('IncludeTpl',"admin.tpl");
	$objSmarty->display("pagetemplate.tpl");
?>
