<?php
/*
 * Corllete Lab Gallery
 *
 * Copyright (C) 2006-2009 Corllete ltd (clabteam.com)
 * Support and updates at http://www.free-source.net/
 * Released under the terms and conditions of the
 * GNU General Public License (http://www.gnu.org/licenses/gpl.txt)
 *
 * Random pictures (no permissions check!) menu template
 *
 * $Id: sgallery_randpics_tmpl.php 1561 2011-04-21 11:07:58Z secretr $
*/
if (!defined('e107_INIT')) { exit; }

/* define number of albums (1 picture per album is going to be shown) */
//define('SGAL_RANDPICS_NUM', 2);

/* thumb settings overrides */
//define('SGAL_RANDPICS_W', 190); /* width */
//define('SGAL_RANDPICS_H', 190); /* height */
//define('SGAL_RANDPICS_FAR', 'C'); /* force aspect ratio */

//Other available vars -  IMAGE_NAME | IMAGE_URL | IMAGE_OPEN | IMAGE_THUMB | IMAGE_THUMB_URL | IMAGE_TOTAL | IMAGE_COUNT | IMAGE_INDEX
        $SGAL_RANDPICS_MENU['start'] = '
           <table cellpadding="2" cellspacing="1">
        ';
        $SGAL_RANDPICS_MENU['item'] = '
				<tr>
					<td class="center">
						{IMAGE_OPEN}
					</td>
				</tr>
        ';
        $SGAL_RANDPICS_MENU['end'] = '
           </table>
        ';