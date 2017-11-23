<?php

/**
 * $Id: dtstamp.php 10 2010-09-07 23:13:51Z michiel $
 * 
 * Date Time Stamp for e107 v7xx - by Michiel Horvers
 * This module for the e107 .7+ website system
 * Copyright Michiel Horvers 2009
 *
 * Released under the terms and conditions of the
 * GNU General Public License (http://gnu.org).
 *
 * Initial Creation Date: 3 jul 2009 - 13:05:21
 * $HeadURL: svn://ubusrv/echo2/MemberList/frontliners.eu/fl_plugins/memberlist/includes/dtstamp.php $
 * 
 * Revision: $LastChangedRevision: 10 $
 * Last Modified: $LastChangedDate: 2010-09-08 01:13:51 +0200 (wo, 08 sep 2010) $
 *  
 */
class dtstamp {

	var $format;
	
	function dtstamp() {
		global $pref;
		$this->format['long'] = $pref['longdate'];
		$this->format['short'] = "%d-%m-%y %H:%M";
		$this->format['short_break'] = "%d-%m-%y<br/>%H:%M";
		$this->format['shortday'] = "%a %d %b %H:%M";
		$this->format['forum'] = $pref['forumdate'];
		$this->format['time'] = "%H:%M";
	}
	
	function stamp($datestamp, $mode = "short") {
		/*
		# Date convert
		# - parameter #1:  string $datestamp, unix stamp
		# - parameter #2:  string $mode, date format, default long
		# - return         parsed text
		# - scope          public
		*/
		global $pref;

		$datestamp += TIMEOFFSET;

		if (isset($this->format[$mode])) {
			return strftime($this->format[$mode], $datestamp);
		} else {
			return strftime($mode, $datestamp);
		} 
	}

}

?>