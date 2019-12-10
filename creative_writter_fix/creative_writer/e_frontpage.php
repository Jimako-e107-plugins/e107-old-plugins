<?php
/*
 * e107 website system
 *
 * Copyright (C) 2008-2015 e107 Inc (e107.org)
 * Released under the terms and conditions of the
 * GNU General Public License (http://www.gnu.org/licenses/gpl.txt)
 *
*/

if (!defined('e107_INIT')) { exit; }

e107::lan('creative_writer',true);

//v2.x spec.
class creative_writer_frontpage // include plugin-folder in the name.
{
	// simple   
/* 	function config()
	{

		$frontPage = array('page' => '{e_PLUGIN}creative_writer/cwriter.php', 'title' => CWRITER_A1);

		return $frontPage;
	} */ 


 
	// multiple
	function config()
	{
		$config = array();
    $url3 = e107::url('creative_writer','challenges');
		$config['title']    = CWRITER_A1;
		$config['page']     = array(  
						0   => array('page' => '{e_PLUGIN}creative_writer/cwriter.php', 'title'=>CWRITER_A1),
            1   => array('page' => '{e_PLUGIN}creative_writer/creative_writer.php', 'title'=>CWRITER_A78),
						2   => array('page' => $url3, 'title'=>LAN_CWRITER_A003),           
		);
         
		return $config;
	}  
 




}



?>