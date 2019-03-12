<?php

require_once("../../class2.php");
// If not a valid call to the script then leave it
if (!defined('e107_INIT'))
{
    exit;
}
// require_once(e_HANDLER . "userclass_class.php");
if (e_LANGUAGE != "English" && file_exists(e_PLUGIN . "creative_writer/languages/" . e_LANGUAGE . ".php"))
{
    include_once(e_PLUGIN . "creative_writer/languages/" . e_LANGUAGE . ".php");
}
else
{
    include_once(e_PLUGIN . "creative_writer/languages/English.php");
}
// define the over ride meta tags
// define("PAGE_NAME", ECLASSF_1);
// check if we use the wysiwyg for text areas
$e_wysiwyg = "cwriter_cdetails";
if ($pref['wysiwyg'])
{
    $WYSIWYG = true;
}



?>