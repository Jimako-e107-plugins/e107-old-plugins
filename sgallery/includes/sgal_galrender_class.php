<?php
/*
+ ----------------------------------------------------------------------------------------------------+
|        e107 website system 
|        Gallery Render Class:  e107_plugins/sgallery/includes/sgal_render_class.php
|        Email: m.yovchev@clabteam.com
|        $Revision: 739 $
|        $Date: 2008-04-22 14:03:31 +0300 (Tue, 22 Apr 2008) $
|        $Author: secretr $
|	     Copyright Corllete Lab ( http://www.clabteam.com ) under GNU GPL License (http://gnu.org)
|        Free Support: http://dev.e107bg.org/
+----------------------------------------------------------------------------------------------------+
*/
if (!defined('e107_INIT')) { exit; }

include_lan(SGAL_LAN.'_render.php'); 



class sgal_galrender_class {
	var $mod = 'user';
	
	function setmod($mod='user'){
		if(!$mod) $mod = 'user';
		$this->mod = $mod;
	}
	
	function renderNew($row=array(), $tmpl='') {
        global $sgal_pref, $tp, $sgal_shortcodes, $SGALLERY_MNG_CREATE_BODY;
		if(!$tmpl) return '';
		
		$parse_array = array();
        $sgal_param = array();
		
		if(!$sgal_shortcodes)
			require_once(SGAL_INCPATH."sgal_batch.php");

        $parse_array['data_form_open'] = "<form method='post' action='".e_SELF."?".e_QUERY."' enctype='application/x-www-form-urlencoded' id='publish'>";
        $parse_array['title_field'] = "<input type='text' value='{$row['title']}' id='title' name='title' size='80' maxlength='200' class='tbox mngr-text' />";
        require_once(e_HANDLER.'ren_help.php');
        //not checked yet ?
        
        define('e_WYSIWYG', false);
        $insertjs = " onselect='storeCaret(this);' onclick='storeCaret(this);' onkeyup='storeCaret(this);' ";
        $parse_array['description_field'] = "<textarea class='tbox mngr-area' id='album_description' name='album_description' cols='80' rows='6'{$insertjs}>{$row['album_description']}</textarea><br />".display_help("help", 'news');
        $parse_array['data_form_submit'] = "<input name='final_submit' id='sgal_mngdata_submit' value='1' type='hidden' />";
        $parse_array['cancel_new_album'] = "<input class='button' name='event[album_create_cancel]' id='album_create_cancel' value='".SGAL_LANPBL_5."' type='submit' />";
		$parse_array['new_album'] = "<input class='button' name='event[album_create]' id='album_go2create' value='".SGAL_LANPBL_4."' type='submit' />";

		$parse_array['data_form_close'] = "</form>";  
		
		$tmpl = clSimpleParser($tmpl, $parse_array);
		// simple parse it
        return $tmpl = $tp->parseTemplate($tmpl, TRUE, $sgal_shortcodes);
	}
	
	function renderList($row=array(), $tmpl='') {
        global $sgal_pref, $tp, $sql, $sgal_shortcodes, $SGALLERY_MNG_CREATE_BODY;
		if(!$tmpl) return '';
		
		$parse_array = array();
        $sgal_param = array();
		
		if(!$sgal_shortcodes)
			require_once(SGAL_INCPATH."sgal_batch.php");

        $parse_array['data_form_open'] = "<form method='post' action='".e_SELF."?".e_QUERY."' enctype='application/x-www-form-urlencoded' id='publish'>";
        $parse_array['title_field'] = "<input type='text' value='{$row['title']}' id='title' name='title' size='80' maxlength='200' class='tbox mngr-text' />";
        require_once(e_HANDLER.'ren_help.php');
        
        $show_cats = ADMIN ? true : check_class($sgal_pref['sgal_usermod_galleries']);
        
		//galleries && albums
		if(ADMIN) {
        	$qry = "
        	SELECT al.*
        	FROM #sgallery AS al
            ORDER BY al.dt DESC 
        	";
    	} else {
            $qry = "
        	SELECT al.*
        	FROM #sgallery AS al
        	WHERE al.sgal_user LIKE '".USERID.".%'
            ORDER BY al.dt DESC 
        	";
        }
        
        $parse_array['sgal_album_box'] = '';
        $box = '';
    	if($sql->db_Select_gen($qry)) {
    	   
			$rows = $sql->db_getList('ALL', FALSE, FALSE, 'album_id');
			$uids = array();
			$cats = array();
			
			$parse_array['sgal_album_box'] = "<select class='tbox sgal-catbox' id='sgal_catbox' name='cat_id' size='15' style='width: 100%;'>\n";
			
            //eQTimeOn();
			//cats & albums
            if($show_cats && $sql -> db_Select("sgallery_cats", "cat_id, title as ctitle", (ADMIN ? '1 ' : 'active>0 ')."ORDER BY cat_order ASC")) {
                $cats = $sql->db_getList('ALL', FALSE, FALSE, 'cat_id');
                
                foreach ($cats as $cid=>$crow) {
                	
                	$afound = '';
                    foreach ($rows as $aid=>$row) {
                        if($row['sgal_user']) {
                            $uids[$aid] = $row;
                            unset($rows[$aid]);
                            //continue;
                        }
                        
                        if($row['cat_id']!=$cid) continue;
                        
                        if($row['album_ustatus']) {
                            if($row['active']) $stat = SGAL_LANPBL_17;
                            else $stat = SGAL_LANPBL_19;
                        } else $stat = SGAL_LANPBL_18;
                        
                        $uname = '';
                        if(ADMIN && $row['sgal_user']) {
                            $tmp = explode('.', $row['sgal_user']);
                            unset($tmp[0]);
                            $uname = count($tmp) > 1 ? implode('.', $tmp) : $tmp[1];
                        } 
                        if(!ADMIN && $row['sgal_user']) {
                            //already restricted by sql query
                            $uname = USERNAME;
                        }
                        
                        
                        $afound .= "<option value='{$aid}'>&nbsp;&nbsp;&nbsp;".$tp->toHTML($row['title'], FALSE, 'TITLE')." [".($uname ? "{$uname} - " : '')."{$stat}]</option>\n";
                    }
                    $box .= "<optgroup label='&nbsp;--".str_replace(array('<', '>', '"', "'"), array('&lt;', '&gt;', '&quot;', '&#039;'), $crow['ctitle']).(!$afound ? ' ('.SGAL_LANPBL_6.')' : '')."--'>\n";
                    $box .= $afound."\n<!-- --></optgroup>";
                }
                
                
            }
            
            //user albums
            $loop = !empty($uids) ? $uids : $rows;
            unset($uids, $rows);
            //print_a($rows);
            $afound = '';
            foreach ($loop as $aid=>$row) {
                if($row['album_ustatus']) {
                    if($row['active']) $stat = SGAL_LANPBL_17;
                    else $stat = SGAL_LANPBL_19;
                } else $stat = SGAL_LANPBL_18;
                
                if(ADMIN) {
                    $tmp = explode('.', $row['sgal_user']);
                    unset($tmp[0]);
                    $uname = count($tmp) > 1 ? implode('.', $tmp) : $tmp[1];
                } elseif(!$uname) {
                    $uname = USERNAME;
                }
                

                $afound .= "<option value='{$aid}'>&nbsp;&nbsp;&nbsp;".$tp->toHTML($row['title'], FALSE, 'TITLE')." [".(ADMIN ? "{$uname} - " : '')."{$stat}]</option>\n";
            }
            
            $box .= "<optgroup label='&nbsp;--".str_replace(array('<', '>', '"', "'"), array('&lt;', '&gt;', '&quot;', '&#039;'), SGAL_LANPBL_7)." - ".(!ADMIN ? "{$uname} " : '').(!$afound ? ' ('.SGAL_LANPBL_6.')' : '')."--'>\n";
            $box .= $afound."\n<!-- --></optgroup>";
            //eQTimeOff();
			
			
			$parse_array['sgal_album_box'] .= $box."</select>";
        }
        if(!$box) $parse_array['sgal_album_box'] = SGAL_LANPBL_8;
        
        define('e_WYSIWYG', false);
        $insertjs = " onselect='storeCaret(this);' onclick='storeCaret(this);' onkeyup='storeCaret(this);' ";
        $parse_array['description_field'] = "<textarea class='tbox mngr-area' id='album_description' name='album_description' cols='80' rows='6'{$insertjs}>{$row['album_description']}</textarea><br />".display_help("help", 'body');
        $parse_array['new_album'] = "<input class='button' name='event[album_go2create]' id='album_go2create' value='".SGAL_LANPBL_4."' type='submit' />";
        $parse_array['data_form_close'] = "<input name='event[album_submit]' id='album_submit' value='1' type='hidden' />";
        $parse_array['data_form_close'] .= "</form>";  
		
		$tmpl = clSimpleParser($tmpl, $parse_array);
		// simple parse it
        return $tmpl = $tp->parseTemplate($tmpl, TRUE, $sgal_shortcodes);
	}
	
	function renderOptions($row=array(), $tmpl='') {
        global $sgal_pref, $tp, $sgal_shortcodes;
		if(!$tmpl) return '';
		if(!varsettrue($row['cat_id'], 0)) return '';
		
		if($this->mod == 'user') {

        }
		
		$parse_array = array();
        $sgal_param = array();
        
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
          
        $parse_array['uploadtype'] = "<select class='tbox' name='uploadtype'>";
        
        for ($i=0; $i<count($up_value); $i++)
        {
            $parse_array['uploadtype'] .= "<option value='".$up_value[$i]."'>".$up_name[$i]."</option>\n";
        }
        
        $parse_array['uploadtype'] .= "
        </select>
        "; 
        
        if(in_array('user_resize', $up_value)) {
            $parse_array['user_sizes'] = "<input class='tbox' style='text-align:right' type='text' name='user_resize_w' value='".$sgal_pref['sgal_w']."' size='4' maxlength='4' />&nbsp;px&nbsp;&nbsp;X&nbsp;&nbsp;<input style='text-align:right' class='tbox' type='text' name='user_resize_h' value='".$sgal_pref['sgal_h']."' size='4' maxlength='4' />&nbsp;px";
        }   
		
        $parse_array['data_form_open'] = "<form method='post' action='".e_SELF."?".e_QUERY."' enctype='application/x-www-form-urlencoded' id='publish'>";

		$parse_array['data_form_close'] = "</form>";  
		
		$tmpl = clSimpleParser($tmpl, $parse_array);
		// simple parse it
        return $tmpl = $tp->parseTemplate($tmpl, TRUE, $sgal_shortcodes);
	}
	
	function renderFinish($row=array()) {
        global $sgal_pref, $pref, $tp, $sgal_shortcodes, $sgalobj, $PLUGINS_DIRECTORY;
        if(!$row) 
            return SGAL_LANPBL_20;
        
        $ret = '';
        
        $album = unserialize($_SESSION['album_data']);
        
        $mf = '';
        $rt = '';
        if($this->mod=='user' && $pref['upload_maxfilesize']) {
            $mf = '
                  var dataTag = xml.createNode(1, "formdata", "");
                  dataTag.setAttribute("name", "MAX_FILE_SIZE");
                  dataTag.text = "'.$pref['upload_maxfilesize'].'";
                  postTag.appendChild(dataTag);
            ';
        }
        if($row['uploadtype'] != 'none') {
            $cfgarr = array();
            if($row['uploadtype'] == 'user_resize') {
                $cfg = array('w'=>varset($row['user_resize_w'],''), 'h'=>varset($row['user_resize_h'],''));
                $thclass = $sgalobj->loadObj('thumb_class'); 
                $cfgarr = $thclass->makeConfig($cfg, true); //srict - w,h only
            } elseif($row['uploadtype'] == 'restrict_resize' || $row['uploadtype'] == 'auto_resize') {
                $cfgarr = $sgalobj->defThconfig(true);//srict - w,h only
            }
            
            if($cfgarr) {
                $rt = '
                  var resizeTag = xml.createNode(1, "resize", "");
                  resizeTag.setAttribute("cx", "'.$cfgarr['w'].'");
                  resizeTag.setAttribute("cy", "'.$cfgarr['h'].'");
                  resizeTag.setAttribute("quality", "'.$cfgarr['q'].'");
                  
                  
                  files.item(i).appendChild(resizeTag);
                ';
            }
        }
        $ret = '
        <script type="text/javascript">
          // <![CDATA[
          // JS by Timothy Webb @ cisco.com  
         
          function publishItems() {
            var xml = window.external.Property("TransferManifest");
            var files = xml.selectNodes("transfermanifest/filelist/file");
            var flc = files.length;
            
            for (i = 0; i < flc; i++) {
                            
              var postTag = xml.createNode(1, "post", "");
              postTag.setAttribute("href", "'.e_SELF.'?gaction=finish");
              postTag.setAttribute("name", "file_userfile[]");
        
              '.$mf.'
        
              var dataTag = xml.createNode(1, "formdata", "");
              dataTag.setAttribute("name", "uploading");
              dataTag.text = "1";
              postTag.appendChild(dataTag);
              
              var dataTag = xml.createNode(1, "formdata", "");
              dataTag.setAttribute("name", "uploadtype");
              dataTag.text = "'.$row['uploadtype'].'";
              postTag.appendChild(dataTag);

              var dataTag = xml.createNode(1, "formdata", "");
              dataTag.setAttribute("name", "user_resize_w");
              dataTag.text = "'.$row['user_resize_w'].'";
              postTag.appendChild(dataTag);
              
              var dataTag = xml.createNode(1, "formdata", "");
              dataTag.setAttribute("name", "user_resize_h");
              dataTag.text = "'.$row['user_resize_h'].'";
              postTag.appendChild(dataTag);
        
              var dataTag = xml.createNode(1, "formdata", "");
              dataTag.setAttribute("name", "event[finish]");
              dataTag.text = "1";
              postTag.appendChild(dataTag);
        
              var dataTag = xml.createNode(1, "formdata", "");
              dataTag.setAttribute("name", "cat_id");
              dataTag.text = "'.intval($row['cat_id']).'";
              postTag.appendChild(dataTag);             
        
              files.item(i).appendChild(postTag);
              
              '.$rt.'
            }
            var uploadTag = xml.createNode(1, "uploadinfo", "");
            
            var htmluiTag = xml.createNode(1, "htmlui", "");
            var htmlscssPage = xml.createNode(1, "successpage", "");
            var htmlerrPage = xml.createNode(1, "failurepage", "");
            
            htmluiTag.text = "'.SITEURL.$PLUGINS_DIRECTORY.'sgallery/gallery.php?'.(!$album['sgal_user'] ? 'view.'.$row['cat_id'] : 'uview.'.$row['cat_id']).'";
            htmlscssPage.text = "'.SITEURL.$PLUGINS_DIRECTORY.'sgallery/publish_xp/publish.php?gaction=scss";
            htmlerrPage.text = "'.SITEURL.$PLUGINS_DIRECTORY.'sgallery/publish_xp/publish.php?gaction=err";
            
            uploadTag.appendChild(htmluiTag);
            uploadTag.appendChild(htmlscssPage);
            uploadTag.appendChild(htmlerrPage);
            
            xml.documentElement.appendChild(uploadTag);
        
            window.external.Property("TransferManifest")=xml;
            window.external.FinalNext();
          }
        
          publishItems();
          // ]]>
        </script>
        ';
	   return $ret;
	}

	
}
?>