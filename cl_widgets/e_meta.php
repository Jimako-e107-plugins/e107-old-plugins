<?php
/*
 * Corllete Lab Widgets
 *
 * Copyright (C) 2006-2009 Corllete ltd (clabteam.com)
 * Support and updates at http://www.free-source.net/
 * Released under the terms and conditions of the
 * GNU General Public License (http://www.gnu.org/licenses/gpl.txt)
 *
 * CL Widgets - Meta
 *
 * $Id: e_meta.php 841 2010-01-20 12:26:25Z secretr $
*/
if (!defined("e107_INIT")) exit;
global $pref;

//require_once(e_PLUGIN.'cl_widgets/widget.php'); ? - already called in e_module
$cl_widget = &clw_widget::getInstance();

/*if($cl_widget->getPref('cl_08compat')) 
{*/
    //Include styles depends on style preferences, and not 0.8 compat pref!
	if(clw_widget::inAdmin() && $cl_widget->getPref('cl_08compat_style_admin', 1))
	{
		echo "\n<link rel='stylesheet' href='".CLW_COMPAT_ABS."style_compat_admin.css' type='text/css' />\n";
	}
	elseif (!clw_widget::inAdmin() && $cl_widget->getPref('cl_08compat_style', 1))
	{
		echo "\n<link rel='stylesheet' href='".CLW_COMPAT_ABS."style_compat.css' type='text/css' />\n";
	}
/*}*/

if(e_PAGE != 'print.php') {
    $tmp = $cl_widget->run_meta();

    $out = varset($tmp['pre_lib']);

	$out .= '
        <!-- CL Widgets - Compressed Library -->
		<script src="'.CLW_APP_ABS.'jslib/jslib.php?'.$pref['cl_widget_cachelm'].(!$pref['cl_widget_jscompression'] ? '-nocompression' : '').'" type="text/javascript"></script>
	';

	$out .= varset($tmp['default']);
	unset($tmp);

	echo $out;

	$cl_widget->render_runtime_js();
	$cl_widget->render_runtime_meta('');
}

//e107 v0.8 JS API compat mod
if($cl_widget->getPref('cl_08compat')) {
	global $register_sc;
	//hack! - register theme shortcodes when in 0.8 compat mod
	if(isset($register_sc) && is_array($register_sc))
	{
		$e107 = &e107c::getInstance();
		if(method_exists($e107->tp->e_sc, 'isRegistered'))
		{
			foreach($register_sc as $code)
			{
				if(!$e107->tp->e_sc->isRegistered($code))
				{
					$code = strtoupper($code);
					$e107->tp->e_sc->registered_codes[$code]['type'] = 'theme';
				}
			}
		}
	}

	echo "<script type='text/javascript'>\n";
	echo "<!--\n";
	echo "document.observe('dom:loaded', function() {\n";
	echo "e107Event.trigger('loaded', {element: null}, document);\n";
	echo "});\n";
	echo "// -->\n";
	echo "</script>\n";
}
