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
 * $Source: /home/e-smith/files/ibays/cvsroot/files/glossary/glossary.php,v $
 * $Revision: 1.5 $
 * $Date: 2006/06/27 14:55:36 $
 * $Author: duclos $
 */

if (!defined('e107_INIT')) { exit; }

include_lan(e_PLUGIN."glossary/languages/".e_LANGUAGE."/Lan_".basename(__FILE__));

class e_glossary
{
	var $linkdefs = array();
	var $linkurls = array();

	function e_glossary()
	{

		// constructor
		$sql = new db;
		if($sql->db_Select("glossary", "*", "glo_approved = '1' AND glo_linked = '1'"))
		{
			$linkdefs = $sql -> db_getList();
			foreach($linkdefs as $words)
			{
				$word = $words['glo_name'];
				$this->linkdefs[] = $word;
				$this->linkurls[] = "<a href='".e_PLUGIN."glossary/glossaire.php#word_id_".$words['glo_id']."' title='".LAN_GLOSSARY_LINK_01."' rel='internal'>".$word."</a>";
			}
		}
	}

	function glossary($text)
	{
		global $pref;
		if ($pref['glossary_linkword'] && basename(e_SELF) != "glossaire.php")
		{
			$content = preg_split('#(<.*>)#Umis', $text, -1, PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE );
			$ptext = "";
//print("[[".$text."]]");
//print("[<"); print_r($content); print(">]");
/*
			foreach($content as $cont)
			{
				$ptext .= (strstr($cont, "<") ? $cont : str_replace($this -> linkwords, $this -> linkurls, $cont));
			}
*/
			$in = 0;

			$opentag1 = "^(<a|<img).*>$";
			$opentag2 = "^<img.*>$";
			$closetag = "^</a>$";
			
			foreach($content as $cont)
			{
				//if (eregix($opentag1, $cont))
				if (preg_match("%".$opentag1."%i", $cont))  
					$in++;

				//if (eregix($closetag, $cont))
				if (preg_match("%".$closetag."%i", $cont))  
					$in--;

				if ($in)
				{
					$ptext .= $cont;
					//if (eregix($opentag2, $cont))
					if (preg_match("%".$opentag2."%i", $cont))  
						$in--;
				}
				else
					$ptext .= str_replace($this->linkdefs, $this->linkurls, $cont);
			}
			return $ptext;
		}

		return $text;
	}

}

?>