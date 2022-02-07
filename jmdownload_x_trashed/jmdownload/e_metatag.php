<?php

/**
 * @file
 * Metatag addon file.
 */


/**
 * Class metatag_metatag.
 *
 * Usage: PLUGIN_metatag
 */
class jmdownload_metatag
{

 
	/**
	 * Alter config before caching takes place.
	 *
	 * @param $config
	 */
	public function config_alter(&$config)
	{
       $config['download']['tab']  = true;
       
       return $config;
	}

}
