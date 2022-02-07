<?php
/*
 * e107 website system
 *
 * Copyright (C) 2008-2016 e107 Inc (e107.org)
 * Released under the terms and conditions of the
 * GNU General Public License (http://www.gnu.org/licenses/gpl.txt)
 *
 * jm_download menu file.
 *
 */


if (!defined('e107_INIT')) { exit; }

$text = "";
e107::lan("jmdownload" , "lan_front");

$template = e107::getTemplate('jmdownload', 'latest_menu'); 


/* CAPTION FROM MENU SETTINGS */
$menu_caption = '';
if(isset($parm['menuCaption'][e_LANGUAGE]))
{
	$menu_caption = $parm['menuCaption'][e_LANGUAGE];
}
else $menu_caption = $parm['menuCaption']; 

$vars = array('{MENU_CAPTION}' => $menu_caption);

$caption  = str_replace(array_keys($vars), $vars, $template['caption']);    
 
/* ITEM LIMIT FROM MENU SETTINGS */
$menu_limit = 0;
if(isset($parm['menuLimit']))
{
	$menu_limit = $parm['menuLimit'];
}
else $menu_limit = $parm['menuLimit']; 


/* TABLERENDER FROM MENU SETTINGS */
$menu_tablestyle = 0;
if(isset($parm['menuTableStyle']))
{
	$menu_tablestyle = $parm['menuTableStyle'];
}
else $menu_tablestyle = $parm['menuTableStyle']; 
 
require_once(e_PLUGIN."/jmdownload/classes/latest_downloads_class.php");

$class = new latest_downloads_list();  
$listArray = $class->getListData($menu_limit);
 
$start    =  $tp->parseTemplate($template[$sectiontemplate]['start'] );

$sc = e107::getScBatch('jmdownload', 'jmdownload');

/*	 * Example e107::getScBatch('contact')->wrapper('contact/form');
	 * which results in using the $CONTACT_WRAPPER['form'] wrapper in the parsing phase   */
	 
$sc->wrapper('latest_menu/item');
 
$start    =  $tp->parseTemplate($template['start'], true, $sc);
$end      =  $tp->parseTemplate($template['end'], true, $sc);

 
$items ='';

foreach ($listArray as  $v)
{			
	$sc->setVars($v);   
    $items    .=  $tp->parseTemplate($template['item']['item'], true, $sc);       
}

e107::getRender()->tablerender($caption, $start.$items.$end, $menu_tablestyle);



?>