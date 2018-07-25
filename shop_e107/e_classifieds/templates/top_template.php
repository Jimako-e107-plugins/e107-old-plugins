<?php
if (!function_exists("e_classifieds_mtemplate"))
{
    function e_classifieds_mtemplate($top_show_author, $top_show_date, $top_show_category,$top_show_info)
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
        if ($top_show_category)
        {
            $top_returnval .= "Category {TOPMENU_CATEGORY}<br />";
        }
        $top_returnval .= "<br />";
        return $top_returnval;
    }
}
if (!function_exists("e_classifieds_ptemplate"))
{
    function e_classifieds_ptemplate($top_show_author, $top_show_date, $top_show_category,$top_show_info)
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
        if ($top_show_category)
        {
            $top_returnval .= "Category {TOPMENU_CATEGORY}<br />";
        }
        $top_returnval .= "<br />";
        return $top_returnval;
    }
}

?>