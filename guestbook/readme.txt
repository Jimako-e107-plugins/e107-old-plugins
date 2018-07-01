-----------------------------------------------------------------------------------------------------------+
                                             GUESTBOOK PLUGIN
-----------------------------------------------------------------------------------------------------------+
 original: Andrew Rockwell 2003
           http://2sdw.com
           chavo@2sdw.com
-----------------------------------------------------------------------------------------------------------+
 updates:  Richard Perry 2005
           http://www.greycube.com
           code@greycube.com
-----------------------------------------------------------------------------------------------------------+
 updates:  Chris Engelhard en Jan Feyen 2006
           http://www.zwartemarkt.org
           eaonflux@zwartemarkt.org
-----------------------------------------------------------------------------------------------------------+
 updates:  Christian Reyer 2007
           http://www.planet-comander.de
           comander@planet-comander.de
Fix Some Bugs
Added German Language
-----------------------------------------------------------------------------------------------------------+           
 updates:  Christian Reyer 2007
           http://www.planet-comander.de
           comander@planet-comander.de
Fix Some Bugs
-----------------------------------------------------------------------------------------------------------+           
 updates:  Titanik 2007
           http://upc.utc.sk
           tomasss@inmail.sk
-----------------------------------------------------------------------------------------------------------+           
 updates: Rainer Janz 2007
	  http://www.platinwebservice.de
	  webmaster@platinwebservice.de
-----------------------------------------------------------------------------------------------------------+ 

4.0
Added e_notify.php for email notification for new guestbook entry
Added function "Activation after Admin Verification" (for 
Added new Admin Menu for viewing and activate or delete new guestbook entries
Added Notification in Preferences for email notification if admin verification is enabled
changed/added LAN defines in German.php and English.php
Added functions to active, block and delete entries in admin menu
fixed update tables in plugin.php for versions older 3.74
changed hardcoded notifications in plugin.php to language files
changed all Files to utf-8


3.74
Added Danish language (thanks to Black Muddler)
3.73
Remove verification code for logged User
Added French language (thanks to Laurent ROBIN (Lolo))
Added Russian language (thanks to Panarin.A.V)
3.72
Added e_status
Removed hide_profile (it's in users setting)
Added page title
Added German language (thanks to Wolfgang Habon)
Added Dutch language (thanks to Jens Orie)
3.7
Added Message Content for delete

3.6
Added editing time to Admin setting
Added hide profile to Admin setting
Added insert ip to db
Added Slovak Language

-----------------------------------------------------------------------------------------------------------+           
                     

We added an image code verification option.
You can enable it in the admin screen of this great plugin.
-----------------------------------------------------------------------------------------------------------+

 Installation:

  - Upload the guestbook folder to e107_plugins folder

  - Goto to Admin Area, Plugin Manager, Install Guestbook

  - Goto to Admin Area, Guestbook, to change the default settings

-----------------------------------------------------------------------------------------------------------+

 Upgrading from the old guestbook version 2.x:

  - Delete guestbook folder, upload new guestbook folder
  
  - Goto the Admin Area, Links, Remove guestbook.php from the link so its just e107_plugins/guestbook/

-----------------------------------------------------------------------------------------------------------+

 If $GBOOKSTYLE is defined in your e107 theme.php then the Guestbook will use that layout.

 If not it will use the default layout set within the guestbook_class.php

 The available options are:

  {GUEST_NAME}    = Posters name
  {GUEST_COMMENT} = Posters comment
  {DATE}          = Date and Time when entry was made

  {URL_IMG}       = Link to posters website as an image
  {URL_TEXT}      = Link to posters website as text

  {EMAIL_IMG}     = Link to posters email address as an image
  {EMAIL_TEXT}    = Link to posters email address as text

  {PROFILE_IMG}   = Link to a registered posters profile as an image
  {PROFILE_TEXT}  = Link to a registered posters profile as text

  {EDIT_IMG}      = Link for editing guestbook entries as an image
  {EDIT_TEXT}     = Link for editing guestbook entries as text

  {DELETE_IMG}    = Link for deleting guestbook entries as an image
  {DELETE_TEXT}   = Link for deleting guestbook entries as text

  {IP_ADMIN}      = Posters IP address viewable by admins only
  {IP_PUBLIC}     = Posters IP address viewable by everyone

-----------------------------------------------------------------------------------------------------------+
