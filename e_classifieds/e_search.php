<?php
if (!defined('e107_INIT')) { exit; }
if (e_LANGUAGE != "English" && file_exists(e_PLUGIN . "e_classifieds/languages/" . e_LANGUAGE . ".php"))
{
    include_once(e_PLUGIN . "e_classifieds/languages/" . e_LANGUAGE . ".php");
}
else
{
    include_once(e_PLUGIN . "e_classifieds/languages/English.php");
}
$myclass_title = ECLASSF_A52;
$search_info[]=array( 'sfile' => e_PLUGIN.'e_classifieds/search/search_parser.php', 'qtype' => $myclass_title, 'refpage' => 'classifieds.php');
?>