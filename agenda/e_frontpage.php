<?php
if (file_exists(e_PLUGIN."agenda/agenda_variables.php")) {
	include_once(e_PLUGIN."agenda/agenda_variables.php");

   $front_page['agenda']['title'] = 'Agenda';
   $front_page['agenda']['page'][] = array('page' => $PLUGINS_DIRECTORY.'agenda/agenda.php?view.0', 'title' => AGENDA_LAN_VIEW_00);
   $front_page['agenda']['page'][] = array('page' => $PLUGINS_DIRECTORY.'agenda/agenda.php?view.5', 'title' => AGENDA_LAN_VIEW_05);
   $front_page['agenda']['page'][] = array('page' => $PLUGINS_DIRECTORY.'agenda/agenda.php?view.1', 'title' => AGENDA_LAN_VIEW_01);
   $front_page['agenda']['page'][] = array('page' => $PLUGINS_DIRECTORY.'agenda/agenda.php?view.2', 'title' => AGENDA_LAN_VIEW_02);
   $front_page['agenda']['page'][] = array('page' => $PLUGINS_DIRECTORY.'agenda/agenda.php?view.3', 'title' => AGENDA_LAN_VIEW_03);
   $front_page['agenda']['page'][] = array('page' => $PLUGINS_DIRECTORY.'agenda/agenda.php?view.4', 'title' => AGENDA_LAN_VIEW_04);
}
?>