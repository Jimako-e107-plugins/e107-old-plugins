<?php
if (!defined('e107_INIT')) { exit; }
if (e_LANGUAGE != "English" && file_exists(e_PLUGIN . "e_classifieds/languages/admin/" . e_LANGUAGE . ".php"))
{
    include_once(e_PLUGIN . "e_classifieds/languages/admin/" . e_LANGUAGE . ".php");
} 
else
{
    include_once(e_PLUGIN . "e_classifieds/languages/admin/English.php");
} 
$eclassf_posts = $sql->db_Count("eclassf_ads", "(*)");
if (empty($eclassf_posts))
{
    $eclassf_posts = 0;
} 
$text .= "<div style='padding-bottom: 2px;'><img src='" . e_PLUGIN . "e_classifieds/images/icon_16.png' style='width: 16px; height: 16px; vertical-align: bottom;border:0;' alt='' /> " . ECLASSF_A50 . ": " . $eclassf_posts . "</div>";

?>