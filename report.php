<?php 
	include 'includes/common.php';
	include_once "includes/classes/class.index.php";
	include_once "includes/classes/class.report.php";
	ob_start();
	$objLogin = new Login();
	$objLogin->chklogin();
	
	$objReport = new Report();
	//Get department values
	$objReport->getalldepres();
	
	$depvar = "SELECT * FROM department order by Id asc";
	$depresult = mysql_query($depvar) OR die(mysql_error());
	while($rrow = mysql_fetch_assoc($depresult))
		{
			$depdata[] = $rrow; // store in array	
		}
	$objSmarty->assign('depdata', $depdata);
	
	$SelQuery	= "SELECT ID,DepartmentId,ResourceInitial FROM `resource`"
		             ." WHERE  	DepartmentId ='".$_REQUEST['department']."' order by ResourceInitial asc";

	$res=mysql_query($SelQuery);
	
	while($view=mysql_fetch_array($res))
		{
			$getresdep[] = $view;	
		}
	$objSmarty->assign('getresdep', $getresdep);
	
	// Fetching month and year from rating database to create an array for drop down : Sep 29, 2016 (MA)
	$yearselect = "select RatingDate from rating ";
	$yearres = mysql_query($yearselect);
	while($yearview=mysql_fetch_array($yearres))
		{
			$str=$yearview;
			$exp=explode("-",$str[0]);
			$input[] = $exp[0];
			$year_array = array_unique($input);
			//$monthName[] = date("F", mktime(0, 0, 0, $exp[1], 10));
			//$month_array = array_unique($monthName);
		}
		//print_r( array_flip($monthnum_array));
	$months = array('01'=>"January", '02'=>"February", '03'=>"March", '04'=>"April", '05'=>"May", '06'=>"June", 
		'07'=>"July", '08'=>"August", '09'=>"September", '10'=>"October", '11'=>"November", '12'=>"December");
	//$year = array('1'=>"2016", '2'=>"2017", '3'=>"2018", '4'=>"2019", '5'=>"2020", '6'=>"2021",
	// '7'=>"2022", '8'=>"2023", '9'=>"2024", '10'=>"2025", '11'=>"2026", '12'=>"2027",'13'=>"2028",'14'=>"2029",'15'=>"2030");
	$objSmarty->assign('year',$year_array);
	$objSmarty->assign('months',$months);
	// code ends here : Sep 29, 2016 (MA)
	$objSmarty->assign('currentMonth', date('m'));
	$objSmarty->assign('currentYear', date('Y'));
	// code to change month and year 
	if($_REQUEST['month'] && $_REQUEST['year'] != '') 
	{
	$objSmarty->assign('currentMonth',$_REQUEST['month']);
	$objSmarty->assign('currentYear', $_REQUEST['year']);	
	}
	// check whether individual or all 
	if($_REQUEST['getreshid'] == '1')
	{
		$objReport->getallres();
	}
	elseif($_REQUEST['getreshid'] == '2')
	{
		$objLogin->getresourcebydept($_REQUEST['department']);
		$objReport->getindres();
	}
	$objSmarty->assign('activePage',"3");
	$objSmarty->assign('IncludeTpl',"report.tpl");
	$objSmarty->display("pagetemplate.tpl");
?>



