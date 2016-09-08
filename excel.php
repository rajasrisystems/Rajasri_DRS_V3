<?php
include "includes/common.php";
include_once "includes/classes/class.report.php";

$objReport = new Report();
global $config;

	$getyr  = $_REQUEST['year'];
	$getini = $_REQUEST['newresid']; // resource id
	$iniquery=$_REQUEST['optionname']; // resource initial
	$departmentname = $_REQUEST['deptname'];	//department name
	$getdepart = $_REQUEST['department']; //department id
	$getmon = $_REQUEST['month'];
	$monthName = date("F", mktime(0, 0, 0, $getmon, 10)); // month no to  name 
	$givendate=$getmon.'/'.$getyr; 
	
	/********CSV********************/
	$csvFile="Daily Rating System Report\n";

	$filename="download/Report-".$iniquery."-(".$departmentname.")-".$monthName."-".$getyr."-".time().".csv";
	
	$output = fopen($filename, 'w');
	
		
	$csvFile.='Period,'.$monthName.','.$getyr."\n";
	
	$csvFile.='Resource,'.$iniquery."\n";
	


	/********CSV********************/
/********beg and end points********************/
	$fstDate=$getyr.'-'.$getmon.'-01';
	$ddate =date('Y-m-d', strtotime($fstDate . ' -1 month'));
	$nOfDays=cal_days_in_month(CAL_GREGORIAN, $getmon, $getyr);
	$lastDate=date("Y-m-t", strtotime($fstDate));
	$ddate=$fstDate;
	$dateArr[]=$ddate;
	for($i=1;$i<$nOfDays;$i++)
	{
		$ddate=date('Y-m-d', strtotime($ddate . ' +1 day'));
		$dateArr[]=$ddate;
	}

	$c=0;
	$today=date('Y-m-d');
	$onlydate=date('d');
	$nnprepoints = $onlydate * $begin_points;
	$noofdays = 0;

	foreach($dateArr as $ddate)
	{
		if($ddate <= $today)
		{
			$noofdays++;	
			$select_res="select * from rating where ResourceID='".$getini."' and RatingDate='".$ddate."' order by RatingDate desc";
			$exe_res=$objReport->ExecuteQuery($select_res, "select");
			$count_res=$objReport->ExecuteQuery($select_res, "norows");
			/******************************** For Previous Month**************************************/	
			$CodeID =$rows['CodeID'];			
			$previousmonth=date('m/Y', strtotime($fstDate . ' -1 month'));
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
					$getexe = $objReport->ExecuteQuery($sql, "select");
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
			if($count_res > 0)
			{
			$mulvar="select * from rating where ResourceID='".$getini."' and RatingDate='".$ddate."' order by RatingDate desc";
			$mulquery=mysql_query($mulvar);
			$num_rows=mysql_num_rows($mulquery);
			while($mulrow=mysql_fetch_array($mulquery))
				{
				$mulcode=$mulrow['CodeID'];
				$mulselect="select * from code where ID='".$mulcode."'";
				$multiple=$objReport->ExecuteQuery($mulselect, "select");
				$change +=$multiple[0]['Points'];
				
				}
				$newPoint= $begin_points +$change;
				$newcodevar[]=$exe_res[0]['CodeID'];
				$pointArr[]=$newPoint;
				$maildate = date("d/m/Y",strtotime($date));
				$mailnotes = $exe_res[0]['Notes'];
				$mailcreate = $objReport->getuserbyId($exe_res[0]['CreatedBy']);
				
			}
			else
			{
				$ch=($change!=0)?$change:"";
				$pointArr[]=$begin_points;
				$maildate = date("d/m/Y",strtotime($ddate));
				$mailnotes = $exe_res[0]['Notes'];
				$mailcreate = $objReport->getuserbyId($exe_res[0]['CreatedBy']);
				//csv				
				
			}
		}
	}
	$average=round((array_sum($pointArr))/$noofdays,2);


/********beg and end points********************/

	$csvFile.='Beginning Rate,'.$begin_points.',End Rate,'.$average."\n";
	$csvFile.="Date,Change,Rating,Notes,Manager\n"; 
	
	$firstDate=$getyr.'-'.$getmon.'-01';
	$date =date('Y-m-d', strtotime($firstDate . ' -1 month'));
	$nOfDays=cal_days_in_month(CAL_GREGORIAN, $getmon, $getyr);
	$lastDate=date("Y-m-t", strtotime($firstDate));
	$date=$firstDate;
	$datesArr[]=$date;
	for($i=1;$i<$nOfDays;$i++){
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
			$exe_res=$objReport->ExecuteQuery($select_res, "select");
			$count_res=$objReport->ExecuteQuery($select_res, "norows");
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
				while($row2=mysql_fetch_array($exequery))
				{
					$sql = "SELECT * FROM code where ID='".$row2['CodeID']."'";
					$getexe = $objReport->ExecuteQuery($sql, "select");
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
			if($count_res > 0)
			{
			$mulvar="select * from rating where ResourceID='".$getini."' and RatingDate='".$date."' order by RatingDate desc";
			$mulquery=mysql_query($mulvar);
			$num_rows=mysql_num_rows($mulquery);
			while($mulrow=mysql_fetch_array($mulquery))
				{
				$mulcode=$mulrow['CodeID'];
				$mulselect="select * from code where ID='".$mulcode."'";
				$multiple=$objReport->ExecuteQuery($mulselect, "select");
				$change +=$multiple[0]['Points'];
				
				}
			$newPoint= $begin_points +$change;
				$newcodevar[]=$exe_res[0]['CodeID'];
				$pointsArr[]=$newPoint;
				$maildate = date("d/m/Y",strtotime($date));
				$mailnotes = $exe_res[0]['Notes'];
				$mailcreate = $objReport->getuserbyId($exe_res[0]['CreatedBy']);
				//csv
				$csvFile .= $maildate.','.$change.','.$newPoint.','.$mailnotes.','.$mailcreate."\n";
			}
			else
			{
				$ch=($change!=0)?$change:"";
				$pointsArr[]=$begin_points;
				$maildate = date("d/m/Y",strtotime($date));
				$mailnotes = $exe_res[0]['Notes'];
				$mailcreate = $objReport->getuserbyId($exe_res[0]['CreatedBy']);
				//csv				
				$csvFile .= $maildate.','.$ch.','.$begin_points.','.$mailnotes.','.$mailcreate."\n";
				
			}
		}
	}
	$average=round((array_sum($pointsArr))/$noofdays,2);
	$ch=($average!=0)?$change:"";
	$csvFile .= "\n Average,\t,".$average."\n";

fputs($output, $csvFile);
fclose($output);
$objReport->getmailid($getini,$filename);
?>
