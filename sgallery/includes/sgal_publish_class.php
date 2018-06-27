<?php
class sgal_publish_class{
	var $obj = false;
	function sgal_publish_class(&$obj) {
		$this->obj = $obj;
	}
	
	function renderLoginForm($frm='') {
		if(!$frm) {
			$frm = "
				<form action='".e_SELF."' enctype='application/x-www-form-urlencoded' method='post' id='publish'>
				<script type='text/javascript'>
				setSubtitle('".SGAL_LANPBL_1."');
				setSubmitOnNext(true);
				setButtons(false, true, false);
				</script>
				<table class='fborder' style='margin-top: 10px; padding: 5px'>
				<tr>
					<td class='fcaption' colspan='2'>Please login</td>
				</tr>
				<tr>
					<td class='forumheader3'>".SGAL_LANPBL_2." </td>
					<td class='forumheader3'><input class='tbox' id='username' type='text' name='username' size='16' value='' maxlength='30' /></td>
				</tr>
				<tr>
					<td class='forumheader3'>".SGAL_LANPBL_3." </td>
					<td class='forumheader3'>
						<input class='tbox' id='userpass' type='password' name='userpass' size='16' value='' maxlength='20' />
						<input type='hidden' name='userlogin' value='1' />
					</td>
				</tr>
				</table>
				<script type='text/javascript'>document.getElementById('publish')['username'].focus();</script>
				</form>
			";
		}
		return $frm;
	}
	
	function render_albums($tmpl='') {

        if(!$tmpl) {
			$tmpl = "
		        {DATA_FORM_OPEN}
				<div style='width: 98%; margin: 10px auto; text-align: center'>{SGAL_ALBUM_BOX}
				<div style='float: left; clear: both; '>{NEW_ALBUM}</div>
                </div>
		        {DATA_FORM_CLOSE}
			";
		}
		
		$tmpl .= "
			<script type='text/javascript'>
			setSubtitle('".SGAL_LANPBL_4a."');
			setSubmitOnNext(true);
			setButtons(false, true, false);
			</script>
		";

		if(!$this->obj) return ''; 
		$clrender = $this->obj->loadObj('galrender_class'); 
		if(ADMIN && getperms("P")) $mod = 'admin';
		else $mod = 'user';
		
		$clrender -> setmod($mod);
		
		return $clrender -> renderList($_POST, $tmpl);
	}
	
	function render_options($tmpl='') {
        if(!varsettrue($_GET['cat_id'], 0) || !is_numeric($_GET['cat_id'])) {
			$_SESSION['sessmsg'] = SGAL_LANPBL_9;
			$this->publish_sessmsg(e_SELF."?gaction=albums");
        }
       
        $_POST['cat_id'] = $_GET['cat_id'];
		if(!$tmpl) {
		    include_lan(SGAL_LAN.'_render.php'); 
			$tmpl = "
		        <table style='width: 95%; text-align: center; margin: 10px auto; padding: 10px'>
		        <tr>
		          <td style='padding: 5px; font-weight: bold'>".SGAL_LANPBL_11.":</td>
				</tr>
		        <tr>
		          <td style='padding: 0px 5px;'>{UPLOADTYPE}</td>
				</tr>
		        <tr>
		          <td style='padding: 5px; font-weight: bold'>".SGAL_LANPBL_12." <span class='smalltext'>(".SGAL_LANPBL_13.")</span>:</td>
				</tr>
		        <tr>
		          <td style='padding: 0px 5px;'>{USER_SIZES}</td>
				</tr>
		        <tr>
		          <td style='padding: 5px 5px;'>".SGAL_LANPBL_24."</td>
				</tr>
                </table>
			";
		}
		
		$tmpl = "{DATA_FORM_OPEN}
            {$tmpl}
            <input type='hidden' name='cat_id' value='{$_POST['cat_id']}' />
            <input type='hidden' name='event[finish]' value='1' />
            {DATA_FORM_CLOSE}
			<script type='text/javascript'>
			setSubtitle('".SGAL_LANPBL_10."');
			setSubmitOnNext(true);
			setOnBackUrl('".SGAL_PUBLISH_ABS."publish.php?gaction=albums');
			setButtons(true, true, false);
			</script>
		";

		if(!$this->obj) return ''; 
		$clrender = $this->obj->loadObj('galrender_class'); 
		if(ADMIN && getperms("P")) $mod = 'admin';
		else $mod = 'user';
		
		$clrender -> setmod($mod);
		
		return $clrender -> renderOptions($_POST, $tmpl);
	}
	
	function render_album_create($tmpl='') {
		if(!$tmpl) {
			$cat_box_pre = "<tr><td>".SGAL_GALLERY.":</td></tr><tr><td>";
			$cat_box_post = "</td></tr>";
			$tmpl = "
		        {DATA_FORM_OPEN}
		        <table style='width: 95%; text-align: center; margin: 10px auto;'>
		        {SGAL_CATEGORY_BOX=%%".$cat_box_pre."%%".$cat_box_post."%%}
		        <tr>
		            <td>".SGAL_LANMNG_8.":</td>
		        </tr>
		        <tr>
		            <td>{TITLE_FIELD}</td>
		        </tr>
		        <tr>
		            <td>".SGAL_LANMNG_9.":<br />{DESCRIPTION_FIELD}</td>
		        </tr>
		        <tr>
		            <td style='text-align: left'>{NEW_ALBUM}&nbsp;{CANCEL_NEW_ALBUM}</td>
		        </tr>
		        </table>
				<script type='text/javascript'>document.getElementById('publish')['title'].focus();</script>
		        {DATA_FORM_CLOSE}
			";

		}
		
		$tmpl .= "
			<script type='text/javascript'>
			setSubtitle('".SGAL_LANPBL_4."');
			setSubmitOnNext(true);
			setOnBackUrl('".SGAL_PUBLISH_ABS."publish.php?gaction=albums');
			setButtons(true, false, false);
			</script>
		";

		if(!$this->obj) return ''; 
		$clrender = $this->obj->loadObj('galrender_class'); 
		if(ADMIN && getperms("P")) $mod = 'admin';
		else $mod = 'user';
		
		$clrender -> setmod($mod);
		
		return $clrender -> renderNew($_POST, $tmpl);
	}
	
	function render_finish() {
		global $sgal_pref, $pref, $tp, $sql, $sgal_shortcodes;
        
        if(!varsettrue($_POST['cat_id'], 0) ) return '';
        
        $_POST['cat_id'] = intval($_POST['cat_id']);
        
        $ret = "
			<script type='text/javascript'>
			setSubtitle('');
			setSubmitOnNext(true);
			setOnBackUrl('".SGAL_PUBLISH_ABS."publish.php?gaction=options');
			setButtons(false, true, false);
			</script>
		";
		
		if(!$this->obj) return ''; 
		$clrender = $this->obj->loadObj('galrender_class'); 
		if(ADMIN && getperms("P")) $mod = 'admin';
		else $mod = 'user';
		
        //album db check
        $wh = $mod == 'user' ? " AND sgal_user LIKE '".USERID.".%'" : '';
        if(!$sql->db_Select('sgallery','*',"album_id='{$_POST['cat_id']}'{$wh}")) {
            $_SESSION['sessmsg'] = SGAL_LANPBL_20;
            $this->publish_sessmsg(e_SELF."?gaction=albums");
        }
        
        $_POST['album_data'] = $sql -> db_Fetch();
        $_SESSION['album_data'] = serialize($_POST['album_data']);
		
		//  Final check ------------------------------------------>
		$_POST['cl_currentcnt'] = '0';
		$tmp = array();
        //permissions && limits
        if($mod == 'user') {
       
            if(!check_class($sgal_pref['sgal_usermod_allow']) || !check_class($pref['sgal_active'])) {
                $_SESSION['sessmsg'] = SGAL_LANPBL_16;
                $this->publish_sessmsg(e_SELF."?gaction=albums");
            }
                

                
            //load user stats
    		if(!$sgal_shortcodes)
    			require_once(SGAL_INCPATH."sgal_batch.php");
    			
            $tp->parseTemplate('{SGAL_USER_MYSTATS}', FALSE, $sgal_shortcodes); 
            
            $tstats = getcachedvars('sgal_useritem');
            $tmp = getcachedvars('sgal_useritem_'.USERID);
            $alstats = $tmp[$_POST['cat_id']];
            unset($tmp);

            //total upload limit
    		if($sgal_pref['sgal_usermod_totalsize'] && $tstats['sgal_user_totalpicsize'] >= $sgal_pref['sgal_usermod_totalsize']) {
    			$_SESSION['sessmsg'] = SGAL_LANMNG_15;
    			$this->publish_sessmsg(e_SELF."?gaction=albums");
    		}
    		//this album upload limit
    		if($sgal_pref['sgal_usermod_albumsize'] && $alstats['sgal_user_alpicsize'] >= $sgal_pref['sgal_usermod_albumsize']) {
    			$_SESSION['sessmsg'] = SGAL_LANMNG_16;
    			$this->publish_sessmsg(e_SELF."?gaction=albums");
    		}
    		
    		//this album file count limit
    		if($sgal_pref['sgal_usermod_piccount'] && ( ($alstats['sgal_user_alpicnumber'] + $alstats['sgal_user_alawpicnumber']) >= $sgal_pref['sgal_usermod_piccount'] ) ) {
    			$_SESSION['sessmsg'] = SGAL_LANMNG_17;
    			$this->publish_sessmsg(e_SELF."?gaction=albums");
    		}
    		$_POST['cl_currentcnt'] = $alstats['sgal_user_alpicnumber'] + $alstats['sgal_user_alawpicnumber'];
    		$tmp = array('total'=>$tstats, 'album'=>$alstats);
    		
            
        }
        $tmp['mod'] = $mod; 
        $_SESSION['user_limits'] = serialize($tmp);
        // End Final check ------------------------------------------>
		
		// render js based wizard communication
		$clrender -> setmod($mod);

		return $clrender -> renderFinish($_POST);
		
		
	}

	function render_uploaded() {
	   //no output during xp upload
       return '';
	}
	
	function render_scss() {
	   //no output during xp upload
        $msg = $_SESSION['end_msg'];
        if(ADMIN && $pref['developer']) {
            print_a($_SESSION['debug']);
        }
        //logout - class2.php
        $msg .= "<br /><br />".SGAL_LANPBL_23."<br style='clear: both' />
            <form method='post' action='".e_SELF."?".e_QUERY."' enctype='application/x-www-form-urlencoded' id='publish'>
            <input type='hidden' name='event[end]' value='1' />
            </form>
			<script type='text/javascript'>
			setSubtitle('".SGAL_LANPBL_21."');
			setSubmitOnNext(true);
			setButtons(false, true, true);
			</script>
        ";
        unset($_SESSION['posted_options'],$_SESSION['album_data'],$_SESSION['user_limits'],$_SESSION['end_msg'],$_SESSION['debug']);
        return $this->publish_msg($msg, true);
	}
	
	function render_err() {
	    global $pref;
        //error!
        if(ADMIN && $pref['developer']) {
            print_a($_SESSION['debug']);
        }
        $msg = $_SESSION['end_msg'];
        $msg .= "<br /><br />".SGAL_LANPBL_23."<br style='clear: both' />
            <form method='post' action='".e_SELF."?".e_QUERY."' enctype='application/x-www-form-urlencoded' id='publish'>
            <input type='hidden' name='event[end]' value='1' />
            </form>
			<script type='text/javascript'>
			setSubtitle('".SGAL_LANPBL_22."');
			setSubmitOnNext(true);
			setButtons(false, true, true);
			</script>
        ";
        unset($_SESSION['posted_options'],$_SESSION['album_data'],$_SESSION['user_limits'],$_SESSION['end_msg'],$_SESSION['debug']);
        return $msg;
	}
	
	function render_end() {
        global $sql, $pref;
        //logout - class2.php
    	$udata=USERID.".".USERNAME;
    	$sql->db_Update("online", "online_user_id = '0', online_pagecount=online_pagecount+1 WHERE online_user_id = '{$udata}' LIMIT 1");

    	session_destroy();
    	$_SESSION[$pref['cookie_name']]="";
    
    	cookie($pref['cookie_name'], "", (time() - 2592000));
    	
        $msg .= "
			<script type='text/javascript'>
			setSubtitle('');
			setSubmitOnNext(false);
			setButtons(false, false, true);
			window.external.FinalNext();
			</script>
        ";
        return $this->publish_msg($msg, true);
	}
	
	function event_end() {
	   $this->publish_sessmsg(e_SELF.'?gaction=end');
	}
	
	function event_album_go2create() {
		session_write_close();
		header('Location:'.e_SELF.'?gaction=album_create');
		exit;
	}
	
	function event_album_create_cancel() {
		session_write_close();
		header('Location:'.e_SELF.'?gaction=albums');
		exit;
	}
	
	function event_album_create() {
        global $sgal_pref, $tp, $sql, $sgal_shortcodes;
		$row = array();
        $insert = array();
		
        if(!ADMIN && !check_class($sgal_pref['sgal_usermod_albumcreate'])) {
            $_SESSION['sessmsg'] = SGAL_LANPBL_16;
			publish_sessmsg(e_SELF."?gaction=albums");
            exit;
        }
		
        //load user stats
		if(!$sgal_shortcodes)
			require_once(SGAL_INCPATH."sgal_batch.php");
			
        $tp->parseTemplate('{SGAL_USER_MYSTATS}', FALSE, $sgal_shortcodes); 
        
        $tstats = getcachedvars('sgal_useritem');
        $tmp = getcachedvars('sgal_useritem_'.USERID);
        $alstats = $tmp[$id];
        unset($tmp);
        
		if(ADMIN && getperms("P")) $mod = 'admin';
		else $mod = 'user';
		
		if($mod!='admin' && $sgal_pref['sgal_usermod_albumcount'] && $tstats['sgal_user_albumnumber'] >= $sgal_pref['sgal_usermod_albumcount']) {
			$_SESSION['sessmsg'] = SGAL_LANMNG_23."<br />".SGAL_LANMNG_24;
			$this->publish_sessmsg(e_SELF."?gaction=albums");
		}

		$insert['title'] = $tp -> toDB(trim(varset($_POST['title'],'')));
		$_POST['title'] = $tp -> post_toForm(varset($_POST['title'],''));
		$insert['album_description'] = $tp -> toDB(trim(varset($_POST['album_description'], '')));
		$_POST['album_description'] = $tp -> post_toForm(varset($_POST['album_description'],''));

		
		$insert['dt'] = time();
		$insert['active'] = 1;
		$insert['sgal_user'] = USERID.'.'.USERNAME;
		$insert['album_ustatus'] = $sgal_pref['sgal_usermod_albumcreate_approve'] && $mod!='admin' ? 0 : 1;
		
		if($mod=='admin') { 
            $insert['cat_id'] = $_POST['cat_id'] ? intval($_POST['cat_id']) : 0; 
            $_POST['cat_id'] = $insert['cat_id'];
        }
		elseif(isset($_POST['cat_id']) && check_class($sgal_pref['sgal_usermod_galleries'])) {
			$insert['cat_id'] = $_POST['cat_id'] ? intval($_POST['cat_id']) : 0;
			$_POST['cat_id'] = $insert['cat_id'];
		}

		if(!$insert['title']) {
			$_SESSION['sessmsg'] = SGAL_LANMNG_10;
		} else {               
			//check insert id, create dir, redirect
			$inserted_id = $sql->db_Insert("sgallery", $insert);
			if($inserted_id) {
				$clactions = $this -> obj -> loadObj('actions_class');
				$uniq_str = $clactions -> uniq_str();
				if($uniq_str && !is_dir(SGAL_ALBUMPATH.$uniq_str) && mkdir(SGAL_ALBUMPATH.$uniq_str, 0777)) {
					if($sql->db_Update("sgallery", "path='{$uniq_str}' WHERE album_id='{$inserted_id}' ")) {
						$_SESSION['sessmsg'] = SGAL_LANMNG_25.( $sgal_pref['sgal_usermod_albumcreate_approve'] && $mod!='admin' ? '<br />'.SGAL_LANMNG_26 : '' );
						$this->publish_sessmsg(e_SELF."?gaction=albums");
						exit;
					}
					rmdir(SGAL_ALBUMPATH.$uniq_str);
				}
			}
			
			$_SESSION['sessmsg'] = SGAL_LANMNG_27;
		}
	}
	
	function event_album_submit() {
		if(varsettrue($_POST['cat_id'], 0) && is_numeric($_POST['cat_id'])) {
            session_write_close();
    		header('Location:'.e_SELF.'?gaction=options&cat_id='.$_POST['cat_id']);
    		exit;
        }
        $_SESSION['sessmsg'] = SGAL_LANPBL_9;
	}
	

	
	function event_finish() {
        global $action, $sgalobj, $sql, $e107, $sgal_pref;
        
        //file submitted
        if(isset($_POST['uploading'])) {
            //upload options
            $_SESSION['debug'][] = array('pst'=>$_POST, 'fl'=>$_FILES['file_userfile']);
            
            $options = unserialize($_SESSION['posted_options']);
            
            //limit info - quick check
            $tmp = unserialize($_SESSION['user_limits']);
            $tstats = varset($tmp['total'], '');
            $alstats = varset($tmp['album'], '');
            $mod = $tmp['mod'];
            unset($tmp);
            
            //album data (cached by render method)
            $album = unserialize($_SESSION['album_data']);
            
            //upload
            $upload_limit=array();
            $upload_limit['total'] = $tstats['sgal_user_totalpicsize'];
            $upload_limit['album'] = $alstats['sgal_user_alpicsize'];
            $upload_limit['picnum'] = $alstats['sgal_user_alpicnumber'] + $alstats['sgal_user_alawpicnumber'];
            
            $clactions = $sgalobj->loadObj('actions_class'); 
            $imagepath = SGAL_ALBUMPATH.$album['path'];
            //upload submitted!
            $_POST['submitupload'] = 1;
            $msg = $clactions -> uploadImage($imagepath, $imagepath, $sgalobj, true, $mod, $upload_limit);
            $uploaded = getcachedvars('c_sgal_resized');
            if($mod == 'user' && $sgal_pref['sgal_usermod_picapprove'] && !empty($uploaded)) {

                if($sql->db_Count('sgallery_submit','(*)',"WHERE submit_album_id='{$album['album_id']}'")) {
                    $update = "submit_album_id='{$album['album_id']}', submit_user='".(USERID.".".USERNAME)."', submit_dt='".time()."', submit_ip='".$e107->getip()."', submit_picnum='".(varsettrue($alstats['sgal_user_alawpicnumber'], 0)+count($uploaded))."'";
                    $sql -> db_Update("sgallery_submit", "{$update} WHERE submit_album_id='{$album['album_id']}'");
                } else {
                    $insert = array();
                    $insert['submit_album_id'] = $album['album_id'];
                    $insert['submit_user'] = USERID.".".USERNAME;
                    $insert['submit_dt'] = time();
                    $insert['submit_ip'] = $e107->getip();
                    $insert['submit_picnum'] = count($uploaded);
                    $sql->db_Insert("sgallery_submit", $insert);
                }
            }
            if(!empty($msg) && is_array($msg)) {
                if(count($msg) > 1 ) $msg = implode(' ', $msg);
                else $msg = $msg[0];
                $_SESSION['end_msg'] .= $msg;
            }
            //no output
            //$action['render'] = 'uploaded';
            //$this -> render_uploaded();
            exit; 
            
        } else {
            //first run
            $_SESSION['posted_options'] = serialize($_POST);
            $_SESSION['end_msg'] = '';
            $action['render'] = 'finish';
            return true;
        }

	}
	
	function handleRequest($req=array(), $mod='', $args='') {
		
		if($mod!='event' && $mod!='render') return '';
		if(empty($req) || !isset($req[$mod]) || !$req[$mod]) return '';
		
		$tmp = $mod.'_'.$req[$mod];
		//echo $tmp;
		if(method_exists($this,$tmp)) {
			return $this->$tmp($args);
		}
		else {
            $this->publish_msg(SGAL_LANPBL_15);
            exit;
        }
		return false;	
	}
	
    function detectReg($os=''){
	   if($os == 'xp' || $os == 'vista')
	       return $os;
	       
	    if(!($ua = $_SERVER['HTTP_USER_AGENT']))
	       return 'xp'; //TO DO - default as a pref
        
        if(strpos($ua, 'Windows NT 6') !== FALSE)
            return 'vista';  
        else 
            return 'xp';
	}
	
	function generateReg($os=''){
	    global $PLUGINS_DIRECTORY, $THEMES_DIRECTORY, $e107;
	    // Gallery 2 publishxp - 
	    //@author Timothy Webb <tiwebb@cisco.com>
	    //modified by secretr
	    /* OS choice (xp, vista or auto-detect) */
        $os = $this -> detectReg($os);
	    
	    switch ($os) {
            case 'xp':
            	$reg_path = "[HKEY_CURRENT_USER\Software\Microsoft\Windows\CurrentVersion\Explorer\PublishingWizard\PublishingWizard\Providers\{PATH}]";
                break; 
                
            case 'vista':
            	$reg_path = "[HKEY_CURRENT_USER\Software\Microsoft\Windows\CurrentVersion\Explorer\PublishingWizard\InternetPhotoPrinting\Providers\{PATH}]";
                break; 
         }
	    
    	/* Setup the headers for the Registry file */
    	header("Cache-control: private");
    	header("Content-Type: application/octet-stream");
    	header("Content-Disposition: filename=cl_gallery_{$os}_install.reg");
    	
    	$parse_array = array();
    	$parse_array['path'] .= 'corrleteLab_gallery';
        $parse_array['path'] .= $_SERVER['HTTP_X_FORWARDED_HOST'] ? '_'.$_SERVER['HTTP_X_FORWARDED_HOST'] : '_'.$_SERVER['HTTP_HOST'];
    	$parse_array['title'] = "Corllete Lab Gallery @ ".SITEURL;
    	$parse_array['descr'] = SGAL_LANPBL_25." ".SITENAME;
    	$parse_array['href'] = SITEURL.$PLUGINS_DIRECTORY.'sgallery/publish_xp/membersonly.php';
    	$parse_array['icon'] = file_exists(THEME."favicon.ico") ? $e107->http_path.substr(THEME_ABS, 1).'favicon.ico' : SITEURL.'favicon.ico';
    	
    	$tmpl = "Windows Registry Editor Version 5.00\n{$reg_path}"
        ."\n\"displayname\"=\"{TITLE}\""
        ."\n\"description\"=\"{DESCR}\""
        ."\n\"href\"=\"{HREF}\""
        ."\n\"icon\"=\"{ICON}\"";
        
        $ret = clSimpleParser($tmpl, $parse_array);
        //windows line end
        $ret = preg_replace("/(?<!\r)\n/", "\r\n", $ret);
        // convert to propper enconding
        $code = $this -> _getCharsetFromRequest();
        echo $this -> convertFromUtf8($ret, $code);

        return null;
    }
	
    function publish_msg($msg='', $return=false) {
        global $sgal_pref;
        if(!$msg) return '';
		$txt = '
			<div class="cap_border" style="width: 100%">
				<div class="main_caption">
					<div class="bevel">'.SGAL_PAGE_NAME.' - '.SGAL_LANPBL_14.'</div>
				</div>
			</div>
			<table class="cont" style="width: 100%;">
			<tr>
				<td class="menu_content" style="width: 100%">
					<div style="text-align: center; font-weight: bold;">
						'.$msg.'
					</div>
				</td>
			</tr>
			</table>';

        if($return) {
            return $txt;
        }
        echo $txt;
    }
	
    function publish_sessmsg($loc='') {
        session_write_close();
        header("Location: ".($loc ? $loc : e_SELF.(e_QUERY ? '?'.e_QUERY: '')));
        exit;
    }
    
    /** @author Timothy Webb <tiwebb@cisco.com>
     * Maps the locale of the HTTP request to a corresponding Windows character set.
     * To detect the locale, the following precedence is applied:
     *  1) Preferred locale of the user (check session locale) unless it is equal to the default
     *  2) HTTP_ACCEPT_LANGUAGE header (what does the system of the client accept)
     *  3) Gallery site-wide default locale (might not be supported by system of the client)
     *
     * @return string A Microsoft Windows character set
     */
    function _getCharsetFromRequest() {
    
    	//just in case
        $tmp = explode('_', CORE_LC);
    	$lanCode = strtolower($tmp[0]);
    
    	/*
    	 * Lookup table: language code to Windows Code Page. Source:
    	 * http://www.microsoft.com/globaldev/reference/oslocversion.mspx
    	 */
    	switch ($lanCode) {
    	    case 'th': /* Thai */
    		$codePage = 874;
    		break;
    	    case 'ja': /* Japanese */
    		$codePage = 932;
    		break;
    	    case 'zh': 
    		  if(CORE_LC2 == 'cn') $codePage = 936;/* Chinese (Simplified) */
    		  else $codePage = 950;/* Chinese (Traditional) */
    		break;
    	    case 'ko': /* Korean */
    		$codePage = 949;
    		break;
    	    case 'hr': /* Croatian */
    	    case 'cs': /* Czech */
    	    case 'hu': /* Hungarian */
    	    case 'po': /* Polish */
    	    case 'ro': /* Romanian */
    	    case 'sk': /* Slovak */
    	    case 'sl': /* Slovenian */
    		$codePage = 1250;
    		break;
    	    case 'bg': /* Bulgarian */
    	    case 'ru': /* Russian */
    		$codePage = 1251;
    		break;
    	    case 'ca': /* Catalan */
    	    case 'da': /* Danish */
    	    case 'nl': /* Dutch */
    	    case 'en': /* English */
    	    case 'fi': /* Finnish */
    	    case 'fr': /* French */
    	    case 'de': /* German */
    	    case 'it': /* Italian */
    	    case 'no': /* Norwegian */
    	    case 'pt': /* Portuguese */
    	    case 'es': /* Spanish */
    	    case 'sv': /* Swedish */
    		$codePage = 1252;
    		break;
    	    case 'el': /* Greek */
    		$codePage = 1253;
    		break;
    	    case 'tr': /* Turkish */
    		$codePage = 1254;
    		break;
    	    case 'he': /* Hebrew */
    	    case 'iw': /* Hebrew (legacy) */
    		$codePage = 1255;
    		break;
    	    case 'ar': /* Arabic */
    		$codePage = 1256;
    		break;
    	    case 'et': /* Estonian */
    	    case 'lv': /* Latvian */
    	    case 'lt': /* Lithuanian */
    		$codePage = 1257;
    		break;
    	    default: $codePage = 1252;
    	}
    	return 'Windows-' . $codePage;
    }
    
     /* @author Bharat Mediratta <bharat@menalto.com>
     *  @package Gallery2 core
     * Warning: If neither iconv, mb_convert_encoding, or recode_string is available
     *          returns the input string
     */
    function convertFromUtf8($string, $targetEncoding=false) {

    	if(empty($targetEncoding)) $targetEncoding = CHARSET;
        if (strtolower($targetEncoding) == 'utf-8') {
    	    return $string;
    	}
    
    	/* Iconv can return false, so try it first.  If it fails, continue */

        $ret = '';
    	if (function_exists('mb_convert_encoding')) {
    	    $ret = mb_convert_encoding($string, $targetEncoding, 'UTF-8');
    	} elseif (function_exists('iconv')) {
    	    if (($ret = iconv('UTF-8', $targetEncoding . '//IGNORE', $string)) !== false) {
    		  return $ret;
    	    }
    	} else if (function_exists('recode_string')) {
    	    $ret = recode_string('UTF-8..' . $targetEncoding, $string);
    	} 
    	
    	if(!$ret) $ret = $string;
    	return $ret;
    }
}
?>