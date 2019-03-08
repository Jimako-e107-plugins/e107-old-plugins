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
if (!defined('e107_INIT'))
{
    exit;
}
if (!function_exists("portfolio_mtemplate"))
{
    function portfolio_mtemplate($top_show_author, $top_show_date, $top_show_category,$top_show_info)
    {
        $top_returnval = "{TOPMENU_ITEM}<br />";
        if ($top_show_info)
        {
            $top_returnval .= "{TOPMENU_INFO}<br />";
        }
        if ($top_show_author)
        {
            $top_returnval .= "Posted by {TOPMENU_POSTER}<br />";
        }
        if ($top_show_date)
        {
            $top_returnval .= "Posted on {TOPMENU_DATE}<br />";
        }

        $top_returnval .= "<br />";
        return $top_returnval;
    }
}
if (!function_exists("portfolio_ptemplate"))
{
    function portfolio_ptemplate($top_show_author, $top_show_date, $top_show_category,$top_show_info)
    {
        $top_returnval = "{TOPMENU_ITEM}<br />";
        if ($top_show_info)
        {
            $top_returnval .= "{TOPMENU_INFO}<br />";
        }
        if ($top_show_author)
        {
            $top_returnval .= "Posted by {TOPMENU_POSTER}<br />";
        }
        if ($top_show_date)
        {
            $top_returnval .= "Posted on {TOPMENU_DATE}<br />";
        }
        $top_returnval .= "<br />";
        return $top_returnval;
    }
}

?>