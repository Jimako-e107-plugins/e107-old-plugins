<?php
/*
 * Corllete Lab Gallery
 *
 * Copyright (C) 2006-2009 Corllete ltd (clabteam.com)
 * Support and updates at http://www.free-source.net/
 * Released under the terms and conditions of the
 * GNU General Public License (http://www.gnu.org/licenses/gpl.txt)
 *
 * Random Album Menu Template
 *
 * $Id: sgallery_multirand_tmpl.php 1640 2011-08-08 10:30:35Z berckoff $
*/
if (!defined('e107_INIT')) { exit; }

/* define number of galleries */
//define('SGAL_RAND_MULTINUM', 1);

/* define menu type - true == random, false == latest  */
//define('SGAL_RAND', true);


//Other available vars -  ALBUM_HREF | ALBUM_TITLE | IMAGE_OPEN | IMAGE | IMAGE_COUNT
$MRAND_MENU_LOOP = '
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