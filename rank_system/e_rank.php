<?php

/**
 * $Id: e_rank.php,v 1.5 2009/10/22 21:29:45 michiel Exp $
 * 
 * Rank System for e107 v7xx - by Michiel Horvers
 * This module for the e107 .7+ website system
 * Copyright Michiel Horvers 2009
 *
 * Released under the terms and conditions of the
 * GNU General Public License (http://gnu.org).
 *
 * Initial Creation Date: 28 mrt 2009 - 14:10:19
 * 
 * Revision: $Revision: 1.5 $
 * Last Modified: $Date: 2009/10/22 21:29:45 $
 *
 * Change Log:
 * $Log: e_rank.php,v $
 * Revision 1.5  2009/10/22 21:29:45  michiel
 * Implemeted Time-based goals
 *
 * Revision 1.4  2009/10/22 19:10:27  michiel
 * Added triggers for Rank conditions
 *
 * Revision 1.3  2009/10/22 15:03:35  michiel
 * Implemented customizable conditions
 *
 * Revision 1.2  2009/06/26 09:23:00  michiel
 * Merged from dev_01_01
 *
 * Revision 1.1.2.1  2009/04/01 19:26:41  michiel
 * Medal goal automated using e_rank.php
 *
 *  
 */

// Define an element in the array $e_rank
$e_rank[] = array(
    'plug_name' => 'Rank System', // the name of this plugin - can be a language constant
    'plug_folder' => 'rank_system', // the folder name for this plugin
	'goal_visits' => array (
		'goal' => 'goal_visits',
		'trigger' => 'trigger_visits',
		'name' => 'Site visits',
		'table' => 'user',
		'field' => 'user_visits',
		'usr_field' => 'user_id'
	),
	'goal_forum' => array (
		'goal' => 'goal_forum',
		'trigger' => 'trigger_forum',
		'name' => 'Forum posts',
		'table' => 'user',
		'field' => 'user_forums',
		'usr_field' => 'user_id'
	),
	'goal_chatbox' => array (
		'goal' => 'goal_chatbox',
		'trigger' => 'trigger_chatbox',
		'name' => 'Chatbox posts',
		'table' => 'user',
		'field' => 'user_chats',
		'usr_field' => 'user_id'
	),
	'goal_comments' => array (
		'goal' => 'goal_comments',
		'trigger' => 'trigger_comments',
		'name' => 'Comment posts',
		'table' => 'user',
		'field' => 'user_comments',
		'usr_field' => 'user_id'
	),
	'goal_join' => array (
		'goal' => 'goal_join',
		'name' => 'Member since',
		'table' => 'user',
		'field' => 'user_join',
		'usr_field' => 'user_id'
	),
	'trigger_allposts' => array (
		'trigger' => 'trigger_allposts',
		'name' => 'All Posts',
		'table' => 'user',
		'field' => '(user_comments+user_forums+user_chats)',
		'usr_field' => 'user_id'
	),
		
	'medals' => true, //Will this plugin influence the medals
	'ranks' => true //Will this plugin influence the ranks
);

?>