<?php
/*
+---------------------------------------------------------------+
|        On This Day Menu for e107 v7xx - by Father Barry
|
|        This module for the e107 .7+ website system
|        Copyright Barry Keal 2004-2009
|
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
|
+---------------------------------------------------------------+
*/
if (!defined('e107_INIT'))
{
    exit;
}
global $sql, $tp, $pref, $OTD_PREF, $otd_obj, $e107cache;

if (!is_object($otd_obj))
{
    require_once(e_PLUGIN . 'onthisday_menu/includes/onthisday_class.php');
    $otd_obj = new onthisday;
}
$otd_now = time() + ($pref['time_offset'] * 3600);
$otd_today = date("dmY", $otd_now);
// print date("d",$OTD_PREF['otd_last']) ." ". date("d",$otd_now);
if (date("d", $OTD_PREF['otd_last']) != date("d", $otd_now))
{
    $e107cache->clear("nq_otdmenu");
    $e107cache->clear("otd_display");
    $OTD_PREF['otd_last'] = $otd_now;
    $otd_obj->save_prefs();
}
if ($cacheData = $e107cache->retrieve("nq_otdmenu"))
{
    echo $cacheData;
}
else
{      
    if ($otd_obj->otd_read)
    {
        include_lan(e_PLUGIN . "onthisday_menu/languages/" . e_LANGUAGE . ".php");

        $otd_thisday = date("j");
        $otd_thismonth = date("n");
        $otd_text = "";
        if ($sql->db_Select("onthisday", "*", "where otd_day='$otd_thisday' and otd_month='$otd_thismonth' order by otd_year", "nowhere", false))
        {
            while ($item = $sql->db_Fetch())
            {
                extract($item);
                $otd_text .= "<img src='" . THEME . "images/bullet2.gif' alt='' /> ";
                if ($otd_full)
                {
                    $otd_text .= "<a href='" . e_PLUGIN . "onthisday_menu/index.php?$otd_today'>" . ($otd_year > 0?OTD_03 . " " . $otd_year:OTD_02);
                }

                if ($otd_full)
                {
                    $otd_text .= "</a>";
                }

                $otd_text .= "<br />" . $tp->html_truncate($tp->toHTML($otd_brief, false, "no_make_clickable emotes_off"), $OTD_PREF['otd_maxlength'], OTD_MORE) . "<br />" ;
            }
            $otd_text.="<div style='text-align:center'><a href='".e_PLUGIN."onthisday_menu/index.php'>".OTD_015."</a></div>";
        }
        else
        {
            if ($OTD_PREF['otd_showempty'])
            {
                $otd_text = OTDLAN_DEFAULT;
            }
        }
        if ($otd_obj->otd_submit)
        {
            // allowed to submit so display link
            $otd_text .= "<div style='text-align:center;'><a href='" . e_PLUGIN . "onthisday_menu/manage_entries.php'>" . OTD_001 . "</a></div>";
        }

        ob_start(); // Set up a new output buffer
        $ns->tablerender(OTDLAN_CAP, $otd_text); // Render the menu
        $cache_data = ob_get_flush(); // Get the menu content, and display it
        $e107cache->set("nq_otdmenu", $cache_data); // Save to cache
    }
}
