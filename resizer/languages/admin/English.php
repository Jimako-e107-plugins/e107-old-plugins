<?php
/*
+ ----------------------------------------------------------------------------------------------------+
|        e107 website system 
|        Email: support@naja7host.com
|        $Author: Mohamed Anouar Achoukhy $
+----------------------------------------------------------------------------------------------------+
*/
// lan  plugin 
define("IM_LAN_1", "nCode Image Resizer");
define("IM_LAN_2", "Automatically resize images in news content");
define("IM_LAN_3", "Installation Successful .");
define("IM_LAN_4", "Upgrade Successful .");

// lan admin_menu 
define("IM_LAN_5", "nCode Settings");
define("IM_LAN_6", "Settings");
define("IM_LAN_7", "Help");

// lan admin_config 
define("IM_LAN_8", "Maximum width");
define("IM_LAN_9", "Images taller than this width will be resized. Enter 0 to allow all widths, or leave the field empty to use the default value.");
define("IM_LAN_10", "Maximum height");
define("IM_LAN_11", "Images taller than this height will be resized. Enter 0 to allow all heights, or leave the field empty to use the default value.");
define("IM_LAN_12", "Keep original size");
define("IM_LAN_13", "Enlarge in same window");
define("IM_LAN_14", "Open in same window");
define("IM_LAN_14A", "Open in new window");
define("IM_LAN_15", "Open with tinybox");
define("IM_LAN_15B", "Open with tinybox V2");
define("IM_LAN_15A", "Open with fancebox");
define("IM_LAN_16", "Type of resize");
define("IM_LAN_17", "Save Changes");
define("IM_LAN_18", "Global Settings");
define("IM_LAN_19", "Enable nCode Image Resizer");
define("IM_LAN_20", "Change Saved");
define("IM_LAN_21", "Help ");
define("IM_LAN_22", "Unknown action");
define("IM_LAN_23", '
NCODE IMAGE RESIZER FOR E107 v0.75+
-------------------------------------
version: 1.0.1

I. What does it do
------------------
This plugin enables you to automatically resize every user-posted image which
is larger than given dimensions. Users can choose the maximum dimensions and the
resize method to use.
The resize methods are:
- No resizing
- Enlargement in the same document
- Enlargement in the same window (replacing the page content document)
- Enlargement in a new window
- Enlargement with Modal Box

It also adds an information bar (which is not displayed when the image is too
small) .

II. What does it not do
-----------------------
- It does not do server side resizing of images. Everything is done clientside
- It does not prevent long loading times. The images have to be downloaded completely
  by the client before the script can resize them.


III. Installation / Upgrade
----------------
1. Upload "resizer" folder to the ' . e_PLUGIN .' directory in your e107 installation.
2. go to plugins mager and install the plugin .
3. Set the setting as you want from  setting tab of this  .

The installation adds a couple of settings .


IV. Configuration
------------------
Administrators can change the maximum dimensions and resize mode in the options window.
These values will be the default for users without a setting of their own and
anonymous users.

V. Version history
------------------
1.0.1 (May 6th, 2007)
- first Release 


VI. Incompatibilities
---------------------
Incompatibilities have been reported with:
"Transparency PNG pictures with Internet Explorer 6 (server-side solution)"
(http://www.vbulletin.org/forum/showthread.php?t=93415)

VI. Copyright
-------------
please keep in mind that:
THIS IS PORTED PLUGIN from (nCode - www.ncode.nl - info@ncode.nl ) to e107 . 


VII. Dotations
--------------
Do you like this plugin ? Donations are highly appreciated. You can donate by PayPal or 
MoneyBookers to admin@naja7host.com. Feel free to add your comments, suggestions or 
recommendations to this donation.


');
/* reserved for next release

define("IM_LAN_24", "");
define("IM_LAN_25", "");
define("IM_LAN_26", "");
*/


?>