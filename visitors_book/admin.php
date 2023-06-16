<?php
/*
*************************************
*        Visitors Book				*
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
include_lan(e_PLUGIN."visitors_book/languages/".e_LANGUAGE."/admin.php");

if (!isset($pref['plug_installed']['aa_jquery']))
{
	$title=WARNING_01;
	$text=WARNING_02;
	$ns -> tablerender($title, $text);
}

if(isset($_POST['save']))
{
	$sql->db_Select_gen("UPDATE ".MPREFIX."visitors_book_prefs
							SET admin='".abs($_POST['admin'])."'");
	$title=VIBO_LAN_12;
	$text="
		<form action='".e_SELF."' method='post'>
			<p class='center'>
				".VIBO_LAN_13."
				<br /><br />
				<input type='submit' class='button' value='".VIBO_LAN_08."' />
			</p>
		<form>
	";
	$ns -> tablerender($title, $text);
}
else
{
	$bivo_pref=mysql_query("SELECT * FROM ".MPREFIX."visitors_book_prefs WHERE admin>'-0'");
	$bivo_pref=mysql_fetch_array($bivo_pref);
	
	$title=VIBO_LAN_01;
	$text="
	<form action='".e_SELF."' method='post'>
		<table style='width:100%;'>
			<tr>
				<td class='fcaption' style='vertical-align:middle;'>
					".VIBO_LAN_02."
				</td>
				<td class='forumheader3' style='vertical-align:middle;'>
					<select class='tbox' name='admin'>
						<option value='0'
		";
		if ($bivo_pref['admin']=='0') {$text.="selected='selected'";}
		$text.="		>".VIBO_LAN_06."</option>
						<option value='253'
		";
		if ($bivo_pref['admin']=='253') {$text.="selected='selected'";}
		$text.="		>".VIBO_LAN_07."</option>
		";
		$cql=mysql_query("SELECT * FROM ".MPREFIX."userclass_classes WHERE userclass_id>'0'");
		while ($classes=mysql_fetch_array($cql,MYSQL_ASSOC))
		{
			$text.="	<option value='".$classes['userclass_id']."'
			";
			if ($bivo_pref['admin']==$classes['userclass_id']) {$text.="selected='selected'";}
			$text.="		>".$classes['userclass_name']."</option>
			";
		}
		$text.="
						<option value='254'
		";
		if ($bivo_pref['admin']=='254') {$text.="selected='selected'";}
		$text.="		>".VIBO_LAN_09."</option>
						<option value='250'
		";
		if ($bivo_pref['admin']=='250') {$text.="selected='selected'";}
		$text.="		>".VIBO_LAN_10."</option>
						<option value='255'
		";
		if ($bivo_pref['admin']=='255') {$text.="selected='selected'";}
		$text.="		>".VIBO_LAN_11."</option>
					</select>
				</td>
			</tr>
			<tr>
				<td class='forumheader' colspan='2'>
					".VIBO_LAN_03."
				</td>
			</tr>
			<tr>
				<td class='forumheader2' colspan='2' style='text-align:center'>
					<input type='submit' class='button' name='save' value='".VIBO_LAN_05."' />
				</td>
			</tr>
		</table>
	</form>
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