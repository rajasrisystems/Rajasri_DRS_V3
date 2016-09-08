<?php
class Update extends MysqlFns
{

	function Update()
		{
		global $config;
        	$this->MysqlFns();
		$this->Offset			= 0;
		$this->Limit			= 15;
		$this->page			= 0;
		$this->Keyword			= '';
		$this->Operator			= '';
		$this->PerPage			= '';
		}
	function fetchdata()
		{
			global $objSmarty,$config;
			$useridass=$_REQUEST['USid'];
			$assosvar = "SELECT * FROM userinfo WHERE Id ='$useridass'";
			$assosres = mysql_query($assosvar) OR die(mysql_error());
			while($rrow = mysql_fetch_assoc($assosres))
				{
					$userdata[] = $rrow;
				}
			$objSmarty->assign('userdata', $userdata);
		}
	function updateinfo($iid)
		{
			global $objSmarty,$config;
			$afirstname = addslashes($_REQUEST['upfname']);
			$alastname  = addslashes($_REQUEST['uplname']);
			$aemail	 = $_REQUEST['upemail'];
			$ausername = addslashes($_REQUEST['upuname']);
			$apassword = $_REQUEST['uppwd'];
			$adob =$_REQUEST['dpic'];
			if($_REQUEST['newimage']!= null)
			{					
			$aimage = $_REQUEST['newimage'];
			}
			else
			{	
			$aimage =$_REQUEST['provar'];
			}			
			$tempvar = " UPDATE userinfo SET Firstname = '$afirstname', 
							      Lastname = '$alastname', 
							      Emailaddress= '$aemail',
							      DateofBirth ='$adob', 
							      Username='$ausername',
							      Password='$apassword',
							      Image ='$aimage'  WHERE Id ='$iid'";
			$this->ExecuteQuery($tempvar, "update");
			header("location:index.php?login=uvalid");
		}	
}
?>
