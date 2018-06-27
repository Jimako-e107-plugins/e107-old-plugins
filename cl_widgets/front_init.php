<?php
/*
 * Corllete Lab Widgets
 *
 * Copyright (C) 2006-2009 Corllete ltd (clabteam.com)
 * Support and updates at http://www.free-source.net/
 * Released under the terms and conditions of the
 * GNU General Public License (http://www.gnu.org/licenses/gpl.txt)
 *
 * CL WIdgets - Front-end init
 *
 * $Id: front_init.php 502 2009-06-19 09:51:36Z secretr $
*/
require_once('../../../../class2.php');

	if(!isset($pref['plug_installed']['cl_widgets'])) {
		echo 'Access denied!';
		exit;
	}

//language
    include_lan(e_PLUGIN.'cl_widgets/languages/'.e_LANGUAGE.'/plugin.php');


//session messages - start new session only if required - without warning
if(!session_id()) {
    session_start();
}

//system messages
    $CLW_SYSMSG = array();


//actions/default action
    if(e_QUERY) {
        $acts = explode('.', e_QUERY);
    } else {
        $acts = array();
    }
    
    $action = varset($acts[0]) ? $acts[0] : 'config';
    
    require_once(e_PLUGIN.'cl_widgets/widget.php');
    $cl_widget = &clw_widget::getInstance();
    
//auto-detect widget_id
    require_once(CLW_APP.'includes/widgets_utils.php');
    $tmp = str_replace(e_PAGE, '', e_SELF);
    $cl_widget_id = end(explode('/', trim($tmp, '/.')));
    $cl_widget_data = clw_utils_get_wdata($cl_widget_id);
    $cl_widget_icon = "<img src='".($cl_widget_data['icon'] ? $cl_widget_data['icon'] : CLW_APP.'images/icon_32.png')."' style='border: 0 none' alt='{$cl_widget_data['title']}' />";
    $cl_widget_infobox = "
        <table cellpadding='0' cellspacing='3'>
        <tr>
        <td style='text-align: left; width: 32px'>{$cl_widget_icon}</td>
        <td style='text-align: left;'><strong>{$cl_widget_data['title']}</strong><br />".CLW_LANPLUG_VER.":{$cl_widget_data['version']}</td>
        </tr>
        </table>
    ";
    
    //widget object
    $widget =& $cl_widget->initWidget($cl_widget_id);
    

?>