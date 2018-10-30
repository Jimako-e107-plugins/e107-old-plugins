<?php
/*
 * e107 website system
 *
 * Copyright (C) 2002-2012 e107 Inc (e107.org)
 * Released under the terms and conditions of the
 * GNU General Public License (http://www.gnu.org/licenses/gpl.txt)
 *
 * Event calendar - search shim
 *
 * $URL: https://e107.svn.sourceforge.net/svnroot/e107/trunk/e107_0.7/e107_plugins/calendar_menu/e_search.php $
 * $Id: e_search.php 13009 2012-10-27 15:19:55Z e107steved $
 */
if (!defined('e107_INIT')) { exit(); }

include_lan(e_PLUGIN.'calendar_menu/languages/'.e_LANGUAGE.'_search.php');

$search_info[] = array('sfile' => e_PLUGIN.'calendar_menu/search/search_parser.php', 'qtype' => CM_SCH_LAN_1, 'refpage' => 'calendar.php');

?>