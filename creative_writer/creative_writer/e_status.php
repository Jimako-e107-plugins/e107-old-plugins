<?php
if (!defined('e107_INIT'))
{
    exit;
}

include_lan(e_PLUGIN . "creative_writer/languages/" . e_LANGUAGE . ".php");
$cwriter_posts = $sql->db_Count("cw_book", "(*)");
if (empty($cwriter_posts))
{
    $cwriter_posts = 0;
}
$text .= "<div style='padding-bottom: 2px;'><img src='" . e_PLUGIN . "creative_writer/images/cwriter_16.png' style='width: 16px; height: 16px; vertical-align: bottom;border:0;' alt='' /> " . CWRITER_A74 . ": " . $cwriter_posts . "</div>";

?>