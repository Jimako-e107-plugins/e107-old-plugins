<?php

########################################
# IRDJ (e107) BY MARTINJ  | VERSION 1.2 | January 2008		#
# For e107 website system - e107.org | http://www.irdj.co.uk		#
# email martinleeds AT googlemail.com					#
########################################

$eplug_admin = true;

require_once("../../class2.php");
if(!getperms("P")){ header("location:".e_BASE."index.php"); }
require_once(e_HANDLER."userclass_class.php");
require_once(e_ADMIN."auth.php");

		if (file_exists(e_PLUGIN."irdj/languages/irdj_".e_LANGUAGE.".php"))
		{
			include_once(e_PLUGIN."irdj/languages/irdj_".e_LANGUAGE.".php");
		}
		else
		{
		include_once(e_PLUGIN."irdj/languages/irdj_English.php");
		}

		
function helpurl($helptext, $location)
		{
		return "<a href='#' onclick=open_window('help.php?id=".$location."')>".$helptext."</a></h3>";
		}
		
$menutext="<a href='irdjprofile_admin.php'>[List Profiles]</a> <a href='irdjprofile_admin.php?new=1'>[New Profile]</a> <a href='irdj_admin.php'>[Main IRDJ Page]</a><br />";

$text .= $menutext."<br />".DJS_10."<br /><br />";
	
// Check for Edit in url
if (ISSET($_GET['edit']))
	{	
	$pr=$_GET['pr'];
	$pdd="<select name='edit_link'><option value='0'>No Profile";

		$work=mysql_query("SELECT * FROM ".$mySQLprefix."irdjprofile_admin");
			while($row = mysql_fetch_array($work))
			{
			if ($pr==$row['id'])
			$pdd .="<option value='".$row['id']."' SELECTED />".$row['dj_name'];

			else
			$pdd .="<option value='".$row['id']."' />".$row['dj_name'];
			}
			
	$pdd .="</select>";

	$djid=$_GET['edit'];
	
	$work=mysql_query("SELECT * FROM ".$mySQLprefix."irdj WHERE id=$djid ORDER BY time");
	$djinfo=mysql_fetch_array($work);

		// Find the djs day to select
		$checked=$djinfo['day'];
		$i=1;
		
		while ($i<8)
			{
			if ($checked==$i)
				$text_wkday="<option value='".$i."' SELECTED />";
			else $text_wkday="<option value='".$i."'>";
				$option[$i]=$text_wkday;
		
			$i++;
			}
	
	echo "<br /><b>Edit DJ...</b>
	<table width='100%' border='1'>
	<tr>
		<td ><b>".DJS_11."</b></td>
		<td ><b>".DJS_12."</b></td>
		<td ><b>".DJS_13."</b></td>
		<td ><b>".DJS_14."</b></td>
		<td ><b>".DJS_15."</b></td>
		<td ><b>".DJS_18."</b></td>
	</tr>
	<tr><form name='edit' action='irdj_admin.php' method='post'>
	<td><select name='edit_day'>
	".$option['1']."".DJS_0."</option>".$option['2']."".DJS_1."</option>".$option['3']."".DJS_2."</option>".$option['4']."".DJS_3."</option>".$option['5']."".DJS_4."</option>".$option['6']."".DJS_5."</option>".$option['7']."".DJS_6."</option>
	</select></td>
	<td><input type='text' name='edit_time' value='".$djinfo['time']."'></td>
	<td><input type='text' name='edit_djname' value='".$djinfo['dj_name']."'></td>
	<td><input type='text' name='edit_genre' value='".$djinfo['genre']."'></td>
	<td>".$pdd."
	<input type='hidden' name='edit_djid' value='".$djid."'>
	</td><td><input type='submit' value='Update'></td>
	</form></tr></table>";

	exit;
	
	}
	
	
	

	// Edit Record if posted
	if (ISSET($_POST['edit_djname']))
	{
	$djid=$_POST['edit_djid'];
	$edjname=addslashes($_POST['edit_djname']);
	$egenre=addslashes($_POST['edit_genre']);
	$eday=$_POST['edit_day'];
	$etime=addslashes($_POST['edit_time']);
	$elink=$_POST['edit_link'];
	
	$work=mysql_query("UPDATE ".$mySQLprefix."irdj SET dj_name='$edjname', time='$etime', day='$eday', genre='$egenre', link='$elink' WHERE id=$djid");
	if(!$work)
	die("Could not edit: ".mysql_error());
	
	echo "** Record $djid edited **";
	}
	
	
	
// Check for delete
if (ISSET($_GET['delete']))
	{
	$djid=$_GET['delete'];
	$work=mysql_query("DELETE FROM ".$mySQLprefix."irdj WHERE id=$djid");
	if(!$work)
	die("Could not delete: ".mysql_error());
	
	echo "** Record $djid deleted from the schedule **";
	}
	
// Check for config changes
if (ISSET($_GET['config']))
	{
	if ($_POST['show_genre']=="1")
	$work=mysql_query("UPDATE ".$mySQLprefix."irdj_config SET show_genre='1'");
		else
		$work=mysql_query("UPDATE ".$mySQLprefix."irdj_config SET show_genre='0'");
		
	if ($_POST['show_link']=="1")
	$work=mysql_query("UPDATE ".$mySQLprefix."irdj_config SET show_links='1'");
		else
		$work=mysql_query("UPDATE ".$mySQLprefix."irdj_config SET show_links='0'");
	
	if ($_POST['show_border']=="1")
	$work=mysql_query("UPDATE ".$mySQLprefix."irdj_config SET show_border='1'");
		else
		$work=mysql_query("UPDATE ".$mySQLprefix."irdj_config SET show_border='0'");
	
	$ppage_text=addslashes($_POST['page_text']);
		$page_text=strip_tags($ppage_text, '<p><a><b><h1><h2><h3><h4><h5><br />');
		$work=mysql_query("UPDATE ".$mySQLprefix."irdj_config SET page_text='$page_text'");
	
	
	} // end if config changed


// Check for new record
if (ISSET($_POST['djname']))
	{
	$djname=addslashes($_POST['djname']);
	$genre=addslashes($_POST['genre']);
	$day=$_POST['day'];
	$time=addslashes($_POST['time']);
	$link=$_POST['link'];
	
	$work=mysql_query("INSERT INTO ".$mySQLprefix."irdj (dj_name, genre, day, time, link) 
	VALUES ('$djname', '$genre', '$day', '$time', '$link')");
	
	if (!$work)
		die("Could not insert:".mysql_error());
	
	}
	
	
// Start the list of DJs
$days=array(DJS_0, DJS_1, DJS_2, DJS_3, DJS_4, DJS_5, DJS_6);

	$text .= "<table width='100%' border='1'>
	<tr>
		<td><b>".DJS_11."</b></td>
		<td><b>".DJS_12."</b></td>
		<td><b>".DJS_13."</b></td>
		<td><b>".DJS_14."</b></td>
		<td><b>".DJS_15."</b></td>
		<td><b>".DJS_16."</b></td>
		<td><b>".DJS_17."</b></td>
	</tr>";

// echo each row

$i=1;

	while ($i<8)
	{	
	$work=mysql_query("SELECT * FROM ".$mySQLprefix."irdj WHERE day='$i' ORDER BY time");

		while($row = mysql_fetch_array($work))
		{
		$daynumber=$row['day'];
		$dayofweek=$days[$daynumber-1];
	
		if ($row['link']=="" || $row['link']=="0")
			$link="No Profile";
		else
			$link="<a href='profile.php?id=".$row['link']."'>View Profile</a>";
		
		$delid=$row['id'];		
		$text .= "
		<tr>
		<td>".$dayofweek."</td>
		<td>".$row['time']."</td>
		<td>".$row['dj_name']."</td>
		<td>".$row['genre']."</td>
		<td>".$link."</td>
		<td><a href='irdj_admin.php?edit=".$row['id']."&pr=".$row['link']."'>Edit</a></td>
		<td><a href='irdj_admin.php?delete=$delid' onclick=\"return jsconfirm('Are you sure?')\">Delete</a></td>		
		</tr>";
		}
	$i++;

	}
	
// end of rows
$text .= "
</table>
";

$work=mysql_query("SELECT * FROM ".$mySQLprefix."irdj");
		$daycheck=mysql_affected_rows();
		
		if ($daycheck=='0')
			$text .= "<center><br /><b>The Schedule is empty. Enter DJ and Schedule information below.</b></center>";

			
// Add New DJ Form

$pdd="<select name='link'><option value='0'>No Profile";

	$work=mysql_query("SELECT * FROM ".$mySQLprefix."irdjprofile_admin");
		while($row = mysql_fetch_array($work))
		{
		$pdd .="<option value='".$row['id']."' />".$row['dj_name'];
		}

$pdd .="</select>";

$text .= "<br /><b>Add New DJ...</b>
	<table width='100%' border='1'>
	<tr>
		<td><b>".DJS_11."</b></td>
		<td><b>".DJS_12."</b></td>
		<td><b>".DJS_13."</b></td>
		<td><b>".DJS_14."</b></td>
		<td><b>".DJS_15."</b></td>
		<td><b>".DJS_18."</b></td>
	</tr>
	<tr><form name='new' action='irdj_admin.php' method='post'>
	<td><select name='day'>
	<option value='1'>".DJS_0."</option><option value='2'>".DJS_1."</option><option value='3'>".DJS_2."</option><option value='4'>".DJS_3."</option><option value='5'>".DJS_4."</option><option value='6'>".DJS_5."</option><option value='7'>".DJS_6."</option>
	</select></td>
	<td><input type='text' name='time' value='1PM - 2PM'></td>
	<td><input type='text' name='djname' value=''></td>
	<td><input type='text' name='genre' value=''></td>
	<td>".$pdd."
	</td><td><input type='submit' value='".DJS_19."'></td>
	</form>
	</tr>
	</table><br />";
	

// Profiles List
$work=mysql_query("SELECT * FROM ".$mySQLprefix."irdjprofile_admin");
		if(!$work)
			die("Could not select profiles: ".mysql_error());

			$ifblank=mysql_affected_rows();

	$text .="<b>Current Profiles</b>
	<table width='100%' border='1'>
	<tr><td><b>DJ Name</b></td><td><b>ID</b></td><td><b>Location</b></td><td><b>Age</b></td><td><b>View</b></td><td><b>Edit</b></td></tr>";
	
	while($row = mysql_fetch_array($work))
	{
	$delid=$row['id'];
	
	$text .="<tr><td>".$row['dj_name']."</td><td>".$row['id']."</td><td>".$row['dj_location']."</td><td>".$row['dj_age']."</td><td><a href='profile.php?id=".$row['id']."'>View Profile</a></td><td><a href='irdjprofile_admin.php?edit=".$row['id']."'>EDIT</a></td></tr>";
	}
	
	$text .="</table>";
	
		if ($ifblank==0)
		$text .="<center><h3>No Profiles yet! <a href='irdjprofile_admin.php?new=1'>[Add New Profile]</a></h3></center>";

	

// Get config settings to show...
	$work=mysql_query("SELECT * FROM ".$mySQLprefix."irdj_config");
		if (!$work)
			die("Could not select config tables:".mysql_error());
		
	$config=mysql_fetch_array($work);

	if ($config['show_genre']=="1")
	$show_genre="CHECKED";
		else
		$show_genre="";
	
	if ($config['show_links']=="1")
	$show_link="CHECKED";
		else
		$show_link="";
	
	if ($config['show_border']=="1")
	$show_border="CHECKED";
		else
		$show_border="";
		
	$page_text=$config['page_text'];
	
// Show config form
$text .= "<br /><br /><b>Edit Configuration...</b><table width='100%'><tr>
<form name='config' method='POST' action='irdj_admin.php?config=1'>
<td>".helpurl("Show Genre",1)."<input type='checkbox' value='1' name='show_genre' ".$show_genre." /></td>
<td>".helpurl("Disable Links",2)."<input type='checkbox' value='1' name='show_link' ".$show_link." /></td>
<td>".helpurl("Box in Schedule",3)."<input type='checkbox' value='1' name='show_border' ".$show_border." /></td>
<td>".helpurl("Text to show on Schedule Page",4)."<br ><textarea name='page_text' cols='50' rows='5'>".$page_text."</textarea></td></tr>
<tr><td><input type='submit' value='Update Settings'></td>
</form>
</tr></table>
<br />
<center><a href='http://www.irdj.net'>IRDJ Schedule System</a> by <a href='http://www.martinj.co.uk'>Martinj</a></center>";

$ns->tablerender("DJ Schedule",$text);
require_once(e_ADMIN.'footer.php');

?>