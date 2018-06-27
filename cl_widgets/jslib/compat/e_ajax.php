<?php
/*
+ ----------------------------------------------------------------------------+
||     e107 website system
|
|     Steve Dunstan 2001-2002
|     http://e107.org
|     jalist@e107.org
|
|     Released under the terms and conditions of the
|     GNU General Public License (http://gnu.org).
|
|     $Id: e_ajax.php 1155 2010-10-06 16:47:10Z secretr $
+----------------------------------------------------------------------------+
*/
$_E107['minimal'] = TRUE;
define('e_TOKEN_FREEZE', true); 
require_once("../../../../class2.php");
//ob_start();
ob_implicit_flush(0);

// -----------------------------------------------------------------------------
	// Ajax Short-code-Replacer Routine.

	$shortcodes = "";

	if($_POST['ajax_sc'] && $_POST['ajax_scfile'])
	{
		include_once(e_HANDLER.'shortcode_handler.php');
	 	$file = $tp->replaceConstants($_POST['ajax_scfile']);
		$shortcodes = $tp -> e_sc -> parse_scbatch($file);
	}
	
// New Part Start (Fix by Cameron)

	if(isset($register_sc) && is_array($register_sc)) // Fix for missing THEME shortcodes.
	{
		foreach($register_sc as $code)
		{
			$tp->e_sc->registered_codes[$code]['type'] = 'theme';
		}
	}

// New part End. 

	if($_POST['ajax_sc'] && $_POST['ajax_used'])
	{
		list($fld,$parm) = explode("=",$_POST['ajax_sc']);
		$prm = ($parm) ? "=".str_replace(array('{', '}'), '', urldecode($parm)) : "";
		echo $tp->parseTemplate("{".strtoupper($fld).$prm."}",TRUE,$shortcodes);
		exit;
	}