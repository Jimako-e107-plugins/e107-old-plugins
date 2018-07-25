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
if (!$mgb -> own($rid) && !getperms("P") && USERID !== $row['blogcom_uid']) {header("location:".e_BASE."index.php");}
// ============= START OF THE BODY ====================================
//the settings
$svd = false;
if (IsSet($_POST['mgblog_comsend'])) {
	if (IsSet($_POST['gname'])) {
		$text = serialize(array('gname'=>$tp->toDB($_POST['gname']), 'commenttext'=>$tp->toDB($_POST['mgblog_comtext'])));
	} else {
		$text = $tp->toDB($_POST["mgblog_comtext"]);
	}
	if ($text != NULL) {
		$sql -> db_Update("macgurublog_com", "blogcom_text='$text' where blogcom_id=$rid");
		$msg = MACGURUBLOG_MENU_18;
		$svd = true;
	} else {
		$msg = MACGURUBLOG_MENU_19;
	}
	$ns -> tablerender('', '<div style="text-align:center;">'.$msg.'</div>');
}

if ($svd == false) {
	$sql -> db_Select("macgurublog_com", "*", "blogcom_id=".$rid);
	if ($sql -> db_Rows() == NULL) {
		$ns -> tablerender('', '<div style="text-align:center;">'.MACGURUBLOG_MENU_32.'</div>');
	} else {
		$row = $sql -> db_Fetch();
		if ($row['blogcom_uid'] != 0) {
			$ctxt = $row['blogcom_text'];
		} else {
			$tmp = unserialize($row['blogcom_text']);
			$ctxt = $tmp['commenttext'];
			$gname = ($tmp['gname']!=''?'<input type="hidden" name="gname" value="'.$tmp['gname'].'" />':'');
		}
		$text = "<div style='text-align:center'>
<form method=\"post\" action=\"".e_SELF."?".e_QUERY."\" name=\"macgurublog_comment\" id=\"dataform\">
<div style=\"text-align:center;\">
<textarea class=\"tbox\" style=\"width:90%;\" type=\"text\" name=\"mgblog_comtext\" rows='15' onselect='storeCaret(this);' onclick='storeCaret(this);' onkeyup='storeCaret(this);'>${ctxt}</textarea>
</div>
".($WYSIWYG ? '' : "<div style=\"text-align:center;\">
<input class='helpbox' type='text' name='helpb' size='100' readonly=\"readonly\" /> <br />
".ren_help()."<br />".r_emote()."
</div>")."
${gname}
<input class=\"button\" type=\"submit\" name=\"mgblog_comsend\" value=\"".MACGURUBLOG_MENU_33."\" />

</form>
</div>";

		$ns -> tablerender($pref['macgurublog_11'], $text);
	}
}
// ========= End of the BODY ===================================================
require_once(FOOTERF);
?>