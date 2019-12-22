<?php
/*
################################################################
#
#	CHATBOX II
#
#		Copyright - Billy Smith
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
*/

require_once("../../class2.php");

if(!getperms("P")) { header("location:".e_BASE."index.php"); exit; }

if (file_exists(e_PLUGIN."chatbox2/languages/".e_LANGUAGE."/".e_LANGUAGE."_config.php")) {
	include_once(e_PLUGIN."chatbox2/languages/".e_LANGUAGE."/".e_LANGUAGE."_config.php");
} else {
	include_once(e_PLUGIN."chatbox2/languages/English/English_config.php");
}

require_once(e_ADMIN."auth.php");
require_once(e_HANDLER."userclass_class.php");

$pageid = "admin_readme";
$text= "
************
<br />
WARNING
<br />
************
<br />
WARNING - Be sure to ADD a 'Muted' CLASS, (Your choice of name) and then set it in CHATBOX ADMIN - GENERAL SETTINGS or you will receive error messages.
<br />
<br />
WARNING - Enabling the ChatBox II menu BEFORE running the copy script would allow posts, and cause the copy to fail.
<br />
<br />
WARNING - Setting the values for REFRESH RATE or FLOOD CONTROL too low could cause users and YOU (ADMIN) to get Banned. You would end up seeing a white page. You will then need to go into the database and clear out the ban on ADMIN in the USER TABLE.
<br />
<br />
************
<br />
_README.TXT
<br />
************
<br />
READ the _readme.txt file BEFORE installation;
<br />
<br />
It contains helpful installation instructions.
<br />
<br />
Details on HACKS to enable additional functionality such as;
<br />
 1. Correct percentage in User Profile
<br />
 2. Correct pages users are on.
<br />
 3. Correct problems with CHATBOXSTYLE's defined in themes and elsewhere.
<br />
<br />
Other useful information
<br />
<br />
************
<br />
INFORMATION
<br />
************
<br />
To copy old ChatBox messages over to ChatBox II, Load the following page.
<br /><br />
[plugins_folder]/chatbox2/admin_copy_cbt.php
<br /><br />
This should be done AFTER Installation but BEFORE any messages are put into ChatBox II.
<br />
<br />
<br />
************
<br />
UPGRADING
<br />
************
<br />
Backup existing version (in case you want to revert back)
<br />
Copy files over existing chatbox2 files.
<br />
Go to each page in PLUGIN ADMIN -  CHATBOX II and review each control field, then update settings.
<br />
<br />
<br />
************
<br />
INSTALLATION
<br />
************
<br />
==============================================
<br />
IMPORTANT
<br />
==============================================
<br />
For full functionality you should install as follows;
<br />
<br />
* Don't activate menu until all else is completed so no one will post prematurely.
<br />
1) Upload the chatbox2 folder to your 'e107_plugins/' directory.
<br />
2) Install the Chatbox2 Plugin.
<br />
3) Install the Hacks mentioned in the _readme.txt file
<br />
4) Check theme for CHATBOXSTYLE and make changes as mentioned in the _readme.txt file or comment it out.
<br />
5) Go to ADMIN-USERCLASSES and create a Muted class Called something like 'Muted'.
<br />
6) Click CONFIGURE or go to ADMIN. Configure and save each page.
<br />
7) Run the script to copy the Original chatbox chats to the NEW table BEFORE Allowing posting.
<br />
8) Go to ADMIN-MENU and enable chatbox2
<br />
<br />
There is also a chatpage.php page that could be installed in ADMIN-SITE LINKS, BUT the phpFreeChat has many more features.
<br />
<br />
To install the chatpage.php, you need to add a site link to /e107_plugins/chatbox2/chatpage.php
<br />
<br />
It is recommended to go into ADMIN>MENU and select the chatbox2 and edit it's visibility.  Set it so that it becomes hidden when chatpage.php is selected.
<br />
<br />
<br />
************
<br />
NOTES
<br />
************
<br />
1) The number that appears next to 'View All Posts' or 'Moderate' represents the number of posts NOT Visible.
<br />
Total posts - Visible Posts =  the # value shown.
<br />
It is NOT the TOTAL Posts.
<br />
<br />
<br />
************
<br />
SUPPORT
<br />
************
<br />
Look for support in the <a href='http://www.e107.org' target='e107page'>e107.org</a> forums under Chatbox II.
<br />
<br />
************
<br />
DONATE
<br />
************
<br />
If you like this, consider a donation so I am able to put more time into what I like, creating or updating plugins for e107.
<br />
<form action='https://www.paypal.com/cgi-bin/webscr' method='post'>
<input type='hidden' name='cmd' value='_s-xclick'>
<input type='image' src='https://www.paypal.com/en_US/i/btn/btn_donate_SM.gif' border='0' name='submit' alt='PayPal - The safer, easier way to pay online!'>
<img alt='' border='0' src='https://www.paypal.com/en_US/i/scr/pixel.gif' width='1' height='1'>
<input type='hidden' name='encrypted' value='-----BEGIN PKCS7-----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-----END PKCS7-----'>
</form>
<br />
<br />
<br />
<br />
Consider Donating to e107. Click below or go to <a href='http://www.e107.org' target='e107page'>e107.org</a>.
<br />
<form action='https://www.paypal.com/cgi-bin/webscr' method='post'>
<div>
<input type='hidden' name='cmd' value='_s-xclick' />
<input type='image' src='https://www.paypal.com/en_US/i/btn/btn_donate_LG.gif' style='border:0' name='submit' alt='Please click here to make a donation to the e107 project - thank you' />
<input type='hidden' name='encrypted' value='-----BEGIN PKCS7-----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-----END PKCS7-----' />
</div>
</form>
<br />
<br />
<br />
<center><a href=\"javascript:history.back();\">Back</a></center>
<br />
<br />
<br />
";

$ns -> tablerender(CB2LAN_VLB4, $text);
require_once(e_ADMIN."footer.php");
?>
