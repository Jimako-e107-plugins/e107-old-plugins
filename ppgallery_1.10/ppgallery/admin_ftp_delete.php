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
	unlink("images/".$_POST['source']);
	$title=PPGLAN_17;
	$text="
		<form action='".e_SELF."' method='post'>
			<p class='center'>
				".PPGLAN_29."
				<br /><br />
				<input type='submit' class='button' value='".PPGLAN_16."' />
			</p>
		<form>
	";
	$ns -> tablerender($title,$text);
}
else
{
	$title=PPGLAN_25;
	$text="
		<form action='".e_SELF."' method='post'>
			<table style='width:100%;'>
				<tr>
					<td class='fcaption center' colspan='2'>
						".PPGLAN_26."
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
			if (strstr($file, ".gif") ||
				strstr($file, ".png") ||
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
					<td class='fcaption center' colspan='2'>
						<input type='submit' class='button' name='delete' value='".PPGLAN_28."' />
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