<?php
/**
 * Corllete Lab Gallery
 *
 * Copyright (C) 2006-2009 Corllete ltd (clabteam.com)
 * Support and updates at http://www.free-source.net/
 * Released under the terms and conditions of the
 * GNU General Public License (http://www.gnu.org/licenses/gpl.txt)
 *
 * Real Latest pictures menu
 *
 * $Id: sgal_random_menu.php 695 2009-09-28 11:10:32Z secretr $
 */

if (!defined('e107_INIT'))  exit;

global $ns, $pref, $sgal_pref, $SGAL_LATESTPICS_MENU;

if (!check_class($pref['sgal_active']))  return '';
if (!defined('SGAL_PATH'))               require_once 'init.php';

include_lan(SGAL_LAN.'.php');

# Load Template
if (!isset($SGAL_LATESTPICS_MENU) || !$SGAL_LATESTPICS_MENU)
{
	if (is_readable(THEME.'templates/sgallery/sgallery_latestpics_tmpl.php'))
		require_once (THEME.'templates/sgallery/sgallery_latestpics_tmpl.php');
	else
		require_once (SGAL_TMPL.'sgallery_latestpics_tmpl.php');
}

if (!defined('SGAL_GALRAND'))                   define('SGAL_GALRAND',               true);  # true|false
if (!defined('SGAL_LATESTPICS_ITEMS_PER_ROW'))  define('SGAL_LATESTPICS_ITEMS_PER_ROW', 0);

# Load menu abstraction
require_once SGAL_INCPATH.'sgal_menu_abstract.php';

# Create menu object
$menu = new sgal_menu_abstract();

# SQL query opts
$db_where = (!check_class($sgal_pref['sgal_usermod_visible'])) ? " AND al.sgal_user = ''" : '';

$db_limit = defined('SGAL_LATEST_NUM') ? intval(SGAL_LATEST_NUM) : 12;
$db_query = "
	SELECT al.*, alc.title AS ctitle
	FROM #sgallery AS al
	LEFT JOIN #sgallery_cats AS alc ON al.cat_id = alc.cat_id
	WHERE al.active > 0
	AND alc.active > 0{$db_where}
	GROUP by al.album_id
	ORDER by al.dt DESC";

$menu->setParam('ipr',  SGAL_LATESTPICS_ITEMS_PER_ROW)
	->setParam('sort',  SGAL_RAND)
	->setParam('limit', $db_limit)
	->setParam('db_query', $db_query)
	->setTemplate($SGAL_LATESTPICS_MENU);

# Thumbs width, height, far options
if (defined('SGAL_RAND_W'))     $cfgarr['w']   = SGAL_RAND_W;
if (defined('SGAL_RAND_H'))     $cfgarr['h']   = SGAL_RAND_H;
if (defined('SGAL_RAND_FAR'))   $cfgarr['far'] = SGAL_RAND_FAR;
if (isset($cfgarr) && $cfgarr)  $menu->setParam('thumb', $cfgarr);

$text  = $menu->runMenu('latest_pics');
$title = SGAL_RANDM_1a;

return $ns->tablerender($title, $text, 'clGallery');