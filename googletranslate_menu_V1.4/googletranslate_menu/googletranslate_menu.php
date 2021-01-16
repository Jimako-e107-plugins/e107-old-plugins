<?php
/*
+---------------------------------------------------------------+
|   Google Translate_menu
|	Copyright Father Barry 2006-8
|   Released under the terms and conditions of the
|   GNU General Public License (http://gnu.org).
|   Suitable for e107  v7
+---------------------------------------------------------------+
*/
if (!defined('e107_INIT'))
{
    exit;
}
require_once(e_PLUGIN.'googletranslate_menu/includes/google_trans_class.php');
include_lan(e_PLUGIN . "googletranslate_menu/languages/" . e_LANGUAGE . ".php");
if (!is_object($gtrans_obj)) {
	$gtrans_obj=new google_translate;
}
$res = $gtrans_obj->show_flags();
$ns->tablerender(GTM_LAN_CAPTION, $res);

return;
#
#if (isset ($HTTP_SERVER_VARS)) $_SERVER = &$HTTP_SERVER_VARS;
#(!e_QUERY?$page = e_SELF:$page = e_SELF . "?" . e_QUERY);
#$gpage = e_SELF . "?" . e_QUERY;
#$gtrans_text = "";
#$gpath = "http://translate.google.com/translate?langpair=";
#
#switch (e_LANGUAGE)
#{
#    case 'English':
#     $gtrans_text .= "<a href='{$gpath}en|ar&amp;u={$gpage}'><img src=\"" . e_PLUGIN . "googletranslate_menu/images/arabia.png\" alt='" . GTM_LAN_ARABIC . "' title='Arabic' style='vertical-align:middle;  border:0; width:19px; height:12px;' /></a> ";
#        $gtrans_text .= "<a href='{$gpath}en|bg&amp;u={$gpage}'><img src=\"" . e_PLUGIN . "googletranslate_menu/images/bulgaria.png\" alt='" . GTM_LAN_FRENCH . "' title='Bulgarian' style='vertical-align:middle;  border:0; width:19px; height:12px;' /></a> ";
#        $gtrans_text .= "<a href='{$gpath}en|zh-CN&amp;u={$gpage}'><img src=\"" . e_PLUGIN . "googletranslate_menu/images/china.png\" alt='" . GTM_LAN_CHINESE . "' title='Chinese' style='vertical-align:middle;  border:0; width:19px; height:12px;' /></a> ";
#        $gtrans_text .= "<a href='{$gpath}en|hr&amp;u={$gpage}'><img src=\"" . e_PLUGIN . "googletranslate_menu/images/croatia.png\" alt='" . GTM_LAN_FRENCH . "' title='Croatian' style='vertical-align:middle;  border:0; width:19px; height:12px;' /></a> ";
#        $gtrans_text .= "<a href='{$gpath}en|cs&amp;u={$gpage}'><img src=\"" . e_PLUGIN . "googletranslate_menu/images/czech.png\" alt='" . GTM_LAN_FRENCH . "' title='Czech' style='vertical-align:middle;  border:0; width:19px; height:12px;' /></a> ";
#        $gtrans_text .= "<a href='{$gpath}en|da&amp;u={$gpage}'><img src=\"" . e_PLUGIN . "googletranslate_menu/images/danish.png\" alt='" . GTM_LAN_FRENCH . "' title='Danish' style='vertical-align:middle;  border:0; width:19px; height:12px;' /></a> ";
#        $gtrans_text .= "<a href='{$gpath}en|tl&amp;u={$gpage}'><img src=\"" . e_PLUGIN . "googletranslate_menu/images/filipino.png\" alt='" . GTM_LAN_FRENCH . "' title='Filipino' style='vertical-align:middle;  border:0; width:19px; height:12px;' /></a> ";
#        $gtrans_text .= "<a href='{$gpath}en|fi&amp;u={$gpage}'><img src=\"" . e_PLUGIN . "googletranslate_menu/images/finland.png\" alt='" . GTM_LAN_FRENCH . "' title='Finish' style='vertical-align:middle;  border:0; width:19px; height:12px;' /></a> ";
#        $gtrans_text .= "<a href='{$gpath}en|fr&amp;u={$gpage}'><img src=\"" . e_PLUGIN . "googletranslate_menu/images/france.png\" alt='" . GTM_LAN_FRENCH . "' title='Demander en fran&#231;ais' style='vertical-align:middle;  border:0; width:19px; height:12px;' /></a> ";
#        $gtrans_text .= "<a href='{$gpath}en|de&amp;u={$gpage}'><img src=\"" . e_PLUGIN . "googletranslate_menu/images/germany.png\" alt='" . GTM_LAN_GERMAN . "' title='Paginieren Sie auf Deutsch' style='vertical-align:middle;  border:0; width:19px; height:12px;' /></a> ";
#        $gtrans_text .= "<a href='{$gpath}en|el&amp;u={$gpage}'><img src=\"" . e_PLUGIN . "googletranslate_menu/images/greece.png\" alt='" . GTM_LAN_FRENCH . "' title='Greek' style='vertical-align:middle;  border:0; width:19px; height:12px;' /></a> ";
#        $gtrans_text .= "<a href='{$gpath}en|iw&amp;u={$gpage}'><img src=\"" . e_PLUGIN . "googletranslate_menu/images/israel.png\" alt='" . GTM_LAN_FRENCH . "' title='Hebrew' style='vertical-align:middle;  border:0; width:19px; height:12px;' /></a> ";
#        $gtrans_text .= "<a href='{$gpath}en|hi&amp;u={$gpage}'><img src=\"" . e_PLUGIN . "googletranslate_menu/images/india.png\" alt='" . GTM_LAN_FRENCH . "' title='Hindi' style='vertical-align:middle;  border:0; width:19px; height:12px;' /></a> ";
#        $gtrans_text .= "<a href='{$gpath}en|id&amp;u={$gpage}'><img src=\"" . e_PLUGIN . "googletranslate_menu/images/indonesia.png\" alt='" . GTM_LAN_FRENCH . "' title='Indonesian' style='vertical-align:middle;  border:0; width:19px; height:12px;' /></a> ";
#        $gtrans_text .= "<a href='{$gpath}en|it&amp;u={$gpage}'><img src=\"" . e_PLUGIN . "googletranslate_menu/images/italy.png\" alt='" . GTM_LAN_ITALIAN . "' title='Chiamare nell&#39;italiano' style='vertical-align:middle;  border:0; width:19px; height:12px;' /></a> ";
#        $gtrans_text .= "<a href='{$gpath}en|ja&amp;u={$gpage}'><img src=\"" . e_PLUGIN . "googletranslate_menu/images/japan.png\" alt='" . GTM_LAN_DUTCH . "' title='Japanese' style='vertical-align:middle;  border:0; width:19px; height:12px;' /></a> ";
#        $gtrans_text .= "<a href='{$gpath}en|ko&amp;u={$gpage}'><img src=\"" . e_PLUGIN . "googletranslate_menu/images/korea.png\" alt='" . GTM_LAN_KOREAN . "' title='Korean' style='vertical-align:middle;  border:0; width:19px; height:12px;' /></a> ";
#		$gtrans_text .= "<a href='{$gpath}en|lv&amp;u={$gpage}'><img src=\"" . e_PLUGIN . "googletranslate_menu/images/latvia.png\" alt='" . GTM_LAN_FRENCH . "' title='Latvian' style='vertical-align:middle;  border:0; width:19px; height:12px;' /></a> ";
#        $gtrans_text .= "<a href='{$gpath}en|lt&amp;u={$gpage}'><img src=\"" . e_PLUGIN . "googletranslate_menu/images/lithuania.png\" alt='" . GTM_LAN_FRENCH . "' title='Lithuanian' style='vertical-align:middle;  border:0; width:19px; height:12px;' /></a> ";
#        $gtrans_text .= "<a href='{$gpath}en|nl&amp;u={$gpage}'><img src=\"" . e_PLUGIN . "googletranslate_menu/images/netherlands.png\" alt='" . GTM_LAN_DUTCH . "' title='Vertalen naar het Nederlands' style='vertical-align:middle;  border:0; width:19px; height:12px;' /></a> ";
#        $gtrans_text .= "<a href='{$gpath}en|no&amp;u={$gpage}'><img src=\"" . e_PLUGIN . "googletranslate_menu/images/norway.png\" alt='" . GTM_LAN_FRENCH . "' title='Norwegian' style='vertical-align:middle;  border:0; width:19px; height:12px;' /></a> ";
#
#        $gtrans_text .= "<a href='{$gpath}en|pl&amp;u={$gpage}'><img src=\"" . e_PLUGIN . "googletranslate_menu/images/poland.png\" alt='" . GTM_LAN_FRENCH . "' title='Polish' style='vertical-align:middle;  border:0; width:19px; height:12px;' /></a> ";
#        $gtrans_text .= "<a href='{$gpath}en|pt&amp;u={$gpage}'><img src=\"" . e_PLUGIN . "googletranslate_menu/images/portugal.png\" alt='" . GTM_LAN_PORTUGESE . "' title='Pagine em Portugese' style='vertical-align:middle;  border:0; width:19px; height:12px;' /></a> ";
#        $gtrans_text .= "<a href='{$gpath}en|ro&amp;u={$gpage}'><img src=\"" . e_PLUGIN . "googletranslate_menu/images/romania.png\" alt='" . GTM_LAN_FRENCH . "' title='Romanian' style='vertical-align:middle;  border:0; width:19px; height:12px;' /></a> ";
#        $gtrans_text .= "<a href='{$gpath}en|ru&amp;u={$gpage}'><img src=\"" . e_PLUGIN . "googletranslate_menu/images/russia.png\" alt='" . GTM_LAN_RUSSIAN . "' title='Poccn&#1081;cka&#1103;' style='vertical-align:middle;  border:0; width:19px; height:12px;' /></a> ";
#        $gtrans_text .= "<a href='{$gpath}en|sl&amp;u={$gpage}'><img src=\"" . e_PLUGIN . "googletranslate_menu/images/slovenia.png\" alt='" . GTM_LAN_FRENCH . "' title='Slovenian' style='vertical-align:middle;  border:0; width:19px; height:12px;' /></a> ";
#        $gtrans_text .= "<a href='{$gpath}en|sr&amp;u={$gpage}'><img src=\"" . e_PLUGIN . "googletranslate_menu/images/serbia.png\" alt='" . GTM_LAN_FRENCH . "' title='Serbian' style='vertical-align:middle;  border:0; width:19px; height:12px;' /></a> ";
#        $gtrans_text .= "<a href='{$gpath}en|sk&amp;u={$gpage}'><img src=\"" . e_PLUGIN . "googletranslate_menu/images/slovakia.png\" alt='" . GTM_LAN_FRENCH . "' title='Slovakian' style='vertical-align:middle;  border:0; width:19px; height:12px;' /></a> ";
#        $gtrans_text .= "<a href='{$gpath}en|es&amp;u={$gpage}'><img src=\"" . e_PLUGIN . "googletranslate_menu/images/spain.png\" alt='" . GTM_LAN_SPANISH . "' title='Pagine en espa&#241;ol' style='vertical-align:middle;  border:0; width:19px; height:12px;' /></a> ";
#        $gtrans_text .= "<a href='{$gpath}en|sv&amp;u={$gpage}'><img src=\"" . e_PLUGIN . "googletranslate_menu/images/sweden.png\" alt='" . GTM_LAN_FRENCH . "' title='Swedish' style='vertical-align:middle;  border:0; width:19px; height:12px;' /></a> ";
#        $gtrans_text .= "<a href='{$gpath}en|uk&amp;u={$gpage}'><img src=\"" . e_PLUGIN . "googletranslate_menu/images/ukraine.png\" alt='" . GTM_LAN_FRENCH . "' title='Ukranian' style='vertical-align:middle;  border:0; width:19px; height:12px;' /></a> ";
#        $gtrans_text .= "<a href='{$gpath}en|vi&amp;u={$gpage}'><img src=\"" . e_PLUGIN . "googletranslate_menu/images/vietnam.png\" alt='" . GTM_LAN_FRENCH . "' title='Vietnamese' style='vertical-align:middle;  border:0; width:19px; height:12px;' /></a> ";
#        $gtrans_text .= "<a href=\"javascript:document.location.href='$page'\"><img src=\"" . e_PLUGIN . "googletranslate_menu/images/uk.png\" alt='" . GTM_LAN_ENGLISH . "' title='Revert to English' style='vertical-align:middle;  border:0; width:19px; height:12px;' /></a> <br />";
#        break;
#
#    case 'French':
#        $gtrans_text = "<a href='{$gpath}fr|en&amp;u={$gpage}'><img src=\"" . e_PLUGIN . "googletranslate_menu/images/united-kingdom.gif\" alt='" . GTM_LAN_ENGLISH . "' title='Translate to English' style='vertical-align:middle;  border:0; width:19px; height:12px;' /></a> ";
#        $gtrans_text = "<a href='{$gpath}fr|de&amp;u={$gpage}'><img src=\"" . e_PLUGIN . "googletranslate_menu/images/germany.gif\" alt='" . GTM_LAN_ENGLISH . "' style='vertical-align:middle;  border:0; width:19px; height:12px;' /></a> ";
#        $gtrans_text .= "<a href=\"javascript:document.location.href='$page'\"><img src=\"" . e_PLUGIN . "googletranslate_menu/images/france.gif\" alt=" . GTM_LAN_FRENCH . " style='vertical-align:middle;  border:0; width:19px; height:12px;' /></a>";
#        break;
#
#    case 'German':
#        $gtrans_text = "<a href='{$gpath}de|en&amp;u={$gpage}'><img src=\"" . e_PLUGIN . "googletranslate_menu/images/united-kingdom.gif\" alt='" . GTM_LAN_ENGLISH . "' title='Translate to English' style='vertical-align:middle;  border:0; width:19px; height:12px;' /></a> ";
#        $gtrans_text = "<a href='{$gpath}de|fr&amp;u={$gpage}'><img src=\"" . e_PLUGIN . "googletranslate_menu/images/france.gif\" alt='" . GTM_LAN_FRENCH . "' title='fran&#231;ais' style='vertical-align:middle;  border:0; width:19px; height:12px;' /></a> ";
#        $gtrans_text .= "<a href=\"javascript:document.location.href='$page'\"><img src=\"" . e_PLUGIN . "googletranslate_menu/images/germany.gif\" alt=" . GTM_LAN_GERMAN . " style='vertical-align:middle;  border:0; width:19px; height:12px;'></a>";
#        break;
#
#    case 'Italian':
#        $gtrans_text = "<a href='{$gpath}it|en&amp;u={$gpage}'><img src=\"" . e_PLUGIN . "googletranslate_menu/images/united-kingdom.gif\" alt='" . GTM_LAN_ENGLISH . "' title='Translate to English' style='vertical-align:middle;  border:0; width:19px; height:12px;' /></a> ";
#        $gtrans_text .= "<a href=\"javascript:document.location.href='$page'\"><img src=\"" . e_PLUGIN . "googletranslate_menu/images/italy.gif\" alt=" . GTM_LAN_ITALIAN . " style='vertical-align:middle;  border:0; width:19px; height:12px;'></a>";
#        break;
#
#    case 'Spanish':
#        $gtrans_text = "<a href='{$gpath}es|en&amp;u={$gpage}'><img src=\"" . e_PLUGIN . "googletranslate_menu/images/united-kingdom.gif\" alt='" . GTM_LAN_ENGLISH . "' title='Translate to English'  style='vertical-align:middle;  border:0; width:19px; height:12px;' /></a> ";
#        $gtrans_text .= "<a href=\"javascript:document.location.href='$page'\"><img src=\"" . e_PLUGIN . "googletranslate_menu/images/spain.gif\" alt=" . GTM_LAN_SPANISH . " style='vertical-align:middle;  border:0; width:19px; height:12px;' /></a>";
#        break;
#
#    case 'Portugese':
#        $gtrans_text = "<a href='{$gpath}pt|en&amp;u={$gpage}'><img src=\"" . e_PLUGIN . "googletranslate_menu/images/united-kingdom.gif\" alt='" . GTM_LAN_ENGLISH . "' title='Translate to English' style='vertical-align:middle;  border:0; width:19px; height:12px;' /></a> ";
#        $gtrans_text .= "<a href=\"javascript:document.location.href='$page'\"><img src=\"" . e_PLUGIN . "googletranslate_menu/images/portugal.gif\" alt=" . GTM_LAN_PORTUGESE . " style='vertical-align:middle;  border:0; width:19px; height:12px;' /></a>";
#        break;
#    case 'Dutch':
#        $gtrans_text = "<a href='{$gpath}nl|en&amp;u={$gpage}'><img src=\"" . e_PLUGIN . "googletranslate_menu/images/united-kingdom.gif\" alt='" . GTM_LAN_ENGLISH . "' title='Translate to English' style='vertical-align:middle;  border:0; width:19px; height:12px;' /></a> ";
#        $gtrans_text .= "<a href=\"javascript:document.location.href='$page'\"><img src=\"" . e_PLUGIN . "googletranslate_menu/images/netherlands.gif\" alt=" . GTM_LAN_DUTCH . " style='vertical-align:middle;  border:0; width:19px; height:12px;' /></a>";
#        break;
#    case 'Russian':
#        $gtrans_text = "<a href='{$gpath}ru|en&amp;u={$gpage}'><img src=\"" . e_PLUGIN . "googletranslate_menu/images/united-kingdom.gif\" alt='" . GTM_LAN_ENGLISH . "' title='Translate to English' style='vertical-align:middle;  border:0; width:19px; height:12px;' /></a> ";
#        $gtrans_text .= "<a href=\"javascript:document.location.href='$page'\"><img src=\"" . e_PLUGIN . "googletranslate_menu/images/russia.png\" alt=" . GTM_LAN_DUTCH . " style='vertical-align:middle;  border:0; width:19px; height:12px;' /></a>";
#        break;
#    case 'Chinese':
#        $gtrans_text = "<a href='{$gpath}zh-CN|en&amp;u={$gpage}'><img src=\"" . e_PLUGIN . "googletranslate_menu/images/united-kingdom.gif\" alt='" . GTM_LAN_ENGLISH . "' title='Translate to English' style='vertical-align:middle;  border:0; width:19px; height:12px;' /></a> ";
#        $gtrans_text .= "<a href=\"javascript:document.location.href='$page'\"><img src=\"" . e_PLUGIN . "googletranslate_menu/images/china.png\" alt=" . GTM_LAN_DUTCH . " style='vertical-align:middle;  border:0; width:19px; height:12px;' /></a>";
#        break;
#    case 'Japanese':
#        $gtrans_text = "<a href='{$gpath}ja|en&amp;u={$gpage}'><img src=\"" . e_PLUGIN . "googletranslate_menu/images/united-kingdom.gif\" alt='" . GTM_LAN_ENGLISH . "' title='Translate to English' style='vertical-align:middle;  border:0; width:19px; height:12px;' /></a> ";
#        $gtrans_text .= "<a href=\"javascript:document.location.href='$page'\"><img src=\"" . e_PLUGIN . "googletranslate_menu/images/japan.png\" alt=" . GTM_LAN_DUTCH . " style='vertical-align:middle;  border:0; width:19px; height:12px;' /></a>";
#        break;
#}
#
#$ns->tablerender(GTM_LAN_CAPTION, $gtrans_text);
#
?>