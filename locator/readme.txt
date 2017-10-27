#==============================================================================+
#   Locator - an e107 Plugin by nlstart
#
#   Plugin Support Website: [link=external=http://e107.webstartinternet.com/]e107.webstartinternet.com[/link]
#
#   A plugin template for the e107 Website System; visit [link=external=http://e107.org/]e107.org[/link]
#   For more plugins visit: [link=external=http://plugins.e107.org/]plugins.e107.org[/link] or [link=external=http://www.e107coders.org/]e107coders.org[/link]
#
#==============================================================================+

If you like this plugin, send me something from [link=https://www.amazon.com/gp/registry/wishlist/KA5YB4XJZYCW/]my Amazon wishlist[/link] to keep me motivated!
Alternatively, PayPal some new funds to: nlstart@webstartinternet.com

Purpose of the Locator plugin
=====================================
GOAL: Display a grid of locations and display the locations in a map


Prerequisites:
==============
- E107 core v0.7.7 (or newer) installed.
- When you want to embed a Google Map integrated on your Locator page on your site you need a Google Maps API key;
  getting a Google Maps API key is free and easy: [link=external]http://maps.google.com/apis/maps/signup.html[/link].
  if you don't have an API key; no worries; a Locator link to the Google Maps website does not require a Google Map API key.


Installation:
=============
a. Unzip the files
b. Upload the Locator plugin files into your 'e107_plugins' folder. Although 'Upload plugin' from the Admin section might work, uploading your plugin files by using an FTP client program is recommended.
c. When working on Linux or Unix based server set the CHMOD settings of directories to 755 and set CHMOD of all .php files to 644.
d. Login as an administrator into e107, go to Plugin Manager, install Locator and you can start defining the settings


3. Updates:
===========
RC2 contains Google Map Class from [link=external=http://www.phpinsider.com/]phpinsider.com[/link]
When upgrading from Release Candidate RC 1/2/3/4/5/6/7:
step 1. Overwrite old plugin folder with new files.
step 2. Go to Admin Area > Plugins > Locator > Locator Settings; fill in or check the new settings to your preferences; click button 'Apply changes'.

RC4 must become somewhat faster; e107 caching is supported by default (even if caching setting in e107 is set off).
New in RC4 are grouping possibilities: group on category, country, city and/or zip code. You can select any of the groups to be active or not. You can also create external links to directly apply a certain group. Example: if you have a category with id '1' (NOTE: not the category description!), you could link to 'locator.php?cat.1' (without the quotes). Furthermore, you can define the group dividing character yourself. Default would be e.g. group1 - group2 - group3.
Use locator.php?cat.n for linking to a category, where n is the category id. E.g. locator.php?cat.1, shows all locations of category 1.
Use locator.php?cnt.n for linking to a country, where n is country id. E.g. locator.php?cnt.138, shows all locations of The Netherlands.
Use locator.php?cty.n for linking to a city, where n is the city name. E.g. locator.php?cty.London, shows all locations in London.
Use locator.php?zip.n for linking to a (part of) zip code. The length of the zip code parameter n must equal the settings (default = 1). E.g. locator.php?zip.8, shows all locations where zip code starts with 8.
Also new are the settings: 'Display group list only' which enables you to suppress the complete list. If 'Show tooltips' is switched on it displays the description of the location when hovering the mouse pointer over the location.
Finally 'Input coordinates (latitude, longitude)' will enable you to input latitude and longtitude at locations. If both the latitude and longitude are filled in, the external google map link behind the location, as well as the embedded Google Map will display the marker based on the coordinates you have put in. In all other cases, the location will be based on the address data.
It is also possible to paginate, you can also define what the number of locations per page should be. Note: if all to be displayed locations fit on one page the paging will be suppressed. The paginate setting will have effect on the admin tool for locations (admin_locations.php) and the location presentation for your visitors (locator.php). The pagination can be applied without or without groupings. E.g. use locator.php?p.3 to link to page 3, but use locator.php.cat.3.2 to go to page 2 of category list 3.

RC5 contains the bugfix for pagination without groups.

Locator v1.0 has a bugfix on the caching; instead of unique cache file per user there is only one cache file per location created.
It also contains an automatic upgrade of the database to store opening times per location, and a class based category.
The class based category allows you to hide or show certain categories. In previous versions, the setting of an active category was not relevant; now only active categories are shown and the user must belong to a user class that is entitled to view the category.
After installing v1.0 by overwriting all files of a previous Locator RCx; go to the Plugin Manager, find Locator plugin, press Upgrade and you're done.
The setting "Suppress column 'Order online'" is introduced; even if field URL1 is filled in; it won't be shown in the location list.
There is a new setting 'Location submission user class'; set default to 'No one (inactive)'. By setting this class you determine which user class is allowed to enter new locations. For users who are member of the class a new link 'Submit new location' will be presented at the right top of the locator.php page. Submitted locations must be approved by the administrator of the site.


Important background information
================================
The menu 'Locations' (admin_locations.php) will only be visible if at least one active country AND one active category have been specified.
At the locator settings the locator title field can be filled in. This title will be displayed on the locator page that is shown to your visitors (locator.php).
Default sort order; you can define in 'Maintain locations' your own order. You can choose from the following order sortings: 'Your specified order', locator ID, zip code, client name, category ID.
Print total header gives you control over the header; if this is 'Yes' a total number of all locations is printed on the locator page that is shown to your visitors (locator.php).
With the maptype you can control the type of link: choose between Google maps or Mapquest.
In case you selected Mapquest you can also define the default Mapquest zoom factor. In case you leave the field empty or define an invalid value the default zoom factor of 9 will be used.

Including the Google Map on your page can seriously slow down the page load if you have a lot of locations. From a user perspective, there is not so much to be done about it... The plugin however has been provided of (automatically) working with cache memory for the map, also there is a paginate option and various group options. The best is to combine a limited pagination and small groups. This will lead to the best results when dealing with a large list of locations. Also you are adviced to change the default link into one of your groups, e.g. locator.php?cat.1 so that the first retrieval of locations will be directly only the locations from the first category.

What countries is geocoding available in?
The Google Maps API Geocoder can currently geocode addresses in Austria, Australia, Belgium, Brazil, Canada, The Czech Republic, Denmark, Finland, France, Germany, Hong Kong, Hungary, India, Ireland, Italy, Japan, Luxembourg, The Netherlands, New Zealand, Norway, Poland, Portugal, Singapore, Spain, Sweden, Switzerland, Taiwan, The United Kingdom, and the United States.
The accuracy of geocoded locations may vary per country.

Link for more info: [link]http://code.google.com/support/bin/answer.py?answer=62668&topic=10946[/link]


Troubleshooting
===============
In case you use Mapquest as your map type; please leave the country codes in tact. They are important in finding the right location on the map.
In case you use Google as your map type; please leave the country descriptions in tact. They are important in finding the right location on the map.
In case you use coordinates: always put them in with English decimal notations: like e.g. Latitude: 99.99999, Longtitude: 9.99999
In case you want to work with settings: 'Display group list only' it is adviced to use in Admin area > Links a specific existing group you have in use. Suppose you use activated the category group display, you could refer to locator.php?cat=1 (assuming this number exists..) as your default link. Otherwise, the first display of the locator page will display all locations. Using groups and setting display group only will give you the opportunity to speed up the initial load of the locations page.
Including the Google Map on your page can seriously slow down the page load if you have a lot of locations. You should definitively consider working with groups and the setting ''Display group list only'.

Setting up the locator plugin can become kind of 'tricky' due to the large amount of possible settings. It is possible to display groups in the maps, but display the complete list, with or without pagination. Just play around with settings 'Paginate', 'Display group list only' and 'Show group on..'. Besides, if the number of locations to be shown is less than the page length, the pagination will be suppressed (in other words: your records fit on just one page).


Changelog:
==========
Version 1.3 (released January 20, 2011):
 - admin_locations.php: fixed bug on line 519 of list of locations not showing if page setting is off; thanks ottokar

Version 1.2 (released February 9, 2010):
 * Sub-goals for release 1.2:
   - bugfix release
 * Bugs Fixed:
   - locator.php: various security improvements
   - locator.php: unicode characters in city names
   - locator.php: using 'your specified order' went wrong above 10
   - admin_locations.php: using 'your specified order' went wrong above 10
   - admin_locations.php: when working with pages changing active locations on a page whiped out the status of other pages
 * Minor Changes:
   - plugin.php: added US to country list at installation
* Known issues:
   - bugtracker #30: When in the map a location is opened; and the from or to field is filled with an address, the button to show the directions does not work. This problem is related to the theme used or it's CSS. Cause still unknown.
   - country 'US' United States of America is not included in the country list when upgrading from 1.1 or below. It can be added via 'Maintain Countries'.

Version 1.1 (released 03 September 2008):
 * Sub-goals for release 1.1:
   - bugfix release
 * New/Added Features:
   -
 * Altered Features:
   - admin_locations.php?approve: more interlinear spacing and use button style for cancel as well; thanks kroll
   - admin_openhrs.php: use button style for cancel as well; thanks kroll
 * Bugs Fixed:
   - admin_categories: removed hardcoded language field 'CLASS' from line 241; thanks kroll
   - locator_submit.php: include language file to display javascript pop-up alert properly; thanks kroll
 * Minor Changes:
   - admin_categories.php, admin_locations.php: centered the 'Actions' header
   - admin_openhrs.php: added break line before presenting the table (line 183); thanks kroll
   - plugin.php: adjusted for upgrade from 1.0 or older
 * Wishlist:
   - build in possibility to display Google Map above list or below list
 * Known bugs:
   - bugtracker #30: When in the map a location is opened; and the from or to field is filled with an address, the button to show the directions does not work. This problem is related to the theme used or it's CSS. Cause still unknown.

Version 1.0 (released 01 September 2008):
 * Sub-goals for release 1.0:
   - launch a new e107 compliant plugin
   - make plugin language independent
   - initial version
   - introduce embedded Google Maps in Locator (RC 2)
 * New/Added Features:
   - GoogleMapAPI2.5.class: added Google Map API 2.5 with modifications to use in e107 (RC 2)
   - build in possibilities to configure 'Show Google Map' (only available when Google Maps is selected) (RC 2)
   - locator.php: bugtracker #24: group functionality for Google Map API on category (RC4)
   - locator.php: bugtracker #24: group functionality for Google Map API on country (RC4)
   - locator.php: bugtracker #24: group functionality for Google Map API on city (RC4)
   - locator.php: bugtracker #24: group functionality for Google Map API on (part of) zip code (RC4)
   - locator.php: bugtracker #24: introduced display of groups only if setting is 'Yes' (RC4)
   - locator.php: introduced proper use of tooltip functionality (RC4)
   - locator.php: bugtracker #31: introduced use of looking up coordinates (Latitude, Longitude) (RC4)
   - locator.php: bugtracker #33: introduced display extra text line in info window if setting is 'Yes' (RC4)
   - locator.php: introduced pagination for large amounts of locations (RC4)
   - locator.php: show opening hours info is setting is activated (1.0)
   - locator.php: added class category functionality (1.0)
   - locator.php: bugtracker #32: added link to submit new locations for appropriate user class from Locator configuration (1.0)
   - locator_submit.php: bugtracker #32: new program for optional user submission of locations (1.0)
   - e_latest.php: bugtracker #32: new program that shows the new user submitted locations in the main admin Latest part (1.0)
   - admin_categories.php: added class category  functionality (1.0)
   - admin_categories.php: added cancel button in edit screen (1.0)
   - admin_categories_edit.php: added class category functionality (1.0)
   - admin_config.php: bugtracker #24: setting to switch group on category on/off (RC4)
   - admin_config.php: bugtracker #24: setting to switch group on country on/off (RC4)
   - admin_config.php: bugtracker #24: setting to switch group on city on/off (RC4)
   - admin_config.php: bugtracker #24: setting to determine length of city grouping (default is whole city name) (RC4)
   - admin_config.php: bugtracker #24: setting to switch group on zipcode on/off (RC4)
   - admin_config.php: bugtracker #24: setting to determine length of zipcode grouping (default = 1) (RC4)
   - admin_config.php: bugtracker #24: setting to determine divide character between groups (default = -) (RC4)
   - admin_config.php: bugtracker #24: setting to display group list only (RC4)
   - admin_config.php: setting to determine showing tooltips when hovering over locations (RC4)
   - admin_config.php: bugtracker #31: setting to display coordinates (RC4)
   - admin_config.php: bugtracker #33: setting to display extra text line in info window (RC4)
   - admin_config.php: setting to switch pagination on/off (RC4)
   - admin_config.php: setting to set number of locations per page (RC4)
   - admin_config.php: sorting method on city (RC4)
   - admin_config.php: new setting to 'suppress input coordindates in info window' (RC6)
   - admin_config.php: new setting to 'Suppress column "Order online"' (1.0)
   - admin_config.php: new setting to 'Display opening hours in info window ' (1.0)
   - admin_config.php: new setting 'Location submission user class' to define user class that is allowed to add new locations (1.0)
   - admin_locations.php: bugtracker #31: introduced fields for latitude and longitude if setting for coordinates is Yes (RC4)
   - admin_locations.php: introduced pagination for large amounts of locations (RC4)
   - admin_locations_edit.php: returns after editing to the page where it came from (RC6)
   - admin_openhrs.php: new program to maintain opening hours of locations (1.0)
   - e_search.php: introduced integrated e107 search (1.0)
 * Altered Features:
   - GoogleMapAPI.2.5.class: adjusted for e107 caching (RC4); thanks bugrain
   - admin_categories: bugtracker #27: adjusted new and edit category form with active checkbox (RC4)
   - admin_categories_edit: bugtracker #27: adjusted new and edit locator category database saving with active checkbox (RC4)
   - admin_countries: bugtracker #27: adjusted new and edit country form with active checkbox (RC4)
   - admin_countries_edit: bugtracker #27: adjusted new and edit locator country database saving with active checkbox (RC4)
   - admin_locations: bugtracker #27: adjusted new and edit location form with active checkbox (RC4)
   - admin_locations_edit: bugtracker #27: adjusted new and edit locator location database saving with active checkbox (RC4)
 * Bugs Fixed:
   - GoogleMapAPI2.5.class: fixed bug for setting GLatLngBounds in local formatting (RC3)
   - GoogleMapAPI2.5.class: fixed bug for displaying tooltips properly (RC4)
   - GoogleMapAPI2.5.class: bugfix for displaying within e107 table rendering (RC6)
   - GoogleMapAPI.2.5.class: bugfix for exploding e107 caching (1.0); thanks bugrain/steved
   - admin_categories_edit: bugtracker #26: changed way storing interval intval($tp->toDB($_POST['locator_test_integer'])) (RC4)
   - admin_config: bugtracker #25: changed Google Map API field from size 125 to size 50 (for small resolution screens) (RC4)
   - admin_locations: bugtracker #29: changed sorting order for add locations form (RC4)
   - in all programs: fixed language file retrieval method (RC4)
   - locator.php: in case city if not filled in the description of the sidebar equals the location name (RC4)
   - locator.php: bugfix on pagination without groups (RC5)
   - locator.php: bugfix on short open tag <? changed into <?php (see: http://nl2.php.net/manual/en/ini.core.php) (RC6)
   - locator.php: bugfix when users are putting HTML or BBcode in the fields 'Location' or 'Additional info window text' (RC6)
   - locator.php: bugfix for displaying Google Map within e107 table rendering (RC6)
   - locator.php: bugfixes for when showing groups: only the active records are selected (RC6)
   - locator.php: bugfixes for column span of groups underneath Google map (RC7)
   - locator.php: bugfixes for displaying correct divide character for pagination (RC7)
   - locator.php: bugfix on line 233 to add a break (thanks to kroll) (1.0)
 * Minor Changes:
   - locator_sql.php: deleted specification DEFAULT CHARSET=latin1 ; it caused in at least one instance install problems (RC4)
   - locator_sql.php: added shop opening hours fields to table locator_sites (1.0)
   - plugin.php: made language independent (RC4)
   - plugin.php: update for additional opening hours fields to table locator_sites (1.0)
   - plugin.php: update for category class to table locator_cat (1.0)
   - Dutch.php: replaced special characters in Dutch language file with correct HTML (RC7)
   - logo files logo_16.png and logo_32.png replaced (1.0)
 * Wishlist:
   - build in possibility to display Google Map above list or below list
   - bugtracker #32: User submission of locations
 * Known bugs:
   - bugtracker #30: When in the map a location is opened; and the from or to field is filled with an address, the button to show the directions does not work. This problem is related to the theme used or it's CSS. Cause still unknown.


Future roadmap
==============
* actually monitor the buglist on [link=external=http://e107.webstartinternet.com]e107.webstartinternet.com[/link]
* monitor what features end users want


License
=======
Locator is distributed as free open source code released under the terms and conditions of the [link=external=http://gnu.org/]GNU General Public License[/link].