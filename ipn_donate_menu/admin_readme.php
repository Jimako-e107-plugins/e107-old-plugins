<?php
   // Remember that we must include class2.php
   require_once("../../class2.php");

   // Check current user is an admin, redirect to main site if not
   if (!getperms("P")) {
      header("location:".e_HTTP."index.php");
      exit;
   }

   // Include page header stuff for admin pages
   require_once(e_ADMIN."auth.php");

   // Our informative text
   $text = "<p><strong>AUTHORS</strong><br />
   - Klutsh added IPN stuff<br /><br />
   - Cameron using some code from Lolo Irie<br /><br />
   - Bazzer with fixes and enhancements<br /><br />
   - Richard with fixes and enhancements</p>
   <hr />
   <p><strong> SUPPORT</strong></p>
   <p> - For this version you can ask questions on the forum at <a href='http://www.x-projects.org'>http://www.x-projects.org</a></p>
   <hr />";

   // The usual, tell e107 what to include on the page
   $ns->tablerender("PayPal IPN Read Me", $text);

   require_once(e_ADMIN."footer.php");
?>
