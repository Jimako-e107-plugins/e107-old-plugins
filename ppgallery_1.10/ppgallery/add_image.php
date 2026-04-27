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
include_lan(e_PLUGIN."ppgallery/languages/".e_LANGUAGE."/add_image.php");

$gallery=mysql_query("SELECT * FROM ".MPREFIX."ppgallery_gallerys WHERE gallery='".$id."'");
$gallery=mysql_fetch_array($gallery);
if($gallery==""){header("location:".e_BASE."index.php");exit;}
if(check_class($gallery['addclass'])) {} else {header("location:".e_BASE."index.php");exit;}
	
if (isset($_POST['save']))
{
	if ($_FILES['source']['name']!="")
	{	
		if (is_uploaded_file($_FILES['source']['tmp_name']))
		{
			$imagetype=pathinfo($_FILES['source']['name']);
			$imagetype=$imagetype['extension'];
			$imagetype=strtolower($imagetype);
						
			if (($imagetype=="jpg")or($imagetype=="jpeg")or($imagetype=="png"))
			{
				$description=$tp->toDB($_POST["description"]);
				$description=strip_tags($description);
						
				$imagename="".USERID.time().".".$imagetype."";
				$image_pfad="images/".$imagename;
				$temp="images/".$imagename;
				$thumb_pfad="thumbs/".$imagename;
				move_uploaded_file($_FILES['source']['tmp_name'],$temp);
						 
				$size=getimagesize($temp);
				$breite=$size[0];
				$hoehe=$size[1];
				
				if($breite<$hoehe)
				{ 
					$neueBreite=$breite_max;
					$neueHoehe=intval($hoehe*$neueBreite/$breite);
					
				}
				else
				{ 
					$neueHoehe=$hoehe_max;
					$neueBreite=intval($breite*$neueHoehe/$hoehe);
					
				}
				
				if (($imagetype=="jpg")or($imagetype=="jpeg"))
				{
					$altesBild=imagecreatefromjpeg($temp);
					$neuesBild=imagecreatetruecolor($neueBreite,$neueHoehe);
					imagecopyresized($neuesBild,$altesBild,0,0,0,0,$neueBreite,$neueHoehe,$breite,$hoehe);
					imagejpeg($neuesBild,$thumb_pfad);
					
					$eintragen=mysql_query("INSERT INTO ".MPREFIX."ppgallery_images
									(is_gallery, source, owner, checked, description) 
									VALUES ('".$id."',
											'".$imagename."',
											'".USERID."',
											'0',
											'".$description."')");
					$caption=PPGLAN_01;
					$text="
						<p class='center'>
							".PPGLAN_02."
							<br /><br />
							<a href='gallery.php?id=".$id."' class='button'>".PPGLAN_03."</a>
							<a href='".e_SELF."?id=".$id."' class='button'>".PPGLAN_11."</a>
						</p>
					";
				}
				elseif ($imagetype=="png")
				{
					$altesBild=imagecreatefrompng($image_pfad);
					$neuesBild=imagecreatetruecolor($neueBreite,$neueHoehe);
					$color=imagecolorallocatealpha($neuesBild, 0, 0, 0, 127);
					imagefill($neuesBild, 0, 0, $color);
					imagecopyresampled($neuesBild,$altesBild,0,0,0,0,$neueBreite,$neueHoehe,$breite,$hoehe);
					imagesavealpha($neuesBild,true);
					imagepng($neuesBild,$thumb_pfad);
					
					$eintragen=mysql_query("INSERT INTO ".MPREFIX."ppgallery_images
									(is_gallery, source, owner, checked, description) 
									VALUES ('".$id."',
											'".$imagename."',
											'".USERID."',
											'0',
											'".$description."')");
					$caption=PPGLAN_01;
					$text="
						<p class='center'>
							".PPGLAN_02."
							<br /><br />
							<a href='gallery.php?id=".$id."' class='button'>".PPGLAN_03."</a>
						</p>
					";
				}
				else
				{
					$caption=PPGLAN_05;
					$text="
						<p class='center'>
							".PPGLAN_04."
							<br /><br />
							<a href='gallery.php?id=".$id."' class='button'>".PPGLAN_03."</a>
						</p>
					";
				}
			}
			else 
			{
				$caption=PPGLAN_05;
				$text="
					<p class='center'>
						".PPGLAN_04."
						<br /><br />
						<a href='gallery.php?id=".$id."' class='button'>".PPGLAN_03."</a>
					</p>
				";
			}
		}
		else
		{
			$caption=PPGLAN_05;
			$text="
				<p class='center'>
					".PPGLAN_04."
					<br /><br />
					<a href='gallery.php?id=".$id."' class='button'>".PPGLAN_03."</a>
				</p>
			";
		}
	}
	else
	{
		$caption=PPGLAN_05;
		$text="
			<p class='center'>
				".PPGLAN_04."
				<br /><br />
				<a href='gallery.php?id=".$id."' class='button'>".PPGLAN_03."</a>
			</p>
		";
	}

}
else
{
	$caption=PPGLAN_06;
	$text="
		<form action='".e_SELF."?id=".$id."' method='post' enctype='multipart/form-data'>
			<table style='width:100%;'>
				<tr>
					<td class='forumheader' style='vertical-align:middle;width:10%;'>".PPGLAN_12."</td>
					<td class='forumheader3'>
						<input type='file' name='source'>
					</td>
				</tr>
				<tr>
					<td class='forumheader' colspan='2'>
						".PPGLAN_07."
					</td>
				</tr>
				<tr>
					<td class='forumheader' style='vertical-align:middle'>".PPGLAN_08."</td>
					<td class='forumheader3'>
						<textarea class='tbox' name='description' placeholder='".PPGLAN_09."' style='width:95%;height:150px'></textarea>
					</td>
				</tr>
				<tr>
					<td class='fcaption center' colspan='2'>
						<input type='submit' class='button' name='save' value='".PPGLAN_10."' />
					</td>
				</tr>
			</table>
		</form>
	";
}

$text.=$inc;
$ns -> tablerender($caption,$text);

require_once(FOOTERF);
?> 