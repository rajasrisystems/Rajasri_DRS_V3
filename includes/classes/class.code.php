<?php
class Code extends MysqlFns
{

	function Code()
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
	function insertcode()
	{
		global $objSmarty;
		if($_REQUEST['codeshow']=='1')
		{
		$selcode="select * from code where Code like 'G%' order by ID desc limit 1";
		$ExeSel= mysql_query($selcode);
		$row = mysql_fetch_array($ExeSel);
		$count=$row['Code'];
		$a = "INSERT INTO code(Code,
					 Description,
					  Points,
					  codetype) 
				         VALUES 
				      	 ('".++$count."','".$_REQUEST['code']."','".$_REQUEST['points']."','".$_REQUEST['codeshow']."')"; 
		$this->ExecuteQuery($a, "insert");
		header("location:code.php?successmsg=1");// redirecting
		}
		if($_REQUEST['codeshow']=='2')
		{
		$selcode="select * from code where Code like 'B%' order by ID desc limit 1";
		$ExeSel= mysql_query($selcode);
		$row = mysql_fetch_array($ExeSel);
		$count=$row['Code'];
		$a = "INSERT INTO code(Code,
					 Description,
					  Points,
					  codetype) 
				         VALUES 
				      	 ('".++$count."','".$_REQUEST['code']."','".$_REQUEST['points']."','".$_REQUEST['codeshow']."')"; 
		$this->ExecuteQuery($a, "insert");
		header("location:code.php?successmsg=1");// redirecting
		}
	}
	function Updatecode($id)
	{
		global $objSmarty,$config;
		if($_REQUEST['codeshow']=='1')
		{
		$selcode="select * from code where Code like 'G%' order by ID desc limit 1";
		$ExeSel= mysql_query($selcode);
		$row = mysql_fetch_array($ExeSel);
		$count=$row['Code'];
		$tempvar = " UPDATE code SET Code ='".++$count."', 
					 Description = '".$_REQUEST['code']."' ,
					 Points = '".$_REQUEST['points']."',
					 codetype ='".$_REQUEST['codeshow']."'
					 WHERE ID ='$id'";
		$this->ExecuteQuery($tempvar, "update");
		header("location:code.php?successmsg=2");// redirecting
		}
		if($_REQUEST['codeshow']=='2')
		{
		$selcode="select * from code where Code like 'B%' order by ID desc limit 1";
		$ExeSel= mysql_query($selcode);
		$row = mysql_fetch_array($ExeSel);
		$count=$row['Code'];
		$tempvar = " UPDATE code SET Code ='".++$count."', 
					 Description = '".$_REQUEST['code']."' ,
					 Points = '".$_REQUEST['points']."',
					 codetype ='".$_REQUEST['codeshow']."'
					 WHERE ID ='$id'";
		$this->ExecuteQuery($tempvar, "update");
		header("location:code.php?successmsg=2");// redirecting
		}
		/* echo $selcode="select Code from code where ID= '".$id."' ";
		$ExeSel= mysql_query($selcode);
		echo $row = mysql_fetch_array($ExeSel);
		exit;
		$codeid =$row;
		$tempvar = " UPDATE code SET  Description = '".$_REQUEST['code']."' ,
					 Points = '".$_REQUEST['points']."'
					 WHERE ID ='$id'";
		$this->ExecuteQuery($tempvar, "update");
		header("location:code.php?successmsg=2");*/
	}
	function getAllcode()
	{
		global $objSmarty;
		if(isset($_REQUEST['sortflag']) && $_REQUEST['sortflag']!='')
		{
			if($_REQUEST['sortflag']=='1')
			{
				$orderBy.="order by Code asc";
			}
			elseif($_REQUEST['sortflag']=="2")
			{
				$orderBy.="order by Code desc";
			}
			elseif($_REQUEST['sortflag']=='3'){
				$orderBy.="order by Description asc";
			}
			elseif($_REQUEST['sortflag']=='4'){
				$orderBy.="order by Description desc";
			}
			
		}
		else
		{
			$orderBy.="order by ID desc";
		}
		$selcode="select * from code $orderBy";
		$execode=$this->ExecuteQuery($selcode,"select");
		$objSmarty->assign("codeval",$execode);
	}
	function getspecificcode($id1){
		global $objSmarty;
		$selcode="select * from code where ID = ".$id1." order by ID desc"; 
		$execode=$this->ExecuteQuery($selcode,"select");
		$objSmarty->assign("indcode",$execode);
	}
	function codedelete($id)
	{
		global $objSmarty,$config;
		//Delete the corresponding record from code table 
		$tempdrop = "DELETE FROM code WHERE ID ='$id'";
		$this->ExecuteQuery($tempdrop, "delete");
		header("location:code.php?successmsg=3");// redirecting
	}
	
}
?>
