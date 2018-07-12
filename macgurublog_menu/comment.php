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
$WYSIWYG = (USER === TRUE ? $pref['wysiwyg'] : FALSE);
$e_wysiwyg = "mgblog_comtext";
require_once(HEADERF);
if (file_exists(e_PLUGIN."macgurublog_menu/languages/".e_LANGUAGE.".php")) {
	require_once(e_PLUGIN."macgurublog_menu/languages/".e_LANGUAGE.".php");
} else {
	require_once(e_PLUGIN."macgurublog_menu/languages/English.php");
}
// ============= START OF THE BODY ====================================
$rid = intval($_GET['rid']);
//blog entry echo
$sql -> db_Query("select ".MPREFIX."macgurublog_rec.*, blog_enable from ".MPREFIX."macgurublog_rec left join ".MPREFIX."macgurublog_main on (".MPREFIX."macgurublog_rec.blogrec_uid=".MPREFIX."macgurublog_main.blog_uid) where blogrec_id=".$rid.";");
if ($sql -> db_Rows() != NULL) {
	$row = $sql -> db_Fetch();
	$visible = $row['blog_enable'];
	$visible = ($visible == 1 || getperms("P") || $buid == USERID);
	if ($visible == false) {
		$text = '<div style="text-align:center;">'.MACGURUBLOG_MENU_10.'</div>';
		$ns -> tablerender('', $text);
	} else {
		$title = $tp->toHTML($row['blogrec_title'], true);
		$text = '<div>'.($tp->toHTML($row['blogrec_text'], true))."</div>\n";
		$text .= '<hr /><div style="text-align:right;">';
		$text .= $mgb -> dt(1, $row['blogrec_date']);
		$text .= "</div>\n";
		$ns -> tablerender($title, $text);
		//db insert
		if ((USER === true || $pref['macgurublog_9'] == true) && IsSet($_POST['mgblog_comsend'])) {
			$comment_text = $tp->toDB($_POST["mgblog_comtext"]);
			$t = time();
			$uid = USERID;
			if ($comment_text != NULL) {
				if (USER === true) {
					$sql -> db_Insert("macgurublog_com", "0, $rid, $t, $uid, '$comment_text'");
				} else {
					$ct = serialize(array('gname' => $tp->toDB($_POST['gname']),'commenttext' => $comment_text));
					$sql -> db_Insert("macgurublog_com", "0, $rid, $t, 0, '$ct'");
				}
				$msg = MACGURUBLOG_MENU_25;
			} else {
				$msg = MACGURUBLOG_MENU_26;
			}
			$ns -> tablerender('', '<div style="text-align:center;">'.$msg.'</div>');
		}
		//comments
		$own = ($mgb -> own($rid) || getperms('P'));
		$sql -> db_Query("select ".MPREFIX."macgurublog_com.*, user_name from ".MPREFIX."macgurublog_com left join ".MPREFIX."user on (".MPREFIX."macgurublog_com.blogcom_uid=".MPREFIX."user.user_id) where blogcom_rid=".$rid." order by blogcom_date asc;");
		$text = NULL;
		if ($sql -> db_Rows() != 0) {
			while($row = $sql-> db_Fetch()){
				if ($row['blogcom_uid'] != 0) {
					$nme = $row['user_name'];
					$ctxt = $row['blogcom_text'];
				} else {
					$tmp = unserialize($row['blogcom_text']);
					$nme = $tmp['gname'] . ' (' . MACGURUBLOG_MENU_110 . ')';
					$ctxt = $tmp['commenttext'];
				}
				$text .= '<div style="text-align:left;"><b>'.$nme.':</b><br />';
				$text .= '<div>'.($tp->toHTML($ctxt, true)).'</div><div style="text-align:right;">';
				if ($own) {
					$text .= '<a href="'.e_PLUGIN."macgurublog_menu/delete_com.php?rid=".$row['blogcom_id'].'">'.MACGURUBLOG_MENU_14."</a> | \n";
				}
				if ($own || USERID === $row['blogcom_uid']) {
					$text .= '<a href="'.e_PLUGIN."macgurublog_menu/edit_com.php?rid=".$row['blogcom_id'].'">'.MACGURUBLOG_MENU_13."</a> | \n";
				}
				$text .= $mgb -> dt(1, $row['blogcom_date']).'</div></div><hr />';
			}
			$ns -> tablerender(MACGURUBLOG_MENU_22, substr($text, 0, -6));
		}
		//rating
		if ($pref['macgurublog_13']) {
			require_once(e_HANDLER."rate_class.php");
			$rater = new rater;
			$ns -> tablerender(MACGURUBLOG_MENU_126, '<div style="text-align:center;">'.($rater->composerating('macgurublog', $rid)).'</div>');
		}
		//enter comment
		$text = "<div style='text-align:center'>
<form method=\"post\" action=\"".e_SELF."?".e_QUERY."\" name=\"macgurublog_comment\" id=\"dataform\">
<div style=\"text-align:center;\">
".(USER === true ? '' : '<p style="text-align:left; width:90%; margin: auto;">'.MACGURUBLOG_MENU_109.': <input class="tbox" name="gname" type="text" size="20" /></p>' )."
<textarea class=\"tbox\" style=\"width:90%;\" type=\"text\" name=\"mgblog_comtext\" rows='15' onselect='storeCaret(this);' onclick='storeCaret(this);' onkeyup='storeCaret(this);'></textarea>
</div>
".($WYSIWYG ? '' : "<div style=\"text-align:center;\">
<input class='helpbox' type='text' name='helpb' size='100' readonly=\"readonly\" /> <br />
".ren_help()."<br />".r_emote()."
</div>")."

<input class=\"button\" type=\"submit\" name=\"mgblog_comsend\" value=\"".MACGURUBLOG_MENU_24."\" />

</form>
</div>";
		if (USER === true || $pref['macgurublog_9'] == true) {
			$ns -> tablerender(MACGURUBLOG_MENU_23, $text);
		} else {
			$ns -> tablerender(MACGURUBLOG_MENU_23, '<div style="text-align:center">'.MACGURUBLOG_MENU_27.'</div>');
		}
	}
} else {
	$ns -> tablerender('', '<div style="text-align:center">'.MACGURUBLOG_MENU_32.'</div>');
}
// ========= End of the BODY ===================================================
require_once(FOOTERF);
?>