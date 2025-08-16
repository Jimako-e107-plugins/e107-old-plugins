<?php
// * Newslinks Menu for e107 v7
// * newslink to be approved
include_lan(e_PLUGIN . "newslink/languages/" . e_LANGUAGE . ".php");
$newslink_approve = $sql->db_Count('newslink_newslink', '(*)', "WHERE newslink_approved='0'");
$text .= "<div style='padding-bottom: 2px;'>
<img src='" . e_PLUGIN . "newslink/images/newslink_16.png' style='width: 16px; height: 16px; vertical-align: bottom;border:0;' alt='' /> ";
if (empty($newslink_approve))
{
    $newslink_approve = 0;
}
if ($newslink_approve)
{
    $text .= "<a href='" . e_PLUGIN . "newslink/admin_submit.php'>" . NEWSLINK_A81 . ": " . $newslink_approve . "</a>";
}
else
{
    $text .= NEWSLINK_A81 . ': ' . $newslink_approve;
}

$text .= '</div>';

?>