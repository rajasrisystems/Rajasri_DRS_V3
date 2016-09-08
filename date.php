<?php
include 'includes/common.php';
$month='9';
$year='2016';

// calculate number of days in a month
//echo $month == 2 ? ($year % 4 ? 28 : ($year % 100 ? 29 : ($year % 400 ? 28 : 29))) : (($month - 1) % 7 % 2 ? 30 : 31);
$query="select RatingDate from rating";
$exequery=mysql_query($query);
while($res=mysql_fetch_array($exequery))
{
	$date[]=$res['RatingDate'];
	
}
//print_r($date);
echo $count=count($date);
for($i=0;$i<$count;$i++)
{
	$exp=explode('-',$date[$i]);
	print_r($exp[1]);
	$key = array_search('08', $exp);
	print_r($key);
}

?> 

