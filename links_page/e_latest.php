<?php
if (!defined('e107_INIT')) { exit; }

$submitted_links = $sql->db_Select("tmp", "*", "tmp_ip='submitted_link' ");
$text .= "<div style='padding-bottom: 2px;'><img src='".e_PLUGIN_ABS."links_page/images/linkspage_16.png' style='width: 16px; height: 16px; vertical-align: bottom' alt='' />".($submitted_links ? " <a href='".e_PLUGIN_ABS."links_page/admin_linkspage_config.php?sn'>".ADLAN_LAT_5.": $submitted_links</a>" : " ".ADLAN_LAT_5.": ".$submitted_links)."</div>";
?>