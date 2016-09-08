<?php 
class Report extends MysqlFns
{
	function Report()
		{
		global $config;
        	$this->MysqlFns();
		$this->Offset			= 0;
		$this->Limit			= 15;
		$this->page				= 0;
		$this->Keyword			= '';
		$this->Operator			= '';
		$this->PerPage			= '';
		}
	// All resources
	function allresource()
	{
		global $objSmarty;
		$getmon = $_REQUEST['month'];
		$getyr  = $_REQUEST['year'];
		
		$date=$getmon.'/'.$getyr;
		$select="select * from rating r,resource re where date_format(r.RatingDate, '%m/%Y')='".$date."' and re.ID=r.ResourceID group by r.ResourceID";
		$exeresource = $this->ExecuteQuery($select,"select");
		$objSmarty->assign('resdata',$exeresource);
			
	}
	function oneresource()
	{
		global $objSmarty;
		$getmon = $_REQUEST['month'];
		$getyr  = $_REQUEST['year'];
		$getini = $_REQUEST['newresid'];
		
		$date=$getmon.'/'.$getyr;
		$select="select * from rating where ResourceID='".$getini."' and date_format(RatingDate, '%m/%Y')='".$date."'";
		$exeresource = $this->ExecuteQuery($select,"select");
		$objSmarty->assign('oneresdata',$exeresource);
	
	}
	function getuserbyId($id)
	{
		global $objSmarty,$config;
		//Get the details from table for edit option
		$tempdisvar= "SELECT * FROM admin where ID= ' $id' ";
		$displaydet= $this->ExecuteQuery($tempdisvar, "select");
		//$objSmarty->assign('adminDetails', $displaydet);
		return $displaydet[0]['Username'];
	}
	function getb($m,$i,$y)
	{
		global $objSmarty,$config;
		$getyr  =$y ;
		$getmon =$m;
		$getini = $i;
		$firstDate=$getyr.'-'.$getmon.'-01';
		$date=date('Y-m-d', strtotime($firstDate . ' -1 month'));
		$numberOfDays=cal_days_in_month(CAL_GREGORIAN, $getmon, $getyr);
		$lastDate=date("Y-m-t", strtotime($firstDate));
		$date=$firstDate;
		$datesArr[]=$date;
		for($i=1;$i<$numberOfDays;$i++)
		{
			$date=date('Y-m-d', strtotime($date . ' +1 day'));
			$datesArr[]=$date;
		}
		$c=0;
		$today=date('Y-m-d');
		$onlydate=date('d');
		$nnprepoints = $onlydate * $begin_points;
		$noofdays = 0;
		foreach($datesArr as $date)
			{
			if($date <= $today)
			{
				$noofdays++;	
				$select_res="select * from rating where ResourceID='".$getini."' and RatingDate='".$date."' order by RatingDate desc";
				$exe_res=$this->ExecuteQuery($select_res, "select");
				$count_res=$this->ExecuteQuery($select_res, "norows");
				$CodeID =$rows['CodeID'];			
				$previousmonth=date('m/Y', strtotime($firstDate . ' -1 month'));
				$rat_date=explode("/", $previousmonth);
				$month_days=cal_days_in_month(CAL_GREGORIAN, $rat_date[0], $rat_date[1]);
				$day = date("d");  // current date
				$prepoints=$month_days*50; // prev month
				$nprepoints=$day*50; // cur month
				$result_date= "SELECT * FROM rating where date_format(RatingDate, '%m/%Y')='".$previousmonth."' and ResourceID='$getini'";
				$exequery=mysql_query($result_date);
				$num_rows=mysql_num_rows($exequery);
				$points=0;
				if($num_rows>0)
				{
					while($row2=mysql_fetch_array($exequery))
					{
						$sql = "SELECT * FROM code where ID='".$row2['CodeID']."'";
						$getexe = $this->ExecuteQuery($sql, "select");
						$points+= $getexe[0]['Points'];
					}
				}
				if($points != '')
				{
					$tot= ($points + $prepoints)/$month_days;
					return $begin_points=(round($tot,2));
				}
				else
				{
					return $begin_points=50;
				}
			}
			}
	}	
	function gete($m,$i,$y)
	{
	$getmon = $m;
	$getyr  = $y;
	$getini = $i;
	$firstDate=$getyr.'-'.$getmon.'-01';
	$date=date('Y-m-d', strtotime($firstDate . ' -1 month'));
	$numberOfDays=cal_days_in_month(CAL_GREGORIAN, $getmon, $getyr);
	$lastDate=date("Y-m-t", strtotime($firstDate));
	$date=$firstDate;
	$datesArr[]=$date;
	for($i=1;$i<$numberOfDays;$i++){
		$date=date('Y-m-d', strtotime($date . ' +1 day'));

		$datesArr[]=$date;
	}
	$c=0;
	$today=date('Y-m-d');
	$onlydate=date('d');
	$nnprepoints = $onlydate * $begin_points;
	$noofdays = 0;
	foreach($datesArr as $date){
		if($date <= $today){
			$noofdays++;	
			$select_res="select * from rating where ResourceID='".$getini."' and RatingDate='".$date."' order by RatingDate desc";
			$exe_res=$this->ExecuteQuery($select_res, "select");
			$count_res=$this->ExecuteQuery($select_res, "norows");
			/******************************** For Previous Month**************************************/	
			$CodeID =$rows['CodeID'];			
			$previousmonth=date('m/Y', strtotime($firstDate . ' -1 month'));
			$rat_date=explode("/", $previousmonth);
			$month_days=cal_days_in_month(CAL_GREGORIAN, $rat_date[0], $rat_date[1]);
			$day = date("d");  // current date
			$prepoints=$month_days*50; // prev month
			$nprepoints=$day*50; // cur month
			$result_date= "SELECT * FROM rating where date_format(RatingDate, '%m/%Y')='".$previousmonth."' and ResourceID='$getini'";
			$exequery=mysql_query($result_date);
			$num_rows=mysql_num_rows($exequery);
			$points=0;
			if($num_rows>0)
			{
				while($row2=mysql_fetch_array($exequery)){
					$sql = "SELECT * FROM code where ID='".$row2['CodeID']."'";
					$getexe = $this->ExecuteQuery($sql, "select");
					$points+= $getexe[0]['Points'];
				}
			}
			if($points != '')
			{
				$tot= ($points + $prepoints)/$month_days;
				$begin_points=(round($tot,2));
			}
			else
			{
				$begin_points=50;
			}
			/******************************** For Previous Month**************************************/
			$change=0;
			if($count_res > 0){
			$mulvar="select * from rating where ResourceID='".$getini."' and RatingDate='".$date."' order by RatingDate desc";
			$mulquery=mysql_query($mulvar);
			$num_rows=mysql_num_rows($mulquery);
			while($mulrow=mysql_fetch_array($mulquery)){
					$mulcode=$mulrow['CodeID'];
					$mulselect="select * from code where ID='".$mulcode."'";
				$multiple=$this->ExecuteQuery($mulselect, "select");
				$change +=$multiple[0]['Points'];
				$newPoint= $begin_points +$change;
				}
				$newcodevar[]=$exe_res[0]['CodeID'];
				$pointsArr[]=$newPoint;
			}else{
				$pointsArr[]=$begin_points;
			}
		}
	}
	return $average=round((array_sum($pointsArr))/$noofdays,2);
	}
	function getmailid($id, $nid)
	{
		//$selectedid = $_REQUEST['newresid'];
		$iselect="select Email from resource where ID='".$id."'";
		$idresource = $this->ExecuteQuery($iselect,"select");
		$to_email = $idresource[0]['Email']; // send email id 
		$filepath =  $_SERVER['DOCUMENT_ROOT']."/rajasri_DRS/$nid"; 
		$mailmonth = $_REQUEST['month'];
		$monthName = date("F", mktime(0, 0, 0, $mailmonth, 10));
		$mailyear = $_REQUEST['year'];
		$iniquery=$_REQUEST['optionname'];
		$mail_sendlink=$this->sendmail($monthName,$mailyear,$to_email,$filepath,$iniquery);
	}
	function sendmail($monthName,$mailyr,$to_email,$file,$iniquery)
    	{
		if($to_email!="")
           	 {
                $Recipiant = $to_email;
                $subject="Daily Ratings for the month of ".$monthName."-".$mailyr."";
                $Sender="hr@rajasri.net";
                $host= $config['Email_Host'];                               // sets GMAIL as the SMTP server
                $port=$config['Email_Port'];                             // set the SMTP port for the GMAIL server
                $username=$config['Email_Username'];                   // GMAIL username
                $pwd=$config['Email_Password'];

                include $_SERVER['DOCUMENT_ROOT'].'/rajasri_DRS/phpmailer/class.phpmailer.php';
                $mail = new PHPMailer();
                $mail->IsSMTP();
                $mail->IsMail();
                $mail->SMTPAuth   = true;                  // enable SMTP authentication
                $mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
                $mail->Host       = $host;      // sets GMAIL as the SMTP server
                $mail->Port       = $port;                   // set the SMTP port for the GMAIL server
                $mail->Username   = $username;  // GMAIL username
                $mail->Password   = $pwd;            // GMAIL password
                $mail->AddReplyTo($Sender,"");
                $mail->From       = "hr@rajasri.net";
                $mail->FromName   = "Rajasri";
                $mail->Sender      = $Sender;
                $mail->Subject    = $subject;
                if($file!="")
		{
                   $mail->AddAttachment($file); // attach files
                }
		$mail->Body = $iniquery.",\n\nPlease find your ratings for the month ".$monthName."-".$mailyr." in the attached file.";
                $mail->AddAddress("$Recipiant","");
                if($mail->Send()) 
		{
			header('Location: report.php?id=1');
		}
		else
		{
			return false;
		}
                $mail->ClearAddresses();
           	 }
	}
}
?>
