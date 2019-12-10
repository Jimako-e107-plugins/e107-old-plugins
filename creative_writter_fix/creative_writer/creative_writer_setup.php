<?php
/*
* e107 website system
*
* Copyright (c) 2008-2016 e107 Inc (e107.org)
* Released under the terms and conditions of the
* GNU General Public License (http://www.gnu.org/licenses/gpl.txt)
*
* Custom creative_writer install/uninstall/update routines
*
*/
 
e107::lan('creative_writer');

class creative_writer_setup
{
 
	function install_post($var)
	{
		$sql = e107::getDb();
		$mes = e107::getMessage();
		$tp  = e107::getParser();
 
    /* for developing */
    $query = "INSERT INTO #cw_category (cw_category_id, cw_category_name, cw_category_icon, cw_category_lastupdated, cw_category_class) VALUES 
      (NULL, '".$tp->toDB(LAN_CWRITER_EXAMPLE_CATEGORY_01)."', '', '".time()."',   '0'),
      (NULL, '".$tp->toDB(LAN_CWRITER_EXAMPLE_CATEGORY_02)."', '', '".time()."',   '0') 
 		";
		$status = ($sql->gen($query, true)) ? E_MESSAGE_SUCCESS : E_MESSAGE_ERROR;
		
		$mes->add(LAN_DEFAULT_TABLE_DATA.": cw_category", $status);
    $query = "INSERT INTO #cw_genre (cw_genre_id, cw_genre_name, cw_genre_icon, cw_genre_lastupdated) VALUES 
      (NULL, '".$tp->toDB(LAN_CWRITER_EXAMPLE_GENRE_01)."', '', '".time()."'),
      (NULL, '".$tp->toDB(LAN_CWRITER_EXAMPLE_GENRE_02)."', '', '".time()."') 
 		";
		$status = ($sql->gen($query, true)) ? E_MESSAGE_SUCCESS : E_MESSAGE_ERROR;
		$mes->add(LAN_DEFAULT_TABLE_DATA.": cw_genre", $status);		
		
		$mes->add(LAN_DEFAULT_TABLE_DATA.": cw_character", $status);
    $query = "INSERT INTO #cw_character (cw_character_id, cw_character_name, cw_character_icon, cw_character_lastupdated) VALUES 
      (NULL, '".$tp->toDB(LAN_CWRITER_EXAMPLE_CHARACTER_01)."', '', '".time()."'),
      (NULL, '".$tp->toDB(LAN_CWRITER_EXAMPLE_CHARACTER_02)."', '', '".time()."') 
 		";
		$status = ($sql->gen($query, true)) ? E_MESSAGE_SUCCESS : E_MESSAGE_ERROR;
		$mes->add(LAN_DEFAULT_TABLE_DATA.": cw_character", $status);			
		
		
		
		
    // set text prefs
	  $prefdata = e107::getPlugConfig('creative_writer')->getPref();
	  $prefdata['cwriter_terms']				= "Don't write anything I don't like";
		$prefdata['cwriter_currency']	= "&pound;";
		$prefdata['cwriter_metad']			= "Description";
		$prefdata['metak']	= "Father barry's plugin,creative writer";

		// setting not to change plugin.xml
		$prefdata['cwriter_read']			= "0";
		$prefdata['cwriter_create']			= "253";
		$prefdata['cwriter_approval']			= "250";		
		$prefdata['cwriter_admin']			= "250";
						
    e107::getPlugConfig('creative_writer')->setPref($prefdata)->save();
		
	}
 
}