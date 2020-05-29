<?php
/*
+---------------------------------------------------------------+
|        e107 website system
|       
|        ©Steve Dunstan 2001-2006
|        http://e107.org
|        jalist@e107.org
|
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
|
|		$Source: ../e107_plugins/my_little_shop/admin/admin_steuer.php $
|		$Revision: 0.01 $
|		$Date: 2008/06/24 $
|		$Author: ***RuSsE*** $
+---------------------------------------------------------------+
*/

require_once("../../../class2.php");
if(!getperms("P")){ header("location:".e_BASE."index.php"); exit; }
define("PLUG_FOLDER", "my_little_shop/");
define("IMAGE_FOLDER", e_PLUGIN.PLUG_FOLDER."produkt_images/");
$lan_file = e_PLUGIN.PLUG_FOLDER."languages/".e_LANGUAGE."/cat_lan.php";
require_once(file_exists($lan_file) ? $lan_file :  e_PLUGIN.PLUG_FOLDER."languages/German/cat_lan.php");
// ++++++++ ADMIN TABLE PAGE CONFIGURATION +++++++++++++++++++++++++++++++++++++
  $configtitle = "Shop-Hauptmenü";//"My Plugin - Configuration ";
  	$pageid = "MLS_Home";  // unique name that matches the one used in admin_menu.php.
	$show_preset = TRUE; // allow e107 presets to be saved for use in the form.


require_once(e_ADMIN."auth.php");
require_once("../handler/form_handler.php");

$table_total = $sql -> db_Select($tablename);

$text = "
<div style='text-align:center'>

<table style='width:96%;' class='fborder'>
	<tr>
		<td  class='forumheader' style='text-align:center'>
			<a href='".e_PLUGIN.PLUG_FOLDER."admin/admin_categorie.php'><img border='0' style='vertical-align: middle' title='Produkt-Kategorien vewalten' src='".e_PLUGIN.PLUG_FOLDER."images/produkt_kats.png'><br/>Produkt-Kategorien</a> 
		</td>
		<td  class='forumheader' style='text-align:center'>
			<a href='".e_PLUGIN.PLUG_FOLDER."admin/admin_hersteller.php'><img border='0' style='vertical-align: middle' title='Hersteller vewalten' src='".e_PLUGIN.PLUG_FOLDER."images/manufacture.png'><br/>Hersteller</a> 
		</td>
		<td  class='forumheader' style='text-align:center'>
			<a href='".e_PLUGIN.PLUG_FOLDER."admin/admin_produkt_no_cat.php'><img border='0' style='vertical-align: middle' title='Produkte ohne Kategorien vewalten' src='".e_PLUGIN.PLUG_FOLDER."images/ohne_kat.png'><br/>Produkte ohne Kategorien</a> 
		</td>
		<td  class='forumheader' style='text-align:center'>
			<a href='".e_PLUGIN.PLUG_FOLDER."admin/admin_steuer.php'><img border='0' style='vertical-align: middle' title='Steuer-Verwaltung' src='".e_PLUGIN.PLUG_FOLDER."images/rechnung.png'><br/>Steuer</a> 
		</td>
	</tr>
	<tr>
		<td  class='forumheader' style='text-align:center'><a href='".e_PLUGIN.PLUG_FOLDER."admin/admin_steuer.php'><img border='0' style='vertical-align: middle' title='' src='".e_PLUGIN.PLUG_FOLDER."images/???'><br/>???</a> 
		</td>
		<td  class='forumheader' style='text-align:center'><a href='".e_PLUGIN.PLUG_FOLDER."admin/admin_steuer.php'><img border='0' style='vertical-align: middle' title='Menüs verwalten' src='".e_PLUGIN.PLUG_FOLDER."images/menus.png'><br/>Menüs</a> 
		</td>
		<td  class='forumheader' style='text-align:center'><a href='".e_PLUGIN.PLUG_FOLDER."admin/admin_steuer.php'><img border='0' style='vertical-align: middle' title='Seiten verwalten' src='".e_PLUGIN.PLUG_FOLDER."images/sites.png'><br/>Seiten</a> 
		</td>
		<td  class='forumheader' style='text-align:center'><a href='".e_PLUGIN.PLUG_FOLDER."admin/'><img border='0' style='vertical-align: middle' title=' ' src='".e_PLUGIN.PLUG_FOLDER."images/statistik.png'><br/>Statistik</a> 
		</td>
	</tr>
	<tr>
		<td  class='forumheader' style='text-align:center'>
		<a href='".e_PLUGIN.PLUG_FOLDER."admin/admin_auftraege_offen.php?NEUE'><img border='0' style='vertical-align: middle' title='' src='".e_PLUGIN.PLUG_FOLDER."images/auftrag_neu.png'><br/>Offene Aufträge</a>
		</td>
		<td  class='forumheader' style='text-align:center'>
		<a href='".e_PLUGIN.PLUG_FOLDER."admin/admin_auftraege_offen.php?PROZES'><img border='0' style='vertical-align: middle' title='' src='".e_PLUGIN.PLUG_FOLDER."images/auftrag_edit.png'><br/>Aufträge zu versenden</a>
		</td>
		<td  class='forumheader' style='text-align:center'>
		<a href='".e_PLUGIN.PLUG_FOLDER."admin/admin_auftraege_offen.php?OK'><img border='0' style='vertical-align: middle' title='' src='".e_PLUGIN.PLUG_FOLDER."images/auftrag_end.png'><br/>Geschlossene Aufträge</a>
		</td>
		<td  class='forumheader' style='text-align:center'>
		<a href='".e_PLUGIN.PLUG_FOLDER."admin/admin_lagerbestand.php'><img border='0' style='vertical-align: middle' title='' src='".e_PLUGIN.PLUG_FOLDER."images/lager.png'><br/>Lager-Bestand</a> 
		</td>
	</tr>
</table><br/><br/>";
$text .=powered_by_shop();
$text .= "</div>";
// =================================================================

$ns -> tablerender($configtitle, $text);
require_once(e_ADMIN."footer.php");

?>
