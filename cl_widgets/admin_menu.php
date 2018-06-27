<?php
/*
+ ----------------------------------------------------------------------------------------------------+
|        e107 website system 
|        Email: office@clabteam.com
|        Organization: Corllete (R) Lab Copyright 2007 Corllete ltd. - www.clabteam.com
|        $Id: admin_menu.php 410 2009-06-06 14:35:57Z secretr $
|        License: GNU GENERAL PUBLIC LICENSE - http://www.gnu.org/licenses/gpl.txt
+----------------------------------------------------------------------------------------------------+
*/
if (!defined('e107_INIT')) { exit; }
global $pageid, $cl_widget_id;

	$menutitle = CLW_LANADM_M;//"Menu Title";
	
	$butname[] = CLW_LANADM_M4;//list
	$butlink[] = "admin_config.php?list";  
	$butid[] = "list"; 

/*
	$butname[] = CLW_LANADM_M5. ;//manage
	$butlink[] = "admin_config.php?manage";  
	$butid[] = "manage"; 
*/

	$butname[] = CLW_LANADM_M2;//config
	$butlink[] = "admin_config.php?config";  
	$butid[] = "config"; 
	
	$butname[] = CLW_LANADM_M1;//help
	$butlink[] = "admin_config.php?help";  
	$butid[] = "help";
	/*
	$butname[] = CLW_LANADM_M3;//readme
	$butlink[] = "admin_config.php?readme";  
	$butid[] = "readme";
    */ 

	if($pageid == 'uninstall')
        $pageid = 'list';
        
	for ($i=0; $i<count($butname); $i++) {
        $var[$butid[$i]]['text'] = $butname[$i];
		$var[$butid[$i]]['link'] = $butlink[$i];
	};

    show_admin_menu($menutitle,$pageid, $var);
?>