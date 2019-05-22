<?php

if (!defined('e107_INIT'))
{
    exit;
}
if (e_LANGUAGE != "English" && file_exists(e_PLUGIN . "phonedir/languages/admin/" . e_LANGUAGE . ".php"))
{
    include_once(e_PLUGIN . "phonedir/languages/admin/" . e_LANGUAGE . ".php");
}
else
{
    include_once(e_PLUGIN . "phonedir/languages/admin/English.php");
}
$pdir_posts = $sql->db_Count("pd_directory", "(*)");
if (empty($pdir_posts))
{
    $pdir_posts = 0;
}
$text .= "<div style='padding-bottom: 2px;'><img src='" . e_PLUGIN . "phonedir/images/pdir_16.png' style='width: 16px; height: 16px; vertical-align: bottom;border:0;' alt='' /> " . phonedir_ADLAN_126 . ": " . $pdir_posts . "</div>";

?>