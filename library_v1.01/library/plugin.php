<?php
/* 
+---------------------------------------------------------------+
| Library management system plugin. License GNU/PGL
| Editor : Daddy Cool ( david.coll@e107educ.org )
|     $Source: /cvsroot/e107educ/e107educ_plugins/library/plugin.php,v $
|     $Revision: 1.1 $
|     $Date: 2007/01/21 08:02:14 $
|     $Author: daddycool78 $
+---------------------------------------------------------------+
*/
if (!defined('e107_INIT')) exit;

$lan_file	= e_PLUGIN."library/languages/".e_LANGUAGE.".php";
require_once((file_exists($lan_file) ? $lan_file : e_PLUGIN."library/languages/English.php"));


$eplug_name = BIBLIO_PLUGIN_1;
$eplug_version = "1.0";
$eplug_author = "David Coll";
$eplug_url = "http://e107educ.org";
$eplug_email = "david.coll@e107educ.org";
$eplug_description = BIBLIO_PLUGIN_2;
$eplug_compatible = "e107v0.7.6";
$eplug_compliant = false;
#$eplug_readme = '';

$eplug_folder = "library";
$eplug_menu_name = "library";
$eplug_conffile = "admin_prefs.php";
$eplug_module = false;
$eplug_icon = $eplug_folder."/icon.png";
$eplug_icon_small = $eplug_folder."/icon_small.png";
$eplug_caption = BIBLIO_PLUGIN_1;

$eplug_prefs = array(
	'library_gestionemprunt' => e_UC_ADMIN,
	'library_global_access' => e_UC_PUBLIC,
	'library_gestionemprunt_second' => e_UC_NOBODY,
	'library_membre' => e_UC_MEMBER,
	'library_perm_emprunt' => '0',
	'library_perm_retour' => '0',
	'library_perm_listeemprunt' => '0',
	'library_perm_ajout' => '0',
	'library_user_edit_summary' => '1',
	'library_nb_emprunt_max' => '4',
	'library_duree_emprunt' => '1036800',
	'library_edit_message' => BIBLIO_ADMIN_18
);

$eplug_table_names = array("library");
$eplug_tables = array("
CREATE TABLE `".MPREFIX."library` (
  `library_id` int(10) unsigned NOT NULL auto_increment,
  `library_isbn` int(13) NOT NULL default '0',
  `library_auteur1` varchar(100) NOT NULL default '',
  `library_auteur2` varchar(100) NOT NULL default '',
  `library_auteur3` varchar(100) NOT NULL default '',
  `library_auteur4` varchar(100) NOT NULL default '',
  `library_auteur5` varchar(100) NOT NULL default '',
  `library_titre` varchar(100) NOT NULL default '',
  `library_soustitre` varchar(100) NOT NULL default '',
  `library_categorie` varchar(100) NOT NULL default '',
  `library_editeur` varchar(100) NOT NULL default '',
  `library_collection` varchar(100) NOT NULL default '',
  `library_sommaire` text NOT NULL,
  `library_anneeparu` int(10) NOT NULL default '0',
  `library_exemplaire` int(5) NOT NULL default '1',
  `library_acquisle` int(10) NOT NULL default '0',
  `library_emprunte` tinyint(1) NOT NULL default '0',
  `library_empruntepar` int(10) NOT NULL default '0',
  `library_empruntdate` int(10) NOT NULL default '0',
  `library_histo` varchar(100) NOT NULL default '',
  `library_pretautorise` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`library_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ;"
);


$eplug_link = true;
$eplug_link_name = BIBLIO_MENU_1;
$eplug_link_url = e_PLUGIN.$eplug_folder."/library.php";
$eplug_done = BIBLIO_PLUGIN_4;
?>
