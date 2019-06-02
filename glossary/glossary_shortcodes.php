<?php
/**
 * Glossary by Shirka (www.shirka.org)
 *
 * A plugin for the e107 Website System (http://e107.org)
 *
 * ©Andre DUCLOS 2006
 * http://www.shirka.org
 * duclos@shirka.org
 *
 * Released under the terms and conditions of the
 * GNU General Public License (http://gnu.org).
 *
 * $Source: /home/e-smith/files/ibays/cvsroot/files/glossary/glossary_shortcodes.php,v $
 * $Revision: 1.7 $
 * $Date: 2006/06/28 01:16:10 $
 * $Author: duclos $
 */

if (!defined('e107_INIT')) { exit; }

global $word_shortcodes;

include_once(e_HANDLER.'shortcode_handler.php');

$word_shortcodes = $tp -> e_sc -> parse_scbatch(__FILE__);
/*

SC_BEGIN WORD_NAME
global $glo_id, $word, $tp;
if ($parm == "page")
	return "<a id='word_id_".$glo_id."'>".$tp->toHTML($word, TRUE)."</a>";
else
	return $tp->toHTML($word, TRUE);
SC_END

SC_BEGIN WORD_DESCRIPTION
global $description, $tp;
return $tp->toHTML($description, TRUE);
SC_END

SC_BEGIN LINK_TO_TOP
return "<a href='".e_SELF."#top' title='".LAN_GLOSSARY_LINK_TOP_02."'>".LAN_GLOSSARY_LINK_TOP_01."</a>";
SC_END

SC_BEGIN WORD_PAGE_TITLE
global $pref;
return "<a id='top'>".$pref['glossary_page_title']."</a>";
SC_END

SC_BEGIN WORD_MENU_TITLE
global $pref;
if ($pref['glossary_menu_lastword'])
	return LAN_GLOSSARY_MENU_TITLE_01;
else
	return LAN_GLOSSARY_MENU_TITLE_02;
SC_END

SC_BEGIN WORD_ANCHOR
global $wcar;
return "<a id='".$wcar."'>".$wcar."</a>";
SC_END

SC_BEGIN WORD_CHAR_LINK
global $wcar;
if ($parm == "link")
	return "<a href='".e_SELF."#".$wcar."' title='".LAN_GLOSSARY_LINK_LETTER_01." &lt;".$wcar."&gt;"."'>".$wcar."</a>";
else
	return $wcar;
SC_END

SC_BEGIN ADMINOPTIONS
global $glo_id;
if (ADMIN && getperms("P"))
{
	$adop_icon = (file_exists(THEME."generic/newsedit.png") ? THEME."generic/newsedit.png" : e_IMAGE."generic/".IMODE."/newsedit.png");
	return " <a href='".e_PLUGIN."glossary/admin_config.php?edit.".$glo_id."' title='".LAN_GLOSSARY_ADMINOPTIONS_01."'><img src='".$adop_icon."' alt='' style='border:0' /></a>\n";
}
else
	return "";
SC_END

SC_BEGIN EMAILITEM
global $glo_id, $tp, $pref;
if (isset($pref['glossary_emailprint']) && $pref['glossary_emailprint'])
	return $tp->parseTemplate("{EMAIL_ITEM=".LAN_GLOSSARY_EMAILPRINT_01."^plugin:glossary.{$glo_id}}");
SC_END

SC_BEGIN PRINTITEM
global $glo_id, $tp, $pref;
if (isset($pref['glossary_emailprint']) && $pref['glossary_emailprint'])
	return $tp->parseTemplate("{PRINT_ITEM=".LAN_GLOSSARY_EMAILPRINT_02."^plugin:glossary.{$glo_id}}");
SC_END

SC_BEGIN PDFITEM
global $glo_id, $tp, $pref;
if (isset($pref['glossary_emailprint']) && $pref['glossary_emailprint'])
	return $tp->parseTemplate("{PDF=".LAN_GLOSSARY_EMAILPRINT_03."^plugin:glossary.{$glo_id}}");
SC_END

SC_BEGIN LINK_PAGE_NAVIGATOR
global $LINK_PAGE_NAVIGATOR, $rs, $pref;
$text = "";
$mains = "";
$baseurl = e_PLUGIN."glossary/glossaire.php";
if(isset($pref['glossary_page_link_submit']) && $pref['glossary_page_link_submit'] && isset($pref['glossary_submit']) && $pref['glossary_submit'] && check_class($pref['glossary_submit_class']))
{
	$direct = (isset($pref['glossary_submit_directpost']) && $pref['glossary_submit_directpost']) ? 1 : 0;
	if(isset($pref['glossary_page_link_rendertype']) && $pref['glossary_page_link_rendertype'] == "1")
		$mains = $rs->form_option($direct ? LAN_GLOSSARY_GLO_06 : LAN_GLOSSARY_GLO_05, "0", $baseurl."?createSub", "");
	else
		$mains = "<a href='".$baseurl."?createSub'>".($direct ? LAN_GLOSSARY_GLO_06 : LAN_GLOSSARY_GLO_05)."</a>";
}

if($mains)
{
	$cap = (isset($pref['glossary_page_caption_nav']) && $pref['glossary_page_caption_nav'] ? $pref['glossary_page_caption_nav'] : LAN_GLOSSARY_GLO_07);
	if(isset($pref['glossary_page_link_rendertype']) && $pref['glossary_page_link_rendertype'] == "1")
	{
		$selectjs = "style='width:100%;' onchange=\"if(this.options[this.selectedIndex].value != ''){ return document.location=this.options[this.selectedIndex].value; }\" ";
		$text .= $rs->form_select_open("navigator", $selectjs);
		$text .= $rs->form_option($cap, "0", "", "");
		$text .= $rs->form_option("", "0", "", "");
		$text .= $mains;
		$text .= $rs->form_select_close();
		$text .= "<br />";
	}
	else
	{
		$text .= $cap."<br />";
		$text .= $mains;
	}
}
return $text;
SC_END

SC_BEGIN LINK_MENU_NAVIGATOR
global $LINK_MENU_NAVIGATOR, $rs, $pref;
$text = "";
$mains = "";
$baseurl = e_PLUGIN."glossary/glossaire.php";
$bullet = defined("BULLET") ? "<img src='".THEME_ABS."images/".BULLET."' alt='' style='vertical-align: middle; border: 0;' />" : "<img src='".THEME_ABS."images/bullet2.gif' alt='bullet' style='vertical-align: middle; border: 0;' />";
if(isset($pref['glossary_menu_link_frontpage']) && $pref['glossary_menu_link_frontpage'])
{
	if(isset($pref['glossary_menu_link_rendertype']) && $pref['glossary_menu_link_rendertype'] == "1")
		$mains .= $rs->form_option(LAN_GLOSSARY_BLMENU_02, "0", $baseurl, "");
	else
		$mains .= $bullet."&nbsp;<a href='".$baseurl."'>".LAN_GLOSSARY_BLMENU_02."</a>";
}

if(isset($pref['glossary_menu_link_submit']) && $pref['glossary_menu_link_submit'] && isset($pref['glossary_submit']) && $pref['glossary_submit'] && check_class($pref['glossary_submit_class']))
{
	$direct = (isset($pref['glossary_submit_directpost']) && $pref['glossary_submit_directpost']) ? 1 : 0;
	if(isset($pref['glossary_menu_link_rendertype']) && $pref['glossary_menu_link_rendertype'] == "1")
		$mains .= $rs->form_option($direct ? LAN_GLOSSARY_BLMENU_06 : LAN_GLOSSARY_BLMENU_03, "0", $baseurl."?createSub", "");
	else
		$mains .= ($mains ? "<br />" : "").$bullet."&nbsp;<a href='".$baseurl."?createSub'>".($direct ? LAN_GLOSSARY_BLMENU_06 : LAN_GLOSSARY_BLMENU_03)."</a>";
}

if($mains)
{
	$cap = (isset($pref['glossary_menu_caption_nav']) && $pref['glossary_menu_caption_nav'] ? $pref['glossary_menu_caption_nav'] : LAN_GLOSSARY_BLMENU_04);
	if(isset($pref['glossary_menu_link_rendertype']) && $pref['glossary_menu_link_rendertype'] == "1")
	{
		$selectjs = "style='width:100%;' onchange=\"if(this.options[this.selectedIndex].value != ''){ return document.location=this.options[this.selectedIndex].value; }\" ";
		$text .= $rs->form_select_open("navigator", $selectjs);
		$text .= $rs->form_option($cap, "0", "", "");
		$text .= $rs->form_option("", "0", "", "");
		$text .= $mains;
		$text .= $rs->form_select_close();
	}
	else
	{
		$text .= $cap."<br />";
		$text .= $mains;
	}
}
return $text;
SC_END

*/

?>