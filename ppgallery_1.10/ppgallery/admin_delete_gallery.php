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

if (isset($_POST['delete']))
{
	$title=PPGLAN_43;
	
	$imagecount=$sql->db_Count("ppgallery_images","(*)", "WHERE is_gallery='".$_POST['id']."'");
	
	$text="
		<form action='".e_SELF."' method='post'>
			<p class='center'>
				".PPGLAN_44." ".$imagecount." ".PPGLAN_45."
				<br /><br />
				<input type='hidden' name='id' value='".$_POST['id']."' />
				<input type='submit' class='button' name='yes' value='".PPGLAN_46."' />
				<input type='submit' class='button' value='".PPGLAN_47."' />
			</p>
		<form>
	";
}
elseif (isset($_POST['yes']))
{
	$gql=mysql_query("SELECT * FROM ".MPREFIX."ppgallery_images WHERE is_gallery='".$_POST['id']."'");
	while ($image=mysql_fetch_array($gql,MYSQL_ASSOC))
	{
		unlink("images/".$image['source']);
		unlink("thumbs/".$image['source']);
	}

	$sql->db_Select_gen("DELETE FROM ".MPREFIX."ppgallery_images WHERE is_gallery='".$_POST['id']."'");
	$sql->db_Select_gen("DELETE FROM ".MPREFIX."ppgallery_gallerys WHERE gallery='".$_POST['id']."'");
	
	$title=PPGLAN_17;
	$text="
		<form action='".e_SELF."' method='post'>
			<p class='center'>
				".PPGLAN_48."
				<br /><br />
				<input type='submit' class='button' value='".PPGLAN_16."' />
			</p>
		<form>
	";
}
else
{
	$title=PPGLAN_42;
	
	$text="
	<table style='width:100%;'>
		<tr>
			<td class='fcaption'>".PPGLAN_02."</td>
			<td class='fcaption center'>".PPGLAN_03."</td>
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
						<form action='".e_SELF."' method='post' style='display:inline'>
							<input type='hidden' name='id' value='".$gallery['gallery']."' />
							<input type='submit' class='button' name='delete' value='".PPGLAN_42."' />
						</form>
				</td>
			</tr>
		
		";
	}
	$text.="
	</table>
	";
}
$ns -> tablerender($title,$text);
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