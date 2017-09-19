<?php
/**
 * Glossary by Shirka (www.shirka.org)
 *
 * A plugin for the e107 Website System (http://e107.org)
 *
 * ©Andre DUCLOS 2006
 * http://www.shirka.org
 * duclos@shirka.org
 *
 * Released under the terms and conditions of the
 * GNU General Public License (http://gnu.org).
 *
 * $Source: /home/e-smith/files/ibays/cvsroot/files/glossary/search/search_advanced.php,v $
 * $Revision: 1.1 $
 * $Date: 2006/06/10 19:53:03 $
 * $Author: duclos $
 */

if (!defined('e107_INIT')) { exit; }

$advanced['date']['type'] = 'date';
$advanced['date']['text'] = LAN_SEARCH_50.':';

$advanced['author']['type'] = 'author';
$advanced['author']['text'] = LAN_SEARCH_61.':';

$advanced['match']['type'] = 'dropdown';
$advanced['match']['text'] = LAN_SEARCH_52.':';
$advanced['match']['list'][] = array('id' => 0, 'title' => LAN_SEARCH_53);
$advanced['match']['list'][] = array('id' => 1, 'title' => LAN_SEARCH_54);

?>