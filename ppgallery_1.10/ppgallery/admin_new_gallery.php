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

if (isset($_POST['create']))
{
	$sql->db_Select_gen("INSERT INTO ".MPREFIX."ppgallery_gallerys
							(name, description, viewclass, addclass, adminclass, gorder) 
							VALUES ('".$tp->toDB($_POST["name"])."',
									'".$tp->toDB($_POST["description"])."',
									'".$_POST['viewclass']."',
									'".$_POST['addclass']."',
									'".$_POST['adminclass']."',
									'".$_POST['gorder']."')");
	$title=PPGLAN_17;
	$text="
		<form action='".e_SELF."' method='post'>
			<p class='center'>
				".PPGLAN_59."
				<br /><br />
				<input type='submit' class='button' value='".PPGLAN_16."' />
			</p>
		<form>
	";
	$ns -> tablerender($title, $text);
}
else
{
	$title=PPGLAN_60;
	$text="
		<form action='".e_SELF."' method='post'>
			<table style='width:100%;'>
				<tr>
					<td class='fcaption' style='vertical-align:middle;width:10%;'>".PPGLAN_02."</td>
					<td class='forumheader3'>
						<input type='text' class='tbox' name='name' size='35'></input>
					</td>
				</tr>
				<tr>
					<td class='fcaption' style='vertical-align:middle'>".PPGLAN_19."</td>
					<td class='forumheader3'>
						<textarea class='tbox' name='description' placeholder='".PPGLAN_20."' style='width:95%;height:150px;'></textarea>
					</td>
				</tr>
				<tr>
					<td class='fcaption' style='vertical-align:middle'>".PPGLAN_04."</td>
					<td class='forumheader3'>
						<select class='tbox' name='viewclass'>
							<option value='0' selected='selelected'>".PPGLAN_08."</option>
							<option value='253'>".PPGLAN_09."</option>
			";
			$cql=mysql_query("SELECT * FROM ".MPREFIX."userclass_classes WHERE userclass_id>'0'");
			while ($classes=mysql_fetch_array($cql,MYSQL_ASSOC))
			{
				$text.="	<option value='".$classes['userclass_id']."'>".$classes['userclass_name']."</option>";
			}
			$text.="
							<option value='254'>".PPGLAN_10."</option>
							<option value='250'>".PPGLAN_11."</option>
							<option value='255'>".PPGLAN_12."</option>
						</select>
					</td>
				</tr>
				<tr>
					<td class='fcaption' style='vertical-align:middle'>".PPGLAN_05."</td>
					<td class='forumheader3'>
						<select class='tbox' name='addclass'>
							<option value='253' selected='selelected'>".PPGLAN_09."</option>
			";
			$cql=mysql_query("SELECT * FROM ".MPREFIX."userclass_classes WHERE userclass_id>'0'");
			while ($classes=mysql_fetch_array($cql,MYSQL_ASSOC))
			{
				$text.="	<option value='".$classes['userclass_id']."'>".$classes['userclass_name']."</option>";
			}
			$text.="
							<option value='254'>".PPGLAN_10."</option>
							<option value='250'>".PPGLAN_11."</option>
							<option value='255'>".PPGLAN_12."</option>
						</select>
					</td>
				</tr>
				<tr>
					<td class='fcaption' style='vertical-align:middle'>".PPGLAN_06."</td>
					<td class='forumheader3'>
						<select class='tbox' name='adminclass'>
			";
			$cql=mysql_query("SELECT * FROM ".MPREFIX."userclass_classes WHERE userclass_id>'0'");
			while ($classes=mysql_fetch_array($cql,MYSQL_ASSOC))
			{
				$text.="	<option value='".$classes['userclass_id']."'>".$classes['userclass_name']."</option>";
			}
			$text.="
							<option value='254' selected='selelected'>".PPGLAN_10."</option>
							<option value='250'>".PPGLAN_11."</option>
						</select>
					</td>
				</tr>
				<tr>
					<td class='fcaption' style='vertical-align:middle'>".PPGLAN_58."</td>
					<td class='forumheader3'>
						<select class='tbox' name='gorder'>
			";
			$count=1;
			$gql=mysql_query("SELECT * FROM ".MPREFIX."ppgallery_gallerys");
			while ($gallerys=mysql_fetch_array($gql,MYSQL_ASSOC))
			{
				$text.="<option value='".$count."'>".$count."</option>";
				$count++;
			}
			
			$text.="		<option value='".$count."' selected='selected'>".$count."</option>
						</select>
					</td>
				</tr>
				<tr>
					<td class='fcaption center' colspan='2'>
						<input type='submit' class='button' name='create' value='".PPGLAN_13."' />
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