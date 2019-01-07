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

// protection du fichier
if (!defined('e107_INIT')) { exit; }

global $pref;     

// raccourci chemin images bbcodes
$advbbcodes_chemin = "advanced_bbcodes/images/bbcodes/";

// Multilanguages
@include(e_PLUGIN."advanced_bbcodes/languages/".e_LANGUAGE.".php");
@include(e_PLUGIN."advanced_bbcodes/languages/French.php");

/*---------------------------------------------------------------------------------------------------
|        1.Hr bbcode
---------------------------------------------------------------------------------------------------*/

if ($pref['advanced_bbcodes_ligne']){
// informations sur le bbcode hr
$bb['name'] = 'ligne';
$bb['onclick'] = 'addtext';
$bb['onclick_var'] = "[ligne][/ligne]";
$bb['icon'] = e_PLUGIN_ABS."".$advbbcodes_chemin."icon_hr.png";
$bb['helptext'] = "".LAN_ADVANCED_BBCODES_LIGNE."";
$bb['function'] = '';
$bb['function_var'] = '';

if ($pref['advanced_bbcodes_ligne_news']){
// ajout du bbcode juste pour les news et la proposition des news
$BBCODE_TEMPLATE_NEWSPOST .= "{BB=ligne}";
$BBCODE_TEMPLATE_SUBMITNEWS .= "{BB=ligne}";
} 
else {
// ajout du bbcode aux templates par defaut
$BBCODE_TEMPLATE .= "{BB=ligne}"; 
$BBCODE_TEMPLATE_NEWSPOST .= "{BB=ligne}";
$BBCODE_TEMPLATE_SUBMITNEWS .= "{BB=ligne}";
$BBCODE_TEMPLATE_ADMIN .= "{BB=ligne}";
$BBCODE_TEMPLATE_CPAGE .= "{BB=ligne}";
} 

$eplug_bb[] = $bb; // ajout à la liste gobale - Très Important!
}
else {
}

/*---------------------------------------------------------------------------------------------------
|        2.Roller bbcode
---------------------------------------------------------------------------------------------------*/

if ($pref['advanced_bbcodes_roller']){
// informations sur le bbcode roller
$bb['name'] = 'roller';
$bb['onclick'] = 'addtext';
$bb['onclick_var'] = "[roller][/roller]";
$bb['icon'] = e_PLUGIN_ABS."".$advbbcodes_chemin."icon_roller.png";
$bb['helptext'] = "".LAN_ADVANCED_BBCODES_ROLLER."";
$bb['function'] = '';
$bb['function_var'] = '';

if ($pref['advanced_bbcodes_roller_news']){
// ajout du bbcode juste pour les news et la proposition des news
$BBCODE_TEMPLATE_NEWSPOST .= "{BB=roller}";
$BBCODE_TEMPLATE_SUBMITNEWS .= "{BB=roller}";
} 

else {
// ajout du bbcode aux templates par defaut
$BBCODE_TEMPLATE .= "{BB=roller}"; 
$BBCODE_TEMPLATE_NEWSPOST .= "{BB=roller}";
$BBCODE_TEMPLATE_SUBMITNEWS .= "{BB=roller}";
$BBCODE_TEMPLATE_ADMIN .= "{BB=roller}";
$BBCODE_TEMPLATE_CPAGE .= "{BB=roller}";
} 

$eplug_bb[] = $bb; // ajout à la liste gobale - Très Important!
}
else {
}

/*---------------------------------------------------------------------------------------------------
|        3.Strike bbcode
---------------------------------------------------------------------------------------------------*/

if ($pref['advanced_bbcodes_strike']){
// informations sur le bbcode strike
$bb['name']		= 'strike'; 
$bb['onclick'] = 'addtext';
$bb['onclick_var']	= "[strike][/strike]"; 
$bb['icon']		= e_PLUGIN_ABS."".$advbbcodes_chemin."icon_strike.png"; 
$bb['helptext']		= "".LAN_ADVANCED_BBCODES_STRIKE."";
$bb['function']		= '';   
$bb['function_var']     = '';  

if ($pref['advanced_bbcodes_strike_news']){
// ajout du bbcode juste pour les news et la proposition des news
$BBCODE_TEMPLATE_NEWSPOST .= "{BB=strike}";
$BBCODE_TEMPLATE_SUBMITNEWS .= "{BB=strike}";
} 

else {
// ajout du bbcode aux templates par defaut
$BBCODE_TEMPLATE .= "{BB=strike}"; 
$BBCODE_TEMPLATE_NEWSPOST .= "{BB=strike}";
$BBCODE_TEMPLATE_SUBMITNEWS .= "{BB=strike}";
$BBCODE_TEMPLATE_ADMIN .= "{BB=strike}";
$BBCODE_TEMPLATE_CPAGE .= "{BB=strike}";
} 

$eplug_bb[] = $bb; // ajout à la liste gobale - Très Important!
}
else {
}

/*---------------------------------------------------------------------------------------------------
|        4.Hide bbcode
---------------------------------------------------------------------------------------------------*/

if ($pref['advanced_bbcodes_hide']){
// informations sur le bbcode hide
$bb['name']		= 'hide'; 
$bb['onclick'] = 'addtext';
$bb['onclick_var']	= "[hide][/hide]"; 
$bb['icon']		= e_PLUGIN_ABS."".$advbbcodes_chemin."icon_hide.png"; 
$bb['helptext']		= "".LAN_ADVANCED_BBCODES_HIDE."";
$bb['function']		= '';   
$bb['function_var']     = '';  

if ($pref['advanced_bbcodes_hide_news']){
// ajout du bbcode juste pour les news et la proposition des news
$BBCODE_TEMPLATE_NEWSPOST .= "{BB=hide}";
$BBCODE_TEMPLATE_SUBMITNEWS .= "{BB=hide}";
} 
else {
// ajout du bbcode aux templates par defaut
$BBCODE_TEMPLATE .= "{BB=hide}"; 
$BBCODE_TEMPLATE_NEWSPOST .= "{BB=hide}";
$BBCODE_TEMPLATE_SUBMITNEWS .= "{BB=hide}";
$BBCODE_TEMPLATE_ADMIN .= "{BB=hide}";
$BBCODE_TEMPLATE_CPAGE .= "{BB=hide}";
} 

$eplug_bb[] = $bb; // ajout à la liste gobale - Très Important!
}
else {
}

/*---------------------------------------------------------------------------------------------------
|        5.GoogleVideo bbcode
---------------------------------------------------------------------------------------------------*/

if ($pref['advanced_bbcodes_gvideo']){
// informations sur le bbcode googlevideo
$bb['name'] = 'gvideo'; 
$bb['onclick'] = 'addtext'; 
$bb['onclick_var'] = "[gvideo][/gvideo]"; 
$bb['icon'] = e_PLUGIN_ABS."".$advbbcodes_chemin."icon_gvideo.png"; 
$bb['helptext'] = "".LAN_ADVANCED_BBCODES_GVIDEO."";
$bb['function'] = '';
$bb['function_var'] = '';

if ($pref['advanced_bbcodes_gvideo_news']){
// ajout du bbcode juste pour les news et la proposition des news
$BBCODE_TEMPLATE_NEWSPOST .= "{BB=gvideo}";
$BBCODE_TEMPLATE_SUBMITNEWS .= "{BB=gvideo}";
} 

else {
// ajout du bbcode aux templates par defaut
$BBCODE_TEMPLATE .= "{BB=gvideo}"; 
$BBCODE_TEMPLATE_NEWSPOST .= "{BB=gvideo}";
$BBCODE_TEMPLATE_SUBMITNEWS .= "{BB=gvideo}";
$BBCODE_TEMPLATE_ADMIN .= "{BB=gvideo}";
$BBCODE_TEMPLATE_CPAGE .= "{BB=gvideo}";
} 

$eplug_bb[] = $bb; // ajout à la liste gobale - Très Important!
}
else {
}

/*---------------------------------------------------------------------------------------------------
|        6.Youtube bbcode
---------------------------------------------------------------------------------------------------*/

if ($pref['advanced_bbcodes_youtube']){
// informations sur le bbcode youtube
$bb['name'] = 'youtube';
$bb['onclick'] = 'addtext';
$bb['onclick_var'] = "[youtube][/youtube]";
$bb['icon'] = e_PLUGIN_ABS."".$advbbcodes_chemin."icon_youtube.png";
$bb['helptext'] = "".LAN_ADVANCED_BBCODES_YOUTUBE."";
$bb['function'] = '';
$bb['function_var'] = '';

if ($pref['advanced_bbcodes_youtube_news']){
// ajout du bbcode juste pour les news et la proposition des news
$BBCODE_TEMPLATE_NEWSPOST .= "{BB=youtube}";
$BBCODE_TEMPLATE_SUBMITNEWS .= "{BB=youtube}";
} 

else {
// ajout du bbcode aux templates par defaut
$BBCODE_TEMPLATE .= "{BB=youtube}"; 
$BBCODE_TEMPLATE_NEWSPOST .= "{BB=youtube}";
$BBCODE_TEMPLATE_SUBMITNEWS .= "{BB=youtube}";
$BBCODE_TEMPLATE_ADMIN .= "{BB=youtube}";
$BBCODE_TEMPLATE_CPAGE .= "{BB=youtube}";
} 

$eplug_bb[] = $bb; // ajout à la liste gobale - Très Important!
}
else {
}

/*---------------------------------------------------------------------------------------------------
|        7.Dailymotion bbcode
---------------------------------------------------------------------------------------------------*/

if ($pref['advanced_bbcodes_dailymotion']){
// informations sur le bbcode dailymotion
$bb['name'] = 'dailymotion'; 
$bb['onclick'] = 'addtext'; 
$bb['onclick_var'] = "[dailymotion][/dailymotion]"; 
$bb['icon'] = e_PLUGIN_ABS."".$advbbcodes_chemin."icon_dailymotion.png"; 
$bb['helptext'] = "".LAN_ADVANCED_BBCODES_DAILYMOTION."";
$bb['function'] = '';
$bb['function_var'] = '';

if ($pref['advanced_bbcodes_dailymotion_news']){
// ajout du bbcode juste pour les news et la proposition des news
$BBCODE_TEMPLATE_NEWSPOST .= "{BB=dailymotion}";
$BBCODE_TEMPLATE_SUBMITNEWS .= "{BB=dailymotion}";
} 

else {
// ajout du bbcode aux templates par defaut
$BBCODE_TEMPLATE .= "{BB=dailymotion}"; 
$BBCODE_TEMPLATE_NEWSPOST .= "{BB=dailymotion}";
$BBCODE_TEMPLATE_SUBMITNEWS .= "{BB=dailymotion}";
$BBCODE_TEMPLATE_ADMIN .= "{BB=dailymotion}";
$BBCODE_TEMPLATE_CPAGE .= "{BB=dailymotion}";
} 

$eplug_bb[] = $bb; // ajout à la liste gobale - Très Important!
}
else {
}

/*---------------------------------------------------------------------------------------------------
|        8.MetaCafe bbcode
---------------------------------------------------------------------------------------------------*/

if ($pref['advanced_bbcodes_metacafe']){
// informations sur le bbcode metacafe
$bb['name'] = 'metacafe';
$bb['onclick'] = 'addtext';
$bb['onclick_var'] = "[metacafe][/metacafe]";
$bb['icon'] = e_PLUGIN_ABS."".$advbbcodes_chemin."icon_metacafe.png";
$bb['helptext'] = "".LAN_ADVANCED_BBCODES_METACAFE."";
$bb['function'] = '';
$bb['function_var'] = '';

if ($pref['advanced_bbcodes_metacafe_news']){
// ajout du bbcode juste pour les news et la proposition des news
$BBCODE_TEMPLATE_NEWSPOST .= "{BB=metacafe}";
$BBCODE_TEMPLATE_SUBMITNEWS .= "{BB=metacafe}";
} 

else {
// ajout du bbcode aux templates par defaut
$BBCODE_TEMPLATE .= "{BB=metacafe}"; 
$BBCODE_TEMPLATE_NEWSPOST .= "{BB=metacafe}";
$BBCODE_TEMPLATE_SUBMITNEWS .= "{BB=metacafe}";
$BBCODE_TEMPLATE_ADMIN .= "{BB=metacafe}";
$BBCODE_TEMPLATE_CPAGE .= "{BB=metacafe}";
} 

$eplug_bb[] = $bb; // ajout à la liste gobale - Très Important!
}
else {
}

/*---------------------------------------------------------------------------------------------------
|        9.Acronym bbcode
---------------------------------------------------------------------------------------------------*/

if ($pref['advanced_bbcodes_acronym']){
// informations sur le bbcode acronym
$bb['name'] = 'acronym';
$bb['onclick'] = 'addtext';
$bb['onclick_var'] = "".LAN_ADVANCED_BBCODES_ACRONYM_ON."";
$bb['icon'] = e_PLUGIN_ABS."".$advbbcodes_chemin."icon_acronym.png";
$bb['helptext'] = "".LAN_ADVANCED_BBCODES_ACRONYM."";
$bb['function'] = '';
$bb['function_var'] = '';

if ($pref['advanced_bbcodes_acronym_news']){
// ajout du bbcode juste pour les news et la proposition des news
$BBCODE_TEMPLATE_NEWSPOST .= "{BB=acronym}";
$BBCODE_TEMPLATE_SUBMITNEWS .= "{BB=acronym}";
} 

else {
// ajout du bbcode aux templates par defaut
$BBCODE_TEMPLATE .= "{BB=acronym}"; 
$BBCODE_TEMPLATE_NEWSPOST .= "{BB=acronym}";
$BBCODE_TEMPLATE_SUBMITNEWS .= "{BB=acronym}";
$BBCODE_TEMPLATE_ADMIN .= "{BB=acronym}";
$BBCODE_TEMPLATE_CPAGE .= "{BB=acronym}";
} 

$eplug_bb[] = $bb; // ajout à la liste gobale - Très Important!
}
else {
}

/*---------------------------------------------------------------------------------------------------
|        10.Lecteur Mp3 bbcode
---------------------------------------------------------------------------------------------------*/

if ($pref['advanced_bbcodes_mplayer']){
// informations sur le bbcode lecteur mp3
$bb['name'] = 'mplayer';
$bb['onclick'] = 'addtext';
$bb['onclick_var'] = "[mplayer][/mplayer]";
$bb['icon'] = e_PLUGIN_ABS."".$advbbcodes_chemin."icon_mplayer.png";
$bb['helptext'] = "".LAN_ADVANCED_BBCODES_MP3."";
$bb['function'] = '';
$bb['function_var'] = '';

if ($pref['advanced_bbcodes_mplayer_news']){
// ajout du bbcode juste pour les news et la proposition des news
$BBCODE_TEMPLATE_NEWSPOST .= "{BB=mplayer}";
$BBCODE_TEMPLATE_SUBMITNEWS .= "{BB=mplayer}";
} 

else {
// ajout du bbcode aux templates par defaut
$BBCODE_TEMPLATE .= "{BB=mplayer}"; 
$BBCODE_TEMPLATE_NEWSPOST .= "{BB=mplayer}";
$BBCODE_TEMPLATE_SUBMITNEWS .= "{BB=mplayer}";
$BBCODE_TEMPLATE_ADMIN .= "{BB=mplayer}";
$BBCODE_TEMPLATE_CPAGE .= "{BB=mplayer}";
} 

$eplug_bb[] = $bb; // ajout à la liste gobale - Très Important!
}
else {
}

/*---------------------------------------------------------------------------------------------------
|        11.Parchemin bbcode
---------------------------------------------------------------------------------------------------*/

if ($pref['advanced_bbcodes_parchemin']){
// informations sur le bbcode parchemin
$bb['name'] = 'parchemin';
$bb['onclick'] = 'addtext';
$bb['onclick_var'] = "[parchemin][/parchemin]";
$bb['icon'] = e_PLUGIN_ABS."".$advbbcodes_chemin."icon_parchemin.png";
$bb['helptext'] = "".LAN_ADVANCED_BBCODES_PARCHEMIN."";
$bb['function'] = '';
$bb['function_var'] = '';

if ($pref['advanced_bbcodes_parchemin_news']){
// ajout du bbcode juste pour les news et la proposition des news
$BBCODE_TEMPLATE_NEWSPOST .= "{BB=parchemin}";
$BBCODE_TEMPLATE_SUBMITNEWS .= "{BB=parchemin}";
} 

else {
// ajout du bbcode aux templates par defaut
$BBCODE_TEMPLATE .= "{BB=parchemin}"; 
$BBCODE_TEMPLATE_NEWSPOST .= "{BB=parchemin}";
$BBCODE_TEMPLATE_SUBMITNEWS .= "{BB=parchemin}";
$BBCODE_TEMPLATE_ADMIN .= "{BB=parchemin}";
$BBCODE_TEMPLATE_CPAGE .= "{BB=parchemin}";
} 

$eplug_bb[] = $bb; // ajout à la liste gobale - Très Important!
}
else {
}

/*---------------------------------------------------------------------------------------------------
|        12.Spoiler bbcode
---------------------------------------------------------------------------------------------------*/

if ($pref['advanced_bbcodes_spoiler']){
// informations sur le bbcode spoiler
$bb['name'] = 'sp';
$bb['onclick'] = 'addtext';
$bb['onclick_var'] = "[sp][/sp]";
$bb['icon'] = e_PLUGIN_ABS."".$advbbcodes_chemin."icon_spoiler.png";
$bb['helptext'] = "".LAN_ADVANCED_BBCODES_SPOILER."";
$bb['function'] = '';
$bb['function_var'] = '';

if ($pref['advanced_bbcodes_sp_news']){
// ajout du bbcode juste pour les news et la proposition des news
$BBCODE_TEMPLATE_NEWSPOST .= "{BB=sp}";
$BBCODE_TEMPLATE_SUBMITNEWS .= "{BB=sp}";
} 

else {
// ajout du bbcode aux templates par defaut
$BBCODE_TEMPLATE .= "{BB=sp}"; 
$BBCODE_TEMPLATE_NEWSPOST .= "{BB=sp}";
$BBCODE_TEMPLATE_SUBMITNEWS .= "{BB=sp}";
$BBCODE_TEMPLATE_ADMIN .= "{BB=sp}";
$BBCODE_TEMPLATE_CPAGE .= "{BB=sp}";
} 
                              
$eplug_bb[] = $bb; // ajout à la liste gobale - Très Important!
}
else {
}

/*---------------------------------------------------------------------------------------------------
|        13.ToolFaq bbcode
--------------------------------------------------------------------------------------------------- */

if ($pref['advanced_bbcodes_toolfaq']){
// informations sur le bbcode toolfaq
$bb['name'] = 'toolfaq';
$bb['onclick'] = 'addtext';
$bb['onclick_var'] = "[toolfaq][/toolfaq]";
$bb['icon'] = e_PLUGIN_ABS."".$advbbcodes_chemin."icon_toolfaq.png";
$bb['helptext'] = "".LAN_ADVANCED_BBCODES_TOOLFAQ."";
$bb['function'] = '';
$bb['function_var'] = '';

if ($pref['advanced_bbcodes_toolfaq_news']){
// ajout du bbcode juste pour les news et la proposition des news
$BBCODE_TEMPLATE_NEWSPOST .= "{BB=toolfaq}";
$BBCODE_TEMPLATE_SUBMITNEWS .= "{BB=toolfaq}";
} 

else {
// ajout du bbcode aux templates par defaut
$BBCODE_TEMPLATE .= "{BB=toolfaq}"; 
$BBCODE_TEMPLATE_NEWSPOST .= "{BB=toolfaq}";
$BBCODE_TEMPLATE_SUBMITNEWS .= "{BB=toolfaq}";
$BBCODE_TEMPLATE_ADMIN .= "{BB=toolfaq}";
$BBCODE_TEMPLATE_CPAGE .= "{BB=toolfaq}";
} 

$eplug_bb[] = $bb; // ajout à la liste gobale - Très Important!
}
else {
}

?>