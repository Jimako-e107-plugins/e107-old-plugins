<?php

if (!defined('e107_INIT')) { exit; }

if (file_exists(e_PLUGIN."userjournals_menu/languages/".e_LANGUAGE.".php")){
   include_once(e_PLUGIN."userjournals_menu/languages/".e_LANGUAGE.".php");
} else {
   include_once(e_PLUGIN."userjournals_menu/languages/English.php");
}

// $e_plug_table     = Comment type (max 10 character used to uniquely identify comments for this plugin)
// $reply_location   = Relative URL to go to when comment is clicked
// $db_table         = The name of your plugins database table.
// $link_name        = The field in your plugin's db table that corresponds to it's name or title.
// $db_id            = The name of the field in your plugin's db table that correspond to it's unique id number.
// $plugin_name      = A name for your plugin. It will be used in links to comments, in list_new/new.php.

$e_plug_table     = "userjourna";
$reply_location   = e_PLUGIN."userjournals_menu/userjournals.php?blog.{NID}";
$db_table         = "userjournals";
$link_name        = "userjournals_subject";
$db_id            = "userjournals_id";
$plugin_name      = UJ1;

?>