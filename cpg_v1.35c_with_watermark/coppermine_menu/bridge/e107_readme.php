<?php
require_once("../../../class2.php");
require_once(e_ADMIN."auth.php");
$text=<<<EOT
/* 
|  Copyright (C) 2003 Thom Michelbrink
|
|  Author:  Thom Michelbrink     mcfly@e107.org
|				With much additional work by MrPete
|
|  This program is free software which I release under the GNU General Public
|  License. You may redistribute and/or modify this program under the terms
|  of that license as published by the Free Software Foundation; either
|  version 2 of the License, or (at your option) any later version.
|
|  This program is distributed in the hope that it will be useful,
|  but WITHOUT ANY WARRANTY; without even the implied warranty of
|  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
|  GNU General Public License for more details.  Version 2 is in the
|  COPYRIGHT file in the top level directory of this distribution.
| 
|  To get a copy of the GNU General Puplic License, write to the Free Software
|  Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
*/

##############  PURPOSE #########################

  This is a modified version of the Coppermine Photo Gallery (coppermine.sf.net) for use 
  with the e107 CMS system (e107.org).
  
  This version allows all Coppermine functionality, embedded into an e107 website. It takes
  advantage of all e107 web formatting and e107 user data.
  
##############  SUPPORT #########################
  
  All support questions and bug reports for this version should be made on the e107coders.org forums or in the bugtracker there. I will browse the coppermine forums once in a while, but not too often.
    
Requirements:

  This plugin requires e107 Verion 0.600+
  It's assumed you have at least PHP version 4.3
  It's assumed you have GD1, GD2 or ImageMagick library properly installed and configured.

############## INSTALLATION ##################### 

==>>First Time Installers <<==
1) Upload all files to a coppermine_menu folder in your e107_plugins directory on your server, 
   retaining directory structure.
2) (Already DONE in e107coders version) Copy the contents of this folder (bridge/e107) to the coppermine_menu folder
3) (Already DONE in e107coders version) Edit include/init.inc.php: UNcomment the line define('UDB_INTEGRATON','e107');
4) Go to the admin section of the website, go the to plugin manager and install Coppermine. If you get any errors or warnings: fix the issue, UNINSTALL (admin level; no need to delete files), and install again.
5) Now leave the admin section and try the 'Gallery' link...
6) Go to the Coppermine 'Config' menu. Verify that all parameters are correct. Most of it should be auto-configured for you. Note that an 'e107' theme has been picked. Don't touch this! The coppermine 'e107' theme simply draws on whatever theme you have chosen in e107.
7) Create at least one album, and upload a photo. Check for any file permission (chmod) problems and fix them.

==>>Upgraders<<== (these instructions assume you have the pre-configure e107coders.org version)
1) Back up your database. Use phpMyAdmin to be sure you have a good backup!
2) BE CAREFUL WITH THE NEXT STEP!!! **DO NOT** lose your coppermine_menu/albums folder! It contains all of your existing photos!
3) Carefully: delete your old coppermine_menu contents BUT NOT THE ALBUM FOLDER. Do not lose the album folder or you will be sorry.
4) Now, copy the new coppermine_menu folder to your server
5) Follow the first-time-installer instructions above. (You'll see an "upgrade" link instead of "install" in the e107 admin plugin manager.)

############## MENU CONFIGURATION ###################

This version includes an e107 menu that displays random images and/or quick-jumps to coppermine categories and albums.
To enable it, use the e107 admin -> menus manager as with any other menu. Once it is enabled, use the standard menu configuration options to set its parameters.

############## SETUP AND USAGE HINTS ###################

Coppermine groups 
-----------------
'groups' in coppermine are knows as 'user classes' in e107.  Once you create a userclass in e107, it will automatically appear in the Coppermine 'groups' page.  From there you can set permissions.  A special e107 userclass of COPPERMINE_ADMIN is also created. Users assigned to that class are 'Administrators' in Coppermine.

Users who are members of multiple e107 userclasses are likewise members of the same coppermine 'groups'.

Built-in Coppermine groups:
* 'Anonymous' is all e107 guests
* 'Registered' is all e107 members
* 'Administrators' are members of e107 group 'COPPERMINE_ADMIN' (you set these!)
* 'Banned' is not used in the e107 integration

Coppermine visitors
-------------------
A 'visitor' in Coppermine is anyone viewing a page. They may be a guest, an admin, or anything in between.

Gaining upload permission
-------------------------
A user cannot upload pictures to an album unless and until the album is set to allow visitors to upload pictures.

Remember: "Visitors" are all people who can see an album. So, visitors must be given upload permission

=========================================================
Version history:

8/1/2003 - 0.1
	+ Initial release, supported Coppermine 1.1.1
 
11/18/2003 - 0.2b1
	+ Upgraded to support Coppermine 1.2.0
	+ Change e107_default theme to just 'e107', tweaked it a bit to use more of the e107 css files.

11/19/2003 - 0.2b2
	+ Favorites link only appears for registered members
	+ Link to 'Album List' always return to root album
	+ Fixed a lot of theme problems (others probably still exist)
	+ Fixed breadcrumb not showing
	+ Random image menu no longer shows unapproved images
	+ Dynamically create the e-card URL on install

11/20/2003 - 0.3
	* Changed version to 0.3 because of mixup of not calling the first 0.2 a beta
	+ Fixed problem (again) with username not appearing on user-uploaded images
	
11/20/2003 - 0.3.1
	+ Fixed problem with userclasses, it was assigning the group to the last userclass matched instead of the first.
	+ Added some code to the init.inc.php file that was included in the previous version of coppermine but appearently the developers left it out of the new version. It checks for write capabilies to the album directory.  I put it back in this version because I thought it was necessary.  It will only be shown to coppermine admins (site admin is a coppermine admin by default)
	+ Uploading an image as admin will now store the admin id/username.
	
11/28/2003 - 0.3.2
	+ Added native EXIF code, you no longer need to have it compiled into PHP. Install will turn it on by default.  If you are upgrading, you will have to go to preference and set it to 'YES'.
	+ Fixed a few minor display/xhtml errors. (thanks d723)
	+ When adding a userclass in e107 and then going to album properties, the new group would not show up unless you went the the coppermine 'group' page.  Fixed now.
	
1/16/2004 - 0.3.3
	+ Added a config screen to the random image menu, also added a 'jump to' section.
	+ Fixed duplicate breadcrumb from appearing, hopefully it appears everywhere now (but only once).
	+ Fixed problem with empty albums showing errors when image was clicked.  I was blaming coppermine core code for this, it was a theme issue :)
	+ Added <?php to exif 'makers 'files ( instead of just <? )
	+ changed a few include paths to fix a few servers that don't like the other way. (fixes blank pages that appear on displayimage.php page)
	+ Tweaked the theme a little bit more, any changes anyone has are VERY welcome.
	+ If an album was restricted to a group, admin would never see it.
	+ changed all references to the 'default' theme to 'e107'.

1/2005 - 1.3.2a
	+ Converted to full coppermine integration with zero coppermine code edits
	+ Enhanced coppermine_menu to understand multi-level categories and to attach owner id to albums
2/2005 - 1.3.2b
	+ plugin.php now should work on all sites
	+ Incorporate Bobo's German language file for e107 menu
	+ Include improved GD2 hack to support GIFs. Thanks, Bobo!!! (This is not standard Coppermine but is
	  being submitted to the cpg dev's)
	+ Auto-configure what we can: Admin email, theme, image library, image path, site path
	+ Test and add warning about Safe Mode
	+ Enhance UDB to properly support ecards
	+ Lock out coppermine install -- it breaks predefined e107 integration
	
EOT;
	$ns -> tablerender("Coppermine Photo Gallery Plugin Readme" , nl2br($text));
	require_once(e_ADMIN."footer.php");
?>
