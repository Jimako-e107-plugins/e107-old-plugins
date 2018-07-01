<?php

// Define an element in the array $e_rank
$e_rank[] = array(
    'plug_name' => 'KroozeArcade', // the name of this plugin - can be a language constant
    'plug_folder' => 'kroozearcade_menu', // the folder name for this plugin
	'goal_champ' => array (
		'goal' => 'goal_champ',
		'name' => 'Arcade Champs',
		'table' => 'arcade_champions',
		'query' => "select count(game_id) count from #arcade_champs where user_id = {USER_ID}"
	),
	'medals' => true, //Will this plugin influence the medals
	'ranks' => false //Will this plugin influence the ranks
);

?>