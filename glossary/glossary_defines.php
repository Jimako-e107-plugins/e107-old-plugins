<?php
/**
 * Glossary by Shirka (www.shirka.org)
 *
 * A plugin for the e107 Website System (http://e107.org)
 *
 * Released under the terms and conditions of the
 * GNU General Public License (http://gnu.org).
 *
 * $Source: /home/e-smith/files/ibays/cvsroot/files/glossary/glossary_defines.php,v $
 * $Revision: 1.2 $
 * $Date: 2006/06/14 23:07:30 $
 * $Author: duclos $
 */

if (!defined('e107_INIT')) { exit; }

include_lan(e_PLUGIN."glossary/languages/".e_LANGUAGE."/Lan_".basename(__FILE__));

$imagedir = e_IMAGE."/admin_images/";

if (!defined('GLOSSARY_ICON_LINK'))
	define('GLOSSARY_ICON_LINK', "<img src='".$imagedir."arrow_16.png' alt='' title='".GLOSSARY_LAN_ICON_01."' style='border:0; cursor:pointer;' />");

if (!defined('GLOSSARY_ICON_NOLINK'))
	define('GLOSSARY_ICON_NOLINK', "<img src='".$imagedir."arrow_over_16.png' alt='' title='".GLOSSARY_LAN_ICON_02."' style='border:0; cursor:pointer;' />");

?>