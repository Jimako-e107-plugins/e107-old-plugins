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
require_once("pref.php");
include_lan(e_PLUGIN."ppgallery/languages/".e_LANGUAGE."/choose.php");

if (isset($_POST['save']))
{
	$content="
	<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
	<html xmlns='http://www.w3.org/1999/xhtml'>
	<head>
	<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
	<title>".PPGLAN_01."</title>
	<link href='stuff/style.css' rel='stylesheet' type='text/css' />
	<link href='stuff/prettyPhoto.css' rel='stylesheet' type='text/css' />
	<script src='stuff/jquery.js' language='javascript'></script>
	<script src='stuff/script.js' language='javascript'></script>
	<script src='stuff/prettyPhoto.js' language='javascript'></script>
	
	</head>
	<body class='ch'>
	<div id='ch-spacer'></div>
	<a href='javascript:window.close()' id='ch_close' class='ch_button'>".PPGLAN_08."</a>
	<div id='choose'>
		<div id='choose_title'>";
	if ($_FILES['source']['name']!="")
	{	
		if (is_uploaded_file($_FILES['source']['tmp_name']))
		{
			$imagetype=pathinfo($_FILES['source']['name']);
			$imagetype=$imagetype['extension'];
			$imagetype=strtolower($imagetype);
						
			if (($imagetype=="jpg")or($imagetype=="jpeg")or($imagetype=="png"))
			{
				$newphrase=str_replace("ch_new.php","",$_SERVER['REQUEST_URI']);
				$fix=str_replace("//","/",$newphrase);
				
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
									VALUES ('".$_POST['gallery']."',
											'".$imagename."',
											'".USERID."',
											'0',
											'".$description."')");
					$content.="Meldung
						</div>
						<br /><br />
							".PPGLAN_09."
						<br /><br />
					";
					$image=mysql_query("SELECT * FROM ".MPREFIX."ppgallery_images WHERE source='".$imagename."'");
					$image=mysql_fetch_array($image);
					
					$content.="
							<div class='choose_title'>
							".PPGLAN_12."
						</div>
						<table style='width:100%;'>
							<tr>
								<td class='forumheader3' valign='top' align='left'>
									<a href='images/".$image['source']."' rel='prettyPhoto' title='".$image['description']."' class='pp_leftfloat'>
										<img class='ppgallery_image' src='thumbs/".$image['source']."' />
									</a>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.
								</td>
							</tr>
							<tr>
								<td class='forumheader3' valign='top' align='left'>
									<textarea class='ch_textarea'>[pp_left=".SITEURLBASE.$fix."images/".$image['source']."][img]".SITEURLBASE.$fix."thumbs/".$image['source']."[/img][/pp_left]</textarea>
								</td>
							</tr>
						</table>
						<div class='choose_title'>
							".PPGLAN_13."
						</div>
						<table style='width:100%;'>
							<tr>
								<td class='forumheader3' valign='top' align='left'>
									<a href='images/".$image['source']."' rel='prettyPhoto' title='".$image['description']."' class='pp_rightfloat'>
										<img class='ppgallery_image' src='thumbs/".$image['source']."' />
									</a>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.
								</td>
							</tr>
							<tr>
								<td class='forumheader3' valign='top' align='left'>
									<textarea class='ch_textarea'>[pp_right=".SITEURLBASE.$fix."images/".$image['source']."][img]".SITEURLBASE.$fix."thumbs/".$image['source']."[/img][/pp_right]</textarea>
								</td>
							</tr>
						</table>
						<div class='choose_title'>
							".PPGLAN_14."
						</div>
						<table style='width:100%;'>
							<tr>
								<td class='forumheader3' valign='top' align='left'>
									<a href='images/".$image['source']."' rel='prettyPhoto' title='".$image['description']."' >
										<img class='ppgallery_image' src='thumbs/".$image['source']."' />
									</a>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.
								</td>
							</tr>
							<tr>
								<td class='forumheader3' valign='top' align='left'>
									<textarea class='ch_textarea'>[pp=".SITEURLBASE.$fix."images/".$image['source']."][img]".SITEURLBASE.$fix."thumbs/".$image['source']."[/img][/pp]</textarea>
								</td>
							</tr>
						</table>
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
									VALUES ('".$_POST['gallery']."',
											'".$imagename."',
											'".USERID."',
											'0',
											'".$description."')");
					$content.="".PPGLAN_10."
						</div>
						<br />
							B".PPGLAN_11."
						<br /><br />
					";
					$image=mysql_query("SELECT * FROM ".MPREFIX."ppgallery_images WHERE source='".$imagename."'");
					$image=mysql_fetch_array($image);
					
					$content.="
							<div class='choose_title'>
							".PPGLAN_12."
						</div>
						<table style='width:100%;'>
							<tr>
								<td class='forumheader3' valign='top' align='left'>
									<a href='images/".$image['source']."' rel='prettyPhoto' title='".$image['description']."' class='pp_leftfloat'>
										<img class='ppgallery_image' src='thumbs/".$image['source']."' />
									</a>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.
								</td>
							</tr>
							<tr>
								<td class='forumheader3' valign='top' align='left'>
									<textarea class='ch_textarea'>[pp_left=".SITEURLBASE.$fix."images/".$image['source']."][img]".SITEURLBASE.$fix."thumbs/".$image['source']."[/img][/pp_left]</textarea>
								</td>
							</tr>
						</table>
						<div class='choose_title'>
							".PPGLAN_13."
						</div>
						<table style='width:100%;'>
							<tr>
								<td class='forumheader3' valign='top' align='left'>
									<a href='images/".$image['source']."' rel='prettyPhoto' title='".$image['description']."' class='pp_rightfloat'>
										<img class='ppgallery_image' src='thumbs/".$image['source']."' />
									</a>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.
								</td>
							</tr>
							<tr>
								<td class='forumheader3' valign='top' align='left'>
									<textarea class='ch_textarea'>[pp_right=".SITEURLBASE.$fix."images/".$image['source']."][img]".SITEURLBASE.$fix."thumbs/".$image['source']."[/img][/pp_right]</textarea>
								</td>
							</tr>
						</table>
						<div class='choose_title'>
							".PPGLAN_14."
						</div>
						<table style='width:100%;'>
							<tr>
								<td class='forumheader3' valign='top' align='left'>
									<a href='images/".$image['source']."' rel='prettyPhoto' title='".$image['description']."' >
										<img class='ppgallery_image' src='thumbs/".$image['source']."' />
									</a>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.
								</td>
							</tr>
							<tr>
								<td class='forumheader3' valign='top' align='left'>
									<textarea class='ch_textarea'>[pp=".SITEURLBASE.$fix."images/".$image['source']."][img]".SITEURLBASE.$fix."thumbs/".$image['source']."[/img][/pp]</textarea>
								</td>
							</tr>
						</table>
					";
				}
				else
				{
					$content.="".PPGLAN_15."
						</div>
						<br /><br />
							".PPGLAN_16."
						<br /><br />
					";
				}
			}
			else 
			{
				$content.="".PPGLAN_15."
					</div>
					<br /><br />
					".PPGLAN_16."
					<br /><br />
				";
			}
		}
		else
		{
			$content.="".PPGLAN_15."
				</div>
				<br /><br />
				".PPGLAN_16."				
				<br /><br />
			";
		}
	}
	else
	{
		$content.="".PPGLAN_15."
			</div>
			<br /><br />
			".PPGLAN_16."
			<br /><br />
		";
	}
	$content.="
		<br /><br />
		".PPGLAN_07." <a href='http://oyabunstyle.de' target='_blank'>Oyabunstyle.de</a>
	</div>
	
	</body>
	</html>
	";
}
else
{
	$content="
	<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
	<html xmlns='http://www.w3.org/1999/xhtml'>
	<head>
	<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
	<title>".PPGLAN_01."</title>
	<link href='stuff/style.css' rel='stylesheet' type='text/css' />
	
	</head>
	<body class='ch'>
	<div id='ch-spacer'></div>
	<a href='javascript:window.close()' id='ch_close' class='ch_button'>".PPGLAN_08."</a>
	<div id='choose'>
		<div id='choose_title'>
			".PPGLAN_17."
		</div>
		<br />
		<form action='".e_SELF."' method='post' enctype='multipart/form-data'>
			<table style='width:100%;text-align:left;'>
				<tr>
					<td style='vertical-align:middle;width:10%;font-weight:bold;padding:4px'>".PPGLAN_18."</td>
					<td style='padding:4px'>
						<select class='tbox' name='gallery'>
	";
	$gql=mysql_query("SELECT * FROM ".MPREFIX."ppgallery_gallerys WHERE gallery>'0' ORDER BY gorder DESC");
	while ($gallery=mysql_fetch_array($gql,MYSQL_ASSOC))
	{
		if(check_class($gallery['viewclass']))
		{
			$content.="<option value='".$gallery['gallery']."'>".$gallery['name']."</option>";
		}
	}
	$content.="
						</select>
					</td>
				</tr>
				<tr>
					<td style='vertical-align:middle;width:10%;font-weight:bold;padding:4px'>".PPGLAN_19."</td>
					<td style='padding:4px'>
						<input type='file' name='source'>
					</td>
				</tr>
				<tr>
					<td colspan='2' style='font-weight:bold;padding:4px'>
						".PPGLAN_20."
					</td>
				</tr>
				<tr>
					<td style='vertical-align:middle;font-weight:bold;padding:4px'>".PPGLAN_21."</td>
					<td style='padding:4px'>
						<textarea class='tbox' name='description' placeholder='".PPGLAN_22."' style='width:95%;height:150px'></textarea>
					</td>
				</tr>
				<tr>
					<td colspan='2' style='font-weight:bold;padding:4px;text-align:center;'>
						<input type='submit' class='ch_button' name='save' value='".PPGLAN_23."' />
					</td>
				</tr>
			</table>
		</form><br />
		".PPGLAN_07." <a href='http://oyabunstyle.de' target='_blank'>Oyabunstyle.de</a>
	</div>
	
	</body>
	</html>
	";

}

echo $content;
?>