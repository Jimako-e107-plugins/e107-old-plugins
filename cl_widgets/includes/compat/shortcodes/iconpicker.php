<?php
/*
 * Copyright e107 Inc e107.org, Licensed under GNU GPL (http://www.gnu.org/licenses/gpl.txt)
 * $Id: iconpicker.php 434 2009-06-10 14:52:05Z secretr $
 *
 * Image picker shortcode
 *
*/

function iconpicker_shortcode($parm)
{
	require_once (e_HANDLER."file_class.php");
	require_once(e_HANDLER.'admin_handler.php');

	$e107 = &e107c::getInstance();

	$fl = new e_file();
	$parms = array();

	parse_str($parm, $parms);

	if(!varset($parms['path']))
	{
		$parms['path'] = CLW_APP."jslib/compat/images/icons/";
		$parms['path_omit'] = CLW_APP."jslib/compat/images/icons/";
	}
	$parms['path'] = explode('|', $parms['path']);
	
	$ilist = array();
	foreach($parms['path'] as $iconpath)
	{
		$tmp = $fl->get_files($iconpath, '\.jpg|\.gif|\.png|\.JPG|\.GIF|\.PNG');
		$ilist[$iconpath] = $tmp;
		unset($tmp);
	}
	//$iconlist = multiarray_sort($iconlist, 'fname');

	$tmp = array(16, 32, 48, 64, 128);
	$tmp1 = array();
	$name = varset($parms['id']);
	$ret = array();
	
	foreach($ilist as $p => $iconlist)
	{
		
		foreach($iconlist as $icon)
		{
	
			$filepath = varsettrue($parms['path_omit']) ? str_replace(explode('|', $parms['path_omit']), "", $icon['path'].$icon['fname']) : $e107->tp->createConstants($icon['path'], 1).$icon['fname'];
			if(!varset($parms['view_path']))
			{
				$filepath_abs = str_replace(array(e_IMAGE, e_FILE, e_PLUGIN), array(e_IMAGE_ABS, e_FILE_ABS, e_PLUGIN_ABS), $icon['path'].$icon['fname']);
			}
			else 
			{
				$filepath_abs = $parms['view_path'].$icon['fname'];
			}
			$str = "<a href='#{$filepath}' title='{$filepath}' onclick=\"e107Helper.insertText('{$filepath}','{$name}','{$name}-iconpicker'); return false; \"><img class='icon picker list%%size%%' src='{$filepath_abs}' alt='{$filepath}' /></a>";
	
			foreach ($tmp as $isize)
			{
	
				if(strpos($icon['fname'], '_'.$isize.'.') !== false)
				{
	
					$tmp1[$isize] = varset($tmp1[$isize]).str_replace('%%size%%', ' S'.$isize, $str);
					continue 2;
				}
			}
			$tmp1['other'] = varset($tmp1['other']).$str;//other
		}
		
		$ret[] = $tmp1 ? '<div id="'.$name.'-iconpicker-ajax"><div class="clear"><strong>'.str_replace('../', '', $p).'</strong></div><div class="clear" style="height: 15px"><!-- --></div><div class="field-spacer iconpicker">'.str_replace('%%size%%', '', implode('</div><div class="field-spacer iconpicker">', $tmp1)).'</div></div>' : '<strong>'.str_replace('../', '', $p).'</strong> is empty';
	}
	
	return $ret ? implode('<div class="clear H15"><!-- --></div>', $ret) : '';
}
