<?php
/*
 * Corllete Lab Widgets
 *
 * Copyright (C) 2006-2009 Corllete ltd (clabteam.com)
 * Support and updates at http://www.free-source.net/
 * Released under the terms and conditions of the
 * GNU General Public License (http://www.gnu.org/licenses/gpl.txt)
 *
 * CL WIdgets - Administration area
 *
 * $Id: admin_config.php 1536 2011-04-13 13:04:19Z berckoff $
*/

require_once('../../class2.php');

if(!ADMIN || !getperms("P")){ header("location:".SITEURL."index.php"); exit; }

//language
    include_lan(e_PLUGIN.'cl_widgets/languages/'.e_LANGUAGE.'/admin.php');


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

    $action = varset($acts[0]) ? $acts[0] : 'list';


//unique pageid -> admin menu
    $pageid = $action;

    require_once(e_PLUGIN.'cl_widgets/widget.php');
    $cl_widget = &clw_widget::getInstance();


//require_admin handler
    require_once(CLW_APP.'includes/widgets_admin_handler.php');

//global per action event
    clw_event($action, $action, $acts);

//authorize + HEADER code
    require_once(e_ADMIN.'auth.php');




//prepare & render
    clw_prepare($action, $acts);

    $text = '';
    unset($acts);

echo "<div style='float: right; margin-right: 20px; margin-bottom: 10px; padding: 5px; font-weight: bold; border: 1px solid #ccc'><a href='http://www.free-source.net' style='text-decoration: none;'><img src='".e_PLUGIN_ABS."cl_widgets/images/icon_32.png' alt='' style='vertical-align: middle; margin-right: 10px' /></a><a href='http://www.free-source.net'>Corllete Lab Widgets v{$pref['cl_widget_ver']}</a></div>";
require_once(e_ADMIN."footer.php");

exit;

function clw_prepare($action, $rel=array()) {
    global $CLW_SYSMSG, $ns;

    //check admin events for this action
    clw_event($action, varset($_POST['admin_event']), $rel);

    //render current page
    clw_render($action, $rel);
}

function clw_render($action, $rel=array()) {
    global $CLW_SYSMSG;

    //render function
    $rfunc = "clw_page_{$action}";
    if(function_exists($rfunc))
        $rfunc($rel);
    else
        clw_out(CLW_LANADM, LAN_ERROR, array(CLW_LANSYSMSG_3));
}

function clw_event($action, $event, $rel=array()) {
    if($event) {
        //event function
        $efunc = "clw_event_{$action}";

        if(function_exists($efunc)) {
            return $efunc($event, $rel);
        }
    }

    return '';
}
/*
function clw_out($title, $body, $arrmsg=false) {
    global $ns;

    require_once(CLW_COMPAT_PATH.'message_handler.php');
    $emessage = &eMessage::getInstance();

    if(varsettrue($_SESSION['clw_sys_msg'])) {
        //$arrmsg[] = $_SESSION['clw_sys_msg'];
        $emessage->add($_SESSION['clw_sys_msg']);
    }

    $_SESSION['clw_sys_msg'] = '';

    if($arrmsg && is_array($arrmsg)) {
    	foreach ($arrmsg as $msg)
    	{
    		$emessage->add($msg);
    	}
    } elseif($arrmsg) {
    	$emessage->add($arrmsg);
    }

    $ns -> tablerender($title, $emessage->render().$body);
}

function clw_sessmgs($msg) {
    if(!$msg) return;

    if(varsettrue($_SESSION['clw_sys_msg'])) {
        $_SESSION['clw_sys_msg'] .= '<br />'.$msg;
    } else {
        $_SESSION['clw_sys_msg'] = $msg;
    }
}
*/
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

    $smsg = clw_getmsg(true);
    $cl_widget = clw_widget::getInstance();
    
    if(!$cl_widget->getPref('cl_08compat'))
    {
    	echo $smsg;
    	$smsg = '';
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
?>