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
	// all dept res
	function getalldepres()
	{
		global $objSmarty,$config;
		$getmon = date(m);
		$monthName = date("F", mktime(0, 0, 0, $getmon, 10));
		$getyr  = date(Y);
		$date=$getmon.'/'.$getyr;
	
		//$select="select * from rating r,resource re where date_format(r.RatingDate, '%m/%Y')='".$date."' and re.ID=r.ResourceID group by r.ResourceID";
		//$result=mysql_query($select);
		//$num=mysql_num_rows($result);
		$newselect = "select * from resource";
		$resultnew=mysql_query($newselect);
		$c=1;
		$associativeArray = array();
		
		$table[]='<tr >
				<tr style="display:none;"><td>Period</td><td>'.$monthName.'-'.$getyr.'</td></tr>
				<th>Resource</th>
				<th>Beginning Rate</th>
				<th>End Rate</th>
			</tr>';
			while($rows=mysql_fetch_array($resultnew))
			{
				$ResourceID	=$rows['ID'];
				$CodeID 	=$rows['CodeID'];
				$firstDate=$getyr.'-'.$getmon.'-01';
				$previousmonth=date('m/Y', strtotime($firstDate . ' -1 month'));
				$rat_date=explode("/", $previousmonth);
				$month_days=cal_days_in_month(CAL_GREGORIAN, $rat_date[0], $rat_date[1]);
				$prepoints=$month_days*50; 
				$nprepoints=$day*50; 
				/******************************** Beggining rate calculation**************************************/
				$result_date= "SELECT * FROM rating where date_format(RatingDate, '%m/%Y')='".$previousmonth."' and ResourceID='$ResourceID'";
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
				else 
				{
					$begin_points=50;
				}
				if($points != '')
				{
					$tot= ($points + $prepoints)/$month_days;
					$begin_points=(round($tot,2));
					$objSmarty->assign('begin_points',$begin_points);
				}
				else
				{
					$begin_points=50;
				}
				/********************************  Beggining rate calculation**************************************/
				/********************************  End rate calculation**************************************/
				$ppoints=0;
				$day = date("d");  // current date
				$montht = date("m"); // current month
				$nnprepoints=$day * $begin_points;
				$firstDate=$getyr.'-'.$getmon.'-01';
				$previousmonth=date('m/Y', strtotime($firstDate . ' -1 month'));
				$rat_date=explode("/", $previousmonth);
				$month_days=cal_days_in_month(CAL_GREGORIAN, $rat_date[0], $rat_date[1]);
				$prepoints=$month_days*50; 
				$presult_date= "SELECT * FROM rating where date_format(RatingDate, '%m/%Y')='".$date."' and ResourceID='$ResourceID'";
				$pexequery=mysql_query($presult_date);
				$pnum_rows=mysql_num_rows($pexequery);
				if($pnum_rows>0)
				{
					while($prow2=mysql_fetch_array($pexequery)){
						$psql = "SELECT * FROM code where ID='".$prow2['CodeID']."'";
						$pgetexe = $this->ExecuteQuery($psql, "select");
						$ppoints+= $pgetexe[0]['Points'];
					}
				}
				else
				{
					$end_points=50;
				}
				if($ppoints != '')
				{
					if($getmon == $montht)
					{
					$ptot= ($ppoints + $nnprepoints)/$day;
					$end_points=(round($ptot,2));		
					}	
					else
					{
					$ptot= ($ppoints + $prepoints)/$month_days;
					$end_points=(round($ptot,2));					
					}
				}
				else
				{
					$end_points=50;
				}
				/******************************** End rate calculation**************************************/
				
				$c++;
				
				$iniarr = $rows['ResourceInitial'];
				$begarr =$begin_points;
				$endarr =$end_points;
				
				$table[]='<tr>
						<td>'.$rows['ResourceInitial'].'</td>
						<td>'.$begin_points.'</td>
				 		<td>'.$end_points.'</td>
				 </tr>';
			}
				$objSmarty->assign('table',$table);
		
	}
	//all resource report
	
	function getallres()
	{
	global $objSmarty,$config;
	$getmon = $_REQUEST['month'];
	$monthName = date("F", mktime(0, 0, 0, $getmon, 10));
	$getyr  = $_REQUEST['year'];
	$getdepart = $_REQUEST['department'];
	//$currentmon = date(m);	
	//$currentyear = date(m);	
	$testdate = "06/2016";	
	$date=$getmon.'/'.$getyr;
	if($getdepart == 0)
	{
		$select="select * from resource";
	}
	else 
	{
		$select="select * from resource where DepartmentId ='".$getdepart."'";
	}
	$result=mysql_query($select);
	$num=mysql_num_rows($result);
	$c=1;
	$associativeArray = array();
	if($num!='' && $date >= $testdate){
		$table[]='<tr >
				<tr style="display:none;"><td>Period</td><td>'.$monthName.'-'.$getyr.'</td></tr>
				<tr style="display:none;"><td>Department</td><td>'.$this->getdepartnamebyId($getdepart).'</td></tr>
				<tr style="display:none;"></tr>
				<th>Resource</th>
				<th>Beginning Rate</th>
				<th>End Rate</th>
			</tr>';
		while($rows=mysql_fetch_array($result)){
			$ResourceID	=$rows['ID'];
			$CodeID 	=$rows['CodeID'];
			$firstDate=$getyr.'-'.$getmon.'-01';
			$previousmonth=date('m/Y', strtotime($firstDate . ' -1 month'));
			$rat_date=explode("/", $previousmonth);
			$month_days=cal_days_in_month(CAL_GREGORIAN, $rat_date[0], $rat_date[1]);
			$prepoints=$month_days*50; 
			$nprepoints=$day*50; 
			/******************************** Beggining rate calculation**************************************/
			$result_date= "SELECT * FROM rating where date_format(RatingDate, '%m/%Y')='".$previousmonth."' and ResourceID='$ResourceID'";
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
				$objSmarty->assign('begin_points',$begin_points);
			}
			else
			{
				$begin_points=50;
			}
			/********************************  Beggining rate calculation**************************************/
			/********************************  End rate calculation**************************************/
			$ppoints=0;
			$day = date("d");  // current date
			$montht = date("m"); // current month
			$nnprepoints=$day * $begin_points;
			$firstDate=$getyr.'-'.$getmon.'-01';
			$previousmonth=date('m/Y', strtotime($firstDate . ' -1 month'));
			$rat_date=explode("/", $previousmonth);
			$month_days=cal_days_in_month(CAL_GREGORIAN, $rat_date[0], $rat_date[1]);
			$prepoints=$month_days*50; 
			$presult_date= "SELECT * FROM rating where date_format(RatingDate, '%m/%Y')='".$date."' and ResourceID='$ResourceID'";
			$pexequery=mysql_query($presult_date);
			$pnum_rows=mysql_num_rows($pexequery);
			if($pnum_rows>0)
			{
				while($prow2=mysql_fetch_array($pexequery)){
					$psql = "SELECT * FROM code where ID='".$prow2['CodeID']."'";
					$pgetexe = $this->ExecuteQuery($psql, "select");
					$ppoints+= $pgetexe[0]['Points'];
				}
			}
			if($ppoints != '')
			{
				if($getmon == $montht)
				{
				$ptot= ($ppoints + $nnprepoints)/$day;
				$end_points=(round($ptot,2));		
				}	
				else
				{
				$ptot= ($ppoints + $prepoints)/$month_days;
				$end_points=(round($ptot,2));					
				}
			}
			else
			{
				$end_points=50;
			}
			/******************************** End rate calculation**************************************/
			
			$c++;
			
			$iniarr = $rows['ResourceInitial'];
			$begarr =$begin_points;
			$endarr =$end_points;
			
			$table[]='<tr>
					<td>'.$rows['ResourceInitial'].'</td>
					<td>'.$begin_points.'</td>
			 		<td>'.$end_points.'</td>
			 </tr>';
		}
			$objSmarty->assign('table',$table);
		}
		else
		{
			$table[]='<tr >
				<tr style="display:none;"><td>Period</td><td>'.$monthName.'-'.$getyr.'</td></tr>
				<th>Resource</th>
				<th>Beginning Rate</th>
				<th>End Rate</th>
			</tr>';
			$table[]='<tr>
						<td colspan="3"> No records found</td>
						
				 </tr>';
			$objSmarty->assign('table',$table);
		}
	}
		
	// Individual data

	function getindres()
	{
		global $objSmarty,$config;
		$getdepart = $_REQUEST['department'];	
		$getmon = $_REQUEST['month'];
		$monthName = date("F", mktime(0, 0, 0, $getmon, 10));
		$getyr  = $_REQUEST['year'];
		$getini = $_REQUEST['newresid'];
		$iniquery=$_REQUEST['optionname'];
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
		$table[]='<tr >
		<tr style="display:none;"><td>Period</td><td>'.$monthName.'-'.$getyr.'</td></tr>
		<tr style="display:none;"><td>Department</td><td>'.$this->getdepartnamebyId($getdepart).'</td></tr>
		<tr style="display:none;"><td> Resource:</td><td>'.$iniquery.'</td></tr>
		<tr style="display:none;"><td> Beginning Rate</td><td>'.$this->getb($getmon,$getini,$getyr).'</td><td> End Rate</td><td>'.$this->gete($getmon,$getini,$getyr).'</td>
		<tr style="display:none;"></tr>
		<tr style="display:none;"></tr>	
				<th>Date</th>
				<th>Change</th>
				<th>Rating</th>
				<th>Notes</th>
				<th>Code</th>
				<th>Manager</th>
			</tr>';
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
					$begin_points=$config['DefaultPoint'];
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
					}
					$newPoint= $begin_points +$change;
					$newcodevar[]=$exe_res[0]['CodeID'];
					
					$pointsArr[]=$newPoint;
					$table[] = '<tr>
						<td>'.date("d/m/Y",strtotime($date)).'</td>
						<td>'.$change.' </td>
						<td>'.$newPoint .'</td>
						<td style="text-align: left;">'.$exe_res[0]['Notes'].'</td>
						<td>'.$this->getcodebyid($exe_res[0]['CodeID']).'</td>
						<td>'.$this->getuserbyId($exe_res[0]['CreatedBy']).'</td>
						</tr>';
				}
				else
				{
				$pointsArr[]=$begin_points;
					
				 $table[]= '<tr>
					<td>'.date("d/m/Y",strtotime($date)).'</td>
					<td>&nbsp;</td>
					<td>'.$begin_points .'</td>
					<td>'.$exe_res[0]['Notes'].'</td>
					<td>'.$this->getcodebyid($exe_res[0]['CodeID']).'</td>
					<td>'.$this->getuserbyId($exe_res[0]['CreatedBy']).'</td>
				</tr>';
				}
			}
		}
		//exit;
		$average=round((array_sum($pointsArr))/$noofdays,2);
		$table2[]='<tr>
					<td colspan="2"><b>Average</b></td>
					<td><b>'.$average.'</b>
					<input type="hidden" text="avg_rate" id="avg_rate" value="'.$average.'">
					<input type="hidden" text="beginpoints" id="beginpoints" value="'.$begin_points.'">
					</td>
					<td> </td>
				</tr>  ';
	
		
		$objSmarty->assign('table',$table);
		$objSmarty->assign('table2',$table2);
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
	function getcodebyid($id)
	{
		global $objSmarty,$config;
		//Get the details from table for edit option
		$tempdisvar= "SELECT * FROM code where ID = ' $id' ";
		$displaydet= $this->ExecuteQuery($tempdisvar, "select");
		//$objSmarty->assign('adminDetails', $displaydet);
		return $displaydet[0]['Code'];
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
					header('Location:report.php?id=1');
				}
				else
				{
					return false;
				}
		        $mail->ClearAddresses();
		    }
	}
	function getdepartnamebyId($id)
	{
		$department = "SELECT * FROM department where ID='".$id."'";
		$getexe = $this->ExecuteQuery($department, "select");
		return $getexe[0]['DepartmentName'];
	}
}
?>
