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
		
$menutext="<a href='irdjprofile_admin.php'>[List Profiles]</a> <a href='irdjprofile_admin.php?new=1'>[New Profile]</a> <a href='irdj_admin.php'>[Main IRDJ Page]</a><br /><br />";
	
$text="";

$text .=$menutext;

// Edit record posted
	if (ISSET($_POST['editdj_name']))
	{
	$editdj_name=addslashes($_POST['editdj_name']);
	$editdj_age=addslashes($_POST['editdj_age']);
	$editdj_location=addslashes($_POST['editdj_location']);
	$editdj_genre=addslashes($_POST['editdj_genre']);
	$editdj_photo=addslashes($_POST['editdj_photo']);
	$editdj_intro=addslashes($_POST['editdj_intro']);
	$editdj_body=addslashes($_POST['editdj_body']);
	$editdj_theme=$_POST['editdj_theme'];
	$djid=$_POST['djid'];
	
		if ($_POST['editgdimage']=="1")
		$editdj_photo="themes/iart.php?text=".$editdj_name." ".$editdj_genre;
	
	$work=mysql_query("UPDATE ".$mySQLprefix."irdjprofile_admin SET dj_name='$editdj_name', dj_intro='$editdj_intro', dj_body='$editdj_body', dj_age='$editdj_age', dj_location='$editdj_location', dj_genre='$editdj_genre', dj_photo='$editdj_photo', dj_theme='$editdj_theme' WHERE id='$djid'");
	if(!$work)
	die("Could not update profile: ".mysql_error());
	
	echo "** Profile Edited!! **";
	}

// Check for Delete Profile
	if (ISSET($_GET['delete']))
	{
	$djid=$_GET['delete'];
	$work=mysql_query("DELETE FROM ".$mySQLprefix."irdjprofile_admin WHERE id=$djid");
	if(!$work)
	die("Could not delete: ".mysql_error());
	
	echo "** Profile $djid deleted **";
	
	}

// New Record posted
	if (ISSET($_POST['dj_name']))
	{
	$dj_name=addslashes($_POST['dj_name']);
	$dj_age=addslashes($_POST['dj_age']);
	$dj_location=addslashes($_POST['dj_location']);
	$dj_genre=addslashes($_POST['dj_genre']);
	$dj_photo=addslashes($_POST['dj_photo']);
	$dj_intro=addslashes($_POST['dj_intro']);
	$dj_body=addslashes($_POST['dj_body']);
	$gdimage=$_POST['gdimage'];
	$dj_theme=$_POST['dj_theme'];
	
	if ($dj_theme="")
		$dj_theme="0";
	
	if ($dj_photo=="" && $gdimage=="1")
		$dj_photo="themes/iart.php?text=".$dj_name;
	
	$work=mysql_query("INSERT INTO ".$mySQLprefix."irdjprofile_admin (dj_name, dj_intro, dj_body, dj_age, dj_location, dj_genre, dj_photo, dj_theme) VALUES ('$dj_name', '$dj_intro', '$dj_body', '$dj_age', '$dj_location', '$dj_genre', '$dj_photo', '$dj_theme') ");
	if(!$work)
	die("Could not add profile: ".mysql_error());
	
	echo "** Profile Created!! **";
	} // end new record posted

			// Example posted - for next version
			/*
			if (ISSET($_POST['exdj_name']))
			{
			$dj_name=addslashes($_POST['exdj_name']);
			$dj_age=addslashes($_POST['exdj_age']);
			$dj_location=addslashes($_POST['exdj_location']);
			$dj_genre=addslashes($_POST['exdj_genre']);
			$dj_photo=addslashes($_POST['exdj_photo']);
			$dj_intro=addslashes($_POST['exdj_intro']);
			$dj_body=addslashes($_POST['exdj_body']);
	
			$work=mysql_query("INSERT INTO ".$mySQLprefix."irdjprofile_admin (dj_name, dj_intro, dj_body, dj_age, dj_location, dj_genre, dj_photo) VALUES ('$dj_name', '$dj_intro', '$dj_body', '$dj_age', '$dj_location', '$dj_genre', '$dj_photo') ");
			if(!$work)
			die("Could not add profile: ".mysql_error());
	
			echo "** Example Profile Created!! **";
			} // end example record posted
			*/

	
// Edit record form
	if (ISSET($_GET['edit']))
	{
	$djid=$_GET['edit'];
	
	$work=mysql_query("SELECT * FROM ".$mySQLprefix."irdjprofile_admin WHERE id='$djid'");
		if(!$work)
			die("Could not add profile: ".mysql_error());
	$row=mysql_fetch_array($work);
	
	
		// Get theme
		$themeslist="";

		$i=0;
			if ($handle = opendir('themes/')) {
			while (false !== ($file = readdir($handle))) {
			$irdjthemes[$i]=$file;
			$i++;
				}
			}
		closedir($handle);
		
		$i=0;
		
			foreach ($irdjthemes AS $dircontent) {
			$domain = strstr($dircontent, 'theme_');
			
			if ($domain<>"") {
				
				if ($row['dj_theme']==$i)
					$themeslist .="<input type='radio' name='editdj_theme' value='".$i."' checked>".$i." | ";
				
				else
					$themeslist .="<input type='radio' name='editdj_theme' value='".$i."' />".$i." | ";
				
				$i++;
				}
			}
	
	$dj_name=$row['dj_name'];
	$dj_age=$row['dj_age'];
	$dj_location=$row['dj_location'];
	$dj_genre=$row['dj_genre'];
	$dj_photo=$row['dj_photo'];
	$dj_intro=$row['dj_intro'];
	$dj_body=$row['dj_body'];
	
	
	$text .="
	<table width='50%'>
	<form name='editprofile' action='irdjprofile_admin.php' method='post'>
	<tr><td><h3>Edit Profile</h3></td></tr>
	<tr><td>DJ Name</td><td><input type='text' name='editdj_name' value='".$dj_name."'></td></tr>
	<tr><td>Age</td><td><input type='text' name='editdj_age' size='3' value='".$dj_age."'></td></tr>
	<tr><td>Location</td><td><input type='text' name='editdj_location' value='".$dj_location."'></td></tr>
	<tr><td>Genre</td><td><input type='text' name='editdj_genre' value='".$dj_genre."'></td></tr>
	<tr><td>Photo URL ".helpurl("[info]",7)."</td><td><input type='text' name='editdj_photo' value='".$dj_photo."'><input type='checkbox' name='editgdimage' value='1' > Create Image ".helpurl("[info]",9)."</td></tr>
	<tr><td>Select Theme</td><td>".$themeslist." ".helpurl("[info]",8)."</td></tr>
	</table>
		
	<table width='80%'>
	<tr><td>Intro Text ".helpurl("[info]",5)."<br /><textarea rows='5' cols='90' name='editdj_intro'>".$dj_intro."</textarea>
	<br /><br />Main Text ".helpurl("[info]",6)."<br /><textarea rows='10' cols='90' name='editdj_body'>".$dj_body."</textarea></td></tr>
	<tr><td><input type='hidden' name='djid' value='".$djid."'>
	<input type='submit' value='Update Profile'></td></tr>
	</form>
	</table><br /><br />
	";

	} // end edit record form
	
	
// Blank form for new dj
	if (ISSET($_GET['new']))
	{
	
		// Example Profile Creator - for next version
		/*
		$text .="<form name='ex_irdjprofile_admin' action='irdjprofile_admin.php' method='post'>
		<input type='hidden' name='exdj_name' value='DJ Example'>
		<input type='hidden' name='exdj_age' size='3' value='21'>
		<input type='hidden' name='exdj_location' value='UK'>
		<input type='hidden' name='exdj_genre' value='Anything'>
		<input type='hidden' name='exdj_photo' value=''>
		<input type='hidden' name='exdj_intro' value=''>
		<input type='hidden' name='exdj_body' value=''>
		<input type='submit' value='Make an example profile'><br />
		</form>";
		*/
		
		// Get themes menu to $themeslist

		$themeslist="";

		$i=0;
			if ($handle = opendir('themes/')) {
			while (false !== ($file = readdir($handle))) {
			$irdjthemes[$i]=$file;
			$i++;
			}
			}
		closedir($handle);
		
		$i=0;
		
			foreach ($irdjthemes AS $dircontent)
			{
			$domain = strstr($dircontent, 'theme_');
		
			if ($domain<>"")
				{
				$themeslist .="<input type='radio' name='dj_theme' value='".$i."'>".$i." | ";
	
				$i++;
				}
			}
	
	$text .="
	<table width='50%'>
	<form name='irdjprofile_admin' action='irdjprofile_admin.php' method='post'>
	<tr><td><h3>New Profile</h3></td><td></td></tr>
	<tr><td>DJ Name</td><td><input type='text' name='dj_name'></td></tr>
	<tr><td>Age</td><td><input type='text' name='dj_age' size='3'></td></tr>
	<tr><td>Location</td><td><input type='text' name='dj_location'></td></tr>
	<tr><td>Genre</td><td><input type='text' name='dj_genre'></td></tr>
	<tr><td>Photo URL ".helpurl("[info]",7)."</td><td><input type='text' name='dj_photo'> <input type='checkbox' name='gdimage' value='1' > Create Image ".helpurl("[info]",9)."</td></tr>
	<tr><td>Select Theme</td><td>".$themeslist." ".helpurl("[info]",8)."</td></tr>
	</table>
	
	<table width='80%'>
	<tr><td>Intro Text ".helpurl("[info]",5)."<br /><textarea rows='5' cols='90' name='dj_intro'></textarea><br /><br />
	Main Text ".helpurl("[info]",6)."<br /><textarea rows='10' cols='90' name='dj_body'></textarea></td></tr>
	<tr><td><input type='submit' value='Add New Profile'></td></tr>

	</form>
	</table><br /><br />
	";
	}
	
// Show current profiles
	$work=mysql_query("SELECT * FROM ".$mySQLprefix."irdjprofile_admin");
		if(!$work)
			die("Could not select profiles: ".mysql_error());
	$ifblank=mysql_affected_rows();

	$text .="<b>Current Profiles</b><br />
	<table width='100%' border='1'><tr><td><b>ID</b></td><td><b>DJ Name</b></td><td><b>Location</b></td><td><b>Age</b></td><td><b>View Profile</b></td><td><b>Edit</b></td><td><b>Delete</b></td></tr>";
	
	while($row = mysql_fetch_array($work))
	{
	$delid=$row['id'];
	
	$text .="<tr><td>".$row['id']."</td><td>".$row['dj_name']."</td><td>".$row['dj_location']."</td><td>".$row['dj_age']."</td><td><a href='profile.php?id=".$row['id']."'>View</a></td><td><a href='irdjprofile_admin.php?edit=".$row['id']."'>EDIT</a></td>
			<td><a href='irdjprofile_admin.php?delete=$delid' onclick=\"return jsconfirm('Are you sure?')\">Delete</a></td></tr>";
	}
	
	$text .="</table>";	
		
	if ($ifblank==0)
		$text .="<center><h3>No Profiles yet! <a href='irdjprofile_admin.php?new=1'>[Add New Profile]</a></h3></center>";
	
$ns->tablerender("DJ Profile",$text);
require_once(e_ADMIN.'footer.php');

?>