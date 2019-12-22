################################################################
#
#	CHATBOX II
#
#		Billy Smith
#		http://www.vitalogix.com
#		chicks_hate_me@hotmail.com
#
#	Designed for use with the e107 website system.
#		http://e107.org
#
#	Released under the terms and conditions of the GNU GPL.
#		GNU General Public License (http://gnu.org)
#
#	Leave Acknowledgements in ALL Distributions and derivatives.
#
################################################################
TODO

Fix orb showing 
Fix Bad Message
Fix Cache

==============================================
TOC
==============================================
* IMPORTANT
* TO DO
* Version History
* Fixes
* Hacks (Useful hacks)
* Changing Images
* Changing Sound

==============================================
IMPORTANT
==============================================
* Don't activate chatbox2_menu until installation done or so no one will post prematurely. 
* Be sure to make the Mute USERCLASS or you will get errors.
* Make sure you 

* For full functionality you should install as follows;
Install plugin
Read the ADMIN README in the CHATBOX II Plugin to complete installation. 
Install the Hacks
Make a 'Muted' USERCLASS
Check the theme for a $CHATBOXSTYLE and fix it as mentioned below or comment it out. 
Run the script to copy the Original chatbox chats to the NEW table BEFORE Allowing posting. 
Go to ADMIN and check all ChatBox II settings. 
Go to ADMIN-MENU and activate it. 

==============================================
TO DO (Future)
==============================================
eCaptcha - Not likely, This should just be class controlled. Chat should be fast to do for those allowed.

PhpFreeChat Intergration - Future maybe. Not very easy to do. 

Colored Names - Future, Other plugins are doing these things, waiting to be sure how to do it so it won't conflict with other authors Ideas.
Possibly, there would be a standard for this, using prefs. Something like a pref like 'admin_name_color' It would be easy to get or set.  One issue is the DB search to check all the classes each time risk/reward may be low. 

Marquee Option - Easy for NON-Dynamic, 

Intergrate more GOLD features. 

==============================================
VERSION HISTORY
==============================================
*********************************
CHANGES - Version 1.5.1
*********************************
Added GOLD Admin Page
Chat Display Name now modified by GOLD System
Disabled Cache, so site cache can be used (Failed and not really useful with Dynamic updating)
Fixed error when Empty post sent. 

*********************************
CHANGES - Version 1.5.0
*********************************
Added ability to Mute Chat Users (Must add a 'Muted' CLASS)
Option to Allow WhiteSpace 
Made Control "Initial Posts to Show" an INPUT value rather than a PULLDOWN
Closes EMOTES after Dynamic Submit
GOLD System Integration (add and subtract)

*********************************
CHANGES - Version 1.4.5
*********************************
Fixed ERROR: noerr Error (Some servers passed a space, added a trim function)
Fixed $CHATBOXSTYLE, Now wraps existing one (SEE BELOW FOR FIXES)
Fixed Speaker Image on dark Backgorund ugliness

*********************************
CHANGES - Version 1.4.4
*********************************
XHTML Compliance on chatpage and chatbox II
Disabled HTML less than(<) Tags for security
User list selectable on location on top or bottom
Option for whether users can post consecutively or once and wait
Made JS files easier to edit for Language changes (All Lang at top of file)
Added HACK documentation for class2.php to show user location properly
Added HACK doc. for files\shortcode\batch\user_shortcodes.php to show user post % correctly

*********************************
CHANGES - Version 1.4.2
*********************************
Added optional Header on ChatBox and Chat Page. 
Fixed Upload error (1.4.1 was directed to image, not zip)
Cleaned up some code. 

*********************************
CHANGES - Version 1.4.0
*********************************
ADDED Ability for Users/Mods to delete posts if enabled. 

*********************************
CHANGES - Version 1.3.2
*********************************
Removed code that put out Test output.
Other minor tweaks.

*********************************
CHANGES - Version 1.3.1
*********************************
Minor changes to chatpage.php (modify link posted twice in some configurations).

*********************************
CHANGES - Version 1.3.0
*********************************
Initial Release as Chatbox II
Added dynamic updating
Colorized messaging with jscolor - http://jscolor.com
Additional configuration
Chat Page tied to Chatbox

*********************************
FROM ORIGINAL CHATBOX
*********************************
Based on the original ChatBox
2006/11/20 - v1.12 - By mrpete
2007/01/28 - v1.21 - By e107steved
2008/01/04 -  Modified by Martin - Edit option added


==============================================
CHATBOXSTYLE
==============================================
************
FIX CURRENT
************
This fix lets the user/mod delete X to show, and fixes CHATBOXSTYLE use in general. 

To use all the functionality of the Chatbox II, you may need to modify the $CHATBOXSTYLE in the theme.php or elsewhere.  Or you can comment them out and use the default ones defined in chatbox2_menu.php.

If you want to keep the CHATBOXSTYLE you have defined in the them, you may need to at least replace the 'BUTTON' html.

Look for something similar to this;

<img src='".THEME_ABS."images/bullet1.gif' alt='' style='vertical-align: middle;' />

and replace it with the following

{BULLET} 

* you may want to add a space between the {BULLET} and the {USERNAME}


************
CUSTOM
************
You may want to use the example CHATBOXSTYLE below, and modify it. Use it to replace your existing one in the theme.php file (I recommend commenting out current one in case you want to go back)

OR, if your theme doesn't have one, add one of the examples below and edit as needed, OR look in the chatbox2_menu.php and use the CHATBOXSTYLE defined in there as a template. 

Here's some explaination. 
{BULLET} - Looks for theme/images/bullet2.gif unless the bullet is defined elsewhere. You might want to leave the current link rather than replace it with {BULLET} if you already have it pointing to your desired bullet image.  

{USERNAME} =  Username after it's been changed by gold or other formatting.

{GOLDBREAK} = Adds a <br /> if there's no orb for gold (hack fix, but works)

{TIMEDATE} = TIME DATE using the short format defined in ADMIN - PREFS - TIME DATE FORMATS

{CBCONTROL} - Adding this will show the DELETE post and the BLOCK (mute) User buttons. 

{MESSAGE} = The actual message, after it's been changed or formatted. 

Be sure the STYLE CLASS's used in the theme's tags exist in your theme CSS file. or in another CSS file that will be loaded.
Modify style as needed to override some things like text-aligm:left  etc....

************
EXAMPLE
************
(also look in chatbox2_menu.php or chatpage.php for examples)

$CHATBOXSTYLE = "
	<div style='text-align:center;' class='spacer'>
		{BULLET}
		{GOLDBREAK}
		<b>{USERNAME}</b>
		{GOLDBREAK}
		<span class='smallblacktext'>
			{TIMEDATE}{CBCONTROL}
		</span>
		<br />
		<span class='smalltext'>
			{MESSAGE}
		</span>
	</div>
	<hr>
";

************
EXAMPLE
************
Same, but wrapped in a table with border enabled.

$CHATBOXSTYLE = "
	<div style='text-align:center'>
	<table style='width:90%;border:1;'>
	<tr>
	<td class='alttd'>
		<div style='text-align:center;' class='spacer'>
			{BULLET}
			{GOLDBREAK}
			<b>{USERNAME}</b>
			{GOLDBREAK}
			<span class='smallblacktext'>
				{TIMEDATE}{CBCONTROL}
			</span>
			<br />
			<span class='smalltext'>
				{MESSAGE}
			</span>
		</div>
	</td>
	</tr>
	</table>
	</div>
";



==============================================
HACKS
==============================================

***********
Percentage
***********
The Percentage is calulated in a shortcode, because the original chatbox is so embedded in the core. 

A hack to fix this is (BUT it may make e107 core file integrity checks fail);

edit \files\shortcode\batch\user_shortcodes.php

1. Look for the line;

if (isset($pref['plug_installed']['chatbox_menu']))

and change it to;

// CHATBOX II PERCENTAGE HACK 
if (isset($pref['plug_installed']['chatbox2_menu']))

2. THEN Look for the line;

$chatposts = $sql->db_Count("chatbox");

change it to;

// CHATBOX II PERCENTAGE HACK 
$chatposts = $sql->db_Count("chatbox2");

3. Go into the Chatbox II and have it recalulate chatbox entries. 

That should resolve it. 

**********
**********

***************************
CORRECT USER LOCATION PAGES 
***************************
The online pages will show as chatbox2_control, or chatpage_control to everyone else because of pages dynamically updating and using class2.php for security. 

A hack to fix this (BUT it may make e107 core file integrity checks fail) is as follows;

Edit class2.php

1. Look for  the following lines; 

$page = (strpos(e_SELF, "forum_") !== FALSE) ? e_SELF.".".e_QUERY : e_SELF;
$page = (strpos(e_SELF, "comment") !== FALSE) ? e_SELF.".".e_QUERY : $page;
$page = (strpos(e_SELF, "content") !== FALSE) ? e_SELF.".".e_QUERY : $page;


2. Right after these lines, add the following. 

// CHATBOX II HACK - SHOWS CORRECT PAGE DURING UPDATES
global $user_pref; 
if ( (strpos($page, "chatbox2_control") !== FALSE) || (strpos($page, "chatpage_control") !== FALSE) ) {
	$page = $user_pref['cb2_current_page'];
}else{
	if(USER){
		$user_pref['cb2_current_page'] = $page;
		save_prefs('user');
	}
}
if($page == ""){
	$page = CB2_L41;
}			
// END HACK


==============================================
CHANGING IMAGES
==============================================
Images that are uses, such as the one for the speaker can be found in the sub-directory chatbox2_menu/images

If you change the image, just rename the old images to preserve them, then name the new images to the proper name. 

* soundon.png is the speaker icon.

* soundoff.png is the speaker icon showing it's disabled. 

* mute.png is an admin control icon for muting a chatbox user. 

* delete.png is the image shown in the chat that allows the poster, and mods to delete that one chat entry. 


You can use other forms of images, like jpeg, or gif's, but rename them to the extention .png to work with the current code.

==============================================
CHANGING SOUNDS
==============================================
If you have sounds enabled, the sound comes from the file newpost_sound.wav in the sound directory. 

TO change it;

rename newpost_sound.wav to newpost_sound1.wav

Add a new sound file, and name it newpost_sound.wav. 

There are also other examples of sound files to choose from in the sound folder. 



==============================================
END OF README
==============================================
















