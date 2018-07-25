<?php
/*
+---------------------------------------------------------------+
|        e_Classifieds Classified advert manager for e107 v7xx - by Father Barry
|
|        This module for the e107 .7+ website system
|        Copyright Barry Keal 2004-2008
|
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
|
+---------------------------------------------------------------+
*/

include_lan(e_PLUGIN . "e_classifieds/languages/" . e_LANGUAGE . ".php");
$e_gold[] = array("plug_name" => "Classifieds",
    "plug_folder" => "e_classifieds",
    "credit" => false,
    "deduct" => true,
    'gold_menu' => true,
    'gold_link' => '{e_PLUGIN}e_classifieds/classifieds.php',
    'gold_title' => 'Classifieds');
if (!function_exists('e_classifieds_configure_edit'))
{
    function e_classifieds_configure_edit()
    {
        // get globals in case already set
        global $eclassf_obj, $ECLASSF_PREF;
        // check if the classifieds object exists
        if (!is_object($eclassf_obj))
        {
            // Not created object so get the class
            require_once(e_PLUGIN . "e_classifieds/includes/eclassifieds_class.php");
            // and create the object
            $eclassf_obj = new classifieds;
        }
        // *
        // * Create the entry form
        // *
        $retval = "
<form method='post' action='" . e_SELF . "' id='gold_classifieds' >
<div>
	<input type='hidden' name='gold_plugin' value='e_classifieds' />
</div>
<table class='fborder' style='" . ADMIN_WIDTH . "'>
	<tr>
		<td class='fcaption' colspan='2' style='text-align:left'>" . ECLASSF_GOLD_04 . "</td>
	</tr>
	<tr>
		<td class='forumheader2' colspan='2' style='text-align:left'><b>" . $gold_msg . "</b>&nbsp;</td>
	</tr>
		<tr>
		<td class='forumheader3' style='width:30%;text-align:left'>" . ECLASSF_GOLD_01 . "</td>
		<td class='forumheader3' style='width:70%;text-align:left'>
			<input type='text' class='tbox' name='eclassf_goldcost' value='" . $ECLASSF_PREF['eclassf_goldcost'] . "' />
		</td>
	</tr>
	<tr>
		<td class='forumheader2' colspan='2' style='text-align:left'>
			<input type='submit' class='button' name='gold_save' value='" . ECLASSF_GOLD_02 . "'</td>
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
if (!function_exists("e_classifieds_configure_save"))
{
    function e_classifieds_configure_save()
    {
        // get globals in case already set
        global $eclassf_obj, $ECLASSF_PREF;
        // check if the classifieds object exists
        if (!is_object($eclassf_obj))
        {
            // Not created object so get the class
            require_once(e_PLUGIN . "e_classifieds/includes/eclassifieds_class.php");
            // and create the object
            $eclassf_obj = new classifieds;
        }
        // save the  max bet
        $ECLASSF_PREF['eclassf_goldcost'] = $_POST['eclassf_goldcost'];

        $eclassf_obj->save_prefs();
        // return a message saying saved
        return ECLASSF_GOLD_03;
    }
}

?>