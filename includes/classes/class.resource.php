<?php
class Resource extends MysqlFns
{

	function Resource()
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
	function ResourceAdding()
	{
		global $objSmarty;
		$newRs_name= $_POST['resource_text'];
		$newRs_Init = $_POST['resource_initial'];
		$newRs_Dept = $_POST['department'];	
		$newRs_email = $_POST['em_txt'];
		$select="select * from resource where ResourceInitial = '".$newRs_Init."'";
		$count=$this->ExecuteQuery($select,'norows');// If the Resource initial is not in the table
			if($count == 0)//the count will be 0 so insert query will happen --- otherwise dont insert ---
			{
				$rs_insrt = "INSERT INTO resource(ResourceName, ResourceInitial,Email,DepartmentId)values('".$newRs_name."','".$newRs_Init."','".$newRs_email."','".$newRs_Dept."')";
				$inst_var = $this->ExecuteQuery($rs_insrt,'insert');
				$objSmarty->assign("SuccessMessage", "Resource details added successfully");
			}else{
				$objSmarty->assign("ErrorMessage", "Resource initial already exist");
			}
	}
	function show_resource()
	{
		global $objSmarty;
		$orderBy='';
		$new_Dept = $_POST['department'];
		if(isset($_REQUEST['sortflag']) && $_REQUEST['sortflag']!='')
		{
			if($_REQUEST['sortflag']=='1')
			{
				$orderBy.="order by  ResourceName asc";
			}
			elseif($_REQUEST['sortflag']=="2")
			{
				$orderBy.="order by  ResourceName desc";
			}
			elseif($_REQUEST['sortflag']=='3')
			{
				$orderBy.="order by ResourceInitial asc";
			}
			elseif($_REQUEST['sortflag']=='4')
			{
				$orderBy.="order by ResourceInitial desc";
			}
			elseif($_REQUEST['sortflag']=='5')
			{
				$orderBy.="order by DepartmentName asc";
			}
			elseif($_REQUEST['sortflag']=='6')
			{
				$orderBy.="order by DepartmentName desc";
			}
		}
		else
		{
			$orderBy.="order by  ResourceName asc";
		}
		$newRs_name= $_POST['resource_text'];
		$newRs_init = $_POST['resource_initial'];
		$dis_res = "select * from resource r, department d where r.DepartmentId = d.Id  $orderBy";
		$res =$this->ExecuteQuery($dis_res,'select');
		$objSmarty->assign('showres',$res);
	}
	
	function getResourcebyId($id)
	{
		global $objSmarty,$config;
		
		//Get the details from table for edit option
		$tempdisvar= "SELECT * FROM resource where ID= '$id'";
		$displaydet= $this->ExecuteQuery($tempdisvar, "select");
		$objSmarty->assign('resourceDetails', $displaydet);
	}
	function del_rsusers($id)
	{
		global $objSmarty,$config;
		//Delete the corresponding record from rating table 
		$tempdrop = "DELETE FROM resource WHERE ID ='$id'";
		$this->ExecuteQuery($tempdrop, "delete");
		header("location:resource.php?successmsg=2");// redirecting
	}
	function Resource_update($id)
	{
		global $objSmarty,$config;
		$upresname = $_REQUEST['resource_text'];
		$upresinit = $_REQUEST['resource_initial'];
		$upresdept = $_POST['department'];	
		$upresemail = $_POST['em_txt'];
		$select="select * from resource where ResourceInitial = '".$upresinit."' and ID!='$id'";
		$count=$this->ExecuteQuery($select,'norows');// If the Resource initial is not in the table
		//header("location:resource.php?successmsg=1");//redirect
		if($count == 0)//the count will be 0 so insert query will happen --- otherwise dont insert ---
			{
				$tempvar = "UPDATE resource SET ResourceName = '$upresname', ResourceInitial='$upresinit',Email='$upresemail',  DepartmentId='$upresdept' where ID = '$id'";
				$count=$this->ExecuteQuery($tempvar ,"update");
				$objSmarty->assign("SuccessMessage", "Resource details updated successfully");
				$_REQUEST['Rs_Id'] =""; // clearing the textfield after updating;
			}else{
				$objSmarty->assign("ErrorMessage", "Resource details already exist");
				
			}
		
		
	}
		
}	
	
?>
