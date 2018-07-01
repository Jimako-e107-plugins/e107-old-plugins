<?php
/**
 * $Id: e_notify.php,v 1.1 2009/03/28 13:01:39 michiel Exp $
 * 
 * Rank System for e107 v7xx - by Michiel Horvers
 * This module for the e107 .7+ website system
 * Copyright Michiel Horvers 2009
 *
 * Released under the terms and conditions of the
 * GNU General Public License (http://gnu.org).
 *
 * Revision: $Revision: 1.1 $
 * Last Modified: $Date: 2009/03/28 13:01:39 $
 *
 * Change Log:
 * $Log: e_notify.php,v $
 * Revision 1.1  2009/03/28 13:01:39  michiel
 * Initial CVS revision
 *
 *  
 */

if (!defined('e107_INIT')) { exit; }
include_lan(e_PLUGIN . "rank_system/languages/" . e_LANGUAGE . ".php");
$config_category = RANKS_NF_01;
$config_events = array('recommpost' => RANKS_NF_02);

if (!function_exists('notify_recommpost'))
{
    function notify_recommpost($recommdata)
    {
        global $nt;
        $message = "<strong>" . RANKS_NF_03 . ": </strong>" . $recommdata['source'] . "<br />";
        $message .= "<strong>" . RANKS_NF_04 . ":</strong> " . $recommdata['target'] . "<br />";
        $message .= "<strong>" . RANKS_NF_05 . ":</strong> " . $recommdata['recomm'] . "<br />";
        $message .= "<strong>" . RANKS_NF_06 . ":</strong><br />";
        $message .= $recommdata['motiv']."<br /><br />";
        $nt->send('recommpost', RANKS_NF_01, $message);
    }
}

?>