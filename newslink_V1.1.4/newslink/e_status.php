<?php
include_lan(e_PLUGIN . "newslink/languages/" . e_LANGUAGE . ".php");
$newslink_posts = $sql->db_Count("newslink_newslink", "(*)");
if (empty($newslink_posts))
{
    $newslink_posts = 0;
}
$text .= "<div style='padding-bottom: 2px;'><img src='" . e_PLUGIN . "newslink/images/newslink_16.png' style='width: 16px; height: 16px; vertical-align: bottom;border:0;' alt='' /> " . NEWSLINK_A82 . ": " . $newslink_posts . "</div>";

?>