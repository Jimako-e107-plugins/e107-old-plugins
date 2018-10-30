<?php
/**
 * Corllete Lab Gallery
 * 
 * Copyright (C) 2006-2009 Corllete ltd (clabteam.com)
 * Support and updates at http://www.free-source.net/
 * Released under the terms and conditions of the
 * GNU General Public License (http://www.gnu.org/licenses/gpl.txt)
 * 
 * SGallery 1 Shortcode Batch File
 * 
 * $Id: sgal1_batch.php 859 2011-03-28 14:42:23Z berckoff $
 */

if (!defined('e107_INIT'))	exit;

include_once e_HANDLER.'shortcode_handler.php';

global $tp;

if (!is_a($tp, 'e_parse'))	$tp = new e_parse();

$sgal1_shortcodes = $tp->e_sc->parse_scbatch(__FILE__);
/*
SC_BEGIN SGAL1_TMPL
	$params = getcachedvars('sgal1_params');
	return $params['tmpl'];
SC_END

SC_BEGIN SGAL1_CURRENT_PIC_ID
	$current = getcachedvars('sgal1_current_pic');
	return $current['img_id'];
SC_END

SC_BEGIN SGAL1_CURRENT_PIC_PATH
	$params  = getcachedvars('sgal1_params');
	$current = getcachedvars('sgal1_current_pic');
	if     (!isset($params['thumb']))     return ((isset($params['shadowbox']) ? e_PLUGIN_ABS : e_PLUGIN).'sgallery/pics/'.$current['img_path']);
	elseif (class_exists('e107', false))  return e107::getParser()->thumbUrl(e_PLUGIN.'sgallery/pics/'.$current['img_path'], $params['thumb']);
SC_END

SC_BEGIN SGAL1_CURRENT_PIC_DISPLAY
	$current = getcachedvars('sgal1_current_pic');
	return (1 == $current['img_id'] ? '' : ' display: none;');
SC_END

SC_BEGIN SGAL1_CAT_ID
	$category = getcachedvars('sgal1_category_item');
	return $category['cat_id'];
SC_END

SC_BEGIN SGAL1_CAT_URL
	$category = getcachedvars('sgal1_category_item');
	return e_PLUGIN.'sgallery/sgallery.php?cat='.$category['cat_id'];
SC_END

SC_BEGIN SGAL1_CAT_NAME
	$category = getcachedvars('sgal1_category_item');
	return $category['cat_title'];
SC_END

SC_BEGIN SGAL1_CAT_ALBUMS
	$ret = '';
	parse_str(e_QUERY, $query);
	$category = getcachedvars('sgal1_category_item');
	foreach ($category['cat_albums'] as $album)
	{
		$ret[] = '<a style="padding: 1px 4px;'.($query['album'] == $album['album_id'] ? ' background-color: #DDDDDD;' : '').'" href="'.e_PLUGIN.'sgallery/sgallery.php?album='.$album['album_id'].'">'.$album['album_title'].'</a>';
	}
	return implode('|', $ret);
SC_END

SC_BEGIN SGAL1_NAVI_LEFT
	$navi = getcachedvars('sgal1_navigation');
	return (false !== $navi['left']['page'] ? 'onclick="loadPage('.$navi['left']['page'].')"' : '');
SC_END

SC_BEGIN SGAL1_NAVI_LEFT_CLASS
	$navi = getcachedvars('sgal1_navigation');
	return (true == $navi['left']['active'] ? 'active' : 'inactive');
SC_END

SC_BEGIN SGAL1_NAVI_RIGHT
	$navi = getcachedvars('sgal1_navigation');
	return (false != $navi['right']['page'] ? 'onclick="loadPage('.$navi['right']['page'].')"' : '');
SC_END

SC_BEGIN SGAL1_NAVI_RIGHT_CLASS
	$navi = getcachedvars('sgal1_navigation');
	return (true == $navi['right']['active'] ? 'active' : 'inactive');
SC_END

SC_BEGIN SGAL1_NAVI_IMG
	$current = getcachedvars('sgal1_current_pic');
	return e_PLUGIN.'sgallery/pics/'.$current['img_path'];
SC_END

SC_BEGIN SGAL1_NAVI_IMG_ID
	$current = getcachedvars('sgal1_current_pic');
	return $current['img_id'];
SC_END

SC_BEGIN SGAL1_NAVI_IMG_SHADOWBOX
	$params  = getcachedvars('sgal1_params');
	$current = getcachedvars('sgal1_current_pic');
	
	return (isset($params['shadowbox']) ? 'rel="shadowbox__sgal1_'.$params['tmpl'].'___"' : 'onclick="showPic({SGAL1_NAVI_IMG_ID})"');
SC_END



SC_BEGIN SGAL1_JS_LOADER
	$params = getcachedvars('sgal1_params');
	$tmpl	= $params['tmpl'];
	$ret	= '';
	foreach ($params as $k=>$v)	$ret.= "
								$k: '$v',";
	if (strlen($ret))	$ret = rtrim(','.$ret, ',');
	
	return '
			<script type="text/javascript">
				var sgal_executor;	
				var running		= false;
				var current_id	= 1;
				var total_pics	= '.$params['pps'].';
				'.(!isset($params['slideshow']) ? '' : '
				var continuous_loop	= '.(isset($params['loop']) ? 'true' : 'false').';
				
				function swap_pics()
				{
					running = true;
					
					setTimeout(\'running = false;\', 1550);
					
					if (current_id == total_pics && false == continuous_loop)
					{
						sgal_executor.stop();
						return;
					}
					
					$(\'sgal1-'.$tmpl.'-main-pic-\'+current_id).puff({ duration: 1.5 });
					
					if (undefined != $(\'sgal1-'.$tmpl.'-thumb-\'+current_id))
					{
						$(\'sgal1-'.$tmpl.'-thumb-\'+current_id).style.opacity=0.4;
					}
					
					current_id++;
					
					if (current_id > total_pics)	current_id = 1;
					
					$(\'sgal1-'.$tmpl.'-main-pic-\'+current_id).appear({ duration: 1.5 });
					
					if (undefined != $(\'sgal1-'.$tmpl.'-thumb-\'+current_id))
					{
						$(\'sgal1-'.$tmpl.'-thumb-\'+current_id).style.opacity=1;
					}
				}
				
				document.observe(\'dom:loaded\', function()
				{
					$(\'sgal1-'.$tmpl.'-main-pic-\'+current_id).appear({ duration: 1.0 });
					
					if (undefined != $(\'sgal1-'.$tmpl.'-thumb-\'+current_id))
					{
						$(\'sgal1-'.$tmpl.'-thumb-\'+current_id).style.opacity=1;
					}
					
		   			sgal_executor = new PeriodicalExecuter(function(sgal_executor) { swap_pics() }, '.$params['slideshow'].');
				});
				').(isset($params['shadowbox']) ? '
				function prepareShadowboxBraces()
				{
					$$(\'a[rel*=shadowbox]\').each(function(target)
					{
						target.writeAttribute(\'rel\', target.readAttribute(\'rel\').replace(/__/, \'[\').replace(/___/, \']\').replace(/:::/g, \';\').replace(/::/g, \'=\').replace(/:\-::/g, \'{\').replace(/::\-:/g, \'}\'));
						Shadowbox.setup(target);
					});
				}' : '
				function showPic(id)
				{
					if (undefined != $(\'sgal1-'.$tmpl.'-main-pic-\'+id) && current_id != id && !running)
					{
						running = true;
						
						setTimeout(\'running = false;\', 1550);
						
						$(\'sgal1-'.$tmpl.'-main-pic-\'+current_id).puff({ duration: 1.5 });
						
						if (undefined != $(\'sgal1-'.$tmpl.'-thumb-\'+current_id))
						{
							$(\'sgal1-'.$tmpl.'-thumb-\'+current_id).style.opacity=0.4;
							$(\'sgal1-'.$tmpl.'-thumb-\'+current_id).filters.alpha.opacity=40;
						}
						
						current_id = id;
						
						$(\'sgal1-'.$tmpl.'-main-pic-\'+id).appear({ duration: 1.5 });
						
						if (undefined != $(\'sgal1-'.$tmpl.'-thumb-\'+current_id))
						{
							$(\'sgal1-'.$tmpl.'-thumb-\'+current_id).style.opacity=1;
							$(\'sgal1-'.$tmpl.'-thumb-\'+current_id).filters.alpha.opacity=100;
						}
						
						if (sgal_executor)	sgal_executor.stop();
					}
				}').'
				
				function loadPage(page_num)
				{
					if (undefined != $(\'sgal1-'.$tmpl.'\'))
					{
						new Ajax.Updater({ success: \'sgal1-'.$tmpl.'\' }, \''.e_PLUGIN.'sgallery/sgallery.php\', {
							
							method: \'get\',
							onComplete: function() {
								current_id = 1;
								total_pics = $A($(\'sgal1-'.$tmpl.(isset($params['shadowbox']) ? '-navi-thumbs' : '-pic').'-container\').getElementsByTagName(\'img\')).size();
								if (undefined != $(\'sgal1-'.$tmpl.'-thumb-\'+current_id))
								{
									$(\'sgal1-'.$tmpl.'-thumb-\'+current_id).style.opacity=1;
									$(\'sgal1-'.$tmpl.'-thumb-\'+current_id).filters.alpha.opacity=100;
								}
								'.(!isset($params['slideshow']) ? '' : '
								if (null == sgal_executor.timer)	sgal_executor = new PeriodicalExecuter(function(sgal_executor) { swap_pics() }, '.$params['slideshow'].');
								').(!isset($params['shadowbox']) ? '' : '
								prepareShadowboxBraces();').'
							},
							parameters: {
								page: page_num,
								e_ajax: true'.$ret.'
							}
						});
					}
				}
			</script>';
SC_END
//*/