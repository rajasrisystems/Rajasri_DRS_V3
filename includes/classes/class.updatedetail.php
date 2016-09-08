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
			$assosvar = "SELECT * FROM rating r,resource re,code c WHERE r.ResourceID=re.ID and r.CodeID=c.ID ";
			$userdata=$this->ExecuteQuery($assosvar, "select");
			$objSmarty->assign('userdata', $userdata);
		}
	function updateinfo($iid)
		{
		global $objSmarty,$config;
		$uprdate = $_REQUEST['ratingdate'];
		$upresid = $_REQUEST['resource'];
		$upnotes=$_REQUEST['notes'];	
		$upcodeid= $_REQUEST['code'];	
		$tempvar = " UPDATE rating SET RatingDate= '$uprdate ',
					 ResourceID = '$upresid',
					 CodeID ='(SELECT ID FROM code WHERE Code='$upcodeid')',
					 Notes='$upnotes'  WHERE Id ='$iid'";
		$this->ExecuteQuery($tempvar, "update");
		$objSmarty->assign("upsuccess","Data updated successfully");
		}	
}
?>
