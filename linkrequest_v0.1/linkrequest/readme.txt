"Link Request" v0.1 plugin for e107 website system

Created by modifying "Contact Us" v1.0 plugin by Tim Cas, which was a modified version of "SimpleContact" plugin by EagleUK.

Purpose: to create a specific form for a user to submit a request to have their website added to our links page, a "Link Request"...get it? <g>

The original plugin was written for e107 v0.616, and was installed on v0.7.8 by me, and then modified to create this specific package. It should therefore work on all versions of e107 from v0.616 and up through v0.7+

This plugin is not guaranteed to do anything, nor is it guaranteed not to break your e107 setup. 
Please make backups regularly, especially before doing any major modifications. Granted, this is a minor modification, but don't email me just to complain if something breaks. This is my first release of anything, and it's only a mod of someone elses work to be a more specific use.

If you use it and it works, let me know. If you make changes, let me know, and maybe I'll release a newer version. If you make significant changes to the use of the plugin, please release your own version and help the e107 community.

Roger A. Lareau
NRAmember@NRAmember.com

Instructions:
=============

Extract files using directory structure in the ZIP file.

Upload to your 107_plugins directory.

Install the plugin using the Plugin Manager.

Configure the plugin:

	1> Set the "Link Request UserClass"

	If you set it for anything OTHER than "Everyone (public)",
	then the configuration is done. Enjoy the plugin.

If you set the "Link Request UserClass" to "Everyone (public)", then you must also do the following:

	2> Edit the act_sendmail.php file by replacing the ADMINEMAIL
	variable with a specific email address. This is because the 
	variable is not picked up when there is not a user logged in. 
	this allows anyone browsing your site to submit a link request
	without joining first. Enclose the email address in single quotes.
	See example below:

	Original code:

	sendemail( ADMINEMAIL, $subject, $message);
	
	Replacement code:

	sendemail( 'youremail@yourdomain.com', $subject, $message);



Revisions Made:
===============

v 0.1
-----changes from the original plugin:

	Created this readme file.
	
	Changed all the variables so not to conflict with "Contact Us" plugin if both are used on same site.

	Created a variable in the Language file for the email's subject, you can set it to whatever you want.

	Changed all the references to "Contact US" to "Link Request", still giving credit in description and readme.

	Cleaned up the display of the form, the titles and fields now align for a better presentation.

	Added hidden subject field to the form.
	
	Lengthened the name entry field to match the rest of the fields.

	