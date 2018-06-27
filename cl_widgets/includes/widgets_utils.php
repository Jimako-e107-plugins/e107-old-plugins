<?php
/*
+ ----------------------------------------------------------------------------------------------------+
|        e107 website system 
|        Email: office@clabteam.com
|        Organization: Corllete (R) Lab Copyright 2007 Corllete ltd. - www.clabteam.com
|        $Id: widgets_utils.php 410 2009-06-06 14:35:57Z secretr $
|        License: GNU GENERAL PUBLIC LICENSE - http://www.gnu.org/licenses/gpl.txt
+----------------------------------------------------------------------------------------------------+
*/

if (!defined('e107_INIT')) { exit; }

function clw_utils_getall_wdata() {
    
    if(($tmp = getcachedvars('clw_widget_all_data')) || $tmp !== FALSE) return $tmp;
    
    require_once(e_HANDLER."file_class.php");
	$fl = new e_file;
	
	$list = array();
	
	$list_arr = $fl->get_files(CLW_WIDGETS, "\.php$", "standard");
	
	if(!$list_arr) return array();
	
	foreach ($list_arr as $fdata) {
        $wid = str_replace( '.php', '', $fdata['fname']); 
        if(!is_dir(CLW_WIDGETS.$wid)) continue;
        
        $widget_data = array();
        
        include(CLW_WIDGETS.$fdata['fname']);
        
        if($widget_data) $list[$wid] = $widget_data;
    }
    
    cachevars('clw_widget_all_data', $list);
    
    return $list;
}

function clw_utils_get_wdata($id) {
    
    $id = preg_replace('/[^a-zA-Z0-9\-_]/', '', $id);
    if(!$id) return false;
    
    if(($tmp = getcachedvars('clw_widget_'.$id)) || $tmp !== FALSE) return $tmp;
    
    if(!is_dir(CLW_WIDGETS.$id) || !is_readable(CLW_WIDGETS.$id.'.php')) return false;
    
    include(CLW_WIDGETS.$id.'.php');
   
    cachevars('clw_widget_'.$id, $widget_data);
    
    return $widget_data;
}

?>