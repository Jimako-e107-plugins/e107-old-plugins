<?php
/*
+------------------------------------------------------------------------------+
| Locator - a plugin by nlstart
|
|	Plugin Support Site: e107.webstartinternet.com
|
|	For the e107 website system visit http://e107.org
|
|	Released under the terms and conditions of the
|	GNU General Public License (http://gnu.org).
+------------------------------------------------------------------------------+
*/

define("LOCATOR_DESC", "An e107 Locator Plugin.");

// module admin_menu.php
define("LOCATOR_MENU_00", "Locator Options");
define("LOCATOR_MENU_01", "Locator Settings");
define("LOCATOR_MENU_02", "Maintain Countries");
define("LOCATOR_MENU_03", "Maintain Categories");
define("LOCATOR_MENU_04", "Maintain Locations");
define("LOCATOR_MENU_05", "Opening Hours");
define("LOCATOR_MENU_06", "Approve locations");
define("LOCATOR_MENU_07", "*");
define("LOCATOR_MENU_08", "*");
define("LOCATOR_MENU_09", "Readme");
define("LOCATOR_MENU_10", "Support this plugin");
define("LOCATOR_MENU_11", "Please make an online donation today here");

// module admin_config.php
define("LOCATOR_CONF_00", "Locator Configuration");
define("LOCATOR_CONF_01", "Maintain Locator Settings");
define("LOCATOR_CONF_02", "Locator Title field");
define("LOCATOR_CONF_03", "Locator Image Directory");
define("LOCATOR_CONF_04", "Help text for Image directory: remind the trailing slash!");
define("LOCATOR_CONF_05", "Default Sort Order");
define("LOCATOR_CONF_06", "Your specified order");
define("LOCATOR_CONF_07", "Locator ID");
define("LOCATOR_CONF_08", "Zip code");
define("LOCATOR_CONF_09", "Location name");
define("LOCATOR_CONF_10", "Category ID");
define("LOCATOR_CONF_11", "Apply Changes");
define("LOCATOR_CONF_12", "Your settings have been saved.");
define("LOCATOR_CONF_13", "Print total header?");
define("LOCATOR_CONF_14", "Yes");
define("LOCATOR_CONF_15", "No");
define("LOCATOR_CONF_16", "Map type");
define("LOCATOR_CONF_17", "Google Maps");
define("LOCATOR_CONF_18", "MapQuest");
define("LOCATOR_CONF_19", "MapQuest zoom factor (1-11)<br/>(default when empty = 9)");
define("LOCATOR_CONF_20", "Google Maps API key");
define("LOCATOR_CONF_21", "Get your free Google Maps API key");
define("LOCATOR_CONF_22", "Filling in the Google Maps API key will embed a Google Map on your page. It will also give you access to a lot of configuration settings.<br />Not filling in the Google Maps API key will still display links to Google Maps.");
define("LOCATOR_CONF_23", "Show Map control (zoom/move/center)");
define("LOCATOR_CONF_24", "On");
define("LOCATOR_CONF_25", "Off");
define("LOCATOR_CONF_26", "Map control type");
define("LOCATOR_CONF_27", "Large (show move/center/zoom controls)");
define("LOCATOR_CONF_28", "Small (show move/center controls)");
define("LOCATOR_CONF_29", "Show Map type choice (map/satellite/hybrid)");
define("LOCATOR_CONF_30", "Map type default");
define("LOCATOR_CONF_31", "Normal map");
define("LOCATOR_CONF_32", "Satellite map");
define("LOCATOR_CONF_33", "Hybrid map");
define("LOCATOR_CONF_34", "Map scale control");
define("LOCATOR_CONF_35", "Map width (in pixels, default: 500)");
define("LOCATOR_CONF_36", "Map height (in pixels, default: 500)");
define("LOCATOR_CONF_37", "Map side bar<br />Having a long list of locations?<br/>Advice: set this Off");
define("LOCATOR_CONF_38", "Show info window on click on location");
define("LOCATOR_CONF_39", "Show map directions inside info window");
define("LOCATOR_CONF_40", "Grouping divide character <br />Default value is '-' if left blank");
define("LOCATOR_CONF_41", "Show group on category");
define("LOCATOR_CONF_42", "Show group on country");
define("LOCATOR_CONF_43", "Show group on city");
define("LOCATOR_CONF_44", "Show group on zip code");
define("LOCATOR_CONF_45", "Zip code group length <br />Default value is 1 if left blank");
define("LOCATOR_CONF_46", "Display extra text line in info window");
define("LOCATOR_CONF_47", "Display group list only");
define("LOCATOR_CONF_48", "Show tooltips");
define("LOCATOR_CONF_49", "Input coordinates (latitude, longitude)");
define("LOCATOR_CONF_50", "Paginate");
define("LOCATOR_CONF_51", "Number of locations per page");
define("LOCATOR_CONF_52", "You have a lot of active locations; consider this option!");
define("LOCATOR_CONF_53", "City"); // Extra default sort order
define("LOCATOR_CONF_54", "City group length <br />Default value is complete city name if left blank");
define("LOCATOR_CONF_55", "Suppress input coordindates in info window");
define("LOCATOR_CONF_56", "Suppress column 'Order online'");
define("LOCATOR_CONF_57", "Display opening hours in info window");
define("LOCATOR_CONF_58", "Location submission user class");

// module admin_countries.php
define("LOCATOR_COU_00", "Maintain Countries");
define("LOCATOR_COU_01", "Maintain Locator Countries");
define("LOCATOR_COU_02", "No countries defined");
define("LOCATOR_COU_03", "#");
define("LOCATOR_COU_04", "Country code");
define("LOCATOR_COU_05", "Country description");
define("LOCATOR_COU_06", "Active");
define("LOCATOR_COU_07", "Actions");
define("LOCATOR_COU_08", "Edit");
define("LOCATOR_COU_09", "Delete");
define("LOCATOR_COU_10", "Apply changes");
define("LOCATOR_COU_11", "Create new country");
define("LOCATOR_COU_12", "Save new country");
define("LOCATOR_COU_13", "Change Country");
define("LOCATOR_COU_14", "Save changes");
define("LOCATOR_COU_15", "15Active");
define("LOCATOR_COU_16", "16Actions");
define("LOCATOR_COU_17", "17Change Category");
define("LOCATOR_COU_18", "18Edit");
define("LOCATOR_COU_19", "19Delete");

// module admin_countries_edit.php
define("LOCATOR_COUEDIT_01", "Delete Country");
define("LOCATOR_COUEDIT_02", "Are you sure you want to delete this country?");
define("LOCATOR_COUEDIT_03", "Yes");
define("LOCATOR_COUEDIT_04", "No");

// module admin_categories.php
define("LOCATOR_CAT_00", "Maintain Categories");
define("LOCATOR_CAT_01", "Overview Locator Categories");
define("LOCATOR_CAT_02", "No categories defined");
define("LOCATOR_CAT_03", "Create new category");
define("LOCATOR_CAT_04", "#");
define("LOCATOR_CAT_05", "Category name");
define("LOCATOR_CAT_06", "Locator Image Directory");
define("LOCATOR_CAT_07", "Help text for Image directory: remind the trailing slash!");
define("LOCATOR_CAT_08", "Test Field One");
define("LOCATOR_CAT_09", "Test Field Two");
define("LOCATOR_CAT_10", "Test Field Three");
define("LOCATOR_CAT_11", "Test Field Four");
define("LOCATOR_CAT_12", "Test Field Integer");
define("LOCATOR_CAT_13", "Apply Changes");
define("LOCATOR_CAT_14", "Sort Order");
define("LOCATOR_CAT_15", "Active");
define("LOCATOR_CAT_16", "Actions");
define("LOCATOR_CAT_17", "Change Category");
define("LOCATOR_CAT_18", "Edit");
define("LOCATOR_CAT_19", "Delete");
define("LOCATOR_CAT_20", "Category class");
define("LOCATOR_CAT_21", "Cancel");
define("LOCATOR_CAT_22", "Class");

// module admin_categories_edit.php
define("LOCATOR_CATEDIT_01", "Delete Category");
define("LOCATOR_CATEDIT_02", "Are you sure you want to delete this category?");
define("LOCATOR_CATEDIT_03", "Yes");
define("LOCATOR_CATEDIT_04", "No");

// module admin_locations.php
define("LOCATOR_LOC_00", "Maintain Locations");
define("LOCATOR_LOC_01", "Maintain Locations");
define("LOCATOR_LOC_02", "No locations defined");
define("LOCATOR_LOC_03", "Create new location");
define("LOCATOR_LOC_04", "#");
define("LOCATOR_LOC_05", "Location");
define("LOCATOR_LOC_06", "Address 1");
define("LOCATOR_LOC_07", "Category");
define("LOCATOR_LOC_08", "Zip code");
define("LOCATOR_LOC_09", "City");
//define("LOCATOR_LOC_10", "Status");
define("LOCATOR_LOC_10", "Order online");
define("LOCATOR_LOC_11", "Telephone 1");
define("LOCATOR_LOC_12", "Fax 1");
define("LOCATOR_LOC_13", "Apply Changes");
define("LOCATOR_LOC_14", "Sort Order");
define("LOCATOR_LOC_15", "Active");
define("LOCATOR_LOC_16", "Actions");
define("LOCATOR_LOC_17", "Change Location");
define("LOCATOR_LOC_18", "Edit");
define("LOCATOR_LOC_19", "Delete");
define("LOCATOR_LOC_20", "Category");
define("LOCATOR_LOC_21", "Country");
define("LOCATOR_LOC_22", "URL 1");
define("LOCATOR_LOC_23", "No");
define("LOCATOR_LOC_24", "Yes");
define("LOCATOR_LOC_25", "Additional info window text");
define("LOCATOR_LOC_26", "Latitude");
define("LOCATOR_LOC_27", "Longitude");
define("LOCATOR_LOC_28", "Page");
define("LOCATOR_LOC_29", "Approve user submitted locations");
define("LOCATOR_LOC_30", "Name");
define("LOCATOR_LOC_31", "Indicated status");
define("LOCATOR_LOC_32", "Inactive");
define("LOCATOR_LOC_33", "Submission date");
define("LOCATOR_LOC_34", "IP address");
define("LOCATOR_LOC_35", "Name");
define("LOCATOR_LOC_36", "E-mail");
define("LOCATOR_LOC_37", "Approve");
define("LOCATOR_LOC_38", "Reject");
define("LOCATOR_LOC_39", "Approve locations");
define("LOCATOR_LOC_40", "");

// module admin_locations_edit.php
define("LOCATOR_LOCEDIT_01", "Delete Location");
define("LOCATOR_LOCEDIT_02", "Are you sure you want to delete this location?");
define("LOCATOR_LOCEDIT_03", "Yes");
define("LOCATOR_LOCEDIT_04", "No");

// module admin_openhrs.php
define("LOCATOR_ADMIN_HRS_00", "Maintain Opening Hours");
define("LOCATOR_ADMIN_HRS_01", "01");
define("LOCATOR_ADMIN_HRS_02", "02");
define("LOCATOR_ADMIN_HRS_03", "03");
define("LOCATOR_ADMIN_HRS_04", "Edit");
define("LOCATOR_ADMIN_HRS_05", "Save changes");
define("LOCATOR_ADMIN_HRS_06", "Cancel");
define("LOCATOR_ADMIN_HRS_07", "Edit Opening Hours");
define("LOCATOR_ADMIN_HRS_08", "Overview Opening Hours");
define("LOCATOR_ADMIN_HRS_09", "09");
define("LOCATOR_ADMIN_HRS_10", "Location");
define("LOCATOR_ADMIN_HRS_11", "Monday");
define("LOCATOR_ADMIN_HRS_12", "Tuesday");
define("LOCATOR_ADMIN_HRS_13", "Wednesday");
define("LOCATOR_ADMIN_HRS_14", "Thursday");
define("LOCATOR_ADMIN_HRS_15", "Friday");
define("LOCATOR_ADMIN_HRS_16", "Saturday");
define("LOCATOR_ADMIN_HRS_17", "Sunday");
define("LOCATOR_ADMIN_HRS_18", "Remarks");
define("LOCATOR_ADMIN_HRS_19", "19");
define("LOCATOR_ADMIN_HRS_20", "20");
define("LOCATOR_ADMIN_HRS_21", "Location description");
define("LOCATOR_ADMIN_HRS_22", "22");
define("LOCATOR_ADMIN_HRS_23", "23");
define("LOCATOR_ADMIN_HRS_24", "24");
define("LOCATOR_ADMIN_HRS_25", "25");
define("LOCATOR_ADMIN_HRS_26", "26");
define("LOCATOR_ADMIN_HRS_27", "27");
define("LOCATOR_ADMIN_HRS_28", "28");
define("LOCATOR_ADMIN_HRS_29", "29");
define("LOCATOR_ADMIN_HRS_30", "30");
define("LOCATOR_ADMIN_HRS_31", "Options");

// module locator.php
define("LOCATOR_CORE_00", "Locator Main Module");
define("LOCATOR_CORE_01", "Locator"); // not in use
define("LOCATOR_CORE_02", "No locations found.");
define("LOCATOR_CORE_03", "Location");
define("LOCATOR_CORE_04", "Address");
define("LOCATOR_CORE_05", "Zipcode");
define("LOCATOR_CORE_06", "City");
define("LOCATOR_CORE_07", "Phone");
define("LOCATOR_CORE_08", "Fax");
//define("LOCATOR_CORE_09", "Status");
define("LOCATOR_CORE_09", "Order online");
define("LOCATOR_CORE_10", "Y");
define("LOCATOR_CORE_11", "Total number of locations:");
define("LOCATOR_CORE_12", "Click to view map");
define("LOCATOR_CORE_13", "Click here for your online order");
define("LOCATOR_CORE_14", "No zip code");
define("LOCATOR_CORE_15", "Latitude");
define("LOCATOR_CORE_16", "Longitude");
define("LOCATOR_CORE_17", "Page");
define("LOCATOR_CORE_18", "No city");
define("LOCATOR_CORE_19", "OPENING HOURS");
define("LOCATOR_CORE_20", "MONDAY");
define("LOCATOR_CORE_21", "TUESDAY");
define("LOCATOR_CORE_22", "WEDNESDAY");
define("LOCATOR_CORE_23", "THURSDAY");
define("LOCATOR_CORE_24", "FRIDAY");
define("LOCATOR_CORE_25", "SATURDAY");
define("LOCATOR_CORE_26", "SUNDAY");
define("LOCATOR_CORE_27", "REMARKS");
define("LOCATOR_CORE_28", "Submit new location");

// module locator_submit.php
define("LOCATOR_SUBM_01", "Submit location");
define("LOCATOR_SUBM_02", "Send location to admin");
define("LOCATOR_SUBM_03", "Your name");
define("LOCATOR_SUBM_04", "Your e-mail");
define("LOCATOR_SUBM_05", "Submit location result");
define("LOCATOR_SUBM_06", "Your Location has been submitted succesfully. After the administrator approves and activates your location it will become visible.");
define("LOCATOR_SUBM_07", "Location field is mandatory");
define("LOCATOR_SUBM_08", "Return to Locator page");

// module e_latest.php
define("LOCATOR_LATEST_01", "Submitted locations");

// module GoogleMapAPI.2.5.class.php
define("LOCATOR_CLASS_01", "Sorry, the Google Maps API is not compatible with this browser.");
define("LOCATOR_CLASS_02", "<b>If you enable use of Javascript in your browser you will see Google Maps.</b>");
define("LOCATOR_CLASS_03", "Start address: (include addr, city st/region)");
define("LOCATOR_CLASS_04", "Get Directions");
define("LOCATOR_CLASS_05", "submit"); // to button
define("LOCATOR_CLASS_06", "End address: (include addr, city st/region)");
define("LOCATOR_CLASS_07", "Get Directions");
define("LOCATOR_CLASS_08", "submit"); // from button
define("LOCATOR_CLASS_09", "Directions: ");
define("LOCATOR_CLASS_10", "To here");
define("LOCATOR_CLASS_11", "From here");

// module help.php
define("LOCATOR_ADMIN_HELP_00", "Locator Help");
define("LOCATOR_ADMIN_HELP_01", "General Preferences");
define("LOCATOR_ADMIN_HELP_02", "Manage your Locator settings. Give in your locator title that will be displayed to your visitors. Choose your map type; Google or Mapquest. If you fill in the Google Maps API key an embedded map will be displayed. Also a lot of additional settings for this embedded Google Map can be defined.");
define("LOCATOR_ADMIN_HELP_03", "Maintain Countries");
define("LOCATOR_ADMIN_HELP_04", "Maintain the Locator countries.<br/>Please note you will be able only to select from active countries.");
define("LOCATOR_ADMIN_HELP_05", "Maintain Categories");
define("LOCATOR_ADMIN_HELP_06", "Maintain your Locator categories.<br />Please note you will be able only to select from active categories.");
define("LOCATOR_ADMIN_HELP_07", "Maintain Locations");
define("LOCATOR_ADMIN_HELP_08", "Maintain your Locations.<br/>This menu will be displayed if you have at least one active category. The location sorting is dependent on the settings in General Preferences. Only active locations will be shown on the locator page.");
define("LOCATOR_ADMIN_HELP_90", "ReadMe.txt");  // also used in admin_readme.php
define("LOCATOR_ADMIN_HELP_91", "View the Readme text file for detailed release information and version history.<br/><br/>For additional help on this plugin view the <a href='http://wiki.e107.org/?title=Locator'>e107 Wiki pages</a>.");
define("LOCATOR_ADMIN_HELP_99", "readme.txt"); // actual helpfile called by admin_readme.php to allow for multi-langual helpfiles

// module plugin.php
define("LOCATOR_LAN_URL", "http://e107.webstartinternet.com/");
define("LOCATOR_LAN_DESCR", "A e107 locator plugin.");
define("LOCATOR_LAN_CAPTION", "Configure Locator");
define("LOCATOR_LAN_LINK_NAME", "Locator");
define("LOCATOR_LAN_DONE1", "Installation");
define("LOCATOR_LAN_DONE2", "successful.");
define("LOCATOR_LAN_UPGRADE", "Thank you for upgrading");
define("LOCATOR_LAN_FROM", "from");
define("LOCATOR_LAN_TO", "to");
?>