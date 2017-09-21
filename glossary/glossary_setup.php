<?php
/*
* e107 website system
*
* Copyright (c) 2008-2016 e107 Inc (e107.org)
* Released under the terms and conditions of the
* GNU General Public License (http://www.gnu.org/licenses/gpl.txt)
*
* Custom Qlossarry install/uninstall/update routines
*
*/

class glossary_setup
{
/*	
 	function install_pre($var)
	{
		// print_a($var);
		// echo "custom install 'pre' function<br /><br />";
	}
*/
	function install_post($var)
	{
		$sql = e107::getDb();
		$mes = e107::getMessage();
		$tp = e107::getParser();
		 
		$query = "INSERT INTO #glossary (glo_id, glo_name, glo_description, glo_author, glo_datestamp, glo_approved, glo_linked) VALUES 
      (1, '".$tp->toDB(LAN_GLOSSARY_EXAMPLE_WRD_01)."', '".$tp->toDB(LAN_GLOSSARY_EXAMPLE_DEF_01)."', '".USERID.".".USERNAME."', '".time()."', '1', '0'),
			(2, '".$tp->toDB(LAN_GLOSSARY_EXAMPLE_WRD_02)."', '".$tp->toDB(LAN_GLOSSARY_EXAMPLE_DEF_02)."', '".USERID.".".USERNAME."', '".time()."', '1', '0');
 		";
		
		$status = ($sql->gen($query, true)) ? E_MESSAGE_SUCCESS : E_MESSAGE_ERROR;
		$mes->add(LAN_DEFAULT_TABLE_DATA.": glossarys", $status);
 
 

	}
/*	
	function uninstall_options()
	{
	
	}


	function uninstall_post($var)
	{
		// print_a($var);
	}

	function upgrade_post($var)
	{
		// $sql = e107::getDb();
	}
*/	
}
