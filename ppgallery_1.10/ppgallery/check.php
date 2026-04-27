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
include_lan(e_PLUGIN."ppgallery/languages/".e_LANGUAGE."/check.php");

$image=mysql_query("SELECT * FROM ".MPREFIX."ppgallery_images WHERE image='".$id."'");
$image=mysql_fetch_array($image);

$gallery=mysql_query("SELECT * FROM ".MPREFIX."ppgallery_gallerys WHERE gallery='".$image['is_gallery']."'");
$gallery=mysql_fetch_array($gallery);
if($gallery==""){header("location:".e_BASE."index.php");exit;}
if(check_class($gallery['adminclass'])) {} else {header("location:".e_BASE."index.php");exit;}
	
if (isset($_POST['check']))
{
	$sql->db_Select_gen("UPDATE ".MPREFIX."ppgallery_images SET checked='".time()."' WHERE image=".$id."");
	$caption=PPGLAN_06;
	$text="
		<p class='center'>
			".PPGLAN_01."
			<br /><br />
			<a href='gallery.php?id=".$image['is_gallery']."' class='button'>".PPGLAN_02."</a>
			<a href='check_images.php' class='button'>".PPGLAN_07."</a>
		</p>
	";
}
else
{
	$caption=PPGLAN_05;
	$text="
		<form action='".e_SELF."?id=".$id."' method='post'>
			<div class='center'>
				<a href='images/".$image['source']."' rel='prettyPhoto[".$id."]' title='".$image['description']."' >
					<div class='ppgallery_preview' style='background-image:url(thumbs/".$image['source'].");'></div>
				</a>
				<br /><br />
				".PPGLAN_03."
				<br /><br />
				<input type='submit' name='check' class='button' value='".PPGLAN_04."' />
			</div>
		</form>
	";
}

$text.=$inc;
$ns -> tablerender($caption, $text); 
require_once(FOOTERF); 
?> 