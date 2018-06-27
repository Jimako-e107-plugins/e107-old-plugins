<?php
/*
 * Corllete Lab Widgets
 *
 * Copyright (C) 2006-2009 Corllete ltd (clabteam.com)
 * Support and updates at http://www.free-source.net/
 * Released under the terms and conditions of the
 * GNU General Public License (http://www.gnu.org/licenses/gpl.txt)
 *
 * CL Widgets - e_Module
 *
 * $Id: e_module.php 502 2009-06-19 09:51:36Z secretr $
*/
if (!defined("e107_INIT")) exit;

require_once(e_PLUGIN.'cl_widgets/widget.php');
$cl_widget = &clw_widget::getInstance();

if($cl_widget->loadCompatEnv()) 
{
	$e107 = &e107c::getInstance();
	//cache fix
	$e107cache = &$e107->ecache;
	define('e_AJAX_REQUEST', (isset($_REQUEST['ajax_used']) && $_REQUEST['ajax_used']));
}

$cl_widget->initAll();

$cl_widget->run_module();
