<?php
/**
 * $Id: e_status.php,v 1.1 2009/03/28 13:01:44 michiel Exp $
 * 
 * Rank System for e107 v7xx - by Michiel Horvers
 * This module for the e107 .7+ website system
 * Copyright Michiel Horvers 2009
 *
 * Released under the terms and conditions of the
 * GNU General Public License (http://gnu.org).
 *
 * Revision: $Revision: 1.1 $
 * Last Modified: $Date: 2009/03/28 13:01:44 $
 *
 * Change Log:
 * $Log: e_status.php,v $
 * Revision 1.1  2009/03/28 13:01:44  michiel
 * Initial CVS revision
 *
 *  
 */

include_lan(e_PLUGIN . "rank_system/languages/admin/" . e_LANGUAGE . ".php");
$rec_posts = $sql->db_Count("rank_recommend", "(*)", "WHERE recomm_state =0");
if (empty($rec_posts))
{
    $rec_posts = 0;
}
$text .= "<div style='padding-bottom: 2px;'><img src='" . e_PLUGIN . "rank_system/images/ranks16.gif' style='width: 16px; height: 16px; vertical-align: bottom;border:0;' alt='' /> " . ADLAN_RS_SS01 . ": " . $rec_posts . "</div>";

?>