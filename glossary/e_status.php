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
 * $Source: /home/e-smith/files/ibays/cvsroot/files/glossary/e_status.php,v $
 * $Revision: 1.3 $
 * $Date: 2006/06/24 14:42:32 $
 * $Author: duclos $
 */

if (!defined('e107_INIT')) { exit; }

include_lan(e_PLUGIN."glossary/languages/".e_LANGUAGE."/Lan_".basename(__FILE__));

$count = $sql->db_Count("glossary", "(*)", "where glo_approved = '1'");

$text .= "
	<div style='padding-bottom: 2px;'>
		<img src='".e_PLUGIN."glossary/images/icon_16.png' style='width: 16px; height: 16px; vertical-align: bottom' alt='' /> ";

$text .= "<a href='".e_PLUGIN."glossary/admin_config.php' alt='' >".LAN_GLOSSARY_STATUS_01."</a>: ".$count;

$text .= "
	</div>";

?>