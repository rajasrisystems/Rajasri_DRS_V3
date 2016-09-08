<?php
include "includes/common.php";
if(isset($_REQUEST['exportQuery']) && $_REQUEST['exportQuery']!=''){
	header("Content-type: text/csv");
	header("Content-disposition:attachment; filename=Rating_".date('d-m-Y').".csv");

	$csvFile=array('Member Name',
				'Card Number',
				'Merchant Name',
				'Branch Name',
				'Transaction Type',
				'Amount',
				'Points',
				'Created Date');

	$output = fopen('php://output', 'w');
	fputcsv($output, $csvFile,';');
	$query=$_REQUEST['exportQuery'];
	$exeCount=mysql_query($query);
	while ($row=mysql_fetch_array($exeCount)) {

		$memberName=$row['FirstName'].' '.$row['LastName'];
		$cardNumber="'".$row['CardNumber'];
		$merchantName=$row['CompanyName'];
		$branchName=$row['BranchName'];
		$trans=$row['TransactionType'];
		if($trans=='0'){
			$transactionType="Redeemed";
		}else if($trans=='1'){
			$transactionType="Earned";
		}else if($trans=='2'){
			$transactionType="Change Added";
		}else{
			$transactionType="";
		}
		$amount=$row['PreferredCurrency'].' '.$row['Amount'];
		$points=$row['Points'];
		$createdDate=$row['CreatedDate'];

		$csvFile =array(stripslashes($memberName),
		$cardNumber,
		stripslashes($merchantName),
		stripslashes($branchName),
		$transactionType,
		$amount,
		$points,
		$createdDate);
		fputcsv($output, $csvFile,';');
	}

	fclose($output);
}
?>
