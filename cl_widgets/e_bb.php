<?php
/*
+ ----------------------------------------------------------------------------------------------------+
|        e107 website system 
|        Email: office@clabteam.com
|        Organization: Corllete (R) Lab Copyright 2007 Corllete ltd. - www.clabteam.com
|        $Id: e_bb.php 410 2009-06-06 14:35:57Z secretr $
|        License: GNU GENERAL PUBLIC LICENSE - http://www.gnu.org/licenses/gpl.txt
+----------------------------------------------------------------------------------------------------+
*/
if (!defined('e107_INIT')) { exit; }


$cl_widget = &clw_widget::getInstance();

$wbbs = $cl_widget->run_e_bb();
if(empty($wbbs)) $wbbs = array();
//TODO cache

foreach ($wbbs as $widget_bb) {

	$bb['name']			= $widget_bb['name']; 
	$bb['onclick']		= $widget_bb['onclick']; 
	$bb['onclick_var']	= $widget_bb['onclick_var']; 
	            
	$bb['icon']			= $widget_bb['icon'];
	$bb['helptext']		= $widget_bb['helptext'];
	$bb['function']		= $widget_bb['function'];   
	$bb['function_var']	= $widget_bb['function_var'];  
    
	$eplug_bb[] = $bb;

    // add to the global list 
    $BBCODE_TEMPLATE .= varset($widget_bb['template'], ''); 
    $BBCODE_TEMPLATE_NEWSPOST .= varset($widget_bb['template_newspost'], ''); 
    $BBCODE_TEMPLATE_ADMIN .= varset($widget_bb['template_admin'], ''); 
    $BBCODE_TEMPLATE_CPAGE .= varset($widget_bb['template_cpage'], ''); 


}

?>