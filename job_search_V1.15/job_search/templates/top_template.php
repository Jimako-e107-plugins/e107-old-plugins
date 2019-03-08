<?php
if (!defined('e107_INIT'))
{
    exit;
}
if (!function_exists("jobsearch_mtemplate"))
{
    function jobsearch_mtemplate($top_show_author, $top_show_date, $top_show_category,$top_show_info)
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
if (!function_exists("jobsearch_ptemplate"))
{
    function jobsearch_ptemplate($top_show_author, $top_show_date, $top_show_category,$top_show_info)
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