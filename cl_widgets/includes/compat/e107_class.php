<?php
/*
+ ----------------------------------------------------------------------------+
|     e107 website system
|
|     Steve Dunstan 2001-2002
|     http://e107.org
|     jalist@e107.org
|
|     Released under the terms and conditions of the
|     GNU General Public License (http://gnu.org).
|
|     $Source: /cvsroot/e107/e107_0.8/e107_handlers/e107_class.php,v $
|     $Revision: 1.27 $
|     $Date: 2009/01/09 17:25:50 $
|     $Author: secretr $
+----------------------------------------------------------------------------+
*/

if (!defined('e107_INIT')) { exit; }

/**
 * Core e107 class
 *
 */
class e107c
{
	/**
	 *
	 * @var e107
	 */
	var $_instance = null;
	
	/**
	 *
	 * @var e_parse
	 */
	var $tp = null;
	
	/**
	 *
	 * @var db
	 */
	var $sql = null;
	
	/**
	 *
	 * @var ecache_c
	 */
	var $ecache = null;
	
	/**
	 *
	 * @var ArrayData
	 */
	var $arrayStorage = null;
	
	/**
	 *
	 * @var e107_event
	 */
	var $e_event = null;
	
	/**
	 *
	 * @var e107table
	 */
	var $ns = null;
	

	function e107c($check)
	{
		if($check !== 'e107_compat_class_php4_very_long_hard_to_remember_check')
			die('Fatal error! You are not allowed to direct instantinate an object for singleton class! Please use e107c::getInstance()');

		$this->bc_init();

		global $e107, $sql, $tp, $ns, $eArrayStorage, $e_event, $e107cache, $pref;

		$e107->sql = &$sql;

		$pref['syscachestatus'] = $pref['cachestatus'];
		require_once(CLW_COMPAT_PATH.'cache_handler.php');
		$e107->ecache = new ecache_c();
		$e107cache = &$e107->ecache;

		$e107->tp = &$tp;
		require_once(CLW_COMPAT_PATH.'shortcode_handler.php');
		$e107->tp->e_sc = new e_shortcode_c();


		$e107->ns = &$ns;
		$e107->arrayStorage = &$eArrayStorage;
		$e107->e_event = &$e_event;

		$this->_instance = &$e107;

	}

	/**
	 * Get e107 class instance - php4 singleton implementation
	 *
	 * @return e107c
	 */
	function &getInstance()
	{
		static $instance = array();

		if(!$instance)
		{
		   	$instance[0] = new e107c('e107_compat_class_php4_very_long_hard_to_remember_check');
		}
	  	return 	$instance[0]->_instance;
	}

	function bc_init() {
		global $DOWNLOADS_DIRECTORY, $ADMIN_DIRECTORY, $IMAGES_DIRECTORY, $THEMES_DIRECTORY, $PLUGINS_DIRECTORY,
		$FILES_DIRECTORY, $HANDLERS_DIRECTORY, $LANGUAGES_DIRECTORY, $HELP_DIRECTORY, $CACHE_DIRECTORY,
		$NEWSIMAGES_DIRECTORY, $CUSTIMAGES_DIRECTORY, $UPLOADS_DIRECTORY,$_E107;

		if($CACHE_DIRECTORY)
		{
           	define("e_CACHE", e_BASE.$CACHE_DIRECTORY);
		}
		else
		{
           	define("e_CACHE", e_BASE.$FILES_DIRECTORY."cache/");
		}

		if($NEWSIMAGES_DIRECTORY)
		{
           	define("e_NEWSIMAGE", e_BASE.$NEWSIMAGES_DIRECTORY);
		}
		else
		{
           	define("e_NEWSIMAGE", e_IMAGE."newspost_images/");
		}

		if($CUSTIMAGES_DIRECTORY)
		{
           	define("e_CUSTIMAGE", e_BASE.$CUSTIMAGES_DIRECTORY);
		}
		else
		{
           	define("e_CUSTIMAGE", e_IMAGE."custom/");
		}

		if ($DOWNLOADS_DIRECTORY{0} == "/")
		{
			define("e_DOWNLOAD", $DOWNLOADS_DIRECTORY);
		}
		else
		{
			define("e_DOWNLOAD", e_BASE.$DOWNLOADS_DIRECTORY);
		}

		if(!$UPLOADS_DIRECTORY)
		{
           	$UPLOADS_DIRECTORY = $FILES_DIRECTORY."public/";
		}

		if ($UPLOADS_DIRECTORY{0} == "/")
		{
			define("e_UPLOAD", $UPLOADS_DIRECTORY);
		}
		else
		{
			define("e_UPLOAD", e_BASE.$UPLOADS_DIRECTORY);
		}
	}
}
?>
