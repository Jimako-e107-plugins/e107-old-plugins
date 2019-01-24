<?php
/*
+---------------------------------------------------------------+
|	e107 website system
|
|	©Steve Dunstan 2001-2005
|	http://e107.org
|	jalist@e107.org
|
|	Released under the terms and conditions of the
|	GNU General Public License (http://gnu.org).
|
|
|   uclass_show plugin  ver. 1.02 - 20 nov 2012 rev. 12 nov 2012 09.42
|   by Alf - http://www.e107works.org
|   Released under the terms and conditions of the
|   Creative Commons "Attribution-Noncommercial-Share Alike 3.0"
|   http://creativecommons.org/licenses/by-nc-sa/3.0/
+---------------------------------------------------------------+
*/

//plugin.php
define("UC_SHOW_01", "Assign a picture to each user class and shows under his avatar and / or profile");
define("UC_SHOW_02", "UserClass SHOW");
define("UC_SHOW_03", "UserClass SHOW has been installed. For first setup click here");
define("UC_SHOW_04", "UserClass SHOW has been updated.");
define("UC_SHOW_05", "Settings updated");

//admin config
define("UC_SHOW_ADM_01", "UserClass SHOW setup");
define("UC_SHOW_ADM_OPT_01", "UserClass SHOW options");
define("UC_SHOW_ADM_02", "Warning!<br />you have already uploaded this file");
define("UC_SHOW_ADM_03", "Extension not allowed");
define("UC_SHOW_ADM_04", "you can not upload files with this extension");
define("UC_SHOW_ADM_05", "Assign a picture to the existing classes");
define("UC_SHOW_ADM_06", "name");
define("UC_SHOW_ADM_07", "description");
define("UC_SHOW_ADM_08", "current image");
define("UC_SHOW_ADM_09", "upload image  (recommended max width:");
define("UC_SHOW_ADM_10", "available images");
define("UC_SHOW_ADM_11", "the image has been deleted, you must reload it or assign a different");
define("UC_SHOW_ADM_12", "no image assigned");
define("UC_SHOW_ADM_13", "upload");
define("UC_SHOW_ADM_14", "no images found");
define("UC_SHOW_ADM_15", "assign");
define("UC_SHOW_ADM_16", "Warning!<br />different user classes use the same image");
define("UC_SHOW_ADM_17", "You have not yet configured user classes (groups of Members)<br />configure them now, from here <a href ='".e_ADMIN."userclass2.php' title='users groups'><img src='".e_PLUGIN."uclass_show/images/conf_class.png' alt=''/></a>");
define("UC_SHOW_ADM_18", "Plugin is");
define("UC_SHOW_ADM_19", "DISABLED");
define("UC_SHOW_ADM_20", "ENABLED");
define("UC_SHOW_ADM_21", "Setup menu");
define("UC_SHOW_ADM_22", "Enable or disable the plugin. If disabled no configuration is possible unless the management of images (above)");
define("UC_SHOW_ADM_23", "Show in forum");
define("UC_SHOW_ADM_24", "If you enable this option, the \"user class images\" that you set will be displayed under the avatar in the forum.");
define("UC_SHOW_ADM_25", "Show in comments");
define("UC_SHOW_ADM_26", "If you enable this option, the \"user class images\" that you set will be displayed under the avatar in the comments.");
define("UC_SHOW_ADM_27", "Show in user profile");
define("UC_SHOW_ADM_28", "If you enable this option, the \"user class images\" that you set will be displayed under the user profile.");
define("UC_SHOW_ADM_29", "Number of images");
define("UC_SHOW_ADM_30", "If you have created a lot of user classes and then you have too many pictures to show, here you can set the maximum number. The default is 5.<br />However, if you select that option, the user profile page will show all groups images.");
define("UC_SHOW_ADM_31", "Hide to guests");
define("UC_SHOW_ADM_32", "Enabling this option only registered and logged users can see the user classes images");
define("UC_SHOW_ADM_33", "Show group name");
define("UC_SHOW_ADM_34", "Enabling this option each class image will be displayed with the name of the group it represents, showmn onmouse over effect.");
define("UC_SHOW_ADM_35", "Save settings");
define("UC_SHOW_ADM_36", "and others: ");
define("UC_SHOW_ADM_37", "select");
//upgrade 1.01 12 nov 12
define("UC_SHOW_ADM_38", "Using custom templates");
define("UC_SHOW_ADM_39", "select to enable");
define("UC_SHOW_ADM_40", "for the forum:");
define("UC_SHOW_ADM_41", "for comments");
define("UC_SHOW_ADM_42", "for user profile");
define("UC_SHOW_ADM_43", "This option allows you to change the default shortcodes e107, if you use custom templates to the forum for comments to your user profile.<br /><span style='color:#861e03;font-weight:bold;'>Warning!</span> what you write in the text boxes here on the left is saved in the core of the CMS and used on pages that use those customtemplates. You must enter only code that you know as absolutely sure (eg  {AVATARSTATUS} or {FS_AVATAR}  coming from the developers of the custom template you use). <strong>The inclusion of other code may expose you to serious risks to your site, if you don't know what are you doing.</strong>");
define("UC_SHOW_ADM_44", "By default, this plugin search and replace the following shortcodes:<br /> {AVATAR} for the forum and comments;<br />{USER_LOGINNAME} for user profile.");

//admin menu
define("UC_SHOW_ADM_OPT_02", "Setup");
define("UC_SHOW_ADM_OPT_03", "Info");
define("UC_SHOW_ADM_OPT_04", "Tips");

//admin readme
define("UC_SHOW_README_01", "UserClass_Show allows you to assign images to each user group created in e107 and show them under the avatar of each user belonging to that class (group).");
define("UC_SHOW_README_02", "The particularity of UserClass_Show is to allow the user the total management of images directly from the control panel without any need to edit files, insert shortcodes or upload images via FTP. Everything is managed from the control panel of the plugin, which automatically cleans it's tables, check the images and alerts the user to any significant changes in the management of user classes e107.");
define("UC_SHOW_README_03", "<strong>Plugin functions</strong>:<br />assign images to each user group created;<br />upload images directly from your control panel (need public upload permission setted. Read e107 documentation);<br />warning if image does not exist and/or deleted; <br />warning if two or more classes use the same image;<br />notice if you load files with extensions that are not allowed;<br />size sensing set by e107 for the avatar and sizing images of the group;<br /> possibility of browsing all the images uploaded for subsequent redeployments;<br />preview of uploaded images;<br />choice single or multiple sections where show images (forum , comments, user profile)<br />ability to hide pictures of the group to guests;<br />possibility of limiting the number of images displayed at a presettable value from the control panel;<br />ability to view or hide description for the group.");
define("UC_SHOW_README_04", "<strong>Considering that the plugin works on the original e107 templates, users who use custom template can find useful information on the page \"tips\" of the plugin</strong>.");
//admin tips
define("UC_SHOW_TIPS_01", "This plugin works on the original e107 templates. This means that if you are using custom templates (forum_viewtopic, comments, user), image display group may be vitiated by errors and, in some cases it may not be. Here are some suggestions.");
define("UC_SHOW_TIPS_02", "If using shortcodes of custom template from third parties, such as in the case of custom avatar downloaded from e107works.org, the mod that displays the online / offline user, you can enable the option \"<strong> uses custom template</strong>\". Using this function, you can manually enter the shortcode to use, if it is different from the default e107. This option relative menu, explain exactly how to intervene.");
define("UC_SHOW_TIPS_03", "Experienced users, working on the file <strong> e_meta.php </strong> contents in this plugin, can also correct not only the shortcodes used by custom template, but also work on the HTML code to enhance or customize the rendering, if necessary.");
define("UC_SHOW_TIPS_04", "The plugin automatically configures the permissions (CHMOD) of the folder to upload images. If in any case the upload from the control panel does not go well, <strong>after checking permits loading of e107 (IMPORTANT !)</strong>, check whether the folder <strong>uclass_show/class_images</strong> has permission <strong>0755</strong> or those your hoster require.");
define("UC_SHOW_TIPS_05", "However, these operations are not necessary for most users, but if you ever need help you can ask for assistance <a href='http://www.e107works.org/e107_plugins/forum/forum_viewforum.php?11' title='FAQ'>==>here</a> and solve quite quickly.");

?>
