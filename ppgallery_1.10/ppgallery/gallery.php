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
include_lan(e_PLUGIN."ppgallery/languages/".e_LANGUAGE."/gallery.php");


$gallery=mysql_query("SELECT * FROM ".MPREFIX."ppgallery_gallerys WHERE gallery='".intval($id)."'");
$gallery=mysql_fetch_array($gallery);
if($gallery==""){header("location:".e_BASE."index.php");exit;}
if(check_class($gallery['viewclass'])) {} else {header("location:".e_BASE."index.php");exit;}

//Zählen aller vorhandenen Datensätze in der MySQL-Tabelle
$result=mysql_query("SELECT * FROM ".MPREFIX."ppgallery_images WHERE is_gallery='".intval($id)."'");
$menge=mysql_num_rows($result);

if(check_class($gallery['adminclass']))
{
	$admin_link=" <a href='edit_gallery.php?id=".$id."' class='button'>".PPGEDITLAN_01."</a> ";
	$admin_legende="
		<tr>
			<td style='width:32px;padding-right:5px;'><img src='stuff/check.png' /></td>
			<td>".PPGLAN_02."</td>
		</tr>
		<tr>
			<td style='width:32px;padding-right:5px;'><img src='stuff/deny.png' /></td>
			<td>".PPGLAN_03."</td>
		</tr>
	";
}
if(check_class($gallery['addclass']))
{
	$add_link=" <a href='add_image.php?id=".$id."' class='button'>".PPGLAN_04."</a>";
}

$caption=$gallery['name'];
$text="
<div class='forumheader3'>
	".$tp->toHTML($gallery['description'],true)."
	<br /><br />
	<div class='center'>
		<a href='index.php' class='button'>".PPGLAN_05."</a> ".$add_link.$admin_link."
	</div>
</div>
<table style='width:100%;'>
	<tr>
";

$count=1;
$gql=mysql_query("SELECT * FROM ".MPREFIX."ppgallery_images WHERE is_gallery='".intval($id)."' ORDER BY image DESC LIMIT $start, $show");
while ($image=mysql_fetch_array($gql,MYSQL_ASSOC))
{
	if (is_int($count/$zshow)) {$after="</tr><tr>";}
	if ($image['checked']==0)
	{
		if (check_class($gallery['adminclass']))
		{
			$alert="
			<a href='delete.php?id=".$image['image']."' class='ppgallery_alert' style='background-image:url(stuff/deny.png);' title='".PPGLAN_03."'></a>
			<a href='check.php?id=".$image['image']."' class='ppgallery_check' style='background-image:url(stuff/check.png);' title='".PPGLAN_02."'></a>
			<a href='edit_image.php?id=".$image['image']."' class='ppgallery_edit' style='background-image:url(stuff/edit.png);' title='".PPGLAN_04."'></a>
		";
		}
		else
		{
			$alert="<div class='ppgallery_alert' style='background-image:url(stuff/alert.png);'></div>";
		}
	}
	else
	{
		$alert="
			<a href='image.php?id=".$image['image']."' class='ppgallery_alert' style='background-image:url(stuff/details.png);' title='".PPGLAN_06."'></a>
		";
	}
	$text.="
		<td class='forumheader3 center' valign='top'>
			<a href='images/".$image['source']."' rel='prettyPhoto[".$id."]' title='".$image['description']."' >
				<div class='ppgallery_preview' style='background-image:url(thumbs/".$image['source'].");width:".$width."px;height:".$width."px'></div>
			</a>
			".$alert."
		</td>
		".$after."
	";
	unset ($after);
	$count++;
}
$text.="</tr></table>";

include "browse.php";

$ns -> tablerender($caption,$text); 

$caption=PPGLAN_07;

$text="
<table style='width:100%;'>
	<tr>
		<td style='width:32px;padding-right:5px;'><img src='stuff/details.png' /></td>
		<td>".PPGLAN_08."</td>
	</tr>
	<tr>
		<td style='width:32px;padding-right:5px;'><img src='stuff/alert.png' /></td>
		<td>".PPGLAN_09."</td>
	</tr>
	".$admin_legende."
</table>
";

$text.=$inc;
$ns -> tablerender($caption,$text); 
require_once(FOOTERF); 
?> 