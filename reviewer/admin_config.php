<?php
/*
+---------------------------------------------------------------+
|        Reviewer Plugin for e107 v7xx - by Father Barry
|
|        This module for the e107 .7+ website system
|        Copyright Barry Keal 2004-2008
|
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
|
+---------------------------------------------------------------+
*/

require_once("../../class2.php");
if (!defined('e107_INIT'))
{
    exit;
}
if (!getperms("P"))
{
    header("location:" . e_HTTP . "index.php");
    exit;
}

require_once(e_ADMIN . "auth.php");
if (!defined('ADMIN_WIDTH'))
{
    define(ADMIN_WIDTH, "width:100%;");
}
include_lan(e_PLUGIN . "reviewer/languages/" . e_LANGUAGE . ".php");

if (!is_object($reviewer_obj))
{
    require_once(e_PLUGIN . "reviewer/includes/reviewer_class.php");
    $reviewer_obj = new reviewer;
}

if (e_QUERY == "update")
{
    $success = 0;
    if (intval($_POST['reviewer_seo']) == 1 && $REVIEWER_PREF['reviewer_seo'] == 0)
    {
        // changed to we are using seo
        $success = $reviewer_obj->regen_htaccess('on');
    } elseif (intval($_POST['reviewer_seo']) == 0 && $REVIEWER_PREF['reviewer_seo'] == 1)
    {
        // changed to not using seo
        $success = $reviewer_obj->regen_htaccess('off');
    }
    if ($success > 0)
    {
        $reviewer_errmsg = explode('~', REVIEWER_AI037);
        $reviewer_msgtext .= REVIEWER_AI036 . ' ' . $faq_errmsg[$success] . " ({$success}) <br />";
    }
    // Update rest
    $REVIEWER_PREF['reviewer_adminclass'] = intval($_POST['reviewer_adminclass']);
    $REVIEWER_PREF['reviewer_submitclass'] = intval($_POST['reviewer_submitclass']);
    $REVIEWER_PREF['reviewer_createclass'] = intval($_POST['reviewer_createclass']);
    $REVIEWER_PREF['reviewer_autoclass'] = intval($_POST['reviewer_autoclass']);
    $REVIEWER_PREF['reviewer_readclass'] = intval($_POST['reviewer_readclass']);
    $REVIEWER_PREF['reviewer_catperpage'] = intval($_POST['reviewer_catperpage']);
    $REVIEWER_PREF['reviewer_reviewperpage'] = intval($_POST['reviewer_reviewperpage']);
    $REVIEWER_PREF['reviewer_menu_inmenu'] = intval($_POST['reviewer_menu_inmenu']);
    $REVIEWER_PREF['reviewer_editown'] = intval($_POST['reviewer_editown']);
    $REVIEWER_PREF['reviewer_editownitem'] = intval($_POST['reviewer_editownitem']);
    $REVIEWER_PREF['reviewer_use1'] = intval($_POST['reviewer_use1']);
    $REVIEWER_PREF['reviewer_use2'] = intval($_POST['reviewer_use2']);
    $REVIEWER_PREF['reviewer_use3'] = intval($_POST['reviewer_use3']);
    $REVIEWER_PREF['reviewer_use4'] = intval($_POST['reviewer_use4']);
    $REVIEWER_PREF['reviewer_use5'] = intval($_POST['reviewer_use5']);
    $REVIEWER_PREF['reviewer_use6'] = intval($_POST['reviewer_use6']);
    $REVIEWER_PREF['reviewer_use7'] = intval($_POST['reviewer_use7']);
    $REVIEWER_PREF['reviewer_use8'] = intval($_POST['reviewer_use8']);
    $REVIEWER_PREF['reviewer_use9'] = intval($_POST['reviewer_use9']);
    $REVIEWER_PREF['reviewer_use10'] = intval($_POST['reviewer_use10']);
    $REVIEWER_PREF['reviewer_rate1'] = (empty($_POST['reviewer_rate1'])?"{REVIEWER_RATE1}":$tp->toDB($_POST['reviewer_rate1']));
    $REVIEWER_PREF['reviewer_rate2'] = (empty($_POST['reviewer_rate2'])?"{REVIEWER_RATE2}":$tp->toDB($_POST['reviewer_rate2']));
    $REVIEWER_PREF['reviewer_rate3'] = (empty($_POST['reviewer_rate3'])?"{REVIEWER_RATE3}":$tp->toDB($_POST['reviewer_rate3']));
    $REVIEWER_PREF['reviewer_rate4'] = (empty($_POST['reviewer_rate4'])?"{REVIEWER_RATE4}":$tp->toDB($_POST['reviewer_rate4']));
    $REVIEWER_PREF['reviewer_rate5'] = (empty($_POST['reviewer_rate5'])?"{REVIEWER_RATE5}":$tp->toDB($_POST['reviewer_rate5']));
    $REVIEWER_PREF['reviewer_rate6'] = (empty($_POST['reviewer_rate6'])?"{REVIEWER_RATE6}":$tp->toDB($_POST['reviewer_rate6']));
    $REVIEWER_PREF['reviewer_rate7'] = (empty($_POST['reviewer_rate7'])?"{REVIEWER_RATE7}":$tp->toDB($_POST['reviewer_rate7']));
    $REVIEWER_PREF['reviewer_rate8'] = (empty($_POST['reviewer_rate8'])?"{REVIEWER_RATE8}":$tp->toDB($_POST['reviewer_rate8']));
    $REVIEWER_PREF['reviewer_rate9'] = (empty($_POST['reviewer_rate9'])?"{REVIEWER_RATE9}":$tp->toDB($_POST['reviewer_rate9']));
    $REVIEWER_PREF['reviewer_rate10'] = (empty($_POST['reviewer_rate10'])?"{REVIEWER_RATE10}":$tp->toDB($_POST['reviewer_rate10']));
    $REVIEWER_PREF['reviewer_TC'] = $tp->toDB($_POST['reviewer_TC']);
    $REVIEWER_PREF['reviewer_comments'] = intval($_POST['reviewer_comments']);
    $REVIEWER_PREF['reviewer_disclaimer'] = intval($_POST['reviewer_disclaimer']);
    $REVIEWER_PREF['reviewer_defcat'] = intval($_POST['reviewer_defcat']);
    $REVIEWER_PREF['reviewer_captcha'] = intval($_POST['reviewer_captcha']);
    $REVIEWER_PREF['reviewer_usecat'] = intval($_POST['reviewer_usecat']);
    $REVIEWER_PREF['reviewer_half'] = intval($_POST['reviewer_half']);
    $REVIEWER_PREF['reviewer_seo'] = intval($_POST['reviewer_seo']);
    $reviewer_obj->save_prefs();
    $reviewer_msgtext .= REVIEWER_A012 ;

    $reviewer_obj->clear_cache();
}

$reviewer_text .= "
<script type='text/javascript'>
function reviewer_toggle()
{
//alert(document.getElementById(\"reviewer_ac\").checked);
	if (document.getElementById(\"reviewer_ac\").checked)
	{
 		document.getElementById(\"reviewer_ac1\").style.display = \"none\";
 		document.getElementById(\"reviewer_ac2\").style.display = \"none\";
 		document.getElementById(\"reviewer_ac3\").style.display = \"none\";
 		document.getElementById(\"reviewer_ac4\").style.display = \"none\";
 		document.getElementById(\"reviewer_ac5\").style.display = \"none\";
 		document.getElementById(\"reviewer_ac6\").style.display = \"none\";
 		document.getElementById(\"reviewer_ac7\").style.display = \"none\";
 		document.getElementById(\"reviewer_ac8\").style.display = \"none\";
 		document.getElementById(\"reviewer_ac9\").style.display = \"none\";
 		document.getElementById(\"reviewer_ac10\").style.display = \"none\";
 	}
 	else
 	{
  		document.getElementById(\"reviewer_ac1\").style.display = \"\";
  		document.getElementById(\"reviewer_ac2\").style.display = \"\";
  		document.getElementById(\"reviewer_ac3\").style.display = \"\";
  		document.getElementById(\"reviewer_ac4\").style.display = \"\";
  		document.getElementById(\"reviewer_ac5\").style.display = \"\";
  		document.getElementById(\"reviewer_ac6\").style.display = \"\";
  		document.getElementById(\"reviewer_ac7\").style.display = \"\";
  		document.getElementById(\"reviewer_ac8\").style.display = \"\";
  		document.getElementById(\"reviewer_ac9\").style.display = \"\";
  		document.getElementById(\"reviewer_ac10\").style.display = \"\";
 	}
}
</script>
<form method='post' action='" . e_SELF . "?update' id='confrecipe'>
	<table style='" . ADMIN_WIDTH . "' class='fborder'>
		<tr>
			<td colspan='2' class='fcaption'>" . REVIEWER_A021 . "</td>
		</tr>
		<tr>
			<td class='forumheader2' colspan='2' ><strong>{$reviewer_msgtext}</strong>&nbsp;</td>
		</tr>";
// Main admin class
$reviewer_text .= "
		<tr>
			<td style='width:30%' class='forumheader3'>" . REVIEWER_A009 . "</td>
			<td style='width:70%' class='forumheader3'>" . r_userclass("reviewer_adminclass", $tp->toFORM($REVIEWER_PREF['reviewer_adminclass']), "off", 'nobody, member, main,admin, classes') . "</td>
		</tr>";
$reviewer_text .= "
		<tr>
			<td style='width:30%' class='forumheader3'>" . REVIEWER_A010 . "</td>
			<td style='width:70%' class='forumheader3'>" . r_userclass("reviewer_submitclass", $tp->toFORM($REVIEWER_PREF['reviewer_submitclass']), "off", 'public,guest, nobody, member,main, admin, classes') . "</td>
		</tr>";
$reviewer_text .= "
		<tr>
			<td style='width:30%' class='forumheader3'>" . REVIEWER_AC027 . "</td>
			<td style='width:70%' class='forumheader3'>" . r_userclass("reviewer_createclass", $tp->toFORM($REVIEWER_PREF['reviewer_createclass']), "off", 'nobody, member,main, admin, classes') . "</td>
		</tr>";
$reviewer_text .= "
		<tr>
			<td style='width:30%' class='forumheader3'>" . REVIEWER_AC028 . "</td>
			<td style='width:70%' class='forumheader3'>" . r_userclass("reviewer_autoclass", $tp->toFORM($REVIEWER_PREF['reviewer_autoclass']), "off", 'nobody, member,main, admin, classes') . "</td>
		</tr>";

$reviewer_text .= "
		<tr>
			<td style='width:30%' class='forumheader3'>" . REVIEWER_A011 . "</td>
			<td style='width:70%' class='forumheader3'>" . r_userclass("reviewer_readclass", $tp->toFORM($REVIEWER_PREF['reviewer_readclass']), "off", 'nobody,public,guest, member, admin, main,classes') . "</td>
		</tr>";
// Number of categories to show
$reviewer_text .= "
		<tr>
			<td style='width:30%' class='forumheader3'>" . REVIEWER_A013 . "</td>
			<td style='width:70%' class='forumheader3'><input class='tbox' type='text'  size='10' name='reviewer_catperpage' value='" . $REVIEWER_PREF['reviewer_catperpage'] . "' /></td>
		</tr>";
// Number of reviews on page
$reviewer_text .= "
		<tr>
			<td style='width:30%' class='forumheader3'>" . REVIEWER_A014 . "</td>
			<td style='width:70%' class='forumheader3'><input class='tbox' type='text'  size='10' name='reviewer_reviewperpage' value='" . $REVIEWER_PREF['reviewer_reviewperpage'] . "' /></td>
		</tr>";
// Number of reviews in menu
$reviewer_text .= "
		<tr>
			<td style='width:30%' class='forumheader3'>" . REVIEWER_A040 . "</td>
			<td style='width:70%' class='forumheader3'><input class='tbox' type='text'  size='10' name='reviewer_menu_inmenu' value='" . $REVIEWER_PREF['reviewer_menu_inmenu'] . "' /></td>
		</tr>";
$reviewer_text .= "
		<tr>
			<td style='width:30%' class='forumheader3'>" . REVIEWER_A024 . "</td>
			<td style='width:70%' class='forumheader3'>";
$reviewer_text .= "<select name='reviewer_defcat' class='tbox' >";
if ($sql->db_Select("reviewer_category", "reviewer_category_id,reviewer_category_name", "order by reviewer_category_name", "nowhere", false))
{
    while ($reviewer_row = $sql->db_Fetch())
    {
        $reviewer_text .= "<option value='" . $reviewer_row['reviewer_category_id'] . "' " . ($REVIEWER_PREF['reviewer_defcat'] == $reviewer_row['reviewer_category_id']?"selected='selected'":"") . " >" . $reviewer_row['reviewer_category_name'] . "</option>";
    }
}
else
{
    $reviewer_text .= "<option value='0' >" . REVIEWER_A025 . "</option>";
}

$reviewer_text .= "
			</select>
			</td>
		</tr>";
// use category rate info
$reviewer_text .= "
		<tr>
			<td style='width:30%' class='forumheader3'>" . REVIEWER_A037 . "</td>
			<td style='width:70%' class='forumheader3'>
				<input class='tbox' id='reviewer_ac' type='checkbox' onclick=\"reviewer_toggle()\" name='reviewer_usecat' value='1' " . ($REVIEWER_PREF['reviewer_usecat'] > 0?"checked='checked'":"") . " />
			</td>
		</tr>";
// use 1
if ($REVIEWER_PREF['reviewer_usecat'] > 0)
{
    $reviewer_display = "none";
}
else
{
    $reviewer_display = "";
}
$reviewer_text .= "
		<tr id='reviewer_ac1' style='display:{$reviewer_display}'>
			<td style='width:30%' class='forumheader3'>" . REVIEWER_A015 . "</td>
			<td style='width:70%' class='forumheader3'>
				<input class='tbox' type='checkbox' name='reviewer_use1' value='1' " . ($REVIEWER_PREF['reviewer_use1'] > 0?"checked='checked'":"") . " />
	" . REVIEWER_A028 . " <input class='tbox' type='text' style='width:30%' maxlength='20' name='reviewer_rate1' value='" . $tp->toFORM($REVIEWER_PREF['reviewer_rate1']) . "' />
			</td>
		</tr>";
// use 2
$reviewer_text .= "
		<tr id='reviewer_ac2' style='display:{$reviewer_display}'>
			<td style='width:30%' class='forumheader3'>" . REVIEWER_A016 . "</td>
			<td style='width:70%' class='forumheader3'>
				<input class='tbox' type='checkbox' name='reviewer_use2' value='1' " . ($REVIEWER_PREF['reviewer_use2'] > 0?"checked='checked'":"") . " />
	" . REVIEWER_A028 . " <input class='tbox' type='text' style='width:30%' maxlength='20' name='reviewer_rate2' value='" . $tp->toFORM($REVIEWER_PREF['reviewer_rate2']) . "' />
			</td>
		</tr>";
// use 3
$reviewer_text .= "
		<tr id='reviewer_ac3' style='display:{$reviewer_display}'>
			<td style='width:30%' class='forumheader3'>" . REVIEWER_A017 . "</td>
			<td style='width:70%' class='forumheader3'>
				<input class='tbox' type='checkbox' name='reviewer_use3' value='1' " . ($REVIEWER_PREF['reviewer_use3'] > 0?"checked='checked'":"") . " />
	" . REVIEWER_A028 . " <input class='tbox' type='text' style='width:30%' maxlength='20' name='reviewer_rate3' value='" . $tp->toFORM($REVIEWER_PREF['reviewer_rate3']) . "' />
			</td>
		</tr>";
// use 4
$reviewer_text .= "
		<tr id='reviewer_ac4' style='display:{$reviewer_display}'>
			<td style='width:30%' class='forumheader3'>" . REVIEWER_A018 . "</td>
			<td style='width:70%' class='forumheader3'>
				<input class='tbox' type='checkbox' name='reviewer_use4' value='1' " . ($REVIEWER_PREF['reviewer_use4'] > 0?"checked='checked'":"") . " />
		" . REVIEWER_A028 . " <input class='tbox' type='text' style='width:30%' maxlength='20' name='reviewer_rate4' value='" . $tp->toFORM($REVIEWER_PREF['reviewer_rate4']) . "' />
			</td>
		</tr>";
// use 5
$reviewer_text .= "
<tr id='reviewer_ac5' style='display:{$reviewer_display}'>
<td style='width:30%' class='forumheader3'>" . REVIEWER_A019 . "</td>
<td style='width:70%' class='forumheader3'>
	<input class='tbox' type='checkbox' name='reviewer_use5' value='1' " . ($REVIEWER_PREF['reviewer_use5'] > 0?"checked='checked'":"") . " />
	" . REVIEWER_A028 . " <input class='tbox' type='text' style='width:30%' maxlength='20' name='reviewer_rate5' value='" . $tp->toFORM($REVIEWER_PREF['reviewer_rate5']) . "' />
</td>
</tr>";
// use 6
$reviewer_text .= "
<tr id='reviewer_ac6' style='display:{$reviewer_display}'>
<td style='width:30%' class='forumheader3'>" . REVIEWER_A029 . "</td>
<td style='width:70%' class='forumheader3'>
	<input class='tbox' type='checkbox' name='reviewer_use6' value='1' " . ($REVIEWER_PREF['reviewer_use6'] > 0?"checked='checked'":"") . " />
	" . REVIEWER_A028 . " <input class='tbox' type='text' style='width:30%' maxlength='20' name='reviewer_rate6' value='" . $tp->toFORM($REVIEWER_PREF['reviewer_rate6']) . "' />
</td>
</tr>";
// use 5
$reviewer_text .= "
<tr id='reviewer_ac7' style='display:{$reviewer_display}'>
<td style='width:30%' class='forumheader3'>" . REVIEWER_A030 . "</td>
<td style='width:70%' class='forumheader3'>
	<input class='tbox' type='checkbox' name='reviewer_use7' value='1' " . ($REVIEWER_PREF['reviewer_use7'] > 0?"checked='checked'":"") . " />
	" . REVIEWER_A028 . " <input class='tbox' type='text' style='width:30%' maxlength='20' name='reviewer_rate7' value='" . $tp->toFORM($REVIEWER_PREF['reviewer_rate7']) . "' />
</td>
</tr>";
// use 5
$reviewer_text .= "
<tr id='reviewer_ac8' style='display:{$reviewer_display}'>
<td style='width:30%' class='forumheader3'>" . REVIEWER_A031 . "</td>
<td style='width:70%' class='forumheader3'>
	<input class='tbox' type='checkbox' name='reviewer_use8' value='1' " . ($REVIEWER_PREF['reviewer_use8'] > 0?"checked='checked'":"") . " />
	" . REVIEWER_A028 . " <input class='tbox' type='text' style='width:30%' maxlength='20' name='reviewer_rate8' value='" . $tp->toFORM($REVIEWER_PREF['reviewer_rate8']) . "' />
</td>
</tr>";
// use 5
$reviewer_text .= "
<tr id='reviewer_ac9' style='display:{$reviewer_display}'>
<td style='width:30%' class='forumheader3'>" . REVIEWER_A032 . "</td>
<td style='width:70%' class='forumheader3'>
	<input class='tbox' type='checkbox' name='reviewer_use9' value='1' " . ($REVIEWER_PREF['reviewer_use9'] > 0?"checked='checked'":"") . " />
	" . REVIEWER_A028 . " <input class='tbox' type='text' style='width:30%' maxlength='20' name='reviewer_rate9' value='" . $tp->toFORM($REVIEWER_PREF['reviewer_rate9']) . "' />
</td>
</tr>";
// use 5
$reviewer_text .= "
<tr id='reviewer_ac10' style='display:{$reviewer_display}'>
<td style='width:30%' class='forumheader3'>" . REVIEWER_A033 . "</td>
<td style='width:70%' class='forumheader3'>
	<input class='tbox' type='checkbox' name='reviewer_use10' value='1' " . ($REVIEWER_PREF['reviewer_use10'] > 0?"checked='checked'":"") . " />
	" . REVIEWER_A028 . " <input class='tbox' type='text' style='width:30%' maxlength='20' name='reviewer_rate10' value='" . $tp->toFORM($REVIEWER_PREF['reviewer_rate10']) . "' />
</td>
</tr>";
// use comments
$reviewer_text .= "
<tr>
<td style='width:30%' class='forumheader3'>" . REVIEWER_A020 . "</td>
<td style='width:70%' class='forumheader3'><input class='tbox' type='checkbox' name='reviewer_comments' value='1' " . ($REVIEWER_PREF['reviewer_comments'] > 0?"checked='checked'":"") . " /></td>
</tr>";
// edit own reviews
$reviewer_text .= "
<tr>
<td style='width:30%' class='forumheader3'>" . REVIEWER_AC031 . "</td>
<td style='width:70%' class='forumheader3'><input class='tbox' type='checkbox' name='reviewer_editown' value='1' " . ($REVIEWER_PREF['reviewer_editown'] > 0?"checked='checked'":"") . " /></td>
</tr>";
$reviewer_text .= "
<tr>
<td style='width:30%' class='forumheader3'>" . REVIEWER_AC032 . "</td>
<td style='width:70%' class='forumheader3'><input class='tbox' type='checkbox' name='reviewer_editownitem' value='1' " . ($REVIEWER_PREF['reviewer_editownitem'] > 0?"checked='checked'":"") . " /></td>
</tr>";
// force disclaimer
$reviewer_text .= "
<tr>
<td style='width:30%' class='forumheader3'>" . REVIEWER_A022 . "</td>
<td style='width:70%' class='forumheader3'><input class='tbox' type='checkbox' name='reviewer_disclaimer' value='1' " . ($REVIEWER_PREF['reviewer_disclaimer'] > 0?"checked='checked'":"") . " /></td>
</tr>";
// use half points in reviews
$reviewer_text .= "
<tr>
<td style='width:30%' class='forumheader3'>" . REVIEWER_AC029 . "</td>
<td style='width:70%' class='forumheader3'><input class='tbox' type='checkbox' name='reviewer_half' value='1' " . ($REVIEWER_PREF['reviewer_half'] > 0?"checked='checked'":"") . " /></td>
</tr>";
// use captcha
$reviewer_text .= "
<tr>
<td style='width:30%' class='forumheader3'>" . REVIEWER_AI028 . "</td>
<td style='width:70%' class='forumheader3'><input class='tbox' type='checkbox' name='reviewer_captcha' value='1' " . ($REVIEWER_PREF['reviewer_captcha'] > 0?"checked='checked'":"") . " /></td>
</tr>";
// use seo
$reviewer_text .= "
<tr>
<td style='width:30%' class='forumheader3'>" . REVIEWER_AI034 . "</td>
<td style='width:70%' class='forumheader3'><input class='tbox' type='checkbox' name='reviewer_seo' value='1' " . ($REVIEWER_PREF['reviewer_seo'] > 0?"checked='checked'":"") . " /><br /><i>".REVIEWER_AI035."</i></td>
</tr>";
$reviewer_text .= "
<tr>
<td style='width:30%' class='forumheader3'>" . REVIEWER_AC026 . "</td>
<td style='width:70%' class='forumheader3'><textarea class='tbox' style='width:80%;' rows='6' cols='50' id='reviewer_TC' name='reviewer_TC' >" . $tp->toFORM($REVIEWER_PREF['reviewer_TC']) . "</textarea></td>
</tr>";
// Submit button
$reviewer_text .= "
<tr>
<td colspan='2' class='forumheader2' style='text-align: left;'><input type='submit' name='update' value='" . REVIEWER_A023 . "' class='button' />
</td>
</tr>
<tr>
<td colspan='2' class='fcaption' style='text-align: left;'>&nbsp;
</td>
</tr>";
$reviewer_text .= "</table></form>";
$ns->tablerender(REVIEWER_A001, $reviewer_text);
require_once(e_ADMIN . "footer.php");
