<?php
if (!defined('e107_INIT'))
{
    exit;
}
include_lan(e_PLUGIN . "creative_writer/languages/" . e_LANGUAGE . ".php");
$cwriter_approve = $sql->db_Count('cw_book', '(*)', "WHERE cw_book_approved='0'");
$text .= "<div style='padding-bottom: 2px;'>
<img src='" . e_PLUGIN . "creative_writer/images/cwriter_16.png' style='width: 16px; height: 16px; vertical-align: bottom;border:0;' alt='' /> ";
if (empty($cwriter_approve))
{
    $cwriter_approve = 0;
}
if ($cwriter_approve)
{
    $text .= "<a href='" . e_PLUGIN . "creative_writer/admin_submit.php'>" . CWRITER_A73 . ": " . $cwriter_approve . "</a>";
}
else
{
    $text .= CWRITER_A73 . ': ' . $cwriter_approve;
}

$text .= '</div>';

?>