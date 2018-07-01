<?php

// Define an element in the array $e_rank
$e_rank[] = array(
    'plug_name' => 'FAQ', // the name of this plugin - can be a language constant
    'plug_folder' => 'faq', // the folder name for this plugin
	'goal_faq' => array (
		'goal' => 'goal_faq',
		'name' => 'FAQ posts',
		'table' => 'faq',
		'query' => "select count(*) count from #faq where faq_author like '{USER_ID}.%'"
	),
	'medals' => true, //Will this plugin influence the medals
	'ranks' => false //Will this plugin influence the ranks
);

?>