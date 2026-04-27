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
$eplug_admin=TRUE;
require_once("../../class2.php");
if (!defined('e107_INIT')){exit;}
if(!getperms("P")){header("location:".e_BASE."index.php"); exit; }
require_once(e_ADMIN."auth.php");
include_lan(e_PLUGIN."ppgallery/languages/".e_LANGUAGE."/admin.php");

if (!isset($pref['plug_installed']['aa_jquery']))
{
	$title=WARNING_01;
	$text=WARNING_02;
	$ns -> tablerender($title, $text);
}

if (isset($_POST['save']))
{
	$type=explode(".",$_POST['source']);
	$imagetype=$type[count($type)-1];
	rename("images/".$_POST['source'],"images/".USERID.time().".".$imagetype."");
	$file_name=USERID.time().".".$imagetype;
	
	$quelle="images/".$file_name;
	$ziel="thumbs/".$file_name;
	
	$pref=mysql_query("SELECT * FROM ".MPREFIX."ppgallery_pref WHERE width>'0'");
	$pref=mysql_fetch_array($pref);

	$breite_max=$pref['width'];
	$hoehe_max=$pref['width'];
	
	$size=getimagesize("images/".$file_name); 
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
	
	if ((strtolower($imagetype)=="jpg")or(strtolower($imagetype)=="jpeg"))
	{
		$altesBild=imagecreatefromjpeg($quelle);
		$neuesBild=imagecreatetruecolor($neueBreite,$neueHoehe);
		imagecopyresized($neuesBild,$altesBild,0,0,0,0,$neueBreite,$neueHoehe,$breite,$hoehe);
		imagejpeg($neuesBild,$ziel);
		
		$description=$tp->toDB($_POST["description"]);
		$description=strip_tags($description);
		
		$sql->db_Select_gen("INSERT INTO ".MPREFIX."ppgallery_images
								(is_gallery, source, owner, checked, description) 
								VALUES ('".$_POST['is_gallery']."',
										'".$file_name."',
										'".USERID."',
										'".time()."',
										'".$description."')");
		$title=PPGLAN_17;
		$text="
			<form action='".e_SELF."' method='post'>
				<p class='center'>
					".PPGLAN_30."
					<br /><br />
					<input type='submit' class='button' value='".PPGLAN_16."' />
				</p>
			<form>
		";
		$ns -> tablerender($title,$text);
	}
	elseif (strtolower($imagetype)=="png")
	{
		$altesBild=imagecreatefrompng($quelle); 
		$neuesBild=imagecreatetruecolor($neueBreite,$neueHoehe);
		$color=imagecolorallocatealpha($neuesBild,0,0,0,127); 
		imagefill($neuesBild,0,0,$color);
		imagecopyresampled($neuesBild,$altesBild,0,0,0,0,$neueBreite,$neueHoehe,$breite,$hoehe);
		imagesavealpha($neuesBild,true);
		//imagedestroy ($image_pfad);
		imagepng($neuesBild,$ziel);
		
		$description=$tp->toDB($_POST["description"]);
		$description=strip_tags($description);
				
		$sql->db_Select_gen("INSERT INTO ".MPREFIX."ppgallery_images
								(is_gallery, source, owner, checked, description) 
								VALUES ('".$_POST['is_gallery']."',
										'".$file_name."',
										'".USERID."',
										'".time()."',
										'".$description."')");
		$title=PPGLAN_17;
		$text="
			<form action='".e_SELF."' method='post'>
				<p class='center'>
					".PPGLAN_30."
					<br /><br />
					<input type='submit' class='button' value='".PPGLAN_16."' />
				</p>
			<form>
		";
		$ns -> tablerender($title,$text);
	}
	elseif ($_POST['source']=="")
	{
		$title=PPGLAN_17;
		$message="
			<form action='".e_SELF."' method='post'>
				<p class='center'>
					".PPGLAN_31."
					<br /><br />
					<input type='submit' class='button' value='".PPGLAN_16."' />
				</p>
			<form>
		";
		$ns -> tablerender($title,$message);
	}
	else
	{
		$title=PPGLAN_17;
		$message="
			<form action='".e_SELF."' method='post'>
				<p class='center'>
					".PPGLAN_32."
					<br /><br />
					<input type='submit' class='button' value='".PPGLAN_16."' />
				</p>
			<form>
		";
		$ns -> tablerender($title,$message);
	}
}
else
{
	$title=PPGLAN_33;
	$text="
		<form action='".e_SELF."' method='post'>
			<table style='width:100%;'>
				<tr>
					<td class='fcaption center' colspan='2'>
						".PPGLAN_34."
					</td>
				</tr>
				<tr>
					<td class='fcaption' style='vertical-align:middle;width:10%;'>".PPGLAN_27."</td>
					<td class='forumheader3'>
						<table style='width:100%;'>
							<tr>
	";
	$count=1;
	$verzeichnis=openDir("".e_PLUGIN."ppgallery/images");
	while ($file=readDir($verzeichnis))
	{
		if (is_int($count/3)) {$after="</tr><tr>";}
		if ($count==10){break;}
		if ($file!="." && $file != ".." && !is_dir($file)) {
			if (strstr($file, ".png") ||
				strstr($file, ".jpg"))
			{
				$bild1=mysql_query("SELECT source FROM ".MPREFIX."ppgallery_images WHERE source='$file'");
				$bild1=mysql_fetch_array($bild1);
				$bild1=$bild1['source'];
				if ($file!=$bild1) {$text.="<td><input type='radio' name='source' value='$file'><img src='images/$file' style='max-width:200px;' /></td>".$after;unset($after);$count++;}

			}
		}
	}
	$text.="			</tr></table>
					</td>
				</tr>
				<tr>
					<td class='fcaption' style='vertical-align:middle'>".PPGLAN_19."</td>
					<td class='forumheader3'>
						<textarea class='tbox' name='description' placeholder='".PPGLAN_23."' style='width:95%;height:150px;'></textarea>
					</td>
				</tr>
				<tr>
					<td class='fcaption' style='vertical-align:middle'>".PPGLAN_24."</td>
					<td class='forumheader3'>
						<select class='tbox' name='is_gallery'>
			";
			$cql=mysql_query("SELECT * FROM ".MPREFIX."ppgallery_gallerys WHERE gallery>'0' ORDER BY gorder DESC");
			while ($gallery=mysql_fetch_array($cql,MYSQL_ASSOC))
			{
				$text.="	<option value='".$gallery['gallery']."'>".$gallery['name']."</option>";
			}
			$text.="
						</select>
					</td>
				</tr>
				<tr>
					<td class='fcaption center' colspan='2'>
						<input type='submit' class='button' name='save' value='".PPGLAN_13."' />
					</td>
				</tr>
			</table>
		</form>
	";
	$ns -> tablerender($title, $text);
}
$text="
<div style='margin:0 auto;width:600px;height:100px;'>
	<br />
	<a href='http://oyabunstyle.de' onclick='window.open(this.href);return false;' style='float:left;'>
		<img src='stuff/LinkMe.png' alt='Powered by Oyabunstyle.de' />
	</a>
	<div id='fb-root' style='float:left;padding:0 10px'></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = '//connect.facebook.net/de_DE/all.js#xfbml=1&appId=200248436689702';
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<div class='fb-like' data-href='http://www.facebook.com/Oyabunstyle.de' data-send='false' data-layout='box_count' data-width='450' data-show-faces='false' data-font='arial' style='float:left;padding:0 10px'></div>
</p>";
$ns -> tablerender($text);
require_once(e_ADMIN."footer.php");
?>