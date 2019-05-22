<?php
/*
+---------------------------------------------------------------+
| Library management system plugin. License GNU/PGL
| Editor : Daddy Cool ( david.coll@e107educ.org )
|     $Source: /cvsroot/e107educ/e107educ_plugins/library/autocomplete/ac_retrieve.php,v $
|     $Revision: 1.1 $
|     $Date: 2007/01/21 08:02:14 $
|     $Author: daddycool78 $
+---------------------------------------------------------------+
*/
require_once("../../../class2.php");
$lan_file	= e_PLUGIN."library/languages/".e_LANGUAGE.".php";
require_once((file_exists($lan_file) ? $lan_file : e_PLUGIN."library/languages/English.php"));

extract($_POST);
if($ac_liste_multichoice){
  if($sql->db_Select("library", "library_titre, library_soustitre", "(library_titre like '%$ac_liste_multichoice%' or library_soustitre like '%$ac_liste_multichoice%') AND library_pretautorise !='1' ORDER by library_titre")){
	 echo "<ul>\n";
  	while($row = $sql->db_Fetch()) {
  		extract($row);
  		$library_titre = eregi_replace($ac_liste_multichoice, "<b>$ac_liste_multichoice</b>", $library_titre);
  		$library_soustitre = eregi_replace($ac_liste_multichoice, "<b>$ac_liste_multichoice</b>", $library_soustitre);
  		echo "<li>$library_titre _ $library_soustitre".(@$_GET['comma']?"<span style='display:none;'>;</span>":"")."</li>\n";
  	}
  	echo "</ul>";
  }
}
elseif($ac_liste){
  if($sql->db_Select("library", "library_titre, library_soustitre, library_auteur1", "(library_titre like '%$ac_liste%' OR library_soustitre like '%$ac_liste%' OR library_auteur1 like '%$ac_liste%' OR library_auteur2 like '%$ac_liste%' OR library_auteur3 like '%$ac_liste%' OR library_auteur4 like '%$ac_liste%' OR library_auteur5 like '%$ac_liste%') ORDER by library_titre LIMIT 0,10")){
	 echo "<ul>\n";
  	while($row = $sql->db_Fetch()) {
  		extract($row);
  		$library_titre = eregi_replace($ac_liste, "<b>$ac_liste</b>", $library_titre);
  		$library_soustitre = eregi_replace($ac_liste, "<b>$ac_liste</b>", $library_soustitre);
  		$library_auteur1 = eregi_replace($ac_liste, "<b>$ac_liste</b>", $library_auteur1);
  		echo "<li><span class='informal'>de $library_auteur1</span>$library_titre _ $library_soustitre</li>\n";
  	}
  	echo "</ul>";
  }
}
elseif($ac_member){
  $condition = "AND FIND_IN_SET('4',user_class) ";   //modify this to reflect your needs !!!!!!!!!!!!!!! currently NOT used
  if($sql->db_Select("user", "user_id,user_name,user_login,user_class", "(user_name like '%$ac_member%' or user_login like '%$ac_member%') $condition ORDER by user_login")){
	 echo "<ul>\n";
  	while($row = $sql->db_Fetch()) {
  		extract($row);
  		$user_login = eregi_replace($ac_member, "<b>$ac_member</b>", $user_login);
  		$user_name = eregi_replace($ac_member, "<b>$ac_member</b>", $user_name);
  		echo "<li><span class='informal'> $user_name</span>$user_login".(@$_GET['comma']?"<span style='display:none;'>;</span>":"")."</li>\n";
  	}
  	echo "</ul>";
  }
}
else{
	 echo BIBLIO_AUTOCOMPLETE_2;

}
?>
