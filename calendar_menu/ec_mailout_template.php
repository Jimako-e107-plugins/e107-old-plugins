<?php
/*
 * e107 website system
 *
 * Copyright (C) 2002-2012 e107 Inc (e107.org)
 * Released under the terms and conditions of the
 * GNU General Public License (http://www.gnu.org/licenses/gpl.txt)
 *
 * Event calendar - event entry and display
 *
 * $URL: https://e107.svn.sourceforge.net/svnroot/e107/trunk/e107_0.7/usersettings.php $
 * $Id: usersettings.php 11645 2010-08-01 12:57:11Z e107coders $

This template is used during the subscription mailouts - it is inserted at the front of the text
defined for each category.
Main purpose is to define the 'pre' and 'post' styles, but it can be used much as any E107 template
*/
if (!defined('e107_INIT')) { exit; }

$sc_style['EC_MAIL_HEADING_DATE']['pre'] = "";
$sc_style['EC_MAIL_HEADING_DATE']['post'] = "";

$sc_style['EC_MAIL_SHORT_DATE']['pre'] = "";
$sc_style['EC_MAIL_SHORT_DATE']['post'] = "";

$sc_style['EC_MAIL_TITLE']['pre'] = "";
$sc_style['EC_MAIL_TITLE']['post'] = "";

$sc_style['EC_MAIL_ID']['pre'] = "";
$sc_style['EC_MAIL_ID']['post'] = "";

$sc_style['EC_MAIL_DETAILS']['pre'] = "";
$sc_style['EC_MAIL_DETAILS']['post'] = "";

$sc_style['EC_MAIL_LOCATION']['pre'] = EC_LAN_32." ";
$sc_style['EC_MAIL_LOCATION']['post'] = "";

$sc_style['EC_MAIL_AUTHOR']['pre'] = EC_LAN_31." ";
$sc_style['EC_MAIL_AUTHOR']['post'] = "";

$sc_style['EC_MAIL_CONTACT']['pre'] = EC_LAN_33." ";
$sc_style['EC_MAIL_CONTACT']['post'] = "";

$sc_style['EC_MAIL_THREAD']['pre'] = "";
$sc_style['EC_MAIL_THREAD']['post'] = "";

$sc_style['EC_MAIL_LINK']['pre'] = "";
$sc_style['EC_MAIL_LINK']['post'] = "";

$sc_style['EC_MAIL_CATEGORY']['pre'] = "";
$sc_style['EC_MAIL_CATEGORY']['post'] = "";

$sc_style['EC_MAIL_DATE_START']['pre'] = (isset($thisevent['event_allday']) && $thisevent['event_allday']) ? EC_LAN_68." " : EC_LAN_29." ";
$sc_style['EC_MAIL_DATE_START']['post'] = "";

$sc_style['EC_MAIL_TIME_START']['pre'] = EC_LAN_144;
$sc_style['EC_MAIL_TIME_START']['post'] = "";

$sc_style['EC_MAIL_DATE_END']['pre'] = EC_LAN_69." ";
$sc_style['EC_MAIL_DATE_END']['post'] = "";

$sc_style['EC_MAIL_TIME_END']['pre'] = EC_LAN_144;
$sc_style['EC_MAIL_TIME_END']['post'] = "";


?>
