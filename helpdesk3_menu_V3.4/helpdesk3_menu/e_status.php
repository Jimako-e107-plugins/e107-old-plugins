<?php

include_lan(e_PLUGIN . "helpdesk3_menu/languages/admin/" . e_LANGUAGE . ".php");
include_lan(e_PLUGIN . "helpdesk3_menu/languages/" . e_LANGUAGE . ".php");

$total_tickets = $sql->db_Count('hdunit', '(*)');
if (empty($total_tickets))
{
    $total_tickets = 0;
}
$text .= "<div style='padding-bottom: 2px;'>
<img src='" . e_PLUGIN . "helpdesk3_menu/images/hdu_16.png' style='width: 16px; height: 16px; vertical-align: bottom' alt='' /> ";

$text .= HDU_198 . " " . $total_tickets;

$text .= '</div>';

?>