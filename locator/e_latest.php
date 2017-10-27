<?php
if (!defined('e107_INIT')) { exit; }

// Get language file (assume that the English language file is always present)
$lan_file = e_PLUGIN."locator/languages/".e_LANGUAGE.".php";
include_lan($lan_file);

$submitted_locations = $sql->db_Count('locator_sub_sites', '(*)', "WHERE locator_sub_verified IS NULL");
$text .= "<div style='padding-bottom: 2px;'>
<img src='".e_PLUGIN."locator/images/logo_16.png' style='width: 16px; height: 16px; vertical-align: bottom' alt='' /> ";

if ($submitted_locations) {
	$text .= "<a href='".e_PLUGIN."locator/admin_locations.php?approve'>".LOCATOR_LATEST_01.": ".$submitted_locations."</a>";
} else {
	$text .= LOCATOR_LATEST_01.": ".$submitted_locations;
}

$text .= '</div>';
?>