<?php
if (!defined('e107_INIT')) { exit; }

include_lan(e_PLUGIN."visitors_book/languages/".e_LANGUAGE."/admin.php");

$visitors_book_posts=$sql -> db_Count("visitors_book","(*)","WHERE checked='0'");
$text.="
<div style='padding-bottom: 2px;'>
	<img src='".e_PLUGIN_ABS."visitors_book/stuff/16.png' style='vertical-align: bottom' alt='' /> ".VIBO_LAN_28.": ".$visitors_book_posts."
</div>";
?>