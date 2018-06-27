<?php
/**
 * Corllete Lab Gallery
 * 
 * Copyright (C) 2006-2009 Corllete ltd (clabteam.com)
 * Support and updates at http://www.free-source.net/
 * Released under the terms and conditions of the
 * GNU General Public License (http://www.gnu.org/licenses/gpl.txt)
 * 
 * Random Gallery Menu
 * 
 * $Id: sgal_galmultirand_menu.php 1644 2011-08-08 14:42:40Z berckoff $
 */

if (!defined('e107_INIT'))  exit;

global $ns, $pref, $sgal_pref, $MGAL_MENU_LOOP;

if (!check_class($pref['sgal_active']))  return '';
if (!defined('SGAL_PATH'))               require_once 'init.php';

include_lan(SGAL_LAN.'.php');

# Load Template
if (!isset($MGAL_MENU_LOOP) || !$MGAL_MENU_LOOP)
{
	if (is_readable(THEME.'templates/sgallery/sgallery_galrand_tmpl.php'))
		require_once THEME.'templates/sgallery/sgallery_galrand_tmpl.php';
	else
		require_once SGAL_TMPL.'sgallery_galrand_tmpl.php';
}

if (!defined('SGAL_GALRAND'))                define('SGAL_GALRAND',               true);  # true|false
if (!defined('SGAL_GALRAND_ITEMS_PER_ROW'))  define('SGAL_GALRAND_ITEMS_PER_ROW', 0);

# Load menu abstraction
require_once SGAL_INCPATH.'sgal_menu_abstract.php';

# Create menu object
$menu = new sgal_menu_abstract();

# SQL query opts
$db_where = (!check_class($sgal_pref['sgal_usermod_visible'])) ? " AND al.sgal_user = ''" : '';
$db_order = SGAL_GALRAND ? 'rand()' : 'alc.cat_order ASC';
$db_limit = defined('SGAL_GALRAND_MULTINUM') ? intval(SGAL_GALRAND_MULTINUM) : varsettrue($sgal_pref['sgal_galrand_multinum'], 3);
$db_query = "
	SELECT al.*, alc.title AS ctitle, alc.active AS cactive, alc.cat_order
	FROM #sgallery_cats AS alc
	LEFT JOIN #sgallery AS al ON al.cat_id = alc.cat_id 
	WHERE al.active > 0
	AND alc.active > 0{$db_where}
	GROUP by alc.cat_id
	ORDER BY {$db_order}
	LIMIT {$db_limit}";

$menu->setParam('ipr', SGAL_GALRAND_ITEMS_PER_ROW)
	->setParam('sort', SGAL_GALRAND)
	->setParam('db_query', $db_query)
	->setTemplate($MGAL_MENU_LOOP);

# Thumbs width, height, far options
if (defined('SGAL_GALRAND_W'))    $cfgarr['w']   = SGAL_GALRAND_W;
if (defined('SGAL_GALRAND_H'))    $cfgarr['h']   = SGAL_GALRAND_H;
if (defined('SGAL_GALRAND_FAR'))  $cfgarr['far'] = SGAL_GALRAND_FAR;
if (isset($cfgarr) && $cfgarr)    $menu->setParam('thumb', $cfgarr);

$text  = $menu->runMenu();
$title = SGAL_GALRAND ? SGAL_RANDM_5 : SGAL_RANDM_4;

return $ns->tablerender($title, $text, 'clGallery_mgalrand');