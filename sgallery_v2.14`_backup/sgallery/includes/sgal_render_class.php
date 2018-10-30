<?php
/*
+ ----------------------------------------------------------------------------------------------------+
|        e107 website system 
|        Gallery Render Class: e107_plugins/sgallery/includes/sgal_render_class.php
|        Email: m.yovchev@clabteam.com
|        $Revision: 741 $
|        $Date: 2008-04-23 14:31:38 +0300 (Wed, 23 Apr 2008) $
|        $Author: secretr $
|	     Copyright Corllete Lab ( http://www.clabteam.com ) under GNU GPL License (http://gnu.org)
|        Free Support: http://dev.e107bg.org/
+----------------------------------------------------------------------------------------------------+
*/
if (!defined('e107_INIT')) { exit; }

include_lan(SGAL_LAN.'_render.php'); 

class sgal_render_class {
    var $flobj=''; //e107 file object
    
    
    function adminUploadForm($imagepath, $opt='all', $ajax_prefs='') { //todo opts!
        global $sgal_pref, $pref;
        
        if(!$ajax_prefs) $ajax_prefs = ".{$sgal_pref['sgal_restrict_w']}.{$sgal_pref['sgal_restrict_h']}.{$sgal_pref['sgal_w']}.{$sgal_pref['sgal_h']}";
        $text = '';
        if (!FILE_UPLOADS)
        {
          if(ADMIN) $text .= "<br /><strong>".LAN_UPLOAD_SERVEROFF."</strong><br />";
          else $text .= "<br /><strong>".SGAL_LANRND_108."</strong><br />";
        }
        elseif($opt=='all' && !getperms('6')) 
        {
          $text .= "<br /><strong>".SGAL_LANRND_108.": ".SGAL_ALBUMPATH_ABS."</strong><br />";
        }
        elseif($opt=='user' && (!$pref['upload_enabled'] || !check_class($pref['upload_class']))) 
        {
          if(ADMIN) $text .= "<br /><a href='".e_ADMIN."upload.php'>".SGAL_LANRND_109."</a><br />";
          else $text .= "<br /><strong>".SGAL_LANRND_108."</strong><br />";
        }
        else
        {
          $path_error = false;                
          if (!is_dir($imagepath) || !is_writable($imagepath))
          {
              if(ADMIN) $text .= "<br />".LAN_UPLOAD_777." <strong>".$imagepath.(!is_dir($imagepath) ? " - ".SGAL_LANRND_121 : '' )."</strong><br />";
              else $text .= "<br />".SGAL_LANRND_108."</strong><br />";
              $path_error = true;
          }
                         
          $up_name = array();
          $up_value = array();
          $defval = varset($_POST['uploadtype'],'none');
          
          //auto resize only
          if($sgal_pref['sgal_restrict_size']) {
              $up_name[] = SGAL_LANRND_28;
              $up_value[] = "restrict_resize";
              
          }
          
          if($sgal_pref['sgal_allow_autoresize'] && !$sgal_pref['sgal_restrict_size']) {
              $up_name[] = SGAL_LANRND_25;
              $up_value[] = "auto_resize";
              
          }
        
          //if the user resize is allowed
          if($sgal_pref['sgal_allow_uresize'] && !$sgal_pref['sgal_restrict_size']) {
              $up_name[] = SGAL_LANRND_26;
              $up_value[] = "user_resize";
              
          }
          
          //no action
          if(!$sgal_pref['sgal_restrict_size']) {
              $up_name[] = SGAL_LANRND_29;
              $up_value[] = "none";
              
          }
          
          if(!$_POST['uploadtype']) $_POST['uploadtype'] = $defval = $up_value[0];
          
          $text .= "
             <div>
          ";
          
          if($up_value && !$path_error) {                     
             if(ADMIN) $text .= SGAL_LANRND_46.': <strong>'.realpath($imagepath).'</strong><br />';
             $text .= SGAL_LANRND_47.': <strong>a-z, A-Z, 0-9, '.SGAL_LANRND_47a.' ( . ), '.SGAL_LANRND_47b.' ( - ), '.SGAL_LANRND_47c.' ( _ )</strong><br /><br />';
            
             $text .= "<select class='tbox' name='uploadtype' onchange=\"show_info( this.value".($ajax_prefs ? " + '$ajax_prefs'" : '').",'up_type','cont_', '".SGAL_LANRND_163."',1,1);\">";
             
             for ($i=0; $i<count($up_value); $i++)
             {
                 $selected = ($_POST['uploadtype'] == $up_value[$i]) ? "selected='selected'" : "";
                 $text .= "<option value='".$up_value[$i]."' $selected>".$up_name[$i]."</option>\n";
             }
        
        
             $text .="
                </select>
            ";                 
          }
          
        
          $text .= "<br /><div id='up_container' style='margin: 10px 0px;'>
          <span id='upline' style='white-space:nowrap'>
          ";
          
          if(!$path_error) {
              $text .= "<input class='tbox' type='file' name='file_userfile[]' size='40' />";
          }
        
          
          $text .="&nbsp;</span>
          <br />
          </div>
          ";
        
          if(!$path_error) {
            $text .= "
             <table style='width:100%;'>
        	 <tr>
                <td style='white-space:nowrap; text-align: left;'><input type='button' class='button' value='".SGAL_LANRND_45."' onclick=\"duplicateHTML('upline','up_container');\"  /></td>
        	    <td style='white-space:nowrap; text-align: left;'>
                    <div id='sg_upload_info' style='clear: both; width:100%; display: none; padding: 5px 0px'>
                        <div id='cont_'></div>
                    </div>
                </td>
        	    
        	 </tr>
        	 <tr>
                <td style='white-space:nowrap; text-align: left;' colspan='2'><input class='button' type='submit' name='submitupload' value='".($up_value ? SGAL_LANRND_23 : '')."' /></td>   
        	 </tr>
             </table>
             </div>";
             $text .= "
                 <script type='text/javascript'>
                   show_info('{$defval}'".($ajax_prefs ? " + '$ajax_prefs'" : '').",'up_type','sg_upload_info', '".SGAL_LANRND_163."',1);
                 </script>
             "; 
          }                  
        
        }
        return $text;
    }

/*    
    function publishXP(){
        global $sgal_pref;
        //reg file
    }
*/
    
    /*
    * @descr Render Admin Image List
    * @$imagepath string relative/absolute path to the images
    * @$imagelist array Image List array returned from get_files method  
    * @$mainimg mixed main/default image filename or false to disable        
    * @opt string - comma separated option list [all OR main|rethumb|delete]    
    * @access public    
    */
    function adminImageList($imagepath, $imagelist=array(), $mainimg='', $opt='all', $thpath='') {
        global $sgal_pref, $THCONFIG_THDEF, $tp;

        //icons
        $imagedir = e_IMAGE_ABS."admin_images/";
        if (!defined("SGAL_ICON_MAINPIC_SRC")){ define("SGAL_ICON_MAINPIC_SRC", (file_exists(THEME."images/sgal_mainpic_16.png") ? THEME_ABS."images/sgal_mainpic_16.png" : $imagedir."frontpage_16.png")); }
        if (!defined("SGAL_ICON_AUTOTHUMB_SRC")){ define("SGAL_ICON_AUTOTHUMB_SRC", (file_exists(THEME."images/sgal_custom_16.png") ? THEME_ABS."images/sgal_custom_16.png" : $imagedir."custom_16.png")); }
        
        $opt = str_replace(' ', '', $opt);//clean
        if($opt != 'all' && $opt) {
            $options = explode(',', $opt);
        } else {
            $options = array($opt);
        }
        
        //path stuff
        //$constpath = $imagepath;
        $tmp = substr($imagepath,-1);
        if($tmp != '/' && $tmp != '}') $imagepath = $imagepath.'/'; 
        $thumbpath_abs = $tp->replaceConstants($imagepath,'full'); 
        // TO DO !!!!!!
        $thumbpath = makeURL($imagepath); 
        $imagepath = $tp->replaceConstants($imagepath); 
        //$imagepath = $tp->replaceConstants($constpath); 
        //$imagepath = makeURL($constpath); 

        if(empty($imagelist)) {
            if(!$this->flobj) {
                require_once(SGAL_INCPATH."sgal_file_class.php");
                $this->flobj = new sgal_file;
            }

            $imagelist = $this -> flobj -> sgal_pics($imagepath, $sgal_pref);
        } 
        
        //more paths stuff
        //$imagepath_abs = $tp->replaceConstants($constpath,'full'); 
        
        //$thumbpath = makeURL($imagepath); 
        //print_a($thumbpath);
        $text = '';
        $group = md5(time());
        
        if($imagelist && is_array($imagelist)) {
          $i = 0;
          foreach($imagelist as $img){
        
                 $i++;
                 
                 $tmpimg = is_file($img['path'].$img['fname']) ? getimagesize($img['path'].$img['fname']) : "";
                 
                 //if the pic do not exist - go to the next
                 if(!$tmpimg) {
                    $i--;
                    continue;
                 }
        
                 if($tmpimg[0] >= $tmpimg[1]) {
                    //landscape
                    $tw =  varsettrue($sgal_pref['sgal_thumb_w'], 120);
                    $the = varsettrue($sgal_pref['sgal_thumb_h'], 90);
                    $pw =  $sgal_pref['sgal_restrict_size'] ? varsettrue($sgal_pref['sgal_restrict_w'], 640) : varsettrue($sgal_pref['sgal_w'], 640);
                    $ph =  $sgal_pref['sgal_restrict_size'] ? varsettrue($sgal_pref['sgal_restrict_h'], 480) : varsettrue($sgal_pref['sgal_h'], 480);
                 } elseif($tmpimg[0] < $tmpimg[1]) {
                    //portrait
                    $tw =  varsettrue($sgal_pref['sgal_thumb_h'], 120);
                    $the = varsettrue($sgal_pref['sgal_thumb_w'], 90);
                    $pw =  $sgal_pref['sgal_restrict_size'] ? varsettrue($sgal_pref['sgal_restrict_h'], 480) : varsettrue($sgal_pref['sgal_h'], 640);
                    $ph =  $sgal_pref['sgal_restrict_size'] ? varsettrue($sgal_pref['sgal_restrict_w'], 640) : varsettrue($sgal_pref['sgal_w'], 480);
                 }
                 $maxh = $tw;
                 //thumb + cfg
                 $brd_color = ($img['fname'] == $mainimg ? '2EA63A' : $sgal_pref['sgal_bg']);
                 $cfg = $THCONFIG_THDEF;
                 $cfg['fltr'][] = 'bord|1|0|0|'.$brd_color;
                 $thumb = showThumb($thumbpath.$img['fname'], $cfg , 'relative', $thpath);

                 // check if re-thumb is needed
                 $rethumb = '';
                 if(in_array('all', $options) || in_array('rethumb', $options)) {
                     //fixed showing rethumb when not needed 
                     if( ($tmpimg[0] > $pw || $tmpimg[1] > $ph) && ($sgal_pref['sgal_allow_autoresize'] || $sgal_pref['sgal_restrict_size']))
                            $rethumb = "<input type='image' title='".SGAL_LANRND_25." - {$pw}x{$ph}' name='thumb[mainrethumb#".$img['fname']."]' src='".SGAL_ICON_AUTOTHUMB_SRC."' />&nbsp;";
                 }
                 if(strlen($img['fname']) > 25) {
                    $tmp = explode('.', $img['fname']);
                    $tmp1= count($tmp) - 1;
                    if($tmp1) {
                        $ext = '.'.$tmp[$tmp1];
                        unset($tmp[$tmp1]);
                    } else $ext = '';
                    $tmp = implode('.', $tmp);
                    $bttl= substr($tmp, 0, 16).'...'.$ext;
                    unset($tmp, $tmp1);
                 } else {
                    $bttl = $img['fname'];
                 }
                 if(in_array('notitle', $options)) {
                    $alt = "";
                    $bttl = "";
                 } else {
                    $alt = $tp->toAttribute($img['fname']);
                    $bttl = preg_replace("#[^a-z0-9._\-]#i", '', $bttl);
                 }
                 
                 $text .= "
                 <div style='width: 200px; float: left; vertical-align: middle; margin: 10px; padding: 2px; text-align: center;'>
                 <table style='width: 99%;margin-left: auto; margin-right: auto; text-align: center;' class='fborder'>
                 <caption title='{$alt}' style='text-align: left; padding: 2px 0px;'>".$bttl."</caption>
                 <tr>
                    <td style='width:100%; text-align: right' class='fcaption'>
                        ".$rethumb.((in_array('all', $options) || in_array('main', $options)) && $img['fname'] != $mainimg  ? "<input type='image' title='".SGAL_LANRND_35."' name='thumb[mainthumb#".$img['fname']."]' src='".SGAL_ICON_MAINPIC_SRC."' />" : "")."
                        ".((in_array('all', $options) || in_array('delete', $options))  ? "<input type='image' title='".SGAL_LANRND_DELETE."' name='delete[pic#".$img['fname']."]' src='".ADMIN_DELETE_ICON_PATH."' onclick=\"return jsconfirm('".str_replace("'", "\'", SGAL_LANRND_105a)." &quot;".$img['fname']."&quot;? ".str_replace("'", "\'", SGAL_LANRND_105b)."')\" />" : "")."
                    </td>
                 </tr>   
                 <tr>
                    <td style='width:100%; height: {$maxh}px; text-align: center; vertical-align: middle' class='forumheader3'>
                        <a href='".$thumbpath_abs.$img['fname']."' class='lightview' rel='gallery_{$group}' onclick=\"sgalSmartOpen('".showJsThumb($thumbpath.$img['fname'], $img['fname'].': '.SGAL_LANRND_36, 'relative', $thpath)."', 1, this); return false;\" title='".SGAL_LANRND_36."'><img src='".$thumb."' alt='".$img['fname']."' style='border: 0px none; vertical-align: middle;' /></a>
                    </td>
                 </tr>
                 <tr>
                    <td style='width:100%; text-align: center' class='forumheader2'>
                        <em>".SGAL_LANRND_31.":</em><br /><strong> ".$tmpimg[0]."px</strong> X <strong>".$tmpimg[1]."px</strong>
                    </td>
                 </tr>
                 </table>  
                 </div>
                 ";
        
        
          }
        
        } else {
          if(ADMIN) $text .= "<br /><strong>".SGAL_LANRND_107.' '.SGAL_LANRND_107a.': '.$thumbpath."</strong><br />";
          else $text .= SGAL_LANRND_107;
        }
        
        return $text;
              
    }
}
?>