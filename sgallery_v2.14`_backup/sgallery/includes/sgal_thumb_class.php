<?php
/*
+ ----------------------------------------------------------------------------------------------------+
|        e107 website system 
|       Thumb class: e107_plugins/sgallery/includes/ajax_thumb_class.php
|        Email: m.yovchev@clabteam.com
|        $Revision: 739 $
|        $Date: 2008-04-22 14:03:31 +0300 (Tue, 22 Apr 2008) $
|        $Author: secretr $
|	Copyright Corllete Lab ( http://www.clabteam.com )
|        Free Support: http://dev.e107bg.org/
+----------------------------------------------------------------------------------------------------+
*/
if (!defined('e107_INIT')) { exit; }


if(!function_exists('phpThumbURL')) {
    require_once(SGAL_INCPATH.'phpThumb.config.php');
}
require_once('phpthumb.class.php');
include_lan(SGAL_LAN.'_sysmsg.php');

/**
* Thumb class
*
* @package: CL
* @version: 1.00 $
* @author: SecretR $
*/

class sgal_thumb_class {

    var $thumbRelPath;
    var $thumbObj;

    /**
    * @return
    * @desc thumb constructor - empty
    * @access public
    */
    function sgal_thumb_class()
    {
        $this->clearThumb();
    }
    
    /**
    * @desc re-create the thumb object - usefull
    * when creating thumbs in loop as the object should not be reused if the image source differs    
    * @access private
    */
    function clearThumb()
    {
		//destroy the phpthumb object
		$this->thumbObj = '';
		//new phpThumb object - access - private
        $phpThumb = new phpThumb(); 
        $this->thumbObj =& $phpThumb; 
    }
    
    /**
    * @return array    
    * @desc resize multiply images
    * @$rfiles array source files 
    * @$rfiles string action method name [auto_resize|restrict_resize|user_resize|none]      
    * @$dir string source directory     
    * @access public
    */
    function imageActions($rfiles, $action='none', $dir='', $destdir='', $delSource = true)
    { 
        cachevars('c_sgal_resized', array()); //empty
    	
        if(empty($rfiles)) 
            return false;   
    	
        if($action == 'none') {
    	   return array(SGAL_SYSMSG_1);
    	}
            
		if(!method_exists($this, $action)) {
            return array(SGAL_SYSMSG_2);
        }

		if (!empty($dir) && substr($dir, strlen($dir)-1, 1) != '/') {
			$dir .= '/';
		}
		
		if (!empty($destdir) && substr($destdir, strlen($dir)-1, 1) != '/') {
			$destdir .= '/';
		}
		
        if(empty($destdir)) 
            $destdir = $dir;
		
        return $this->$action($rfiles, $dir, $destdir, $delSource);
    } 
    
    /**
    * @return result msg array    
    * @desc auto resize multiply images
    * @$rfiles array source files 
    * @$dir string source directory     
    * @access private
    */
    function auto_resize($rfiles, $dir='', $destdir='', $delSource = false)
    {
        global $sgal_pref, $sgalobj;
        $msg = array();
        $resized = array();
        foreach($rfiles as $key=>$fls) {
            $dest = $dir ? $dir.$fls['name'] : $fls['name'];
            $src = $destdir ? $destdir.'__'.$fls['name'] : '__'.$fls['name'];
            //temp file

            if(!copy($dest, $src)) {
                $src = $dest; //no temp file created
            }
            $tmp = $this->makeResize($sgalobj->defThconfig(), $src, $dest, true, true);

			if($delSource && $destdir != $dir) @unlink($dir.$fls['name']);
            if($tmp) $msg[] = $tmp;
            if(is_readable($dest)) { 
                $rfiles[$key]['resized_path'] = $dest;
                $rfiles[$key]['resized_size'] = filesize($dest);
            } else unset($rfiles[$key]);
            unset($tmp);
        }
        cachevars('c_sgal_resized', $rfiles);
        return $msg;
    }
    
    /**
    * @return result msg array    
    * @desc auto user_resize multiply images
    * $sgal_pref resize values are overwritten by $_POST['resize_value_w'] rezie values
    * $_POST resize values are overwritten by $rfiles['user_resize'] resize values
    * if there is no value the default 640x480 will be used    
    * @$rfiles array source files & user_resize values (optional)
    * @$dir string source directory     
    * @access private
    */
    function user_resize($rfiles, $dir='', $destdir='', $delSource = false)
    {      
        global $sgal_pref;
        $msg = array();
        //catch user_resize post variables 
        $cfg = array('w'=>varset($_POST['user_resize_w'],''), 'h'=>varset($_POST['user_resize_h'],''));
        $cfgarr = $this->makeConfig($cfg, false);
        
        foreach($rfiles as $key=>$fls) {
            $dest = $dir ? $dir.$fls['name'] : $fls['name'];
            $src = $destdir ? $destdir.'__'.$fls['name'] : '__'.$fls['name'];
            
            //temp file
            if(!copy($dest, $src)) {
                $src = $dest;
            }

            $tmp = $this->makeResize($cfgarr, $src, $dest, true, true);

			if($delSource && $destdir != $dir) @unlink($dir.$fls['name']);
			
            if(is_readable($dest)) { 
                $rfiles[$key]['resized_path'] = $dest;
                $rfiles[$key]['resized_size'] = filesize($dest);
            } else unset($rfiles[$key]);
            if($tmp) $msg[] = $tmp;
            unset($tmp,$cfgarr);
        }
        cachevars('c_sgal_resized', $rfiles);
        return $msg;
    }
    
    function restrict_resize($rfiles, $dir='', $destdir='', $delSource = false)
    {      
        global $sgal_pref, $sgalobj;
        $msg = array();

        foreach($rfiles as $key=>$fls) {
            $dest = $dir ? $dir.$fls['name'] : $fls['name'];
            $src = $destdir ? $destdir.'__'.$fls['name'] : '__'.$fls['name'];
            
            //temp file

            if(!copy($dest, $src)) {
                $src = $dest;
            }
            //prepare configuration array
            //$cfgarr = $THCONFIG_DEF;
            
            $tmp = $this->makeResize($sgalobj->defThconfig(), $src, $dest, true, true);

			if($delSource && $destdir != $dir) @unlink($dir.$fls['name']);
            if($tmp) $msg[] = $tmp;
            if(is_readable($dest)) { 
                $rfiles[$key]['resized_path'] = $dest;
                $rfiles[$key]['resized_size'] = filesize($dest);
            } else unset($rfiles[$key]);
            unset($tmp,$cfgarr);
        }
        cachevars('c_sgal_resized', $rfiles);
        return $msg;
    }

     /**
    * @return array
    * @desc create thumb images
    * @$cfgarr array configuration array used by setThConfig
    * @$src string source file
    * @$dest string output file
    * @$delSource bool true - src file will be deleted, false - do not delete the src file
    * @Example $th->make_thumb($cfgarr, $tempfile, $dest_filename, true);
    * @access public
    */
    function makeResize($cfgarr = array(), $src='', $dest='', $debugMsg=true, $delSource = false)
    {
        $ret = false;

        //no source or no destination file
        if(!$src || !$dest) {
           if($debugMsg) {
                 $ret = SGAL_SYSMSG_3;
           }
           $this -> clearThumb();
           return $ret;
        }

        //set phpThumb src file
        $this->thumbObj->setSourceFilename($src);
        //configure phpThumb object
        $this->setConfig($cfgarr);

        $error = false;
        //generate and render to file
        if ($this->thumbObj->GenerateThumbnail()) {
              if (!$this->thumbObj->RenderToFile($dest)) {
                   //RenderToFile error
                   $error = true;
              }
        } else {
              //GenerateThumbnail error
               $error = true;
        }

        if($error) {
             if($debugMsg && ADMIN) {
                $r = md5($dest);
                $ret = "<a href='#' onclick='expandit(\"phpth-errmsg-".$r."\"); return false;'>".LAN_ERROR."[phpThumb]:</a>";
                $ret .= "<div id='phpth-errmsg-".$r."' class='smalltext' style='display: none; text-align: left'><br /><br /> $src -&gt; $dest <br /><br />".implode('<br />', $this->thumbObj->debugmessages)."</div>";
             }
        } else {
            chmod($dest, 0755);
        }

        if($delSource && ($src != $dest || $error)) @unlink($src);
        
		//re-create thumb object
		$this -> clearThumb();
        return $ret;
    }

    /**
    * @return
    * @desc set phpThumb object properties
    * @access private
    */
    function setConfig($cfgarr = array())
    {
       global $PHPTHUMB_CONFIG; 

       $cfgarr = array_merge($PHPTHUMB_CONFIG, $cfgarr);
       //parameters
       foreach ($cfgarr as $key => $value) {
           $this->thumbObj->$key = $value;
       }
       //config options
       //$this->thumbObj->config_error_die_on_error = false;
       //$this->thumbObj->config_output_format = 'jpeg';
    }
    
    /**
    * @return configure array
    * @desc set config
    * @access private
    */
    function makeConfig($cfgarr = array(), $strict=false)
    {
        global $sgal_pref; 
        
        if(isset($cfgarr['w'])) $cfgarr['sgal_w'] = $cfgarr['w'];
        if(isset($cfgarr['h'])) $cfgarr['sgal_h'] = $cfgarr['h'];
        
        if(varset($cfgarr['far'],$sgal_pref['sgal_far']) || $strict) {           
            $ret['far'] = varset($cfgarr['far'],$sgal_pref['sgal_far']); //Force Aspect Ratio
            $ret['w'] = varsettrue($cfgarr['sgal_w'], $sgal_pref['sgal_w']); //width
            $ret['h'] = varsettrue($cfgarr['sgal_h'], $sgal_pref['sgal_h']); //height
        } else {
            $ret['wp'] = varsettrue($cfgarr['sgal_h'], $sgal_pref['sgal_h']); //max width - portrait
            $ret['wl'] = varsettrue($cfgarr['sgal_w'], $sgal_pref['sgal_w']); //max width - landscape
            $ret['hp'] = varsettrue($cfgarr['sgal_w'], $sgal_pref['sgal_w']); //max height - portrait
            $ret['hl'] = varsettrue($cfgarr['sgal_h'], $sgal_pref['sgal_h']); //max height - landscape
        }
        
        $ret['q'] = 80; //to do - pref
        $ret['iar'] = 0; //to do - pref - Ignore Aspect Ratio
        
        $ret['bg'] = varsettrue($cfgarr['sgal_bg'], $sgal_pref['sgal_bg']); //background color
        
        //watermark
        $tmp = array();
        if(isset($cfgarr['wmi'])) {
            $tmp['f'] = varsettrue($cfgarr['wmi']['f'], $sgal_pref['sgal_watermark']);
            $tmp['a'] = varsettrue($cfgarr['wmi']['a'], $sgal_pref['sgal_watermark_pos']);
            $tmp['o'] = varsettrue($cfgarr['wmi']['o'], $sgal_pref['sgal_watermark_op']);
            $tmp['x'] = varsettrue($cfgarr['wmi']['x'], $sgal_pref['sgal_watermark_x']);
            $tmp['y'] = varsettrue($cfgarr['wmi']['y'], $sgal_pref['sgal_watermark_y']);
        } else {
            $tmp['f'] = $sgal_pref['sgal_watermark'];
            $tmp['a'] = $sgal_pref['sgal_watermark_pos'];
            $tmp['o'] = $sgal_pref['sgal_watermark_op'];
            $tmp['x'] = $sgal_pref['sgal_watermark_x']; //to do - prefs
            $tmp['y'] = $sgal_pref['sgal_watermark_y']; //to do - prefs
        }
        
        if(is_readable(SGAL_IMAGES.'watermark/'.$tmp['f'])) 
            $tmp['f'] = SGAL_IMAGES.'watermark/'.$tmp['f']; //use default dir if no path provided in the cfgarr
            
        if($tmp['f'] && $tmp['a']) {
            $ret['fltr'] = array( "wmi|{$tmp['f']}|{$tmp['a']}|{$tmp['o']}|{$tmp['x']}|{$tmp['y']}" );
        }

        return $ret;

    }
}


?>