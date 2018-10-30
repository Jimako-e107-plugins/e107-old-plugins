<?php
/*
 * Corllete Lab Gallery
 *
 * Copyright (C) 2006-2009 Corllete ltd (clabteam.com)
 * Support and updates at http://www.free-source.net/
 * Released under the terms and conditions of the
 * GNU General Public License (http://www.gnu.org/licenses/gpl.txt)
 *
 * User's albums Random/Latest pictures menu template
 *
 * $Id: sgallery_urand_tmpl.php 569 2009-06-26 11:58:13Z secretr $
*/
if (!defined('e107_INIT')) { exit; }

/* define number of albums (1 picture per album is going to be shown) */
//define('SGAL_URAND_NUM', 3);

/* define menu type - true == random, false == latest  */
//define('SGAL_URAND', true);

/* thumb settings overrides */
//define('SGAL_URAND_W', 190); /* width */
//define('SGAL_URAND_H', 190); /* height */
//define('SGAL_URAND_FAR', 'C'); /* force aspect ratio */

//Other available vars -  ALBUM_HREFTITLE | ALBUM_TITLE | IMAGE_OPEN | ALBUM_LINK
        $SGAL_URAND_MENU = '
           <table style="width: 97%; margin: 2px auto; " cellpadding="2" cellspacing="1">
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
						{ALBUM_ULINK} 
					</td>
				</tr>
           </table>
        ';
?>