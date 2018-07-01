<?php
/*
	*************************************************************
	*															*
	*		Plugin		:	Advanced Medal System (e107 v7+)			*
	*		Author	:	garyt								*
	*		Copyright	:	2009								*
	*		Web site	:										*
	*		Description	:	Advanced Medal System				*
	*		Version	:	1.4								*
	*		Date		:	17 Oct 2009							*
	*		Revisions	:	none								*
	*															*
	*-----------------------------------------------------------*
	*															*
	*		Released under the terms and conditions of the		*
	*		GNU General Public License (http://gnu.org).		*
	*															*
	*************************************************************
*/

	if (!defined('e107_INIT'))
	{
    	exit;
	}

	if (file_exists(e_PLUGIN . "advmedsys/languages/Admin/" . e_LANGUAGE . ".php"))
    @require_once (e_PLUGIN . "advmedsys/languages/Admin/" . e_LANGUAGE . ".php");
	else
    @require_once (e_PLUGIN . "advmedsys/languages/Admin/English.php");

	$menutitle  = AMS_ADMIM_S13;
	
	$butname[] = AMS_ADMIM_S11;
	$butlink[] = "admin_main.php";
	$butid[]   = "admin_menu_01";
	
	$butname[] = AMS_ADMIM_S6;
	$butlink[] = "admin_main_overview.php";
	$butid[]   = "admin_menu_02";
	
	$butname[] = AMS_ADMIM_S5;
	$butlink[] = "admin_main_new.php";
	$butid[]   = "admin_menu_03";
	
	$butname[] = AMS_ADMIM_S7;
	$butlink[] = "admin_main_give.php";
	$butid[]   = "admin_menu_04";
	
	$butname[] = AMS_ADMIM_S8;
	$butlink[] = "admin_main_take.php";
	$butid[]   = "admin_menu_05";	
	
	$butname[] = AMS_ADMIM_S2;
	$butlink[] = "admin_main_user.php";
	$butid[]   = "admin_menu_06";
	
	$butname[] = AMS_ADMIM_S4;
	$butlink[] = "admin_main_mo.php";
	$butid[]   = "admin_menu_07";
	
	global $pageid;
	for ($i=0; $i<count($butname); $i++)
	{
	$var[$butid[$i]]['text'] = $butname[$i];
	$var[$butid[$i]]['link'] = $butlink[$i];
	};
	
	show_admin_menu($menutitle, $pageid, $var);


?>