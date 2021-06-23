<?php

/*
+---------------------------------------------------------------+
|        Birthday Menu for e107 v7xx - by Father Barry
|
|        This module for the e107 .7+ website system
|        Copyright Barry Keal 2004-2008
|
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
|
+---------------------------------------------------------------+
*/

$e_gold[] = array("plug_name" => "Birthday Menu", "plug_folder" => "bday_menu", "add" => true, "deduct" => false);

if (!function_exists("bday_menu_configure_edit"))
{
    function bday_menu_configure_edit()
    {
        // get globals in case already set
        global $pref;
        // get the language file for the jokes
        include_lan(e_PLUGIN . "bday_menu/languages/" . e_LANGUAGE . "_birthday_mnu.php");
        // *
        // * Create the entry form
        // *
        $retval = "
<form method='post' action='" . e_SELF . "' id='bday_gold' >
<div>
	<input type='hidden' name='gold_plugin' value='bday_menu' />
</div>
<table class='fborder' style='" . ADMIN_WIDTH . "'>
	<tr>
		<td class='fcaption' colspan='2' style='text-align:left'>" . BDAY_ADMIN_GOLD01 . "</td>
	</tr>
	<tr>
		<td class='forumheader2' colspan='2' style='text-align:left'><b>" . $gold_msg . "</b>&nbsp;</td>
	</tr>
		<tr>
		<td class='forumheader3' style='width:30%;text-align:left'>" . BDAY_ADMIN_GOLD02 . "</td>
		<td class='forumheader3' style='width:70%;text-align:left'>
			<input type='text' class='tbox' name='bday_gold' value='" . $pref['bday_gold'] . "' />
		</td>
	</tr>
	<tr>
		<td class='forumheader2' colspan='2' style='text-align:left'>
			<input type='submit' class='button' name='gold_save' value='" . BDAY_ADMIN_GOLD03 . "'</td>
	</tr>
	<tr>
		<td class='fcaption' colspan='2' style='text-align:left'>&nbsp;</td>
	</tr>
</table>
</form>
";
        return $retval;
    }
}
if (!function_exists("bday_menu_configure_save"))
{
    function bday_menu_configure_save()
    {
        global $pref, $tp;
        // get the language file for the birthday menu
        include_lan(e_PLUGIN . "bday_menu/languages/" . e_LANGUAGE . "_birthday_mnu.php");
        $pref['bday_gold'] = $tp->toDB($_POST['bday_gold']);
        save_prefs();
        // return a message saying saved
        return BDAY_ADMIN_GOLDSAVE;
    }
}

?>