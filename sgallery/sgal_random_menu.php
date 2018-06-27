<?php
/**
 * Corllete Lab Gallery
 *
 * Copyright (C) 2006-2009 Corllete ltd (clabteam.com)
 * Support and updates at http://www.free-source.net/
 * Released under the terms and conditions of the
 * GNU General Public License (http://www.gnu.org/licenses/gpl.txt)
 *
 * Random/Latest pictures menu
 *
 * $Id: sgal_random_menu.php 1644 2011-08-08 14:42:40Z berckoff $
 */

if (!defined('e107_INIT'))  exit;

global $ns, $pref, $sgal_pref, $SGAL_RAND_MENU;

if (!check_class($pref['sgal_active']))  return '';
if (!defined('SGAL_PATH'))               require_once 'init.php';

include_lan(SGAL_LAN.'.php');

# Load Template
if (!isset($SGAL_RAND_MENU) || !$SGAL_RAND_MENU)
{
	if (is_readable(THEME.'templates/sgallery/sgallery_rand_tmpl.php'))
		require_once THEME.'templates/sgallery/sgallery_rand_tmpl.php';
	else
		require_once SGAL_TMPL.'sgallery_rand_tmpl.php';
}

if (!defined('SGAL_RAND'))                define('SGAL_RAND',               true);  # true|false
if (!defined('SGAL_RAND_ITEMS_PER_ROW'))  define('SGAL_RAND_ITEMS_PER_ROW', 0);

# Load menu abstraction
require_once SGAL_INCPATH.'sgal_menu_abstract.php';

# Create menu object
$menu = new sgal_menu_abstract();

# SQL query opts
$db_where = (!check_class($sgal_pref['sgal_usermod_visible'])) ? " AND al.sgal_user = ''" : '';
$db_order = SGAL_RAND ? 'rand()' : 'al.dt DESC';
$db_limit = defined('SGAL_RAND_NUM') ? intval(SGAL_RAND_NUM) : 1;
$db_query = "
	SELECT al.*, alc.title AS ctitle
	FROM #sgallery AS al
	LEFT JOIN #sgallery_cats AS alc ON al.cat_id = alc.cat_id
	WHERE al.active > 0
	AND alc.active > 0{$db_where}
	GROUP by al.album_id
	ORDER BY {$db_order}
	LIMIT {$db_limit}";

$menu->setParam('ipr', SGAL_RAND_ITEMS_PER_ROW)
	->setParam('sort', SGAL_RAND)
	->setParam('db_query', $db_query)
	->setTemplate($SGAL_RAND_MENU);

# Thumbs width, height, far options
if (defined('SGAL_RAND_W'))     $cfgarr['w']   = SGAL_RAND_W;
if (defined('SGAL_RAND_H'))     $cfgarr['h']   = SGAL_RAND_H;
if (defined('SGAL_RAND_FAR'))   $cfgarr['far'] = SGAL_RAND_FAR;
if (isset($cfgarr) && $cfgarr)  $menu->setParam('thumb', $cfgarr);

$text  = $menu->runMenu();
$title = SGAL_RAND ? SGAL_RANDM_1 : SGAL_RANDM_1a;

return $ns->tablerender($title, $text, 'clGallery');