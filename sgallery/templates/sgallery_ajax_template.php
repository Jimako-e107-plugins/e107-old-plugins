<?php
/*
 * Corllete Lab Gallery
 *
 * Copyright (C) 2006-2010 Corllete ltd (clabteam.com)
 * Support and updates at http://www.free-source.net/
 * Released under the terms and conditions of the
 * GNU General Public License (http://www.gnu.org/licenses/gpl.txt)
 *
 * Ajax related temlates
 *
 * $Id$
*/

if (!defined('e107_INIT')) { exit; }

$SGALLERY_AJAX_TEMPLATE = array();

$SGALLERY_AJAX_TEMPLATE['picture'] = '{SGAL_ALBUM_IMGLINK=600,400,C,90}';

$SGALLERY_AJAX_TEMPLATE['nopicture'] = '<img src="'.THEME_ABS.'images/sgal_nopic_600.png" alt="Picture not found" />';

?>