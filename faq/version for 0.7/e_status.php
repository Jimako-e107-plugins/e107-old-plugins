<?php
include_lan(e_PLUGIN . "faq/languages/admin/" . e_LANGUAGE . ".php");
$faq_posts = $sql->db_Count("faq", "(*)");
if (empty($faq_posts))
{
    $faq_posts = 0;
}
$text .= "<div style='padding-bottom: 2px;'><img src='" . e_PLUGIN . "faq/images/icon_16.gif' style='width: 16px; height: 16px; vertical-align: bottom;border:0;' alt='' /> " . FAQ_ADLAN_93 . ": " . $faq_posts . "</div>";

?>