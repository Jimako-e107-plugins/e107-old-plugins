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
 * $Source: /home/e-smith/files/ibays/cvsroot/files/glossary/e_list.php,v $
 * $Revision: 1.3 $
 * $Date: 2006/06/27 14:55:36 $
 * $Author: duclos $
 */

if (!defined('e107_INIT')) { exit; }

if(!$glossary_install = $sql->db_Select("plugin", "*", "plugin_path = 'glossary' AND plugin_installflag = '1' "))
	return;

include_lan(e_PLUGIN."glossary/languages/".e_LANGUAGE."/Lan_".basename(__FILE__));

$LIST_CAPTION = $arr[0];
$LIST_DISPLAYSTYLE = ($arr[2] ? "" : "none");

if($mode == "new_page" || $mode == "new_menu" )
{
	$lvisit = $this->getlvisit();
	$qry = "glo_datestamp>".$lvisit." AND";		
}
else
	$qry = "";

$qry .= " glo_approved = '1' ORDER BY glo_datestamp DESC LIMIT 0,".intval($arr[7]);

$bullet = $this->getBullet($arr[6], $mode);

if(!$sql -> db_Select("glossary", "*", $qry))
	$LIST_DATA = LAN_GLOSSARY_LIST_01;
else
	while($row = $sql -> db_Fetch())
	{

		$rowheading	= $this->parse_heading($row['glo_name'], $mode);
		$ICON		= $bullet;

		$HEADING	= "<a href='".e_PLUGIN."glossary/glossaire.php#word_id_".$row['glo_id']."' title='".LAN_GLOSSARY_LIST_02."' rel='internal'>".$rowheading."</a>";

		if ($arr[3])
		{
			$tmp = explode(".", $row['glo_author']);
			if($tmp[0] == "0")
				$AUTHOR = $tmp[1];
			elseif(is_numeric($tmp[0]) && $tmp[0] != "0")
				$AUTHOR = (USER ? "<a href='".e_BASE."user.php?id.".$tmp[0]."'>".$tmp[1]."</a>" : $tmp[1]);
			else
				$AUTHOR = "";
		}
		else
			$AUTHOR = "";

		$CATEGORY	= "";
		$DATE		= ($arr[5] ? ($row['glo_datestamp'] > 0 ? $this -> getListDate($row['glo_datestamp'], $mode) : "") : "");
		$INFO		= "";
		$LIST_DATA[$mode][] = array( $ICON, $HEADING, $AUTHOR, $CATEGORY, $DATE, $INFO );
	}

?>