<?php 
	include 'includes/common.php';
	include_once "includes/classes/class.index.php";
	include_once "includes/classes/class.report.php";
	$objLogin = new Login();
	$depvar = "SELECT * FROM department order by Id asc";
	$depresult = mysql_query($depvar) OR die(mysql_error());
	while($rrow = mysql_fetch_assoc($depresult))
		{
			$depdata[] = $rrow; // store in array	
		}
	$objSmarty->assign('depdata', $depdata);
	$months = array('01'=>"January", '02'=>"February", '03'=>"March", '04'=>"April", '05'=>"May", '06'=>"June", 
		'07'=>"July", '08'=>"August", '09'=>"September", '10'=>"October", '11'=>"November", '12'=>"December");
	$year = array('1'=>"2016", '2'=>"2017", '3'=>"2018", '4'=>"2019", '5'=>"2020", '6'=>"2021",
		 '7'=>"2022", '8'=>"2023", '9'=>"2024", '10'=>"2025", '11'=>"2026", '12'=>"2027",'13'=>"2028",'14'=>"2029",'15'=>"2030");
	$objSmarty->assign('year',$year);
	$objSmarty->assign('months',$months);
	$objSmarty->assign('currentMonth', date('m'));
	$objSmarty->assign('currentYear', date('Y'));
	$objLogin->chklogin();
	$objReport = new Report();
	$disvar = "SELECT * FROM resource order by ResourceInitial asc";
	$result = mysql_query($disvar) OR die(mysql_error());
	while($row = mysql_fetch_assoc($result))
		{
			$data[] = $row; // store in array	
		}
	if(isset($_GET["func"]) && $_GET["func"] === "myFunction") 
	{
	  	$email = new PHPMailer();
		$senderid = $_REQUEST['newresid'];
		
		$mailvar = "SELECT Email FROM `resource` WHERE ID = '$senderid' ";
		$depresult = mysql_query($mailvar) OR die(mysql_error());
		//print_r($_REQUEST);
		$email->From      = 'you@example.com';
		$email->FromName  = 'Your Name';
		$email->Subject   = 'Message Subject';
		$email->Body      = $bodytext;
		$email->AddAddress( 'destinationaddress@example.com' );
		$file_to_attach = 'PATH_OF_YOUR_FILE_HERE';
		$email->AddAttachment( $file_to_attach , 'NameOfFile.pdf' );
		return $email->Send();

	}
	$objSmarty->assign('tabresdata', $data);	
	$objSmarty->assign('activePage',"3");
	$objSmarty->assign('IncludeTpl',"report.tpl");
	$objSmarty->display("pagetemplate.tpl");
?>



