<?php
/*
+ ----------------------------------------------------------------------------------------------------+
|        e107 website system 
|        Administration Class: e107_plugins/sgallery/includes/sgal_admin_class.php
|        Email: m.yovchev@clabteam.com
|        $Revision: 768 $
|        $Date: 2008-09-18 11:57:24 +0300 (Thu, 18 Sep 2008) $
|        $Author: secretr $
|	     Copyright Corllete Lab ( http://www.clabteam.com )
|        Free Support: http://dev.e107bg.org/
+----------------------------------------------------------------------------------------------------+
*/
if (!defined('e107_INIT')) { exit; }

class sgal_admin_class {

    var $_systype = '';
    var $_sysmsg = '';

    function showAlbums($sub_action, $cpage)
    {
        // ##### Display categories ---------------------------------------------------------------------------------------------------------
        /*  */
        global $ns, $sql, $fl, $sgal_pref, $th, $tp, $action;

        $where = '';
        $tbls = '';
        if(isset($_SESSION['album_category']) && $_SESSION['album_category']) {
           if(is_numeric($_SESSION['album_category'])) {
                $where = "WHERE a.cat_id='".$_SESSION['album_category']."' ";
           } else {
                $where = "WHERE a.sgal_user='".$_SESSION['album_category']."' ";
           }
        }
        
        if($sub_action == 'submitted') {
            $pictest = $sql->db_Count('sgallery_submit','(*)',"WHERE submit_picnum>0");
            if($pictest) {
                $where = " WHERE a.album_ustatus='0' OR (a.album_ustatus='1' AND s.submit_picnum>0 AND s.submit_album_id=a.album_id) GROUP BY a.album_id ";
                $tbls = ", ".MPREFIX.SGAL_STABLE." AS s";
            } else {
                $where = " WHERE a.album_ustatus='0'";
            }
        } else {
            $where .= $where ? " AND a.album_ustatus='1'" : " WHERE a.album_ustatus='1'";
        }

        e107_include_once(SGAL_INCPATH.'pp.class.php');
        $pp = new cl_pp;

        $perPage = $sgal_pref['sgal_admin_albums'];
        $pageNum = $sgal_pref['sgal_pagenum'];

        $pp->pp_Config($perPage, $pageNum);

        //paginating - page limit
        if($where) {
            if($sub_action == 'submitted') {
                $albums = 0;
                if($sql->db_Select(SGAL_MTABLE." AS a{$tbls}", "1 as cnt", " $where", 'nowhere' )){
                    while ($result = $sql -> db_Fetch()) {
                    	$albums += $result['cnt'];
                    }
                }
            } else
                $albums = $sql->db_Count(SGAL_MTABLE." AS a{$tbls}", "(*)", " $where" );
        }
        else $albums = $sql->db_Count("sgallery");
        $limit = ' '.$pp -> pageLimit($albums, $cpage);
        $fltr_ttl = '';
        //# ------ categories ---------------------------------------
        if($sql->db_Select("sgallery_cats", "*", "ORDER BY cat_order ASC", 'nowhere' )) {

           $row = $sql -> db_getList();

           $catselect = "<select class='tbox' name='album_category' onchange='this.form.submit()'>";
           $catselect .= "<option value='0'>".SGAL_LANADM_13."</option>\n";
           $cnt = count($row);
           
           $catselect .= "<optgroup label='-- ".SGAL_LANADM_62." --'>\n"; 
           foreach ($row as $value)
           {
               //category cash
               $selected = '';
               $categories[$value['cat_id']]['title'] = $value['title'];
               $categories[$value['cat_id']]['active'] = $value['active'];
               if($value['cat_id'] == $_SESSION['album_category']) {
                    $selected = " selected='selected'";
                    $fltr_ttl = SGAL_LANADM_60." {$value['title']}";
               }
               $catselect .= "<option value='".$value['cat_id']."'{$selected}>".$value['title']."</option>\n";

           }
           $catselect .= "</optgroup>\n"; 
           
           if($sql->db_Select("sgallery", "DISTINCT sgal_user", "sgal_user!='' ORDER BY dt DESC" )) {
               $catselect .= "<optgroup label='-- ".str_replace(array("'", '"'), array('&#039;', '&quot;'), SGAL_LANADM_12a)." --'>\n"; 
               while($urow = $sql->db_Fetch()) {
                   $selected = '';
                   $udata = explode('.', $urow['sgal_user']);
                   if($urow['sgal_user'] == $_SESSION['album_category']) {
                        $selected = " selected='selected'";
                        $fltr_ttl = SGAL_LANADM_59." &quot;{$udata[1]}&quot;";
                   }
                   $catselect .= "<option value='".$urow['sgal_user']."'{$selected}>".$udata[1]."</option>\n";
               }
               $catselect .= "</optgroup>\n"; 
           }
           
           $catselect .= "</select>";
        } else {
           $catselect = '';
           $categories = false;
        }

        if(!$fltr_ttl) $fltr_ttl = SGAL_LANADM_49;
        $text = "<div style='margin-left: auto; margin-right: auto'>
        <form method='post' action='".e_SELF.(e_QUERY ? '?'.e_QUERY : '')."' id='dataform'>
        <table style='width: 99%;margin-left: auto; margin-right: auto; text-align: center' class='fborder'>
         ";

         //category menu
         $text .= "
         <tr>
         <td style='width:100%; text-align: left' colspan='3' class='forumheader'>
            <div style='float: right'>".($sub_action != 'submitted' ? $catselect : '')."</div>
            &nbsp;<strong>".SGAL_LANADM_48."</strong>: <em>".$fltr_ttl."</em> </td>
         </tr>";

        if ($sql->db_Select(SGAL_MTABLE." AS a{$tbls}", "*", $where."ORDER BY a.dt DESC{$limit}", 'nowhere' ))
        {
            $alarray = $sql -> db_getList();

            $text .= "
            <tr>
            <td style='width:40%;text-align:center' class='fcaption'>[ID] ".SGAL_LANADM_14."</td>
            <td style='width:40%;text-align:center' class='fcaption'>".SGAL_LANADM_15."</td>
            <td style='width:20%;text-align:center;' class='fcaption'>".SGAL_LANADM_16."</td>
            </tr>";

            foreach($alarray as $row)
            {
                $imagepath = SGAL_ALBUMPATH.$row['path']."/";

                $main_thumb = "";
                $add = '';
                $imagelist = $fl -> sgal_pics($imagepath, $sgal_pref);
                $thumbs = $imagelist ? count($imagelist) : 0;
                                
                $cfg = array();
                $cfg['w'] = 40;
                $cfg['h'] = 30;
                $cfg['far'] = 'C';
                $cfg['bg'] = $sgal_pref['sgal_bg'];
                $cfg['fltr'][] = 'bord|1|0|0|C0C0C0';
                
                if($row['thsrc'] && is_file($imagepath.$row['thsrc'])) {
                    $main_thumb = "<img src='".showThumb($row['path'].'/'.$row['thsrc'], $cfg)."' alt='".$row['thsrc']."' style='border: 0px none;' />";
                } else {
                    $main_thumb = "<img src='".SGAL_IMAGES_ABS."gallery_40.png' alt='' style='border: 0px none; width: 40px; height: 30px' />";
                }
                
                //if no images - chechk the status and update if needed - fix v1.2-> only when not user album
                if($sub_action != 'submitted' && !$thumbs && $row['active'] && (!$row['sgal_user'] || $row['album_ustatus'])) {
                     $sql->db_Update('sgallery', "active='0' WHERE album_id='".$row['album_id']."'");
                     $row['active'] = 0;
                }
                
                if($sub_action == 'submitted') {
                    $show_js = "show_info({$row['album_id']},'album_approve.view','album_papprove', '".SGAL_LANADM_163."')";
                    $admoptions =  "<a href='#' title='".SGAL_LANADM_17a."' onclick=\"{$show_js}; return false;\"><img src='".SGAL_IMAGES_ABS."gallery_16.png' alt='".SGAL_LANADM_17a."' style='border: 0px none ; vertical-align: top; width: 16px; height: 16px;' /></a>&nbsp;";
                    
                    $appimg = "<img src='".($row['album_ustatus'] ? SGAL_IMAGES_ABS."checkmark_16.gif" : SGAL_IMAGES_ABS."checkmark_na_16.gif" )."' alt='".($row['album_ustatus'] ? SGAL_LANADM_54 : SGAL_LANADM_53 )."' style='border: 0px none ; vertical-align: top; width: 16px; height: 16px;' />";
                    
                    $admoptions .= "<a href='".e_SELF."?submitted.album_approve.".$row['album_id'].".{$cpage}' title='".($row['album_ustatus'] ? SGAL_LANADM_53.' - '.SGAL_LANADM_54 : SGAL_LANADM_53.' - '.SGAL_LANADM_53a)."' style='border:0px none;'>{$appimg}</a>&nbsp;";
                    $admoptions .= "<a href='".e_SELF."?submitted.edit.".$row['album_id'].".{$cpage}' style='border:0px none;'>".ADMIN_EDIT_ICON."</a>&nbsp;";
                    $admoptions .= "<input type='image' title='".LAN_DELETE."' name='delete[main#".$row['album_id']."]' src='".ADMIN_DELETE_ICON_PATH."' onclick=\"return jsconfirm('".SGAL_LANADM_104a." [ID: ".$row['album_id']."]. ".SGAL_LANADM_104b."')\"/>&nbsp;";
                    $contid = 'papprove_'.$row['album_id'];
                    $add = '<br /><strong>'.SGAL_LANADM_55. ':</strong> ' . (!$row['album_ustatus'] ?  SGAL_ALBUM.($row['submit_picnum'] ? " &amp; {$row['submit_picnum']} ".SGAL_PICTUREORS : '') : ($row['submit_picnum'] ? "{$row['submit_picnum']} ".SGAL_PICTUREORS : 'n/a') );
                } else {
                    $show_js = "show_info({$row['album_id']},'album_pics','album_pinfo', '".SGAL_LANADM_163."')";
                    $admoptions =  "<a href='#' title='".SGAL_LANADM_17."' onclick=\"show_info({$row['album_id']},'album_pics','album_pinfo', '".SGAL_LANADM_163."'); return false;\"><img src='".SGAL_IMAGES_ABS."gallery_16.png' alt='".SGAL_LANADM_17."' style='border: 0px none ; vertical-align: top; width: 16px; height: 16px;' /></a>&nbsp;";
                    $admoptions .= "<a href='".e_SELF."?main.chstat.".$row['album_id'].".{$cpage}' title='".($row['active'] ? SGAL_LANADM_18 : SGAL_LANADM_19 )."' style='border:0px none;'><img src='".($row['active'] ? SGAL_IMAGES_ABS."checkmark_16.gif" : SGAL_IMAGES_ABS."checkmark_na_16.gif" )."' alt='".($row['active'] ? SGAL_LANADM_18 : SGAL_LANADM_19 )."' style='border: 0px none ; vertical-align: top; width: 16px; height: 16px;'".(!$thumbs && !$row['active'] &&  !$row['sgal_user'] ? "onclick=\"alert('".SGAL_LANADM_103."'); return false;\"" : '' )." /></a>&nbsp;";
                    $admoptions .= "<a href='".e_SELF."?main.edit.".$row['album_id'].".{$cpage}' style='border:0px none;'>".ADMIN_EDIT_ICON."</a>&nbsp;";
                    $admoptions .= "<input type='image' title='".LAN_DELETE."' name='delete[main#".$row['album_id']."]' src='".ADMIN_DELETE_ICON_PATH."' onclick=\"return jsconfirm('".SGAL_LANADM_104a." [ID: ".$row['album_id']."]. ".SGAL_LANADM_104b."')\"/>&nbsp;";
                    $contid = 'pinfo_'.$row['album_id'];
                    $add = " <a href='".SGAL_PATH_ABS."gallery.php?".($row['cat_id'] ? "view" : "uview" ).".{$row['album_id']}' rel='external'>[".SGAL_VIEW."]</a>";
                    
                }
                
                $main_thumb = "
                <div style='float: left; margin: 0px 3px'>
                    <a href='#' onclick=\"{$show_js}; return false;\" title='".str_replace(array("'", '"', '<', '>'), array('&#039;', '&quot;', '&lt;', '&gt;'), ($sub_action == 'submitted' ? SGAL_LANADM_17a : SGAL_LANADM_17))."'>
                        {$main_thumb}
                    </a>
                </div>";
                
                $tmpcat = $categories[$row['cat_id']] ? ( $categories[$row['cat_id']]['active'] ? $categories[$row['cat_id']]['title'] : $categories[$row['cat_id']]['title']." <strong>[".SGAL_LANADM_18a."]</strong>") : SGAL_LANADM_128;
                $us = '';
                if($row['sgal_user']) {
                    $u = explode('.',$row['sgal_user']);
                    $tmpcat .= "<br /><em>".SGAL_LANADM_14b.":</em> <strong>[<a href='".SITEURL."user.php?id.{$u[0]}'>{$u[1]}</a>]</strong>";
                }
                
                $text .= "<tr>
                <td style='width:40%; text-align:left; line-height: 130%; vertical-align: middle' class='forumheader3'>
                    {$main_thumb}<strong>[".$row['album_id']."]</strong> ".($row['title'] ? $tp->toHTML($row['title']) : "[".SGAL_LANADM_20."]")."{$add}
                    <div id='album_{$contid}' style='clear: both; width:100%; display: none; padding: 5px 0px'><div id='cont_{$row['album_id']}'></div></div>
                </td>
                <td style='width:40%; text-align:left; vertical-align: top' class='forumheader3'>$tmpcat</td>
                <td style='width:20%; text-align:center; vertical-align: top' class='forumheader3'>$admoptions</td>
                </tr>";

            }

            //page navigation
            $text .= "</table>
            </form></div>
            <div style='width: 99%; margin-left: auto; margin-right: auto; margin-top: 5px'><div style='text-align: right;'>
            ";

            $text .= $pp -> pageNav($albums, $cpage, "{$action}.0.0");

            $text .= "
            </div>
            </div>
            ";

        }
        else { // no result

          $text .= "<tr><td style='text-align:center' colspan='3' class='forumheader3'>".($sub_action == 'submitted' ? SGAL_LANADM_102a : SGAL_LANADM_102)."</td></tr></table></form></div>";

        }


        $this->show_message();
        $ns->tablerender (($sub_action=='submitted' ? SGAL_LANADM_12c : SGAL_LANADM_8), $text);
    }

    function createAlbum($id, $action='main')
    {
        // ##### Display album creation form ---------------------------------------------------------------------------------------------------------
        /*  */
        global $sgalobj, $ns, $sql, $fl, $sgal_pref, $th, $tp, $THCONFIG_THDEF, $rs, $row, $p;
        $text = "<div style='margin-left: auto; margin-right: auto'>
        <form method='post' action='".e_SELF."?".e_QUERY."' id='gal_dataform' style='margin: 0px; padding: 0px'".(FILE_UPLOADS ? " enctype='multipart/form-data'" : "").">
        <table style='width: 99%; text-align: center;' class='fborder'>
         ";
        // replace old global $cal
        $frm = e107::getForm();
        //find categories
        if($sql->db_Select("sgallery_cats", "*", "ORDER BY cat_order ASC", 'nowhere')) {

           $row = $sql -> db_getList();

           $catselect = "<select class='tbox' name='cat_id'>";
           $catselect .= "<option value='0'>".LAN_SELECT."</option>\n";
           $cnt = count($row);
           foreach ($row as $value)
           {
               //category cash
               $categories[$value['cat_id']]['title'] = $value['title'];
               $categories[$value['cat_id']]['active'] = $value['active'];

               $selected = ($value['cat_id'] == $_POST['cat_id']) ? " selected='selected'" : '';
               $catselect .= "<option value='".$value['cat_id']."'{$selected}>".$value['title']."</option>\n";

           }
           $catselect .= "</select>";
        } else {
           $catselect = '';
           $categories = false;
        }

        $imagepath = SGAL_ALBUMPATH.$_POST['path']."/";

        //only if the album is already inserted in the db
        if(($categories && $id) || $action == 'submitted')
        {             
              //approve screen
              if($action == 'submitted') {
                  $text .= "<tr>
                  <td style='width:100%; text-align: center' colspan='2' class='fcaption'>".SGAL_LANADM_55."</td>
                  </tr>";
                  // -------- Show Image ---------------------------
                  //<a href='#' style='cursor: pointer; cursor: hand' onclick=\"show_info({$id},'album_approve','album_papprove', '".SGAL_LANADM_163."'); return false;\">".SGAL_LANADM_55."</a>
                  $text .= "<tr>
                  <td colspan='2' style='vertical-align: top; text-align: left' class='forumheader3'>
                    <div id='album_papprove_{$id}' style='clear: both; width:100%; display: none; padding: 5px 0px'><div id='cont_app{$id}'></div></div>
                  ";
    
                  //ajax load

                  $text .= "
                    <script type='text/javascript'>
                        show_info({$id},'album_approve.edit','album_papprove', '".SGAL_LANADM_163."');
                    </script>
                  ";
                  $text .= "</td></tr>";
    
                  // -------- End Show Image ---------------------------
              
              }
              else {
                  //# --- Pictures -------------------------------------------------------
                  $robj = $sgalobj->loadObj('render_class');
                  $text .= "<tr>
                  <td style='width:100%; text-align: center' colspan='2' class='fcaption'>".SGAL_LANADM_22."</td>
                  </tr>";
    
                  // -------- Start Upload Image ---------------------
                  $text .= "
                  <tr>
                  <td style='width:20%; vertical-align: top; text-align: left' class='forumheader3'>".LAN_UPLOAD_IMAGES.": </td>
                  <td style='width:80%; text-align: left; vertical-align: top' class='forumheader3'>
                  <a style='cursor: pointer; cursor: hand' onclick='expandit(this);'>".SGAL_LANADM_24."</a>
                  <div id='upl' style='display: ".(isset($_POST['rethumb']) || isset($_POST['thumb']) || isset($_POST['delete']) || isset($_POST['submitupload']) ? 'block' : 'none').";'>";
    
                  $text .= $robj->adminUploadForm($imagepath);
    
                  $text .= "
                  </div>
                  </td>
                  </tr>
                  ";
                  // -------- End Upload Image ---------------------
              }
              


              // -------- Show Image ---------------------------

              $text .= "<tr>
              <td style='width:20%; vertical-align: top; text-align: left' class='forumheader3'>".SGAL_LANADM_33.($action == 'submitted' ? ' ('.SGAL_APPROVED.')' : '').": </td>
              <td style='width:80%; text-align: left; vertical-align: top' class='forumheader3'>
              
              <a href='#' style='cursor: pointer; cursor: hand' onclick=\"show_info({$id},'album_editpics','album_editpics', '".SGAL_LANADM_163."'); return false;\">".SGAL_LANADM_34.($action == 'submitted' ? ' ('.SGAL_APPROVED.')' : '')."</a>
              <div id='album_editpics_{$id}' style='clear: both; width:100%; display: none; padding: 5px 0px'><div id='cont_{$id}'></div></div>
              ";

              //ajax load when needed
              if( (isset($_POST['rethumb']) || isset($_POST['thumb']) || isset($_POST['delete']) || isset($_POST['submitupload'])) && $action != 'submitted' ) {
                $text .= "
                    <script type='text/javascript'>
                        show_info({$id},'album_editpics','album_editpics', '".SGAL_LANADM_163."');
                    </script>
                ";
              }
              $text .= "</td></tr>";

              // -------- End Show Image ---------------------------
        }

        $text .= "<tr>
        <td style='width:100%; text-align: center' colspan='2' class='fcaption'>".SGAL_LANADM_37."</td>
        </tr>";

        //#-------- category menu --------------------------------


        if(!$categories && $action != 'submitted') {
            $text .= "<tr>
            <td style='width:100%; text-align: center' colspan='2' class='forumheader3'><span class='redtxt'>".SGAL_LANADM_108."</span></td>
            </tr></table></form></div>";


        } else {
            $text .= "<tr>
            <td style='width:20%; text-align: left' class='forumheader3'>".SGAL_LANADM_38.":</td>
            <td style='width:80%; text-align: left' class='forumheader3'>
             $catselect
            </td>
            </tr>";

            //#-------- category menu --------------------------------


            // -------- member ---------------------
            $uid = 0;
            $uname = '';
            
            if($id && $_POST['sgal_user']) {
                $u = explode('.',$_POST['sgal_user']);
                $uid = $u[0];
                $uname = $u[1];
            }    

            $ubox = $rs->form_select_open('sgal_user')."\n";
            $ubox .= $rs->form_option('- '.SGAL_LANADM_52.' -', (!$_POST['sgal_user']), '');
            if($sql->db_Select("user", "*")) {
            	while ($urow = $sql->db_Fetch()) {
            	   $ubox .= $rs->form_option("{$urow['user_loginname']} - {$urow['user_name']}".($urow['user_ban'] > 0 ? ' ['.SGAL_LANADM_51.']' : ''), ("{$uid}.{$uname}" == "{$urow['user_id']}.{$urow['user_name']}"), "{$urow['user_id']}.{$urow['user_name']}");
            	}
            }
            $ubox .= $rs->form_select_close();
            
            $text.=" 
    		<tr>
    		<td style='width:20%; text-align: left; vertical-align: top' class='forumheader3'>".SGAL_LANADM_14b.":</td>
    		<td style='width:80%; text-align: left;' class='forumheader3'>
                $ubox
            </td>
            </tr>
            ";
            // -------- member end ---------------------


            // -------- title ---------------------

             $text .= "
             <tr>
             <td style='width:20%; text-align: left' class='forumheader3'>".SGAL_LANADM_14.":</td>
             <td style='width:80%; text-align: left' class='forumheader3'>
             <input class='tbox' type='text' name='title' size='80' value='".$tp->post_toForm($_POST['title'])."' maxlength='200' style='width:98%' />
             </td>
             </tr>
             ";
            // -------- title end ---------------------
            
            // -------- description ---------------------
            $insertjs = (!e_WYSIWYG) ? "onselect='storeCaret(this);' onclick='storeCaret(this);' onkeyup='storeCaret(this);' ": "";
            $text .= "
            <tr>
            <td style='width:20%; text-align: left; vertical-align: top' class='forumheader3'>".SGAL_LANADM_14a.":</td>
            <td style='width:80%; text-align: left' class='forumheader3'>

                ".$rs->form_textarea("album_description", 80, 15, $_POST['album_description'], $insertjs, 'width: 98%')."
                ".display_help("helpb", 'body')."

            </td>
            </tr>
            ";
            // -------- description end ---------------------

            // -------- Activate ---------------------
            $isactive = !isset($_POST['active']) || !empty($_POST['active']) ? 1 : 0;

            $text .="
            <tr>
            <td style='width:20%; text-align: left;' class='forumheader3'>".SGAL_LANADM_39.":</td>
            <td style='width:80%; text-align: left;' class='forumheader3'>
            <input type='radio' name='active' value='1' id='activate'".($isactive == 1 ? ' checked="checked"' : '')." />
            <label for='activate'>".SGAL_LANADM_19a."</label>
            &nbsp;&nbsp;&nbsp;
            <input type='radio' name='active' value='0' id='notactive'".($isactive == 0 ? ' checked="checked"' : '')." />
            <label for='notactive'>".SGAL_LANADM_18a."</label>
            </td>
            </tr>
            ";
            // -------- end of activate ---------------------
            $stayb = '';
            if($action != 'submitted') {
                // -------- datestamp ---------------------
                $dstamp = ($_POST['dt'] > 0) ? date("d/m/Y H:i:s", $_POST['dt']) : date("d/m/Y H:i:s", time());
                
        		$cal_options['firstDay'] = 0;
        		$cal_options['showsTime'] = true;
        		$cal_options['showOthers'] = true;
        		$cal_options['weekNumbers'] = false;
        		$cal_options['ifFormat'] = "%d/%m/%Y %H:%M:%S";
        		$cal_options['timeFormat'] = "24";
        		$cal_attrib['class'] = "tbox";
        		$cal_attrib['size'] = "25";
        		$cal_attrib['onfocus'] = "this.blur()";
        		$cal_attrib['name'] = "calendar";
        		$cal_attrib['value'] = $dstamp;
                
                $update_checked = ($_POST['update_datestamp']) ? " checked='checked'" : "";
                
                $text .="
                <tr>
                <td style='width:20%; text-align: left; vertical-align: top' class='forumheader3'>".LAN_DATE.":</td>
                <td style='width:80%; text-align: left;' class='forumheader3'><div>";
                //".$cal->make_input_field($cal_options, $cal_attrib)."
                $text .= $frm->datepicker("calendar", $dstamp,"type=datetime&size=xx-large");
                $text .="<br />
                <input type='checkbox' value='1' id='update_datestamp' name='update_datestamp'{$update_checked} />
                <label for='update_datestamp'>".SGAL_LANADM_40."</label>
                </div>
                </td>
                </tr>";
                // -------- end of datestamp ---------------------
    
                if(!isset($_POST['stay'])) $_POST['stay'] = !$id ? 2 : 0;
                $stayb = ' '.ECLI_LANADM_133.': '.$rs->form_radio('stay', '0', $_POST['stay']=='0')." <label for='stay0'>".ECLI_LANADM_136."</label>".$rs->form_radio('stay', '1', $_POST['stay']=='1')." <label for='stay1'>".($id ? ECLI_LANADM_134 : ECLI_LANADM_135)."</label>";
                if(!$id) {
                    $stayb .= ' '.$rs->form_radio('stay', '2', (integer)$_POST['stay']==2)." <label for='stay2'>".ECLI_LANADM_134."</label>";
                }
            }
            $text .= "<tr>
            <td style='text-align:center' colspan='2' class='forumheader3'>
            <input type='hidden' name='album_id' value='".$id."' />
            <input type='hidden' name='path' value='".varset($_POST['path'],'')."' />
            ".($action == 'submitted' ? "<label for='sgal_send_notify'>".SGAL_LANADM_61."&nbsp;</label><input type='checkbox' name='sgal_send_notify' id='sgal_send_notify' value='1' style='margin: 0px; padding: 0px' />" : '')."
            {$stayb}&nbsp;&nbsp;<input class='button' type='submit' name='submit_album' value='".($action != 'submitted' ? LAN_SAVE : SGAL_APPROVE)."' />
            &nbsp;&nbsp;<input class='button' type='button' name='cancel' value='".LAN_CANCEL."' onclick=\"document.location.href='".e_SELF."?{$action}.0.0.{$p}'\" />
            </td>
            </tr>
            ";

            $text .= '</table></form></div>';
        }


        $ttl = $id ? SGAL_LANADM_41 : SGAL_LANADM_42 ;
        $this->show_message();
        $ns->tablerender ($ttl, $text);
    }

    function showCats($sub_action, $cpage)
    {
        // ##### Display categories ---------------------------------------------------------------------------------------------------------
        /*  */
        global $ns, $sql, $fl, $sgal_pref, $th, $tp;

        e107_include_once(SGAL_INCPATH.'pp.class.php');
        $pp = new cl_pp;

        $perPage = 20;//$sgal_pref['sgal_admin_albums'];
        $pageNum = $sgal_pref['sgal_pagenum']; //dobre e da e nechetno chislo

        $pp->pp_Config($perPage, $pageNum);

        //paginating - page limit
        $cats = $sql->db_Count("sgallery_cats");
        $limit = ' '.$pp -> pageLimit($cats, $cpage);

        if($sub_action == 'order') $limit = '';

        $text = "<div style='margin-left: auto; margin-right: auto'>
        <form method='post' action='".e_SELF."?".e_QUERY."' id='dataform'>
        <table align='center' style='width: 99%' class='fborder'>
         ";

        $ad = $sub_action == 'order' ? 'ASC' : 'DESC' ;
        if ($sql->db_Select("sgallery_cats", "*", "ORDER BY cat_order ASC{$limit}", 'nowhere'))
        {
            $catarray = $sql -> db_getList();

            $text .= "
            <tr>
            <td style='width:5%;text-align:center' class='fcaption'>ID</td>
            <td style='width:75%;text-align:center' class='fcaption'>".SGAL_LANADM_14."</a></td>
            <td style='width:20%;text-align:center;' class='fcaption'>".LAN_OPTIONS."</td>
            </tr>";

            $br = 0;
            $admoptions = '';
            $cnt = count($catarray);
            foreach($catarray as $row)
            {
                if($sub_action == 'order') {
                    $br++;
                    $admoptions = "<select class='tbox' name='order[]'>";

                    for ($i = 1; $i <= $cnt; $i++)
                    {
                        $selected = $br == $i ? " selected='selected'" : '';
                        $admoptions .= "<option value='".$row['cat_id']."_{$i}'{$selected}>$i</option>\n";
                    }
                    $admoptions .= "</select>";
                } else {

                    $admoptions = "<a href='".e_SELF."?category.chstat.".$row['cat_id']."' title='".($row['active'] ? SGAL_LANADM_18 : SGAL_LANADM_19 )."' style='border:0px none;'><img src='".($row['active'] ? SGAL_IMAGES_ABS."checkmark_16.gif" : SGAL_IMAGES_ABS."checkmark_na_16.gif" )."' alt='".($row['active'] ? SGAL_LANADM_18 : SGAL_LANADM_19 )."' style='border: 0px none ; vertical-align: top; width: 16px; height: 16px;' /></a>&nbsp;";
                    $admoptions .= "<a href='".e_SELF."?category.edit.".$row['cat_id']."' style='border:0px none;'>".ADMIN_EDIT_ICON."</a>&nbsp;";
                    $admoptions .= "<input type='image' title='".LAN_DELETE."' name='delete[category#".$row['cat_id']."]' src='".ADMIN_DELETE_ICON_PATH."' onclick=\"return jsconfirm('".SGAL_LANADM_113." [ID: ".$row['cat_id']." ]. ".SGAL_LANADM_114."')\" />&nbsp;";

                }
                $text .= "<tr>
                <td style='width:5%; text-align:center;' class='forumheader3'>".$row['cat_id']."</td>
                <td style='width:75%; text-align:left; line-height: 130%;' class='forumheader3'>".($row['title'] ? $tp->toHTML($row['title']) : "[".SGAL_LANADM_20."]")."</td>
                <td style='width:20%; text-align:center;' class='forumheader3'>$admoptions</td>
                </tr>";

            }

            if($sub_action == 'order') {
                 $text .= "<tr>
                 <td style='text-align:center' colspan='3' class='forumheader3'>
                 <input class='button' type='submit' name='submit_order' value='".LAN_UPDATE."' />
                 </td>
                 </tr>
                 ";
            }

            //page navigation
            $text .= "</table>
            </form></div>
            <div style='width: 99%; margin-left: auto; margin-right: auto; margin-top: 5px'><div style='text-align: right;'>
            ";

            if($sub_action != 'order') $text .= $pp -> pageNav($cats, $cpage, 'category.0.0');

            $text .= "
            </div>
            </div>
            ";

        }
        else { // no result

          $text .= "<tr><td style='text-align:center' colspan='3' class='forumheader3'>".LAN_EMPTY."</td></tr></table></form></div>";

        }

        $ttl = $sub_action == 'order' ? SGAL_LANADM_11a : SGAL_LANADM_10;
        $this->show_message();
        $ns->tablerender ($ttl, $text);
    }
	
    function createCat($id)
    {
        // ##### Display category creation form ---------------------------------------------------------------------------------------------------------
        /*  */
        global $ns, $sql, $rs, $fl, $sgal_pref, $th, $tp;
        
        $text = "<div style='margin-left: auto; margin-right: auto'>
        <form method='post' action='".e_SELF."?".e_QUERY."' id='cat_dataform'>
        <table align='center' style='width: 99%' class='fborder'>
         ";

        // -------- title ---------------------
         $text .= "
         <tr>
         <td style='width:20%; text-align: left' class='forumheader3'>".SGAL_LANADM_14.":</td>
         <td style='width:80%; text-align: left' class='forumheader3'>
         <input class='tbox' type='text' name='title' size='80' value='".$tp->post_toForm($_POST['title'])."' maxlength='200' style='width:98%' />
         </td>
         </tr>
         ";

        // -------- title end ---------------------
        
        // -------- description ---------------------
        $insertjs = (!e_WYSIWYG) ? "onselect='storeCaret(this);' onclick='storeCaret(this);' onkeyup='storeCaret(this);' ": "";
        $text .= "
        <tr>
        <td style='width:20%; text-align: left; vertical-align: top' class='forumheader3'>".SGAL_LANADM_14a.":</td>
        <td style='width:80%; text-align: left' class='forumheader3'>

            ".$rs->form_textarea("cat_description", 80, 15, $_POST['cat_description'], $insertjs, 'width: 98%')."
            ".display_help("helpb", 'body')."

        </td>
        </tr>
        ";
        // -------- description end ---------------------
        

        // -------- Activate ---------------------
        $isactive = !isset($_POST['active']) || !empty($_POST['active']) ? 1 : 0;

        $text .="
        <tr>
        <td style='width:20%; text-align: left;' class='forumheader3'>".SGAL_LANADM_39.":</td>
        <td style='width:80%; text-align: left;' class='forumheader3'>
        <input type='radio' name='active' value='1' id='activate'".($isactive == 1 ? ' checked="checked"' : '')." />
        <label for='activate'>".SGAL_LANADM_19a."</label>
        &nbsp;&nbsp;&nbsp;
        <input type='radio' name='active' value='0' id='notactive'".($isactive == 0 ? ' checked="checked"' : '')." />
        <label for='notactive'>".SGAL_LANADM_18a."</label>
        </td>
        </tr>
        ";
        // -------- end of activate ---------------------

        if(!isset($_POST['stay'])) $_POST['stay'] = !$id ? 1 : 0;
        $stayb = ' '.ECLI_LANADM_133.': '.$rs->form_radio('stay', '0', $_POST['stay']=='0')." <label for='stay0'>".ECLI_LANADM_136."</label>".$rs->form_radio('stay', '1', $_POST['stay']=='1')." <label for='stay1'>".($id ? ECLI_LANADM_134 : ECLI_LANADM_135)."</label>";


        $text .= "<tr>
        <td style='text-align:center' colspan='3' class='forumheader3'>
        <input type='hidden' name='cat_id' value='".$id."' />
        <input type='hidden' name='cat_order' value='".varset($_POST['cat_order'], 0)."' />
        {$stayb}&nbsp;&nbsp;<input class='button' type='submit' name='submit_cat' value='".LAN_SAVE."' />
        </td>
        </tr>
        ";

        $text .= '</table></form></div>';
        $ttl = $id ? SGAL_LANADM_43 : SGAL_LANADM_44 ;
        
        $this->show_message();
        $ns->tablerender ($ttl, $text);
    }
	
	//page - general(default) | user
    function editPrefs($page='general')
    {
        // ##### Display prefs edit form ---------------------------------------------------------------------------------------------------------
        /*  */
        global $ns, $sql, $sgal_pref, $pref, $tp, $rs, $PHPTHUMB_CONFIG;

        require_once(e_HANDLER."userclass_class.php"); 
        
        $text = "<div style='margin-left: auto; margin-right: auto'>
            <form method='post' action='".e_SELF."?".e_QUERY."' id='prefs_{$page}'>
            <table style='width: 100%;' class='fborder'>
        ";
        
        if($page == 'user'){
            // user album settings form sgal_usermod_albumcreate
            $ttl = SGAL_LANADM_12b;
            $text .= "
            <tr>
                <td style='width:100%; text-align: left' colspan='2' class='fcaption'>".SGAL_LANPREFS_GEN."</td>
            </tr>
            <tr>
                <td style='width:60%; text-align: left' class='forumheader3'><strong>".SGAL_LANPREFS_30.":</strong>
                    <br /><span class='smalltext' style='font-style: italic;'>".SGAL_LANPREFS_30a."</span>
                </td>
                <td style='width:40%; text-align: left;' class='forumheader3'>
                    ".r_userclass("sgal_usermod_allow", $sgal_pref['sgal_usermod_allow'], "off", "nobody,main,admin,member,classes")."
                </td>
            </tr>
            <tr>
                <td style='width:60%; text-align: left' class='forumheader3'><strong>".SGAL_LANPREFS_31.":</strong>
                    <br /><span class='smalltext' style='font-style: italic;'>".SGAL_LANPREFS_31a."</span>
                </td>
                <td style='width:40%; text-align: left;' class='forumheader3'>
                    ".r_userclass("sgal_usermod_albumcreate", $sgal_pref['sgal_usermod_albumcreate'], "off", "nobody,main,admin,member,classes")."
                </td>
            </tr>
            <tr>
                <td style='width:60%; text-align: left' class='forumheader3'><strong>".SGAL_LANPREFS_41.":</strong>
                    <br /><span class='smalltext' style='font-style: italic;'>".SGAL_LANPREFS_41a."</span>
                </td>
                <td style='width:40%; text-align: left;' class='forumheader3'>
                    <input type='checkbox' name='sgal_usermod_albumcreate_approve' value='1' id='sgal_usermod_albumcreate_approve'".($sgal_pref['sgal_usermod_albumcreate_approve'] ? ' checked="checked"' : '')." />
                    &nbsp;<label for='sgal_usermod_albumcreate_approve'>".SGAL_LANPREFS_41a."</label>
                </td>
            </tr>
            <tr>
                <td style='width:60%; text-align: left' class='forumheader3'><strong>".SGAL_LANPREFS_42.":</strong>
                    <br /><span class='smalltext' style='font-style: italic;'>".SGAL_LANPREFS_42a."</span>
                </td>
                <td style='width:40%; text-align: left;' class='forumheader3'>
                    <input type='checkbox' name='sgal_usermod_picapprove' value='1' id='sgal_usermod_picapprove'".($sgal_pref['sgal_usermod_picapprove'] ? ' checked="checked"' : '')." />
                    &nbsp;<label for='sgal_usermod_picapprove'>".SGAL_LANPREFS_42a."</label>
                </td>
            </tr>
            <tr>
                <td style='width:60%; text-align: left' class='forumheader3'><strong>".SGAL_LANPREFS_32.":</strong>
                    <br /><span class='smalltext' style='font-style: italic;'>".SGAL_LANPREFS_32a."</span>
                </td>
                <td style='width:40%; text-align: left;' class='forumheader3'>
                    ".r_userclass("sgal_usermod_visible", $sgal_pref['sgal_usermod_visible'], "off", "nobody,main,admin,member,public,guest,classes")."
                </td>
            </tr>
            <tr>
                <td style='width:60%; text-align: left' class='forumheader3'><strong>".SGAL_LANPREFS_43.":</strong>
                    <br /><span class='smalltext' style='font-style: italic;'>".SGAL_LANPREFS_43a."</span>
                </td>
                <td style='width:40%; text-align: left;' class='forumheader3'>
                    ".r_userclass("sgal_usermod_galleries", $sgal_pref['sgal_usermod_galleries'], "off", "nobody,main,admin,member,classes")."
                </td>
            </tr>
            ";
            
            $text .= "
            <tr>
                <td style='width:100%; text-align: left' colspan='2' class='fcaption'>".SGAL_LANPREFS_UA."</td>
            </tr>
            ";
            
            //restrict size
            $text .= "
            <tr>
                <td style='width:60%; text-align: left' class='forumheader3'><strong>".SGAL_LANPREFS_35.":</strong>
                    <br /><span class='smalltext' style='font-style: italic;'>".SGAL_LANPREFS_35a."</span>
                </td>
                    <td style='width:40%; text-align: left' class='forumheader3'>
                    <input type='checkbox' name='sgal_usermod_urestrict' value='1' id='sgal_usermod_urestrict'".($sgal_pref['sgal_usermod_urestrict'] ? ' checked="checked"' : '')." />
                    <label for='sgal_usermod_urestrict'>".SGAL_LANPREFS_35b."</label>
                    &nbsp;&nbsp;&nbsp;
                    
                </td>
            </tr>";
            
            $text .= "
            <tr>
            <td style='width:60%; text-align: left' class='forumheader3'><strong>".SGAL_LANPREFS_2.":</strong>
            <br /><span class='smalltext' style='font-style: italic;'>".SGAL_LANPREFS_2a."</span>
            </td>
            <td style='width:40%; text-align: left;' class='forumheader3'>
            ".SGAL_LANPREFS_2b.": <input class='tbox' type='text' name='sgal_usermod_urestrict_w' size='5' value='".$sgal_pref['sgal_usermod_urestrict_w']."' maxlength='4' style='text-align:right' /> px
            &nbsp;
            ".SGAL_LANPREFS_2c.": <input class='tbox' type='text' name='sgal_usermod_urestrict_h' size='5' value='".$sgal_pref['sgal_usermod_urestrict_h']."' maxlength='4' style='text-align:right' /> px
            </td>
            </tr>
            ";
            
            //allowed resize methods
            if($sgal_pref['sgal_usermod_rmethods']) {
                $isactive_um = explode(',', $sgal_pref['sgal_usermod_rmethods']);
            } else $isactive_um = '';
            
            $text .= "
            <tr>
                <td style='width:60%; text-align: left' class='forumheader3'><strong>".SGAL_LANPREFS_33.":</strong>
                    <br /><span class='smalltext' style='font-style: italic;'>".SGAL_LANPREFS_33a."</span>
                </td>
                    <td style='width:40%; text-align: left' class='forumheader3'>
                    <input type='checkbox' name='sgal_usermod_rmethods_str[]' value='autoresize' id='sgal_usermod_rmethods_str_1'".(in_array('autoresize', $isactive_um) ? ' checked="checked"' : '')." />
                    <label for='sgal_usermod_rmethods_str_1'>".SGAL_LANPREFS_34."</label>
                    &nbsp;&nbsp;&nbsp;
                    <input type='checkbox' name='sgal_usermod_rmethods_str[]' value='uresize' id='sgal_usermod_rmethods_str_2'".(in_array('uresize', $isactive_um) ? ' checked="checked"' : '')." />
                    <label for='sgal_usermod_rmethods_str_2'>".SGAL_LANPREFS_36."</label>
                </td>
            </tr>";
            
            //user albums limits
            $text .= "
            <tr>
                <td style='width:100%; text-align: left' colspan='2' class='fcaption'>".SGAL_LANPREFS_ULIMITS."</td>
            </tr>
            ";
            
            //sgal_usermod_albumcount
            $text .= "
            <tr>
                <td style='width:60%; text-align: left' class='forumheader3'><strong>".SGAL_LANPREFS_37.":</strong>
                    <br /><span class='smalltext' style='font-style: italic;'>".SGAL_LANPREFS_37a."</span>
                </td>
                <td style='width:40%; text-align: left;' class='forumheader3'>
                    <input class='tbox' type='text' name='sgal_usermod_albumcount' size='5' value='".($sgal_pref['sgal_usermod_albumcount'] ? $sgal_pref['sgal_usermod_albumcount'] : '0')."' maxlength='3' style='text-align:right' />
                </td>
            </tr>
            ";
            
            //sgal_usermod_albumsize
            $text .= "
            <tr>
                <td style='width:60%; text-align: left' class='forumheader3'><strong>".SGAL_LANPREFS_38.":</strong>
                    <br /><span class='smalltext' style='font-style: italic;'>".SGAL_LANPREFS_37a."</span>
                </td>
                <td style='width:40%; text-align: left;' class='forumheader3'>
                    <input class='tbox' type='text' name='sgal_usermod_albumsize' size='15' value='".($sgal_pref['sgal_usermod_albumsize'] ? number_format(($sgal_pref['sgal_usermod_albumsize']/1024), 2, '.', '') : '0')."' maxlength='20' style='text-align:right' />&nbsp;kb ~ ".sgal_convsize($sgal_pref['sgal_usermod_albumsize'], SGAL_LANPREFS_40)." ".($sgal_pref['sgal_usermod_albumsize'] ? "[{$sgal_pref['sgal_usermod_albumsize']} bytes]" : '')."
                </td>
            </tr>
            ";
            
            //sgal_usermod_piccount
            $text .= "
            <tr>
                <td style='width:60%; text-align: left' class='forumheader3'><strong>".SGAL_LANPREFS_44.":</strong>
                    <br /><span class='smalltext' style='font-style: italic;'>".SGAL_LANPREFS_44a."</span>
                </td>
                <td style='width:40%; text-align: left;' class='forumheader3'>
                    <input class='tbox' type='text' name='sgal_usermod_piccount' size='5' value='".($sgal_pref['sgal_usermod_piccount'] ? $sgal_pref['sgal_usermod_piccount'] : '0')."' maxlength='3' style='text-align:right' />
                </td>
            </tr>
            ";
            
            //sgal_usermod_totalsize
            $text .= "
            <tr>
                <td style='width:60%; text-align: left' class='forumheader3'><strong>".SGAL_LANPREFS_39.":</strong>
                    <br /><span class='smalltext' style='font-style: italic;'>".SGAL_LANPREFS_37a."</span>
                </td>
                <td style='width:40%; text-align: left;' class='forumheader3'>
                    <input class='tbox' type='text' name='sgal_usermod_totalsize' size='15' value='".($sgal_pref['sgal_usermod_totalsize'] ? number_format(($sgal_pref['sgal_usermod_totalsize']/1024), 2, '.', '') : '0')."' maxlength='20' style='text-align:right' />&nbsp;kb ~ ".sgal_convsize($sgal_pref['sgal_usermod_totalsize'], SGAL_LANPREFS_40)." ".($sgal_pref['sgal_usermod_totalsize'] ? "[{$sgal_pref['sgal_usermod_totalsize']} bytes]" : '')."
                </td>
            </tr>
            ";
            
            $text .= "
            <tr>
            <td style='width:100%; text-align: center' colspan='2' class='forumheader'>
            ".$rs->form_button('submit', 'save_sgal_uprefs', LAN_UPDATE)."
            </td>
            </tr>
    		";
            
        } else {
            // general settings form
            $ttl = SGAL_LANADM_12;
            
            $text .= "
            <tr>
                <td style='width:100%; text-align: left' colspan='2' class='fcaption'>".SGAL_LANPREFS_GEN."</td>
            </tr>
            <tr>
                <td style='width:60%; text-align: left' class='forumheader3'><strong>".SGAL_LANPREFS_24.":</strong>
                    <br /><span class='smalltext' style='font-style: italic;'>".SGAL_LANPREFS_24a."</span>
                </td>
                <td style='width:40%; text-align: left;' class='forumheader3'>
                    ".r_userclass("sgal_active", $pref['sgal_active'], "off", "nobody,main,admin,member,public,guest,classes")."
                </td>
            </tr>
            <tr>
                <td style='width:60%; text-align: left' class='forumheader3'><strong>".SGAL_LANPREFS_25.":</strong>
                    <br /><span class='smalltext' style='font-style: italic;'>".SGAL_LANPREFS_25a."</span>
                </td>
                <td style='width:40%; text-align: left;' class='forumheader3'>
                    ".r_userclass("sgal_wperms", $pref['sgal_wperms'], "off", "nobody,main,admin,member,public,guest,classes")."
                </td>
            </tr>
            <tr>
                <td style='width:60%; text-align: left' class='forumheader3'><strong>".SGAL_LANPREFS_26.":</strong>
                    <br /><span class='smalltext' style='font-style: italic;'>".SGAL_LANPREFS_26a."</span>
                </td>
                <td style='width:40%; text-align: left;' class='forumheader3'>
                    ".r_userclass("sgal_advwperms", $pref['sgal_advwperms'], "off", "nobody,main,admin,member,public,guest,classes")."
                </td>
            </tr>
            <tr>
                <td style='width:60%; text-align: left' class='forumheader3'><strong>".SGAL_LANPREFS_27.":</strong>
                    <br /><span class='smalltext' style='font-style: italic;'>".SGAL_LANPREFS_27a."</span>
                </td>
                <td style='width:40%; text-align: left;' class='forumheader3'>
                    ".r_userclass("sgal_bbthumbperms", $pref['sgal_bbthumbperms'], "off", "nobody,main,admin,member,public,guest,classes")."
                </td>
            </tr>
            <tr>
                <td style='width:60%; text-align: left' class='forumheader3'><strong>".SGAL_LANPREFS_46.":</strong>
                    <br /><span class='smalltext' style='font-style: italic;'>".SGAL_LANPREFS_46a."</span>
                    ".($PHPTHUMB_CONFIG['nohotlink_enabled'] ? "<br /><strong>".SGAL_LANPREFS_46b."</strong>" : '')."
                </td>
                <td style='width:40%; text-align: left;' class='forumheader3'>
                    <input type='radio' name='sgal_bballow_external' value='1' id='sgal_bballow_external_on'".($sgal_pref['sgal_bballow_external'] ? ' checked="checked"' : '')." />
                    <label for='sgal_bballow_external_on'>".SGAL_LANADM_19a."</label>
                    &nbsp;&nbsp;&nbsp;
                    <input type='radio' name='sgal_bballow_external' value='0' id='sgal_bballow_external_off'".(!$sgal_pref['sgal_bballow_external'] ? ' checked="checked"' : '')." />
                    <label for='sgal_bballow_external_off'>".SGAL_LANADM_18a."</label>
                </td>
            </tr>
            <tr>
                <td style='width:60%; text-align: left' class='forumheader3'><strong>".SGAL_LANPREFS_45.":</strong>
                    <br /><span class='smalltext' style='font-style: italic;'>".SGAL_LANPREFS_45a."</span>
                </td>
                <td style='width:40%; text-align: left;' class='forumheader3'>
                    ".r_userclass("sgal_upload_publishxp", $sgal_pref['sgal_upload_publishxp'], "off", "nobody,main,admin,member,public,guest,classes")."
                </td>
            </tr>
            <tr>
                <td style='width:60%; text-align: left' class='forumheader3'><strong>".SGAL_LANPREFS_47.":</strong>
                    <br /><span class='smalltext' style='font-style: italic;'>".SGAL_LANPREFS_47a."</span>
                </td>
                <td style='width:40%; text-align: left;' class='forumheader3'>
                    ".r_userclass("sgal_album_comments", $sgal_pref['sgal_album_comments'], "off", "nobody,main,admin,member,public,guest,classes")."
                </td>
            </tr>
            <tr>
                <td style='width:60%; text-align: left' class='forumheader3'><strong>".SGAL_LANPREFS_48.":</strong>
                    <br /><span class='smalltext' style='font-style: italic;'>".SGAL_LANPREFS_48a."</span>
                </td>
                <td style='width:40%; text-align: left;' class='forumheader3'>
                    ".r_userclass("sgal_album_rating", $sgal_pref['sgal_album_rating'], "off", "nobody,main,admin,member,public,guest,classes")."
                </td>
            </tr>
            <tr>
                <td style='width:60%; text-align: left' class='forumheader3'><strong>".SGAL_LANPREFS_50.":</strong>
                    
                </td>
                <td style='width:40%; text-align: left;' class='forumheader3'>
                    ".r_userclass("sgal_latest", $sgal_pref['sgal_latest'], "off", "nobody,main,admin,member,public,guest,classes")."
                </td>
            </tr>
            <tr>
            <td style='width:100%; text-align: left' colspan='2' class='fcaption'>".SGAL_LANPREFS_IMG."</td>
            </tr>
    		";
    		
            // -------- sgal_restrict_size ---------------------
            if($sgal_pref['sgal_restrict_size']) {
                $isactive_restr = 1;
            } else {
                $isactive_restr = 0;
            }
            $text .= "
            <tr>
            <td style='width:60%; text-align: left' class='forumheader3'><strong>".SGAL_LANPREFS_1.":</strong>
            <br /><span class='smalltext' style='font-style: italic;'>".SGAL_LANPREFS_1a."</span>
            </td>
            <td style='width:40%; text-align: left' class='forumheader3'>
            <input type='radio' name='sgal_restrict_size' value='1' id='sgal_restrict_size_on'".($isactive_restr == 1 ? ' checked="checked"' : '')." />
            <label for='sgal_restrict_size_on'>".SGAL_LANADM_19a."</label>
            &nbsp;&nbsp;&nbsp;
            <input type='radio' name='sgal_restrict_size' value='0' id='sgal_restrict_size_off'".($isactive_restr == 0 ? ' checked="checked"' : '')." />
            <label for='sgal_restrict_size_off'>".SGAL_LANADM_18a."</label>
            </td>
            </tr>";
            
            $text .= "
            <tr>
            <td style='width:60%; text-align: left' class='forumheader3'><strong>".SGAL_LANPREFS_2.":</strong>
            <br /><span class='smalltext' style='font-style: italic;'>".SGAL_LANPREFS_2a."</span>
            </td>
            <td style='width:40%; text-align: left;' class='forumheader3'>
            ".SGAL_LANPREFS_2b.": <input class='tbox' type='text' name='sgal_restrict_w' size='5' value='".$sgal_pref['sgal_restrict_w']."' maxlength='4' style='text-align:right' /> px
            &nbsp;
            ".SGAL_LANPREFS_2c.": <input class='tbox' type='text' name='sgal_restrict_h' size='5' value='".$sgal_pref['sgal_restrict_h']."' maxlength='4' style='text-align:right' /> px
            </td>
            </tr>
            ";
    
            // -------- sgal_allow_autoresize ---------------------
            if($sgal_pref['sgal_allow_autoresize']) {
                $isactive_autores = 1;
            } else {
                $isactive_autores = 0;
            }
            $text .= "
            <tr>
            <td style='width:60%; text-align: left' class='forumheader3'><strong>".SGAL_LANPREFS_3.":</strong>
            <br /><span class='smalltext' style='font-style: italic;'>".SGAL_LANPREFS_3a."</span>
            </td>
            <td style='width:40%; text-align: left' class='forumheader3'>
            <input type='radio' name='sgal_allow_autoresize' value='1' id='sgal_allow_autoresize_on'".($isactive_autores == 1 ? ' checked="checked"' : '')." />
            <label for='sgal_allow_autoresize_on'>".SGAL_LANADM_19a."</label>
            &nbsp;&nbsp;&nbsp;
            <input type='radio' name='sgal_allow_autoresize' value='0' id='sgal_allow_autoresize_off'".($isactive_autores == 0 ? ' checked="checked"' : '')." />
            <label for='sgal_allow_autoresize_off'>".SGAL_LANADM_18a."</label>
            </td>
            </tr>";
            
            $text .= "
            <tr>
            <td style='width:60%; text-align: left' class='forumheader3'><strong>".SGAL_LANPREFS_4.":</strong>
            <br /><span class='smalltext' style='font-style: italic;'>".SGAL_LANPREFS_4a."</span>
            </td>
            <td style='width:40%; text-align: left;' class='forumheader3'>
            ".SGAL_LANPREFS_2b.": <input class='tbox' type='text' name='sgal_w' size='5' value='".$sgal_pref['sgal_w']."' maxlength='4' style='text-align:right' /> px
            &nbsp;
            ".SGAL_LANPREFS_2c.": <input class='tbox' type='text' name='sgal_h' size='5' value='".$sgal_pref['sgal_h']."' maxlength='4' style='text-align:right' /> px
            </td>
            </tr>
            ";
            
            // -------- sgal_allow_uresize ---------------------
            if($sgal_pref['sgal_allow_uresize']) {
                $isactive_ures = 1;
            } else {
                $isactive_ures = 0;
            }
            $text .= "
            <tr>
            <td style='width:60%; text-align: left' class='forumheader3'><strong>".SGAL_LANPREFS_5.":</strong>
            <br /><span class='smalltext' style='font-style: italic;'>".SGAL_LANPREFS_5a."</span>
            </td>
            <td style='width:40%; text-align: left' class='forumheader3'>
            <input type='radio' name='sgal_allow_uresize' value='1' id='sgal_allow_uresize_on'".($isactive_ures == 1 ? ' checked="checked"' : '')." />
            <label for='sgal_allow_uresize_on'>".SGAL_LANADM_19a."</label>
            &nbsp;&nbsp;&nbsp;
            <input type='radio' name='sgal_allow_uresize' value='0' id='sgal_allow_uresize_off'".($isactive_ures == 0 ? ' checked="checked"' : '')." />
            <label for='sgal_allow_uresize_off'>".SGAL_LANADM_18a."</label>
            </td>
            </tr>";
            
    		// -------- sgal_far ---------------------        
            $text .= "
            <tr>
            <td style='width:60%; text-align: left' class='forumheader3'><strong>".SGAL_LANPREFS_6.":</strong>
            <br /><span class='smalltext' style='font-style: italic;'>".SGAL_LANPREFS_6a."</span>
            </td>
            <td style='width:40%; text-align: left' class='forumheader3'>
            ".$rs->form_select_open('sgal_far')."
            ".$rs->form_option(SGAL_LANPREFS_6k, (!$sgal_pref['sgal_far']), '0')."
            ".$rs->form_option(SGAL_LANPREFS_6b, ($sgal_pref['sgal_far'] == 'C'), 'C')."
            ".$rs->form_option(SGAL_LANPREFS_6c, ($sgal_pref['sgal_far'] == 'T'), 'T')."
            ".$rs->form_option(SGAL_LANPREFS_6d, ($sgal_pref['sgal_far'] == 'R'), 'R')."
            ".$rs->form_option(SGAL_LANPREFS_6e, ($sgal_pref['sgal_far'] == 'B'), 'B')."
            ".$rs->form_option(SGAL_LANPREFS_6f, ($sgal_pref['sgal_far'] == 'L'), 'L')."
            ".$rs->form_option(SGAL_LANPREFS_6g, ($sgal_pref['sgal_far'] == 'TL'), 'TL')."
            ".$rs->form_option(SGAL_LANPREFS_6h, ($sgal_pref['sgal_far'] == 'TR'), 'TR')."
            ".$rs->form_option(SGAL_LANPREFS_6i, ($sgal_pref['sgal_far'] == 'BL'), 'BL')."
            ".$rs->form_option(SGAL_LANPREFS_6j, ($sgal_pref['sgal_far'] == 'BR'), 'BR')."
            ".$rs->form_select_close()."
            </td>
            </tr>";
            
    		// -------- sgal_bg ---------------------
            $text .= "
            <tr>
            <td style='width:60%; text-align: left' class='forumheader3'><strong>".SGAL_LANPREFS_7.":</strong>
            <br /><span class='smalltext' style='font-style: italic;'>".SGAL_LANPREFS_7a."</span>
            </td>
            <td style='width:40%; text-align: left' class='forumheader3'>
                <input class='tbox' type='text' name='sgal_bg' size='9' value='".$sgal_pref['sgal_bg']."' maxlength='6' style='text-align:left' />
            </td>
            </tr>";
            
    		// -------- sgal_watermark ---------------------        
    		
            //imgselectors - destination images
            //if(array_key_exists('lightbox', $pref['e_meta_list'])) {
            $def = $sgal_pref['sgal_watermark'] ? $sgal_pref['sgal_watermark'] : '';
            $parms = "name=sgal_watermark";
            $parms .= "&path=".SGAL_IMAGES.'watermark/';//watermark path
            $parms .= "&label=--".SGAL_LANPREFS_49b."--";//no watermark
    		$parms .= "&default=".$def;
    		$parms .= "&float=left";
    		$parms .= "&width=120px";
    		$parms .= "&height=120px";
    		$parms .= "&multiple=TRUE";
    		$parms .= "&swidth=300px";
    		
            $wimg = $tp->parseTemplate("{IMAGESELECTOR={$parms}}");
            /*
            } else {
                $wimg = "<strong>".SGAL_LANPREFS_49b."</strong>";
            }
            */
            //alpha
            $alpha = $rs->form_select_open('sgal_watermark_op');
            for ($i=0; $i<=100; $i++ ) {
            	$alpha .= $rs->form_option($i, ($sgal_pref['sgal_watermark_op'] == $i), $i);
            }
            $alpha .= $rs->form_select_close();
            
            $marg = 
            
            $text .= "
            <tr>
            <td style='width:60%; text-align: left; vertical-align: top' class='forumheader3'><strong>".SGAL_LANPREFS_49.":</strong>
            <br /><span class='smalltext' style='font-style: italic;'>".SGAL_LANPREFS_49a."</span>
            </td>
            <td style='width:40%; text-align: left' class='forumheader3'>
                <div style='clear: both; padding: 5px'>
                ".$rs->form_select_open('sgal_watermark_pos')."
                ".$rs->form_option(SGAL_LANPREFS_6k, (!$sgal_pref['sgal_watermark_pos']), '0')."
                ".$rs->form_option(SGAL_LANPREFS_6b, ($sgal_pref['sgal_watermark_pos'] == 'C'), 'C')."
                ".$rs->form_option(SGAL_LANPREFS_6c, ($sgal_pref['sgal_watermark_pos'] == 'T'), 'T')."
                ".$rs->form_option(SGAL_LANPREFS_6d, ($sgal_pref['sgal_watermark_pos'] == 'R'), 'R')."
                ".$rs->form_option(SGAL_LANPREFS_6e, ($sgal_pref['sgal_watermark_pos'] == 'B'), 'B')."
                ".$rs->form_option(SGAL_LANPREFS_6f, ($sgal_pref['sgal_watermark_pos'] == 'L'), 'L')."
                ".$rs->form_option(SGAL_LANPREFS_6g, ($sgal_pref['sgal_watermark_pos'] == 'TL'), 'TL')."
                ".$rs->form_option(SGAL_LANPREFS_6h, ($sgal_pref['sgal_watermark_pos'] == 'TR'), 'TR')."
                ".$rs->form_option(SGAL_LANPREFS_6i, ($sgal_pref['sgal_watermark_pos'] == 'BL'), 'BL')."
                ".$rs->form_option(SGAL_LANPREFS_6j, ($sgal_pref['sgal_watermark_pos'] == 'BR'), 'BR')."
                ".$rs->form_option(SGAL_LANPREFS_49f, ($sgal_pref['sgal_watermark_pos'] == '*'), '*')."
                ".$rs->form_select_close()."  ".SGAL_LANPREFS_49c."
                </div>
                <div style='clear: both; padding: 5px'>
                {$wimg}
                </div>
                <div style='clear: both; padding: 5px'>
                {$alpha} <br />".SGAL_LANPREFS_49d."
                </div>
                <div style='clear: both; padding: 5px'>
                    ".SGAL_LANPREFS_49g.": <input class='tbox' type='text' name='sgal_watermark_x' size='5' value='".$sgal_pref['sgal_watermark_x']."' maxlength='4' style='text-align:right' /> px
                    &nbsp;
                    ".SGAL_LANPREFS_49h.": <input class='tbox' type='text' name='sgal_watermark_y' size='5' value='".$sgal_pref['sgal_watermark_y']."' maxlength='4' style='text-align:right' /> px
                </div>
            </td>
            </tr>
            <tr>
                <td style='width:60%; text-align: left' class='forumheader3'><strong>".SGAL_LANPREFS_51.":</strong>
                    
                </td>
                <td style='width:40%; text-align: left;' class='forumheader3'>
                    <input type='radio' name='sgal_picorder_type' value='fname' id='sgal_picorder_type_fname'".($sgal_pref['sgal_picorder_type'] == 'fname' ? ' checked="checked"' : '')." />
                    <label for='sgal_picorder_type_fname'>".SGAL_LANPREFS_51a."</label>
                    &nbsp;&nbsp;&nbsp;
                    <input type='radio' name='sgal_picorder_type' value='ftime' id='sgal_picorder_type_ftime'".($sgal_pref['sgal_picorder_type'] == 'ftime' ? ' checked="checked"' : '')." />
                    <label for='sgal_picorder_type_ftime'>".SGAL_LANPREFS_51b."</label>
                    <br /><br />
                    <input type='radio' name='sgal_picorder' value='asc' id='sgal_picorder_asc'".($sgal_pref['sgal_picorder'] == 'asc' ? ' checked="checked"' : '')." />
                    <label for='sgal_picorder_asc'>".SGAL_LANPREFS_51c."</label>
                    &nbsp;&nbsp;&nbsp;
                    <input type='radio' name='sgal_picorder' value='desc' id='sgal_picorder_desc'".($sgal_pref['sgal_picorder'] == 'desc' ? ' checked="checked"' : '')." />
                    <label for='sgal_picorder_desc'>".SGAL_LANPREFS_51d."</label>
                </td>
            </tr>
            ";
            
            //Thumb settings
            $text .= "
            <tr>
            <td style='width:100%; text-align: left' colspan='2' class='fcaption'>".SGAL_LANPREFS_TH."</td>
            </tr>
    		"; 
            
    		// -------- thumb gallery list size ---------------------
            $text .= "
            <tr>
            <td style='width:60%; text-align: left' class='forumheader3'><strong>".SGAL_LANPREFS_14.":</strong>
            <br /><span class='smalltext' style='font-style: italic;'>".SGAL_LANPREFS_14a."</span>
            </td>
            <td style='width:40%; text-align: left' class='forumheader3'>
            ".SGAL_LANPREFS_2b.": <input class='tbox' type='text' name='sgal_thgal_w' size='5' value='".$sgal_pref['sgal_thgal_w']."' maxlength='4' style='text-align:right' /> px
            &nbsp;
            ".SGAL_LANPREFS_2c.": <input class='tbox' type='text' name='sgal_thgal_h' size='5' value='".$sgal_pref['sgal_thgal_h']."' maxlength='4' style='text-align:right' /> px
            </td>
            </tr>";
            
    		// -------- thumb album list size ---------------------
            $text .= "
            <tr>
            <td style='width:60%; text-align: left' class='forumheader3'><strong>".SGAL_LANPREFS_15.":</strong>
            <br /><span class='smalltext' style='font-style: italic;'>".SGAL_LANPREFS_15a."</span>
            </td>
            <td style='width:40%; text-align: left' class='forumheader3'>
            ".SGAL_LANPREFS_2b.": <input class='tbox' type='text' name='sgal_thalbum_w' size='5' value='".$sgal_pref['sgal_thalbum_w']."' maxlength='4' style='text-align:right' /> px
            &nbsp;
            ".SGAL_LANPREFS_2c.": <input class='tbox' type='text' name='sgal_thalbum_h' size='5' value='".$sgal_pref['sgal_thalbum_h']."' maxlength='4' style='text-align:right' /> px
            </td>
            </tr>";
            
    		// -------- thumb pictures list size ---------------------
            $text .= "
            <tr>
            <td style='width:60%; text-align: left' class='forumheader3'><strong>".SGAL_LANPREFS_8.":</strong>
            <br /><span class='smalltext' style='font-style: italic;'>".SGAL_LANPREFS_8a."</span>
            </td>
            <td style='width:40%; text-align: left' class='forumheader3'>
            ".SGAL_LANPREFS_2b.": <input class='tbox' type='text' name='sgal_thumb_w' size='5' value='".$sgal_pref['sgal_thumb_w']."' maxlength='4' style='text-align:right' /> px
            &nbsp;
            ".SGAL_LANPREFS_2c.": <input class='tbox' type='text' name='sgal_thumb_h' size='5' value='".$sgal_pref['sgal_thumb_h']."' maxlength='4' style='text-align:right' /> px
            </td>
            </tr>";
            
            //Template Settings
            $text .= "
            <tr>
            <td style='width:100%; text-align: left' colspan='2' class='fcaption'>".SGAL_LANPREFS_TMPLSET."</td>
            </tr>
    		";
    		
            //sgal_galperrow
            $text .= "
            <tr>
            <td style='width:60%; text-align: left' class='forumheader3'><strong>".SGAL_LANPREFS_9.":</strong>
            <br /><span class='smalltext' style='font-style: italic;'>".SGAL_LANPREFS_9a."</span>
            </td>
            <td style='width:40%; text-align: left;' class='forumheader3'>
                <input class='tbox' type='text' name='sgal_galperrow' size='3' value='".$sgal_pref['sgal_galperrow']."' maxlength='2' style='text-align:right' />
            </td>
            </tr>
            ";
            
            //sgal_albumperrow
            $text .= "
            <tr>
            <td style='width:60%; text-align: left' class='forumheader3'><strong>".SGAL_LANPREFS_16.":</strong>
            <br /><span class='smalltext' style='font-style: italic;'>".SGAL_LANPREFS_16a."</span>
            </td>
            <td style='width:40%; text-align: left;' class='forumheader3'>
                <input class='tbox' type='text' name='sgal_albumperrow' size='3' value='".$sgal_pref['sgal_albumperrow']."' maxlength='2' style='text-align:right' />
            </td>
            </tr>
            ";
            
            //sgal_albumperpage
            $text .= "
            <tr>
            <td style='width:60%; text-align: left' class='forumheader3'><strong>".SGAL_LANPREFS_17.":</strong>
            <br /><span class='smalltext' style='font-style: italic;'>".SGAL_LANPREFS_17a."</span>
            </td>
            <td style='width:40%; text-align: left;' class='forumheader3'>
                <input class='tbox' type='text' name='sgal_albumperpage' size='3' value='".$sgal_pref['sgal_albumperpage']."' maxlength='2' style='text-align:right' />
            </td>
            </tr>
            ";
            
            //sgal_picperrow
            $text .= "
            <tr>
            <td style='width:60%; text-align: left' class='forumheader3'><strong>".SGAL_LANPREFS_18.":</strong>
            <br /><span class='smalltext' style='font-style: italic;'>".SGAL_LANPREFS_18a."</span>
            </td>
            <td style='width:40%; text-align: left;' class='forumheader3'>
                <input class='tbox' type='text' name='sgal_picperrow' size='3' value='".$sgal_pref['sgal_picperrow']."' maxlength='2' style='text-align:right' />
            </td>
            </tr>
            ";
            
            //sgal_picperpage
            $text .= "
            <tr>
            <td style='width:60%; text-align: left' class='forumheader3'><strong>".SGAL_LANPREFS_11.":</strong>
            </td>
            <td style='width:40%; text-align: left;' class='forumheader3'>
                <input class='tbox' type='text' name='sgal_picperpage' size='5' value='".$sgal_pref['sgal_picperpage']."' maxlength='4' style='text-align:right' />
            </td>
            </tr>
            ";
            
            //sgal_picperrow_latest
            $text .= "
            <tr>
            <td style='width:60%; text-align: left' class='forumheader3'><strong>".SGAL_LANPREFS_53.":</strong>
            </td>
            <td style='width:40%; text-align: left;' class='forumheader3'>
                <input class='tbox' type='text' name='sgal_picperrow_latest' size='3' value='".$sgal_pref['sgal_picperrow_latest']."' maxlength='2' style='text-align:right' />
            </td>
            </tr>
            ";
            
            //sgal_picperpage_latest
            $text .= "
            <tr>
            <td style='width:60%; text-align: left' class='forumheader3'><strong>".SGAL_LANPREFS_52.":</strong>
            </td>
            <td style='width:40%; text-align: left;' class='forumheader3'>
                <input class='tbox' type='text' name='sgal_picperpage_latest' size='5' value='".$sgal_pref['sgal_picperpage_latest']."' maxlength='4' style='text-align:right' />
            </td>
            </tr>
            ";
            
            //sgal_pagenum
            $text .= "
            <tr>
            <td style='width:60%; text-align: left' class='forumheader3'><strong>".SGAL_LANPREFS_12.":</strong>
            <br /><span class='smalltext' style='font-style: italic;'>".SGAL_LANPREFS_12a."</span>
            </td>
            <td style='width:40%; text-align: left;' class='forumheader3'>
                <input class='tbox' type='text' name='sgal_pagenum' size='5' value='".$sgal_pref['sgal_pagenum']."' maxlength='4' style='text-align:right' />
            </td>
            </tr>
            ";
            
            //sgal_admin_albums
            $text .= "
            <tr>
            <td style='width:60%; text-align: left' class='forumheader3'><strong>".SGAL_LANPREFS_10.":</strong>
            </td>
            <td style='width:40%; text-align: left;' class='forumheader3'>
                <input class='tbox' type='text' name='sgal_admin_albums' size='5' value='".$sgal_pref['sgal_admin_albums']."' maxlength='3' style='text-align:right' />
            </td>
            </tr>
            ";
    
            //sgal_tblrender
            $text .= "
            <tr>
            <td style='width:60%; text-align: left' class='forumheader3'><strong>".SGAL_LANPREFS_13.":</strong>
            <br /><span class='smalltext' style='font-style: italic;'>".SGAL_LANPREFS_13a."</span>
            </td>
            <td style='width:40%; text-align: left;' class='forumheader3'>
                <input type='checkbox' value='1' id='sgal_tblrender' name='sgal_tblrender'".($sgal_pref['sgal_tblrender'] ? " checked='checked'" : '')." />
            </td>
            </tr>
            ";
            
            //Menu settings
            $text .= "
            <tr>
            <td style='width:100%; text-align: left' colspan='2' class='fcaption'>".SGAL_LANPREFS_19."</td>
            </tr>
    		";
    		
            //sgal_galrand_multinum
            $text .= "
            <tr>
            <td style='width:60%; text-align: left' class='forumheader3'><strong>".SGAL_LANPREFS_20.":</strong>
            <br /><span class='smalltext' style='font-style: italic;'>".SGAL_LANPREFS_21.SGAL_LANPREFS_21a."</span>
            </td>
            <td style='width:40%; text-align: left;' class='forumheader3'>
                <input class='tbox' type='text' name='sgal_galrand_multinum' size='5' value='".$sgal_pref['sgal_galrand_multinum']."' maxlength='3' style='text-align:right' />
            </td>
            </tr>
            ";
            
            //sgal_rand_multinum
            $text .= "
            <tr>
            <td style='width:60%; text-align: left' class='forumheader3'><strong>".SGAL_LANPREFS_22.":</strong>
            <br /><span class='smalltext' style='font-style: italic;'>".SGAL_LANPREFS_23.SGAL_LANPREFS_23a."</span>
            </td>
            <td style='width:40%; text-align: left;' class='forumheader3'>
                <input class='tbox' type='text' name='sgal_rand_multinum' size='5' value='".$sgal_pref['sgal_rand_multinum']."' maxlength='3' style='text-align:right' />
            </td>
            </tr>
            ";
            
            $text .= "
            <tr>
            <td style='width:100%; text-align: center' colspan='2' class='forumheader'>
            ".$rs->form_button('submit', 'save_sgal_prefs', LAN_UPDATE)."
            </td>
            </tr>
    		";
		}
       
		         
		$text .= "</table></form></div>";
		 
        $this->show_message();
        $ns->tablerender ($ttl, $text);
	}

    function show_message() {
        global $ns;
        
        return $this->_sysmsg ? $ns->tablerender($this->_systype, "<div style='text-align:center; font-weight: bold'>".$this->_sysmsg."</div>") : '';
    }

    function set_message($msg, $type='') {

       if($msg) {

          $this->_sysmsg .= $msg;

          $this->_systype = $type;

       }

    }

}
?>