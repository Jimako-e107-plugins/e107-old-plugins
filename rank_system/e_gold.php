<?php
/**
 * $Id: e_gold.php,v 1.1 2009/03/28 13:01:43 michiel Exp $
 * 
 * Rank System for e107 v7xx - by Michiel Horvers
 * This module for the e107 .7+ website system
 * Copyright Michiel Horvers 2009
 *
 * Released under the terms and conditions of the
 * GNU General Public License (http://gnu.org).
 *
 * Revision: $Revision: 1.1 $
 * Last Modified: $Date: 2009/03/28 13:01:43 $
 *
 * Change Log:
 * $Log: e_gold.php,v $
 * Revision 1.1  2009/03/28 13:01:43  michiel
 * Initial CVS revision
 *
 *  
 */

// Define an element in the array $e_gold
$e_gold[] = array(
    'plug_name' => 'Rank System', // the name of this plugin - can be a language constant
    'plug_folder' => 'rank_system', // the folder name for this plugin
    'add' => true, // Is gold added by this plugin
    'deduct' => false, // is gold deducted by this plugin
    'gold_menu' => false, // Does it have a link to go in the gold menu
    'gold_shop' => false, // Does this plugin integrate into the gold shop
    );

?>