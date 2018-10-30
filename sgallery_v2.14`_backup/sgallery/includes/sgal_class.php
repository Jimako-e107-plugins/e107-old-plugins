<?php
/*
+ ----------------------------------------------------------------------------------------------------+
|        e107 website system 
|        Gallery Class: e107_plugins/sgallery/includes/sgal_admin_class.php
|        Email: m.yovchev@clabteam.com
|        $Revision: 739 $
|        $Date: 2008-04-22 14:03:31 +0300 (Tue, 22 Apr 2008) $
|        $Author: secretr $
|	     Copyright Corllete Lab ( http://www.clabteam.com ) under GNU GPL License (http://gnu.org)
|        Free Support: http://dev.e107bg.org/
+----------------------------------------------------------------------------------------------------+
*/
if (!defined('e107_INIT')) { exit; }

class clgallery {
    var $_modules = array();
    var $_prefs = array();
    var $_external_prefs = array();
    var $external_CacheTag = false;
    /*
    * @descr Default plugin settings
    * @access private    
    */
    function _DefPrefs(){
        $galpref = array(
            "sgal_restrict_size" => '0',
    		"sgal_restrict_w" => '640',
    		"sgal_restrict_h" => '480',
    		"sgal_allow_uresize" => '1',
    		"sgal_allow_cropresize" => '0',
    		"sgal_allow_autoresize" => '1',
    		"sgal_upload_publishxp" => e_UC_MEMBER, //users who can use XP publishing wizard (photos upload)
    		"sgal_bballow_external" => '0', //enable/disable XP publishing wizard (photos upload)
    		"sgal_album_comments" => e_UC_MEMBER, //users who can post album comments
    		"sgal_album_rating" => e_UC_MEMBER, //users who can give album ratings
    		"sgal_latest" => e_UC_PUBLIC, //latest pictures view perms
    		"sgal_w" => '640',
    		"sgal_h" => '480',
    		"sgal_thumb_create" => '0',//not used yet
    		"sgal_far" => '0',
    		"sgal_bg" => 'FFFFFF',
    		"sgal_watermark" => '', //new - 2.0 RC5 - watermark image name
    		"sgal_watermark_pos" => '0', //new - 2.0 RC5 - image position
    		"sgal_watermark_op" => '75', //new - 2.0 RC5 - image opacity
    		"sgal_watermark_x" => '0', //new - 2.0 RC5 - image x px
    		"sgal_watermark_y" => '0', //new - 2.0 RC5 - image y px
    		"sgal_admin_albums" => '10',
    		"sgal_tblrender" => '1',
    		"sgal_galperrow" => '4',
    		"sgal_thgal_w" => '120',
    		"sgal_thgal_h" => '90',
    		"sgal_albumperrow" => '3',
    		"sgal_albumperpage" => '9',
    		"sgal_thalbum_w" => '120',
    		"sgal_thalbum_h" => '90',
    		"sgal_picperrow" => '4',
    		"sgal_picperpage" => '12',
    		"sgal_picperrow_latest" => '3',
    		"sgal_picperpage_latest" => '12',
    		"sgal_thumb_w" => '120',
    		"sgal_thumb_h" => '90',
    		"sgal_pagenum" => '5',
    		"sgal_usermod_allow" => e_UC_MEMBER, //users who can use user albums module
    		"sgal_usermod_visible" => e_UC_MEMBER, //users who can see user albums
    		"sgal_usermod_albumcreate" => e_UC_MEMBER, // users who can create his own new albums
    		"sgal_usermod_galleries" => e_UC_MEMBER, // users who can assign gallery category to their albums
    		"sgal_usermod_albumcreate_approve" => '1', // Created User album admin approval
    		"sgal_usermod_picapprove" => '1', // User picture upload admin approval
    		"sgal_usermod_rmethods" => 'autoresize,uresize', // resize methods available in user album manager
    		"sgal_usermod_urestrict" => '1', // restrict resize to sgal_usermod_urestrict_w & sgal_usermod_urestrict_h in user album manager
    		"sgal_usermod_urestrict_w" => '640', // restrict resize width in user album manager
    		"sgal_usermod_urestrict_h" => '480', // restrict resize height in user album manager
    		"sgal_usermod_albumcount" => '1', // number of albums allowed | 0 - unlimited
    		"sgal_usermod_piccount" => '10', // number of pics per album allowed | 0 - unlimited
    		"sgal_usermod_albumsize" => '1048576', // total file size per album allowed (bytes) | 0 - unlimited
    		"sgal_usermod_totalsize" => '1048576', // total file size per user allowed (bytes) | 0 - unlimited
    		"sgal_rand_multinum" => '3',
    		"sgal_galrand_multinum" => '2',	
            "sgal_picorder" => 'desc',
            "sgal_picorder_type" => 'ftime',
    		"sgalsys_suspicious_check" => '0'
    	);
        return $galpref;
    }
    
    /*
    * @descr set external settings property
    * @$extprefs array - external prefs override array   
    * @$_external_prefs array    
    * @access public    
    */
    function setExtConfig($extprefs=array(), $extCacheTag='SgalleryExtPrefs') {
        $this->_external_CacheTag = $extCacheTag;
        $this->_external_prefs = array_merge($this->getPref(), $extprefs);
        $this->_prefs = $this->_external_prefs;
        return $this->_external_prefs;
    }
    
    /*
    * @descr get external settings property
    * @$_external_prefs array    
    * @access public    
    */
    function getExtConfig() {
        return $this->_external_prefs;
    }
    
    /*
    * @descr clear external stuff
    * @access public    
    */
    function removeExtConfig() {
        global $e107cache;
        $this->_external_prefs = array();
        $this->_prefs = array();
        if($this->_external_CacheTag) $e107cache->clear($this->_external_CacheTag);
        $this->_external_CacheTag = false;
        $this->_prefs = getPref();//reload
    }
    
    /*
    * @descr default resize configuration array
    * @access public    
    */
    function defThconfig($strict=false) {
        $defpref = $this->_DefPrefs();
        //use external settings if present
        $gal_pref = $this->getExtConfig() ? $this->getExtConfig() : $this->getPref();
        $THCONFIG_DEF['q'] = 80;
        if($gal_pref['sgal_restrict_size']){
            $THCONFIG_DEF['far'] = $gal_pref['sgal_far'] ? $gal_pref['sgal_far'] : 'C'; //Force Aspect Ratio
            $THCONFIG_DEF['w'] = $gal_pref['sgal_restrict_w'] ? $gal_pref['sgal_restrict_w'] : $defpref['sgal_restrict_w']; //width
            $THCONFIG_DEF['h'] = $gal_pref['sgal_restrict_h'] ? $gal_pref['sgal_restrict_h'] : $defpref['sgal_restrict_h']; //height
        } elseif($gal_pref['sgal_allow_autoresize']){
            if($gal_pref['sgal_far'] || $strict) {
                $THCONFIG_DEF['far'] = $gal_pref['sgal_far']; //Force Aspect Ratio
                $THCONFIG_DEF['w'] = $gal_pref['sgal_w']; //width
                $THCONFIG_DEF['h'] = $gal_pref['sgal_h']; //height
            } else {
                $THCONFIG_DEF['wp'] = $gal_pref['sgal_h']; //max width - portrait
                $THCONFIG_DEF['wl'] = $gal_pref['sgal_w']; //max width - landscape
                $THCONFIG_DEF['hp'] = $gal_pref['sgal_w']; //max height - portrait
                $THCONFIG_DEF['hl'] = $gal_pref['sgal_h']; //max height - landscape
            }
        }
        $THCONFIG_DEF['iar'] = 0; //to do - pref ??? - Ignore Aspect Ratio
        $THCONFIG_DEF['bg'] = $gal_pref['sgal_bg']; //backgrounf color
        /*$THCONFIG_DEF['fltr'][] = 'bord|1|0|0|666666'; //to do - border width|x-radius|y-radius|color*/
        
        //watermark image
        $tmp = array();
        if(isset($cfgarr['wmi'])) {
            $tmp['f'] = varsettrue($cfgarr['wmi']['f'], $gal_pref['sgal_watermark']);
            $tmp['a'] = varsettrue($cfgarr['wmi']['a'], $gal_pref['sgal_watermark_pos']);
            $tmp['o'] = varsettrue($cfgarr['wmi']['o'], $gal_pref['sgal_watermark_op']);
            $tmp['x'] = varsettrue($cfgarr['wmi']['x'], $gal_pref['sgal_watermark_x']);
            $tmp['y'] = varsettrue($cfgarr['wmi']['y'], $gal_pref['sgal_watermark_y']);
        } else {
            $tmp['f'] = $gal_pref['sgal_watermark'];
            $tmp['a'] = $gal_pref['sgal_watermark_pos'];
            $tmp['o'] = $gal_pref['sgal_watermark_op'];
            $tmp['x'] = $gal_pref['sgal_watermark_x']; 
            $tmp['y'] = $gal_pref['sgal_watermark_y']; 
        }
        
        if(is_readable(SGAL_IMAGES.'watermark/'.$tmp['f'])) 
            $tmp['f'] = SGAL_IMAGES.'watermark/'.$tmp['f']; //use default dir if no path provided in the cfgarr
            
        if($tmp['f'] && $tmp['a']) {
            $THCONFIG_DEF['fltr'] = array( "wmi|{$tmp['f']}|{$tmp['a']}|{$tmp['o']}|{$tmp['x']}|{$tmp['y']}" );
        }
        
        //print_a($THCONFIG_DEF); exit;
        return $THCONFIG_DEF;
    }
    
    /*
    * @descr Get plugin settings
    * @access public    
    */
    function getPref($force=false){
        global $sql, $e107cache, $eArrayStorage;
        
        $sgal_extpref = false;
        if($this->_prefs && !$force) return $this->_prefs;
        //cache
        $CacheTag = $this->_external_CacheTag ? 'nomd5_'.$this->_external_CacheTag : 'nomd5_SgalleryPrefs';
        $cpref = !$force ? $e107cache->retrieve($CacheTag, 24 * 60, true) : false;
        if(!$cpref) { //no cache
            if ($sql -> db_Select("core", "*", "e107_name='sgallery_prefs' ")) {
                $row = $sql -> db_Fetch();
                $sgal_pref = $eArrayStorage->ReadArray($row['e107_value']);
                if($this->getExtConfig()) {
                    $sgal_pref = array_merge($sgal_pref, $this->getExtConfig());
                    $row['e107_value'] = $eArrayStorage->WriteArray($sgal_pref, false);
                }
                $e107cache->set($CacheTag, $row['e107_value'], true);
            } else { //default
                $sgal_pref = $this->_DefPrefs();
                //core
                $tmp = $eArrayStorage->WriteArray($sgal_pref, false);
                $e107cache->set('nomd5_SgalleryPrefs', $tmp, true);
                $tmp = addslashes($tmp);
                if(!$sql -> db_Update("core", "e107_value='{$tmp}' WHERE e107_name='sgallery_prefs'")) {
                    $sql -> db_Insert("core", "'sgallery_prefs', '{$tmp}' ");
                }
                //external
                if($this->getExtConfig()) {
                    $sgal_pref = array_merge($sgal_pref, $this->getExtConfig());
                    $tmp = $eArrayStorage->WriteArray($sgal_pref, false);
                    $e107cache->set($CacheTag, $tmp, true);
                }
            }
        } else {
            $sgal_pref = $eArrayStorage->ReadArray($cpref);
        }
        $this->_prefs = &$sgal_pref;
        return $sgal_pref;
    }
    
    /*
    * @descr Update plugin settings
    * @access public    
    */
    function updatePref($prefarray){
        global $sql, $e107cache, $eArrayStorage;
        if(!is_array($prefarray) || empty($prefarray)) 
            return false;
        $this->_prefs = &$prefarray;
        $tmp = $eArrayStorage->WriteArray($prefarray, false);
        $sql -> db_Update("core", "e107_value='".addslashes($tmp)."' WHERE e107_name='sgallery_prefs'");
        $e107cache->set('nomd5_SgalleryPrefs', $tmp, true);
        return true;
    }
       
    /*
    * @descr load plugin object $name from includes/sgal_$name.php
    * @$name string module name
    * @access public    
    */
    function &loadObj($name){
        if(empty($name)) {
            return false;
        }
        
        if (isset($this->_modules[$name]) && $this->_modules[$name]) {
            if(class_exists($name)) {
                $instance = new $name;
                return $instance;
            }
            return true;
        }
        $fname = SGAL_INCPATH."sgal_$name.php";
        if(!is_file($fname) || !is_readable($fname)) {
            return false;
        }
        require_once($fname);
        $name = "sgal_$name";
        if(class_exists($name)) {
            $instance = new $name;
            //$this->_modules[$name] =& $instance; - better just create an instance without cache it in the class property
            $this->_modules[$name] = true;
            return $instance;
        }
        $this->_modules[$name] = true;
        return true;
    }       
    
    
}
?>