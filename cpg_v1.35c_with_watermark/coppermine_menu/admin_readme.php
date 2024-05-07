<?php
require_once("../../class2.php");
if(!getperms("P")){ header("location:".e_HTTP."index.php"); exit; }
require_once(e_ADMIN."auth.php");

$pageid  = "readme";
$caption = "Readme File for Coppermine Gallery 1.3.5";


$text .= "
<br/>
  This is a modified version of the Coppermine Gallery (coppermine-gallery.net) for use
  with the e107 CMS system (e107.org).<br/><br/>

  This version allows all Coppermine functionality, embedded into an e107 website. It takes
  advantage of all e107 web formatting and e107 user data.<br/><br/>

  I have taken the main e107 config from the previous version Coppermine for e107 - v1.3.2b by MrPete and applied it to Coppermine Gallery 1.3.5.
   I have also ported the block config to the Plugin Manager for e107 v0.7+.<br/><br/>

<hr>
<u>Support</u><br/><br/>

  All support questions and bug reports for this version should be made on the e107coders.org bugtracker.
<br/><br/>
When posting a bug, please try to include the type of OS and the versions of PHP, MySQL and webserver the problem ocurred under. Also try to include what you did to arrive at the problem. 
<hr>
<u>Requirements</u><br/><br/>

  This plugin requires e107 Verion 0.7+<br/>
  PHP version 4.3 or higher<br/>
  GD1, GD2 or ImageMagick library properly installed and configured.<br/><br/>

<hr>
<u>Known Issues</u><br/><br/>
<ui>
<li>If you do not have the proper graphics library set in the Coppermine Config, you can upload images, but can not add them to the gallery.</li>
<li>Under PHP5, you MUST set 'register_long_arrays' to On in the php.ini</li>
</ui>


";

$ns->tablerender($caption,$text);

require_once(e_ADMIN."footer.php");
?>
