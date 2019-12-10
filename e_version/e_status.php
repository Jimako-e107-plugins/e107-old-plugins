<?php
if (e_LANGUAGE != "English" && file_exists(e_PLUGIN . "e_version/languages/admin/" . e_LANGUAGE . ".php"))
{
    include_once(e_PLUGIN . "e_version/languages/admin/" . e_LANGUAGE . ".php");
} 
else
{
    include_once(e_PLUGIN . "e_version/languages/admin/English.php");
} 
$evrsn_posts = $sql->db_Count("eversion", "(*)");
if (empty($evrsn_posts))
{
    $evrsn_posts = 0;
} 
$text .= "<div style='padding-bottom: 2px;'><img src='" . e_PLUGIN . "e_version/images/icon_16.gif' style='width: 16px; height: 16px; vertical-align: bottom;border:0;' alt='' /> " . EVERSION_A57 . ": " . $evrsn_posts . "</div>";

?>