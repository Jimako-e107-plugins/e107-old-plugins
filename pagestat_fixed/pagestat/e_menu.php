<?php
/*
 * e107 website system
 *
 * Copyright (C) 2008-2016 e107 Inc (e107.org)
 * Released under the terms and conditions of the
 * GNU General Public License (http://www.gnu.org/licenses/gpl.txt)
 *
 *
*/

if (!defined('e107_INIT')) { exit; }

//v2.x Standard for extending menu configuration within Menu Manager. (replacement for v1.x config.php)
//TODO Configure for news menus. 

class pagestat_menu
{

	function __construct()
	{
		// e107::lan('news','admin', 'true');

	}

	/**
	 * Configuration Fields.
	 * @return array
	 */
	public function config($menu='') //TODO LAN
	{
		$fields = array();
 
   

		switch($menu)
		{
			case "popularnews":
					$fields['caption']      = array('title'=> LAN_CAPTION, 'type'=>'text', 'multilan'=>true, 'writeParms'=>array('size'=>'xxlarge'));				
					$fields['count']        = array('title'=> LAN_LIMIT, 'type'=>'text', 'writeParms'=>array('pattern'=>'[0-9]*', 'size'=>'mini'));
			break;
 		}
 
		 return $fields;


	}


}

// optional
class pagestat_menu_form extends e_form
{


} 