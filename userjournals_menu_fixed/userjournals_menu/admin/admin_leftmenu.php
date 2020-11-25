<?php

//file name see:  https://github.com/e107inc/e107/issues/4056

/*
* e107 website system
*
* Copyright (C) 2008-2013 e107 Inc (e107.org)
* Released under the terms and conditions of the
* GNU General Public License (http://www.gnu.org/licenses/gpl.txt)
*
* e107 Userjournals Plugin
*
* #######################################
* #     e107 website system plugin      #
* #     by Jimako                    	 #
* #     https://www.e107sk.com          #
* #######################################
*/ 

/*
+---------------------------------------------------------------+
|        UserJournals plugin for e107 website system
|
|        ©Del Rudolph 2003
|        http://www.downinit.com/
|        del@downinit.com
|
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
+---------------------------------------------------------------+

$eplug_author        = "Del Rudolph, SKiTZ716, bkwon, bugrain";

*/

if (!defined('e107_INIT')) {exit;}

require_once "../../../class2.php";
 
e107::plugLan("userjournals_menu" , "admin/".e_LANGUAGE, false);
e107::plugLan("userjournals_menu" , e_LANGUAGE, false);

class leftmenu_adminArea extends e_admin_dispatcher
{

    protected $modes = array(	
	
		'main'	=> array(
			'controller' 	=> 'userjournals_ui',
			'path' 			=> null,
			'ui' 			=> 'userjournals_form_ui',
			'uipath' 		=> null
		),
		

		'cat'	=> array(
			'controller' 	=> 'userjournals_categories_ui',
			'path' 			=> null,
			'ui' 			=> 'userjournals_categories_form_ui',
			'uipath' 		=> null
		),
		
		'synopsis'	=> array(
			'controller' 	=> 'userjournals_synopsis_ui',
			'path' 			=> null,
			'ui' 			=> 'userjournals_form_ui',
			'uipath' 		=> null
		),
	);	

    protected $adminMenu = array(

		'cat/list'			=> array('caption'=> JOURNAL_MENU_01, 'perm' => 'P'),
		'cat/create'		=> array('caption'=> JOURNAL_MENU_01_ADD, 'perm' => 'P'),

		'main/list'			=> array('caption'=> UJ8, 'perm' => 'P'),
		'main/create'		=> array('caption'=> UJ10, 'perm' => 'P'),
	
		'synopsis/list'		=> array('caption'=> UJ52, 'perm' => 'P'),
	//	'synopsis/create'	=> array('caption'=> UJ10, 'perm' => 'P'),

		'main/prefs' 		=> array('caption'=> LAN_JOURNAL_MENU_00, 'perm' => 'P'),	

		'main/div0'      	=> array('divider'=> true),
		'main/readme'		=> array('caption'=> JOURNAL_MENU_99, 'perm' => 'P'),
		
	);

	protected $adminMenuAliases = array(
		'main/edit'	=> 'main/list'				
	);	
	
	protected $menuTitle = LAN_JOURNAL_A0;

    public function init()
    {

     

    }

}
