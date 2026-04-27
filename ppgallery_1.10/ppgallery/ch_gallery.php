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

if (isset($_GET['gallery']))
{
	//Zählen aller vorhandenen Datensätze in der MySQL-Tabelle
	$result=mysql_query("SELECT * FROM ".MPREFIX."ppgallery_images WHERE is_gallery='".intval($_GET['gallery'])."'");
	$menge=mysql_num_rows($result);

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
			".PPGLAN_24."
		</div>
		<br /><br />
		<a href='ch_gallery.php' class='ch_button'>".PPGLAN_25."</a>
		<br /><br />
		<table style='width:100%;'>
			<tr>
	";

	$count=1;
	$gql=mysql_query("SELECT * FROM ".MPREFIX."ppgallery_images WHERE is_gallery='".intval($_GET['gallery'])."' ORDER BY image DESC LIMIT $start, $show");
	while ($image=mysql_fetch_array($gql,MYSQL_ASSOC))
	{
		if (is_int($count/$zshow)) {$after="</tr><tr>";}
		$content.="
			<td class='forumheader3 center' valign='top'>
				<a href='ch_gallery.php?id=".$image['image']."' title='".$image['description']."' >
					<div class='ppgallery_preview' style='background-image:url(thumbs/".$image['source'].");width:".$width."px;height:".$width."px'></div>
				</a>
				".$alert."
			</td>
			".$after."
		";
		unset ($after);
		$count++;
	}
	$content.="</tr></table>";
	
	include "browse.php";
	
	$content.="
		<br />
		".PPGLAN_07." <a href='http://oyabunstyle.de' target='_blank'>Oyabunstyle.de</a>
	</div>
	
	</body>
	</html>";
}
elseif (isset($_GET['id']))
{
	$image=mysql_query("SELECT * FROM ".MPREFIX."ppgallery_images WHERE image='".intval($_GET['id'])."'");
	$image=mysql_fetch_array($image);
	
	$newphrase=str_replace("ch_gallery.php?id=".$_GET['id'],"",$_SERVER['REQUEST_URI']);
	$fix=str_replace("//","/",$newphrase);
	
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
		<div id='choose_title'>
			".PPGLAN_26."
		</div>
		<br />
		<a href='ch_gallery.php?gallery=".$image['is_gallery']."' class='ch_button'>".PPGLAN_25."</a>
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
		<br /><br />
		".PPGLAN_07." <a href='http://oyabunstyle.de' target='_blank'>Oyabunstyle.de</a>
	</div>
	
	</body>
	</html>";
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
			".PPGLAN_27."
		</div>
		<br /><br />
		<a href='choose.php' class='ch_button'>".PPGLAN_25."</a>
		<br /><br />
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
			$content.="
				<td class='forumheader3 center' valign='top'>
					<div class='center ppgallery_header'>".$gallery['name']."</div>
					<a href='ch_gallery.php?gallery=".$gallery['gallery']."' title='".$gallery['name']."'>
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
	$content.="
			</tr>
		</table>
		<br /><br /><br />
		".PPGLAN_07." <a href='http://oyabunstyle.de' target='_blank'>Oyabunstyle.de</a>
	</div>
	
	</body>
	</html>";
}
echo $content;
?>