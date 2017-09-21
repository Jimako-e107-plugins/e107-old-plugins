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
 * $Source: /home/e-smith/files/ibays/cvsroot/files/glossary/glossary_menu.php,v $
 * $Revision: 1.7 $
 * $Date: 2006/06/27 13:38:49 $
 * $Author: duclos $
 */

if (!defined('e107_INIT')) { exit; }

global   $rs;

$pref = e107::getPlugConfig('glossary')->getPref();

require_once(e_PLUGIN.'glossary/glossary_class.php');
$gc = new glossary_class();

require_once(e_HANDLER."form_handler.php");
$rs = new form;

include_lan(e_PLUGIN."glossary/languages/".e_LANGUAGE."/Lan_".basename(__FILE__));

$text = $gc->displayNav("menu");  	 

if (isset($pref['glossary_menu_lastword']) && $pref['glossary_menu_lastword'])
	$text .= $gc->buildMenuLastWord();
else
	$text .= $gc->buildMenuRandWord();

$caption = (isset($pref['glossary_menu_caption']) && $pref['glossary_menu_caption'] ? $pref['glossary_menu_caption'] : LAN_GLOSSARY_BLMENU_01);

$ns->tablerender($caption, $text);

?>