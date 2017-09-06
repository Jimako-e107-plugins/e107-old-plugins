<?php
   // Load the language file
   if (file_exists(e_PLUGIN."bugtracker2/languages/".e_LANGUAGE.".php")) {
      include_once(e_PLUGIN."bugtracker2/languages/".e_LANGUAGE.".php");
   } else {
      include_once(e_PLUGIN."bugtracker2/languages/English.php");
   }

   global $pref;
   //the name you have decided to use for the comments table comment type column
   $e_plug_table     = "agenda";
   //the location you'd like the user to return to after replying to a comment
   $reply_location   = e_PLUGIN."agenda/agenda.php?viewitem.".$pref["agenda_default_view"].".{NID}";
   //plugins database table
   $db_table         = "agenda";
   //field in your plugin's db table that corresponds to it's name or title
   $link_name        = "agn_title";
   //field in your plugin's db table that correspond to it's unique id number
   $db_id            = "agn_id";
   //used in links to comments, in list_new/new.php
   $plugin_name      = $pref["agenda_page_title"];
?>