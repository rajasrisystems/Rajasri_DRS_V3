<?php 
	include 'includes/common.php';
	include_once "includes/classes/class.index.php";
	$objdrop = new Login();
	$objdrop->deleterow($_REQUEST['Del_Id']);
	$objSmarty->display("pagetemplate.tpl");
?>



