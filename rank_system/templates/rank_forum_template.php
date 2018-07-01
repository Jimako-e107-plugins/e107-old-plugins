<?php
/**
 * $Id: rank_forum_template.php,v 1.2 2009/06/28 15:06:15 michiel Exp $
 * 
 * Rank System for e107 v7xx - by Michiel Horvers
 * This module for the e107 .7+ website system
 * Copyright Michiel Horvers 2009
 *
 * Released under the terms and conditions of the
 * GNU General Public License (http://gnu.org).
 *
 * Initial Creation Date: 28 jun 2009 - 03:58:11
 * 
 * Revision: $Revision: 1.2 $
 * Last Modified: $Date: 2009/06/28 15:06:15 $
 *
 * Change Log:
 * $Log: rank_forum_template.php,v $
 * Revision 1.2  2009/06/28 15:06:15  michiel
 * Merged from dev_01_03
 *
 * Revision 1.1.2.1  2009/06/28 02:35:56  michiel
 * forum templates have been separated from user profile templates
 *
 *  
 */
if (!defined('e107_INIT'))
{
    exit;
}
if (!defined("USER_WIDTH"))
{
    define(USER_WIDTH, "width:100%;");
}

global $rank_shortcodes;

$RANK_FORUM_PROFILE = "{RANK_FORUM_IMG}";

$RANK_FORUM_STAT = "
<br/>".RANKS_FRM_01." {RANK_FORUM_MEDCOUNT}
<br/>".RANKS_FRM_02." {RANK_FORUM_RIBCOUNT}<br/><br/>
";
    
?>