<?php
/**
 * @file
 * v2.x Standard  - Simple mod-rewrite module.
 */
if(!defined('e107_INIT'))
{
	exit;
}

/**
 * Class links_page_url.
 *
 * plugin-folder + '_url' 
 */
class links_page_url
{
	function config()
	{
  
		$config = array();


    $config['comment'] = array(
			// Matched against url, and if true, redirected to 'redirect' below.
			'regex'    => '^links_page/links/comment/(.*)$',
			// Used by e107::url(); to create a url from the db table.
			'sef'      => 'links_page/links/comment/{link_id}',
			// File-path of what to load when the regex returns true.
			'redirect' => '{e_PLUGIN}links_page/links.php?comment.$1'
		); 
 
    $config['catorder'] = array(
			// Matched against url, and if true, redirected to 'redirect' below.
			'regex'    => '^links_page/category/(.*)/(.*)/(.*)$',
			// Used by e107::url(); to create a url from the db table.
			'sef'      => 'links_page/category/{link_category_id}/{link_category_sef}',
			// File-path of what to load when the regex returns true.
			'redirect' => '{e_PLUGIN}links_page/links.php?cat.$1.$3'
		); 
    
    $config['category'] = array(
			// Matched against url, and if true, redirected to 'redirect' below.
			'regex'    => '^links_page/category/(.*)/(.*)$',
			// Used by e107::url(); to create a url from the db table.
			'sef'      => 'links_page/category/{link_category_id}/{link_category_sef}',
			// File-path of what to load when the regex returns true.
			'redirect' => '{e_PLUGIN}links_page/links.php?cat.$1'
		); 


    $config['submitted'] = array(
			// Matched against url, and if true, redirected to 'redirect' below.
			'regex'    => '^links_page/link-submitted$',
			// Used by e107::url(); to create a url from the db table.
			'sef'      => 'links_page/link-submitted',
			// File-path of what to load when the regex returns true.
			'redirect' => '{e_PLUGIN}links_page/links.php?s$1'
		);
    
    $config['submit'] = array(
			// Matched against url, and if true, redirected to 'redirect' below.
			'regex'    => '^links_page/links/submit$',
			// Used by e107::url(); to create a url from the db table.
			'sef'      => 'links_page/links/submit',
			// File-path of what to load when the regex returns true.
			'redirect' => '{e_PLUGIN}links_page/links.php?submit'
		);
    


    
    /* pages without ordering */
    $config['page2'] = array(
			// Matched against url, and if true, redirected to 'redirect' below.
			'regex'    => '^links_page/links/(.*)/(.*)$',
			// File-path of what to load when the regex returns true.
			'redirect' => '{e_PLUGIN}links_page/links.php?$1.$2'
		);
    

    $config['page1'] = array(
		// Matched against url, and if true, redirected to 'redirect' below.
		'regex'    => '^links_page/links/(.*)$',
		// Used by e107::url(); to create a url from the db table.   Not used
		// 'sef'      => 'links_page/links/orderaheading',
		// File-path of what to load when the regex returns true.
		'redirect' => '{e_PLUGIN}links_page/links.php?$1'
	 );                         
    $config['index'] = array(
		// Matched against url, and if true, redirected to 'redirect' below.
		'regex'    => '^links_page/links$',
		// Used by e107::url(); to create a url from the db table.
		'sef'      => 'links_page/links',
		// File-path of what to load when the regex returns true.
		'redirect' => '{e_PLUGIN}links_page/links.php'
	 );    

		$config['base'] = array(
			'sef'      => 'links_page/links/',
		);
		
		$config['rated'] = array(
			'sef'      => 'links_page/links/rated',
		);
    $config['top'] = array(
			'sef'      => 'links_page/links/top',
		);
    $config['alllinks'] = array(			// Used by e107::url(); to create a url from the db table.
			'sef'      => 'links_page/links/all',
		);   
    
    $config['allcats'] = array(			// Matched against url, and if true, redirected to 'redirect' below.
			'sef'      => 'links_page/links/cat',
		);    
    $config['manage'] = array(
			// Matched against url, and if true, redirected to 'redirect' below.
			'sef'      => 'links_page/links/manage',
		);


  return $config;
	}
}