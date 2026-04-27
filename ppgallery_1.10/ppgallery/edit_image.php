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
include_lan(e_PLUGIN."ppgallery/languages/".e_LANGUAGE."/admin.php");

$image=mysql_query("SELECT * FROM ".MPREFIX."ppgallery_images WHERE image='".$id."'");
$image=mysql_fetch_array($image);

$gallery=mysql_query("SELECT * FROM ".MPREFIX."ppgallery_gallerys WHERE gallery='".$image['is_gallery']."'");
$gallery=mysql_fetch_array($gallery);
if($gallery==""){header("location:".e_BASE."index.php");exit;}
if(check_class($gallery['adminclass'])) {} else {header("location:".e_BASE."index.php");exit;}
	
if (isset($_POST['save']))
{
	$description=$tp->toDB($_POST["description"]);
	$description=strip_tags($description);
	
	$sql->db_Select_gen("UPDATE ".MPREFIX."ppgallery_images
						SET description='".$description."',
						is_gallery='".$_POST["is_gallery"]."' WHERE image=".$id."");
	$caption=PPGLAN_17;
	$text="
		<p class='center'>
			".PPGLAN_15."
			<br /><br />
			<a href='gallery.php?id=".$image['is_gallery']."' class='button'>".PPGLAN_21."</a>
		</p>
	";
}
else
{
	$caption=PPGLAN_22;
	$text="
		<form action='".e_SELF."?id=".$id."' method='post'>
			<table style='width:100%;'>
				<tr>
					<td class='forumheader' colspan='2'>".PPGLAN_19."</td>
				</tr>
				<tr>
					<td class='forumheader3' colspan='2'>
						<textarea class='tbox' name='description' placeholder='".PPGLAN_23."' style='width:95%;min-height:150px;'>".$image['description']."</textarea>
					</td>
				</tr>
				<tr>
					<td class='forumheader' style='width:25%;'>".PPGLAN_24."</td>
					<td class='forumheader3'>
						<select class='tbox' name='is_gallery'>
	";
	$cql=mysql_query("SELECT * FROM ".MPREFIX."ppgallery_gallerys WHERE gallery>'0' ORDER BY name");
	while ($gallery=mysql_fetch_array($cql,MYSQL_ASSOC))
	{
		if(check_class($gallery['adminclass']))
		{
			if ($gallery['gallery']==$image['is_gallery']) {$selected="selected='selected'";}
			$text.="	<option value='".$gallery['gallery']."' ".$selected.">".$gallery['name']."</option>";
			unset ($selected);
		}
	}
	$text.="
						</select>
					</td>
				</tr>
				<tr>
					<td class='forumheader center' colspan='2'>
						<input type='submit' name='save' class='button' value='".PPGLAN_13."' />
					</td>
				</tr>
			</table>
		</form>
	";
}

$text.=$inc;
$ns -> tablerender($caption, $text); 
require_once(FOOTERF);
?> 