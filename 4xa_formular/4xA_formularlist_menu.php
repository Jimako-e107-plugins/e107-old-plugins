<?php
/*
+---------------------------------------------------------------+
|	4xA-Formular v0.10 - by ***RuSsE*** (www.e107.4xA.de) 23.02.2011
|		sorce: ../../4xa_formular/4xA_formularlist_menu.php
|
|		For the e107 website system
|		©Steve Dunstan 2001-2002
|		http://e107.org
|		jalist@e107.org
|
|		Released under the terms and conditions of the
|		GNU General Public License (http://gnu.org).
|
+---------------------------------------------------------------+
*/

if (!defined('e107_INIT')) { exit; }

$lan_file = e_PLUGIN."4xa_formular/languages/".e_LANGUAGE.".php";
require_once(file_exists($lan_file) ? $lan_file : e_PLUGIN."4xa_formular/languages/German.php");
$text = "";

$sql->db_Select("e4xA_form_kathegories", "*", "form_kat_id!=''");
while($row = $sql->db_Fetch()){
$text .= "<a href='".e_PLUGIN."4xa_formular/formular.php?".$row['form_kat_id']."'>".$row['form_kat_caption']."</a><br/>";
}

$ns->tablerender(LAN_4xA_FORM_126, $text, 'counter');

?>