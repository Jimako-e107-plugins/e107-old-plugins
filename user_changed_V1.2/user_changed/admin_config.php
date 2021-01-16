<?php
/*
+---------------------------------------------------------------+
|        User Settings Change Notification
|		 for e107 v7xx - by Father Barry
|
|        This module for the e107 .7+ website system
|        Copyright Barry Keal 2004-2008
|
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
|
+---------------------------------------------------------------+
*/

// Thanks to Steve D for the addition of checking for which fields to notify on.
require_once('../../class2.php');
if (!defined('e107_INIT'))
{
    exit;
}
if (!getperms('P'))
{
    header('location:'.e_HTTP.'index.php');
    exit;
}
require_once(e_ADMIN.'auth.php');
require_once(e_HANDLER.'user_extended_class.php');
include_lan(e_PLUGIN.'user_changed/languages/admin/'.e_LANGUAGE.'.php');

$ue = new e107_user_extended;

if (!defined(ADMIN_WIDTH))
{
    define(ADMIN_WIDTH, 'width:100%');
}

// Array of fields to consider. Key is the form field name, value is the DB column name
$fieldOptions = array('username'=>'user_name', 'loginname'=> 'user_loginname', 'realname' => 'user_login',
			'customtitle' => 'user_customtitle', 'email' => 'user_email', 'hideemail' => 'user_hideemail',
			'signature' => 'user_signature', 'image' => 'user_image', 'user_xup' => 'user_xup');

$xtdFields = $ue->user_extended_get_fieldList();
foreach ($xtdFields as $f)
{
	if (1)		// Could add a check for other classes here
	{
		$fieldName = 'user_'.$f['user_extended_struct_name'];
		$fieldOptions['ue#'.$fieldName] = $fieldName;
	}
}
unset($xtdFields);


if (isset($_POST['userChangeUpdate']))
{
	$userEntered = array();
	foreach($_POST as $k => $v)
	{
		if (isset($fieldOptions[$k])) { $userEntered[$k] = $fieldOptions[$k]; }
	}
	$pref['user_changed_fields'] = $userEntered;
	save_prefs();
}

$userEntered = varset($pref['user_changed_fields'],array());

$user_changed_text .= '
<form method="post" action="' . e_SELF . '?update" id="user_changed">
	<table style="' . ADMIN_WIDTH . '" class="fborder">
		<tr>
			<td colspan="2" class="fcaption">' . UCHANGE_A09 . '</td>
		</tr>
		<tr>
			<td colspan="2" class="forumheader2"><b>' . UCHANGE_A04 . '</b>&nbsp;</td>
		</tr>';

$user_changed_text.= "
		<tr>
			<td class='forumheader3'>";
$spacer = '';
foreach ($fieldOptions as $k => $v)
{
	$checked = isset($userEntered[$k]) ? " checked='checked'" : '';
	$user_changed_text .= $spacer."<input type='checkbox' class='tbox' name='{$k}' value='1'{$checked} /> ".$v;
	$spacer = '<br />';
}
$user_changed_text .= "
			</td>
			<td class='forumheader3'>".UCHANGE_A10."</td>
		</tr>";

$user_changed_text .= "
		<tr>
			<td colspan='2' class='forumheader2' style='text-align: left;'>
				<input type='submit' class='button' name='userChangeUpdate' value='".UCHANGE_A11."'>
			</td>
		</tr>
		<tr>
			<td colspan='2' class='fcaption' style='text-align: left;'>&nbsp;</td>
		</tr>

	</table>
</form>";

$ns->tablerender(UCHANGE_A08, $user_changed_text);

require_once(e_ADMIN . 'footer.php');
