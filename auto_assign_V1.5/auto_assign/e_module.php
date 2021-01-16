<?php
/*
+---------------------------------------------------------------+
|	Auto Assign Plugin for e107
|
|	Copyright (C) Father Barry Keal 2003 - 2008
|	http://www.keal.me.uk
|
|	Released under the terms and conditions of the
|	GNU General Public License (http://gnu.org).
+---------------------------------------------------------------+
*/
if (!defined('e107_INIT'))
{
    exit;
}
$e_event->register('usersup', 'auto_assign_usersup', e_PLUGIN . 'auto_assign/auto_assign.php');

?>