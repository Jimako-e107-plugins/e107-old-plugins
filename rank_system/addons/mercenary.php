<?php

// Define an element in the array $e_rank
$e_rank[] = array(
    'plug_name' => 'Mercenary', // the name of this plugin - can be a language constant
    'plug_folder' => 'mercenary', // the folder name for this plugin
	'goal_merc_rounds' => array (
		'goal' => 'goal_merc_rounds',
		'name' => 'Mercenary Rounds',
		'table' => 'merc_users',
		'field' => 'merc_rounds',
		'usr_field' => 'merc_userid'
	),
	'medals' => true, //Will this plugin influence the medals
	'ranks' => false //Will this plugin influence the ranks
);

?>