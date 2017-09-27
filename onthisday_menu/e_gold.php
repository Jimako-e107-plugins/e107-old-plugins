<?php
require_once(e_HANDLER . "userclass_class.php");
include_lan(e_PLUGIN . 'onthisday_menu/languages/' . e_LANGUAGE . '.php');
$e_gold[] = array('plug_name' => OTD_G01, 'plug_folder' => 'onthisday_menu', 'add' => true, 'deduct' => false,
    'gold_menu' => true,
    'gold_link' => '{e_PLUGIN}onthisday_menu/index.php',
    'gold_title' => OTD_G01);

if (!function_exists('onthisday_menu_configure_edit'))
{
    function onthisday_menu_configure_edit()
    {
        // get globals in case already set
        global $otd_obj, $OTD_PREF, $tp;
        if (!is_object($otd_obj))
        {
            require_once(e_PLUGIN . 'onthisday_menu/includes/onthisday_class.php');
            $otd_obj = new onthisday;
        }
        // get the language file for the menu
        include_lan(e_PLUGIN . 'onthisday_menu/languages/' . e_LANGUAGE . '.php');


        // *
        // * Create the entry form
        // *
        $retval = "
<form method='post' action='" . e_SELF . "' id='onthisday_menuform' >
<div>
	<input type='hidden' name='gold_plugin' value='onthisday_menu' />
</div>
<table class='fborder' style='" . ADMIN_WIDTH . "'>
	<tr>
		<td class='fcaption' colspan='2' style='text-align:left'>" . OTD_G01 . "</td>
	</tr>
	<tr>
		<td class='forumheader2' colspan='2' style='text-align:left'><b>" . $gold_msg . "</b>&nbsp;</td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:30%;text-align:left'>" . OTD_G03 . "</td>
		<td class='forumheader3' style='width:70%;text-align:left'>
			<input type='text' class='tbox' name='otd_goldamount' value='" . $OTD_PREF['otd_goldamount'] . "' />
		</td>
	</tr>
	<tr>
		<td class='forumheader2' colspan='2' style='text-align:left'>
			<input type='submit' class='button' name='gold_save' value='" . OTD_G04 . "'</td>
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
if (!function_exists('onthisday_menu_configure_save'))
{
    function onthisday_menu_configure_save()
    {
        // get globals in case already set
        global $otd_obj, $OTD_PREF, $tp;
        if (!is_object($otd_obj))
        {
            require_once(e_PLUGIN . 'onthisday_menu/includes/onthisday_class.php');
            $otd_obj = new onthisday;
        }
        // get the language file
        include_lan(e_PLUGIN . 'onthisday_menu/languages/' . e_LANGUAGE . '.php');
        // save the gold amount
        $OTD_PREF['otd_goldamount'] = $tp->toDB($_POST['otd_goldamount']);
        $otd_obj->save_prefs();
        // return a message saying saved
        return OTD_G02;
    }
}
