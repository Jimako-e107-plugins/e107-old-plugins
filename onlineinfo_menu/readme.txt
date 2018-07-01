Note:- I have only included the English files as the other ones are too out of date, just copy the english one rename it to your language and change.

Please make sure that you go into the Config once installed and save every page.
Also check the Check List to see it you need to setup other info or plugins.

Remember, you don't need to run everything, just set parts to user class : noone to turn off.


This Plugin has been Tested on IE7, Firefox 3, Netscape Navigator, Opera, Safari.
Tested on php 4.4.8 and 5.2.5, MySQL 4.1.22- standard.
Older versions of MySQL (less than 4.0) may not install the tables into the database, if this happens manually add them by getting there structures out of the plugin.php file 
The Cached data may not show to start with until the cached time has passed, set cache to 0 then go out of admin for it to catch the data and then reset the time of the cached info 


Some of the Java Code comes from: Dynamic Drive : http://www.dynamicdrive.com

¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬

INSTALL NOTE: 
===============
*** ******************** ******************** *
Install via FTP not by e107 plugin uploader
*********** ******************** *************

ON NEW INSTALLS:
Please make sure that you save your settings after installing,


ON UPGRADE (Only Upgrade from 7.50, if you are on an earlier version you need to uninstall and reinstall):

There have been loads of changes...
Run Upgrade from Plugin Manager.
Check and set all your settings in its admin sections as they have changed.
Check that it all looks the way you want it and come out of maintenance mode.


For Support, please post on my forum: [link] or post on the Bug Tracker: [link]


¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬ ¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬ ¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬ ¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬ ¬¬¬¬¬


===========
  8.5.1
===========

Fixed - Missing Comments for krooze Arcade on New page


===========
  8.5.0
===========
ADDED - 'Chatbox II' Intergration. 
ADDED - Updates checker (new Version numbering.) 
ADDED - 'Coppermine Photo Gallery' Intergration. 
ADDED - User Class colours. 
ADDED - 'Jokes Menu' Intergration. 
ADDED - 'UserJournals' Intergration. 
ADDED - 'Suggestions Menu' Intergration. 
ADDED - Comments on whats new can be turned on/off. 
ADDED - Users Avatar can now be turned off just to show settings menu. 
ADDED - Default user classes (Head admin, Admin, etc) can now be turned on or off. 
CHANGED - Moved all Fuctions to own php file to shorten coding. 
CHANGED - Admin's & User Class colours now used on the whole Plugin. 
FIXED - Remove Table render around Admin Section. 
FIXED - PM heading now same class as others when not set to hide. 
FIXED - Some small bugs in code. 



===========
8.04
===========
FIXED - Possible issue in the admin section found by Nowwhat@ my forum
ADDED - Head Admin shows separate to normal admins on 'Members on today' and summary 'currently online' wanted by His MAJESTY @ my fourm.
ADDED - Extra Bots

===========
8.02
===========

FI XED - Reported issue with some old plugin confliction with reading system preferences.
FIXED - Flash chat showing users in rooms issue
===========
8.01
===========

FIXED - Lastest changes always showing zero when hidden.
FIXED - Error in sql code in plugin.php which stopped new installs.
ADDED - German Language files.


===========
8.00
===========
NEW - 'Krooze Arcade' Plugin Intergration (New Games and Top Score). 
NEW - 'You Tube' Plugin Intergration. 
NEW - 'Delete Me' Plugin Intergration. 
NEW - PM New Message Sound. 
NEW - 'Members on today' section. 
NEW - 'Whats New' posts / info now can be Marked as read. 
NEW - Forum Posts in what's New can be set to show every post or to Summarize them by Thread. 
NEW - Key Colours for Admin, moderator, member now has a colour picker. 
NEW - 'Flash if new' now uses a colour selector. 
NEW - 'Login Dialog Box' can now be turned off for Themes that have it built in. 
NEW - 'Pop up user info' now has a colour picker. 
NEW - More 'Latest Changes' can be turned off (News, Chatbox, etc.) 
NEW - Todays Birthdays have Avatar on/off option 
NEW - Gallery 2 Comments now added to 'what's new' comments 
NEW - Simple Machine Forum Intergrated 
NEW - 'Bugtracker3' Intergration 
NEW - What's New List on Menu can now hide if the item has no new posts. 
Changed - Check List Moved to this Help Menu. 
Fixed - Some bugs going back from 7.50 like poll comments and birthday ages.



=========== 
7.50
===========
NEW - Now have a Cache System to allow stats like Forum post to be counted once every so often other that recounting them every time.
NEW - Admin IP Checker can now be turned off.
NEW - Bot Checker can now be turned off.
NEW - Now has partial Intergration with Gallery 2 (What's new and linkage, No user intergration).
Fixed - Few small bugs found.
Fixed - General Speed improved overall.
Changed - Ordering components now improved to stop components being selected more that once.
Changed - Who's online now has the option to not show where they are but just show who is on.
Changed - Check List moved to Admin Menu.



7.20
NEW - Suspend Account system, Unlike the Banning option in e107 that stops the banned user from seeing the site. This allows them to view the site but will not allow them to login (with auto Logout if already online) or create a new Account stopping them using members only info. (Can only stop them set up a new account if IP is same).
NEW - New Menu system, The hide option has now been added to all parts of the plugin, if you wish you can hide everything down to the headings.
NEW - Menu system can be set to remember which part the user has opened / hidden so that when they click to another page it does not close what they have opend on the menu.
NEW - Large Flashing Private message notice, This is like the PM alert from Greycube.com. This is better for Users to stop that they have a PM if there Browser does not allow your site to Popup the pm message.
NEW - Flashing What's New messages with option to set the colour to flash.
Added - Section Headings Font size can now be set to the size you wish.
Added - Members Names in Who is online can now be set to the size you wish.
Added - 'Buddy List' now shows who's list you are on.
Added - Chatbox & Forum 'whats changed' can now be removed off list.
Fixed - Missing Comments on Whats New for 'Contents Manager' & 'Link Pages'.
Fixed - Issue which Avatars with space in there name not showing on the Over Avatar information.
Fixed - Issue sometimes a User would show twice in Who's Online info.
Changed - Renamed 'friends list' to 'Buddy list' also Database table renamed on upgrades.
Changed - Whats Installed checks now check for the Plugins path not its name that was causing the system to think that they where not installed or running.

7.13
Fixed - Issue with PM, Log Stats & List New installed checker on New installs

7.12
Fixed - Issue with PM, Log Stats & List New installed checker with Multi- Langugues
Fixed - Issue when Members where hiding and still showed one.

7.11
Added - 'Resend Activation Email' added to login menu.
Removed - Standard / Cam menu option.
Added - Can now select which ones to hide (Members & Guests) on Who's online (replaces Standard / Cam Option).
Changed - Reduced the font size on Who's Online to fit better.
Added - Guest icons on Who's Online for Admins now show the Host lookup for the IP listed.
Updated - More information on the mini Profile popup.
Updated - Add loads more Web Robots
Added - Flash Chat's own Admin is now included in Online Info admin.


7.10
Added - Flash Chat Intergration
Moved - Invision Power Board admin to own page

7.09
Added - Currently Online now shows the forum / thread someones on
Added - Intergration for Invision Power Board Forums & Private Messaging as requested by Psycke (Note: on the PM system, the Login names for e107 and IPB need to be the same to work)
Fixed - issue where top forum starter settings could not be saved
Fixed - issue with Coppermine comments not showing
Added - 'Resend Activation Email' add to Language files for e107 CVS v0.7.6


7.08
Fixed - logout Issue
Fixed - Forum Links on What's New Page now take you to the post when theres more that one page
Fixed - Coppermine image and comments link fixed
Fixed - FAQ comments now fixed on What's New
Added - Top Rated Members added
Added - You can now select to use the Built in Whats New Page or the List Plugin.
Added - Admin Section now has some Intelligence - Has a check list built in for items needed. It will not allow you to use sections that are missing other data or plugins.
Added - Friends list added (request & Original code from schlrech)
Added - Site Links now added to what's new
Changed - Admin Order pages now will not let you have the same section twice.
Changed - Coppermine comments integrated into standard comments on what's new and latest changes
Changed - Configure admin now split into menus.
Changed - Registered user Count now can be set to be seen by other userclass to the Latest Changes
Changed - if Currently online toolbar turned off, the user name now links to their profile
Changed - What's new page now shows the emotes
Changed - What's New page now can show as many records per section as you want via Admin section


7.07 - Beta Testing

7.06
Fixed - issue with Coppermine images with no title (thanks to Andrey for code)
Added - Coppermine image comments to new page (thanks to Andrey for code)
Fixed - issue when used on right menu
Added - French Translation (thanks Tristanya to for this)
Fixed - Layout issue with the Counter (Thanks to schlrech for helping on this and the complete German Translation)
Fixed - Sorted User profile comments on whats new page
New - Now has complete Russian Translation (Thanks to Andrey for this).
Changed - Changed config.php to admin_config.php to standardise

also thanks to schlrech for spotting some coding errors and German Translations

Note:- Spanish & French Translations are incomplete as they are missing the extras to the Plugin.


7.05
Fixed issue when used on right menu
added French Translation (thanks Tristanya to for this)
Fixed - Layout issue with the Counter (Thanks to schlrech for helping on this and the complete German Translation)
Fixed - Sorted User profile comments on whats new page
New - Now has Russian Translation (Thanks to Egor Chernodarov for this).
Updated - Web Bots now have there own icons (thanks Liquid_Squelch for the idea).
Updated - The user info pop up background and border colours can now be changed in plugin admin.
New - Admin Area section so that you can see if there has been any submissions.
Fixed - New Contents to the Content Manager now show.
Updated - Content Titles now used instead of content. and a number (thanks Liquid_Squelch for the idea)..
Fixed - Content and Comment links back to there pages.
Updated - What's new order has been changed to back the new page.
Fixed - PM icon now no longer shows to guests.
New - Now links to the Guestbook Plugin. link: [link] (Thanks to Anko for the idea).
New - Top Forum Starter
New - Top Forum Replier



7.04
Now has German Translation and Admin section now multi lingual, (Thanks to schlrech for this.)

7.03
Most Web Bot / Spiders now seen in Online Guest info instead of there IP address.
Happy Birthday Pops up even if Birthday list is hidden
New News post no longer shows up if news post is set to No One (inactive) in Visibility.
Minor fixes with code and layout


7.02
Small fix on whats new to take you to the correct forum post.
Spanish Language file added (Thanks to Neil Starkey - Rugbydubs) 

7.01
Fixed bug on linking to Content pages

7.0
New For e107 Version 0.7+