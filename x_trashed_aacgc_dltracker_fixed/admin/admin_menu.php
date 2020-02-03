<?php
/*
#######################################
#     e107 website system plguin      #
#     AACGC Network Bar               #
#     by Reid Baughman                #
#     http://www.aacgc.com            #
#######################################

//*
//*		Update 				:	Jimako (e107 v2.x) 
//*
//*   Web site			: https://www.e107sk.com/
//*
//*		Last Change		:	09.07.2019
//*
//*		Version				:	2.1.1
//***************************************************************
*/

if (!defined('e107_INIT')) { exit; }
require_once("../../../class2.php");
 
/* Notes for future re-using
   Always use prefs as first option, it saves time
*/ 

// e107::lan('aacgc_dltracker',true);
 
class aacgc_dltrackermenu_adminArea extends e_admin_dispatcher
{
            
	protected $adminMenu = array(
  
	'main/prefs' 		=> array('caption'=> LAN_PREFS, 'perm' => 'P', 'url'=>'admin_config.php'),
	'tracker/list'			=> array('caption'=> "Download Overviews", 'perm' => '0', 'url'=>'admin_tracker.php'),
  'main/help'		=> array('caption'=> LAN_HELP, 'perm' => '0', 'url'=>'admin_config.php')
	);      
	
 	protected $modes = array(	
	
		'main'	=> array(
			'controller' 	=> 'aacgc_dltracker_ui',
			'path' 			=> null,
			'ui' 			=> 'aacgc_dltracker_form_ui',
			'uipath' 		=> null
		),
		'tracker'	=> array(
			'controller' 	=> 'download_requests_ui',
			'path' 			=> null,
			'ui' 			=> 'download_requests_form_ui',
			'uipath' 		=> null
		),
		
		

	);
	
	protected $menuTitle = 'Download Tracker';
 
}