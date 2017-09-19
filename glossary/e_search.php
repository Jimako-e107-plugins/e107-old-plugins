<?php
/**
 * Glossary by Shirka (www.shirka.org)
 *
 * A plugin for the e107 Website System (http://e107.org)
 *
 * ©Andre DUCLOS 2006
 * http://www.shirka.org
 * duclos@shirka.org
 *
 * Released under the terms and conditions of the
 * GNU General Public License (http://gnu.org).
 *
 * $Source: /home/e-smith/files/ibays/cvsroot/files/glossary/e_search.php,v $
 * $Revision: 1.1 $
 * $Date: 2006/06/10 19:53:03 $
 * $Author: duclos $
 */

if (!defined('e107_INIT')) { exit; }

include_lan(e_PLUGIN."glossary/languages/".e_LANGUAGE."/Lan_".basename(__FILE__));

$search_info[] = array(
	'sfile'			=> e_PLUGIN.'glossary/search/search_parser.php', 
	'qtype'			=> LAN_GLOSSARY_SEARCH_01, 
	'refpage'		=> 'glossaire.php', 
	'advanced'	=> e_PLUGIN.'glossary/search/search_advanced.php', 
	'id'				=> 'glossary'
	);

?>