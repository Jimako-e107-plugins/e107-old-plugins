<?php
/*
|***********************************************************************
|	e_my_items extension for e_Classifieds 2.24
|	e_my_items version 1.1
|
|	This module for the e107 1.0.2+ website system
|
|	Autor: Goslarer1 (Alfred Steckel)
|	Autor eMail: roadnet@roadnet.de
|	Autor Webseite: http://roadnet.de
|
|	Released under the terms and conditions of the
|	GNU General Public License (http://gnu.org).
|***********************************************************************
*/

//-------------------------e107 Scripte einbindung und Prüfung-----------------------------------------------------------------------------------------------------+
require_once("../../class2.php");
if (!defined('e107_INIT')) { exit; }
require_once(HEADERF);
include_lan(e_PLUGIN.'e_classifieds/languages/'.e_LANGUAGE.'.php');

//-------------------------Einbinden der shortcode. EIns vom e107, das 2. vom e_classifieds------------------------------------------------------------------------+
include_once(e_HANDLER . 'shortcode_handler.php');
$eclassf_shortcodes = $tp->e_sc->parse_scbatch(__FILE__);

//-------------------------Verbindung zur Datenbank aufnehmen------------------------------------------------------------------------------------------------------+
$mysql = new db();
$mysql->db_Connect($mySQLserver, $mySQLuser, $mySQLpassword, $mySQLdefaultdb);

//-------------------------Umrechnen der Timestamp Daten aus der DB in einem lesbaren Datum------------------------------------------------------------------------+
$eclassf_gen = new convert;
$mysql = mysql_query("SELECT DATE_FORMAT(date, '%d.%m.%Y') FROM elcassf_posted");
$eclassf_today = mktime(0, 0, 0, date("n", time()), date("j", time()), date("Y", time()));
global $user_shortcodes, $pref, $user;
define("HIDE_EMPTY_FIELDS", FALSE);

//--------------------------DB-Tabellen auf Berechtigung prüfen und auslesen---------------------------------------------------------------------------------------+
$sql2 = new db();
	$sql2 -> db_Select("eclassf_ads", "*","eclassf_user=".USERID."");
$isuser = mysql_fetch_array($sql2);

//---------------------------Meldungen-----------------------------------------------------------------------------------------------------------------------------+
$fehler .="<tr><td  class='forumheader' colspan='5' style='text-align: center; border-bottom: 1px solid #000000;'>Sie haben noch keine Artikel angelegt!</td></tr>";

//---------------------------Testarea PM------------------------------------------------------------------------------------------------------------+


//---------------------------Die Buttons oberhalb der Anzeige in "Mein Shop"---------------------------------------------------------------------------------------+
$text .="
<table class='fborder' style='" . USER_WIDTH . ";'>
<tr>
<td colspan='5'>
</td>
</tr>
<tr>
<td colspan='5' style='text-align:center; padding: 2px;'>
<a href='../../index.php'><input type='button' name='Text 2' value='Home'></a>
<a href='" . e_PLUGIN . "e_classifieds/classifieds.php'><input type='button' name='Text 2' value='Zum Shop'></a>
<a href='../../user.php?id.".USERID."'><input type='button' name='user' value='Mein Profil'></a>
<a href='".e_PLUGIN_ABS."pm/pm.php?inbox'><input type='button' name='Text 2' value='Posteingang'></a>
<a href='".e_PLUGIN."e_classifieds/manage_adds.php'><input type='button' name='Neuer_Artikel' value='Neuer Artikel'></a>
</td>
</tr>";
//---------------------------Das ist nur ein Abstandshalter, kann aber auch mit Inhalt gefüllt werden.------------------------------------------------------------+
$text .="
<tr>
<td  colspan='5' class='forumheader'>&nbsp;</td>
</tr>";

//---------------------------Tabellen aus der DB auslesen---------------------------------------------------------------------------------------------------------+
$sql = new db();
$sql -> db_Select("eclassf_ads", "*","eclassf_user=".USERID."");

//---------------------------Tabelle auslesen, prüfen ob User Ware hat, dann anzeigen. Wenn User keine Ware hat, dann Fehlermeldung.------------------------------+
if(mysql_affected_rows() == 0){$text .="$fehler";}

//---------------------------Anzeige aller Userartikel wenn Prüfung erfolgreich.----------------------------------------------------------------------------------+
else
{
$text .="
<tr>
<th class='forumheader' style='text-align:left; background-color: #FFDFB0;'>Artikelbild</th>
<th class='forumheader' style='text-align:left; background-color: #FFDFB0;'>Artikel</th>
<th class='forumheader' style='text-align:center; background-color: #FFDFB0;'>Anbieter</th>
<th class='forumheader' style='text-align:center; background-color: #FFDFB0;'>Preis</th>
<th class='forumheader' style='text-align:center; background-color: #FFDFB0;'>Beobachter</th>
</tr>
";
	
//---------------------------Auflisten und anzeigen der Userartikel------------------------------------------------------------------------------------------------------------+
			while($row = $sql-> db_Fetch()) 
		{
		extract($row);
		$eclassf_poster = substr($eclassf_user, strpos($eclassf_user, ".")+1);

$text .="<tr>
			<td class='forumheader' rowspan='2' style='text-align: left; padding: 2px 4px 0 0; border-bottom: 1px solid #000000;'>
			<a href='" . e_PLUGIN . "e_classifieds/classifieds.php?0.item." . $row['eclassf_id'] . "." . $row['eclassf_subid'] . "." . $row['eclassf_id'] . "' >
				<img src='" . e_PLUGIN . "e_classifieds/images/classifieds/" . $row['eclassf_thumbnail'] . "' alt='" . $row['eclassf_name'] . "' title='" . $row['eclassf_name'] . "' style='height:80px;width:80px; padding: 4px;'/>
			</a>
			</td>
			<td class='forumheader' style='padding-top: 4px; text-align:left; vertical-align: top;'>
				<a href='" . e_PLUGIN . "e_classifieds/classifieds.php?0.item." . $row['eclassf_id'] . "." . $row['eclassf_subid'] . "." . $row['eclassf_id'] . "' ><font style='color: #B20000;'>".$row['eclassf_name']."</font></a><br /><br />".$row['eclassf_desc']."</td>
			<td class='forumheader' style='padding-top: 4px; text-align:center; vertical-align: top; width:60px;'><a href='../../user.php?id.".USERID."'>$eclassf_poster</a></td>
			<td class='forumheader' style='padding-top: 4px; text-align:center; vertical-align: top; width:45px;'>".$row['eclassf_price']."&nbsp;&euro;</td>
			<td class='forumheader' style='padding-top: 4px; text-align:center; vertical-align: top;'>".$row['eclassf_views']."
			</td>
		</tr>
		<tr>
		<td  class='forumheader' colspan='4' style='text-align: right; vertical-align: top; border-bottom: 1px solid #000000;'>
		Artikel- Nr.&nbsp; ".$row['eclassf_id']."&nbsp;&nbsp;<a href='".e_PLUGIN."e_classifieds/manage_adds.php?action=godo&catid=" . $row['eclassf_id'] . "&actvar=edit'>Bearbeiten</a>&nbsp;|&nbsp;<a href='".e_PLUGIN."e_classifieds/manage_adds.php?action=godo&catid=" . $row['eclassf_id'] . "&actvar=delete'>L&ouml;schen</a></td>
		</tr>\n";
		}
}

//---------------------------Respektiere die Arbeit der Coder und lass dieses Copiryght drinn.---------------------------------------------------------------------------------+
$text .="
<tr>
<td colspan='5' border='none' style='font-size: 9px; color: #D5D5D5; text-align: right; vertical-align: bottom;'><a href='http://roadnet.de' style='color: #D5D5D5'>&copy; 2012&nbsp;Alfred Steckel</a></td>
</tr>
</table>";
$text .="<script type='text/javascript' src='../js/table-sort/js/paginate.js'></script>
		<script type='text/javascript' src='../js/table-sort/js/tablesort.js'></script>	
		<link rel='stylesheet' type='text/css' href='../js/table-sort/css/sort.css' media='screen' />";
$caption = 'Meine privater Shop';
$ns->tablerender($caption,$text); 
require_once(FOOTERF);
?>