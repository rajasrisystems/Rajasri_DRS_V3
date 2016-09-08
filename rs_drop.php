<?php

	include 'includes/common.php';
	include_once "includes/classes/class.resource.php";
	$objResource = new Resource();
	$objResource->del_rsusers($_REQUEST['Del_Id']);
	$objSmarty->display("pagetemplate.tpl");
?>

