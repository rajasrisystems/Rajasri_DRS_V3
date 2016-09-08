<?php

	include 'includes/common.php';
	include_once "includes/classes/class.admin.php";
	$objAdmin = new Admin();
	$objAdmin->del_adusers($_REQUEST['Del_Id']);
	$objSmarty->display("pagetemplate.tpl");
?>





