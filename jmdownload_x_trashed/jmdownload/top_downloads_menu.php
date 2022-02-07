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
$template = e107::getTemplate('jmdownload', 'top_menu'); 

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
$menu_limit = 5;
if(isset($parm['menuLimit']))
{
	$menu_limit = $parm['menuLimit'];
}


/* TABLERENDER FROM MENU SETTINGS */
$menu_tablestyle = '';
if(isset($parm['menuTableStyle']))
{
	$menu_tablestyle = $parm['menuTableStyle'];
}

/* CATEGORY FROM MENU SETTINGS */
$menu_category = 0;
if(isset($parm['top_downloads_cat']))
{
	$menu_category = $parm['top_downloads_cat'];
}


/* PERIOD FROM MENU SETTINGS */
$menu_period = 30;   
if(isset($parm['top_downloads_period']))
{
	$menu_period = $parm['top_downloads_period'];
}

require_once(e_PLUGIN."/jmdownload/classes/top_downloads_class.php");

$class = new top_downloads_list();  
 
$class->setAmount($menu_limit);
$class->setCategory($menu_category);
$class->setPeriod($menu_period);
   
$listArray = $class->getTopDownloadsData();

$start    =  $tp->parseTemplate($template[$sectiontemplate]['start'] );

$sc = e107::getScBatch('jmdownload', 'jmdownload');
 
$sc->wrapper('top_menu/item');;
 
$start    =  $tp->parseTemplate($template['start'], true, $sc);
$end      =  $tp->parseTemplate($template['end'], true, $sc);

$items ='';

foreach ($listArray as  $v)
{			
	$v['period'] = $menu_period;
	$sc->setVars($v);   
    $items    .=  $tp->parseTemplate($template['item']['item'], true, $sc);      
}

e107::getRender()->tablerender($caption, $start.$items.$end, $menu_tablestyle);



?>