<?php
   if (file_exists(e_PLUGIN."userjournals_menu/userjournals_class.php")) {
      include(e_PLUGIN."userjournals_menu/userjournals_class.php");
   } else {
      print "Fatal error, cannot find UserJournals class";
   }

   // If UJ not active don't display anything at all
   if($pref["userjournals_active"] == "1"){
      $GLOBALS['userJournals']->GetWriterMenu($ns);
   }
?>
