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
 * $Id: sgallery_rand_tmpl.php 1643 2011-08-08 13:40:46Z berckoff $
 */

if (!defined('e107_INIT'))  exit;

# Define number of albums (1 picture per album will be shown)
//define('SGAL_RAND_NUM', 3);

# Define menu type - true == random, false == latest
//define('SGAL_RAND', true);

# Override Thumb settings
//define('SGAL_RAND_W',   190);  # width
//define('SGAL_RAND_H',   190);  # height
//define('SGAL_RAND_FAR', 'C');  # force aspect ratio

# Available vars:
#
#  IMAGE, IMAGE_SRC, IMAGE_OPEN, IMAGE_COUNT
#  ALBUM_HREF, ALBUM_LINK, ALBUM_TITLE
#  GALLERY_HREF, GALLERY_LINK, GALLERY_TITLE


# Old
$SGAL_RAND_MENU = '
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
//define('SGAL_RAND_ITEMS_PER_ROW', 3);
//
//$SGAL_RAND_MENU['start']				= '
//		<table style="width: 98%; padding: 0px 5px;" cellpadding="2" cellspacing="1">';
//
//$SGAL_RAND_MENU['end']					= '
//		</table>';
//
//$SGAL_RAND_MENU['list']['row_start']	= '
//			<tr>';
//$SGAL_RAND_MENU['list']['row_end']		= '
//			</tr>';
//
//$SGAL_RAND_MENU['list']['item']			= '
//				<td>
//					<span>{ALBUM_LINK}</span>
//					<span>{IMAGE_OPEN}</span>
//					<span>'.SGAL_RANDM_7.': {IMAGE_COUNT}</span>
//				</td>';
//
//$SGAL_RAND_MENU['list']['separator']	= '';