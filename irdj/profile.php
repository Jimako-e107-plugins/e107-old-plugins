<?php

########################################
# IRDJ (e107) BY MARTINJ  | VERSION 1.2 | January 2008		#
# For e107 website system - e107.org | http://www.irdj.co.uk		#
# email martinleeds AT googlemail.com					#
########################################

require_once("../../class2.php");
define ("e_PAGETITLE", "DJ Profile");
require_once(HEADERF);

if (!defined('e107_INIT')) { exit; }

		if (file_exists(e_PLUGIN."irdj/languages/irdj_".e_LANGUAGE.".php"))
		{
			include_once(e_PLUGIN."irdj/languages/irdj_".e_LANGUAGE.".php");
		}
		else
		{
		include_once(e_PLUGIN."irdj/languages/irdj_English.php");
		}

$view_profile=$_GET['id'];
	
	$work=mysql_query("SELECT * FROM ".$mySQLprefix."irdjprofile_admin WHERE id='$view_profile'");
		if (!mysql_affected_rows())
		die ("Error - Profile not found!");

	$row=mysql_fetch_array($work);


// Get picture
if ($row['dj_photo']=="")
	{
	if (function_exists("gd_info"))
		$dj_photo="themes/iart.php?text=".$row['dj_name']." ".$row['dj_genre'];
	else $dj_photo="nopic.jpg";
	}

else
	$dj_photo=$row['dj_photo'];

if (!$row['dj_theme'] || $row['dj_theme']=="")
		$profile_theme="0";
		else
			$profile_theme=$row['dj_theme'];

include ("themes/theme_".$profile_theme.".php");

$text .= "<br /><div class='center'><a href='http://www.irdj.net'>IRDJ Schedule System</a> by <a href='http://www.martinj.co.uk'>Martinj</a></div><br />";

$ns->tablerender($row['dj_name'],$text);


require_once(FOOTERF);

?>