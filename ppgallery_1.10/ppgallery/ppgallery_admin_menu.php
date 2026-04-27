<?php
/*
*************************************
*        PPGallery					*
*									*
*        (C)Oyabunstyle.de			*
*        http://oyabunstyle.de		*
*        info@oyabunstyle.de		*
*************************************
*/
if (!defined('e107_INIT')){exit;}
include_lan(e_PLUGIN."ppgallery/languages/".e_LANGUAGE."/index.php");

$caption=PPLAN_03;
$pp_admin_menu="
<table style='width:100%;'>
	<tr>
";
$fail=FALSE;
// FTP Bilder überprüfen
$ppcheck=mysql_query("SELECT plugin_id FROM ".MPREFIX."plugin WHERE plugin_name='PPGallery'");
$ppcheck=mysql_fetch_array($ppcheck);
$ppcheck=$ppcheck['plugin_id'];
$usercheck=mysql_query("SELECT user_perms FROM ".MPREFIX."user WHERE user_id='".USERID."'");
$usercheck=mysql_fetch_array($usercheck);
$usercheck=$usercheck['user_perms'];

if ((check_class(250)) or ((ereg($ppcheck,$usercheck))))
{
	$count=0;
	$verzeichnis=openDir("".e_PLUGIN."ppgallery/images");
	while ($file=readDir($verzeichnis))
	{
		if ($file!="." && $file != ".." && !is_dir($file)) {
			if (strstr($file, ".png") ||
				strstr($file, ".jpg"))
			{
				$bildcheck=mysql_query("SELECT source FROM ".MPREFIX."ppgallery_images WHERE source='$file'");
				$bildcheck=mysql_fetch_array($bildcheck);
				$bildcheck=$bildcheck['source'];
				if ($file!=$bildcheck) {$count++;}
			}
		}
	}
	if ($count!=0)
	{
		$pp_admin_menu.="
			<td class='forumheader3' style='width:32px;padding-right:5px;'><img src='".e_PLUGIN."ppgallery/stuff/alert.png' /></td>
			<td class='forumheader3'><a href='".e_PLUGIN."ppgallery/admin_ftp_loads.php'>".$count." ".PPLAN_04."</a></td>
			</tr><tr>
		";
		$fail=TRUE;
	}
}

// Userbilder überprüfen
$count=0;
$sql->db_Select("ppgallery_gallerys", "*", "gallery>'0'");
while ($gallery=$sql->db_Fetch())
{
	if(check_class($gallery['adminclass']))
	{
		$gql=mysql_query("SELECT * FROM ".MPREFIX."ppgallery_images WHERE checked='0' AND is_gallery='".$gallery['gallery']."'");
		while ($image=mysql_fetch_array($gql,MYSQL_ASSOC)) {$count++;}
	}	
}
if ($count!=0)
{
	$pp_admin_menu.="
		<td class='forumheader3' style='width:32px;padding-right:5px;'><img src='".e_PLUGIN."ppgallery/stuff/alert.png' /></td>
		<td class='forumheader3'><a href='".e_PLUGIN."ppgallery/check_images.php'>".$count." ".PPLAN_05."</a></td>
	";
	$fail=TRUE;
}

// Wenn alles korrekt
if ($fail==FALSE)
{
	$pp_admin_menu.="
		<td class='forumheader3'><img src='".e_PLUGIN."ppgallery/stuff/check.png' /></td>
		<td class='forumheader3'>".PPLAN_06."</a></td>
	";
}
$pp_admin_menu.="</tr></table>";

$ns -> tablerender($caption,$pp_admin_menu);
?>