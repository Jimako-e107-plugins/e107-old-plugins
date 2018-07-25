<?php
/*
+---------------------------------------------------------------+
|        e107 website system
|        e107 BLOG Engine by MacGuru
|        GNU General Public License (http://gnu.org).
+---------------------------------------------------------------+
*/
require_once("../../class2.php");
require_once(e_PLUGIN."macgurublog_menu/macgurublog_dt.php");
require_once(HEADERF);
if (file_exists(e_PLUGIN."macgurublog_menu/languages/".e_LANGUAGE.".php")) {
	require_once(e_PLUGIN."macgurublog_menu/languages/".e_LANGUAGE.".php");
} else {
	require_once(e_PLUGIN."macgurublog_menu/languages/English.php");
}

$rid = intval($_GET['rid']);
if (!$mgb -> own($rid) && !getperms("P")) {header("location:".e_BASE."index.php");}
// ============= START OF THE BODY ====================================
$deled = false;
if (IsSet($_POST['mgblog_del'])) {
	if ($_POST["macgurublog_delete"] == 'yes') {
		$sql -> db_Delete('macgurublog_com', 'blogcom_rid='.$rid);
		$sql -> db_Delete('macgurublog_rec', 'blogrec_id='.$rid);
		$sql -> db_Delete("rate", "rate_itemid='{$rid}' AND rate_table='macgurublog'");
		$deld = true;
		$ns -> tablerender('', '<div style="text-align:center">'.MACGURUBLOG_MENU_31.'</div>');
	} else {
		$ns -> tablerender('', '<div style="text-align:center">'.MACGURUBLOG_MENU_30.'</div>');
	}
}
if (!$deld) {
	//blog entry echo
	$sql -> db_Select("macgurublog_rec", "*", "blogrec_id=".$rid);
	if ($sql -> db_Rows() != NULL) {
		$row = $sql -> db_Fetch();
		extract($row);
		$title = $tp->toHTML($row['blogrec_title'], true);
		$text = '<div>'.($tp->toHTML($row['blogrec_text'], true))."</div>\n";
		$text .= '<hr /><div style="text-align:right;">';
		$text .= $mgb -> dt(1, $row['blogrec_date']);
		$text .= "</div>\n";
		$ns -> tablerender($title, $text);
		
		//del form
		$text = "<div style='text-align:center'>
<form method=\"post\" action=\"".e_SELF."?".e_QUERY."\" name=\"macgurublog_comment\" id=\"dataform\">
<input type='checkbox' name='macgurublog_delete' value='yes' id='macgurublog_delete'/> 
<label for='macgurublog_delete'>".MACGURUBLOG_MENU_29."</label>
<br /><br />
<input class='button' type='submit' name='mgblog_del' value='".MACGURUBLOG_MENU_14."' />
</form>
</div>";
		$ns -> tablerender(MACGURUBLOG_MENU_14, $text);
	} else {
		$ns -> tablerender('', '<div style="text-align:center">'.MACGURUBLOG_MENU_32.'</div>');
	}
}
// ========= End of the BODY ===================================================
require_once(FOOTERF);
?>