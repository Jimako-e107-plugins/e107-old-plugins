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
include_lan(e_PLUGIN."ppgallery/languages/".e_LANGUAGE."/check_images.php");

$caption=PPGLAN_01;

$text="
<table style='width:100%'>
	<tr>
";
$gql=mysql_query("SELECT * FROM ".MPREFIX."ppgallery_gallerys WHERE gallery>'0' ORDER BY name");
while ($gallery=mysql_fetch_array($gql,MYSQL_ASSOC))
{
	if(check_class($gallery['adminclass']))
	{
		$count=1;
		$iql=mysql_query("SELECT * FROM ".MPREFIX."ppgallery_images WHERE checked='0' AND is_gallery='".$gallery['gallery']."'");
		while ($image=mysql_fetch_array($iql,MYSQL_ASSOC))
		{
			if (is_int($count/3)) {$after="</tr><tr>";}
			$text.="
				<td class='forumheader3 center' valign='top'>
					".$gallery['name']."
					<br />
					<a href='images/".$image['source']."' rel='prettyPhoto' title='".$image['description']."' >
						<div class='ppgallery_preview' style='background-image:url(thumbs/".$image['source'].");width:".$width."px;height:".$width."px'></div>
					</a>
					<a href='delete.php?id=".$image['image']."' class='ppgallery_alert' style='background-image:url(stuff/deny.png);' title='".PPGLAN_02."'></a>
					<a href='check.php?id=".$image['image']."' class='ppgallery_check' style='background-image:url(stuff/check.png);' title='".PPGLAN_03."'></a>
					<a href='edit_image.php?id=".$image['image']."' class='ppgallery_edit' style='background-image:url(stuff/edit.png);' title='".PPGLAN_04."'></a>
				</td>
				".$after."
			";
			unset ($after);
			$count++;
		}
	}	
}
$text.="</tr></table>";

$text.=$inc;
$ns -> tablerender($caption,$text); 
require_once(FOOTERF); 
?> 