<?php
/*
 * Copyright e107 Inc e107.org, Licensed under GNU GPL (http://www.gnu.org/licenses/gpl.txt)
 * $Id: imagepicker.php 636 2009-07-15 11:33:57Z secretr $
 *
 * Image picker shortcode
 *
*/

function imagepicker_shortcode($parm)
{
	global $pref, $sgalobj, $PHPTHUMB_CONFIG;
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
	
	$iconlist = array();
	foreach($parms['path'] as $iconpath)
	{
		$tmp = $fl->get_files($iconpath, '\.jpg|\.gif|\.png|\.JPG|\.GIF|\.PNG');
		if($tmp)
		{
			$iconlist = array_merge($iconlist, $tmp);
		}
		unset($tmp);
	}
	//$iconlist = multiarray_sort($iconlist, 'fname');
	$name = varset($parms['id']);
	$tmp = array();
	$img_w = varset($parms['w'], 150);
	$img_h = varset($parms['h'], 150);
	foreach($iconlist as $icon)
	{
		
		if(varset($parms['view_path']))
		{
			$filepath_abs = sprintf($parms['view_path'], $icon['fname']);
		}
		else
		{
			$filepath_abs = $filepath_orig = str_replace(array(e_IMAGE, e_FILE, e_PLUGIN), array(e_IMAGE_ABS, e_FILE_ABS, e_PLUGIN_ABS), $icon['path'].$icon['fname']);
		}

		//DEPRECATED - use 'view_path' param instead
		if(varsettrue($pref['plug_installed']['sgallery']) && varsettrue($parms['thumb']))
		{
			require_once(e_PLUGIN.'sgallery/init.php');
			$thprm = explode(',', $parms['thumb']);
			$cfg = array();
			if(isset($thprm[0])) { $cfg['w'] = $thprm[0]; $img_w = $thprm[0]; }
			if(isset($thprm[1])) { $cfg['h'] = $thprm[1]; $img_h = $thprm[1]; }
			if(isset($thprm[2])) $cfg['far'] = $thprm[2];
			if(isset($thprm[3])) $cfg['q'] = $thprm[3];
			
			$filepath_abs = showThumb(makeURL(e107c::getInstance()->tp->createConstants($icon['path'], 1)).$icon['fname'], $cfg, 'relative', SGAL_INCPATH_ABS);
		}

		$filepath = varsettrue($parms['path_omit']) ? str_replace(explode('|', $parms['path_omit']), "", $icon['path'].$icon['fname']) : $e107->tp->createConstants($icon['path'], 1).$icon['fname'];
		//TODO - remove inline style

		$img_src = "<a href='#{$filepath}' title='{$filepath}' onclick=\"e107Helper.insertText('{$filepath}','{$name}','{$name}-imagepicker'); return false; \"><img class='icon picker list' style='width: {$img_w}px; height: {$img_h}px' src='{$filepath_abs}' alt='{$filepath}' /></a>";
		$tmp[] = "
			<div class='image-box f-left center' style='width: ".(intval(varset($parms['box_w'], 160)))."px; height: ".(intval(varset($parms['box_h'], 200)))."px;'>
				<div class='spacer'>
					<div class='image-users'><a href='{$filepath_orig}' rel='shadowbox__{$name}___'>{$icon['fname']}</a></div>
					<div class='image-preview center'>{$img_src}</div>
				</div>
			</div>
		";
	}
	


	//return $tmp ? '<div id="'.$name.'-imagepicker-ajax"><div class="field-spacer iconpicker">'.implode('</div><div class="field-spacer iconpicker">', $tmp).'</div></div>' : '';
	return $tmp ? '<div id="'.$name.'-imagepicker-ajax">'.implode('', $tmp).'</div>' : 'The folder is empty';

}
?>