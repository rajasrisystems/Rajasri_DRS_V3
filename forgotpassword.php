<?php 
	include 'includes/common.php';
	
	if(isset($_GET['msg']))
    {
        $Message = $_GET['msg'];
        $objSmarty->assign('errorMessage',$Message);
    }
	if(isset($_GET['smsg']))
    {
        $Message = $_GET['smsg'];
        $objSmarty->assign('successMessage',$Message);
    }
	//$objSmarty->assign('IncludeTpl',"forgotpassword.tpl");
	$objSmarty->display("forgotpassword.tpl");
?>
