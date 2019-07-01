<?php
/*
+ ----------------------------------------------------------------------------------------------------+
|        e107 website system 
|        Email: office@clabteam.com
|        Organization: Corllete® Lab Copyright 2007 Corllete ltd. - www.clabteam.com
|        $Id: admin_menu.php 667 2007-11-15 12:49:31Z secretr $
|        License: GNU GENERAL PUBLIC LICENSE - http://www.gnu.org/licenses/gpl.txt
+----------------------------------------------------------------------------------------------------+
*/
if (!defined('e107_INIT')) { exit; }
global $pageid;

	$menutitle = FBOX_LANADM_M;//"Menu Title";
	
	$butname[] = FBOX_LANADM_M5;//list
	$butlink[] = "admin_config.php?list";  
	$butid[] = "list"; 

	$butname[] = FBOX_LANADM_M4;//create|edit
	$butlink[] = "admin_config.php?manage";  
	$butid[] = "manage"; 

	$butname[] = FBOX_LANADM_M2;//config
	$butlink[] = "admin_config.php?config";  
	$butid[] = "config"; 
	
	$butname[] = FBOX_LANADM_M1;//help
	$butlink[] = "admin_config.php?help";  
	$butid[] = "help";
	
	$butname[] = FBOX_LANADM_M3;//readme
	$butlink[] = "admin_config.php?readme";  
	$butid[] = "readme";
    
    if($pageid == 'delete')
        $pageid = 'list';
        
	for ($i=0; $i<count($butname); $i++) {
        $var[$butid[$i]]['text'] = $butname[$i];
		$var[$butid[$i]]['link'] = $butlink[$i];
	};

    show_admin_menu($menutitle,$pageid, $var);
?>