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
if (USERID > 0)
{
include_lan(e_PLUGIN . 'mylevel_menu/languages/' . e_LANGUAGE . '.php');
require_once(e_HANDLER."userclass_class.php");
    // if not a user then don't display the menu
    global $tp, $sql, $MYLEVEL_PREF, $mylevel_obj;
    require_once(e_PLUGIN . "mylevel_menu/includes/mylevel_class.php");
    if (!is_object($mylevel_obj))
    {
        $mylevel_obj = new mylevel;
    }
    // If user is not in the exclude class
    if (!in_array(USERID, $mylevel_obj->mylevel_excluded))
    {
        if ($mylevel_text = $e107cache->retrieve("nq_mylevel_menu"))
        {
            // If cached get that
            echo $mylevel_text;
        }
        else
        {
            $mylevel_template="
			<div style='text-align:center;width:100%;' >{MYLEVEL=".$mylevel_obj->mylevel_display.",".USERID.",true}</div>";
            $mylevel_text = $tp->parseTemplate($mylevel_template,true,$mylevel_shortcodes);
            ob_start();
            $ns->tablerender(MYLEVEL_TITLE, $mylevel_text);
            $mylevel_cache = ob_get_flush();
            $e107cache->set("nq_mylevel_menu", $mylevel_cache);
        }
    }
}

?>