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
include_lan(e_PLUGIN."ppgallery/languages/".e_LANGUAGE."/index.php");

$caption=PPGOBLAN_01;

$text="
<table style='width:100%;'>
	<tr>
";
$count=1;
$gql=mysql_query("SELECT * FROM ".MPREFIX."ppgallery_gallerys WHERE gallery>'0' ORDER BY gorder DESC");
while ($gallery=mysql_fetch_array($gql,MYSQL_ASSOC))
{
	if(check_class($gallery['viewclass']))
	{
		$imagecount=$sql->db_Count("ppgallery_images","(*)", "WHERE is_gallery='".intval($gallery['gallery'])."'");
		if ($imagecount>1)
		{
			$image=mysql_query("SELECT * FROM ".MPREFIX."ppgallery_images WHERE is_gallery='".intval($gallery['gallery'])."' ORDER BY RAND() LIMIT 1");
			$image=mysql_fetch_array($image);
			$image="thumbs/".$image['source'];
		}
		elseif ($imagecount==1)
		{
			$image=mysql_query("SELECT * FROM ".MPREFIX."ppgallery_images WHERE is_gallery='".intval($gallery['gallery'])."'");
			$image=mysql_fetch_array($image);
			$image="thumbs/".$image['source'];
		}
		else
		{
			$image="stuff/empty.png";
		}
		if (is_int($count/$zshow)) {$after="</tr><tr>";}
		$text.="
			<td class='forumheader3 center' valign='top'>
				<div class='center ppgallery_header'>".$gallery['name']."</div>
				<a href='gallery.php?id=".$gallery['gallery']."' title='".$gallery['name']."'>
					<div class='ppgallery_preview' style='background-image:url(".$image.");width:".$width."px;height:".$width."px'></div>
				</a>
			</td>
			".$after."
		";
		unset ($after);
		unset ($image);
		unset ($imagecount);
		unset ($image_rand);
		$count++;
	}
}
$text.="</tr></table>";

$text.=$inc;
$ns -> tablerender($caption, $text); 
require_once(FOOTERF); 
?> 