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
require_once("../../class2.php");
require_once(HEADERF);
include_lan(e_PLUGIN."visitors_book/languages/".e_LANGUAGE."/admin.php");

// Grundeinstellungen laden
$vibo_pref=mysql_query("SELECT * FROM ".MPREFIX."visitors_book_prefs WHERE admin>'-1'");
$vibo_pref=mysql_fetch_array($vibo_pref);
// Moderatorinformation
if(check_class($vibo_pref['admin'])) {} else {header("location:".e_BASE."index.php");exit;}
// Löschen
if (isset($_POST['delete']))
{
	$sql->db_Select_gen("DELETE FROM ".MPREFIX."visitors_book WHERE id=".$_POST['id']."");
	$message=VIBO_LAN_33;
}
// Bestätigen
if (isset($_POST['open']))
{
	$sql->db_Select_gen("UPDATE ".MPREFIX."visitors_book SET checked='1' WHERE id=".$_POST['id']."");
	$message=VIBO_LAN_35;
}
// Inhalt
$caption=VIBO_LAN_30;
$text="
<p style='text-align:center'>".$message."</p>
<table style='width:95%'>
";
$eql=mysql_query("SELECT * FROM ".MPREFIX."visitors_book WHERE checked='0' ORDER BY date DESC");
while ($entry=mysql_fetch_array($eql,MYSQL_ASSOC))
{
	if ($entry['is_comment']>0)
	{
		$is_entry=mysql_query("SELECT * FROM ".MPREFIX."visitors_book WHERE id=".$entry['is_comment']."");
		$is_entry=mysql_fetch_array($is_entry);
		
		$is_comment="
			<tr>
				<td class='forumheader2' colspan='2'>
					<img src='".e_PLUGIN."visitors_book/stuff/comment.png' style='width:16px' />
					<span style='vertical-align:top;margin-left:15px;'>".VIBO_LAN_40.$is_entry['name'].VIBO_LAN_42."</span>
				</td>
			</tr>
			<tr>
				<td class='forumheader3' colspan='2'>
					".$tp->toHTML($is_entry['text'],true)."
				</td>
			</tr>
		";
	}
	if ($entry['is_comment']==0)
	{
		$infos="
			<tr>
				<td class='forumheader2' colspan='2'>
					<img src='".e_PLUGIN."visitors_book/stuff/name.png' style='width:16px' />
					<span style='vertical-align:top;margin-left:15px;'>".$entry['name']."</span>
				</td>
			</tr>
			<tr>
				<td class='forumheader2' colspan='2'>
					<img src='".e_PLUGIN."visitors_book/stuff/web.png' style='width:16px' />
					<span style='vertical-align:top;margin-left:15px;'>".$entry['homepage']."</span>
				</td>
			</tr>
		";
		$infos_two="
			IP:
			<span style='vertical-align:top;margin-left:15px;'>".$entry['ip']."</span>
		";
	}
	$text.="
	<form action='".e_SELF."' method='post'>
		".$infos."
		<tr>
			<td class='forumheader2'>
				<img src='".e_PLUGIN."visitors_book/stuff/date.png' style='width:16px' />
				<span style='vertical-align:top;margin-left:15px;'>
					".date("d.m.Y - H:i",$entry['date'])."
				</span>
			</td>
			<td class='forumheader2'>
				".$infos_two."
			</td>
		</tr>
		<tr>
			<td class='forumheader3' colspan='2'>
				".$tp->toHTML($entry['text'],true)."
			</td>
		</tr>
		<tr>
			<td class='forumheader2' colspan='2' style='text-align:center'>
				<input type='hidden' name='id' value='".$entry['id']."'>
				<input type='submit' name='open' value='".VIBO_LAN_31."' class='button'></input>
				<input type='submit' name='delete' value='".VIBO_LAN_32."' class='button'></input>
			</td>
		</tr>
		".$is_comment."
		<tr>
			<td class='forumheader2' colspan='2' style='text-align:center'>
				<hr />
			</td>
		</tr>
	</form>
	";
}
$text.="
	<tr>
		<td class='forumheader2' colspan='2' style='text-align:center'>".VIBO_LAN_34."</td>
	</tr>
</table>
";
$ns -> tablerender($caption, $text); 
require_once(FOOTERF); 
?> 