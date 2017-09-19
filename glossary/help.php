<?php
/**
 * Glossary by Shirka (www.shirka.org)
 *
 * A plugin for the e107 Website System (http://e107.org)
 *
 * Released under the terms and conditions of the
 * GNU General Public License (http://gnu.org).
 *
 * $Source: /home/e-smith/files/ibays/cvsroot/files/glossary/help.php,v $
 * $Revision: 1.2 $
 * $Date: 2006/06/26 23:05:57 $
 * $Author: duclos $
 */

if (!defined('e107_INIT')) { exit; }

require_once(e_PLUGIN."glossary/glossary_ver.php");
require_once(e_PLUGIN."glossary/glossary_defines.php");

include_lan(e_PLUGIN."glossary/languages/".e_LANGUAGE."/Lan_".basename(__FILE__));

if(!e_QUERY)
{
	if(e_PAGE != "admin_readme.php")
	{
		$text  = "<i>".LAN_GLOSSARY_HELP_02."</i>";
		$text .= "<br /><br />";
		$text .= "<b>".LAN_GLOSSARY_HELP_03."</b>";
		$text .= "<br /><br />";
		$text .= LAN_GLOSSARY_HELP_04;
		$text .= "<br /><br />";
		$text .= "<b>".LAN_GLOSSARY_HELP_05."</b>";
		$text .= "<br />";
		$text .= ADMIN_EDIT_ICON." : ".LAN_GLOSSARY_HELP_06;
		$text .= "<br /><br />";
		$text .= ADMIN_DELETE_ICON." : ".LAN_GLOSSARY_HELP_07;
		$text .= "<br /><br />";
		$text .= GLOSSARY_ICON_LINK." : ".LAN_GLOSSARY_HELP_09;
		$text .= "<br /><br />";
		$text .= GLOSSARY_ICON_NOLINK." : ".LAN_GLOSSARY_HELP_10;
	}
	else
		$text = LAN_GLOSSARY_HELP_08;
}
else
{
	if (e_QUERY)
		list($action, $id) = explode(".", e_QUERY);
	else
	{
		$action = FALSE;
		$id = FALSE;
		exit;
	}

	switch($action)
	{
		case "create":
			$text  = "<i>".LAN_GLOSSARY_HELP_CREATE_01."</i>";
			$text .= "<br /><br />";
			$text .= "<b>".LAN_GLOSSARY_HELP_CREATE_02."</b>";
			$text .= "<br />";
			$text .= LAN_GLOSSARY_HELP_CREATE_03;
			$text .= "<br /><br />";
			$text .= "<b>".LAN_GLOSSARY_HELP_CREATE_04."</b>";
			$text .= "<br />";
			$text .= LAN_GLOSSARY_HELP_CREATE_05;
			break;

		case "edit":
			$text = "<i>".LAN_GLOSSARY_HELP_EDIT_01."</i>";
			$text .= "<br /><br />";
			$text .= "<b>".LAN_GLOSSARY_HELP_CREATE_02."</b>";
			$text .= "<br />";
			$text .= LAN_GLOSSARY_HELP_CREATE_03;
			$text .= "<br /><br />";
			$text .= "<b>".LAN_GLOSSARY_HELP_CREATE_04."</b>";
			$text .= "<br />";
			$text .= LAN_GLOSSARY_HELP_CREATE_05;
			break;

		case "optgen":
			$text = "<i>".LAN_GLOSSARY_HELP_OPTGEN_01."</i>";
			$text .= "<br /><br />";
			$text .= "<b>".LAN_GLOSSARY_HELP_OPTGEN_02."</b>";
			$text .= "<br />";
			$text .= LAN_GLOSSARY_HELP_OPTGEN_03;
			$text .= "<br /><br />";
			break;

		case "optpage":
			$text = "<i>".LAN_GLOSSARY_HELP_OPTPAGE_01."</i>";
			$text .= "<br /><br />";
			$text .= "<b>".LAN_GLOSSARY_HELP_OPTPAGE_02."</b>";
			$text .= "<br />";
			$text .= LAN_GLOSSARY_HELP_OPTPAGE_03;
			$text .= "<br /><br />";
			break;

		case "optmenu":
			$text = "<i>".LAN_GLOSSARY_HELP_OPTMENU_01."</i>";
			$text .= "<br /><br />";
			$text .= "<b>".LAN_GLOSSARY_HELP_OPTMENU_02."</b>";
			$text .= "<br />";
			$text .= LAN_GLOSSARY_HELP_OPTMENU_03;
			$text .= "<br /><br />";
			break;

		case "displaySubmitted":
			$text = "<i>".LAN_GLOSSARY_HELP_SUBWORD_01."</i>";
			$text .= "<br /><br />";
			$text .= "<b>".LAN_GLOSSARY_HELP_SUBWORD_02."</b>";
			$text .= "<br />";
			$text .= LAN_GLOSSARY_HELP_SUBWORD_03;
			$text .= "<br /><br />";
			break;

		case "link":
			$text = "<i>".LAN_GLOSSARY_HELP_LINK_01."</i>";
			$text .= "<br /><br />";
			$text .= "<b>".LAN_GLOSSARY_HELP_LINK_02."</b>";
			$text .= "<br />";
			$text .= LAN_GLOSSARY_HELP_LINK_03;
			$text .= "<br /><br />";
			break;

		default:
			$text = $action." ???";
	}
}

$helptitle = LAN_GLOSSARY_HELP_01;

$ns -> tablerender($helptitle, $text);

?>