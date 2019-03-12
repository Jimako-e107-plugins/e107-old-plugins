<?php
/*
+---------------------------------------------------------------+
|        Portfolio manager for e107 v7xx - by Father Barry
|
|        This module for the e107 .7+ website system
|        Copyright Barry Keal 2004-2008
|
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
|
+---------------------------------------------------------------+
*/
$e_gold[] = array("plug_name" => "Portfolio", "plug_folder" => "portfolio", "credit" => true, "deduct" => true);
include_lan(e_PLUGIN . "portfolio/languages/" . e_LANGUAGE . ".php");

if (!function_exists('portfolio_configure_edit'))
{
    function portfolio_configure_edit()
    {
        // get globals in case already set
        global $portfolio_obj, $PORTFOLIO_PREF;

        require_once(e_PLUGIN . "portfolio/includes/portfolio_class.php");
        if (!is_object($portfolio_obj))
        {
            $portfolio_obj = new portfolio;
        }
        // *
        // * Create the entry form
        // *
        $retval = "
<form method='post' action='" . e_SELF . "' id='gold_portfolio' >
<div>
	<input type='hidden' name='gold_plugin' value='portfolio' />
</div>
<table class='fborder' style='" . ADMIN_WIDTH . "'>
	<tr>
		<td class='fcaption' colspan='2' style='text-align:left'>" . PORTFOLIO_GOLD_01 . "</td>
	</tr>
	<tr>
		<td class='forumheader2' colspan='2' style='text-align:left'><b>" . $gold_msg . "</b>&nbsp;</td>
	</tr>
		<tr>
		<td class='forumheader3' style='width:30%;text-align:left'>" . PORTFOLIO_GOLD_02 . "</td>
		<td class='forumheader3' style='width:70%;text-align:left'>
			<input type='text' class='tbox' name='portfolio_goldpost' value='" . $PORTFOLIO_PREF['portfolio_goldpost'] . "' />
		</td>
	</tr>
		<tr>
		<td class='forumheader3' style='width:30%;text-align:left'>" . PORTFOLIO_GOLD_03 . "</td>
		<td class='forumheader3' style='width:70%;text-align:left'>
			<input type='text' class='tbox' name='portfolio_goldview' value='" . $PORTFOLIO_PREF['portfolio_goldview'] . "' />
		</td>
	</tr>
	<tr>
		<td class='forumheader2' colspan='2' style='text-align:left'>
			<input type='submit' class='button' name='gold_save' value='" . PORTFOLIO_GOLD_04 . "'</td>
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
if (!function_exists("portfolio_configure_save"))
{
    function portfolio_configure_save()
    {
        // get globals in case already set
        global $portfolio_obj, $PORTFOLIO_PREF;
        global $portfolio_obj, $PORTFOLIO_PREF;

        require_once(e_PLUGIN . "portfolio/includes/portfolio_class.php");
        if (!is_object($portfolio_obj))
        {
            $portfolio_obj = new portfolio;
        }
        // save the  max bet
        $PORTFOLIO_PREF['portfolio_goldpost'] = $_POST['portfolio_goldpost'];
        $PORTFOLIO_PREF['portfolio_goldview'] = $_POST['portfolio_goldview'];

        $portfolio_obj->save_prefs();
        // return a message saying saved
        return PORTFOLIO_GOLD_05;
    }
}

?>