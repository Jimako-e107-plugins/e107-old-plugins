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
	foreach ($_POST['gorder'] as $loid)
	{
	  $tmp=explode(".",$loid);
	  $sql->db_Update("ppgallery_gallerys", "gorder=".intval($tmp[1])." WHERE gallery=".intval($tmp[0]));
	}
	$ns -> tablerender($title,$text);
}
else
{
	$title=PPGLAN_01;
	
	$text="
	<form action='".e_SELF."' method='post'>
	<table style='width:100%;'>
		<tr>
			<td class='fcaption'>".PPGLAN_02."</td>
			<td class='fcaption center'>".PPGLAN_58."</td>
		</tr>
	";
		
	$gql=mysql_query("SELECT * FROM ".MPREFIX."ppgallery_gallerys WHERE gallery>'0' ORDER BY gorder DESC");
	while ($gallery=mysql_fetch_array($gql,MYSQL_ASSOC))
	{
		$text.="
			<tr>
				<td class='forumheader3' style='vertical-align:middle'>".$gallery['name']."</td>
				<td class='forumheader3 center' style='vertical-align:middle'>
					<select class='tbox' name='gorder[]'>
		";
		$count=1;
		$bql=mysql_query("SELECT * FROM ".MPREFIX."ppgallery_gallerys");
		while ($gallerys=mysql_fetch_array($bql,MYSQL_ASSOC))
		{
			if ($count==$gallery['gorder'])
			{
				$text.="<option value='".$gallery['gallery'].".".$count."' selected='selected'>".$count."</option>";
			}
			else
			{
				$text.="<option value='".$gallery['gallery'].".".$count."'>".$count."</option>";
			}
			$count++;
		}
		$text.="
					</select>
				</td>
			</tr>
		
		";
	}
	$text.="
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