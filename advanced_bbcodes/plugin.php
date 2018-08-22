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

// Protection du fichier
if (!defined('e107_INIT')) { exit; }

// Multilanguages
@include(e_PLUGIN."advanced_bbcodes/languages/".e_LANGUAGE.".php");
@include(e_PLUGIN."advanced_bbcodes/languages/French.php");

// Plugin info
$eplug_name = "".LAN_ADVANCED_BBCODES_NOM."";
$eplug_description = "".LAN_ADVANCED_BBCODES_DESCR."";
$eplug_folder = "advanced_bbcodes";
$eplug_version = "0.4";
$eplug_author = "The_Death_Raw";
$eplug_url = "http://www.e107plugins.fr";
$eplug_email = "postmaster@e107plugins.fr";
$eplug_compatible = "e107 v0.7+";

// Fichier Lisez moi
$eplug_readme = "";

// Texte d'aide afficher en infobulle  
$eplug_caption = "".LAN_ADVANCED_BBCODES_CONFIG.""; 

// Compliant
$eplug_compliant = TRUE;

// Icones du plugin
$eplug_icon = $eplug_folder."/images/icon_32.png";
$eplug_icon_small = $eplug_folder."/images/icon_16.png";
$eplug_logo = $eplug_folder."/images/icon_32.png";

// liste des préférences
$eplug_module = TRUE;
$eplug_conffile = "admin_prefs.php";

// Création d'un lien pour le plugin
$eplug_link = FALSE;
$eplug_link_name = "";
$eplug_link_url  = "";
$eplug_link_perms = ""; // Permissions: Guest, Member, Admin, Everyone

// Texte a afficher une fois le plugin installer
$eplug_done = "".LAN_ADVANCED_BBCODES_DONE1." <strong>$eplug_name</strong> ".LAN_ADVANCED_BBCODES_DONE2." <strong>$eplug_version</strong> ".LAN_ADVANCED_BBCODES_DONE3."";

// Liste des préférences sql
$eplug_prefs = array("advanced_bbcodes_strike"   => "".LAN_ADVANCED_BBCODES_YES."",
                     "advanced_bbcodes_hide"  => "".LAN_ADVANCED_BBCODES_YES."",
                     "advanced_bbcodes_ligne"  => "".LAN_ADVANCED_BBCODES_YES."",
                     "advanced_bbcodes_gvideo"  => "".LAN_ADVANCED_BBCODES_YES."",
                     "advanced_bbcodes_youtube"  => "".LAN_ADVANCED_BBCODES_YES."",
					 "advanced_bbcodes_dailymotion"  => "".LAN_ADVANCED_BBCODES_YES."",
					 "advanced_bbcodes_metacafe"  => "".LAN_ADVANCED_BBCODES_YES."",
					 "advanced_bbcodes_mplayer"  => "".LAN_ADVANCED_BBCODES_YES."",
					 "advanced_bbcodes_parchemin"  => "".LAN_ADVANCED_BBCODES_YES."",
					 "advanced_bbcodes_spoiler"  => "".LAN_ADVANCED_BBCODES_YES."",
					 "advanced_bbcodes_toolfaq"  => "".LAN_ADVANCED_BBCODES_YES."",
					 "advanced_bbcodes_roller"  => "".LAN_ADVANCED_BBCODES_YES."",
					 "advanced_bbcodes_acronym"  => "".LAN_ADVANCED_BBCODES_YES."",
					 "advanced_bbcodes_strike_news"   => "".LAN_ADVANCED_BBCODES_NO."",
                     "advanced_bbcodes_hide_news"  => "".LAN_ADVANCED_BBCODES_NO."",
                     "advanced_bbcodes_ligne_news"  => "".LAN_ADVANCED_BBCODES_NO."",
                     "advanced_bbcodes_gvideo_news"  => "".LAN_ADVANCED_BBCODES_NO."",
                     "advanced_bbcodes_youtube_news"  => "".LAN_ADVANCED_BBCODES_NO."",
					 "advanced_bbcodes_dailymotion_news"  => "".LAN_ADVANCED_BBCODES_NO."",
					 "advanced_bbcodes_metacafe_news"  => "".LAN_ADVANCED_BBCODES_NO."",
					 "advanced_bbcodes_mplayer_news"  => "".LAN_ADVANCED_BBCODES_NO."",
					 "advanced_bbcodes_parchemin_news"  => "".LAN_ADVANCED_BBCODES_NO."",
					 "advanced_bbcodes_sp_news"  => "".LAN_ADVANCED_BBCODES_NO."",
					 "advanced_bbcodes_toolfaq_news"  => "".LAN_ADVANCED_BBCODES_NO."",
					 "advanced_bbcodes_roller_news"  => "".LAN_ADVANCED_BBCODES_NO."",
                     "advanced_bbcodes_acronym_news"  => "".LAN_ADVANCED_BBCODES_NO."");

// Mise à jour des préférences sql
$upgrade_add_prefs = array("advanced_bbcodes_strike"   => "".LAN_ADVANCED_BBCODES_YES."",
                     "advanced_bbcodes_hide"  => "".LAN_ADVANCED_BBCODES_YES."",
                     "advanced_bbcodes_ligne"  => "".LAN_ADVANCED_BBCODES_YES."",
                     "advanced_bbcodes_gvideo"  => "".LAN_ADVANCED_BBCODES_YES."",
                     "advanced_bbcodes_youtube"  => "".LAN_ADVANCED_BBCODES_YES."",
					 "advanced_bbcodes_dailymotion"  => "".LAN_ADVANCED_BBCODES_YES."",
					 "advanced_bbcodes_metacafe"  => "".LAN_ADVANCED_BBCODES_YES."",
					 "advanced_bbcodes_mplayer"  => "".LAN_ADVANCED_BBCODES_YES."",
					 "advanced_bbcodes_parchemin"  => "".LAN_ADVANCED_BBCODES_YES."",
					 "advanced_bbcodes_spoiler"  => "".LAN_ADVANCED_BBCODES_YES."",
					 "advanced_bbcodes_toolfaq"  => "".LAN_ADVANCED_BBCODES_YES."",
					 "advanced_bbcodes_roller"  => "".LAN_ADVANCED_BBCODES_YES."",
					 "advanced_bbcodes_acronym"  => "".LAN_ADVANCED_BBCODES_YES."",
					 "advanced_bbcodes_strike_news"   => "".LAN_ADVANCED_BBCODES_NO."",
                     "advanced_bbcodes_hide_news"  => "".LAN_ADVANCED_BBCODES_NO."",
                     "advanced_bbcodes_ligne_news"  => "".LAN_ADVANCED_BBCODES_NO."",
                     "advanced_bbcodes_gvideo_news"  => "".LAN_ADVANCED_BBCODES_NO."",
                     "advanced_bbcodes_youtube_news"  => "".LAN_ADVANCED_BBCODES_NO."",
					 "advanced_bbcodes_dailymotion_news"  => "".LAN_ADVANCED_BBCODES_NO."",
					 "advanced_bbcodes_metacafe_news"  => "".LAN_ADVANCED_BBCODES_NO."",
					 "advanced_bbcodes_mplayer_news"  => "".LAN_ADVANCED_BBCODES_NO."",
					 "advanced_bbcodes_parchemin_news"  => "".LAN_ADVANCED_BBCODES_NO."",
					 "advanced_bbcodes_sp_news"  => "".LAN_ADVANCED_BBCODES_NO."",
					 "advanced_bbcodes_toolfaq_news"  => "".LAN_ADVANCED_BBCODES_NO."",
					 "advanced_bbcodes_roller_news"  => "".LAN_ADVANCED_BBCODES_NO."",
                     "advanced_bbcodes_acronym_news"  => "".LAN_ADVANCED_BBCODES_NO."");

$upgrade_remove_prefs = "";
$upgrade_alter_tables = "";
?>