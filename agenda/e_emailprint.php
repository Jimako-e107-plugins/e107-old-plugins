<?php

   require(e_PLUGIN."agenda/agenda_variables.php");
   require(e_PLUGIN."agenda/agendaUtils.php");

function print_item($id) {
   global $pref, $agenda, $agn_sql1;

   $pagetitle = isset($pref["agenda_page_title"]) && strlen($pref["agenda_page_title"]) > 0 ? $pref["agenda_page_title"] : AGENDA_LAN_NAME;
   agendaSetFilterSQL();
   require_once(e_PLUGIN."agenda/agendaView".$agenda->getP2().".php");
   return $text;
}

function email_item($id)
{
	$plugintable = "pcontent";
	if(!is_object($sql)){ $sql = new db; }
	if($sql -> select($plugintable, "content_id, content_heading, content_subheading, content_text, content_author, content_parent, content_datestamp, content_class", "content_id='$id' ")){
		while($row = $sql -> db_Fetch()){
			$tmp = explode(".",$row['content_parent']);
			if(!check_class($row['content_class'])){
				header("location:".e_PLUGIN."content/content.php"); exit;
			}
			$message = SITEURL.e_PLUGIN."content/content.php?content.".$id."\n\n".$row['content_heading']."\n".$row['content_subheading']."\n";
		}
		return $message;
	}
}

?>