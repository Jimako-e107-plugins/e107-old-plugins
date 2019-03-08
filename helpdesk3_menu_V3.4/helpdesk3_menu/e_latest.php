<?php

include_lan(e_PLUGIN . "helpdesk3_menu/languages/admin/" . e_LANGUAGE . ".php");
include_lan(e_PLUGIN . "helpdesk3_menu/languages/" . e_LANGUAGE . ".php");

$sql->db_Select("hdu_prefs");
$hdu_row = $sql->db_Fetch();
extract($hdu_row);

$open_tickets = $sql->db_Count('hdunit', '(*)', "WHERE hdu_resolution='$hduprefs_defaultres' and hdu_closed=0");
if (empty($open_tickets))
{
    $open_tickets = 0;
}
$text .= "<div style='padding-bottom: 2px;'>
<img src='" . e_PLUGIN . "helpdesk3_menu/images/hdu_16.png' style='width: 16px; height: 16px; vertical-align: bottom' alt='' /> ";

$text .= HDU_197 . " " . $open_tickets;

$text .= '</div>';

?>