<?php
/*
+---------------------------------------------------------------+
|        e107 website system
|        e107 BLOG Engine by MacGuru
|        GNU General Public License (http://gnu.org).
+---------------------------------------------------------------+
*/

require_once("../../class2.php");
if(!getperms("P")){ header("location:".e_BASE."index.php"); exit; }
require_once(e_ADMIN."auth.php");
if (file_exists(e_PLUGIN."macgurublog_menu/languages/".e_LANGUAGE.".php")) {
	require_once(e_PLUGIN."macgurublog_menu/languages/".e_LANGUAGE.".php");
} else {
	require_once(e_PLUGIN."macgurublog_menu/languages/English.php");
}
$pageid = "config";
// ------------------------------
$prfl = array(MACGURUBLOG_MENU_70, MACGURUBLOG_MENU_71 ,MACGURUBLOG_MENU_72, MACGURUBLOG_MENU_73, MACGURUBLOG_MENU_74);
$prfll = array(MACGURUBLOG_MENU_99, MACGURUBLOG_MENU_100, MACGURUBLOG_MENU_101);
/////
if (IsSet($_POST['mgbupdatesettings'])) {
	$n = $_POST['macgurublog_dbgroup'];
	if ($n == NULL) {
		$n = 3;
	} else {
		$n = array_search($n, $prfl);
	}
	$m = $_POST['macgurublog_waphead'];
	if ($m == NULL) {
		$m = 1;
	} else {
		$m = array_search($m, $prfll);
	}
	$l = $_POST['macgurublog_wapget'];
	if ($l == NULL) {
		$l = 1;
	} else {
		$l = array_search($l, $prfll);
	}
	$pref['macgurublog_1'] = $n;
	$pref['macgurublog_2'] = $_POST['macgurublog_deny'];
	$pref['macgurublog_3'] = $_POST['macgurublog_new'];
	$pref['macgurublog_4'] = $_POST['macgurublog_dnew'];
	$pref['macgurublog_5'] = $_POST['macgurublog_wap'];
	$pref['macgurublog_6'] = $m;
	$pref['macgurublog_7'] = $l;
	$pref['macgurublog_8'] = $_POST['macgurublog_ducm'];
	$pref['macgurublog_9'] = $_POST['macgurublog_gpc'];
	$pref['macgurublog_10'] = $_POST['macgurublog_avatar'];
	$pref['macgurublog_11'] = $_POST['macgurublog_mcap'];
	$pref['macgurublog_12'] = $_POST['macgurublog_smenu'];
	$pref['macgurublog_13'] = $_POST['macgurublog_rating'];
	$pref['macgurublog_14'] = $_POST['macgurublog_iup'];
	save_prefs();
	$ns -> tablerender('', '<div style="text-align:center">'.MACGURUBLOG_MENU_28.'</div>');
}
/////
$prefcapt[] = MACGURUBLOG_MENU_69;
$prefname[] = "macgurublog_dbgroup";
$preftype[] = "dropdown";
$prefvalu[] = implode(',', $prfl);
$predvalu[] = $prfl[$pref['macgurublog_1']];

$prefcapt[] = MACGURUBLOG_MENU_85;
$prefname[] = "macgurublog_deny";
$preftype[] = "checkbox";
$prefvalu[] = true;
$predvalu[] = $pref['macgurublog_2'];

$prefcapt[] = MACGURUBLOG_MENU_86;
$prefname[] = "macgurublog_new";
$preftype[] = "checkbox";
$prefvalu[] = true;
$predvalu[] = $pref['macgurublog_3'];

$prefcapt[] = MACGURUBLOG_MENU_87;
$prefname[] = "macgurublog_dnew";
$preftype[] = "checkbox";
$prefvalu[] = true;
$predvalu[] = $pref['macgurublog_4'];

$prefcapt[] = MACGURUBLOG_MENU_97;
$prefname[] = "macgurublog_wap";
$preftype[] = "text";
$prefvalu[] = "";
$predvalu[] = $pref['macgurublog_5'];

$prefcapt[] = MACGURUBLOG_MENU_98;
$prefname[] = "macgurublog_waphead";
$preftype[] = "dropdown";
$prefvalu[] = implode(',', $prfll);
$predvalu[] = $prfll[$pref['macgurublog_6']];

$prefcapt[] = MACGURUBLOG_MENU_102;
$prefname[] = "macgurublog_wapget";
$preftype[] = "dropdown";
$prefvalu[] = implode(',', $prfll);
$predvalu[] = $prfll[$pref['macgurublog_7']];

$prefcapt[] = MACGURUBLOG_MENU_103;
$prefname[] = "macgurublog_ducm";
$preftype[] = "checkbox";
$prefvalu[] = true;
$predvalu[] = $pref['macgurublog_8'];

$prefcapt[] = MACGURUBLOG_MENU_108;
$prefname[] = "macgurublog_gpc";
$preftype[] = "checkbox";
$prefvalu[] = true;
$predvalu[] = $pref['macgurublog_9'];

$prefcapt[] = MACGURUBLOG_MENU_112;
$prefname[] = "macgurublog_avatar";
$preftype[] = "checkbox";
$prefvalu[] = true;
$predvalu[] = $pref['macgurublog_10'];

$prefcapt[] = MACGURUBLOG_MENU_113;
$prefname[] = "macgurublog_mcap";
$preftype[] = "text";
$prefvalu[] = "";
$predvalu[] = $pref['macgurublog_11'];

$prefcapt[] = MACGURUBLOG_MENU_117;
$prefname[] = "macgurublog_smenu";
$preftype[] = "checkbox";
$prefvalu[] = true;
$predvalu[] = $pref['macgurublog_12'];

$prefcapt[] = MACGURUBLOG_MENU_125;
$prefname[] = "macgurublog_rating";
$preftype[] = "checkbox";
$prefvalu[] = true;
$predvalu[] = $pref['macgurublog_13'];

$prefcapt[] = MACGURUBLOG_MENU_127;
$prefname[] = "macgurublog_iup";
$preftype[] = "checkbox";
$prefvalu[] = true;
$predvalu[] = $pref['macgurublog_14'];

require_once("form_handler.php");
$rs = new form_mgb;
$text = "<div style='text-align:center'>
<form method='post' action='".e_SELF."'>
<table style='width:94%' class='fborder'>";

for ($i=0; $i<count($prefcapt); $i++) {
	$form_send = $prefname[$i] . "|" .$preftype[$i]."|".$prefvalu[$i];
	$text .="
	<tr>
	<td style=\"width:30%; vertical-align:top\" class=\"forumheader3\">".$prefcapt[$i].":</td>
	<td style=\"width:70%\" class=\"forumheader3\">";
	$name = $prefname[$i];
	$text .= $rs->  user_extended_element_edit($form_send,$predvalu[$i],$name);
	$text .="</td></tr>";
};

$text .="<tr style='vertical-align:top'>
<td colspan='2'  style='text-align:center' class='forumheader'>
<input class='button' type='submit' name='mgbupdatesettings' value='".MACGURUBLOG_MENU_65."' />
</td>
</tr>
</table>
</form>
</div>";


$ns -> tablerender(MACGURUBLOG_MENU_67, $text);
// ------------------------------
require_once(e_ADMIN."footer.php");

?>