<?php
if (!defined('e107_INIT'))
{
    exit;
}
include_lan(e_PLUGIN . "faq/languages/" . e_LANGUAGE . ".php");
if (!function_exists("faq_mtemplate"))
{
    function faq_mtemplate($top_show_author, $top_show_date, $top_show_category,$top_show_info)
    {
        $top_returnval = "{TOPMENU_ITEM}<br />";
        if ($top_show_info)
        {
            $top_returnval .= "{TOPMENU_INFO}<br />";
        }
        if ($top_show_author)
        {
            $top_returnval .= FAQLAN_138." {TOPMENU_POSTER}<br />";
        }
        if ($top_show_date)
        {
            $top_returnval .= FAQLAN_139." {TOPMENU_DATE}<br />";
        }
        if ($top_show_category)
        {
            $top_returnval .= FAQLAN_140." {TOPMENU_CATEGORY}<br />";
        }
        $top_returnval .= "<br />";
        return $top_returnval;
    }
}
if (!function_exists("faq_ptemplate"))
{
    function faq_ptemplate($top_show_author, $top_show_date, $top_show_category,$top_show_info)
    {
        $top_returnval = "{TOPMENU_ITEM}<br />";
        if ($top_show_info)
        {
            $top_returnval .= "{TOPMENU_INFO}<br />";
        }
        if ($top_show_author)
        {
            $top_returnval .= FAQLAN_138." {TOPMENU_POSTER}<br />";
        }
        if ($top_show_date)
        {
            $top_returnval .= FAQLAN_139." {TOPMENU_DATE}<br />";
        }
        if ($top_show_category)
        {
            $top_returnval .= FAQLAN_140." {TOPMENU_CATEGORY}<br />";
        }
        $top_returnval .= "<br />";
        return $top_returnval;
    }
}

?>