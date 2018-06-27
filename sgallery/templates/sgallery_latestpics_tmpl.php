<?php
/**
 * Corllete Lab Gallery
 * 
 * Copyright (C) 2006-2009 Corllete ltd (clabteam.com)
 * Support and updates at http://www.free-source.net/
 * Released under the terms and conditions of the
 * GNU General Public License (http://www.gnu.org/licenses/gpl.txt)
 * 
 * Random/Latest pictures menu template
 * 
 * $Id: sgallery_rand_tmpl.php 569 2009-06-26 11:58:13Z secretr $
 */

if (!defined('e107_INIT'))  exit;

# Define number of pictures
//define('SGAL_LATEST_NUM', 3);

# Override Thumb settings
//define('SGAL_RAND_W',   190);  # width
//define('SGAL_RAND_H',   190);  # height
//define('SGAL_RAND_FAR', 'C');  # force aspect ratio

# Available vars:
#
#  IMAGE, IMAGE_SRC, IMAGE_OPEN, IMAGE_COUNT
#  ALBUM_HREF, ALBUM_LINK, ALBUM_TITLE
#

# Old
$SGAL_LATESTPICS_MENU = '
		<table style="width: 98%; padding: 0px 5px;" cellpadding="2" cellspacing="1">
			<tr>
				<td>
					{ALBUM_LINK}
				</td>
			</tr>
			<tr>
				<td style="text-align: center">
					{IMAGE_OPEN}
				</td>
			</tr>
			<tr>
				<td style="text-align: center">
					'.SGAL_RANDM_7.': {IMAGE_COUNT}
				</td>
			</tr>
		</table>';

#
# New stuff - if you need more than one item per slide
#
//define('SGAL_LATESTPICS_ITEMS_PER_ROW', 3);
//
//$SGAL_LATESTPICS_MENU['start']				= '
//		<table style="width: 98%; padding: 0px 5px;" cellpadding="2" cellspacing="1">';
//
//$SGAL_LATESTPICS_MENU['end']					= '
//		</table>';
//
//$SGAL_LATESTPICS_MENU['list']['row_start']	= '
//			<tr>';
//$SGAL_LATESTPICS_MENU['list']['row_end']		= '
//			</tr>';
//
//$SGAL_LATESTPICS_MENU['list']['item']			= '
//				<td>
//					<span>{ALBUM_LINK}</span>
//					<span>{IMAGE_OPEN}</span>
//					<span>'.SGAL_RANDM_7.': {IMAGE_COUNT}</span>
//				</td>';
//
//$SGAL_LATESTPICS_MENU['list']['separator']	= '';