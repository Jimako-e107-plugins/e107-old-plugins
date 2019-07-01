
Corllete Lab's Feature Box (e107 plugin) 
Copyright (C) 2007 Corllete (R) Lab - Corllete ltd. under GNU GPL (http://gnu.org)
http://www.clabteam.com
http://www.free-source.net


    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>


Plugin requirements:
----------------------------
 - e107 v0.79+
 
Summary:
-----------------
This is an advanced version of the core Feature Box module. The plugin is aimed to give more flexibility to theme developers and of course of your own site content.
This plugin is developed to be used from theme developers at first place (theme developers series). 
However it can also be used as ordinary e107 plugin without theme support (fbox menu).
 
User Info
-----------------
Install the plugin from Plugin Manager area. Go to administration, set the plugin preferences and add the content you wish. If your theme supports this plugin no other action
is needed - just read the theme autor's instructions. 
Alternative you could install the plugin in some menu area (recommended in theme top menu area). This plugin has built-in menu ajax support (enable from administration)

	Create/Edit page
	- Title (optional) - used in fbox menu or theme shortcode
	- Text (optional) - used in fbox menu or theme shortcode
	- Image (optional) - used in fbox menu or theme shortcode - to add new image copy it to fbox/templates/tmpl_images or current_theme/fbox/tmpl_images
	- Item template (optional) - choose a template which will be used for this item. The template can be overridden by your theme (shortcode parameters)
	- Default on Page (optional) - exact url - this item will be shown on this page as default item. The url will be converted to e107 url format (e.g. {e_PLUGIN}forum/forum.php)
	- Page Filter (optional) - page match rules (one rule per line) - this item will be shown only on the provided pages. Filter is disabled if the field is empty.
	- Item visibility permissions (optional) - userclass which is allowed to see this item

Theme Developers Info
----------------------------
It's very easy to implement this plugin in your theme - just add {FBOX} shortcode somewhere in your theme. You have the full control over the content & layout with the provided
shortcode parameters. Add parameters in the following (url) format: {FBOX=parm1=val1&parm2=parm2...}

	Available {FBOX} shortocde parameters
	- get_one=0 | 1 		 (if true - get only one item. If you set this to '0' you'll get all available items for this page and control them e.g. via javascript)
	- random=0 |1 			 (get random item -  get_one=1 is required)
	- navigation=0 | 1		 (if enabled this will return only the ajax navigation links - see below)
	- use_template=tmpl_name (the name of template to be used regardless the user per item template choice. Note - read the templates section to undestand what is the template name which you have to use)
	- tablerender=0 | 1		 (enclose in tablerender - if get_one=1 and the title of the current item is not empty it'll be used for the function's title parameter, else FBOX_MENU_1 will be used)
	- render_mod=mod_name 	 (if tablerender=1 this will be the theme mode used in the tablerender function - default theme mod is 'fbox')
	
	You could try any combination of the parameters above. There are some dependencies though - some of the parameters require other parameters to work proper.
	
	Templates
	Templates are read from two locations 'fbox/templates/' and 'current_theme/fbox/'. Theme templates will override plugin templates with same name.
	You have to use the following template filename format: some_name.tmpl.php
	The last part '.tmpl.php' is required (otherwise your template will be ignored)
	The name of the template in the example below is 'some_name' so you can use it as shortcode parameter value this way: use_template=some_name
	
	Template variables
	Your template files can contain the followng template variables:

	 - $FBOX_TEMPLATE_PRE (optional) - this will be added before the fbox item(s); you can use all available template shortcodes here (see below), 
	 the returned values are taken from the active on the current page item. This is useful if you wish to add some sort of JS
	 
	 - $FBOX_TEMPLATE (required) - this is the main item template; if shortcode parameter get_one=0 - this template variable will be used in a loop;
	 you can use all available template shortcodes here (see below)
	 
	 - $FBOX_TEMPLATE_POST (optional) - this will be added after the fbox item(s); you can use all available template shortcodes here (see below), 
	 the returned values are taken from the active on the current page item. This is useful if you wish to add some sort of JS
	 
	 - $FBOX_TEMPLATE_NAV (required for navigation) - template for navigation links - used only when you set shortcode parameter navigation=1; you can use all available template shortcodes here (see below)
	 
	 - $FBOX_TEMPLATE_NAVSEPARATOR (required for navigation) - separator between navigation links - used only when you set shortcode parameter navigation=1; no shortcodes available here
	 
	Template Shortcodes
	You can use the following shortcodes in your template variables:
	{FBOX_TITLE} - title of the item
	{FBOX_TEXT} - text of the item
	{FBOX_IMG} - item image tag
	{FBOX_IMGPATH} - only the path to the item image
	{FBOX_ID} - unique ID of the item
	{FBOX_NUM} - item's order number - useful with navigation links
	{FBOX_NAVCLASS} - returns 'fbox-nav-active' for the active item and 'fbox-nav' for the rest - useful with navigation links
	{FBOX_AJAXURL} - generates the url parameters needed when ajax navigation/load is enabled (see fboxSetActiveItem() function in fbox_switch.js
	
	Other
	In your theme you can use or not the javascript provided with this plugin - it's your choice. NOTE - don't load fbox_switch.js by yourself (e.g. theme_head()) - this can lead to 
	conflicts with fbox_menu. All you have to do is to put the following in your theme.php: 
	define('FBOX_JS', true); 
	
	You can always use default.tmpl.php as a starting point for your fbox theme template.
	You can provide images within your theme which will be shown in fbox plugin administration (create/edit item) - just put them in your_theme/fbox/tmpl_images/ folder
	You can rewrite the default plugin and menu templates - just create default.tmpl.php and menu_alt.tmpl.php in your_theme/fbox/ folder
	In your theme you can check if the plugin is installed this way:
		if(varset($pref['fbox_ver'])) $fbox_installed = true;//or do whatever you want
	The fbox menu uses {FBOX} shortcode, so you could take a look how it's done (fbox_menu.php)
	
