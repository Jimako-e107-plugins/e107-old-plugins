<?php
   // Remember that we must include class2.php
   require_once("../../class2.php");

   // Check current user is an admin, redirect to main site if not
   if (!getperms("P")) {
      header("location:".e_HTTP."index.php");
      exit;
   }
   
   include_lan(e_PLUGIN.'forumthanks/languages/'.e_LANGUAGE.'/lan_admin_thanks.php');

   // Include page header stuff for admin pages
   require_once(e_ADMIN."auth.php");

   $e_sub_cat = 'readme';
   

   // The usual, tell e107 what to include on the page
   $ns->tablerender(LAN_AT11, LAN_AT23);

   require_once(e_ADMIN."footer.php");
?>

