<?php 
	include 'includes/common.php';
	include_once "includes/classes/class.index.php";
	$objLogin = new Login();
	$objLogin->chklogin();

	$objSmarty->assign('activePage',"1");
	$objSmarty->assign('IncludeTpl',"controlpanel.tpl");
	$objSmarty->display("pagetemplate.tpl");
?>



