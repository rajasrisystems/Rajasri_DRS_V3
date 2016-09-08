<?php 
/*   Global Variables   */

##############################

	$config['SiteGlobalPath']			= "http://192.168.1.54/Rajasri_DRS/";

	$config['SiteLocalPath']			= $_SERVER['DOCUMENT_ROOT']."/Rajasri_DRS/";

	$config['SiteClassPath']			= $_SERVER['DOCUMENT_ROOT']."/Rajasri_DRS/includes/classes/";

	$config['SiteTemplatesPath']			= $config['SiteLocalPath']."templates/";

	$config['SiteTemplatesHeader']			= $config['SiteTemplatesPath']."header.tpl";

	$config['SiteTemplatesFooter']			= $config['SiteTemplatesPath']."footer.tpl";

 
/*   Global Site Variables   */

##############################

	$config['SiteTitle']	  	= "Rajasri DRS";

	$config['SiteMail']		= "";

	$config['AdminMail']		= "";

/*local	Database Settings	*/

##############################



	$config['DBHostName']	= "localhost";

	$config['DBUserName']	= "root";

	$config['DBPassword']	= "";

	$config['DBName']	= "rajasri_drs";
	
	
    $config['Email_Host']= "smtp.gmail.com";
	$config['Email_Port']="465";
	$config['Email_Username']="businessdev@rajasri.net";
	$config['Email_Password']="18rajasri";
/*	Page Navigation Settings	*/

##############################

	$config['Limit'] = 20;	

/* Setting some necessary values Here */

	#######################################

	$config['today']=date('Y-m-d');
	
	$config['HoursInGMT'] = "-6";
	$config['MinutesInGMT'] = "0";

/* Setting some necessary values Here */
	
/* Default points*/
	
	$config['DefaultPoint']=50;
	
	#######################################
?>
