 /* /* 
|  Copyright (C) 2003 Thom Michelbrink
|
|  Author:  Thom Michelbrink     mcfly@e107.org
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

  This is a modified version of the Coppermine Photo Gallers (coppermine.sf.net) for use 
  with the e107 CMS system (e107.org).
  
  This modified version allows all Coppermine functionality, while utilizing the e107 user database.
  
##############  SUPPORT #########################
  
  All support questions and bug reports for this version should be made on the e107coders.org forums or in the bugtracker there. I will browse the coppermine forums once in a while, but not too often.
    
Requirements:

  This plugin requires e107 Verion 0.600+

############## INSTALLATION ##################### 

1) Upload all files to your e107_plugins directory on your server, retaining directory structure.
2) Go to the admin section of the website, go the to plugin manager and install Coppermine.
3) Go to coppermine and check for any file permission (chmod) problems and fix them.
4) Create at least one album so you can upload to it.

############## CONFIGURATION ###################

There is a random image menu that comes with this version of coppermine, you can go to your admin -> menus section of e107 and enable this menu.  All configuration options for this menu must be done by editing the source of the php file.

Coppermine groups 
-----------------\
'groups' in coppermine are knows as 'user classes' in e107.  Once you create a userclass in e107, it will automatically appear in the Coppermine 'groups' page.  From there you can set permissions.  There is a special e107 userclass of COPPERMINE_ADMIN, if you create this class in e107 and assign a user to that class, they will automatically be assigned to the 'Administrator' group in Coppermine.

Currently you can only be a member of one 'group' in coppermine, but can be a member of several userclasses in e107.  When a user goes to your coppermine page, it will search through all of the 'groups' in coppermine.  The first userclass it finds (alphabetically) that the user is a member of, this is the group the user is assigned to.

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
	
	
	
	

