<?php 
	include 'includes/common.php';
	include_once "includes/classes/class.code.php";
	$objcode = new Code();
	$objcode->codedelete($_REQUEST['Del_Id']);
	
	$objSmarty->assign('IncludeTpl',"code.tpl");
	$objSmarty->display("pagetemplate.tpl");
?>



