<?php
/**
 * $Id: English.php,v 1.1 2009/10/22 15:00:51 michiel Exp $
 * 
 * Rank System for e107 v7xx - by Michiel Horvers
 * This module for the e107 .7+ website system
 * Copyright Michiel Horvers 2009
 *
 * Released under the terms and conditions of the
 * GNU General Public License (http://gnu.org).
 *
 * Initial Creation Date: 17 okt 2009 - 23:59:52
 * 
 * Revision: $Revision: 1.1 $
 * Last Modified: $Date: 2009/10/22 15:00:51 $
 *
 * Change Log:
 * $Log: English.php,v $
 * Revision 1.1  2009/10/22 15:00:51  michiel
 * Implemented Help text in admin section
 *
 *  
 */

define('HELP_RS', 'Rank System [Reference]');

define('HELP_RS_CD01', 'Rank Conditions');
define('HELP_RS_CD02', 'Even when this is a negative value, enter the ABSULUTE value without the - sign!');
define('HELP_RS_CD03', 'You might want to exert an influence on the original value of the condition.<br/>Only the outcome of this will count for the rank points!<br />Valid signs are:<br /><center>+ - / * %</center><br />For example, if you fill this field with:<br /><center>*2</center>the original value will be doubled and this double value will be used for the rank points.<br />This field will be ignored for manual assigned values!');

define('HELP_RS_MC01', 'GUI');
define('HELP_RS_MC02', 'Level bars can be:<br/><b>fixed</b>: fixed size and will be filled by percentage<br><b>dynamic</b>: size will depend on the value of the level.');
?>