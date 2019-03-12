<?php
if (!defined('e107_INIT'))
{
    exit;
}
function print_item($id)
{
    global $sql, $tp, $helpdesk_obj, $hdu_shortcodes,
    $hdupostername, $hdu_datestamp, $hdu_category, $hdu_summary, $hdu_tagno, $hdu_email, $hdu_resolution, $hdures_resolution, $hdu_description,
    $hdu_tech, $hdu_allocated, $hdu_closed, $hdu_hours, $hdu_fixcost, $hdu_hrate, $hdu_hcost, $hdu_distance, $hdu_fixother,
    $hdu_drate, $hdu_dcost, $hdu_eqptcost, $hdu_callout, $hduc_date, $hduc_postername, $hduc_comment, $hdu_priority, $hdu_savemsg, $hdu_totalcost,
    $hdupostername;

    require_once(e_PLUGIN . "helpdesk3_menu/includes/helpdesk_class.php");
    require_once(e_PLUGIN . "helpdesk3_menu/includes/helpdesk_shortcodes.php");
    if (!is_object($helpdesk_obj))
    {
        $helpdesk_obj = new helpdesk;
    }
    if (!$helpdesk_obj->hdu_read)
    {
        exit();
    }
    $helpdesk_obj->hdu_print = true;
    if (file_exists(e_THEME . "helpdesk_print_template.php"))
    {
        define(HDU_TEMPLATE, e_THEME . "helpdesk_print_template.php");
    }
    else
    {
        define(HDU_TEMPLATE, e_PLUGIN . "helpdesk3_menu/templates/helpdesk_print_template.php");
    }
    if (!isset($gen))
    {
        $gen = new convert;
    }
    $hdu_arg = "
select * from #hdunit
		left join #hdu_categories on hdu_category=hducat_id
		left join #hdu_helpdesk on hducat_helpdesk=hdudesk_id
		left join #hdu_resolve on  hdu_resolution=hdures_id
		where hdu_id = $id";
    $sql->db_Select_gen($hdu_arg, false);
    extract($sql->db_Fetch());
    $hdu_temp = explode(".", $hdu_poster, 2);
    $hdupostername = $hdu_temp[1];

    require_once(HDU_TEMPLATE);
    $hdu_text .= $tp->parsetemplate($HDU_PRINTTICKET, false, $hdu_shortcodes);
    $sql->db_Select("hdu_comments", "*", "where hduc_ticketid=$id order by hduc_date", "nowhere", false);
    while ($hdu_comrow = $sql->db_Fetch())
    {
        extract($hdu_comrow);
        $hdu_temp = explode(".", $hduc_poster, 2);
        $hduc_postername = $hdu_temp[1];
        $hdu_text .= $tp->parsetemplate($HDU_PRINTTICKET_DETAIL, false, $hdu_shortcodes);
    } // while
    $hdu_text .= $tp->parsetemplate($HDU_PRINTTICKET_FOOTER, false, $hdu_shortcodes);
    return $hdu_text;
}

function email_item($id)
{
    global $tp, $sql;
    require_once(e_PLUGIN . "helpdesk3_menu/includes/helpdesk_class.php");
    if (!is_object($helpdesk_obj))
    {
        $helpdesk_obj = new helpdesk;
    }

    $hdu_arg = "select * from #hdunit
		left join #hdu_categories on hdu_category=hducat_id
		left join #hdu_helpdesk on hducat_helpdesk=hdudesk_id
		left join #hdu_resolve on  hdu_resolution=hdures_id
		where hdu_id = $id";
    $sql->db_Select_gen($hdu_arg, false);
    $row = $sql->db_Fetch();
    $hdu_message = HDU_235 . "<br /><br />" . HDU_238 . " <a href='" . SITEURL . e_PLUGIN . "helpdesk3_menu/helpdesk.php?0.show.$id'>" . HDU_239 . "</a><br /><br />";
    $hdu_message .= "<br /><br />" . HDU_236 . " <b>" . $tp->toHTML($row['hdu_summary']) . "</b> " . HDU_237 . " <b>$id</b><br />" ;
    return $hdu_message;
}

?>