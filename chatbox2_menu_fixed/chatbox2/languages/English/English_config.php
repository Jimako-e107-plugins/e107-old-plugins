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

define("CB2LAN_1", "Chat settings updated.");
define("CB2LAN_2", "Moderated.");
define("CB2LAN_3", "No Chat posts yet.");
define("CB2LAN_4", "Member");
define("CB2LAN_5", "Guest");
define("CB2LAN_6", "unblock");
define("CB2LAN_7", "block");
define("CB2LAN_8", "delete");
define("CB2LAN_9", "Moderate Chat");
define("CB2LAN_10", "Moderate Posts");
define("CB2LAN_11", "Chat posts to display");
define("CB2LAN_13", "Replace links");
define("CB2LAN_14", "if ticked, posted links will be replaced by text entered in box below");
define("CB2LAN_15", "Replace string if activated");
define("CB2LAN_16", "links will be replaced by this string");
//define("CB2LAN_17", "Wordwrap count");
//define("CB2LAN_18", "words longer than the number you set here will be wrapped");
define("CB2LAN_19", "Update Settings");
define("CB2LAN_20", "Chat Settings");
define("CB2LAN_21", "Prune");
define("CB2LAN_22", "Delete posts older than a certain time period");
define("CB2LAN_23", "Delete posts older than ");

define("CB2LAN_24", "One day");
define("CB2LAN_25", "One week");
define("CB2LAN_26", "One month");
define("CB2LAN_27", "- Delete all posts -");
define("CB2LAN_28", "Chat pruned.");

define("CB2LAN_31", "Show emoticons?");
define("CB2LAN_32", "Moderator userclass:");

define("CB2LAN_VL60", "Dynamic Viewer userclass:");

define("CB2LAN_VL42", "Allow Duplicate Posts?");
define("CB2LAN_VL50", "Time Until Duplicates Allowed:");
define("CB2LAN_VL51", "Seconds (300 = 5 min)");

define("CB2LAN_33", "User counts recalculated");
define("CB2LAN_34", "Recalculate user post counts:");
define("CB2LAN_35", "Recalculate");

define("CB2LAN_36", "Chat Display options");
define("CB2LAN_37", "Basic");
define("CB2LAN_38", "Basic with dynamic Updating (AJAX)");
define("CB2LAN_29", "Scrolling Chat area");
define("CB2LAN_VL1", "Scrolling with dynamic Updating (AJAX)");
define("CB2LAN_30", "Scrolling Layer height");

define("CB2LAN_VL4", "Refresh Rate (seconds)");
define("CB2LAN_VL5", "(added to the default 2 seconds)");
define("CB2LAN_VL70", "Submit Refresh (seconds)");
define("CB2LAN_VL71", "(added to the default 1 second)");

define("CB2LAN_VL6", "Custom Chat Colors");

define("CB2LAN_VL8", "Name Color");
define("CB2LAN_VL9", "Date/Time Color");
define("CB2LAN_VL10", "Message Color");

define("CB2LAN_VL20", "Chat Area Border Width");
define("CB2LAN_VL21", "Border Color");
define("CB2LAN_VL22", "Background Color");

define("CB2LAN_VL30", "Use Custom Settings Below?");
define("CB2LAN_VL32", "Match Following to Chatbox");
define("CB2LAN_VL33", "Select to copy Chatbox Colors");

define("CB2LAN_VL31", "Allow User Font Color Selection?");

define("CB2LAN_VLM1", "Chat Menu");

define("CB2LAN_VLB1", "General Settings");
define("CB2LAN_VLB2", "Chat Box Settings");
define("CB2LAN_VLB3", "Chat Page Settings");
define("CB2LAN_VLB4", "Information");

define("CB2LAN_VLB5", "Refresh Override - Timeout Set to FLOOD TIMEOUT");

define("CB2LAN_VL65", "Header Data (Optional):");

define("CB2LAN_VL75", "Allow Users/MOD to delete posts:");

define("CB2LAN_VL80", "Activate Sound?");
define("CB2LAN_VL82", "Path to Sound File:");
define("CB2LAN_VL90", "Volume Level (0-100):");
define("CB2LAN_VL91", "Does not work with all players.");

// ADMIN HELP FILES
define("CB2_LAN_HELP_TITLE", "Help and Info");

define("CB2_LAN_HELP_ADMIN_CHATBOX2", "
Refresh Rate (seconds): - Time for USERS Browser to look for changes (Default: 10 + 2 Seconds). If set too low, this could cause problems IF flood timeout is set too low. It could cause Members, and even ADMIN (YOU) to get banned in which you will have to access the database and clear the ban flag.  To avoid the problem, make sure the Chatbox does not update faster than the Flood Settings or disable Flood Protection to use.
<br /><br />
Submit Refresh (seconds): - Time for USERS Browser to look for changes after they SUBMIT a Post (Default: 8 + 1 Seconds). This could also cause issues, such as above. If this is set to a low value, it would make it look a lot faster on Submitting. (See NOTE_1 below for more details).
<br /><br />
Use Custom Settings Below? - Allows setting the Border and Colors of the Scrolling Chatbox if enabled.
<br /><br />
<br /><br />
NOTE_1: When a POST is submitted Dynamically, it goes through two stages. Submit, and Retrieve. IF the Submit is not finished before trying to Retrieve it, it will fail. Using the Submit Timer allows for checking at a time faster than the Normal Refresh Timer. It could be set to a low value, but watch for Issues with Banning if it postings happen too fast compared to the Flood Protect settings.
<br /><br />
<br /><br />
NOTE_2:  Set the `Wrap long words in menu text` to avoid stretching.
<br /><br />
<br /><br />
NOTE_3: Date Uses sttings in ADMIN-PREFERENCES Short date format.
<br /><br />
<br /><br />
");

define("CB2_LAN_HELP_ADMIN_CHATPAGE", "
Refresh Rate (seconds): - Time for USERS Browser to look for changes (Default: 10 + 2 Seconds). If set too low, this could cause problems IF flood timeout is set too low. It could cause Members, and even ADMIN (YOU) to get banned in which you will have to access the database and clear the ban flag.  To avoid the problem, make sure the Chatbox does not update faster than the Flood Settings or disable Flood Protection to use.
<br /><br />
Submit Refresh (seconds): - Time for USERS Browser to look for changes after they SUBMIT a Post (Default: 8 + 1 Seconds). This could also cause issues, such as above. If this is set to a low value, it would make it look a lot faster on Submitting. (See NOTE_1 below for more details).
<br /><br />
Use Custom Settings Below? - Allows setting the Border and Colors of the Scrolling Chatbox if enabled.
<br /><br />
Match Following to Chatbox: - Copies the Scrolling Chatbox color settings to the ChatPage.
<br /><br />
<br /><br />
To install the chatpage.php, you need to add a site link pointing to /e107_plugins/chatbox2/chatpage.php
<br /><br />
<br /><br />
NOTE_1: When a POST is submitted Dynamically, it goes through two stages. Submit, and Retrieve. IF the Submit is not finished before trying to Retrieve it, it will fail. Using the Submit Timer allows for checking at a time faster than the Normal Refresh Timer. It could be set to a low value, but watch for Issues with Banning if it postings happen too fast compared to the Flood Protect settings.
<br /><br />
<br /><br />
NOTE_2: It is recommended going into the Admin-Menu and selecting Chatbox2 visibility and set it so that the Chatbox is DISABLED on when chatpage.php is accessed.
<br /><br />
<br /><br />
NOTE_3:  Set the `Wrap long words in main text` to avoid stretching.
<br /><br />
<br /><br />
NOTE_4: Date Uses sttings in ADMIN-PREFERENCES Short date format.
<br /><br />
<br /><br />
");

// ADDED VERSION 1.4.4
define("CB2LAN_VL41", "Allow Consecutive Postings?");
define("CB2LAN_VL43", "Show User List on Top?");


// ADDED VERSION 1.5.0
define("CB2LAN_VL44", "Allow whitespace in Posts?");
define("CB2LAN_VL76", "Allow MOD to Mute Users?");
define("CB2LAN_VL63", "Mute userclass:");
//define("CB2LAN_VL35", "Enable Name colors by class?");
define("CB2LAN_GLD_B1", "Gold Settings");
define("CB2LAN_GLD1", "Enable Gold Integration:");
define("CB2LAN_GLD2", "Gold Name Height (default 10):");

define("CB2_LAN_HELP_ADMIN_GLD", "
Enable Gold Intergration to allow ORBs to affect names.
<br /><br />
Gold Name Height (Needed to override errors in gold system. Set high enough to show whole name, but not too high to cause large spacing. (Default:10)
<br /><br />
NOTE: The Point Value given for each chat are set in the Gold System plugin itself.
<br /><br />
<br /><br />
");

// CHANGED VERSION 1.5.0
define("CB2LAN_VL2", "Show Bullet?");
define("CB2LAN_VL3", "Show Date?");

define("CB2LAN_12", "Initial amount of posts displayed");
define("CB2LAN_VL61", "Posting userclass:");

define("CB2_LAN_HELP_ADMIN_GEN", "
Moderator userclass: - Self Explanatory (Default:PUBLIC)
<br /><br />
Dynamic Viewer userclass: - For JavaScript Updating (request/response) pages. Should be set to same USERCLASS as the one allowed to view chatbox itself.(Default:PUBLIC)
<br /><br />
Poster userclass: - Same as above. Should be set to same USERCLASS as the one allowed to Post to Chatbox (Default:MEMBERS).
<br /><br />
Mute userclass: - MUST BE CREATED. Users are set to this class when Muted (Blocked) from ChatBox II. This is done by pressing the RED BLOCK, not the Red X. (Default:Muted).
<br /><br />
Allow MOD to Mute Users? - Shows `RED BLOCK` image. Clicking this moves User to Muted CLASS.
<br /><br />
Allow Users/MOD to delete posts: - Shows `x`. Clicking this Deletes Post.
<br /><br />
Allow whitespace in Posts? - IF Set, Posts are NOT compresses and Tabs, New Lines, etc are allowed.
<br /><br />
Allow Consecutive Postings: - If NOT Set, a user (other than mods) can only post once and must wait for a response or another poster to post before they may post again.
<br /><br />
Allow Duplicate Posts: Set to enabled to not use Duplicate Timer.
<br /><br />
Time Until Duplicates Allowed: - Time between the same post being allowed.
<br /><br />
Path to Sound File: Leave blank and save settings to reset to default.
<br /><br />
Allow User Font Color Selection? - When set, the User will have a color box to click and change font color of posts.
<br /><br />
<br /><br />
NOTE: Some settings will not work if $CHATBOXSTYLE is defined properly in the THEME or elsewhere. Read the _readme.txt file for more info...
<br /><br />
<br /><br />
NOTE: Sound settings amd/or the Sound itself may not work in all browsers.
<br /><br />
<br /><br />
NOTE: Deleted posts Will show until users Refresh/Change their page.
<br /><br />
<br /><br />
");

?>