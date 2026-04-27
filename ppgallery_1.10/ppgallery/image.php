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
require_once("../../class2.php");
require_once(HEADERF);
require_once("pref.php");
include_lan(e_PLUGIN."ppgallery/languages/".e_LANGUAGE."/image.php");

$image=mysql_query("SELECT * FROM ".MPREFIX."ppgallery_images WHERE image='".intval($id)."'");
$image=mysql_fetch_array($image);

$user=mysql_query("SELECT * FROM ".MPREFIX."user WHERE user_id='".$image['owner']."'");
$user=mysql_fetch_array($user);

$gallery=mysql_query("SELECT * FROM ".MPREFIX."ppgallery_gallerys WHERE gallery='".intval($image['is_gallery'])."'");
$gallery=mysql_fetch_array($gallery);
if($gallery==""){header("location:".e_BASE."index.php");exit;}
if($image==""){header("location:".e_BASE."index.php");exit;}
if(check_class($gallery['viewclass'])) {} else {header("location:".e_BASE."index.php");exit;}

if(check_class($gallery['adminclass']))
{
	$admin_link=" <a href='edit_image.php?id=".$id."' class='button'>".PPGLAN_01."</a> <a href='delete.php?id=".$id."' class='button'>".PPGLAN_02."</a>";
}

$caption=PPGLAN_03;

$text="
<table style='width:90%'>
	<tr>
		<td class='forumheader3 center' colspan='2'>
			<a href='gallery.php?id=".$image['is_gallery']."' class='button'>".PPGLAN_04."</a> ".$admin_link."
			<br /><br />
			<a href='images/".$image['source']."' rel='prettyPhoto' title='".$image['description']."' >
				<img class='ppgallery_image' src='images/".$image['source']."' />
			</a>
		</td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:50%;'>
			".PPGLAN_05." <a href='".e_BASE."user.php?id.".$user['user_id']."'>".$user['user_name']."</a>
		</td>
		<td class='forumheader3'>".PPGLAN_06." ".date("d.m.Y",$image['checked'])."</td>
	</tr>
	<tr>
		<td class='forumheader3' colspan='2'>
			".$image['description']."
		</td>
	</tr>
	<tr>
		<td class='forumheader' colspan='2'>".PPGLAN_07."</td>
	</tr>
	<tr>
		<td class='forumheader3' colspan='2'>
			<div class='ppcode'>
				<code>[url=".e_SELF."?id=".$id."][img]http://".$_SERVER['SERVER_NAME'].e_PLUGIN_ABS."ppgallery/thumbs/".$image['source']."[/img][/url]</code>
			</div>
		</td>
	</tr>
</table>
";

$text.=$inc;
$ns -> tablerender($caption,$text); 
require_once(FOOTERF); 
?> 