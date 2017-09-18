<?php
if (file_exists(e_PLUGIN."eplayer/language/".e_LANGUAGE.".php")){
   require_once(e_PLUGIN."eplayer/language/".e_LANGUAGE.".php");
} else {
   require_once(e_PLUGIN."eplayer/language/English.php");
}
$numitems = $sql->db_Count("eplayer");
$toapprove = $sql->db_Count("eplayer", "(*)", "where approved<>'0'");
$text .= "<div style='padding-bottom: 2px;'>";
$text .= "<img src='".e_PLUGIN."eplayer/images/icon_16.png' style='width:16px;height:16px;vertical-align:bottom' /> ";
$text .= "<a href='".e_PLUGIN."eplayer/admin_media_local.php'>".EPLAYER_LAN_NAME."</a>: ".$numitems." ".EPLAYER_LAN_40." ($toapprove ".EPLAYER_LAN_50.")</div>";
?>