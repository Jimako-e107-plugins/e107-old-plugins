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
 
/*
/e107_plugins/tagcloud/tagcloud.php
/e107_plugins/tagcloud/tagcloud.php?welcome
Prefs:
tags_seolink   = alias   tags-
tags_fileext   .html
tags_tagspace  _

TODO: replace prefs 
*/
		
class tagcloud_url
{
	var $seolink = '';

	function __construct() {
	 $plugPrefs = e107::getPlugConfig('tagcloud')->getPref();
 
	 $this->seolink =  $plugPrefs['tags_seolink'];
	 $this->fileext =  $plugPrefs['tags_fileext'];
	}
	
	function config()
	{
  
		$config = array();
 
    //if you use {alias}, it can be changed in core URL configuration, now it's in prefs, so let this way
    
    $config['tag'] = array(
    'alias'         => $this->seolink,
//		'regex'    => '^{alias}(.*)'.$this->fileext.'$',
		'regex'    => '^'.$this->seolink.'(.*)'.$this->fileext.'$',
//		'sef'      => '{alias}{tagcloud_key}'.$this->fileext ,
    'sef'      =>  $this->seolink.'{tagcloud_key}'.$this->fileext ,
		'redirect' => '{e_PLUGIN}tagcloud/tagcloud.php?$1' 
	 );   
 
    $config['tagcloud'] = array(
    'alias'         => 'tagcloud',
		'regex'    => '^{alias}\/?$',
		'sef'      => '{alias}',
		'redirect' => '{e_PLUGIN}tagcloud/tagcloud.php'
	 ); 
   
  return $config;
  
	}
}