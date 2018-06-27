<?php
if (!defined('e107_INIT')) { exit; }

//$Id: widget.php 636 2009-07-15 11:33:57Z secretr $
define("CLW_APP", e_PLUGIN.'cl_widgets/');
define("CLW_APP_ABS", e_PLUGIN_ABS.'cl_widgets/');
define("CLW_WIDGETS", e_PLUGIN.'cl_widgets/widgets/');
define("CLW_WIDGETS_ABS", e_PLUGIN_ABS.'cl_widgets/widgets/');
define("CLW_WIDGETS_SC", '{e_PLUGIN}cl_widgets/widgets/');

define("CLW_HANDLER_PATH", CLW_APP.'includes/');
define("CLW_COMPAT_PATH", CLW_HANDLER_PATH.'compat/');
define("CLW_COMPAT_ABS", CLW_APP_ABS.'jslib/compat/');
define('CLW_COMPAT_IMAGES', CLW_APP_ABS."jslib/compat/images/");
define('CLW_COMPAT_IMAGES_REL', CLW_APP."jslib/compat/images/");

include_lan(CLW_APP.'languages/'.e_LANGUAGE.'/system.php');

class clw_widget {

    /**
     * Installed widgets (not implemented yet)
     *
     * @var array
     */
     var $_widgets = array();

    /**
     * Registry
     *
     * @var array
     */
    var $_registry = array();

    /**
     * Core js library
     *
     * @var array
     */
    var $_jslib = array();

    /**
     * Widgets js library
     *
     * @var array
     */
    var $_widgetlib = array();

    /**
     * External js library, loaded with jslib.php
     *
     * @var array
     */
    var $_lib_external = array();

    /**
     * External js library, loaded on runtime
     *
     * @var array
     */
    var $_lib_runtime = array();

    /**
     * External meta info, loaded on runtime
     *
     * @var array
     */
    var $_meta_runtime = array();

    /**
     * All cached js library
     *
     * @var array
     */
    var $_lib_all = array();

    /**
     * New registry entry
     *
     * @param string $key
     * @param mixed $value
     */
    function register($key, &$data)
    {
        $reg =& clw_widget::getInstance();
        $reg->_registry[$key] =& $data;

    }

    /**
     * Get registry entry
     *
     * @param string $key
     * @return mixed
     */
    function &registry($key)
    {
        $reg =& clw_widget::getInstance();

        if(array_key_exists($key, $reg->_registry))
            return $reg->_registry[$key];

        return null;
    }

    /**
     * Get singleton - php4 singleton implementation
     *
     * @return clw_widget
     */
    function &getInstance() {
        static $instance = array();

        if(!$instance) {
            $instance[0] =& new clw_widget;
            $instance[0]->_init();
        }
        return $instance[0];
    }

    /**
     * Singleton init method
     *
     * @return void
     */
    function _init() {
        $this->_jslib[] = 'prototype/prototype';
        $this->_jslib[] = 'scriptaculous/scriptaculous';
        $this->_jslib[] = 'scriptaculous/effects';
        if($this->getPref('cl_08compat', false)) {
        	$this->_jslib[] = 'compat/e10708';
        }
        $this->_lib_all = $this->_jslib;
    }
    
    /**
     * Check if we are currently in admin area
     *
     * @return boolean
     */
    function inAdmin()
    {
    	global $inAdminDir, $e107, $eplug_admin, $PLUGINS_DIRECTORY, $ADMIN_DIRECTORY;
    	if(defined('CLW_APP_INADMIN'))
    	{
    		return CLW_APP_INADMIN;
    	}
    	
    	if(!isset($inAdminDir))
    	{
    		//class2.php
	    	$inAdminDir = FALSE;
			$isPluginDir = strpos(e_SELF,'/'.$PLUGINS_DIRECTORY) !== FALSE;		// True if we're in a plugin
			$e107Path = str_replace($e107->base_path, "", e_SELF);				// Knock off the initial bits
			if	( 
					 (!$isPluginDir && strpos($e107Path, $ADMIN_DIRECTORY) === 0 ) 								// Core admin directory
				  || ($isPluginDir && (strpos(e_PAGE,"admin_") === 0 || strpos($e107Path, "admin/") !== FALSE)) // Plugin admin file or directory
				  || (varsettrue($eplug_admin))																	// Admin forced
				)
			{
			  $inAdminDir = TRUE;
			}
    	}
    	
    	define('CLW_APP_INADMIN', $inAdminDir);
    	return CLW_APP_INADMIN;
    }

    /**
     * Get installed widget array
     *
     * @param bool $keys if true array of type widget_name => widget_version else numerical array (widget names)
     * @return array widget list
     */
    function getInstalled($keys=false) {
    	global $pref;

		if(empty($pref['cl_widget_list']))
			return array();

    	return !$keys ? array_keys($pref['cl_widget_list']) : $pref['cl_widget_list'];
    }

    /**
     * Get All Core prefs
     *
     * @return array
     */
    function getPrefs() {
        global $pref;
        return  $pref;
    }

    /**
     * Get core pref by key
     *
     * @param string $name preference key
     * @param string $default default value
     * @return mixed preference value
     */
    function getPref($name='', $default = null) {
        global $pref;
        return  (isset($pref[$name]) ? $pref[$name] : $default);
    }

    /**
     * Centralized save preferences method
     * Should be always used - easy to manage future preferences & cache routine
     *
     */
    function savePrefs() {
    	global $pref;
    	//TODO - separate settings

    	//refresh cache LastModified - tricky cross-browser cache solution ;)
    	$pref['cl_widget_cachelm'] = time();
    	save_prefs();

    	clw_widget::clear_jslib_cache();
    }

    /**
     * Initialize widget
     *
     * @param string $name name of existing widget
     * @param bool $auto check widget's auto_init method, true when called from initAll()
     * @return clw_widget_abstract
     */
    function initWidget($name, $check_auto = false) {

        $cl_widget =& clw_widget::getInstance();

        if(!$cl_widget->isInstalled($name))
        	return false;

        if(($widget =& $cl_widget->getWidget($name)) && $widget !== null)
            return $widget;

        if(file_exists(CLW_WIDGETS.$name.'/'.$name.'_class.php')) {
            include_once(CLW_WIDGETS.$name.'/'.$name.'_class.php');

            $class_name = "clw_{$name}_class";
            if(!class_exists($class_name)) {
                //$cl_widget->setWidget($name, false);
                return false;
            }

            if($check_auto && !call_user_func(array($class_name, 'auto_init')))
            	return false;

            $widget = new $class_name();

            //check if extends the abstract widget class
            if(!is_subclass_of($widget, 'clw_widget_abstract')) {
                //$reg->setWidget($name, false);
                return false;
            }

            //core init
            $widget->_init($name);
            //widget specific init
            $widget->init();

            //FIXME - better, FAR MORE BETTER cache and cached lib structure
            //use core js lib
            $this->use_jslib($widget->use_jslib());
            //add new js lib
            $this->add_jslib($name, $widget->e_jslib());

            return $cl_widget->setWidget($name, $widget);
        }

        return false;
    }

    /**
     * Init all widgets, which allow auto initialization
     *
     * @return unknown
     */
    function initAll() {

        static $initialized = false;

        if($initialized) return $this;

        //initialize all installed
        $wlist = $this->getInstalled();

        foreach ($wlist as $widget) {

        	$this->initWidget($widget, true);
        }

        $initialized = true;
        return $this;
    }

    /**
     * Register widget
     *
     * @param string $name name of existing widget
     * @param mixed $data widget data
     * @return widget object
     */
    function setWidget($name, $data) {

        if(!$this->checkWidget($name)) {
            $this->_widgets[$name] = $data;
        }

        return $this->getWidget($name);
    }

    /**
     * Get widget
     *
     * @param string $name name of existing widget
     * @return widget object
     */
    function getWidget($name) {

        if($this->checkWidget($name))
            return $this->_widgets[$name];

        return null;
    }

    /**
     * Get all installed widget
     *
     * @param string $name name of existing widget
     * @return widget object
     */
    function getWidgets() {

        $this->initAll();
        return $this->_widgets;

    }

    /**
     * Check if the widget is installed
     *
     * @param string $name name of the widget
     * @return bool
     */
    function isInstalled($name) {
    	return in_array($name, clw_widget::getInstalled());
    }


    /**
     * Check if the widget is registered
     *
     * @param string $name name of existing widget
     * @return mixed
     */
    function checkWidget($name) {
        return array_key_exists($name, $this->_widgets);
    }

    /**
     * Remove widget from the registry
     *
     * @param string $name name of existing widget
     * @return bool
     */
    function unregisterWidget($name) {
        if($this->checkWidget($name)) {
            unset($this->_widgets[$name]);
            return true;
        }

        return false;
    }


    /**
     * Run widget's shortcode
     *
     * @param string $name name of existing widget
     * @param string $sc shortcode name
     * @param array shortcode parameter array
     * @return string
     */
    function run_sc($name, $sc, $parms = array()) {
        if(!($widget =& clw_widget::initWidget($name))) {

            return '';
        }

        //future implementation!
        $ret = $widget->prepare_sc($sc, $parms);
        $ret .= $widget->run_sc($sc, $parms);
        $ret .= $widget->finish_sc($sc, $parms);
        return $ret;

    }

    /**
     * Run widget's bbCode
     *
     * @param string $name name of existing widget
     * @param string bbcode name of bbcode being called
     * @param string $text bbcode text
     * @param string $parms bbcode parameter string
     * @return string
     */
    function run_bb($name, $bbcode, $text = '', $parms = '') {

        if(!($widget =& clw_widget::initWidget($name))) {
            return '';
        }

        return $widget->run_bb($bbcode, $text, $parms);
    }


    /**
     * Run e_meta for all installed widgets
     *
     * @param string $type 'default' | 'pre_lib'
     * @return string
     */
    function run_meta() {

        if(!($installed =& $this->getWidgets()))
            return false;

        $ret['pre_lib'] = '';
        $ret['default'] = '';
        foreach ($installed as $name=>$widget) {
            /* FIXME - cache it */

            if($tmp = $widget->e_meta('pre_lib')) {
                $ret['pre_lib'] .= "
                    <!-- CL Widgets - init $name -->
                    $tmp
                ";

            }

            if($tmp = $widget->e_meta('default')) {
                $ret['default'] .= "
                    <!-- CL Widgets - $name -->
                    $tmp
                ";
            }
        }

        return $ret;
    }

    /**
     * Gather all available widget's js (DEPRECATED - not needed anymore)
     * It'll be changed to $consolidate true|false
     *
     * @param bool $out print it our
     * @return void
     */
    function run_jslib($out = true) {
		/*
			DEPRECATED
		*/
        if($out)
            $this->echo_jslib();
    }

    /**
     * Output all required js libs
     *
     */
    function echo_jslib() {

        foreach ($this->_jslib as $core_jslib) {
            $f = CLW_APP.'jslib/'.$core_jslib.'.js';
            if(file_exists($f.'.php')) {
                include($f.'.php');
                echo "\n\n";
            } elseif($tmp = file_get_contents($f)) {
                echo $tmp."\n\n";
                //echo $f.'<br />';
            }
        }

        foreach ($this->_widgetlib as $w => $libs) {
        	foreach ($libs as $lib) {
                $f = CLW_WIDGETS.$w.'/jslib/'.$lib.'.js';
                if(file_exists($f.'.php')) {
                	echo "//".$lib."\n";
                    include($f.'.php');
                    echo "\n\n";
                } elseif($tmp = file_get_contents($f)) {
                	echo "//".$lib."\n";
                    echo $tmp."\n\n";
                    //echo $f.'<br />';
                }
            }
        }

        foreach ($this->_lib_external as $path => $libs) {
        	foreach ($libs as $lib) {
                $f = $path.$lib.'.js';
                if(file_exists($f.'.php')) {
                	echo "//".$lib."\n";
                    include($f.'.php');
                    echo "\n\n";
                } elseif($tmp = file_get_contents($f)) {
                	echo "//".$lib."\n";
                    echo $tmp."\n\n";
                    //echo $f.'<br />';
                }
            }
            unset($this->_lib_external[$path]);
        }
    }

    /**
     * Delete jslib cache
     *
     */
    function clear_jslib_cache() {
		global $fl;
		if(!varset($fl)) {
			require_once(e_HANDLER.'file_class.php');
			$fl = new e_file();
		}
		$files = $fl->get_files(CLW_APP.'cache/');

		foreach ($files as $file) {
			unlink(CLW_APP.'cache/'.$file['fname']);
		}

    }

    /**
     * Require core js library
     *
     * @param array $lib_arr required libraries
     * @return object cl_widget
     */
    function use_jslib($lib_arr) {
        
        if(!$lib_arr) return $this;
        
        $core_array = array(
            'prototype/prototype',
            'scriptaculous/scriptaculous',
        	'scriptaculous/effects',
        	'scriptaculous/builder',
        	'scriptaculous/controls',
        	'scriptaculous/dragdrop',
        	'scriptaculous/slider',
        	'scriptaculous/sound',
        	'scriptaculous/unittest',
        	'compat/e10708',
            'compat/core/admin',
            'compat/core/debug',
            'compat/core/decorate',
            'compat/core/tabs',
            'compat/core/tooltip'
        );

        foreach ($lib_arr as $f) {
	        if(in_array($f, $core_array) && !in_array($f, $this->_lib_all)) {
	            $this->_jslib[] = $f;
	            $this->_lib_all[] = $f;
	        }
        }

        return $this;
    }

    /**
     * Add js library to the library list
     *
     * @param string $name
     * @param array $lib_arr file array
     * @param string $where not implemented yet
     * @return object cl_widget
     */
    function add_jslib($name, $lib_arr/*9, $where=''*/) {
        //TODO = optional $where to add it? (before | after -> widget name)
        if(!$name || !$lib_arr) return $this;

        foreach ($lib_arr as $f) {
			
            if(!in_array($f, $this->_lib_all)) {
                $this->_widgetlib[$name][] = $f;
                $this->_lib_all[] = $f;
            }
        }

        return $this;
    }

    /**
     * Add external js library to the library list
     * NEW - v1.1
     *
     * @param string $path
     * @param array $lib_arr file array
     * @param string $where not implemented yet
     * @return object cl_widget
     */
    function external_jslib($path, $lib_arr, $where='') {
        //TODO = optional $where to add it? (before | after -> widget name)
        if(!$path || !$lib_arr) return $this;

        foreach ($lib_arr as $f) {
        	if(!in_array($f, $this->_lib_all)) {
		        $this->_lib_external[$path][] = $f;
		        $this->_lib_all[] = $f;
        	}
        }

        return $this;
    }

    /**
     * Add js to the runtime list
     * NEW - v1.1
     *
     * @param string $path
     * @param array $lib_arr file array
     * @param string $where not implemented yet
     * @return object cl_widget
     */
    function runtime_js($path, $lib_arr, $where='') {
        //TODO = optional $where to add it? (before | after -> widget name)
        if(!$path || !$lib_arr) return $this;
		
        foreach ($lib_arr as $f) {
        	if(!in_array($f, $this->_lib_all)) {
		        $this->_lib_runtime[$path][] = $f;
		        $this->_lib_all[] = $f;
        	}
        }

        return $this;
    }

    /**
     * Add js to the meta runtime list
     * NEW - v1.1
     *
     * @param string $file_id id used previously with some of the include_* methods or empty to be appended on e_meta end
     * @param string $src the content to be sent
     * @param string $where pre|post
     * @return object cl_widget
     */
    function runtime_meta($file_id, $src, $where='pre') {

    	if($file_id)
       		$this->_meta_runtime[$file_id][$where][] = $src;
       	else
       		$this->_meta_runtime['e_meta_end'][] = $src;

        return $this;
    }

    /**
     * Include JS located in the core jslib folder
     * NEW - v1.1
     *
     * @param string $file_ids file ids
     * @param bool $jslib if true scripts will be added to jslib consolidation script, $now and $output values will be discarded
     * @param bool $now true - parse it now, false - parse it later (e_meta) - prefered way!
     * @param bool $output used only when $now is true
     * @return string|array
     */
    function include_corejs($file_ids, $jslib = true, $now = false, $output = false) {
    	$this->loadJS($file_ids, 'core', '', $jslib);
    	if(!$jslib && $now) return $this->render_runtime_js($output);
    	return '';
    }

    /**
     * Include JS located in the currently available widgets folder
     * NEW - v1.1
     *
     * @param string $file_ids file ids
     * @param string $widget_id
     * @param bool $jslib if true scripts will be added to jslib consolidation script, $now and $output values will be discarded
     * @param bool $now true - parse it now, false - parse it later (e_meta) - prefered way!
     * @param bool $output used only when $now is true
     * @return string|array
     */
    function include_widgetjs($file_ids, $widget_id, $jslib = true, $now = false, $output = false) {
    	$this->loadJS($file_ids, 'widget', $widget_id, $jslib);
    	if(!$jslib && $now) return $this->render_runtime_js($output);
    	return '';
    }

    /**
     * Include JS located in the current theme folder
     * NEW - v1.1
     *
     * @param string $file_ids file ids
     * @param bool $jslib if true scripts will be added to jslib consolidation script, $now and $output values will be discarded
     * @param bool $now true - parse it now, false - parse it later (e_meta) - prefered way!
     * @param bool $output used only when $now is true
     * @return string|array
     */
    function include_themejs($file_ids, $jslib = true, $now = false, $output = false) {
    	$this->loadJS($file_ids, 'theme', '', $jslib);
    	if(!$jslib && $now) return $this->render_runtime_js($output);
    	return '';
    }

    /**
     * Include JS located in plugin folder
     * NEW - v1.1
     *
     * @param string $file_ids file ids
     * @param string $plugname plugin name
     * @param bool $jslib if true scripts will be added to jslib consolidation script, $now and $output values will be discarded
     * @param bool $now true - parse it now, false - parse it later (e_meta) - prefered way!
     * @param bool $output used only when $now is true
     * @return string|array
     */
    function include_pluginjs($file_ids, $plugname, $jslib = true, $now = false, $output = false) {
    	$this->loadJS($file_ids, 'plugin', $plugname, $jslib);
    	if(!$jslib && $now) return $this->render_runtime_js($output);
    	return '';
    }

    /**
     * Include JS located on provided path
     * NEW - v1.1
     *
     * @param string $file_ids file ids
     * @param bool $jslib if true scripts will be added to jslib consolidation script, $now and $output values will be discarded
     * @param string $path
     * @param bool $now true - parse it now, false - parse it later (e_meta) - prefered way!
     * @param bool $output used only when $now is true
     * @return string|array
     */
    function include_js($file_ids, $path, $jslib = true, $now = false, $output = false) {
    	$this->loadJS($file_ids, $path, '', $jslib);
    	if(!$jslib && $now) return $this->render_runtime_js($output);
    	return '';
    }

    /**
     * Load JS based on it's type
     * NEW - v1.1
     *
     * @param string|array $file_ids file ids
     * @param string $type script type (location)
     * @param string $name optional widget or plugin ID, used only when type is 'widget' or 'plugin'2
     * @param bool $jslib true - include via jslib.php, false - add to runtime stack
     * @return object cl_widget
     */
    function loadJS($file_ids, $type = '', $name = '', $jslib = false) {
		global $tp;
		
		if(is_string($file_ids)) $ids = explode(',', $file_ids);
		
  		foreach ($ids as $k => $id)
		{
			if(in_array($id, $this->_lib_all)) unset($ids[$k]);
		}

		if(empty($ids)) return $this;
		
		switch ($type) {
			case 'core':
				if($jslib) { $this->use_jslib($ids); break; }
				$this->runtime_js(CLW_APP_ABS.'jslib/', $ids);
			break;

			case 'widget': 
				if($jslib) { $this->add_jslib($name, $ids); break; }
				$this->runtime_js(CLW_WIDGETS_ABS.$name.'/jslib/', $ids);
			break;

			case 'theme':
				if($jslib) { $this->external_jslib(THEME.'jslib/', $ids); break; }
				$this->runtime_js(THEME_ABS.'jslib/', $ids);
			break;

			case 'plugin':
				if($jslib) { $this->external_jslib(e_PLUGIN.$name.'/jslib/', $ids); break; }
				$this->runtime_js(e_PLUGIN_ABS.$name.'/jslib/', $ids);
			break;

			default:
				if($jslib) { $this->external_jslib($tp->replaceConstants($type, ''), $ids); break; }
				$this->runtime_js($tp->replaceConstants($type, 'full'), $ids);
			break;
		}

		return $this;
    }

    /**
	 * Load JS on runtime via <script> tag, prevent duplicating scripts
	 * NEW - v1.1
	 *
	 * @param bool|path $output if false - return full path, if true output the whole <script src> block, if 'path' return array of absolute script paths
	 * @return string result
	 */
    function render_runtime_js($output = true) {

		$ret = array();
		$ret_str = '';
		
		foreach ($this->_lib_runtime as $path => $files)
		{
			foreach ($files as $file)
			{
				$p = is_readable($path.$file.'.js.php') ? $path.$file.'.js.php' : $path.$file.'.js';
				$ret[] = $p;
				
				$ret_str .= $this->render_runtime_meta($file, 'pre', false); //meta pre
				$ret_str .= "\n<script type='text/javascript' src='{$p}'></script>\n";
				$ret_str .= $this->render_runtime_meta($file, 'post', false)."\n"; // meta post
			}

			unset($this->_lib_runtime[$path]);
		}

		if($output === 'path') return $ret;
		elseif(!$output) return $ret_str;

		echo $ret_str;
    }

    function render_runtime_meta($id = '', $type='pre', $output = true) {
    	if(!$id && isset($this->_meta_runtime['e_meta_end'])) {
    		$tmp = implode("\n\n", $this->_meta_runtime['e_meta_end']);
    		$this->_meta_runtime['e_meta_end'] = array();
	    	if(!$output) {
	    		return $tmp;
	    	}
	    	echo $tmp;
	    	return '';
    	}

    	$tmp = implode("\n\n", varset($this->_meta_runtime[$id][$type], array()));
		unset($this->_meta_runtime[$id][$type]);

    	if(!$output)
    		return $tmp;

    	echo $tmp;
		return '';
    }

    /**
     * Run e_module for all installed widgets
     *
     * @return bool
     */
    function run_module() {

        if(!($installed = $this->getWidgets()))
            return false;

        foreach ($installed as $widget) 
        {
            $widget->e_module();
        }

        return true;
    }

    /**
     * Run e_bb for all installed widgets
     *
     * @return string
     */
    function run_e_bb() {
    /* FIXME - cache it */

        if(!($installed =& $this->getWidgets()))
            return false;

        $ret = array();
        foreach ($installed as $widget) 
        {
            if($tmp = $widget->e_bb())
                $ret = array_merge($ret, $tmp);
        }

        return $ret;
    }

    /**
     * Load e107 v.0.8 Environment
     * NEW - v1.0.2
     *
     * @param object $e107obj instance of e107 class
     */
    function loadCompatEnv() {
    	global $e107;
    	static $loaded = false;
		if(!$this->getPref('cl_08compat') || $loaded) return false;

		/* e107c::getInstance() will be available site wide */
		require_once(CLW_COMPAT_PATH.'e107_class.php');
		$e107 = &e107c::getInstance();
				
		register_shortcode('iconpicker_shortcode', 'iconpicker', CLW_COMPAT_PATH.'shortcodes/');
		register_shortcode('imagepicker_shortcode', 'imagepicker', CLW_COMPAT_PATH.'shortcodes/');
		register_shortcode('uploadfile_shortcode', 'uploadfile', CLW_COMPAT_PATH.'shortcodes/');
		
		$loaded = true;
		return true;
    }
}

class clw_widget_abstract
{
    var $_widget = '';
    var $_template = array();

    //protected
    function _init($name) {
        global $tp;
        $this->_widget = $name;
        define('CLW_HTTP_'.strtoupper($name), $tp->replaceConstants(CLW_WIDGETS_SC, 'full').$name.'/');
        define('CLW_ABS_'.strtoupper($name), CLW_WIDGETS_ABS.$name.'/');
        define('CLW_REL_'.strtoupper($name), CLW_WIDGETS.$name.'/');
		define('CLW_SC_'.strtoupper($name), CLW_WIDGETS_SC.$name.'/');
    }

    function getName() {
        return $this->_widget;
    }

    function init() {

    }

    function use_jslib() {

    }

    function e_jslib() {

    }

    function e_meta($type='default') {

    }

    function e_module() {

    }

    function e_bb() {

    }

    function getTemplate($tmpl_name='', $key = '', $force=false) {

        if(!$tmpl_name)
            $tmpl_name = $this->getName();
          else 
           	$tmpl_name = trim(preg_replace('#[^\w\/]#', '', $tmpl_name), '/');

		$tmpl_name .= '_tmpl.php';
		
        if(!$force && array_key_exists($tmpl_name, $this->_template))
        {
			if($key && is_array($this->_template[$tmpl_name]))
	        {
	        	return varset($this->_template[$tmpl_name][$key]);
	        }
            return $this->_template[$tmpl_name];
        }
        
        $widget_tmpl = array();

		//theme templates
		$path = THEME.'cl_widgets/'.$this->getName().'/';

		$WIDGET_TMPL = array();
        if(file_exists($path.$tmpl_name)) {
            include($path.$tmpl_name);
        } else {
	        $path = CLW_WIDGETS.$this->getName().'/templates/';
	        
	        if(file_exists($path.$tmpl_name)) {
	            include($path.$tmpl_name);
	        }
        }

        if(empty($WIDGET_TMPL))
        	return '';

        $this->_template[$tmpl_name] = $WIDGET_TMPL;

        if($key && is_array($this->_template[$tmpl_name]))
        {
        	return varset($this->_template[$tmpl_name][$key]);
        }

        return $this->_template[$tmpl_name];

    }

    function getPrefs() {
        global $pref;

        $id = $this->getName();

        return  (isset($pref['cl_widget_prefs'][$id]) ? $pref['cl_widget_prefs'][$id] : null);
    }

    function getPref($name = '', $default = null) {
        global $pref;

        if(!$name) return null;

        $id = $this->getName();

        return  (isset($pref['cl_widget_prefs'][$id][$name]) ? $pref['cl_widget_prefs'][$id][$name] : $default);
    }
    
    function addPref($name, $data)
    {
    	global $pref;
    	$id = $this->getName();
    	$pref['cl_widget_prefs'][$id][$name] = $data;
    	return $this;
    }
    
    function setPrefs($data)
    {
    	global $pref;
    	$id = $this->getName();
    	if(is_array($data))
    	{
    		$pref['cl_widget_prefs'][$id] = $data;
    	}
    	return $this;
    }

    function savePrefs($widget_prefs) {
        global $pref;

        $id = $this->getName();
        $pref['cl_widget_prefs'][$id] = $widget_prefs;

        clw_widget::savePrefs();
    }

    function prepare_sc($name, $parms = array()) {

    }

    function finish_sc($name, $parms = array()) {

    }

    function run_sc($name, $parms = array()) {

    }

    function run_bb($name, $text='', $parms ='') {

    }

    /**
     * Return false to prevent e_module auto-initialization 
     * of the widget
     *
     * @return boolean
     * @access public static
     */
    function auto_init() 
    {
    	return true;
    }
    
    /**
     * This method is called on widget plugin
     * settings change - false will prevent disable of
     * 0.8 compatibility preference
     *
     * @return boolean
     */
    function allow_compat_disable()
    {
    	return true;
    }
}

?>