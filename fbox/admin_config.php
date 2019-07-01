<?php
/*
+ ----------------------------------------------------------------------------------------------------+
|        e107 website system 
|        Email: office@clabteam.com
|        Organization: Corllete® Lab Copyright 2007 Corllete ltd. - www.clabteam.com
|        $Id: admin_config.php 667 2007-11-15 12:49:31Z secretr $
|        License: GNU GENERAL PUBLIC LICENSE - http://www.gnu.org/licenses/gpl.txt
+----------------------------------------------------------------------------------------------------+
*/ 
require_once("../../class2.php");

if(!getperms("P")){ header("location:".e_BASE."index.php"); exit; } 

//language
    include_lan(e_PLUGIN.'fbox/languages/'.e_LANGUAGE.'.php');


//session messages - start new session only if required - without warning
if(!session_id()) {
    session_start();
}

if(!defined('USER_WIDTH')) 
    define('USER_WIDTH', 'width: 98%');
    
//authorize
    require_once(e_ADMIN.'auth.php');
    

//actions/default action
    if(e_QUERY) {
        $tmp = explode('.', e_QUERY);
    } else {
        $tmp = array();
    }
    
    $action = varset($tmp[0]) ? $tmp[0] : 'list';


//unique pageid -> admin menu
    $pageid = $action;

//system messages
    $FBOX_SYSMSG = array();

// main code ----------------------------------------------------------------------------------------------------

//prepare
    fbox_prepare($action, $tmp);
    
    unset($tmp);
    


$text = '';
echo "<div style='float: right; margin-right: 20px; margin-bottom: 10px; padding: 5px; font-weight: bold; border: 1px solid #ccc'><a href='http://www.free-source.net' style='text-decoration: none;'><img src='".e_PLUGIN_ABS."fbox/images/icon_32.png' alt='' style='vertical-align: middle; margin-right: 10px' /></a><a href='http://www.free-source.net'>Corllete Lab's Feature Box v{$pref['fbox_ver']}</a></div>";
require_once(e_ADMIN."footer.php"); 
exit;


function fbox_prepare($action, $rel=array()) {
    global $FBOX_SYSMSG, $ns;
    
    //require_once the proper handler
    require_once(e_PLUGIN.'fbox/includes/fbox_admin_handler.php');

    //check admin events for this action
    fbox_event($action, varset($_POST['admin_event']), $rel);
    
    //render current page
    fbox_render($action, $rel);
}

function fbox_render($action, $rel=array()) {
    global $FBOX_SYSMSG;
    
    //render function
    $rfunc = "fbox_page_{$action}";
    if(function_exists($rfunc))
        $rfunc($rel);    
    else 
        fbox_out(FBOX_LANADM, LAN_ERROR, array(FBOX_LANSYSMSG_3));
}

function fbox_event($action, $event, $rel=array()) {
    global $FBOX_SYSMSG;
    
    if($event) {
        //event function
        $efunc = "fbox_event_{$action}";
        if(function_exists($efunc))
            return $efunc($event, $rel);
    }
    
    return '';
}

function fbox_out($title, $body, $arrmsg=false) {
    global $ns;
    
    if(varsettrue($_SESSION['sys_msg'])) {
        $arrmsg[] = $_SESSION['sys_msg'];
        unset($_SESSION['sys_msg']);
    }
    
    if($arrmsg && is_array($arrmsg))
        $ns -> tablerender(FBOX_LANSYSMSG, '<center>'.implode('<br /><br />', $arrmsg).'</center>');
    
    $ns -> tablerender($title, $body);
}

function fbox_sessmgs($msg) {   
    if(!$msg) return;
    
    if(varsettrue($_SESSION['sys_msg'])) {
        $_SESSION['sys_msg'] .= '<br />'.$msg;
    } else {
        $_SESSION['sys_msg'] = $msg;
    }
}
?>