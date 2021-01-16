<?php
/*
+---------------------------------------------------------------+
|        MyLevel Menu for e107 v7xx - by Father Barry
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

require_once(e_PLUGIN."mylevel_menu/includes/mylevel_class.php");

if (!is_object($mylevel_obj))
{
    $mylevel_obj = new mylevel;
}
$mylevel_requires[]=e_HANDLER."userclass_class.php";
$mylevel_requires[]=e_PLUGIN."mylevel_menu/languages/English.php";
$mylevel_requires[]=e_PLUGIN."mylevel_menu/languages/readme/English.php";
$mylevel_requires[]=e_PLUGIN."mylevel_menu/languages/eversion/English.php";
$mymenu_msgtext=$mylevel_obj->check_requires($mylevel_requires);

require_once(e_HANDLER."userclass_class.php");
include_lan(e_PLUGIN . 'mylevel_menu/languages/' . e_LANGUAGE . '.php');
require_once(e_ADMIN . "auth.php");
if (!defined('ADMIN_WIDTH'))
{
    define(ADMIN_WIDTH, "width:100%;");
}
if (e_QUERY == "update")
{
    // Update rest
    $MYLEVEL_PREF['mylevel_adminclass'] = intval($_POST['mylevel_adminclass']);
    $MYLEVEL_PREF['mylevel_display'] = $tp->toDB($_POST['mylevel_display']);
    $MYLEVEL_PREF['mylevel_userate'] = intval($_POST['mylevel_userate']);
    $MYLEVEL_PREF['mylevel_excludeclass'] = intval($_POST['mylevel_excludeclass']);

    $mylevel_obj->save_prefs();
    $e107cache->clear("nq_mylevel_menu");
    $mymenu_msgtext .= "<strong>" . MYLEVEL_A7 . "</strong>";
}

$mymenu_text .= "
<form method='post' action='" . e_SELF . "?update' id='confmylevel'>
	<table style='" . ADMIN_WIDTH . "' class='fborder'>
		<tr>
			<td colspan='2' class='fcaption'>" . MYLEVEL_A1 . "</td>
		</tr>
		<tr>
			<td class='forumheader3' colspan='2'>{$mymenu_msgtext}&nbsp;</td>
		</tr>";
$mymenu_text .= "
		<tr>
			<td style='width:30%' class='forumheader3'>" . MYLEVEL_A51 . "</td>
			<td style='width:70%' class='forumheader3'>" . r_userclass("mylevel_excludeclass", $MYLEVEL_PREF['mylevel_excludeclass'], "off", "nobody,classes") . "</td>
		</tr>";
$mymenu_text .= "
		<tr>
			<td style='width:30%' class='forumheader3'>" . MYLEVEL_A3 . "</td>
			<td style='width:70%' class='forumheader3'>
				<select class='tbox' name='mylevel_display' >
					<option value='bar' " . ($MYLEVEL_PREF['mylevel_display'] == "bar"?"selected='selected'":"") . ">" . MYLEVEL_A4 . "</option>
					<option value='analogue' " . ($MYLEVEL_PREF['mylevel_display'] == "analogue"?"selected='selected'":"") . ">" . MYLEVEL_A5 . "</option>
					<option value='digital' " . ($MYLEVEL_PREF['mylevel_display'] == "digital"?"selected='selected'":"") . ">" . MYLEVEL_A6 . "</option>
					<option value='thermovert' " . ($MYLEVEL_PREF['mylevel_display'] == "thermovert"?"selected='selected'":"") . ">" . MYLEVEL_A38 . "</option>
					<option value='thermohoriz' " . ($MYLEVEL_PREF['mylevel_display'] == "thermohoriz"?"selected='selected'":"") . ">" . MYLEVEL_A39 . "</option>
				</select>
			</td>
		</tr>";
$mymenu_text .= "
		<tr>
			<td style='width:30%' class='forumheader3'>" . MYLEVEL_A40 . "</td>
			<td style='width:70%' class='forumheader3'>
				<input type='radio' value='0' name='mylevel_userate' class='tbox' style='border:0px;' ".($MYLEVEL_PREF['mylevel_userate']==0?"checked='checked'":"")." /> ".MYLEVEL_A41."<br />
				<input type='radio' value='1' name='mylevel_userate' class='tbox' style='border:0px;' ".($MYLEVEL_PREF['mylevel_userate']==1?"checked='checked'":"")." /> ".MYLEVEL_A42."<br />
				<input type='radio' value='2' name='mylevel_userate' class='tbox' style='border:0px;' ".($MYLEVEL_PREF['mylevel_userate']==2?"checked='checked'":"")." /> ".MYLEVEL_A43."
			</td>
		</tr>";
// Submit button
$mymenu_text .= "
		<tr>
			<td colspan='2' class='forumheader' style='text-align: left;'>
				<input type='submit' name='update' value='" . MYLEVEL_A10 . "' class='button' />
			</td>
		</tr>";
$mymenu_text .= "
	</table>
</form>";

$ns->tablerender(MYLEVEL_A2, $mymenu_text);

require_once(e_ADMIN . "footer.php");

?>