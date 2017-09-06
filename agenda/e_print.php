<?php

   require(e_PLUGIN."agenda/agenda_variables.php");
   require(e_PLUGIN."agenda/agendaUtils.php");
   $text = print_item();

function print_item($id) {
   global $pref, $agenda;

   $pagetitle = isset($pref["agenda_page_title"]) && strlen($pref["agenda_page_title"]) > 0 ? $pref["agenda_page_title"] : AGENDA_LAN_NAME;
   agendaSetFilterSQL();
   require_once(e_PLUGIN."agenda/agendaView".$agenda->getP2().".php");
   return $text;
}

?>