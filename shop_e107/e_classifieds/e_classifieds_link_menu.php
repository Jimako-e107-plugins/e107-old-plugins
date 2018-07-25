<?php
/*
|***********************************************************************
|	e_classifieds_link_menu for e_Classifieds 2.24
|	e_classifieds_link_menu version 1.1
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
if (!defined('e107_INIT'))
{
    exit;
}

$text_link .="
<a href='".e_PLUGIN."e_classifieds/classifieds.php'><img src='".e_PLUGIN."e_classifieds//images/lev1.png'/>&nbsp;Zum Shop</a><br />
<a href='../../search.php'><img src='".e_PLUGIN."e_classifieds//images/lev1.png'/>&nbsp;Artikel suchen</a><br />";

$mysql = new db();
$mysql->db_Connect($mySQLserver, $mySQLuser, $mySQLpassword, $mySQLdefaultdb);
$sql2 = new db();
	$sql2 -> db_Select("eclassf_ads", "*","eclassf_user=".USERID."");
$isuser = mysql_fetch_array($sql2);
if(mysql_affected_rows() == 0){$text .="falsch";}


else {$text_link .="
<a href='".e_PLUGIN."e_classifieds/e_my_items.php'/><img src='".e_PLUGIN."e_classifieds//images/lev1.png'/>&nbsp;Meine Artikel</a><br />
";
}
$ns->tablerender("Shopnavigation", $text_link);

?>