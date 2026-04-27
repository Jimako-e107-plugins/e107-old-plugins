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

$caption=PPLAN_02;

$sql->db_Select("ppgallery_gallerys", "*", "gallery>'0' ORDER BY RAND()");
while ($gallery=$sql->db_Fetch())
{
	if(check_class($gallery['viewclass']))
	{
		$image=mysql_query("SELECT * FROM ".MPREFIX."ppgallery_images WHERE is_gallery='".$gallery['gallery']."' ORDER BY RAND() LIMIT 1");
		$image=mysql_fetch_array($image);
		if ($image['image']!="")
		{
			$pp_random_image_menu="
				<a href='".e_PLUGIN."ppgallery/images/".$image['source']."' rel='prettyPhoto' title='".$image['description']."'>
					<img class='ppgallery_random' src='".e_PLUGIN."ppgallery/thumbs/".$image['source']."' s />
				</a>
			";
			break;
		}
	}	
}

$ns -> tablerender($caption,$pp_random_image_menu);
?>