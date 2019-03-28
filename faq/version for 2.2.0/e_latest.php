<?php
if (!defined('e107_INIT')) { exit; }
require_once("includes/faq_class.php");
if (!is_object($faq_obj)) {
	$faq_obj=new FAQ;
}
$faq_approve = $sql->db_Count('faq', '(*)', "WHERE faq_approved='0'");
$text .= "<div style='padding-bottom: 2px;'>
<img src='" . e_PLUGIN . "faq/images/icon_16.gif' style='width: 16px; height: 16px; vertical-align: bottom;border:0;' alt='' /> ";
if (empty($faq_approve))
{
    $faq_approve = 0;
}
if ($faq_approve)
{
    $text .= "<a href='" . e_PLUGIN . "faq/admin_approve.php'>" . FAQ_ADLAN_94 . ": " . $faq_approve . "</a>";
}
else
{
    $text .= FAQ_ADLAN_94 . ': ' . $faq_approve;
}

$text .= '</div>';

?>