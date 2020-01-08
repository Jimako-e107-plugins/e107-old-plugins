<?php
/*
* e107 website system
*
* Copyright (c) 2008-2016 e107 Inc (e107.org)
* Released under the terms and conditions of the
* GNU General Public License (http://www.gnu.org/licenses/gpl.txt)
*
* Custom Glossary install/uninstall/update routines
*
*/

class glossary_setup
{
 
	function install_post($var)
	{
		$sql = e107::getDb();
		$mes = e107::getMessage();
		$tp = e107::getParser();
		 
		$query = "INSERT INTO #glossary (glo_id, glo_name, glo_description, glo_author, glo_datestamp, glo_approved, glo_linked) VALUES 
      (1, '".$tp->toDB(LAN_GLOSSARY_EXAMPLE_WRD_01)."', '".$tp->toDB(LAN_GLOSSARY_EXAMPLE_DEF_01)."', '".USERID.".".USERNAME."', '".time()."', '1', '0'),
			(2, '".$tp->toDB(LAN_GLOSSARY_EXAMPLE_WRD_02)."', '".$tp->toDB(LAN_GLOSSARY_EXAMPLE_DEF_02)."', '".USERID.".".USERNAME."', '".time()."', '1', '0');
 		";
		
		$status = ($sql->gen($query, true)) ? E_MESSAGE_SUCCESS : E_MESSAGE_ERROR;
		$mes->add(LAN_DEFAULT_TABLE_DATA.": glossary", $status);
  
    // text prefs cant be set in plugin.xml 
	  $prefdata = e107::getPlugConfig('glossary')->getPref();
	  $prefdata['glossary_page_title']				= LAN_GLOSSARY_PLUGIN_07;
		$prefdata['glossary_page_caption_nav']	= LAN_GLOSSARY_PLUGIN_08;
		$prefdata['glossary_menu_caption']			= LAN_GLOSSARY_PLUGIN_01;
		$prefdata['glossary_menu_caption_nav']	= LAN_GLOSSARY_PLUGIN_08;

		// temp fix for false values 
	  $prefdata['glossary_emailprint']				= '0';
		$prefdata['glossary_page_link_rendertype']	= '0';
		$prefdata['glossary_menu_link_rendertype']			= '0';
				
    e107::getPlugConfig('glossary')->setPref($prefdata)->save();
		
	}
 
}
