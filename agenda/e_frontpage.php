<?php
if (file_exists(e_PLUGIN."agenda/agenda_variables.php")) {
	include_once(e_PLUGIN."agenda/agenda_variables.php");
	
	class agenda_frontpage // include plugin-folder in the name.
	{
		function config()
		{
			$frontPage = array();
			$frontPage['title'] = 'Agenda';
			$frontPage['page'][] = array('page' => $PLUGINS_DIRECTORY.'agenda/agenda.php?view.0', 'title' => AGENDA_LAN_VIEW_00);
			$frontPage['page'][] = array('page' => $PLUGINS_DIRECTORY.'agenda/agenda.php?view.5', 'title' => AGENDA_LAN_VIEW_05);
   		$frontPage['page'][] = array('page' => $PLUGINS_DIRECTORY.'agenda/agenda.php?view.1', 'title' => AGENDA_LAN_VIEW_01);
   		$frontPage['page'][] = array('page' => $PLUGINS_DIRECTORY.'agenda/agenda.php?view.2', 'title' => AGENDA_LAN_VIEW_02);
   		$frontPage['page'][] = array('page' => $PLUGINS_DIRECTORY.'agenda/agenda.php?view.3', 'title' => AGENDA_LAN_VIEW_03);
   		$frontPage['page'][] = array('page' => $PLUGINS_DIRECTORY.'agenda/agenda.php?view.4', 'title' => AGENDA_LAN_VIEW_04);
			return 	$frontPage;
		}
	}
}
?>