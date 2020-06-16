<?php

// Config Page
define("LAN_AT1","Replace forum post count");
define("LAN_AT2","Show thanks stats in user.php<br>(test this doesnt break theme)");
define("LAN_AT3","allow Users to remove thanks");
define("LAN_AT4","Insert stat links shortcode into forum.php page");
define("LAN_AT5","Thank Button");
define("LAN_AT6","Loading Icon");
define("LAN_AT7","Only thread starter may be thanked");
define("LAN_AT8","Max thanks allowed per day");
define("LAN_AT9","Save Setting");
define("LAN_AT10","Settings Saved!");
define("LAN_AT31","Show Thank Date");

// Menu
define("LAN_AT11","Read Me");
define("LAN_AT12","Preferences");
define("LAN_AT13","File Manager");
define("LAN_AT14","Moderate Thanks");

//Moderate
define("LAN_AT15","Enter User name to search for:");
define("LAN_AT16","Users Found:");
define("LAN_AT17","Delete all thanks for user?  This cannot be undone. Take regular database backups.");
define("LAN_AT18","User");
define("LAN_AT19","has been thanked");
define("LAN_AT20","time(s)");
define("LAN_AT21","Yes");
define("LAN_AT22","No");

// read me
$readme_thank = "Ajax Thanks plugin created by <b>Milad Pazouki</b> Based on <a href='http://www.jezza101.co.uk'>jezza101</a> Thanks Plugin<p>
   Please contact me via my <a href='mailto:sonixax@yahoo.com'>Email</a> for feature requests, bug reports, feedback, glowing praise, etc.
   <p>
   Keep up to date on e107 and related news and <b>be the first</b> to know when my <b>new releases</b> are available:
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
   ";

define("LAN_AT23",$readme_thank);

// Plugin.php

define("LAN_AT24","Ajax Thanks Plugin");
define("LAN_AT25","Milad Pazouki");
define("LAN_AT26","0.6");
define("LAN_AT27","Ajax Thanks Plugin for E107 Forum system");
define("LAN_AT28","Configure Forum Thanks");
define("LAN_AT29","Installation Successful...");
define("LAN_AT30","Upgrade successful...");



?>