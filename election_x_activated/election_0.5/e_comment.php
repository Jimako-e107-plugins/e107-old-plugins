<?php
/*
+---------------------------------------------------------------+
| Election by bugrain (www.bugrain.plus.com)
|
| A plugin for the e107 Website System (http://e107.org)
|
| Released under the terms and conditions of the
| GNU General Public License (http://gnu.org).
|
| $Source: e:\_repository\e107_plugins/election/e_comment.php,v $
| $Revision: 1.1 $
| $Date: 2006/12/31 16:01:19 $
| $Author: Neil $
+---------------------------------------------------------------+
*/
   // Load the language file
   if (file_exists(e_PLUGIN."election/languages/".e_LANGUAGE.".php")) {
      include_once(e_PLUGIN."election/languages/".e_LANGUAGE.".php");
   } else {
      include_once(e_PLUGIN."election/languages/English.php");
   }

   $e_plug_table     = "election";                                //the name you have decided to use for the comments table comment type column
   $reply_location   = e_PLUGIN."election/election.php?2.{NID}";  //the location you'd like the user to return to after replying to a comment
   $db_table         = "election_candidates";                     //plugins database table
   $link_name        = "election_candidate_name";                 //field in your plugin's db table that corresponds to it's name or title
   $db_id            = "election_candidate_id";                   //field in your plugin's db table that correspond to it's unique id number
   $plugin_name      = $pref["election_pagetitle"];               //used in links to comments, in list_new/new.php
?>