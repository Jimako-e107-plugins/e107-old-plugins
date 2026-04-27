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
	$sql->db_Select_gen("UPDATE ".MPREFIX."ppgallery_gallerys
							SET viewclass='".$_POST['viewclass']."',
								addclass='".$_POST['addclass']."',
								adminclass='".$_POST['adminclass']."'
								WHERE gallery='".$_POST['id']."' ");
	$title=PPGLAN_17;
	$text="
		<form action='".e_SELF."' method='post'>
			<p class='center'>
				".PPGLAN_15."
				<br /><br />
				<input type='submit' class='button' value='".PPGLAN_16."' />
			</p>
		<form>
	";
	$ns -> tablerender($title, $text);
}
elseif (isset($_POST['thumbs']))
{
	$sql->db_Select_gen("UPDATE ".MPREFIX."ppgallery_pref
							SET width='".intval($_POST['width'])."'
							WHERE width>'0' ");
	
	$gql=mysql_query("SELECT * FROM ".MPREFIX."ppgallery_images WHERE image>'0'");
	while ($image=mysql_fetch_array($gql,MYSQL_ASSOC))
	{
		$imagename=$image['source'];
		$image_pfad="images/".$imagename;
		$thumb_pfad="thumbs/".$imagename;
		$temp="images/".$imagename;
		$imagetype=explode(".",$imagename);
		$imagetype=$imagetype[1];
		
		$breite_max=intval($_POST['width']);
		$hoehe_max=intval($_POST['width']);
		
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
		}
	}
	
	$title=PPGLAN_17;
	$text="
		<form action='".e_SELF."' method='post'>
			<p class='center'>
				".PPGLAN_15."
				<br /><br />
				<input type='submit' class='button' value='".PPGLAN_16."' />
			</p>
		<form>
	";
	$ns -> tablerender($title, $text);
}
elseif (isset($_POST['p']))
{
	$sql->db_Select_gen("UPDATE ".MPREFIX."ppgallery_pref
							SET pshow='".intval($_POST['pshow'])."'
							WHERE width>'0' ");
							
	$title=PPGLAN_17;
	$text="
		<form action='".e_SELF."' method='post'>
			<p class='center'>
				".PPGLAN_15."
				<br /><br />
				<input type='submit' class='button' value='".PPGLAN_16."' />
			</p>
		<form>
	";
	$ns -> tablerender($title, $text);
}
elseif (isset($_POST['z']))
{
	$sql->db_Select_gen("UPDATE ".MPREFIX."ppgallery_pref
							SET zshow='".intval($_POST['zshow'])."'
							WHERE width>'0' ");
							
	$title=PPGLAN_17;
	$text="
		<form action='".e_SELF."' method='post'>
			<p class='center'>
				".PPGLAN_15."
				<br /><br />
				<input type='submit' class='button' value='".PPGLAN_16."' />
			</p>
		<form>
	";
	$ns -> tablerender($title, $text);
}
else
{
	$title=PPGLAN_49;
	$pref=mysql_query("SELECT * FROM ".MPREFIX."ppgallery_pref WHERE width>'0'");
	$pref=mysql_fetch_array($pref);
	$text="
	<form action='".e_SELF."' method='post'>
		<table style='width:100%;'>
			<tr>
				<td class='fcaption' colspan='3'>
					".PPGLAN_50."
				</td>
			</tr>
			<tr>
				<td class='fcaption' style='vertical-align:middle;width:15%'>".PPGLAN_51."</td>
				<td class='forumheader3' style='vertical-align:middle'>
					<input type='text' name='width' class='tbox' value='".$pref['width']."' size='5'/> ".PPGLAN_52."
				</td>
				<td class='forumheader3' style='vertical-align:middle;text-align:center;'>
					<input type='submit' class='button' name='thumbs' value='".PPGLAN_13."' />
				</td>
			</tr>
			<tr>
				<td class='fcaption' colspan='3'>
					".PPGLAN_53."
				</td>
			</tr>
			<tr>
				<td class='fcaption' style='vertical-align:middle'>".PPGLAN_54."</td>
				<td class='forumheader3' style='vertical-align:middle'>
					<input type='text' name='pshow' class='tbox' value='".$pref['pshow']."' size='5'/> ".PPGLAN_55."
				</td>
				<td class='forumheader3' style='vertical-align:middle;text-align:center;'>
					<input type='submit' class='button' name='p' value='".PPGLAN_13."' />
				</td>
			</tr>
			<tr>
				<td class='fcaption' colspan='3'>
					".PPGLAN_56."
				</td>
			</tr>
			<tr>
				<td class='fcaption' style='vertical-align:middle'>".PPGLAN_54."</td>
				<td class='forumheader3' style='vertical-align:middle'>
					<input type='text' name='zshow' class='tbox' value='".$pref['zshow']."' size='5'/> ".PPGLAN_57."
				</td>
				<td class='forumheader3' style='vertical-align:middle;text-align:center;'>
					<input type='submit' class='button' name='z' value='".PPGLAN_13."' />
				</td>
			</tr>
		</table>
	</form>
	";
	$ns -> tablerender($title,$text);
	$title=PPGLAN_01;
	$text="
	<table style='width:100%;'>
		<tr>
			<td class='fcaption'>".PPGLAN_02."</td>
			<td class='fcaption center'>".PPGLAN_03."</td>
			<td class='fcaption center'>".PPGLAN_04."</td>
			<td class='fcaption center'>".PPGLAN_05."</td>
			<td class='fcaption center'>".PPGLAN_06."</td>
			<td class='fcaption center'>".PPGLAN_07."</td>
		</tr>
	";
	$gql=mysql_query("SELECT * FROM ".MPREFIX."ppgallery_gallerys WHERE gallery>'0'");
	while ($gallery=mysql_fetch_array($gql,MYSQL_ASSOC))
	{
		$imagecount=$sql->db_Count("ppgallery_images","(*)", "WHERE is_gallery='".$gallery['gallery']."'");
		$text.="
		<form action='".e_SELF."' method='post'>
			<tr>
				<td class='forumheader3' style='vertical-align:middle'>".$gallery['name']."</td>
				<td class='forumheader3 center' style='vertical-align:middle'>".$imagecount."</td>
				<td class='forumheader3 center' style='vertical-align:middle'>	
					<select class='tbox' name='viewclass'>
						<option value='0'
		";
		if ($gallery['viewclass']=='0') {$text.="selected='selected'";}
		$text.="		>".PPGLAN_08."</option>
						<option value='253'
		";
		if ($gallery['viewclass']=='253') {$text.="selected='selected'";}
		$text.="		>".PPGLAN_09."</option>
		";
		$cql=mysql_query("SELECT * FROM ".MPREFIX."userclass_classes WHERE userclass_id>'0'");
		while ($classes=mysql_fetch_array($cql,MYSQL_ASSOC))
		{
			$text.="	<option value='".$classes['userclass_id']."'
			";
			if ($gallery['viewclass']==$classes['userclass_id']) {$text.="selected='selected'";}
			$text.="		>".$classes['userclass_name']."</option>
			";
		}
		$text.="
						<option value='254'
		";
		if ($gallery['viewclass']=='254') {$text.="selected='selected'";}
		$text.="		>".PPGLAN_10."</option>
						<option value='250'
		";
		if ($gallery['viewclass']=='250') {$text.="selected='selected'";}
		$text.="		>".PPGLAN_11."</option>
						<option value='255'
		";
		if ($gallery['viewclass']=='255') {$text.="selected='selected'";}
		$text.="		>".PPGLAN_12."</option>
					</select>
				</td>
				<td class='forumheader3 center' style='vertical-align:middle'>
					<select class='tbox' name='addclass'>
						<option value='253'
		";
		if ($gallery['addclass']=='253') {$text.="selected='selected'";}
		$text.="		>".PPGLAN_09."</option>
		";
		$cql=mysql_query("SELECT * FROM ".MPREFIX."userclass_classes WHERE userclass_id>'0'");
		while ($classes=mysql_fetch_array($cql,MYSQL_ASSOC))
		{
			$text.="	<option value='".$classes['userclass_id']."'
			";
			if ($gallery['addclass']==$classes['userclass_id']) {$text.="selected='selected'";}
			$text.="		>".$classes['userclass_name']."</option>
			";
		}
		$text.="
						<option value='254'
		";
		if ($gallery['addclass']=='254') {$text.="selected='selected'";}
		$text.="		>".PPGLAN_10."</option>
						<option value='250'
		";
		if ($gallery['addclass']=='250') {$text.="selected='selected'";}
		$text.="		>".PPGLAN_11."</option>
						<option value='255'
		";
		if ($gallery['addclass']=='255') {$text.="selected='selected'";}
		$text.="		>".PPGLAN_12."</option>
					</select>
				</td>
				<td class='forumheader3 center' style='vertical-align:middle'>
					<select class='tbox' name='adminclass'>
		";
		$cql=mysql_query("SELECT * FROM ".MPREFIX."userclass_classes WHERE userclass_id>'0'");
		while ($classes=mysql_fetch_array($cql,MYSQL_ASSOC))
		{
			$text.="	<option value='".$classes['userclass_id']."'
			";
			if ($gallery['adminclass']==$classes['userclass_id']) {$text.="selected='selected'";}
			$text.="		>".$classes['userclass_name']."</option>
			";
		}
		$text.="
						<option value='254'
		";
		if ($gallery['adminclass']=='254') {$text.="selected='selected'";}
		$text.="		>".PPGLAN_10."</option>
						<option value='250'
		";
		if ($gallery['adminclass']=='250') {$text.="selected='selected'";}
		$text.="		>".PPGLAN_11."</option>
					</select>
				</td>
				<td class='forumheader3 center' style='vertical-align:middle'>
						<input type='hidden' name='id' value='".$gallery['gallery']."' />
						<input type='submit' class='button' name='save' value='".PPGLAN_13."' />
						</form>
						<form action='edit_gallery.php' method='get' style='display:inline'>
							<input type='hidden' name='id' value='".$gallery['gallery']."' />
							<input type='submit' class='button' name='detail' value='".PPGLAN_14."' />
						</form>
				</td>
			</tr>
		
		";
	}
	$text.="
	</table>
	";
	$ns -> tablerender($title,$text);
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