===============================================================
   e107 BLOG Engine - v2.2.2 - by MacGuru
===============================================================

 With this plugin users can write their own blogs.

 This plugin has a WAP interface where the users can read/write blogs and comments
 The startpage of the WAP interface is: macgurublog_menu/wap.php

 Ths plugin is only compatible with e107 v0.7.x

Users can:
==========
 - Add/edit/delete an entry
 - Categorize entries
 - Hide their blog
 - Write comments to entries in visible blogs and edit them
 - Edit or delete comments from their blog
 - Delete their whole blog
 - Vote on blog entries

Admins can:
===========
 - Edit/delete entries/comments in every blog (in hidden ones too)
 - Delete another user's whole blog
 - Save all blogs from the database
 - See the statistics of the blogs

 The plugin has got a menu box what can be turned on/off on the Menus admin page.
 Languages: English, French, German, Hungarian, Italian, Norwegian, Russian, Swedish
 
 To use the image upload function, pubilc uploads must be enabled.
 After the installation you have to create a directory for the uploaded images
 and set permissions to 0777 on it: e107_images/blog/

This plugin is based on Your Plugin v3.0 by Cameron (www.e107coders.org) Thanx for it!

Version History:
================
v2.2.2
* Further corrections against SQL injection

v2.2.1
* SQL injection patch

v2.2
+ Users can upload images to their blog
+ Blog entries can be rated
* Bug fixed around empty months
* Better listing of new comments
+ French language file - by Lolo Irie (Thanks!)
+ Youtube and Dailymotion video embedding with bbcode - by Lolo Irie (Thank you again! :))
+ Norwegian language file - by jobar (Thanks for it!)
+ Italian language file - by Johnny (Lots of thanks!)
* All short PHP tags replaced with the long version

v2.1.4
* Optimized MySQL queries
+ Comments can be edited by the poster or an admin
+ Russian language file - by MelAZ (Lots of thanks!)

v2.1.3
* Bug fixed around comment deletion

v2.1.2
* Upgrading problem fixed.

v2.1.1
* Fixed missing months
* Modified avatar display
* Now it shows the username in place of the default box caption ('BLOG')
* Fixed form_handler.php function conflicts
* UTF-8 support on user_pref.php,admin_config.php,admin_db.php
* Category+Page change bug fixed

v2.1
* MySQL 5.x compatible installation
+ RSS 2.0 feed for each blog
+ The blog author's avatar can be displayed on the top of the page
+ Changeable box caption
+ Categorizable blog entries
* Fixed new entry link on the WAP interface
+ Integrated into the search system
* The date functions used from the core handler
+ German langage file - by TalkingJazz (Thanks for it!)
* DB Dump generates smaller files.
+ WYSIWYG editor

v2.0.3
* Fixed links and images on WAP pages
* Fixed new entries and comments list on WAP pages

v2.0.2
* Fixed header errors on WAP pages
* Fixed missing links on WAP pages
* Fixed bugged logout method on WAP pages caused by class2.php
     If you get Corrupt Cookie message during login after logout,
     simply restart your WAP browser.
* Fixed new entries list on WAP pages

v2.0.1
* Fixed BBcode parse

v2.0
- Removed support for e107 v0.6
* The plugin now uses the original class2.php for WAP pages too
+ Users can delete their whole blog
+ Admins can change the settings of the users blog
+ Admins can delete the users blog
* Fixed redeclartion errors in form_handler.php
* Fixed header errors on the WAP pages
+ Guests can write comments
+ Swedish language file - by mankan (Thanx for it!)
* WAP pages default char-set changed to utf-8

v1.9.2 (first public release)


------------------
- removed function
+ added function
* bugfix