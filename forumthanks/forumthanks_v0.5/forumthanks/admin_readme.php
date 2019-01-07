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
   $text = "
   Thanks plugin created by <a href='http://www.jezza101.co.uk'>jezza101</a><p>
   Please contact me via my forum for feature requests, bug reports, feedback, glowing praise, etc.
   <p>
   Keep up to date on e107 and related news and <b>be the first</b> to know when my <b>new releases</b> are available:
   <p><a href='http://feeds.feedburner.com/Jezza101'>Subscribe to my RSS News feed now!</a>
   <p>
   <b>Preferences</b>
   <p>
   All preference are marked on by default, but you can switch features off if required, eg if they
   mess with your theme or use too much extra resource
   <p>
   Replace Forum Post Count, this adds in a thanks count and a count of all posts that have received thanks.  This usese the {THANKSPOSTS} shortcode.
   <p>
   Show thanks stats will include stats and links for thanks given and received on the user.php page
   <p>
   Show thanks list includes a list of all users that have thanked a post.  This includes the {THANKEDBY} shortcode in the template.
   <p>
   Show thank stat link on forum.php places a few links to the various stats page next to the normal 'top poster' etc links.
   This will only work on the standard theme template at present.  Let me know if this doesnt work and I will try to improve compatability.
   <p>
   Thanks limit per day is the max number of thanks a user can give.  This is so that \"thanks\" become more valuable.  Set this to 0 
   to turn off the limit.
   <p>
   Moderation menu option allows you to remove all the thanks for a particular user.  Use this carefully as this cannot be undone via the plugin.
   Take regular backups.
   <p>
   If you want only the thread starter to be able to recieve thanks then tick the preference in config.   This means only the top post can be thanked.
   <p>
   An icon can be used in place of the standard link, you will probably need to design your own button as im no graphics artist!
   <p>
   <p>
   <b>Thank Stats</b>
   <p>
   A menu is included to link to the top thankers, thanked posts, etc.  These links are also inserted into the forum.php end info region.
   If you wish to link to these pages elsewhere, look at the menu to see what links are required.
   <p>
   <b>Please Respect the author</b><p>
   Please link to me if you use this Plugin!<p>
   www.jezza101.co.uk
   ";

   // The usual, tell e107 what to include on the page
   $ns->tablerender("MyPlugin Read Me", $text);

   require_once(e_ADMIN."footer.php");
?>

