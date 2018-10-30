<?php
/*
+ ----------------------------------------------------------------------------------------------------+
|        e107 website system 
|        Admin Area : e107_plugins/sgallery/admin_config.php
|        Email: m.yovchev@clabteam.com
|        $Revision: 777 $
|        $Date: 2009-05-13 14:29:38 +0300 (Wed, 13 May 2009) $
|        $Author: secretr $
|	Copyright Corllete Lab ( http://www.clabteam.com )
|        Free Support: http://dev.e107bg.org/
+----------------------------------------------------------------------------------------------------+
*/ 
require_once("../../class2.php");

if(!getperms("P")){ header("location:".e_BASE."index.php"); exit; } 

require_once('init.php');
include_lan(SGAL_LAN.'_admin.php'); 
//load admin class
$admgal = $sgalobj->loadObj('admin_class');

//handlers
require_once(e_HANDLER."ren_help.php");

require_once(SGAL_INCPATH."sgal_file_class.php");
$fl = new sgal_file;

require_once(e_HANDLER."form_handler.php");
$rs = new form;
 

$e_wysiwyg = 'album_description,cat_description';

//call it before header.php
function headerjs()
{
 
    $txt .= "<script type='text/javascript' src='".SGAL_INCPATH."e_ajax.js'></script>";
    $txt .= "
         <script type='text/javascript'>
           var el_loaded = new Array();
           var el_key = '';
           var xmlReq = null;
           function show_info(val, act, info, lmsg, noaddval, nohide) 
           {
                info = !noaddval ? info + '_' + val : info;
                el_key = !noaddval ? act + '_' + val : act;
                var dobj = new Date();
                //var rndget = dobj.getTime();

            	if(document.getElementById(info)) {
                      folder=document.getElementById(info).style;
            	} else {
            		alert('".SGAL_LANADM_162." - ' + info);
            		return false;
               }
               
               if(folder.display=='none' || nohide)
               {
            		folder.display='';
                	if(typeof el_loaded[el_key] == 'undefined') { 
                        loader(info, lmsg, null, null);
                        //rndget removed - possible fixed with Cache-Control header
                        var url = '".SGAL_PATH_ABS."includes/ajax_parse.php?' + act + '.' + val; //+ '.' + rndget;	
                        
                        //quick CL Widgets 0.8 Compat Mod
                        if(typeof e107Ajax === 'object') {
                            setTimeout(function () { new e107Ajax.Updater(info, url) }, 150);
                        }
                        else {
                            setTimeout(function () { sendInfo(url, info) }, 150);
                        }
                	
                		if(!noaddval) el_loaded[el_key] = true;
            		}
               } else {
            		//if(!noaddval) 
                    folder.display='none';
               }

           }
           
           function loader(info, msg, before, append){
                var el = document.getElementById(info);
                if(!before) var elbefore = el.firstChild;
                else var elbefore = document.getElementById(before);
                var pElement = document.createElement('p');
                var text = document.createTextNode(' ' + msg);
                var italic = document.createElement('em');
                var imgElement = document.createElement('img');
                imgElement.setAttribute('src', '".SGAL_IMAGES_ABS."loading_16.gif');
                imgElement.setAttribute('style', 'vertical-align: bottom; width: 16px; height: 16px');
                pElement.appendChild(imgElement);
                italic.appendChild(text);
                pElement.appendChild(italic);
                if(!append) el.insertBefore(pElement, elbefore);
                else el.appendChild(pElement);
           }

            function submit_form(act,info_id,frm,before,msg)
            {
               if(before && msg){
                   loader(info_id, msg, before, null);
               }
               var file = '".SGAL_PATH_ABS."includes/ajax_userparse.php' + (act ? '?' + act : '');
               sendInfo(file,info_id,frm);
            }
            
            var jurlPost = '';
            function page_jump( jurl, pages, show_page, pmsg )
            {
              pmsg = pmsg + pages + ')';
            
              userPage = prompt( pmsg, show_page );
            
              if ( userPage > 0  )
              {
                if ( userPage < 1 )     {    userPage = 1;  }
                if ( userPage > pages ) { userPage = pages; }
                if ( userPage == show_page )    {     return false;    }
            
                window.location = jurl + userPage + jurlPost;
              }
            }
         </script>
    ";
    
    return $txt;
}

require_once(e_ADMIN.'auth.php');

// suspicious check (on every 6-th hour) - tiny cronjob
$now = time();
$sgal_pref['sgalsys_suspicious_check'] = varsettrue($sgal_pref['sgalsys_suspicious_check'], $now);
$check = (($now - $sgal_pref['sgalsys_suspicious_check']) > (6 * 60 * 60)) || $sgal_pref['sgalsys_suspicious_check'] == $now ? true : false;

if($check) {
    // check for file-types;
    if (is_readable(e_ADMIN.'filetypes.php')) {
    	$a_types = strtolower(trim(file_get_contents(e_ADMIN.'filetypes.php')));
    } else {
    	$a_types = 'jpg, jpeg, png, gif';
    }
    
    $a_types = explode(',', $a_types);
    foreach ($a_types as $f_type) {
    	$allowed_types[] = '.'.trim(str_replace('.', '', $f_type));
    }
    //code from admin.php potential check
    $public = array(SGAL_PATH.'cache/', SGAL_ALBUMPATH);
    $suspicious = array();
    foreach ($public as $dir) {
        $test = sgal_filearray($dir, $allowed_types);
        if(!empty($test)) $suspicious[] = $test;
    }
    
    $sgal_pref['sgalsys_suspicious_check'] = !empty($suspicious) ? 0 : $now;
    $sgalobj -> updatePref($sgal_pref);//bugfix - pref not saved
}

if (isset($suspicious) && !empty($suspicious)) {
	$text = ADLAN_ERR_3."<br /><br />";

	foreach ($suspicious as $p_file) {
	    $text .= "<div style='font-weight: bold;'>".implode('<br />', $p_file).'</div>';
	}

	$ns -> tablerender(ADLAN_ERR_1, $text);
	$text = '';
}

//pics - no write permissions
if (!is_writable(SGAL_PATH.'cache/')) {
	$text = SGAL_LANADM_151." <strong>".SGAL_PATH_ABS.'cache/'."</strong>";
	$ns -> tablerender(SGAL_LANADM_152, $text);
	$text = '';
}

//pics - no write permissions
if (!is_writable(SGAL_ALBUMPATH)) {
	$text = LAN_UPLOAD_777." <strong>".SGAL_ALBUMPATH_ABS."</strong>";
	$ns -> tablerender(LAN_ERROR.' - '.LAN_UPLOAD_FILES, $text);
	$text = '';
}


if (e_QUERY) {
    $tmp = explode(".", e_QUERY);
    $action = $tmp[0];
    $sub_action = varset($tmp[1],'');
    $id = intval(varsettrue($tmp[2], 0));
    $p = intval(varsettrue($tmp[3], 0));
    unset($tmp);
} else {
    $action = '';
    $sub_action = '';
    $id = 0;
    $p = 0;
}

    //default action
    if(!$action) $action = 'main';
    
    //item id
    if(!$id) $id = 0;
    $id = intval($id);
    
    //page number
    if(!$p) $p = 1;
    $p = intval($p);

//number albums / categories per page
$amount = $sgal_pref['sgal_admin_albums'] ? $sgal_pref['sgal_admin_albums'] : 10;

//unique pageid -> admin menu
$pageid = $action . ($sub_action ? ".{$sub_action}" : '');

// main code ----------------------------------------------------------------------------------------------------

//session msgs - after-redirect messages
if(isset($_SESSION['sessmsg'])) {
  $admgal->set_message($_SESSION['sessmsg'][0], $_SESSION['sessmsg'][1]);
  unset($_SESSION['sessmsg']);
}

//category filter
if(isset($_POST['album_category'])) {
       $_SESSION['album_category'] = $_POST['album_category'];
        //go to the main section
        if($sub_action) {
             header("Location: ".e_SELF."?main.0.0.".$p);
             exit;
        }
}

//#change status - activate / deactivate -------------------------------
if($sub_action == 'chstat') {

       //category or album
       if($action == 'category') {
          $atable = 'sgallery_cats';
          $whstr = "cat_id='{$id}'";
       }
       else {
          $atable = 'sgallery';
          $whstr = "album_id='{$id}'";
       }
       
       //img path if $extq
       $extq = '';
       if($action == 'main') $extq = ", path, sgal_user";
       if($sql -> db_Select($atable, "active".$extq, $whstr))
       {
          $row = $sql -> db_Fetch();
          $newstat = $row['active'] ? 0 : 1;
          
          $q = '?'.$action.'.0.0.'.$p;
            
          //check the status if album - fix v1.2-> only when not user album
          if($action == 'main' && $newstat && !$row['sgal_user']) {
               $imagelist = $fl -> sgal_pics(SGAL_ALBUMPATH.$row['path']."/", $sgal_pref, false);
               
               //newstat is 0
               if(empty($imagelist)) {
                  
                  $_SESSION['sessmsg'] = array(SGAL_LANADM_122, LAN_ERROR);
                  session_write_close();
                  header("Location: ".e_SELF.$q);
                  exit;
               }
          }

          if($sql -> db_Update($atable, "active='{$newstat}' WHERE {$whstr}")) {
               $_SESSION['sessmsg'] = array(SGAL_LANADM_123, LAN_UPDATED);
               session_write_close();
               header("Location: ".e_SELF.$q);
               exit;
          } else {
              $stat_error = !mysql_errno() ? false : true;  
              $message = !$stat_error ? LAN_NO_CHANGE : LAN_UPDATED_FAILED." - ".LAN_TRY_AGAIN."<br />".LAN_ERROR." ".mysql_errno().": ".mysql_error();
              $type = !$stat_error ? LAN_UPDATED_FAILED : LAN_ERROR.' - '.LAN_UPDATED_FAILED;

              $_SESSION['sessmsg'] = array($message, $type);
              session_write_close();
              header("Location: ".e_SELF.$q);
              exit; 
          }
       }
       unset($id);
}

//#delete item -----------------------------------------------
if(isset($_POST['delete']))
{
    $tmp = array_keys($_POST['delete']);
    list($delete, $del_id) = explode("#", $tmp[0]);
} else {
    $delete = '';
    $del_id = false;
}

if ($delete == "category" && $del_id)
{
    //exists
    $del_id = intval($del_id);
    if ($sql->db_Count('sgallery_cats','(*)',"WHERE cat_id='{$del_id}'"))
    {
       //no items found in the gallery tables
       if(!$sql->db_Count('sgallery','(*)',"WHERE cat_id='{$del_id}'")) {
           if($sql->db_Delete("sgallery_cats", "cat_id='{$del_id}' "))
           {
               $admgal->set_message(SGAL_LANADM_109." #".$del_id." ".SGAL_LANADM_110a , LAN_DELETED);
               //to do - cache
           } else {
               $admgal->set_message(SGAL_LANADM_109." #".$del_id." - ".LAN_DELETED_FAILED.'<br />'.LAN_TRY_AGAIN, LAN_ERROR); 
           }
       } else {
           $admgal->set_message(SGAL_LANADM_109." #".$del_id." ".SGAL_LANADM_110b , LAN_DELETED_FAILED);
       }

    } else $admgal->set_message(SGAL_LANADM_109." #".$del_id." - ".LAN_DELETED_FAILED."<br />".SGAL_LANADM_110c , LAN_ERROR);

    unset($delete, $del_id);
}

if ($delete == "main" && $del_id)
{
    $del_id = intval($del_id);
    if ($sql->db_Select('sgallery',"album_id, path", "album_id='{$del_id}'"))
    {
         $row = $sql -> db_Fetch();
         $imagelist = $fl -> sgal_pics(SGAL_ALBUMPATH.$row['path']."/", $sgal_pref, false);
         if(!empty($imagelist)) {
                $admgal->set_message(SGAL_LANADM_124, LAN_ERROR);
         } else {
             if($row['path'] && $fl->rmtree(SGAL_ALBUMPATH.$row['path'])) { //deleted
                 $sql->db_Delete("sgallery", "album_id='{$del_id}'");
                 $admgal->set_message(SGAL_LANADM_118." #".$del_id." - ".LAN_DELETED , LAN_DELETED);
                 //to do - cache
             } else { //not empty - deletion failed
                if($row['path']) {
                    $admgal->set_message(SGAL_LANADM_118." #".$del_id." - ".LAN_DELETED_FAILED.'<br />'.SGAL_LANADM_125.' '.SGAL_ALBUMPATH_ABS.$row['path'] , LAN_ERROR);
                } else { //path already deleted (!?) - should not happen
                    $sql->db_Delete("sgallery", "album_id='{$del_id}'");
                    $admgal->set_message(SGAL_LANADM_118." #".$del_id." - ".LAN_DELETED , LAN_DELETED);
                    //to do - cache
                }
             }
         }
    } else {
         $admgal->set_message(SGAL_LANADM_118." #".$del_id." - ".LAN_DELETED_FAILED.'<br />'.SGAL_LANADM_126 , LAN_ERROR);
    }
    unset($delete, $del_id);
}

//delete file - album edit ------------------------
if ($delete == "pic" && $del_id && $id)
{
    //file upload permissions ?
    if(getperms('6')) {
        if ($sql->db_Select("sgallery", "*", "album_id='$id' ORDER BY dt DESC"))
        {
            $row = $sql->db_Fetch();
            $delobj = $sgalobj->loadObj('actions_class');
            $imagepath = SGAL_ALBUMPATH.$row['path']."/";
            $mod = $action == 'submitted' ? 'approve' : 'admin';
            if($tmp = $delobj->deleteImage($imagepath, $del_id, $mod, $id)) {
                if($tmp['msg']) {
                    $admgal->set_message($tmp['msg'][0] , $tmp['msg'][1]);
                }
                
                if($tmp['status'] && $row['thsrc'] == $del_id) {
                   //main thumb pic is deleted!
                   $sql -> db_Update('sgallery', "thsrc='' WHERE album_id='$id'");
                   $_POST['thsrc'] = '';
                }
            //to do - cache
             
            }
        } else {
             $admgal->set_message(SGAL_LANADM_126 , LAN_ERROR.' - '.LAN_DELETED_FAILED);
        }
    } else {
        $admgal->set_message(SGAL_LANADM_106, LAN_ERROR);
    }
    unset($delete, $del_id, $delobj);
}

//# -------- Category actions -------------------------
if($action == 'category') {

    //edit variables ----------------->
    if($sub_action == 'edit' && !isset($_POST['submit_cat'])) {
        if ($sql->db_Select("sgallery_cats", "*", "cat_id='$id' ")) {

            $row = $sql->db_Fetch();

            $_POST['title'] = $tp -> toForm($row['title'], true, true);
            $_POST['cat_description'] = $tp -> toForm($row['cat_description'], true, true);
            $_POST['cat_order'] = $row['cat_order'];
            $_POST['active'] = $row['active'];
       }
    }
    
    //category order submited ----------------->
    if(isset($_POST['submit_order'])) {
         if(is_array($_POST['order']))
         {
           foreach ($_POST['order'] as $key => $value)
           {
               $orderarr = explode('_',$value);
               if($orderarr[0] && $orderarr[1])
                   $sql -> db_Update('sgallery_cats', "cat_order='".intval($orderarr[1])."' WHERE cat_id='".$orderarr[0]."'");
           }
           $orderarr = array();
           $admgal->set_message(SGAL_LANADM_115, LAN_UPDATED);
         }

    }
    
    //category submited ----------------->
    if(isset($_POST['submit_cat'])) {

         //create new
         $insert = array();
         $update = '';
         
         $check_error = $_POST['title'] ? false : true;
         
         //insert
         if($sub_action == 'create' && !$check_error) {
            $cat_num = $sql->db_Count("sgallery_cats", "(*)");

            $insert['active'] = 1;
            
            $insert['title'] = $tp -> toDB(trim($_POST['title']));
            $_POST['title'] = $tp -> post_toForm($_POST['title']);
            
            $insert['cat_description'] = $tp -> toDB(trim($_POST['cat_description']));
            $_POST['cat_description'] = $tp -> post_toForm($_POST['cat_description']);
            
            $insert['cat_order'] = $cat_num+1;
            
            $cid = $sql->db_Insert("sgallery_cats", $insert);
            if($cid) {
                
                if(!$_POST['stay']) {
                    $_SESSION['sessmsg'] = array(SGAL_LANADM_109.' [#'.$cid.'] '.SGAL_LANADM_110, LAN_CREATED);
                    //Cache
    
                    session_write_close();
                    header("Location: ".e_SELF.'?category.0.0.'.$p);
                    exit;
                } else {
                    $admgal->set_message(SGAL_LANADM_109.' [#'.$cid.'] '.SGAL_LANADM_110, LAN_CREATED);
                    $_POST = '';
                    $_POST['stay'] = 1;
                }
            } else {
                $admgal->set_message(LAN_CREATED_FAILED, LAN_ERROR);
            }
         }

         if($sub_action == 'edit' && !$check_error) {
            $update .= "active='".intval($_POST['active'])."', title='".$tp -> toDB($_POST['title'])."', cat_description='".$tp -> toDB($_POST['cat_description'])."', cat_order='".intval($_POST['cat_order'])."' WHERE cat_id='$id'";
            $_POST['title'] = $tp -> post_toForm($_POST['title']);
            $_POST['cat_description'] = $tp -> post_toForm($_POST['cat_description']);
            
             if($sql -> db_Update('sgallery_cats', $update)) {
                $_SESSION['sessmsg'] = array(SGAL_LANADM_109.' [#'.$id.'] '.SGAL_LANADM_111, LAN_UPDATED);
                //cache
                session_write_close();
                header("Location: ".e_SELF.'?category.0.0.'.$p);
                exit;
             } else {
                $cat_error = !mysql_errno() ? false : true;
                $message = !$cat_error ? LAN_NO_CHANGE : LAN_UPDATED_FAILED." - ".LAN_TRY_AGAIN."<br />".LAN_ERROR." ".mysql_errno().": ".mysql_error();
                $type = !$cat_error ? LAN_UPDATED_FAILED : LAN_ERROR.' - '.LAN_UPDATED_FAILED;
                if($cat_error)
                    $admgal->set_message($message, $type);
                else {
                    if(!$_POST['stay']) {
                        $_SESSION['sessmsg'] = array($message, $type);
                        session_write_close();
                        header("Location: ".e_SELF.'?category.0.0.'.$p);
                        exit; 
                    } else {
                         $admgal->set_message($message, $type);
                    }
                }
             }
         }

         //category error
         if($check_error) {
            $admgal->set_message(SGAL_LANADM_112, LAN_ERROR);
         }
    }
    
    if($sub_action == 'create' || $sub_action == 'edit')    
         $admgal->createCat($id);
    else
         $admgal->showCats($sub_action, $p);


}
//# -------- Settings -------------------------
elseif($action == 'config') {
    //save settings
    if (isset($_POST['save_sgal_prefs'])) {
    	$sgal_pref['sgal_restrict_size'] = $_POST['sgal_restrict_size'] ? '1' : '0';
    	$sgal_pref['sgal_restrict_w'] = ($_POST['sgal_restrict_w'] && is_numeric($_POST['sgal_restrict_w'])) ? intval($_POST['sgal_restrict_w']) : $sgal_pref['sgal_restrict_w'];
    	$sgal_pref['sgal_restrict_h'] = ($_POST['sgal_restrict_h'] && is_numeric($_POST['sgal_restrict_h'])) ? intval($_POST['sgal_restrict_h']) : $sgal_pref['sgal_restrict_h'];
    	$sgal_pref['sgal_allow_autoresize'] = $_POST['sgal_allow_autoresize'] ? '1' : '0';
    	$sgal_pref['sgal_h'] = ($_POST['sgal_h'] && is_numeric($_POST['sgal_h'])) ? intval($_POST['sgal_h']) : $sgal_pref['sgal_h'];
    	$sgal_pref['sgal_w'] = ($_POST['sgal_w'] && is_numeric($_POST['sgal_w'])) ? intval($_POST['sgal_w']) : $sgal_pref['sgal_w'];
    	$sgal_pref['sgal_allow_uresize'] = $_POST['sgal_allow_uresize'] ? '1' : '0';

    	$sgal_pref['sgal_far'] = strpos('C T R B L TL TR BL BR', $_POST['sgal_far']) !== FALSE ? $_POST['sgal_far'] : '0';
    	$sgal_pref['sgal_bg'] = preg_match('/[a-fA-F0-9]{6}/', $_POST['sgal_bg']) ? $_POST['sgal_bg'] : $sgal_pref['sgal_bg'];
    	
        $sgal_pref['sgal_thgal_w'] = ($_POST['sgal_thgal_w'] && is_numeric($_POST['sgal_thgal_w'])) ? intval($_POST['sgal_thgal_w']) : $sgal_pref['sgal_thgal_w'];
    	$sgal_pref['sgal_thgal_h'] = ($_POST['sgal_thgal_h'] && is_numeric($_POST['sgal_thgal_h'])) ? intval($_POST['sgal_thgal_h']) : $sgal_pref['sgal_thgal_h'];
    	
    	$sgal_pref['sgal_thalbum_w'] = ($_POST['sgal_thalbum_w'] && is_numeric($_POST['sgal_thalbum_w'])) ? intval($_POST['sgal_thalbum_w']) : $sgal_pref['sgal_thalbum_w'];
    	$sgal_pref['sgal_thalbum_h'] = ($_POST['sgal_thalbum_h'] && is_numeric($_POST['sgal_thalbum_h'])) ? intval($_POST['sgal_thalbum_h']) : $sgal_pref['sgal_thalbum_h'];
    	
    	$sgal_pref['sgal_thumb_w'] = ($_POST['sgal_thumb_w'] && is_numeric($_POST['sgal_thumb_w'])) ? intval($_POST['sgal_thumb_w']) : $sgal_pref['sgal_thumb_w'];
    	$sgal_pref['sgal_thumb_h'] = ($_POST['sgal_thumb_h'] && is_numeric($_POST['sgal_thumb_h'])) ? intval($_POST['sgal_thumb_h']) : $sgal_pref['sgal_thumb_h'];
        
        $sgal_pref['sgal_admin_albums'] = ( $_POST['sgal_admin_albums'] && is_numeric($_POST['sgal_admin_albums'])) ? intval($_POST['sgal_admin_albums']) : $sgal_pref['sgal_admin_albums'];
        $sgal_pref['sgal_pagenum'] = ($_POST['sgal_pagenum'] && is_numeric($_POST['sgal_pagenum'])) ? intval($_POST['sgal_pagenum']) : $sgal_pref['sgal_pagenum'];
        $sgal_pref['sgal_tblrender'] = $_POST['sgal_tblrender'] ? '1' : '0';
        
        $sgal_pref['sgal_galperrow'] = ($_POST['sgal_galperrow'] && is_numeric($_POST['sgal_galperrow'])) ? intval($_POST['sgal_galperrow']) : $sgal_pref['sgal_galperrow'];

        $sgal_pref['sgal_albumperrow'] = ($_POST['sgal_albumperrow'] && is_numeric($_POST['sgal_albumperrow'])) ? intval($_POST['sgal_albumperrow']) : $sgal_pref['sgal_albumperrow'];
        $sgal_pref['sgal_albumperpage'] = ($_POST['sgal_albumperpage'] && is_numeric($_POST['sgal_albumperpage'])) ? intval($_POST['sgal_albumperpage']) : $sgal_pref['sgal_albumperpage'];
        $sgal_pref['sgal_picperrow'] = ($_POST['sgal_picperrow'] && is_numeric($_POST['sgal_picperrow'])) ? intval($_POST['sgal_picperrow']) : $sgal_pref['sgal_picperrow'];
    	$sgal_pref['sgal_picperpage'] = ($_POST['sgal_picperpage'] && is_numeric($_POST['sgal_picperpage'])) ? intval($_POST['sgal_picperpage']) : $sgal_pref['sgal_picperpage'];
        
        $sgal_pref['sgal_picperrow_latest'] = ($_POST['sgal_picperrow_latest'] && is_numeric($_POST['sgal_picperrow_latest'])) ? intval($_POST['sgal_picperrow_latest']) : $sgal_pref['sgal_picperrow_latest'];
    	$sgal_pref['sgal_picperpage_latest'] = ($_POST['sgal_picperpage_latest'] && is_numeric($_POST['sgal_picperpage_latest'])) ? intval($_POST['sgal_picperpage_latest']) : $sgal_pref['sgal_picperpage_latest'];
        
        $sgal_pref['sgal_galrand_multinum'] = ($_POST['sgal_galrand_multinum'] && is_numeric($_POST['sgal_galrand_multinum'])) ? intval($_POST['sgal_galrand_multinum']) : $sgal_pref['sgal_galrand_multinum'];
        $sgal_pref['sgal_rand_multinum'] = ($_POST['sgal_rand_multinum'] && is_numeric($_POST['sgal_rand_multinum'])) ? intval($_POST['sgal_rand_multinum']) : $sgal_pref['sgal_rand_multinum'];
        
        $sgal_pref['sgal_upload_publishxp'] = $_POST['sgal_upload_publishxp'];
        $sgal_pref['sgal_bballow_external'] = $_POST['sgal_bballow_external'];
        $sgal_pref['sgal_album_comments'] = $_POST['sgal_album_comments'];
        $sgal_pref['sgal_album_rating'] = $_POST['sgal_album_rating'];
        $sgal_pref['sgal_latest'] = $_POST['sgal_latest'];
        
        $sgal_pref['sgal_picorder'] = ($_POST['sgal_picorder'] != 'asc' && $_POST['sgal_picorder'] != 'desc') ? 'desc' : $_POST['sgal_picorder'];
        $sgal_pref['sgal_picorder_type'] = ($_POST['sgal_picorder_type'] != 'ftime' && $_POST['sgal_picorder_type'] != 'fname') ? 'ftime' : $_POST['sgal_picorder_type'];
        
        //watermark
        $sgal_pref['sgal_watermark'] = $_POST['sgal_watermark'] ? basename($_POST['sgal_watermark']) : '';
        $sgal_pref['sgal_watermark_pos'] = $_POST['sgal_watermark_pos'] ? $_POST['sgal_watermark_pos'] : '0';
        $sgal_pref['sgal_watermark_op'] = $_POST['sgal_watermark_op'] ? intval($_POST['sgal_watermark_op']) : '0';
        $sgal_pref['sgal_watermark_x'] = ($_POST['sgal_watermark_x'] && is_numeric($_POST['sgal_watermark_x'])) ? intval($_POST['sgal_watermark_x']) : '0';
        $sgal_pref['sgal_watermark_y'] = ($_POST['sgal_watermark_y'] && is_numeric($_POST['sgal_watermark_y'])) ? intval($_POST['sgal_watermark_y']) : '0';

        $sgalobj -> updatePref($sgal_pref);
        
        //core prefs
        $pref['sgal_active'] = $_POST['sgal_active'];
        $pref['sgal_wperms'] = $_POST['sgal_wperms'];
        $pref['sgal_advwperms'] = $_POST['sgal_advwperms'];
        $pref['sgal_bbthumbperms'] = $_POST['sgal_bbthumbperms'];
        
        save_prefs();
        $admgal->set_message(SGAL_LANADM_150, LAN_UPDATED);
    }

    $admgal->editPrefs();

} elseif($action == 'uconfig') {
    //save settings
    if (isset($_POST['save_sgal_uprefs'])) {
        
        $sgal_pref['sgal_usermod_allow'] = $_POST['sgal_usermod_allow'];
        $sgal_pref['sgal_usermod_albumcreate'] = $_POST['sgal_usermod_albumcreate'];
        $sgal_pref['sgal_usermod_visible'] = $_POST['sgal_usermod_visible'];
        $sgal_pref['sgal_usermod_galleries'] = $_POST['sgal_usermod_galleries'];
        $sgal_pref['sgal_usermod_urestrict'] = $_POST['sgal_usermod_urestrict'] ? '1' : '0';
        $sgal_pref['sgal_usermod_picapprove'] = $_POST['sgal_usermod_picapprove'] ? '1' : '0';
        $sgal_pref['sgal_usermod_albumcreate_approve'] = $_POST['sgal_usermod_albumcreate_approve'] ? '1' : '0';
        $sgal_pref['sgal_usermod_urestrict_w'] = (is_numeric($_POST['sgal_usermod_urestrict_w']) && $_POST['sgal_usermod_urestrict_w']) ? intval($_POST['sgal_usermod_urestrict_w']) : 640;
        $sgal_pref['sgal_usermod_urestrict_h'] = (is_numeric($_POST['sgal_usermod_urestrict_h']) && $_POST['sgal_usermod_urestrict_h']) ? intval($_POST['sgal_usermod_urestrict_h']) : 480;
        $_POST['sgal_usermod_rmethods_str'] = varsettrue($_POST['sgal_usermod_rmethods_str'], array());
        if(!empty($_POST['sgal_usermod_rmethods_str'])) {
            $sgal_pref['sgal_usermod_rmethods'] = implode(',', $_POST['sgal_usermod_rmethods_str']);
        } else {
            $sgal_pref['sgal_usermod_rmethods'] = '';
        }
        $sgal_pref['sgal_usermod_albumcount'] = intval($_POST['sgal_usermod_albumcount']);
        $sgal_pref['sgal_usermod_piccount'] = intval($_POST['sgal_usermod_piccount']);
        $sgal_pref['sgal_usermod_albumsize'] = is_numeric($_POST['sgal_usermod_albumsize']) && $_POST['sgal_usermod_albumsize'] ? intval($_POST['sgal_usermod_albumsize'] * 1024) : '0'; //convert to bytes
        $sgal_pref['sgal_usermod_totalsize'] = is_numeric($_POST['sgal_usermod_totalsize']) && $_POST['sgal_usermod_totalsize'] ? intval($_POST['sgal_usermod_totalsize'] * 1024) : '0'; //convert to bytes
        
        $sgalobj -> updatePref($sgal_pref);
        $admgal->set_message(SGAL_LANADM_150, LAN_UPDATED);
    }
    $admgal->editPrefs('user');
}
//# -------- Album actions -------------------------
elseif($action == 'main') {

    //edit subaction -------------------------------
    if($sub_action == 'edit' && !isset($_POST['submit_album'])) {
        if ($sql->db_Select("sgallery", "*", "album_id='$id' AND  album_ustatus>0")) {

            $row = $sql->db_Fetch();
            
            $_POST['title'] = $tp -> toForm($row['title'], true, true);
            $_POST['album_description'] = $tp -> toForm($row['album_description'], true, true);
            $_POST['cat_id'] = $row['cat_id'];
            $_POST['sgal_user'] = $row['sgal_user'];
            $_POST['dt'] = $row['dt'];
            $_POST['calendar'] = $row['dt'];
            $_POST['active'] = $row['active'];

            $_POST['thsrc'] = $row['thsrc'];
            $_POST['path'] = $row['path'];

            $_POST['update_datestamp'] = 0;

       }
    }
    
    //album submitted -------------------------------------
    if(isset($_POST['submit_album'])) {

         //create new album
         $album_error = false;
         $insert = array();
         $update = '';
         
         $insert['title'] = $tp -> toDB(trim($_POST['title']));
         $_POST['title'] = $tp -> post_toForm($_POST['title']);
         
         $insert['album_description'] = $tp -> toDB(trim($_POST['album_description']));
         $_POST['album_description'] = $tp -> post_toForm($_POST['album_description']);
         
         $insert['sgal_user'] = $_POST['sgal_user'];
         
         //timestamp
		 if(preg_match("#(.*?)/(.*?)/(.*?) (.*?):(.*?):(.*?)$#", $_POST['calendar'], $matches))
		 {
 			 $_POST['dt'] = mktime($matches[4], $matches[5], $matches[6], $matches[2], $matches[1], $matches[3]);
	     }
		 else
		 {
			 $_POST['dt'] = time();
		 }
		 
         $insert['dt'] = $_POST['update_datestamp'] ? time() : $_POST['dt'];
         $insert['cat_id'] = intval($_POST['cat_id']);
         
         if(empty($_POST['cat_id']) && empty($_POST['sgal_user'])) { //if it's user album cat_id can be left blank...
             $album_error = true;
         }
         
         if(empty($insert['title'])) {
             $album_error = true;
         }

         //album error
         if($album_error) {
                  $admgal->set_message(SGAL_LANADM_116, LAN_ERROR);
         } else {
             //insert
             if($sub_action == 'create')
             {
                 //later it will be checked for pics and the status will be updated
                 $insert['active'] = 1;
                 
                 //create (random) image directory
                 $proof = 0;
                 $upobj = $sgalobj->loadObj('actions_class');
                 while(true) {
                    $proof++;
                    $insert['path'] = $upobj->uniq_str();
                    if(!is_dir(cl_PUBLIC.'gallery/'.$insert['path']))
                         break;
                    //prevent infinite loop
                    if($proof > 20) break;
                 }

                 if(!mkdir(SGAL_ALBUMPATH.$insert['path'], 0777)) {
                       $admgal->set_message(SGAL_LANADM_117, LAN_ERROR);
                 } else {
                        $aid = $sql->db_Insert("sgallery", $insert);
                        if($aid) {
                            $_SESSION['sessmsg'] = array(SGAL_LANADM_118.' [#'.$aid.'] '.SGAL_LANADM_119.'<br />'.SGAL_LANADM_120, LAN_CREATED);
                            //cache
                            //go to edit section - upload pics module is enabled
                            if($_POST['stay'] == "1") $r = e_SELF.'?'.e_QUERY;
                            elseif($_POST['stay'] == "2") $r = e_SELF.'?main.edit.'.$aid.'.'.$p;
                            else $r = e_SELF.'?main.0.0.'.$p;
                            session_write_close();
                            header("Location: ".$r);
                            exit;
                        } else {
                            $admgal->set_message(LAN_CREATED_FAILED.'<br />'.LAN_TRY_AGAIN, LAN_ERROR);
                        }
                 }
             }
             //edit
             elseif($sub_action == 'edit')
             {
                //check the directory name
                if(!preg_match('/[a-zA-Z0-9\._\-]/', $_POST['path'])) {
                     echo 'e107 [sgallery] said: Bad folder name. Access denied';
                     require_once(e_ADMIN.'footer.php');
                     exit;
                }

                //check the images and update the status               
                $imagelist = $fl -> sgal_pics(SGAL_ALBUMPATH.$_POST['path']."/", $sgal_pref, false);

                //deactivate the album - v1.2 fix - only when not user album
                if(empty($imagelist) && !$_POST['sgal_user']) { 
                    $_POST['active'] = 0;
                    $insert['active'] = 0;
                } else {
                    $insert['active'] = intval($_POST['active']);
                }
                
                $update = '';
                foreach ($insert as $key=>$value) {
                	$update .= $update ? ", {$key}='{$value}'" : "{$key}='{$value}'";
                }
                
                $update = "{$update} WHERE album_id='$id'";
                
                if($_POST['stay']) $r = e_SELF.'?'.e_QUERY;
                else $r = e_SELF.'?'.$action.'.0.0.'.$p;

                if ($sql -> db_Update('sgallery', $update)) {
                   //cache

                   //redirect
                   if(!$_POST['stay']) {
                       $_SESSION['sessmsg'] = array(SGAL_LANADM_118.' [#'.$id.'] '.SGAL_LANADM_119a, LAN_UPDATED);
                       session_write_close();
                       header("Location: ".$r);
                       exit;
                   } else {
                       $admgal->set_message(SGAL_LANADM_118.' [#'.$id.'] '.SGAL_LANADM_119a, LAN_UPDATED);
                   }
                   
                } else {
                   $al_error = !mysql_errno() ? false : true;
                   $message = !$al_error ? LAN_NO_CHANGE : LAN_UPDATED_FAILED." - ".LAN_TRY_AGAIN."<br />".LAN_ERROR." ".mysql_errno().": ".mysql_error();
                   $type = !$al_error ? LAN_UPDATED_FAILED : LAN_ERROR.' - '.LAN_UPDATED_FAILED;
                   
                   if($al_error) {
                       $admgal->set_message($message, $type);
                   } else {
                       if(!$_POST['stay']) {
                           $_SESSION['sessmsg'] = array($message, $type);
                           session_write_close();
                           header("Location: ".$r);
                           exit;
                       } else {
                           $admgal->set_message($message, $type);
                       }
                   }
                }
             }

         } //end no error
    } // end album submit
    
    
    //# file upload + image actions -------------------------------------------------------------------------
    if(isset($_POST['submitupload'])) {
        //file upload permissions ?
        
        if(!$id || !$_POST['path']) {
             $_SESSION['sessmsg'] = array(SGAL_LANADM_126, LAN_ERROR);
             session_write_close();
             header("Location: ".e_SELF.'?main.0.0.'.$p);
             exit;
        }
        
        if(getperms('6')) {
            $pref['upload_storagetype'] = "1";
            $imagepath = SGAL_ALBUMPATH.$_POST['path'];
            $upobj = $sgalobj->loadObj('actions_class');
            $msg = $upobj->uploadImage($imagepath, SGAL_ALBUMPATH.$_POST['path'], $sgalobj);
            
            if(!empty($msg) && is_array($msg)) {
                $admgal->set_message(implode('<br />', $msg), SGAL_LANADM_129);
            }/* else {
                 if($_POST['uploadtype'] != 'none')
                    $admgal->set_message(SGAL_LANADM_130, SGAL_LANADM_129);
            }*/
        } else {
            $admgal->set_message(SGAL_LANADM_106, LAN_ERROR);
        }
    }

    //rethumb actions
    if(isset($_POST['thumb'])) {
          $tmp = array_keys($_POST['thumb']);
          list($set_thumb, $thname) = explode("#", $tmp[0]);

    } else {
          $set_thumb = '';
          $thname = false;
    }
    
    //set main album image
    if($set_thumb == 'mainthumb' && $thname) {
         if(!$id || !$_POST['path']) {
            header("Location: ".e_SELF.'?main.0.0.'.$p);
            exit;
         }
    
        //check file name
        if(preg_match("/[^a-zA-Z0-9\._\-]/", $thname)) {
           echo 'e107 [sgallery] said: Bad filename. Access denied';
           require_once('f.php');
           exit;
        }
        
        if ($sql->db_Select("sgallery", "*", "album_id='$id' ORDER BY dt DESC"))
        {
             $row = $sql->db_Fetch();

             //check the images and update the status               
             $imagelist = $fl -> sgal_pics(SGAL_ALBUMPATH.$_POST['path']."/", $sgal_pref);

             if(empty($imagelist) || !is_array($imagelist)) {
                    $admgal->set_message(LAN_ERROR." - ".SGAL_LANADM_127, LAN_ERROR);
             } else {
                    $found = FALSE;
                    foreach ($imagelist as $value)
                    {
                        if($value['fname'] == $thname) {
                               $found = TRUE;
                               break;
                        }
                    }
                    if($found) {

                        if($sql -> db_Update('sgallery', "thsrc='{$thname}' WHERE album_id='$id'")) {
                        
                           $admgal->set_message("&quot;".$thname."&quot; ".SGAL_LANADM_131, LAN_UPDATED);
                           $_POST['thsrc'] = $thname;
                           
                        } else {
                           if(!mysql_errno()) {
                                $admgal->set_message("&quot;{$thname}&quot; ".SGAL_LANADM_132.'. '.LAN_NO_CHANGE , LAN_NO_CHANGE);
                           } else {
                                $admgal->set_message(LAN_ERROR." [mySQL]: [".mysql_errno()."] ".mysql_error() , LAN_UPDATED_FAILED);
                           }
                        }
                    } else {
                       //file not found
                       $admgal->set_message("&quot;".$thname."&quot; - ".SGAL_LANADM_127, LAN_ERROR);
                    }
             }
        } else {
             $admgal->set_message(SGAL_LANADM_126 , LAN_ERROR);
        }
    }
    
    //set main album image
    if($set_thumb == 'mainrethumb' && $thname) {
        if(!$id || !$_POST['path']) {
           header("Location: ".e_SELF.'?main.0.0.'.$p);
           exit;
        }
        
        $rethobj = $sgalobj->loadObj('actions_class');
        $msg = $rethobj->rethumbImage(SGAL_ALBUMPATH.$_POST['path'], $thname, $sgalobj);
    
        if(!empty($msg) && is_array($msg)) {
            $admgal->set_message(implode('<br />', $msg), SGAL_LANADM_129);
        } else {
            $admgal->set_message(SGAL_LANADM_130, SGAL_LANADM_129);
        }

    }

    if($sub_action == 'create' || $sub_action == 'edit')
         $admgal->createAlbum($id);
    else
         $admgal->showAlbums($sub_action, $p);
}
//# -------- Approve actions -------------------------
elseif($action == 'submitted') {
    
    //edit - approve
    if( ($sub_action == 'edit' || $sub_action == 'album_approve') && $id ) {
         
        if ($sql->db_Select("sgallery", "*", "LEFT JOIN ".MPREFIX.SGAL_STABLE." ON album_id=submit_album_id WHERE album_id='{$id}'", 'nowhere')) {
        
            $row = $sql->db_Fetch();
            

            $_POST['title'] = $tp -> toForm(varset($_POST['title'], $row['title']), true, true);
            $_POST['album_description'] = $tp -> toForm(varset($_POST['album_description'], $row['album_description']), true, true);
            $_POST['cat_id'] = varset($_POST['cat_id'],$row['cat_id']);
            $_POST['sgal_user'] = varset($_POST['sgal_user'],$row['sgal_user']);
            $_POST['dt'] = $row['dt'];
            $_POST['calendar'] = $row['dt'];
            $_POST['active'] = varset($_POST['active'], 1); //fix - default 1 on enter
        
            $_POST['thsrc'] = $row['thsrc'];
            $_POST['path'] = $row['path'];
            $_POST['album_ustatus'] = $row['album_ustatus'];
            $_POST['update_datestamp'] = varset($_POST['update_datestamp'], 0);
        }
        
        //quick approve
        if($sub_action == 'album_approve') {
            $quick_app = true;
            $sub_action = 'edit';
            $_POST['submit_album'] = true;
        } else {
            $quick_app = false;
        }
        
        //submitted
        if(isset($_POST['submit_album'])) {
             
             $album_error = false;
             $uparr = array();
             $update = '';
             
             $uparr['title'] = $tp -> toDB(trim($_POST['title']));
             $_POST['title'] = $tp -> post_toForm($_POST['title']);
             
             $uparr['album_description'] = $tp -> toDB(trim($_POST['album_description']));
             $_POST['album_description'] = $tp -> post_toForm($_POST['album_description']);
             
             $uparr['sgal_user'] = $_POST['sgal_user'];

             $uparr['cat_id'] = intval($_POST['cat_id']);
             $uparr['active'] = $_POST['active'] ? 1 : 0;
             $uparr['album_ustatus'] = 1;
             $uparr['dt'] = time(); //update the date to the approve time
             
             if(empty($uparr['sgal_user'])) { //if it's user album - user can't be blank...
                 $album_error = true;
             }
             
             if(empty($uparr['title'])) {
                 $album_error = true;
             }
    
             //album error
             if($album_error) {
                $admgal->set_message(SGAL_LANADM_116, LAN_ERROR);
             } else {
                //check the directory name
                if(!preg_match('/[a-zA-Z0-9\._\-]/', $_POST['path'])) {
                     echo 'e107 [sgallery] said: Bad folder name. Access denied';
                     require_once(e_ADMIN.'footer.php');
                     exit;
                }
                
                foreach ($uparr as $key=>$value) {
                	$update .= $update ? ", {$key}='{$value}'" : "{$key}='{$value}'";
                }
                
                $update = "{$update} WHERE album_id='$id'";
                
                $r = e_SELF.'?'.$action;

                //check images and update the status               
                $imagelist = $fl -> sgal_approve_pics(SGAL_ALBUMPATH.$_POST['path']."/", $sgal_pref);
                $picapp_err = false;
                $cntall = 0;
                if(!empty($imagelist)) {
                    $picapp_err = false;
                    $cntall = count($imagelist);
                    foreach($imagelist as $key=>$img){
                        $name = SGAL_ALBUMPATH.$_POST['path'].'/'.$img['fname'];
                        $newname = SGAL_ALBUMPATH.$_POST['path'].'/'.preg_replace('#^[_]{2}(app).*(_)#', '', $img['fname']);
                        if(rename($name, $newname) === FALSE) {
                            $picapp_err = true;
                        } else {
                            unset($imagelist[$key]);
                        }
                    }
                    $cnt = count($imagelist);
                    if(!$cnt && !$picapp_err) $sql->db_Delete("sgallery_submit", "submit_album_id='{$id}'");
                    else $sql -> db_Update("sgallery_submit", "submit_picnum='".$cnt."' WHERE submit_album_id='{$id}'");
                } elseif(empty($imagelist) && $row['submit_picnum']) {
                    //clear submitted db record
                    $sql->db_Delete("sgallery_submit", "submit_album_id='{$id}'");
                }
                //print_a($_POST);print_a($uparr);print_a($imagelist);

                $sql -> db_Update('sgallery', $update);
                //cache
                
                //user notify
                if(isset($_POST['sgal_send_notify'])) {
                    include_lan(e_PLUGIN.'sgallery/languages/'.e_LANGUAGE.'_enotify.php');
                    $snt = $sgalobj->loadObj('notify_class');

                    $udata = explode('.', $_POST['sgal_user']);
                    $ntdata = array();
                    $ntdata[] = SGAL_NOTIFY_11.' '.$udata[1].",<br />";
                    if(!$_POST['album_ustatus']) $ntdata[] = SGAL_NOTIFY_9.'<br />';
                    if($cntall && !$picapp_err) $ntdata[] = $cntall.' '.SGAL_NOTIFY_9a.'<br />';
                    $ntdata[] = SGAL_NOTIFY_8.': '.$_POST['title'];
                    $ntdata[] = SGAL_NOTIFY_10.': [url='.SITEURL.$PLUGINS_DIRECTORY.'sgallery/gallery.php?uview.'.$id.']'.SITEURL.$PLUGINS_DIRECTORY.'sgallery/gallery.php?uview.'.$id.'[/url]';

                    $snt -> send($udata[0], SGAL_NOTIFY_7, $ntdata);
                }
                
                //redirect
                $_SESSION['sessmsg'] = array(SGAL_LANADM_118.' [#'.$id.'] '.SGAL_LANADM_119a, LAN_UPDATED);
                session_write_close();
                header("Location: ".$r);
                exit;

             }
        
        }
        
        $admgal->createAlbum($id, $action);
    }
    else 
        $admgal->showAlbums($action, $p);
}
elseif($action == 'scheck') {
    ob_start();
    include_once(SGAL_PATH.'admin_server_check.php');
    $text = ob_get_contents();
    ob_end_clean();
    $ns->tablerender(SGAL_LANADM_23, $text);
}
else {
     $_SESSION['sessmsg'] = array(SGAL_LANADM_101, LAN_ERROR);
     session_write_close();     
     header("Location:".e_SELF);
     exit;
}

$text = '';
echo "<div style='float: right; margin-right: 10px; margin-bottom: 10px; padding: 5px; font-weight: bold; border: 1px solid #ccc'><a href='http://www.free-source.net' style='text-decoration: none;'><img src='".SGAL_IMAGES_ABS."icon_32.png' style='vertical-align: middle; margin-right: 10px' /></a><a href='http://www.free-source.net'>Corllete Lab Gallery v{$pref['sgal_version']}</a></div>";
require_once(e_ADMIN."footer.php"); 
exit;

function admin_config_adminmenu(){
global $pageid, $sql, $sgal_pref, $sgal_support, $ns;

    $dtitle = defined('SGAL_SUPPORT_MENUTITLE') ? SGAL_SUPPORT_MENUTITLE : 'Contribute';
    $sgal_support = '<p style="padding: 5px">'.(defined('SGAL_SUPPORT_MENUDESCR') ? SGAL_SUPPORT_MENUDESCR : 'Support the further development of Corllete Lab Gallery').'</p>';
    $sgal_support .= '  
    <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_blank">
        <div style="text-align: center; margin-top: 15px">
        <input type="hidden" name="cmd" value="_xclick" />
        <input type="hidden" name="business" value="support@free-source.net" />
        <input type="hidden" name="item_name" value="Support the further development of Corllete Lab Gallery" />
        <input type="hidden" name="no_shipping" value="0" />
        <input type="hidden" name="no_note" value="1" />
        <input type="hidden" name="currency_code" value="EUR" />
        <input type="hidden" name="tax" value="0" />
        <input type="hidden" name="bn" value="PP-DonationsBF" />
        <input type="hidden" name="lc" value="US" />
        <input type="image" src="https://www.paypal.com/en_US/i/btn/x-click-but21.gif" style="border: 0" name="submit" alt="Donate to CL Gallery project via PayPal" />
        <img  alt="Donate to CL Gallery project via PayPal" style="border: 0; height: 1px; width: 1px" src="https://www.paypal.com/en_US/i/scr/pixel.gif" />
        </div>
    </form>
    ';
    
    
	$menutitle = SGAL_LANADM_7;//"Menu Title";

	$butname[] = SGAL_LANADM_8;//list
	$butlink[] = "admin_config.php";  
	$butid[] = "main"; 
	
	$butname[] = SGAL_LANADM_9;//create / edit album
	$butlink[] = "admin_config.php?main.create";  
	$butid[] = "main.create";
	
	$butname[] = SGAL_LANADM_10;//category list
	$butlink[] = "admin_config.php?category";  
	$butid[] = "category";
	
	$butname[] = SGAL_LANADM_11;// create/edit category
	$butlink[] = "admin_config.php?category.create";  
	$butid[] = "category.create";
	
	$butname[] = SGAL_LANADM_11a;// category order
	$butlink[] = "admin_config.php?category.order";  
	$butid[] = "category.order";
	
	$butname[] = SGAL_LANADM_12;//settings
	$butlink[] = "admin_config.php?config";  
	$butid[] = "config";
	
	$butname[] = SGAL_LANADM_12a;//user settings
	$butlink[] = "admin_config.php?uconfig";  
	$butid[] = "uconfig";
	
    if(check_class($sgal_pref['sgal_upload_publishxp'])) {
    	$butname[] = SGAL_LANADM_25;//Windows .reg
    	$butlink[] = SGAL_PUBLISH_ABS."publish.php?download_reg";  
    	$butid[] = "download_reg";
    }
	
	$butname[] = SGAL_LANADM_23;//server check tool
	$butlink[] = "admin_config.php?scheck";  
	$butid[] = "scheck"; 


    if($pageid == 'main.edit') $pageid = 'main';
    elseif($pageid == 'category.edit') $pageid = 'category';
    elseif($pageid == 'submitted.edit') $pageid = 'submitted';    
    //submitted
    $cnt = 0;
    $qry = "SELECT SUM(submit_picnum) AS pic_count FROM ".MPREFIX.SGAL_STABLE;
    if($sql->db_Select_gen($qry)) {
        $result = $sql -> db_Fetch();
        $cnt = $result['pic_count'];
    }
    $cnt += $sql -> db_Count('sgallery', '(*)', "WHERE album_ustatus='0'");
    if($cnt) {
    	$butname[] = "<strong>".SGAL_LANADM_12c." ({$cnt})</strong>";//user settings
    	$butlink[] = "admin_config.php?submitted";  
    	$butid[] = "submitted";
    } else {
    	$butname[] = SGAL_LANADM_12c;//user settings
    	$butlink[] = "admin_config.php?submitted";  
    	$butid[] = "submitted";
    }
    
	for ($i=0; $i<count($butname); $i++) {
        $var[$butid[$i]]['text'] = $butname[$i];
		$var[$butid[$i]]['link'] = $butlink[$i];
	};

    show_admin_menu($menutitle, $pageid, $var);
    $ns -> tablerender($dtitle, $sgal_support, array('id' => 'sgal_donate_menu', 'style' => 'button_menu'));
}

function sgal_filearray($start="/", $ftypes=array()) {
    $dir=opendir($start);
    while (false !== ($found=readdir($dir))) { 
        $getit[]=$found; 
    }
    foreach($getit as $num => $item) {
        if (is_dir($start.$item) && $item != '/' && $item!="." && $item!=".." && $item!=".svn" && $item != 'CVS') { 
            $test = sgal_filearray($start.$item."/", $ftypes); 
            if($test) {
                $potential = isset($potential) ? array_merge($potential,$test) : $test ;
            }
            $test = '';
        } 
        if ($item != 'Thumbs.db' && $item !=".htaccess" && is_file($start.$item) && filesize($start.$item)) { 
            $fext = substr(strrchr($item, "."), 0);
            if (!in_array(strtolower($fext), $ftypes) && strtolower($fext) != '.jpeg' && !preg_match('#^(pTh)[A-Z0-9]{0,3}(\.tmp)$#', $item)) {
                if ($item == 'index.html' || $item == "null.txt") {
                    if (filesize($start.$item)) {
						$potential[] = str_replace('../', '', $start).$item;
					}
				} else {
					$potential[] = str_replace('../', '', $start).$item;	
				}
			}
        }
    }
    closedir($dir);
    return $potential;
}
?>