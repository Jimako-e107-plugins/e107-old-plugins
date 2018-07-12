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
$eclassf_approve = $sql->db_Count('eclassf_ads', '(*)', "WHERE eclassf_capproved='0'");
$text .= "<div style='padding-bottom: 2px;'>
<img src='" . e_PLUGIN . "e_classifieds/images/icon_16.png' style='width: 16px; height: 16px; vertical-align: bottom;border:0;' alt='' /> ";
if (empty($eclassf_approve))
{
    $eclassf_approve = 0;
} 
if ($eclassf_approve)
{
    $text .= "<a href='" . e_PLUGIN . "e_classifieds/admin_submit.php'>" . ECLASSF_A51 . ": " . $eclassf_approve . "</a>";
} 
else
{
    $text .= ECLASSF_A51 . ': ' . $eclassf_approve;
} 

$text .= '</div>';

?>