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
include_lan(e_PLUGIN."ppgallery/languages/".e_LANGUAGE."/admin.php");

$gallery=mysql_query("SELECT * FROM ".MPREFIX."ppgallery_gallerys WHERE gallery='".$id."'");
$gallery=mysql_fetch_array($gallery);
if($gallery==""){header("location:".e_BASE."index.php");exit;}
if(check_class($gallery['adminclass'])) {} else {header("location:".e_BASE."index.php");exit;}

if (isset($_POST['save']))
{
	$sql->db_Select_gen("UPDATE ".MPREFIX."ppgallery_gallerys
							SET name='".$tp->toDB($_POST["name"])."',
								viewclass='".$_POST['viewclass']."',
								addclass='".$_POST['addclass']."',
								description='".$tp->toDB($_POST["description"])."'
								WHERE gallery='".$_POST['id']."' ");
	$title=PPGLAN_17;
	$text="
		<p class='center'>
			".PPGLAN_15."
			<br /><br />
			<a href='gallery.php?id=".$id."' class='button'>".PPGLAN_21."</a>
		</p>
	";
	$text.=$inc;
	$ns -> tablerender($title, $text);
}
else
{
	$title=PPGLAN_18;
	
	$text="
	<form action='".e_SELF."' method='post'>
	<table style='width:100%;'>
		<tr>
			<td class='forumheader'>".PPGLAN_02."</td>
			<td class='forumheader3'>
				<input type='text' class='tbox' name='name' value='".$gallery['name']."'></input>
			</td>
		</tr>
		<tr>
			<td class='forumheader'>".PPGLAN_04."</td>
			<td class='forumheader3' style='vertical-align:middle'>	
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
		</tr>
		<tr>
			<td class='forumheader'>".PPGLAN_05."</td>
			<td class='forumheader3' style='vertical-align:middle'>
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
		</tr>
		<tr>
			<td class='forumheader'>".PPGLAN_19."</td>
			<td class='forumheader3'>
				<textarea class='tbox' name='description' placeholder='".PPGLAN_20."' style='width:95%;min-height:150px;'>".$tp->post_toForm($gallery['description'])."</textarea>
			</td>
		</tr>
		<tr>
			<td class='forumheader center' colspan='2'>
				<input type='hidden' name='id' value='".$id."' />
				<input type='submit' class='button' name='save' value='".PPGLAN_13."' />
			</td>
		</tr>
		";
	$text.="
	</table>
	</form>
	";
	$text.=$inc;
	$ns -> tablerender($title, $text);
}
require_once(FOOTERF); 
?>