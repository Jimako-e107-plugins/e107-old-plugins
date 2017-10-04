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

class plugin_glossary_glossary_shortcodes extends e_shortcode
{
 
	public function sc_word_name()  {
		global $glo_id, $word, $tp;
		if ($parm == "page")
			return "<a id='word_id_".$glo_id."'>".$tp->toHTML($word, TRUE)."</a>";
		else
			return $tp->toHTML($word, TRUE);
	}
	
	public function sc_word_description()  {
		global $description, $tp;
		return $tp->toHTML($description, TRUE);
	}
	
	public function sc_link_to_top() {
		return "<a href='".e_SELF."#top' title='".LAN_GLOSSARY_LINK_TOP_02."'>".LAN_GLOSSARY_LINK_TOP_01."</a>";
	}
	
	public function sc_word_page_title() {
		global $pref;   
		return "<a id='top'>".$pref['glossary_page_title']."</a>";
	}
	
	public function sc_word_menu_title() {
		global $pref;
		if ($pref['glossary_menu_lastword'])
			return LAN_GLOSSARY_MENU_TITLE_01;
		else
			return LAN_GLOSSARY_MENU_TITLE_02;
	}
	
	public function sc_word_anchor($parm = NULL) {
		global $wcar;
    $parms = eHelper::scParams($parm);
    $tag = varset($parms['tag'], 'a');
		return "<{$tag} id='".$wcar."'>".$wcar."</{$tag}>";
	}
	
	public function sc_word_char_link($parm = NULL) {
		global $wcar;
		$parms = eHelper::scParams($parm);
 
		$class = varset($parms['class'], 'word_char_link');
		if ($parms['link'] == "link")
			return "<a href='".e_SELF."#".$wcar."' class='" . $class . "'  title='".LAN_GLOSSARY_LINK_LETTER_01." &lt;".$wcar."&gt;"."'>".$wcar."</a>";
		else
			return $wcar;
	}
  /* reason: to use shortcode wrapper */ 
	public function sc_word_char($parm = NULL) {
		global $wcar;;
		return $wcar;
	}  
	
	public function sc_adminoptions() {
		global $glo_id;
		if (ADMIN && getperms("P"))
		{                              
			$adop_icon = (file_exists(THEME."generic/newsedit.png") ? "<img src='".THEME."generic/newsedit.png"."'  alt='' style='border:0' />"
       : "<icon class='fa fa-edit'></icon>");
			return " <a href='".e_PLUGIN."glossary/admin_config_old.php?edit.".$glo_id."' target='_blank' title='".LAN_GLOSSARY_ADMINOPTIONS_01."'>".$adop_icon."</a>\n";
		}
		else
			return "";
	}
	
	public function sc_emailitem() {
		global $glo_id, $tp, $pref;
		if (isset($pref['glossary_emailprint']) && $pref['glossary_emailprint'])
			return $tp->parseTemplate("{EMAIL_ITEM=".LAN_GLOSSARY_EMAILPRINT_01."^plugin:glossary.{$glo_id}}");
	}
	
	public function sc_printitem() {
		global $glo_id, $tp;
    $pref = e107::getPlugConfig('glossary')->getPref();
		if (isset($pref['glossary_emailprint']) && $pref['glossary_emailprint'])
			return $tp->parseTemplate("{PRINT_ITEM=".LAN_GLOSSARY_EMAILPRINT_02."^plugin:glossary.{$glo_id}}");
	}
	
	public function sc_pdfitem() {
		global $glo_id, $tp;
    $pref = e107::getPlugConfig('glossary')->getPref();
		if (isset($pref['glossary_emailprint']) && $pref['glossary_emailprint'])
			return $tp->parseTemplate("{PDF=".LAN_GLOSSARY_EMAILPRINT_03."^plugin:glossary.{$glo_id}}");
	}
	
	public function sc_link_page_navigator() {
		global $LINK_PAGE_NAVIGATOR, $rs;
    $pref = e107::getPlugConfig('glossary')->getPref();
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
	}
	
	public function sc_link_menu_navigator()  {
		global $LINK_MENU_NAVIGATOR, $rs ;
    $pref = e107::getPlugConfig('glossary')->getPref();
		$text = "";
		$mains = "";
		$baseurl = e_PLUGIN."glossary/glossaire.php";
		$bullet = defined("BULLET") ? "<img src='".THEME_ABS."images/".BULLET."' alt='' style='vertical-align: middle; border: 0;' />" : "<img src='".e_PLUGIN."glossary/images/bullet2.gif' alt='bullet' style='vertical-align: middle; border: 0;' />";
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
	}

} 

?>