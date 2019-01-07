<?php
/*
+---------------------------------------------------------------+
|        Plugin: Advanced Bbcodes
|        Version: 0.4
|        Date: 12/01/2009
|        Auteur: The_Death_Raw 
|        Email: postmaster@e107plugins.fr
|        Website: www.e107plugins.fr
|
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
+---------------------------------------------------------------+
*/

// plugin.php et stats_menu.php
define("LAN_ADVANCED_BBCODES_NOM",                       "Advanced BBcodes");
define("LAN_ADVANCED_BBCODES_CONFIG",                    "Configurer Advanced BBcodes v0.4");
define("LAN_ADVANCED_BBCODES_DESCR",                     "Permet d'installer 13 nouveaux bbcodes a votre site e107.<br />Cr&eacute;er pour e107 par The_Death_Raw - <a href='http://www.e107plugins.fr' target='_blank'>www.e107plugins.fr</a>.");

// bbcodes
define("LAN_ADVANCED_BBCODES_STRIKE",                    "Texte barr&eacute;: [strike]Texte[/strike]");
define("LAN_ADVANCED_BBCODES_HIDE",                      "Texte cacher: [hide]Partie du texte a cacher[/hide]");
define("LAN_ADVANCED_BBCODES_HIDE_TEXTE",                "CACH&Eacute; - VOUS DEVEZ &Ecirc;TRE CONNECT&Eacute; POUR VOIR");
define("LAN_ADVANCED_BBCODES_LIGNE",                     "Permet de faire une ligne horizontale: [ligne][/ligne]");
define("LAN_ADVANCED_BBCODES_GVIDEO",                    "Ajouter une vid&eacute;o GoogleVideo: [gvideo]http://video.google.com/videoplay?docid=xxxxxxxxxx[/gvideo]");
define("LAN_ADVANCED_BBCODES_YOUTUBE",                   "Ajouter une vid&eacute;o Youtube: [youtube]http://www.youtube.com/watch?v=xxxxxxxxxx[/youtube]");
define("LAN_ADVANCED_BBCODES_DAILYMOTION",               "Ajouter une vid&eacute;o Dailymotion: [dailymotion]http://www.dailymotion.com/swf/xxxxxxxxxx[/dailymotion]");
define("LAN_ADVANCED_BBCODES_METACAFE",                  "Ajouter une vid&eacute;o MetaCafe: [metacafe]http://www.metacafe.com/fplayer/xxxxxxx/xxxxxxxxxx[/metacafe]");
define("LAN_ADVANCED_BBCODES_ACRONYM",                   "Utiliser une balise Acronym: [acronym=D&eacute;finition]Texte[/acronym]");
define("LAN_ADVANCED_BBCODES_ACRONYM_ON",                "[acronym=D&eacute;finition]Texte[/acronym]");
define("LAN_ADVANCED_BBCODES_MP3",                       "Jouer un musique mp3: [mp3]URL du fichier mp3[/mp3]");
define("LAN_ADVANCED_BBCODES_PARCHEMIN",                 "Texte r&ocirc;le play: [parchemin]Texte[/parchemin]");
define("LAN_ADVANCED_BBCODES_TOOLFAQ",                   "ToolFaq affiche une infobulle special au passage de la souris: [toolfaq]Texte[/toolfaq]");
define("LAN_ADVANCED_BBCODES_ROLLER",                    "D&eacute;formation du texte: [roller]Texte[/roller]");
define("LAN_ADVANCED_BBCODES_SPOILER",                   "Le Spoiler permet de reduire et afficher un &eacute;l&eacute;ment via un petit bouton: [sp=Sujet du spoiler]Texte[/sp]");
define("LAN_ADVANCED_BBCODES_SPOILER_SHOW",              "Afficher");
define("LAN_ADVANCED_BBCODES_SPOILER_HIDE",              "Reduire");

// admin_prefs.php
define("LAN_ADVANCED_BBCODES_PREFERENCES",               "Advanced BBcodes - Pr&eacute;f&eacute;rences");
define("LAN_ADVANCED_BBCODES_STRIKE_ADMIN",              "<img src='".e_PLUGIN."advanced_bbcodes/images/bbcodes/icon_strike.png' style='width: 22px; height: 22px; vertical-align: bottom' alt='' /> Utiliser le bbcode Strike?");
define("LAN_ADVANCED_BBCODES_HIDE_ADMIN",                "<img src='".e_PLUGIN."advanced_bbcodes/images/bbcodes/icon_hide.png' style='width: 22px; height: 22px; vertical-align: bottom' alt='' /> Utiliser le bbcode Hide?");
define("LAN_ADVANCED_BBCODES_LIGNE_ADMIN",               "<img src='".e_PLUGIN."advanced_bbcodes/images/bbcodes/icon_hr.png' style='width: 22px; height: 22px; vertical-align: bottom' alt='' /> Utiliser le bbcode Ligne?");
define("LAN_ADVANCED_BBCODES_GVIDEO_ADMIN",              "<img src='".e_PLUGIN."advanced_bbcodes/images/bbcodes/icon_gvideo.png' style='width: 22px; height: 22px; vertical-align: bottom' alt='' /> Utiliser le bbcode GoogleVideo?");
define("LAN_ADVANCED_BBCODES_YOUTUBE_ADMIN",             "<img src='".e_PLUGIN."advanced_bbcodes/images/bbcodes/icon_youtube.png' style='width: 22px; height: 22px; vertical-align: bottom' alt='' /> Utiliser le bbcode Youtube?");
define("LAN_ADVANCED_BBCODES_DAILYMOTION_ADMIN",         "<img src='".e_PLUGIN."advanced_bbcodes/images/bbcodes/icon_dailymotion.png' style='width: 22px; height: 22px; vertical-align: bottom' alt='' /> Utiliser le bbcode Dailymotion?");
define("LAN_ADVANCED_BBCODES_METACAFE_ADMIN",            "<img src='".e_PLUGIN."advanced_bbcodes/images/bbcodes/icon_metacafe.png' style='width: 22px; height: 22px; vertical-align: bottom' alt='' /> Utiliser le bbcode MetaCafe?");
define("LAN_ADVANCED_BBCODES_ACRONYM_ADMIN",             "<img src='".e_PLUGIN."advanced_bbcodes/images/bbcodes/icon_acronym.png' style='width: 22px; height: 22px; vertical-align: bottom' alt='' /> Utiliser le bbcode Acronym?");
define("LAN_ADVANCED_BBCODES_MP3_ADMIN",                 "<img src='".e_PLUGIN."advanced_bbcodes/images/bbcodes/icon_mplayer.png' style='width: 22px; height: 22px; vertical-align: bottom' alt='' /> Utiliser le bbcode Lecteur mp3?");
define("LAN_ADVANCED_BBCODES_PARCHEMIN_ADMIN",           "<img src='".e_PLUGIN."advanced_bbcodes/images/bbcodes/icon_parchemin.png' style='width: 22px; height: 22px; vertical-align: bottom' alt='' /> Utiliser le bbcode Parchemin?");
define("LAN_ADVANCED_BBCODES_SPOILER_ADMIN",             "<img src='".e_PLUGIN."advanced_bbcodes/images/bbcodes/icon_spoiler.png' style='width: 22px; height: 22px; vertical-align: bottom' alt='' /> Utiliser le bbcode Spoiler?");
define("LAN_ADVANCED_BBCODES_TOOLFAQ_ADMIN",             "<img src='".e_PLUGIN."advanced_bbcodes/images/bbcodes/icon_toolfaq.png' style='width: 22px; height: 22px; vertical-align: bottom' alt='' /> Utiliser le bbcode ToolFaq?");
define("LAN_ADVANCED_BBCODES_ROLLER_ADMIN",              "<img src='".e_PLUGIN."advanced_bbcodes/images/bbcodes/icon_roller.png' style='width: 22px; height: 22px; vertical-align: bottom' alt='' /> Utiliser le bbcode Roller?");

// admin_prefs_affichage
define("LAN_ADVANCED_BBCODES_PREFS_AFFICHAGE",           "Advanced BBcodes - Pr&eacute;f&eacute;rences Affichage");
define("LAN_ADVANCED_BBCODES_PREFS_LIGNE_NEWS",          "<img src='".e_PLUGIN."advanced_bbcodes/images/bbcodes/icon_hr.png' style='width: 22px; height: 22px; vertical-align: bottom' alt='' /> Afficher le bbcode Ligne juste dans les news et proposition de news?");
define("LAN_ADVANCED_BBCODES_PREFS_HIDE_NEWS",           "<img src='".e_PLUGIN."advanced_bbcodes/images/bbcodes/icon_hide.png' style='width: 22px; height: 22px; vertical-align: bottom' alt='' /> Afficher le bbcode Hide juste dans les news et proposition de news?");
define("LAN_ADVANCED_BBCODES_PREFS_STRIKE_NEWS",         "<img src='".e_PLUGIN."advanced_bbcodes/images/bbcodes/icon_strike.png' style='width: 22px; height: 22px; vertical-align: bottom' alt='' /> Afficher le bbcode Strike juste dans les news et proposition de news?");
define("LAN_ADVANCED_BBCODES_PREFS_GVIDEO_NEWS",         "<img src='".e_PLUGIN."advanced_bbcodes/images/bbcodes/icon_gvideo.png' style='width: 22px; height: 22px; vertical-align: bottom' alt='' /> Afficher le bbcode GoogleVideo juste dans les news et proposition de news?");
define("LAN_ADVANCED_BBCODES_PREFS_YOUTUBE_NEWS",        "<img src='".e_PLUGIN."advanced_bbcodes/images/bbcodes/icon_youtube.png' style='width: 22px; height: 22px; vertical-align: bottom' alt='' /> Afficher le bbcode Youtube juste dans les news et proposition de news?");
define("LAN_ADVANCED_BBCODES_PREFS_DAILYMOTION_NEWS",    "<img src='".e_PLUGIN."advanced_bbcodes/images/bbcodes/icon_dailymotion.png' style='width: 22px; height: 22px; vertical-align: bottom' alt='' /> Afficher le bbcode Dailymotion juste dans les news et proposition de news?");
define("LAN_ADVANCED_BBCODES_PREFS_METACAFE_NEWS",       "<img src='".e_PLUGIN."advanced_bbcodes/images/bbcodes/icon_metacafe.png' style='width: 22px; height: 22px; vertical-align: bottom' alt='' /> Afficher le bbcode MetaCafe juste dans les news et proposition de news?");
define("LAN_ADVANCED_BBCODES_PREFS_ACRONYM_NEWS",        "<img src='".e_PLUGIN."advanced_bbcodes/images/bbcodes/icon_acronym.png' style='width: 22px; height: 22px; vertical-align: bottom' alt='' /> Afficher le bbcode Acronym juste dans les news et proposition de news?");
define("LAN_ADVANCED_BBCODES_PREFS_MP3_NEWS",            "<img src='".e_PLUGIN."advanced_bbcodes/images/bbcodes/icon_mplayer.png' style='width: 22px; height: 22px; vertical-align: bottom' alt='' /> Afficher le bbcode Lecteur mp3 juste dans les news et proposition de news?");
define("LAN_ADVANCED_BBCODES_PREFS_PARCHEMIN_NEWS",      "<img src='".e_PLUGIN."advanced_bbcodes/images/bbcodes/icon_parchemin.png' style='width: 22px; height: 22px; vertical-align: bottom' alt='' /> Afficher le bbcode Parchemin juste dans les news et proposition de news?");
define("LAN_ADVANCED_BBCODES_PREFS_SPOILER_NEWS",        "<img src='".e_PLUGIN."advanced_bbcodes/images/bbcodes/icon_spoiler.png' style='width: 22px; height: 22px; vertical-align: bottom' alt='' /> Afficher le bbcode Spoiler juste dans les news et proposition de news?");
define("LAN_ADVANCED_BBCODES_PREFS_TOOLFAQ_NEWS",        "<img src='".e_PLUGIN."advanced_bbcodes/images/bbcodes/icon_toolfaq.png' style='width: 22px; height: 22px; vertical-align: bottom' alt='' /> Afficher le bbcode ToolFaq juste dans les news et proposition de news?");
define("LAN_ADVANCED_BBCODES_PREFS_ROLLER_NEWS",         "<img src='".e_PLUGIN."advanced_bbcodes/images/bbcodes/icon_roller.png' style='width: 22px; height: 22px; vertical-align: bottom' alt='' /> Afficher le bbcode Roller juste dans les news et proposition de news?");

// sauvegarder et booléen
define("LAN_ADVANCED_BBCODES_YES",                       "Oui");
define("LAN_ADVANCED_BBCODES_NO",                        "Non");
define("LAN_ADVANCED_BBCODES_ADMIN_SAVE",                "Enregistrer");
define("LAN_ADVANCED_BBCODES_ADMIN_SAVE_TITLE",          "Cliquer pour enregistrer vos pr&eacute;f&eacute;rences");

// installation
define("LAN_ADVANCED_BBCODES_DONE1",                     "Le plugin:");
define("LAN_ADVANCED_BBCODES_DONE2",                     "en version");
define("LAN_ADVANCED_BBCODES_DONE3",                     "a &eacute;t&eacute; installer avec succ&egrave;s");

// form_handler.php
define("ADVANCED_BBCODES_CHECKBOX",                      "Cocher cette case pour s&eacute;l&eacute;ctionner cette option");

// help.php
define("ADVANCED_BBCODES_TITRE",                         "A propos de Advanced BBcodes");
define("ADVANCED_BBCODES_HELP01",                        "Advanced BBcode v0.4");
define("ADVANCED_BBCODES_HELP02",                        "Est une cr&eacute;ation de The_Death_Raw pour e107");
define("ADVANCED_BBCODES_HELPLINK",                      "<a href='http://www.e107plugins.fr' target='_blank' title='e107plugins.fr'><img src='".e_PLUGIN."advanced_bbcodes/images/e107plugins.png' alt='e107plugins.fr' style='border:0px' /><br />www.e107plugins.fr</a>");

// admin_menu.php
define("LAN_ADVANCED_BBCODES_ADMIN_MENU_00",             "Pr&eacute;f&eacute;rences");
define("LAN_ADVANCED_BBCODES_ADMIN_MENU_01",             "Affichage");

?>