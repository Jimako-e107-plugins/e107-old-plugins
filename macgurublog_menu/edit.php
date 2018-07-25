<?php
/*
+---------------------------------------------------------------+
|        e107 website system
|        e107 BLOG Engine by MacGuru
|        GNU General Public License (http://gnu.org).
+---------------------------------------------------------------+
*/
require_once("../../class2.php");
require_once(e_HANDLER."ren_help.php");
require_once(e_HANDLER."emote.php");
require_once(e_PLUGIN."macgurublog_menu/macgurublog_dt.php");
$WYSIWYG = $pref['wysiwyg'];
$e_wysiwyg = "mgblog_rectext";
require_once(HEADERF);
if (file_exists(e_PLUGIN."macgurublog_menu/languages/".e_LANGUAGE.".php")) {
	require_once(e_PLUGIN."macgurublog_menu/languages/".e_LANGUAGE.".php");
} else {
	require_once(e_PLUGIN."macgurublog_menu/languages/English.php");
}

$rid = intval($_GET['rid']);
if (!$mgb -> own($rid) && !getperms("P")) {header("location:".e_BASE."index.php");}
// ============= START OF THE BODY ====================================
//the settings
$svd = false;
if (IsSet($_POST['mgblog_recsend'])) {
	$entry_title = $tp->toDB($_POST["mgblog_rectitle"]);
	$entry_text = $tp->toDB($_POST["mgblog_rectext"]);
	$uid = USERID;
	if ($entry_text != NULL) {
		$sql -> db_Update("macgurublog_rec", "blogrec_title='$entry_title', blogrec_text='$entry_text', blogrec_tag=".intval($_POST["mgblog_reccat"])." where blogrec_id=$rid");
		$msg = MACGURUBLOG_MENU_18;
		$svd = true;
	} else {
		$msg = MACGURUBLOG_MENU_19;
	}
	$ns -> tablerender('', '<div style="text-align:center;">'.$msg.'</div>');
}

if ($svd == false) {
	$sql -> db_Select("macgurublog_tag", "*", "blogtag_uid=".USERID);
	while($row = $sql-> db_Fetch()){
		$cats[$row['blogtag_id']] = $row['blogtag_text'];
	}
	asort($cats);
	$cats[0] = MACGURUBLOG_MENU_114;
	$sql -> db_Select("macgurublog_rec", "blogrec_title, blogrec_text, blogrec_tag", "blogrec_id=".$rid);
	if ($sql -> db_Rows() == NULL) {
		$ns -> tablerender('', '<div style="text-align:center;">'.MACGURUBLOG_MENU_32.'</div>');
	} else {
		$row = $sql -> db_Fetch();
		foreach($cats as $cid=>$cat) {
			$ncats .= '<option value="'.$cid.($row['blogrec_tag']==$cid ? '" selected' : '"').'>'.$cat."</option>\n";
		}
		$text = "<div style='text-align:center'>
<form method=\"post\" action=\"".e_SELF."?".e_QUERY."\" name=\"macgurublog_addentry\" id=\"dataform\">
<table style=\"width:85%\" class=\"fborder\">

<tr>
<td style=\"width:40%\" class='forumheader3'>".MACGURUBLOG_MENU_15.":</td>
<td style=\"width:60%\" class='forumheader3'>
<input class='tbox' type='text' name='mgblog_rectitle' size='40' maxlength='100' value='".$row['blogrec_title']."' />
</td>
</tr>
<tr>
<td style=\"width:40%\" class='forumheader3'>".MACGURUBLOG_MENU_116.":</td>
<td style=\"width:60%\" class='forumheader3'>
<select class=\"tbox\" name=\"mgblog_reccat\" style=\"width: 200px;\">
".$ncats."
</select>
</td>
</tr>
<tr>
<td style=\"width:100%\" class='forumheader3' colspan=\"2\">
<div>".MACGURUBLOG_MENU_16.":</div>
<div style=\"text-align:center;\">
<textarea class=\"tbox\" style=\"width:95%;\" type=\"text\" name=\"mgblog_rectext\" rows='15' onselect='storeCaret(this);' onclick='storeCaret(this);' onkeyup='storeCaret(this);'>".$row['blogrec_text']."</textarea>
</div>
".($WYSIWYG ? '' : "<div style=\"text-align:center;\">
<input class='helpbox' type='text' name='helpb' size='100' readonly=\"readonly\" /> <br />
".ren_help()."<br />".r_emote()."
</div>")."
</td>
</tr>

<tr style=\"vertical-align:top\"> 
<td colspan=\"2\"  style=\"text-align:center;\" class='forumheader'>
<input class=\"button\" type=\"submit\" name=\"mgblog_recsend\" value=\"".MACGURUBLOG_MENU_33."\" />
</td>
</tr>
</table>
</form>
</div>";

		$ns -> tablerender($pref['macgurublog_11'], $text);
	}
}
// ========= End of the BODY ===================================================
require_once(FOOTERF);
?>