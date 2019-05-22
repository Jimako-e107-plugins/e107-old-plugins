<?php
/*
+---------------------------------------------------------------+
| Bugtracker3 by bugrain (www.bugrain.plus.com)
|
| A plugin for the e107 Website System (http://e107.org)
|
| Released under the terms and conditions of the
| GNU General Public License (http://gnu.org).
|
| $Source: e:\_repository\e107_plugins/bugtracker3/e_comment.php,v $
| $Revision: 1.1.2.3 $
| $Date: 2006/11/23 13:27:00 $
| $Author: Neil $
+---------------------------------------------------------------+
*/
   // Load the language file
   if (file_exists(e_PLUGIN."bugtracker3/languages/".e_LANGUAGE.".php")) {
      include_once(e_PLUGIN."bugtracker3/languages/".e_LANGUAGE.".php");
   } else {
      include_once(e_PLUGIN."bugtracker3/languages/English.php");
   }

   $e_plug_table     = "bugtrack3";                                     //the name you have decided to use for the comments table comment type column
   $reply_location   = e_PLUGIN."bugtracker3/bugtracker3.php?2.{NID}";  //the location you'd like the user to return to after replying to a comment
   $db_table         = "bugtracker3_bugs";                              //plugins database table
   $link_name        = "bugtracker3_bugs_summary";                      //field in your plugin's db table that corresponds to it's name or title
   $db_id            = "bugtracker3_bugs_id";                           //field in your plugin's db table that correspond to it's unique id number
   $plugin_name      = $pref["bugtracker3_pagetitle"];                  //used in links to comments, in list_new/new.php
?>