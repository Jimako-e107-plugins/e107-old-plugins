<?php
   require_once(e_PLUGIN."eplayer/eplayer_variables.php");

   $e_plug_table     = "eplayer";                                 //the name you have decided to use for the comments table comment type column
   $reply_location   = e_PLUGIN."eplayer/eplayer.php?view.{NID}"; //the location you'd like the user to return to after replying to a comment
   $db_table         = "eplayer";                                 //plugins database table
   $link_name        = "title";                                   //field in your plugin's db table that corresponds to it's name or title
   $db_id            = "id";                                      //field in your plugin's db table that correspond to it's unique id number
   $plugin_name      = EPLAYER_LAN_NAME;                          //used in links to comments, in list_new/new.php
?>