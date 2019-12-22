<?php
if (!defined('e107_INIT')) { exit; }

$chatbox2_posts = $sql -> db_Count("chatbox2");
$text .= "<div style='padding-bottom: 2px;'><img src='".e_PLUGIN."chatbox2_menu/images/chatbox2_16.png' style='width: 16px; height: 16px; vertical-align: bottom' alt='' /> ".ADLAN_115.": ".$chatbox2_posts."</div>";
?>