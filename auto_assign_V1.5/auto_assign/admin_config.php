<?php
/*
+---------------------------------------------------------------+
|	Auto Assign Plugin for e107
|
|	Copyright (C) Father Barry Keal 2003 - 2008
|	http://www.keal.me.uk
|
|	Released under the terms and conditions of the
|	GNU General Public License (http://gnu.org).
+---------------------------------------------------------------+
*/
require_once('../../class2.php');
if (!defined("e107_INIT"))
{
    exit;
}
if (!getperms('P'))
{
    header('location:' . e_HTTP . 'index.php');
    exit;
}
require_once(e_ADMIN . 'auth.php');
if (!defined(ADMIN_WIDTH))
{
    define(ADMIN_WIDTH, 'width:100%;');
}
require_once(e_HANDLER . 'userclass_class.php');
include_lan(e_PLUGIN . 'auto_assign/languages/admin/' . e_LANGUAGE . '.php');

if (e_QUERY == 'update')
{
    // Update rest
    $pref['autoassign_class1'] = intval($_POST['autoassign_class1']);
    $pref['autoassign_class2'] = intval($_POST['autoassign_class2']);
    $pref['autoassign_class3'] = intval($_POST['autoassign_class3']);
    $pref['autoassign_class4'] = intval($_POST['autoassign_class4']);
    $pref['autoassign_class5'] = intval($_POST['autoassign_class5']);

    save_prefs();
    $autoassign_msgtext =  AUTOASSIGN_A07 ;
}

$autoassign_text .= '
<form method="post" action="' . e_SELF . '?update" id="confdocrep">
	<table style="' . ADMIN_WIDTH . '" class="fborder">
		<tr>
			<td colspan="2" class="fcaption">' . AUTOASSIGN_A01 . '</td>
		</tr>
 		<tr>
		 	<td class="forumheader2" colspan="2"><strong>' . $autoassign_msgtext . '</strong>&nbsp;</td>
		</tr>';
// Classes
$autoassign_text .= '
		<tr>
			<td style="width:30%" class="forumheader3">' . AUTOASSIGN_A02 . '</td>
			<td style="width:70%" class="forumheader3">' . r_userclass('autoassign_class1', $tp->toFORM($pref['autoassign_class1']), 'off', 'nobody,classes') . '</td>
		</tr>';
$autoassign_text .= '
		<tr>
			<td style="width:30%" class="forumheader3">' . AUTOASSIGN_A03 . '</td>
			<td style="width:70%" class="forumheader3">' . r_userclass('autoassign_class2', $tp->toFORM($pref['autoassign_class2']), 'off', 'nobody,classes') . '</td>
		</tr>';
$autoassign_text .= '
		<tr>
			<td style="width:30%" class="forumheader3">' . AUTOASSIGN_A04 . '</td>
			<td style="width:70%" class="forumheader3">' . r_userclass('autoassign_class3', $tp->toFORM($pref['autoassign_class3']), 'off', 'nobody,classes') . '</td>
		</tr>';
$autoassign_text .= '
		<tr>
			<td style="width:30%" class="forumheader3">' . AUTOASSIGN_A05 . '</td>
			<td style="width:70%" class="forumheader3">' . r_userclass('autoassign_class4', $tp->toFORM($pref['autoassign_class4']), 'off', 'nobody,classes') . '</td>
		</tr>';
$autoassign_text .= '
		<tr>
			<td style="width:30%" class="forumheader3">' . AUTOASSIGN_A06 . '</td>
			<td style="width:70%" class="forumheader3">' . r_userclass('autoassign_class5', $tp->toFORM($pref['autoassign_class5']), 'off', 'nobody,classes') . '</td>
		</tr>';
// Submit button
$autoassign_text .= '
		<tr>
			<td colspan="2" class="forumheader2" style="text-align: left;"><input type="submit" name="update" value="' . AUTOASSIGN_A08 . '" class="button" /></td>
		</tr>
		<tr>
			<td colspan="2" class="fcaption" style="text-align: left;">&nbsp;</td>
		</tr>
	</table>
</form>';

$ns->tablerender(AUTOASSIGN_A01, $autoassign_text);

require_once(e_ADMIN . 'footer.php');

?>