<?php
e107::plugLan("userjournals_menu" , "admin/".e_LANGUAGE, false);
e107::plugLan("userjournals_menu" , e_LANGUAGE, false);

class userjournals_menu extends e_search  
{

	function config()
	{	
		$search = array(
			'name'			=> LAN_JOURNAL_A0,
			'table'			=> 'userjournals',
			'qtype'     	=> UJ1,
			'advanced' 		=> array(
								'date'	=> array('type'	=> 'date', 		'text' => LAN_DATE_POSTED),
								'author'=> array('type'	=> 'author',	'text' => LAN_SEARCH_61)
							),
							
			'return_fields'	=> array('blank_id', 'blank_nick', 'blank_message', 'blank_datestamp'),
			'search_fields'	=> array('blank_nick' => '1', 'blank_message' => '1'), // fields and weights.
			
			'order'			=> array('blank_datestamp' => 'DESC'),
			'refpage'		=> 'userjournals.php'
		);


		return $search;
	}

}
$search_info[] = array(
   'sfile'     => e_PLUGIN.'userjournals_menu/search.php',
   'qtype'     => UJ1,
   'refpage'   => 'userjournals.php'
);



