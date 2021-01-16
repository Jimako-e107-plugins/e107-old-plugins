<?php
e107::lan('eversion',true);

/*if (e_LANGUAGE != "English" && file_exists(e_PLUGIN_ABS . "eversion/languages/" . e_LANGUAGE . "_admin.php"))	
{
//	include_once(e_PLUGIN_ABS . "eversion/languages/" . e_LANGUAGE . "_admin.php");
} 
else
{
//	include_once(e_PLUGIN_ABS . "eversion/languages/English_admin.php");
} */
$evrsn_posts = $sql->db_Count("eversion", "(*)");
if (empty($evrsn_posts))
{
    $evrsn_posts = 0;
} 
$text .= "<div style='padding-bottom: 2px;'><img src='" . e_PLUGIN_ABS . "eversion/images/icon_16.gif' style='width: 16px; height: 16px; vertical-align: bottom;border:0;' alt='' /> " . EVERSION_A57 . ": " . $evrsn_posts . "</div>";

?>