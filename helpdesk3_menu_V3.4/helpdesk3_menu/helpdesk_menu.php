<?php
if (!defined('e107_INIT'))
{
    exit;
}
if ($cacheData = $e107cache->retrieve("nq_helpdesk3_menu"))
{
    echo $cacheData;
    return;
}

global $helpdesk_obj;
if (!is_object($helpdesk_obj))
{
    require_once(e_PLUGIN . "helpdesk3_menu/includes/helpdesk_class.php");
    $helpdesk_obj = new helpdesk;
}
if ($helpdesk_obj->hdu_read)
{
$hurl=e_PLUGIN.'helpdesk3_menu/helpdesk.php';
    // Get the counts for each of the three display items, total, open, not assigned
    // $hdu_totcount = $sql->db_Count("hdunit", "(*)");
    // $hdu_opencount = $sql->db_Count("hdunit", "(*)", "where hdu_closed=0");
    // $hdu_notassigned = $sql->db_Count("hdunit", "(*)", "where hdu_allocated=0");
    $hdu_arg1 = "select
(select count(*)  from #hdunit ) as hdu_totcount,
(select count(*)  from #hdunit where hdu_closed=0) as hdu_opencount,
(select count(*)  from #hdunit where hdu_allocated=0) as hdu_notassigned";
    $sql->db_Select_gen($hdu_arg1, false);
    extract($sql->db_Fetch());
    $hdu_text = HDU_65 . " $hdu_totcount
<br />" . HDU_64 . " $hdu_opencount
<br />" . HDU_70 . " $hdu_notassigned
<br />";
    // $hdu_text .= HDU_103 . " <b>$hdu_assignedme</b>";
    if ($helpdesk_obj->hdu_poster)
    {
        $hdu_text .= "<br /><a href='$hurl?0.newticket.0'>" . HDU_68 . "</a>";
    }
    $hdu_text .= "<br />";
    if ($hdu_notassigned > 0 && $helpdesk_obj->hdu_super)
    {
        // if there are un assigned and we are the supervisor
        $hdu_text .= "<br /><a href='$hurl?0.assign.0'>" . HDU_251 . "</a>";
    }
    $hdu_text .= "<br />";
    ob_start(); // Set up a new output buffer
    $helpdesk_obj->tablerender($helpdesk_obj->hduprefs_menutitle, $hdu_text, 'hdu_menu'); // Render the menu
    $cache_data = ob_get_flush(); // Get the menu content, and display it
    $e107cache->set("nq_helpdesk3_menu", $cache_data); // Save to cache

}
