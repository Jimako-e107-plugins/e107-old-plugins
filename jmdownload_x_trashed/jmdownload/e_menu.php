<?php
/*
 * e107 website system
 *
 * Copyright (C) 2008-2015 e107 Inc (e107.org)
 * Released under the terms and conditions of the
 * GNU General Public License (http://www.gnu.org/licenses/gpl.txt)
 *
 *
*/

if (!defined('e107_INIT')) { exit; }

e107::lan("jmdownload" , "lan_menu");

class jmdownload_menu
{
	function __construct()
	{
		 
	}

	/**
	 * Configuration Fields.
	 * @return array
	 */
	public function config($menu='')
	{

		$fields = array();
		$cats = array();
		if($parents = e107::getDB()->retrieve('download_category', '*', " ORDER BY download_category_name", true ))
		{
			
			$parent_item[0] = LAN_JMD_TOPDOWNLOADS_ALL;
            foreach($parents as $parent) {
              $parent_item[$parent['download_category_id']] = $parent['download_category_name']. " - ". $parent['download_category_id'];
			}

			$cats =  $parent_item;
		}
		else 
		{
			$cats[0] = LAN_JMD_TOPDOWNLOADS_NO_CATS_YET;
		}
	 
		$periods = array('0'=>LAN_JMD_TOPDOWNLOADS_ALL_TIME, '7'=>LAN_JMD_TOPDOWNLOADS_WEEK, '30'=> LAN_JMD_TOPDOWNLOADS_MONTH ); 

		switch($menu)
		{
			case "latest_downloads":
      
			$fields['menuCaption']      = array('title'=> LAN_JMD_HELP_LAN_23, 'type'=>'text', 'multilan'=>true, 'writeParms'=>array('size'=>'xxlarge'));
			$fields['menuLimit']        = array('title'=> LAN_JMD_HELP_LAN_01, 'type'=>'text', 'writeParms'=>array('size'=>'xxlarge', 'default'=>5 ));
			$fields['menuTableStyle']   = array('title'=> LAN_JMD_HELP_LAN_24, 'type'=>'text', 'writeParms'=>array('size'=>'xxlarge', 'default'=>'jmdownload' )); 
			 
			break;

			case "top_downloads":
      
				$fields['menuCaption']      	 = array('title'=> LAN_JMD_HELP_LAN_23, 'type'=>'text', 'multilan'=>true, 'writeParms'=>array('size'=>'xxlarge',
				'default'=>LAN_JMD_TOPDOWNLOADS_MENU_TITLE));

				$fields['menuLimit']        	 = array('title'=> LAN_JMD_TOPDOWNLOADS_COUNT, 'type'=>'text', 'writeParms'=>array('size'=>'xxlarge', 'default'=>5 ));
				
				$fields['top_downloads_cat']     = array('title'=> LAN_JMD_DOWNLOADS_CATEGORY, 'type'=>'dropdown',
				 'writeParms'=>array('size'=>'xxlarge', 'optArray'=> $cats ));

				$fields['top_downloads_period']  = array('title'=> LAN_JMD_TOPDOWNLOADS_PERIOD, 'type'=>'dropdown', 'writeParms'=>array('size'=>'xxlarge', 
				'optArray'=> $periods ));

				$fields['menuTableStyle']   	 = array('title'=> LAN_JMD_HELP_LAN_24, 'type'=>'text', 'writeParms'=>array('size'=>'xxlarge', 'default'=>'jmdownload' )); 
				
				break;			
		} 
		
		return $fields;
	}

}
 
 