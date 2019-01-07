<?php
/*
+---------------------------------------------------------------+
|        Plugin: Advanced Bbcodes
|        Version: 0.4
|        Date: 12/01/2009
|        Author: The_Death_Raw 
|        Email: postmaster@e107plugins.fr
|        Website: www.e107plugins.fr
|
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
+---------------------------------------------------------------+
*/

// plugin.php and stats_menu.php
define("LAN_ADVANCED_BBCODES_NOM",                       "Advanced BBcodes");
define("LAN_ADVANCED_BBCODES_CONFIG",                    "Configure Advanced BBcodes v0.4");
define("LAN_ADVANCED_BBCODES_DESCR",                     "Can install new bbcodes in your e107 website.<br />Created for e107 bye The_Death_Raw - <a href='http://www.e107plugins.fr' target='_blank'>www.e107plugins.fr</a>.");

// bbcodes
define("LAN_ADVANCED_BBCODES_STRIKE",                    "Strikethrough text: [strike]Text[/strike]");
define("LAN_ADVANCED_BBCODES_HIDE",                      "Text hide: [hide]Part of the text to hide[/hide]");
define("LAN_ADVANCED_BBCODES_HIDE_TEXTE",                "HIDDEN - YOU MUST BE LOGGED TO SEE");
define("LAN_ADVANCED_BBCODES_LIGNE",                     "Can make a horizontal line: [ligne][/ligne]");
define("LAN_ADVANCED_BBCODES_GVIDEO",                    "Add a GoogleVideo video: [gvideo]http://video.google.com/videoplay?docid=xxxxxxxxxx[/gvideo]");
define("LAN_ADVANCED_BBCODES_YOUTUBE",                   "Add a Youtube youtube: [youtube]http://www.youtube.com/watch?v=xxxxxxxxxx[/youtube]");
define("LAN_ADVANCED_BBCODES_DAILYMOTION",               "Add a Dailymotion video: [dailymotion]http://www.dailymotion.com/swf/xxxxxxxxxx[/dailymotion]");
define("LAN_ADVANCED_BBCODES_METACAFE",                  "Add a MetaCafe video: [metacafe]http://www.metacafe.com/fplayer/xxxxxxx/xxxxxxxxxx[/metacafe]");
define("LAN_ADVANCED_BBCODES_ACRONYM",                   "Use a tag Acronym: [acronym=Definition]Text[/acronym]");
define("LAN_ADVANCED_BBCODES_ACRONYM_ON",                "[acronym=Definition]Texte[/acronym]");
define("LAN_ADVANCED_BBCODES_MP3",                       "Play an mp3 music: [mp3]URL of the mp3 file[/mp3]");
define("LAN_ADVANCED_BBCODES_PARCHEMIN",                 "Text role play: [parchemin]Text[/parchemin]");
define("LAN_ADVANCED_BBCODES_TOOLFAQ",                   "ToolFaq displays a special tooltip with mouse: [toolfaq]Text[/toolfaq]");
define("LAN_ADVANCED_BBCODES_ROLLER",                    "Deformation of the text: [roller]Text[/roller]");
define("LAN_ADVANCED_BBCODES_SPOILER",                   "The Spoiler helps to reduce and view an item via a small button: [sp=About spoiler]Text[/sp]");
define("LAN_ADVANCED_BBCODES_SPOILER_SHOW",              "Show");
define("LAN_ADVANCED_BBCODES_SPOILER_HIDE",              "Hide");

// admin_prefs.php
define("LAN_ADVANCED_BBCODES_PREFERENCES",               "Advanced BBcodes - Preferences");
define("LAN_ADVANCED_BBCODES_STRIKE_ADMIN",              "<img src='".e_PLUGIN."advanced_bbcodes/images/bbcodes/icon_strike.png' style='width: 22px; height: 22px; vertical-align: bottom' alt='' /> Use Strike bbcode?");
define("LAN_ADVANCED_BBCODES_HIDE_ADMIN",                "<img src='".e_PLUGIN."advanced_bbcodes/images/bbcodes/icon_hide.png' style='width: 22px; height: 22px; vertical-align: bottom' alt='' /> Use Hide bbcode?");
define("LAN_ADVANCED_BBCODES_LIGNE_ADMIN",               "<img src='".e_PLUGIN."advanced_bbcodes/images/bbcodes/icon_hr.png' style='width: 22px; height: 22px; vertical-align: bottom' alt='' /> Use Ligne bbcode?");
define("LAN_ADVANCED_BBCODES_GVIDEO_ADMIN",              "<img src='".e_PLUGIN."advanced_bbcodes/images/bbcodes/icon_gvideo.png' style='width: 22px; height: 22px; vertical-align: bottom' alt='' /> Use GoogleVideo bbcode?");
define("LAN_ADVANCED_BBCODES_YOUTUBE_ADMIN",             "<img src='".e_PLUGIN."advanced_bbcodes/images/bbcodes/icon_youtube.png' style='width: 22px; height: 22px; vertical-align: bottom' alt='' /> Use Youtube bbcode?");
define("LAN_ADVANCED_BBCODES_DAILYMOTION_ADMIN",         "<img src='".e_PLUGIN."advanced_bbcodes/images/bbcodes/icon_dailymotion.png' style='width: 22px; height: 22px; vertical-align: bottom' alt='' /> Use Dailymotion bbcode?");
define("LAN_ADVANCED_BBCODES_METACAFE_ADMIN",            "<img src='".e_PLUGIN."advanced_bbcodes/images/bbcodes/icon_metacafe.png' style='width: 22px; height: 22px; vertical-align: bottom' alt='' /> Use MetaCafe bbcode?");
define("LAN_ADVANCED_BBCODES_ACRONYM_ADMIN",             "<img src='".e_PLUGIN."advanced_bbcodes/images/bbcodes/icon_acronym.png' style='width: 22px; height: 22px; vertical-align: bottom' alt='' /> Use Acronym bbcode?");
define("LAN_ADVANCED_BBCODES_MP3_ADMIN",                 "<img src='".e_PLUGIN."advanced_bbcodes/images/bbcodes/icon_mplayer.png' style='width: 22px; height: 22px; vertical-align: bottom' alt='' /> Use Mp3 Player bbcode?");
define("LAN_ADVANCED_BBCODES_PARCHEMIN_ADMIN",           "<img src='".e_PLUGIN."advanced_bbcodes/images/bbcodes/icon_parchemin.png' style='width: 22px; height: 22px; vertical-align: bottom' alt='' /> Use Parchemin bbcode?");
define("LAN_ADVANCED_BBCODES_SPOILER_ADMIN",             "<img src='".e_PLUGIN."advanced_bbcodes/images/bbcodes/icon_spoiler.png' style='width: 22px; height: 22px; vertical-align: bottom' alt='' /> Use Spoiler bbcode?");
define("LAN_ADVANCED_BBCODES_TOOLFAQ_ADMIN",             "<img src='".e_PLUGIN."advanced_bbcodes/images/bbcodes/icon_toolfaq.png' style='width: 22px; height: 22px; vertical-align: bottom' alt='' /> Use ToolFaq bbcode?");
define("LAN_ADVANCED_BBCODES_ROLLER_ADMIN",              "<img src='".e_PLUGIN."advanced_bbcodes/images/bbcodes/icon_roller.png' style='width: 22px; height: 22px; vertical-align: bottom' alt='' /> Use Roller bbcode?");

// admin_prefs_affichage
define("LAN_ADVANCED_BBCODES_PREFS_AFFICHAGE",           "Advanced BBcodes - Viewing Preferences");
define("LAN_ADVANCED_BBCODES_PREFS_LIGNE_NEWS",          "<img src='".e_PLUGIN."advanced_bbcodes/images/bbcodes/icon_hr.png' style='width: 22px; height: 22px; vertical-align: bottom' alt='' /> Show the bbcode Line only in the news and proposal news?");
define("LAN_ADVANCED_BBCODES_PREFS_HIDE_NEWS",           "<img src='".e_PLUGIN."advanced_bbcodes/images/bbcodes/icon_hide.png' style='width: 22px; height: 22px; vertical-align: bottom' alt='' /> Show the bbcode Hide only in the news and proposal news?");
define("LAN_ADVANCED_BBCODES_PREFS_STRIKE_NEWS",         "<img src='".e_PLUGIN."advanced_bbcodes/images/bbcodes/icon_strike.png' style='width: 22px; height: 22px; vertical-align: bottom' alt='' /> Show the bbcode Strike only in the news and proposal news?");
define("LAN_ADVANCED_BBCODES_PREFS_GVIDEO_NEWS",         "<img src='".e_PLUGIN."advanced_bbcodes/images/bbcodes/icon_gvideo.png' style='width: 22px; height: 22px; vertical-align: bottom' alt='' /> Show the bbcode GoogleVideo only in the news and proposal news?");
define("LAN_ADVANCED_BBCODES_PREFS_YOUTUBE_NEWS",        "<img src='".e_PLUGIN."advanced_bbcodes/images/bbcodes/icon_youtube.png' style='width: 22px; height: 22px; vertical-align: bottom' alt='' /> Show the bbcode Youtube only in the news and proposal news?");
define("LAN_ADVANCED_BBCODES_PREFS_DAILYMOTION_NEWS",    "<img src='".e_PLUGIN."advanced_bbcodes/images/bbcodes/icon_dailymotion.png' style='width: 22px; height: 22px; vertical-align: bottom' alt='' /> Show the bbcode Dailymotion only in the news and proposal news?");
define("LAN_ADVANCED_BBCODES_PREFS_METACAFE_NEWS",       "<img src='".e_PLUGIN."advanced_bbcodes/images/bbcodes/icon_metacafe.png' style='width: 22px; height: 22px; vertical-align: bottom' alt='' /> Show the bbcode MetaCafe only in the news and proposal news?");
define("LAN_ADVANCED_BBCODES_PREFS_ACRONYM_NEWS",        "<img src='".e_PLUGIN."advanced_bbcodes/images/bbcodes/icon_acronym.png' style='width: 22px; height: 22px; vertical-align: bottom' alt='' /> Show the bbcode Acronym only in the news and proposal news?");
define("LAN_ADVANCED_BBCODES_PREFS_MP3_NEWS",            "<img src='".e_PLUGIN."advanced_bbcodes/images/bbcodes/icon_mplayer.png' style='width: 22px; height: 22px; vertical-align: bottom' alt='' /> Show the bbcode Lecteur mp3 only in the news and proposal news?");
define("LAN_ADVANCED_BBCODES_PREFS_PARCHEMIN_NEWS",      "<img src='".e_PLUGIN."advanced_bbcodes/images/bbcodes/icon_parchemin.png' style='width: 22px; height: 22px; vertical-align: bottom' alt='' /> Show the bbcode Parchemin only in the news and proposal news?");
define("LAN_ADVANCED_BBCODES_PREFS_SPOILER_NEWS",        "<img src='".e_PLUGIN."advanced_bbcodes/images/bbcodes/icon_spoiler.png' style='width: 22px; height: 22px; vertical-align: bottom' alt='' /> Show the bbcode Spoiler only in the news and proposal news?");
define("LAN_ADVANCED_BBCODES_PREFS_TOOLFAQ_NEWS",        "<img src='".e_PLUGIN."advanced_bbcodes/images/bbcodes/icon_toolfaq.png' style='width: 22px; height: 22px; vertical-align: bottom' alt='' /> Show the bbcode ToolFaq only in the news and proposal news?");
define("LAN_ADVANCED_BBCODES_PREFS_ROLLER_NEWS",         "<img src='".e_PLUGIN."advanced_bbcodes/images/bbcodes/icon_roller.png' style='width: 22px; height: 22px; vertical-align: bottom' alt='' /> Show the bbcode Roller only in the news and proposal news?");

// save and booléen
define("LAN_ADVANCED_BBCODES_YES",                       "Yes");
define("LAN_ADVANCED_BBCODES_NO",                        "No");
define("LAN_ADVANCED_BBCODES_ADMIN_SAVE",                "Save");
define("LAN_ADVANCED_BBCODES_ADMIN_SAVE_TITLE",          "Clik to save your preferences");

// installation
define("LAN_ADVANCED_BBCODES_DONE1",                     "The plugin:");
define("LAN_ADVANCED_BBCODES_DONE2",                     "in version");
define("LAN_ADVANCED_BBCODES_DONE3",                     "was to perform successfully...");

// form_handler.php
define("ADVANCED_BBCODES_CHECKBOX",                      "Tick this case to select this option");

// help.php
define("ADVANCED_BBCODES_TITRE",                         "About Advanced BBcodes");
define("ADVANCED_BBCODES_HELP01",                        "Advanced BBcode v0.4");
define("ADVANCED_BBCODES_HELP02",                        "Was created by The_Death_Raw for e107");
define("ADVANCED_BBCODES_HELPLINK",                      "<a href='http://www.e107plugins.fr' target='_blank' title='e107plugins.fr'><img src='".e_PLUGIN."advanced_bbcodes/images/e107plugins.png' alt='e107plugins.fr' style='border:0px' /><br />www.e107plugins.fr</a>");

// admin_menu.php
define("LAN_ADVANCED_BBCODES_ADMIN_MENU_00",             "Preferences");
define("LAN_ADVANCED_BBCODES_ADMIN_MENU_01",             "View");

?>