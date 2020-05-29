#==============================================================================+
#   EasyGallery - an easy gallery plugin by nlstart
#
#   Plugin Support Website: [link=external=http://e107.webstartinternet.com/]e107.webstartinternet.com[/link]
#
#   A gallery plugin for the e107 Website System; visit [link=external=http://e107.org/]e107.org[/link]
#   For more plugins visit: [link=external=http://plugins.e107.org/]plugins.e107.org[/link]
#   or [link=external=http://www.e107coders.org/]e107coders.org[/link]
#
#==============================================================================+
Thank you for using EasyGallery. You can show your appreciation and support future development by [link=https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=nlstart%40webstartinternet%2ecom&item_name=NLSTART%20Plugins&no_shipping=0&no_note=1&tax=0&currency_code=EUR&lc=EN&bn=PP%2dDonationsBF&charset=UTF%2d8]donate via PayPal[/link] to NLSTART.
Alternatively, send me something from [link=https://www.amazon.com/gp/registry/wishlist/KA5YB4XJZYCW/]my Amazon wishlist[/link] to keep me motivated!

Purpose and history of the EasyGallery plugin
==============================================
The EasyGallery plugin creates it's own thumbnails if GD or ImageMagick is installed.
The plugin has been developed with the idea that administrators of a e107 website should be able to quickly just FTP a folder of images.
The plugin is capable of creating thumbnails on the fly. Image descriptions can be added afterwards by users with admin status.
By default, the comments functionality is switched off, but can be switched on.

It is based on the scripting of [link=http://coding.1-fix.com/php-scripts.htm]phpSimpleGallery v2.1.1[/link]. Author: Craig Atkins
Date: 18/03/2005 (18th March 05), version: 2.1.1
The phpthumbs.bmp.php is based on the [link=http://www.getid3.org]getID3[/link] module.graphic.bmp.php, which is a module for analyzing BMP Image files.
It was modified for use in phpThumb() by James Heinrich 2004.07.27 (27th July 2004).
phpSimpleGallery was branched from Gallery 1.01 by [link=http://www.ricocheting.com/scripts/gallery.html]rococheting[/link].

Prerequisites:
==============
* E107 core v0.7.8 (or newer) installed.
* GD installed (PHP module, installed by default)
* optional: ImageMagick installed (not bundled with PHP)

Installation:
=============
a. Upload the EasyGallery plugin files into your 'e107_plugins' folder. Although 'Upload plugin' from the Admin section might work, uploading your plugin files by using an FTP client program is recommended.
b. When working on Linux or Unix based server set the CHMOD settings of directories to 755 and set CHMOD of all .php files to 644.
c. Login as an administrator into e107, go to Plugin Manager, install EasyGallery and enjoy!

Features:
=========
* Multiple image folders are supported
* Creation of thumbnails on the fly
* Resize of images to maximum size on the fly
* Admin has complete control over uploaded images; delete, move and add images
* Administrator defines user group that is allowed to upload
* Administrator defines number of images per batch upload (1-10)
* Administrator defines if core comment functionality on images is enabled
* Alert of image updates in the admin 'latest' section
* Automatic creation of blank index.html file in image folder to protect from direct viewing
* Application keeps track of who updated which image
* EasyGallery menu that displays a random thumbnail

Updates:
========
Not applicable; no database updates since v1.0!

Important background information
================================
The PECL extension ImageMagick is not bundled with PHP.
Information for installing this PECL extension may be found in the manual chapter titled Installation of PECL extensions. Additional information such as new releases, downloads, source files, maintainer information, and a CHANGELOG, can be located here: http://pecl.php.net/package/imagick.
Note: The official name of this extension is imagick.
More and up-to-date information can be found: http://www.php.net/manual/en/imagick.installation.php

Handy to know for those who are updating images by FTP: you can add already descriptions to your images by adding a text file in the same folder.
Example: you have myphoto001.jpg in your image folder. Create myphoto001.jpg.txt in the same folder and type some text in it. After uploading your image folder your image descriptions will be viewable immediately.
Site members with admin status can change the image descriptions if setting 'Display images within EasyGallery?' is 'Yes', by going to the image detail page.

Styling your gallery
====================
Copy the 2 template files (eg_template.php and eg_style.css) from the easygallery/templates folder to your theme folder and adjust them there. The plugin checks if there is a customised template in your theme folder. If EasyGallery can't find it in the theme folder you use, it will use the default ones.
In the template the $EG_THUMBS is the template for showing the available albums and the initial thumbnails of all images available in the album.
The section $EG_IMAGE is the template for showing a detailed image from an album.

Demonstration
=============
For a demonstration on the web, go directly to http://e107.webstartinternet.com/e107_plugins/easygallery/gallery.php
To have a quick demonstration yourself you can download the full demonstration package from the NLSTART website. 
The gallery folder is than already pre-filled with 15 images in the plugin. It will show you if and how the plugin works right away.

Changelog:
==========
- EasyGallery 1.1 [nlstart, January 14, 2012]
	* admin_overview.php: Restructured totally because folder indication .. is not allowed in URL anymore since 0.7.26
	* e_latest.php: Fixes because folder indication .. is not allowed in URL anymore since 0.7.26
	* eg_class.php: Implemented e-TOKEN in upload images and add description
	* eg_class.php: Fixed upload entry text color in upload images to always black
	* languages/English.php: Added EG_UPLOAD_56 to display if upload fails (e.g. duplicate file name)
	* languages/English.php: Added EG_UPLOAD_10 to display if upload fails on error
- EasyGallery 1.0 [nlstart, February 4, 2010]
	* Customized and restructured existing code
	* Improved album display with previous and next image on image detail level
	* Optimized selections in function PrintThumbs
	* Optimized applications by removing all functions to eg_class.php
	* Enhanced GetEntry to go to next image by clicking on current image
	* Enhanced for use with e107:
	* Added functionality to upload
	* Added functionality to resize uploaded images and shown images to maximum image size
	* Added functionality for admins to interactively add/change image text
	* Added gallery settings to be controlled by e107 administrator
	* Added integration with e107 core comments functionality
	* Added integration with e107 core Menus with random image menu
	* Restructured templates to e107 template style
	* Added admin functionality to control Gallery image folders and upload folder
- phpSimpleGallery 2.1.1 [Craig Atkins, March 18, 2005]
- PHP Image Gallery 1.01 [ricocheting, May 11, 2004] - Initial release


Future roadmap
==============
* actually monitor the buglist on [link=external=http://e107.webstartinternet.com]e107.webstartinternet.com[/link]
* monitor what features end users want

License
=======
EasyGallery is distributed as free open source code released under the terms and conditions of the [link=external=http://gnu.org/]GNU General Public License[/link].