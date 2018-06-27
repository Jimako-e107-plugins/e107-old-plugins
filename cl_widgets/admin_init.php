<?php
/*
 * Corllete Lab Widgets
 *
 * Copyright (C) 2006-2009 Corllete ltd (clabteam.com)
 * Support and updates at http://www.free-source.net/
 * Released under the terms and conditions of the
 * GNU General Public License (http://www.gnu.org/licenses/gpl.txt)
 *
 * CL WIdgets - Admini init
 *
 * $Id: admin_init.php 651 2009-07-17 16:40:35Z secretr $
*/
require_once('../../../../class2.php');

	if(!isset($pref['plug_installed']['cl_widgets']) || !getperms("P")) {
		echo 'Access denied!';
		exit;
	}

$eplug_admin = true;

if(!ADMIN || !getperms("P")){ header("location:".SITEURL."index.php"); exit; }

//language
    include_lan(e_PLUGIN.'cl_widgets/languages/'.e_LANGUAGE.'/admin.php');

//system messages
    $CLW_SYSMSG = array();


//ajax fix
	$qry = str_replace('&amp;', '&', e_QUERY);
	if(is_string($qry) && strpos($qry, 'ajax_used') !== false)
	{
		$qry = str_replace(array('&ajax_used=1', 'ajax_used=1&', 'ajax_used=1'), '', urldecode($qry));
	}
	/*elseif (is_array($qry))
	{
		foreach ($qry as $k => $v) 
		{
			if($v == 'ajax_used')
			{
				unset($qry[$k]);
				break;
			}
		}
		
	}*/

//actions/default action
    if($qry) {
        $acts = explode('.', $qry);
    } else {
        $acts = array();
    }

    $action = varset($acts[0]) ? $acts[0] : 'config';


//unique pageid -> admin menu
    $pageid = $action;

    require_once(e_PLUGIN.'cl_widgets/widget.php');
    $cl_widget = &clw_widget::getInstance();

//auto-detect widget_id
    require_once(CLW_APP.'includes/widgets_utils.php');
    $tmp = str_replace(e_PAGE, '', e_SELF);
    $cl_widget_id = end(explode('/', trim($tmp, '/.')));
    $cl_widget_data = clw_utils_get_wdata($cl_widget_id);
    $cl_widget_icon = "<img src='".($cl_widget_data['icon'] ? $cl_widget_data['icon'] : CLW_APP.'images/icon_48.png')."' style='border: 0 none' alt='{$cl_widget_data['title']}' />";
    $debug_info = $pref['developer'] ?  "
	        <tr>
	        	<td colspan='2'><a href='".e_SELF.'?[debug=sql,+]'.(e_QUERY ? e_QUERY : '')."'>Enable&nbsp;Debug</a>&nbsp;|&nbsp;<a href='".e_SELF.'?[debug=sql,-]'.(e_QUERY ? e_QUERY : '')."'>Disable&nbsp;Debug</a></td>
	        </tr>
    " : '';

    $cl_widget_infobox = "
        <table cellpadding='0' cellspacing='3'>
	        <tr>
		        <td style='text-align: left; width: 32px'>{$cl_widget_icon}</td>
		        <td style='text-align: left;'><strong>{$cl_widget_data['title']}</strong><br />".CLW_LANLIST_2.":{$cl_widget_data['version']}</td>
	        </tr>
	        {$debug_info}
        </table>
    ";

    //widget object
    $widget =& $cl_widget->initWidget($cl_widget_id);
    if(!$widget) die('Widget not found!');

//additional widget menu init
    $cl_widget_menu = array();
    
//v0.8 system messages
	require_once(CLW_COMPAT_PATH.'message_handler.php');

function clw_render_admin($text, $sysmsg = '') {
    global $pref, $pageid, $cl_widget_data;

    $text = $text. "
    <div style='clear: both; float: right; margin: 10px 15px; padding: 5px; font-weight: bold; border: 1px solid #ccc'>
    	<a href='http://www.free-source.net' style='text-decoration: none;'><img src='".e_PLUGIN_ABS."cl_widgets/images/icon_32.png' alt='' style='vertical-align: middle; margin-right: 10px' /></a><a href='http://www.free-source.net'>Corllete Lab Widgets v{$pref['cl_widget_ver']}</a>
    </div>";

    clw_out(CLW_LANADM.' - '.$cl_widget_data['title'], $text, $sysmsg);
};


function clw_out($title, $body, $arrmsg = false, $type = '') {
    global $ns, $pageid;

    $emessage = &eMessage::getInstance();
	if(!$type) $type = E_MESSAGE_INFO;
	
    if($arrmsg && is_array($arrmsg)) 
    {
    	foreach ($arrmsg as $msg)
    	{
    		$emessage->add($msg, $type);
    	}
    } 
    elseif($arrmsg) 
    {
    	$emessage->add($arrmsg, $type);
    }

    $smsg = clw_getmsg(false);
    if(!$smsg)
    {
    	echo $smsg;
    }
    $ns -> tablerender($title, $smsg.$body);
}

function clw_getmsg($return = true)
{
    global $ns;

    $emessage = &eMessage::getInstance();
	$cl_widget = clw_widget::getInstance();
	
	$smsg = $emessage->render();
	if(!empty($smsg) && !$cl_widget->getPref('cl_08compat'))
	{
		$smsg = $ns->tablerender('System message', $smsg, 'default', true);
	}
	if(!$return)
	{
		echo $smsg;
		return '';
	}
	return $smsg;
}

function clw_sessmgs($msg, $type = '') {
    if(!$msg) return;
	
    $emessage = &eMessage::getInstance();
    $emessage->add($msg, ($type ? $type : E_MESSAGE_INFO), true);
}

function admin_config_adminmenu() {

    global $pageid, $cl_widget_id, $cl_widget_data, $cl_widget_menu;

	$menutitle = CLW_LANMANAGE_10.' '.$cl_widget_data['title'];//"Menu Title";

	if(varsettrue($cl_widget_menu)) {
        foreach ($cl_widget_menu as $value) {
        	$butname[] = $value['menu_title'];
        	$butlink[] = $value['menu_link'];
        	$butid[] = $value['menu_action'];
        }
    }

	$butname[] = CLW_LANADM_M4;//main list
	$butlink[] = CLW_APP_ABS."admin_config.php";
	$butid[] = "";

	for ($i=0; $i<count($butname); $i++) {
        $var[$butid[$i]]['text'] = $butname[$i];
		$var[$butid[$i]]['link'] = $butlink[$i];
	};

    show_admin_menu($menutitle, $pageid, $var);
}
?>