<?php
/**
 * $Id: admin_menu.php,v 1.2 2009/10/22 15:03:36 michiel Exp $
 * 
 * Rank System for e107 v7xx - by Michiel Horvers
 * This module for the e107 .7+ website system
 * Copyright Michiel Horvers 2009
 *
 * Released under the terms and conditions of the
 * GNU General Public License (http://gnu.org).
 *
 * Revision: $Revision: 1.2 $
 * Last Modified: $Date: 2009/10/22 15:03:36 $
 *
 * Change Log:
 * $Log: admin_menu.php,v $
 * Revision 1.2  2009/10/22 15:03:36  michiel
 * Implemented customizable conditions
 *
 * Revision 1.1  2009/03/28 13:01:37  michiel
 * Initial CVS revision
 *
 *  
 */
if (!defined('e107_INIT'))
{
    exit;
}
include_lan(e_PLUGIN . 'rank_system/languages/admin/' . e_LANGUAGE . '.php');
global $RANK_PREF;
$readonly = (getperms('0') || check_class($RANK_PREF['rank_plugclass']) ? false : true);

$action = basename($_SERVER['PHP_SELF'], '.php');

if (!$readonly) { 
	$var['admin_config']['text'] = ADLAN_RS_MM01;
	$var['admin_config']['link'] = 'admin_config.php';
	
	$var['admin_conddef']['text'] = ADLAN_RS_MM09;
	$var['admin_conddef']['link'] = 'admin_conddef.php';
	
	$var['admin_catdef']['text'] = ADLAN_RS_MM02;
	$var['admin_catdef']['link'] = 'admin_catdef.php';
	
	$var['admin_rankdef']['text'] = ADLAN_RS_MM03;
	$var['admin_rankdef']['link'] = 'admin_rankdef.php';
}

$var['admin_curranks']['text'] = ADLAN_RS_MM04;
$var['admin_curranks']['link'] = 'admin_curranks.php';

if (!$readonly) {
	$var['admin_med_catdef']['text'] = ADLAN_RS_MM05;
	$var['admin_med_catdef']['link'] = 'admin_med_catdef.php';
	
	$var['admin_med_goaldef']['text'] = ADLAN_RS_MM06;
	$var['admin_med_goaldef']['link'] = 'admin_med_goaldef.php';
	
	$var['admin_medaldef']['text'] = ADLAN_RS_MM07;
	$var['admin_medaldef']['link'] = 'admin_medaldef.php';
}

$var['admin_curmedals']['text'] = ADLAN_RS_MM08;
$var['admin_curmedals']['link'] = 'admin_curmedals.php';

$var['admin_currecomm']['text'] = ADLAN_RS_RM01;
$var['admin_currecomm']['link'] = 'admin_currecomm.php';

if (!$readonly) {
	$var['admin_readme']['text'] = ADLAN_RS_MM90;
	$var['admin_readme']['link'] = 'admin_readme.php';

//$var['admin_vupdate']['text'] = ADLAN_RS_MM91;
//$var['admin_vupdate']['link'] = 'admin_vupdate.php';
}

show_admin_menu(ADLAN_RS_MM, $action, $var);

?>