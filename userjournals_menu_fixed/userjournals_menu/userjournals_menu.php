<?php

// If UJ not active don't display anything at all
if (e107::pref('userjournals_menu', 'userjournals_active') == "1")
{

	if (class_exists('UserJournals'))
	{
		$userjournals_menu = new UserJournals();
	}
	else
	{
		require_once e_PLUGIN . 'userjournals_menu/userjournals_class.php';
		$userjournals_menu = new UserJournals();
	}

	$userjournals_menu->GetReaderMenu();
}

 