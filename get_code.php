<?php
	include "includes/common.php";
	if ( !isset($_REQUEST['term']) )
	exit;
	$query = 'SELECT Code as cd, 
			 Description as ds FROM code where Code like "%'.mysql_real_escape_string($_REQUEST['term']).'%" OR 
			 Description like "%'.mysql_real_escape_string($_REQUEST['term']).'%" ORDER BY ID ASC';
	$rs = mysql_query($query); 
	
	// "%'.mysql_real_escape_string($_REQUEST['term']).'%" ---> If the '%' is in the starting point it doesnt care about starting or before '%'. 
	// It displays the specified keyword after the '%' symbol
	
	$data = array();
	if ( $rs && mysql_num_rows($rs) )
		{
			while( $row = mysql_fetch_array($rs, MYSQL_ASSOC) )
			{		
				$row['value'] = "{$row['cd']}"; 
				$row['label'] = "{$row['cd']} - {$row['ds']}";
				//return $row['cd']."@@@".$row['ds'];
			    $matches[] = $row ; 	
			}
		}	
		
	// jQuery wants JSON data
	echo json_encode($matches);
	flush();
?>
