<?php
/*
 * e107 Bootstrap CMS
 *
 * Copyright (C) 2008-2015 e107 Inc (e107.org)
 * Released under the terms and conditions of the
 * GNU General Public License (http://www.gnu.org/licenses/gpl.txt)
 * 
 * IMPORTANT: Make sure the redirect script uses the following code to load class2.php: 
 * 
 * 	if (!defined('e107_INIT'))
 * 	{
 * 		require_once("../../class2.php");
 * 	}
 * 
 */
 
if (!defined('e107_INIT')) { exit; }

// v2.x Standard  - Simple mod-rewrite module. 

class creative_writer_url // plugin-folder + '_url'
{
	function config() 
	{
		$config = array();

		$config['challenge'] = array(
			'alias'         => 'creative_writer',
			'regex'			=> '^{alias}/challenge/(\d*)$',
			'sef'			=> 'creative_writer/challenge/{cw_challenge_id}',			// {faq_info_sef} is substituted with database value when parsed by e107::url();
			'redirect'		=> '{e_PLUGIN}creative_writer/challenges.php?challenge_id=$1'
		);
 
 
		$config['challenges'] = array(
			'alias'         => 'creative_writer',
			'regex'			=> '^{alias}/challenges/?', 						// matched against url, and if true, redirected to 'redirect' below.
			'sef'			=> '{alias}/challenges', 							// used by e107::url(); to create a url from the db table.
			'redirect'		=> '{e_PLUGIN}creative_writer/challenges.php?p=$1', 		// file-path of what to load when the regex returns true.

		);
		
		$config['chapter'] = array(
			'alias'         => 'creative_writer',
			'regex'			=> '^{alias}/chapter/(\d*)/(\d*)$',
			'sef'			=> 'creative_writer/chapter/{cw_book_id}/{cw_chapter_id}',			// {faq_info_sef} is substituted with database value when parsed by e107::url();
			'redirect'		=> '{e_PLUGIN}creative_writer/chapters.php?book_id=$1&chapter_id=$2'
		);
 
 
		$config['chapters'] = array(
			'alias'         => 'creative_writer',
			'regex'			=> '^{alias}/chapters/?', 						// matched against url, and if true, redirected to 'redirect' below.
			'sef'			=> '{alias}/chapters', 							// used by e107::url(); to create a url from the db table.
			'redirect'		=> '{e_PLUGIN}creative_writer/chapters.php?p=$1', 		// file-path of what to load when the regex returns true.

		);		

		$config['book'] = array(
			'alias'         => 'creative_writer',
			'regex'			=> '^{alias}/book/(\d*)$',
			'sef'			=> 'creative_writer/book/{cw_book_id}',			// {faq_info_sef} is substituted with database value when parsed by e107::url();
			'redirect'		=> '{e_PLUGIN}creative_writer/books.php?book_id=$1'
		);    
    
		$config['creative_writer'] = array(
			'alias'         => 'creative_writer',
			'regex'			=> '^{alias}/books/?', 						// matched against url, and if true, redirected to 'redirect' below.
			'sef'			=> '{alias}/books', 							// used by e107::url(); to create a url from the db table.
			'redirect'		=> '{e_PLUGIN}creative_writer/cwriter.php?p=$1', 		// file-path of what to load when the regex returns true.

		);
		
 
		$config['mybooks-index'] = array(
			'alias'         => 'creative_writer',
			'regex'					=> '^{alias}/mybooks\/?',
			'sef'						=> 'creative_writer/mybooks/',			 
			'redirect'		  => '{e_PLUGIN}creative_writer/mybooks.php'
		);
  
		return $config;
	}
	

	
}