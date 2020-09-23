<?php

########################################
# IRDJ (e107) BY MARTINJ  | VERSION 1.2 | January 2008		#
# For e107 website system - e107.org | http://www.irdj.co.uk		#
# email martinleeds AT googlemail.com					#
########################################

$help=$_GET['id'];

if ($help==1)
	echo "<h3>Show Genre...</h3>If this box is ticked, the DJs genre, as set in the schedule, will be displayed on the main schedule page and the menu display.";
	
if ($help==2)
	echo "<h3>Disable Links</h3>If this box is ticked, it will disable all the links to the profile pages, the DJs name will be shown as normal. If left unticked, when a DJs name is shown it will automatically link to the DJs profile if one is avalible.";

if ($help==3)
	echo "<h3>Box in Schedule</h3>If this box is ticked, the schedule will be boxed inside a table on the main schedule page. If unticked, it will just show the schedule without a bordering box.";

if ($help==4)
	echo "<h3>Text for Schedule Page...</h3>Put your text here to display on the public schdule page. This could be anything you like to describe your website, recent changes etc. Feel free to use HTML as you wish.";

if ($help==5)
	echo "<h3>Intro Text</h3>This text will be shown on the DJ Profile Page next to the DJ photo (if set). Please enter a short introduction to the DJ and feel free to use HTML. A more detailed description can be entered in the Main Text part.";

if ($help==6)
	echo "<h3>Main Profile Text</h3>This text will be shown on the DJ Profile Page and should be the main detail of the DJ. Information here could be experience, equiptment used (e.g decks, cd), venues the DJ plays at, anything you feel! Feel free to use HTML to add extra images, links to other websites or text effects.";

if ($help==7)
	echo "<h3>Photo URL</h3>Enter the FULL path to an image here. A URL can be an image that has been uploaded to the site or from an external website. Please choose the image size carefully to prevent the page layout being broken";

if ($help==8)
	echo "<h3>Themes</h3>Each profile can use its own theme to determine how the profile is laid out. Themes are very basic and located in the /irdj/themes/ folder for editing.<br /><br />You can create more themes by using the same syntax as the other profiles, named theme_0, theme_1 and so on. To add more themes simply create a new file called theme_X.php (X being the number of the theme). You must follow the same sytax and layout of the current themes for them to work.";

if ($help==9)
	echo "<h3>Create Image</h3>This will create a basic random image using the DJ name. This uses GD so GD must be enabled for this to work. Ticking this box will override any link in the Photo box.";
?>