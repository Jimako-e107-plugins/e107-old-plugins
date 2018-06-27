<?php
/**
 * Corllete Lab Gallery
 * 
 * Copyright (C) 2006-2009 Corllete ltd (clabteam.com)
 * Support and updates at http://www.free-source.net/
 * Released under the terms and conditions of the
 * GNU General Public License (http://www.gnu.org/licenses/gpl.txt)
 * 
 * SGallery Categories Navigation Shortcode Batch File
 * 
 * $Id: sgal_navi_batch.php 859 2011-03-28 14:42:23Z berckoff $
 */

if (!defined('e107_INIT'))	exit;

include_once e_HANDLER.'shortcode_handler.php';

global $tp;

if (!is_a($tp, 'e_parse'))	$tp = new e_parse();

$sgal_navi_shortcodes = $tp->e_sc->parse_scbatch(__FILE__);
/*
SC_BEGIN SGAL_NAV_CAT_ID
	$current = getcachedvars('sgal_navi_cat_item');
	return $current['cat_id'];
SC_END
	
SC_BEGIN SGAL_NAV_CAT_NAME
	$current = getcachedvars('sgal_navi_cat_item');
	return $current['cat_title'];
SC_END

SC_BEGIN SGAL_NAV_ALBUM_ID
	$current = getcachedvars('sgal_navi_album_item');
	return $current['album_id'];
SC_END

SC_BEGIN SGAL_NAV_ALBUM_NAME
	$current = getcachedvars('sgal_navi_album_item');
	return $current['album_title'];
SC_END
*/