<?php
// **************************************************************************
// *
// *  Newslinks Menu for e107 v7xx
// *
// **************************************************************************
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
require_once(e_PLUGIN . "newslink/includes/newslink_class.php");
if (!is_object($newslink_obj))
{
    $newslink_obj = new newslink;
}

if (e_QUERY == "update")
{
    // Update rest
    $NEWSLINK_PREF['newslink_perpage'] = intval($_POST['newslink_perpage']);
    $NEWSLINK_PREF['newslink_readclass'] = intval($_POST['newslink_readclass']);
    $NEWSLINK_PREF['newslink_submitclass'] = intval($_POST['newslink_submitclass']);
    $NEWSLINK_PREF['newslink_autoclass'] = intval($_POST['newslink_autoclass']);
    $NEWSLINK_PREF['newslink_inmenu'] = intval($_POST['newslink_inmenu']);
    $NEWSLINK_PREF['newslink_metad'] = $tp->toDB($_POST['newslink_metad']);
    $NEWSLINK_PREF['newslink_metak'] = $tp->toDB($_POST['newslink_metak']);
    $NEWSLINK_PREF['newslink_deforder'] = intval($_POST['newslink_deforder']);
    $NEWSLINK_PREF['newslink_ownedit'] = intval($_POST['newslink_ownedit']);
    $NEWSLINK_PREF['newslink_adminclass'] = intval($_POST['newslink_adminclass']);
    $NEWSLINK_PREF['newslink_rating'] = intval($_POST['newslink_rating']);
    $NEWSLINK_PREF['newslink_captcha'] = intval($_POST['newslink_captcha']);
    $newslink_obj->save_prefs();
    $newslink_msgtext = "<strong>" . NEWSLINK_A7 . "</strong>";
}

$newslink_text .= "
<form method='post' action='" . e_SELF . "?update' id='confdocrep'>
	<table style='" . ADMIN_WIDTH . "' class='fborder'>
		<tr>
			<td colspan='2' class='fcaption'>" . NEWSLINK_A1 . "</td>
		</tr>
		<tr>
			<td class='forumheader3' colspan='2'>{$newslink_msgtext}&nbsp;</td>
		</tr>";
// Main admin class
$newslink_text .= "
		<tr>
			<td style='width:30%' class='forumheader3'>" . NEWSLINK_A5 . "</td>
			<td style='width:70%' class='forumheader3'>" . r_userclass("newslink_readclass", $NEWSLINK_PREF['newslink_readclass'], "off", "nobody,public,members,guest,main,admin,classes") . "</td>
		</tr>";
$newslink_text .= "
		<tr>
			<td style='width:30%' class='forumheader3'>" . NEWSLINK_A6 . "</td>
			<td style='width:70%' class='forumheader3'>" . r_userclass("newslink_submitclass", $NEWSLINK_PREF['newslink_submitclass'], "off", "nobody,public,members,guest,main,admin,classes") . "</td>
		</tr>";
$newslink_text .= "
		<tr>
			<td style='width:30%' class='forumheader3'>" . NEWSLINK_A83 . "</td>
			<td style='width:70%' class='forumheader3'>" . r_userclass("newslink_autoclass", $NEWSLINK_PREF['newslink_autoclass'], "off", "nobody,public,members,guest,main,admin,classes") . "</td>
		</tr>";
$newslink_text .= "
		<tr>
			<td style='width:30%' class='forumheader3'>" . NEWSLINK_A104 . "</td>
			<td style='width:70%' class='forumheader3'>" . r_userclass("newslink_adminclass", $NEWSLINK_PREF['newslink_adminclass'], "off", "nobody,main,admin,classes") . "</td>
		</tr>";
$newslink_text .= "
		<tr>
			<td style='width:30%' class='forumheader3'>" . NEWSLINK_A98 . "</td>
			<td style='width:70%' class='forumheader3'>
				<input name='newslink_ownedit' value='1' type='checkbox' class='tbox' style='border:0;'" . ($NEWSLINK_PREF['newslink_ownedit'] == 1?"checked='checked'":"") . " />
			</td>
		</tr>";
$newslink_text .= "
		<tr>
			<td style='width:30%' class='forumheader3'>" . NEWSLINK_A115 . "</td>
			<td style='width:70%' class='forumheader3'>
				<input name='newslink_captcha' value='1' type='checkbox' class='tbox' style='border:0;'" . ($NEWSLINK_PREF['newslink_captcha'] == 1?"checked='checked'":"") . " />
			</td>
		</tr>";
// $newslink_text .= "
// <tr>
// <td style='width:30%' class='forumheader3'>" . NEWSLINK_A114 . "</td>
// <td style='width:70%' class='forumheader3'>
// <input name='newslink_rating' value='1' type='checkbox' class='tbox' style='border:0;'" . ($NEWSLINK_PREF['newslink_rating'] == 1?"checked='checked'":"") . " />
// </td>
// </tr>";
// Number of newslink to show
$newslink_text .= "
		<tr>
			<td style='width:30%' class='forumheader3'>" . NEWSLINK_A9 . "</td>
			<td style='width:70%' class='forumheader3'><input class='tbox' type='text'  size='10' name='newslink_perpage' value='" . $tp->toFORM($NEWSLINK_PREF['newslink_perpage']) . "' /></td>
		</tr>";
// Number of newslink in menu
$newslink_text .= "
		<tr>
			<td style='width:30%' class='forumheader3'>" . NEWSLINK_A61 . "</td>
			<td style='width:70%' class='forumheader3'><input class='tbox' type='text'  size='10' name='newslink_inmenu' value='" . $tp->toFORM($NEWSLINK_PREF['newslink_inmenu']) . "' /></td>
		</tr>";
$newslink_text .= "
		<tr>
			<td style='width:30%' class='forumheader3'>" . NEWSLINK_A86 . "</td>
			<td style='width:70%' class='forumheader3'>
				<select class='tbox' name='newslink_deforder' >
					<option value='0' " . ($NEWSLINK_PREF['newslink_deforder'] == 0?"selected='selected'":"") . ">" . NEWSLINK_A87 . "</option>
					<option value='1' " . ($NEWSLINK_PREF['newslink_deforder'] == 1?"selected='selected'":"") . ">" . NEWSLINK_A88 . "</option>
					<option value='2' " . ($NEWSLINK_PREF['newslink_deforder'] == 2?"selected='selected'":"") . ">" . NEWSLINK_A89 . "</option>
				</select>
			</td>
		</tr>";
$newslink_text .= "
		<tr>
			<td style='width:30%' class='forumheader3'>" . NEWSLINK_A84 . "</td>
			<td style='width:70%' class='forumheader3'><textarea name='newslink_metad' style='width:85%;vertical-align:top;' cols = '100' rows='6' class='tbox' >" . $tp->toFORM($NEWSLINK_PREF['newslink_metad']) . "</textarea></td>
		</tr>";
$newslink_text .= "
		<tr>
			<td style='width:30%' class='forumheader3'>" . NEWSLINK_A85 . "</td>
			<td style='width:70%' class='forumheader3'><textarea name='newslink_metak' style='width:85%;vertical-align:top;' cols = '100' rows='6' class='tbox' >" . $tp->toFORM($NEWSLINK_PREF['newslink_metak']) . "</textarea></td>
		</tr>";
// Submit button
$newslink_text .= "
		<tr>
			<td colspan='2' class='forumheader' style='text-align: left;'><input type='submit' name='update' value='" . NEWSLINK_A10 . "' class='button' /></td>
		</tr>";
$newslink_text .= "
	</table>
</form>";

$ns->tablerender(NEWSLINK_A2, $newslink_text);

require_once(e_ADMIN . "footer.php");

?>