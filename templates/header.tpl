<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<title>Rajasri DRS</title>
	<meta http-equiv="X-UA-Compatible" content="IE=9" />
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
	<link rel="SHORTCUT ICON" href="img/rajasri.jpeg">
	<link rel="stylesheet" href="css/all.css">
	<script src="js/jquery-latest.js"></script>
</head>
<!--Design Prepared by Rajasri Systems-->   
<body>
<div id="wrapper">
	<div id="header">
		<a href="http://www.rajasri.net/" class="inner-logo"><img src="img/rajasri.jpeg" alt=""/></a>
	<ul id="top-navigation">
			<li {if $activePage eq '1'}class="active"{/if}><a href="controlpanel.php" class="navigation_link">Home</a></li>
			<li {if $activePage eq '5'}class="active"{/if}><a href="admin.php" class="navigation_link">Admin</a></li>
			<li {if $activePage eq '4'}class="active"{/if}><a href="resource.php" class="navigation_link">Resource</a></li>
			<li {if $activePage eq '2'}class="active"{/if}><a href="rating.php" class="navigation_link">Rating</a></li>
			<li {if $activePage eq '3'}class="active"{/if}><a href="report.php" class="navigation_link">Reports</a></li>
			<li><a href="logout.php" class="navigation_link">Logout</a></li>
	</ul>
	<div class="loggedUser">Welcome <span style="color:#66A3FF;">{$smarty.session.Name}</span></div>
	</div>

