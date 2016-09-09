<?php 
	include 'includes/common.php';
	include_once "includes/classes/class.code.php";
	$objcode = new Code();
	$objcode->getAllcode();
	if($_REQUEST['Ident']=='1')
	{
		$objcode->insertcode();
	}
	if($_REQUEST[Id]=='1')
	{
		$objcode->getspecificcode($_REQUEST[Code_Id]);
	}
	if($_REQUEST['update_rating']=='1')
	{
		$objcode->Updatecode($_REQUEST[Code_Id]);
	}
	$objSmarty->assign('activePage',"6");
	$objSmarty->assign('IncludeTpl',"code.tpl");
	$objSmarty->display("pagetemplate.tpl");
?>



