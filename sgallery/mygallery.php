<?php
/*
+ ----------------------------------------------------------------------------------------------------+
|        e107 website system 
|        Gallery front-end : e107_plugins/sgallery/mygallery.php
|        Email: m.yovchev@clabteam.com
|        $Revision: 768 $
|        $Date: 2008-09-18 11:57:24 +0300 (Thu, 18 Sep 2008) $
|        $Author: secretr $
|	     Copyright Corllete Lab ( http://www.clabteam.com )
|        Free Support: http://dev.e107bg.org/
+----------------------------------------------------------------------------------------------------+
*/
    require_once("../../class2.php");
    if(!USER) {
        require_once(HEADERF);
        
        require_once(FOOTERF);
        exit;
    }
    require_once('init.php'); //sgallery init
    
    // Lan Includes ------------------------>
    include_lan(SGAL_LAN.'.php'); 
    include_lan(SGAL_LAN.'_manager.php'); 
    
    // Permissions ------------------------>
    if(!check_class($sgal_pref['sgal_usermod_allow'])) {
        require_once(HEADERF);
        mysgal_msg(SGAL_LAN_20);
        require_once(FOOTERF);
        exit;
    }
    
    // Template Includes ------------------------>
    if(is_readable(THEME."sgallery_manager_tmpl.php")) {
        require_once(THEME."sgallery_manager_tmpl.php");
    } 
    require_once(SGAL_PATH."templates/sgallery_manager_tmpl.php");
    
    $e_wysiwyg = 'album_description';
    
    //header function
    function headerjs()
    {
        $txt = "<script type='text/javascript' src='".SGAL_INCPATH."e_ajax.js'></script>";
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
                		//alert('Element not found or your browser do not support DOM! - ' + info);
                		return false;
                   }
                   
                   if(folder.display=='none' || nohide)
                   {
                		folder.display='';
                    	if(typeof el_loaded[el_key] == 'undefined') { 
                            loader(info, lmsg, null, null);
                            //rndget removed - possible fixed with Cache-Control header
                            var url = '".SGAL_PATH_ABS."includes/ajax_userparse.php?' + act + '.' + val; //+ '.' + rndget;	
                            
                    		var t=setTimeout('sendInfo(\"' + url + '\", \"' + info + '\")',150);
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
             </script>
        ";
        
        return $txt;
    }
    
    // Objects ------------------------>
    require_once(SGAL_INCPATH."sgal_file_class.php");
    $fl = new sgal_file;
    
    // Parse Get Query ------------------------>
    if (e_QUERY) {
    	$tmp = explode(".", e_QUERY);
    	$action = varsettrue($tmp[0], 'edit');
    	$id = varsettrue($tmp[1], 0);

    } else {
        //default values
        $action = 'edit';
        $id = 0;
    }
    
    if(!$action) $action = 'edit';
    $id = intval($id);
    
    // General info ---------------------------->
    $pagesrc = '';
    $title = SGAL_PAGE_NAME.' - '.SGAL_MANAGER_PNAME;
    define('e_PAGETITLE', $title);
    
    $bread_pre = defset('SGAL_BC_SITENAME', 0) ? "<a href='".e_HTTP."'>".SITENAME."</a>".SGAL_BREADC_CHAR : '';
    $sql->db_Mark_Time('Start: CL sgal_manage');
    
    // Start Session if not already started
    if ($pref['user_tracking'] != "session") {
    	session_start();
    }
    
    //session msgs - after-redirect messages
    $SYSMSG = '';
    
    if(isset($_SESSION['sessmsg'])) {
      $SYSMSG = mysgal_msg($_SESSION['sessmsg'], true);
      unset($_SESSION['sessmsg']);
    }
    
    //override sgal prefs - user albums as module on top of Gallery API
    $tmppref = array();
    $tmppref['sgal_restrict_size'] = $sgal_pref['sgal_usermod_urestrict'];
    $tmppref['sgal_restrict_w'] = $sgal_pref['sgal_usermod_urestrict_w'] ? $sgal_pref['sgal_usermod_urestrict_w'] : 640;
    $tmppref['sgal_restrict_h'] = $sgal_pref['sgal_usermod_urestrict_h'] ? $sgal_pref['sgal_usermod_urestrict_h'] : 480;
    $tmp = $sgal_pref['sgal_usermod_rmethods'] ? explode(',', $sgal_pref['sgal_usermod_rmethods']) : array();
    $tmppref['sgal_allow_uresize'] = in_array('uresize', $tmp) ? '1' : '0';
    $tmppref['sgal_allow_autoresize'] = in_array('autoresize', $tmp) ? '1' : '0';

    $sgal_pref = $sgalobj->setExtConfig($tmppref, 'SgalleryUserPrefs');
    
    // actions ------------------------------------>
    if($action == 'edit') {
        if(!$id) {
            require_once(HEADERF);
            mysgal_msg(SGAL_LAN_55);
            require_once(FOOTERF);
            exit;
        }
        
        // Wysiwyg JS support on or off.
        require_once(HEADERF);
                
        // Init data arrays
        $parse_array = array();
        $sgal_param = array();
        
        // SQL query && Result ---------------------------------------->
        
    	$qry = "
    	SELECT al.*,
    	alc.title AS ctitle
    	FROM #sgallery AS al
    	LEFT JOIN #sgallery_cats AS alc ON al.cat_id = alc.cat_id AND alc.active > 0
    	WHERE al.sgal_user LIKE '".USERID.".%' AND al.album_id={$id}
    	GROUP by al.album_id 
    	";
    	
    	if(!$sql->db_Select_gen($qry)) {
            mysgal_msg(SGAL_LAN_55);
            require_once(FOOTERF);
            exit;
        }
         
        $row = $sql->db_Fetch();
        
        //create album first
        if(!$row['path']) {
            echo 'Path error!';
            require_once(FOOTERF);
            exit;
        }
        
        //after-redirect messages
        if($SYSMSG) echo $SYSMSG;
        
        //render object
        include_lan(SGAL_LAN.'_render.php');
        //shortcodes
        require_once(SGAL_INCPATH."sgal_batch.php");
        
        //load user stats
        $tp->parseTemplate('{SGAL_USER_MYSTATS}', FALSE, $sgal_shortcodes); 
        
        $tstats = getcachedvars('sgal_useritem');
        $tmp = getcachedvars('sgal_useritem_'.USERID);
        $alstats = $tmp[$id];
        unset($tmp);

        //user limits
        $ulimit_error = false;
        if($sgal_pref['sgal_usermod_totalsize'] && $tstats['sgal_user_totalpicsize'] >= $sgal_pref['sgal_usermod_totalsize']) {
            $ulimit_error = true;
            $ulimit_msg = SGAL_LANMNG_18.'. '.SGAL_LANMNG_15;
        } elseif($sgal_pref['sgal_usermod_albumsize'] && $alstats['sgal_user_alpicsize'] >= $sgal_pref['sgal_usermod_albumsize']) {
            $ulimit_error = true;
            $ulimit_msg = SGAL_LANMNG_18.'. '.SGAL_LANMNG_16;
        } elseif($sgal_pref['sgal_usermod_piccount'] && ($alstats['sgal_user_alpicnumber'] + $alstats['sgal_user_alawpicnumber']) >= $sgal_pref['sgal_usermod_piccount']) {
            $ulimit_error = true;
            $ulimit_msg = SGAL_LANMNG_18.'. '.SGAL_LANMNG_17;
        }
                
        //edit actions ------------------------------------------------>
        /* Upload Action */

        if(!$ulimit_error && isset($_POST['submitupload'])) {
            
            $upload_limit=array();
            $upload_limit['total'] = $tstats['sgal_user_totalpicsize'];
            $upload_limit['album'] = $alstats['sgal_user_alpicsize'];
            $upload_limit['picnum'] = $alstats['sgal_user_alpicnumber'] + $alstats['sgal_user_alawpicnumber'];
            
            $clactions = $sgalobj->loadObj('actions_class'); 
            $imagepath = SGAL_ALBUMPATH.$row['path'];
            $msg = $clactions -> uploadImage($imagepath, $imagepath, $sgalobj, true, 'user', $upload_limit);
            
            //admin msg
            $uploaded = getcachedvars('c_sgal_resized');
            if($sgal_pref['sgal_usermod_picapprove'] && !empty($uploaded)) {

                if($sql->db_Count('sgallery_submit','(*)',"WHERE submit_album_id='{$id}'")) {
                    $update = "submit_album_id='{$id}', submit_user='".(USERID.".".USERNAME)."', submit_dt='".time()."', submit_ip='".$e107->getip()."', submit_picnum='".($alstats['sgal_user_alawpicnumber']+count($uploaded))."'";
                    $sql -> db_Update("sgallery_submit", "{$update} WHERE submit_album_id='{$id}'");
                } else {
                    $insert = array();
                    $insert['submit_album_id'] = $id;
                    $insert['submit_user'] = USERID.".".USERNAME;
                    $insert['submit_dt'] = time();
                    $insert['submit_ip'] = $e107->getip();
                    $insert['submit_picnum'] = count($uploaded);
                    $sql->db_Insert("sgallery_submit", $insert);
                }
            }
            
            if(!empty($msg) && is_array($msg))
            $_SESSION['sessmsg'] = implode('<br />', $msg);
            sgal_sessmsg();

        }
        /* Delete Image Action */
        if(isset($_POST['delete']))
        {
            $tmp = array_keys($_POST['delete']);
            list($delete, $del_id) = explode("#", $tmp[0]);
            if($del_id) {
                $clactions = $sgalobj->loadObj('actions_class'); 
                $imagepath = SGAL_ALBUMPATH.$row['path']."/";
                if($tmp = $clactions->deleteImage($imagepath, $del_id, 'user')) {
                    if($tmp['msg']) {
                        $_SESSION['sessmsg'] = $tmp['msg'];
                    }
                    
                    if($tmp['status'] && $row['thsrc'] == $del_id) {
                       //main thumb pic is deleted!
                       $sql -> db_Update('sgallery', "thsrc='' WHERE album_id='{$id}'");
                       $_POST['thsrc'] = '';
                    }
                //to do - cache
                 
                }
                //redirect
                if(isset($_POST['send_open_ajax'])) {
                
                    //awaiting approval pic deleted
                    if($sgal_pref['sgal_usermod_picapprove'] && $_POST['send_open_ajax']=='pics_app') {

                        if($alstats['sgal_user_alawpicnumber'] > 1) {
                            $update = "submit_dt='".time()."', submit_ip='".$e107->getip()."', submit_picnum='".($alstats['sgal_user_alawpicnumber']-1)."'";
                            $sql -> db_Update("sgallery_submit", "{$update} WHERE submit_album_id='{$id}'");
                        } else {
                            $sql->db_Delete("sgallery_submit", "submit_album_id='{$id}' ");
                        }

                    }
                
                    $_SESSION['open_ajax'] = $_POST['send_open_ajax'];
                    unset($_POST['send_open_ajax']);
                }
                sgal_sessmsg();
            }
            unset($del_id, $tmp);
        }
        /* Update album metadata action */
        if(isset($_POST['sgal_mngdata_submit'])) {
            //form submitted
            $update['title'] = $tp -> toDB(trim($_POST['title']));
            $row['title'] = $tp -> post_toForm($_POST['title']);
            
            $update['album_description'] = $tp -> toDB(trim($_POST['album_description']));
            $row['album_description'] = $tp -> post_toForm($_POST['album_description']);
            
            if(isset($_POST['cat_id']) && check_class($sgal_pref['sgal_usermod_galleries'])) {
                $update['cat_id'] = $row['cat_id'] = intval($_POST['cat_id']);
            }
            
            if(!$row['title']) {
                mysgal_msg(SGAL_LANMNG_10);
            } else {
                $up = '';
                foreach ($update as $key=>$value) {
                	$up .= $up ? ", {$key}='{$value}'" : "{$key}='{$value}'";
                }
                
                $up = "{$up} WHERE album_id='{$id}'";
                $sql -> db_Update('sgallery', $up);
                mysgal_msg(SGAL_LANMNG_11);
            }
        }
        /* rethumb actions */
        if(isset($_POST['thumb'])) {
            $tmp = array_keys($_POST['thumb']);
            list($set_thumb, $thname) = explode("#", $tmp[0]);
            
            if($set_thumb == 'mainthumb' && $thname) {
                $clactions = $sgalobj->loadObj('actions_class'); 
                $imagepath = SGAL_ALBUMPATH.$row['path']."/";
                
                $clactions->checkPath($thname);
                
                $sql -> db_Update('sgallery', "thsrc='{$thname}' WHERE album_id='{$id}'");
                $row['thsrc'] = $thname;
                
                mysgal_msg(SGAL_LANMNG_11);
                
            } elseif($set_thumb == 'mainrethumb' && $thname) {
                $clactions = $sgalobj->loadObj('actions_class');
                //TO DO - improve thumb msgs
                $msg = $clactions->rethumbImage(SGAL_ALBUMPATH.$row['path'], $thname, $sgalobj, 1);

                mysgal_msg(SGAL_LANMNG_22);
            }
    
        }



        $clrender = $sgalobj->loadObj('render_class');
        
        // load form and images source
        //$row['title'] = $tp->toForm($row['title'], false, true);

        $parse_array['data_form_open'] = "<form method='post' action='".e_SELF."?".e_QUERY."' id='sgal_dataform'>";
        $parse_array['title_field'] = "<input type='text' value='{$row['title']}' id='title' name='title' size='80' style='width: 98%' maxlength='200' class='tbox mngr-text' />";
        require_once(e_HANDLER.'ren_help.php');
        
        $insertjs = (!e_WYSIWYG) ? " onselect='storeCaret(this);' onclick='storeCaret(this);' onkeyup='storeCaret(this);' ": "";
        $parse_array['description_field'] = "<textarea class='tbox mngr-area' style='width: 98%' id='album_description' name='album_description' cols='80' rows='16'{$insertjs}>{$row['album_description']}</textarea><br />".display_help("help", 'news');
        $parse_array['data_form_submit'] = "<input class='button' name='sgal_mngdata_submit' id='sgal_mngdata_submit' value='".SGAL_LANMNG_7."' type='submit' />";
        $parse_array['data_form_close'] = "</form>";

        $upload_form_pre = "<form method='post' action='".e_SELF."?".e_QUERY."' id='sgal_upform'".(FILE_UPLOADS ? " enctype='multipart/form-data'" : "").">";
        $upload_form_post = "</form>";
        
        //
        if(check_class($sgal_pref['sgal_upload_publishxp'])) {
            $tmp = array();
            $tmp1 = strpos($_SERVER['HTTP_USER_AGENT'], 'Windows NT 6') !== FALSE ? 'vista' : 'xp';
            $tmp['download_reg_file'] = "<a href='".SGAL_PUBLISH_ABS."publish.php?download_reg.auto'>".SGAL_LANMNG_28d." (".($tmp1 == 'vista' ? SGAL_LANMNG_28k : SGAL_LANMNG_28j).") [cl_gallery_{$tmp1}_install.reg]</a>";
            $tmp['download_xpreg_file'] = "<a href='".SGAL_PUBLISH_ABS."publish.php?download_reg.xp'>".SGAL_LANMNG_28d." [cl_gallery_xp_install.reg]</a>";
            $tmp['download_vistareg_file'] = "<a href='".SGAL_PUBLISH_ABS."publish.php?download_reg.vista'>".SGAL_LANMNG_28d." [cl_gallery_vista_install.reg]</a>";
            $parse_array['publishxp'] = $cltemplate = clSimpleParser($SGALLERY_MNG_TABLE_PUBLISHXP, $tmp);
            unset($tmp);
        }
        else 
            $parse_array['publishxp'] = '';
        
        $parse_array['upload_form'] = !$ulimit_error ? $upload_form_pre.$clrender -> adminUploadForm(SGAL_ALBUMPATH.$row['path'], 'user',".{$sgal_pref['sgal_restrict_w']}.{$sgal_pref['sgal_restrict_h']}.{$sgal_pref['sgal_w']}.{$sgal_pref['sgal_h']}").$upload_form_post : $ulimit_msg;
        
        //save some server resources here
        if($alstats['sgal_user_alpicnumber']) {
            $parse_array['image_and_actions'] = "
                <form method='post' action='".e_SELF."?".e_QUERY."#picform' id='sgal_picform'>
                <div>
                    <p id='picform' style='margin: 0px; padding: 0px'><a href='#' title='".SGAL_LANMNG_6."' onclick=\"show_info('{$row['album_id']}','album_pics','album_pinfo', '".$tp->toJS.(SGAL_LANRND_163)."'); return false;\">".SGAL_LANMNG_6."</a></p>
                    <input type='hidden' name='send_open_ajax' value='pics' />
                    <div id='album_pinfo_{$row['album_id']}' style='clear: both; width:100%; display: none; padding: 5px 0px'>
                        <div id='cont_{$row['album_id']}'></div>
                    </div>
                </div>
                </form>
            ";
            if(isset($_SESSION['open_ajax']) && $_SESSION['open_ajax'] == 'pics' || isset($_POST['thumb'])) {
                unset($_SESSION['open_ajax']);
                $parse_array['image_and_actions'] .= "
                    <script type='text/javascript'>
                        show_info('{$row['album_id']}','album_pics','album_pinfo', '".$tp->toJS.(SGAL_LANRND_163)."');
                    </script>
                ";
            }
        } else $parse_array['image_and_actions'] = SGAL_LANRND_122;
        
        if($alstats['sgal_user_alawpicnumber']){
            $parse_array['image_awaiting'] = "
                <form method='post' action='".e_SELF."?".e_QUERY."#picform_app' id='sgal_picform_app'>
                <div>
                    <p id='picform_app' style='margin: 0px; padding: 0px'><a href='#' title='".SGAL_LANMNG_6."' onclick=\"show_info('{$row['album_id']}','album_pics_approve','album_pinfo_approve', '".$tp->toJS.(SGAL_LANRND_163)."'); return false;\">".SGAL_LANMNG_6."</a></p>
                    <input type='hidden' name='send_open_ajax' value='pics_app' />
                    <div id='album_pinfo_approve_{$row['album_id']}' style='clear: both; width:100%; display: none; padding: 5px 0px'>
                        <div id='cont_app{$row['album_id']}'></div>
                    </div>
                </div>
                </form>
            ";
            if(isset($_SESSION['open_ajax']) && $_SESSION['open_ajax'] == 'pics_app') {
                unset($_SESSION['open_ajax']);
                $parse_array['image_awaiting'] .= "
                    <script type='text/javascript'>
                        show_info('{$row['album_id']}','album_pics_approve','album_pinfo_approve', '".$tp->toJS.(SGAL_LANRND_163)."');
                    </script>
                ";
            }
        } else $parse_array['image_awaiting'] = SGAL_LANRND_122;
        
        // simple parse it
        $cltemplate = $SGALLERY_MNG_TABLE_START.$SGALLERY_MNG_EDIT_BODY.$SGALLERY_MNG_TABLE_ULPOAD.$SGALLERY_MNG_TABLE_IMAGES.$SGALLERY_MNG_AWAITING_IMAGES.$SGALLERY_MNG_TABLE_END;
        $cltemplate = clSimpleParser($cltemplate, $parse_array);
        
        //template parse
        $sgal_param['action'] = 'uview';
        $sgal_param['cpage'] = 1; //current page
        $sgal_param['imgpage'] = 1; //current album page
        $sgal_param['max_wh'] = $sgal_pref['sgal_thumb_w'] > $sgal_pref['sgal_thumb_h'] ? $sgal_pref['sgal_thumb_w'] : $sgal_pref['sgal_thumb_h'];
        $sgal_param['sgal_breadc'] = $bread_pre."<a href='".SGAL_PATH."gallery.php'>".PAGE_BREADC_HOME."</a>".SGAL_BREADC_CHAR."<a href='".SGAL_PATH_ABS."gallery.php?ulist.0.{$cpage}'>".SGAL_LAN_16."</a>".SGAL_BREADC_CHAR."<a href='".SGAL_PATH_ABS."gallery.php?ulist.".USERID.".1'>".USERNAME."</a>".SGAL_BREADC_CHAR.SGAL_MANAGER_PNAME;
        
        cachevars('c_sgal_item', $row);
		cachevars('c_sgal_param', $sgal_param);
        $pagesrc .= $tp->parseTemplate($cltemplate,TRUE,$sgal_shortcodes);
        unset($clrender);
    } elseif($action == 'create') {

        if(!check_class($sgal_pref['sgal_usermod_albumcreate'])) {
            require_once(HEADERF);
            mysgal_msg(SGAL_LAN_20);
            require_once(FOOTERF);
            exit;
        }
        
        // Wysiwyg JS support on or off.
        require_once(HEADERF);
                
        // Init data arrays
        $parse_array = array();
        $sgal_param = array();
        
        //after-redirect messages
        if($SYSMSG) echo $SYSMSG;
        
        //shortcodes
        require_once(SGAL_INCPATH."sgal_batch.php");
        
        //load user stats
        $tp->parseTemplate('{SGAL_USER_MYSTATS}', FALSE, $sgal_shortcodes); 
        
        $tstats = getcachedvars('sgal_useritem');
        $tmp = getcachedvars('sgal_useritem_'.USERID);
        $alstats = $tmp[$id];
        unset($tmp);
        
        //user limits
        if($sgal_pref['sgal_usermod_albumcount'] && $tstats['sgal_user_albumnumber'] >= $sgal_pref['sgal_usermod_albumcount']) {
            mysgal_msg(SGAL_LANMNG_23."<br />".SGAL_LANMNG_24."<br /><a href='".SGAL_PATH_ABS."gallery.php?ulist.".USERID."'>".SGAL_LAN_18."</a>");
            require_once(FOOTERF);
            exit;
        }
        $row = array();
        $insert = array();
        /* Update album metadata action */
        if(isset($_POST['sgal_mngcreate_submit'])) {
            //form submitted
            $insert['title'] = $tp -> toDB(trim($_POST['title']));
            $row['title'] = $tp -> post_toForm($_POST['title']);
            
            $insert['album_description'] = $tp -> toDB(trim($_POST['album_description']));
            $row['album_description'] = $tp -> post_toForm($_POST['album_description']);

            
            $insert['dt'] = time();
            $insert['active'] = 1;
            $insert['sgal_user'] = USERID.'.'.USERNAME;
            $insert['album_ustatus'] = $sgal_pref['sgal_usermod_albumcreate_approve'] ? 0 : 1;
            
            if(isset($_POST['cat_id']) && check_class($sgal_pref['sgal_usermod_galleries'])) {
                $insert['cat_id'] = $row['cat_id'] = intval($_POST['cat_id']);
            }
            
            if(!$row['title']) {
                mysgal_msg(SGAL_LANMNG_10);
            } else {               
                //check insert id, create dir, redirect
                $inserted_id = $sql->db_Insert("sgallery", $insert);
                if($inserted_id) {
                    $clactions = $sgalobj -> loadObj('actions_class');
                    $uniq_str = $clactions -> uniq_str();
                    if($uniq_str && !is_dir(SGAL_ALBUMPATH.$uniq_str) && mkdir(SGAL_ALBUMPATH.$uniq_str, 0777)) {
                        if($sql->db_Update("sgallery", "path='{$uniq_str}' WHERE album_id='{$inserted_id}' ")) {
                        
                            include_lan(e_PLUGIN.'sgallery/languages/'.e_LANGUAGE.'_enotify.php');
                            $ntdata = array();
                            $categoryid = 0;
                            if($insert['cat_id']) {
                                if($sql -> db_Select('sgallery_cats', 'title as ctitle', "cat_id='{$insert['cat_id']}'")) {
                                    $tmp = $sql -> db_Fetch();
                                    $categoryid = $insert['cat_id'];
                                    $categoryname = $tmp['ctitle'];
                                }
                            }
                            $ntdata[] = SGAL_NOTIFY_2.": ".USERNAME." [#".USERID."] | ".$e107->getip()."<br />";
                            $ntdata[] = SGAL_NOTIFY_8.': '.$_POST['title'];
                            if($categoryid) $ntdata[] = SGAL_NOTIFY_12.': '.$categoryname.'<br />'.SGAL_NOTIFY_13.': [url='.SITEURL.$PLUGINS_DIRECTORY.'sgallery/gallery.php?list.'.$categoryid.']'.SITEURL.$PLUGINS_DIRECTORY.'sgallery/gallery.php?list.'.$categoryid.'[/url]';
                            $ntdata[] = SGAL_NOTIFY_10.': [url='.SITEURL.$PLUGINS_DIRECTORY.'sgallery/gallery.php?uview.'.$inserted_id.']'.SITEURL.$PLUGINS_DIRECTORY.'sgallery/gallery.php?uview.'.$inserted_id.'[/url]';
                            
                            $e_event -> trigger("sgal_albumsbm", $ntdata);
                            
                            $_SESSION['sessmsg'] = SGAL_LANMNG_25.( $sgal_pref['sgal_usermod_albumcreate_approve'] ? '<br />'.SGAL_LANMNG_26 : '' );
                            sgal_sessmsg(e_SELF."?edit.".$inserted_id);
                        }
                        rmdir(SGAL_ALBUMPATH.$uniq_str);
                    }
                }
                
                mysgal_msg(SGAL_LANMNG_27);
            }
        } else {
            $row['title'] = '';
            $row['album_description'] = '';
            $row['cat_id'] = '';
        }   
        
        $parse_array['data_form_open'] = "<form method='post' action='".e_SELF."?".e_QUERY."' id='sgal_dataform'>";
        $parse_array['title_field'] = "<input type='text' value='{$row['title']}' id='title' name='title' style='width: 98%' size='80' maxlength='200' class='tbox mngr-text' />";
        require_once(e_HANDLER.'ren_help.php');
        //not checked yet ?
        
        
        $insertjs = (!e_WYSIWYG) ? " onselect='storeCaret(this);' onclick='storeCaret(this);' onkeyup='storeCaret(this);' ": "";
        $parse_array['description_field'] = "<textarea class='tbox mngr-area' style='width: 98%' id='album_description' name='album_description' cols='80' rows='6'{$insertjs}>{$row['album_description']}</textarea><br />".display_help("help", 'news');
        $parse_array['data_form_submit'] = "<input class='button' name='sgal_mngcreate_submit' id='sgal_mngdata_submit' value='".SGAL_LANMNG_7."' type='submit' />";
        $parse_array['data_form_close'] = "</form>";  
        
        // simple parse it
        $cltemplate = $SGALLERY_MNG_TABLE_START.$SGALLERY_MNG_CREATE_BODY.$SGALLERY_MNG_TABLE_END;
        $cltemplate = clSimpleParser($cltemplate, $parse_array);
        
        //template parse
        $sgal_param['action'] = 'uview';
        $sgal_param['cpage'] = 1; //current page
        $sgal_param['imgpage'] = 1; //current album page
        $sgal_param['max_wh'] = $sgal_pref['sgal_thumb_w'] > $sgal_pref['sgal_thumb_h'] ? $sgal_pref['sgal_thumb_w'] : $sgal_pref['sgal_thumb_h'];
        $sgal_param['sgal_breadc'] = $bread_pre."<a href='".SGAL_PATH."gallery.php'>".PAGE_BREADC_HOME."</a>".SGAL_BREADC_CHAR."<a href='".SGAL_PATH_ABS."gallery.php?ulist.0.{$cpage}'>".SGAL_LAN_16."</a>".SGAL_BREADC_CHAR."<a href='".SGAL_PATH_ABS."gallery.php?ulist.".USERID.".1'>".USERNAME."</a>".SGAL_BREADC_CHAR.SGAL_MANAGER_CREATE;
        
        cachevars('c_sgal_item', $row);
		cachevars('c_sgal_param', $sgal_param);
        $pagesrc .= $tp->parseTemplate($cltemplate,TRUE,$sgal_shortcodes);
        unset($clrender); 
    }
    
    
    
    $sql->db_Mark_Time('End: CL sgal_manage');
    
    
    $pagesrc = "<div id='sgal_manage'>{$pagesrc}</div>";
    if($sgal_pref['sgal_tblrender']) 
        $ns->tablerender($title, $pagesrc, 'sgal_manage');
    else
        echo $pagesrc;
        
    require_once(FOOTERF);
    exit;
    
    // functions ------------------------>
    function sgal_sessmsg($loc='') {
        session_write_close();
        header("Location: ".($loc ? $loc : e_SELF.(e_QUERY ? '?'.e_QUERY: '')));
        exit;
    }
    
    function mysgal_msg($msg='', $return=false) {
        global $sgal_pref, $ns;
        if(!$msg) return '';
        if($return) {
            return $sgal_pref['sgal_tblrender'] ? $ns->tablerender(SGAL_PAGE_NAME, "<div style='text-align:center'><strong>".$msg."</strong></div>", 'sgal_manage_sysmsg', true) : $msg;
        }
        if($sgal_pref['sgal_tblrender']) $ns->tablerender(SGAL_PAGE_NAME, "<div style='text-align:center'><strong>".$msg."</strong></div>", 'sgal_manage_sysmsg');
        else echo $msg;
    }
?>