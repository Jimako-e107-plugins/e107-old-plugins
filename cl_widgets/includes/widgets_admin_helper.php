<?php
/*
+ ----------------------------------------------------------------------------------------------------+
|        e107 website system
|        Email: office@clabteam.com
|        Organization: Corllete (R) Lab Copyright 2007 Corllete ltd. - www.clabteam.com
|        $Id: widgets_admin_helper.php 841 2010-01-20 12:26:25Z secretr $
|        License: GNU GENERAL PUBLIC LICENSE - http://www.gnu.org/licenses/gpl.txt
+----------------------------------------------------------------------------------------------------+
*/

if (!defined('e107_INIT')) { exit; }

require_once(CLW_COMPAT_PATH.'message_handler.php');

class clw_helper {

    function render_installed() {
        global $CLW_SYSMSG, $pref;

        $emessage = &eMessage::getInstance();

        $widget_list = clw_utils_getall_wdata();

        $widget_installed_list = clw_widget::getInstalled(true);
        $widget_missing_list = array();

        $widget_installed = '';


        //installed
        foreach ($widget_installed_list as $w => $ver) {
        	$w = trim($w);

            if(varset($widget_list[$w])) {
                $wdata = $widget_list[$w];

                $title = $wdata['title'];

                $icon = "<img src='".($wdata['icon'] ? $wdata['icon'] : CLW_APP.'images/icon_32.png')."' style='border: 0 none' alt='{$wdata['title']}' />";
                $configure = '';
                if(varset($wdata['administration'])) {
                    $url = CLW_WIDGETS_ABS."{$w}/admin_config.php";
                    $icon = "<a href='{$url}'>{$icon}</a>";
                    $configure = "<div style='float: right;' onclick=\"location.href='{$url}'\"><a href='{$url}' title='".CLW_LANLIST_6."'><img src='".CLW_APP_ABS."images/configure_48.png' alt='".CLW_LANLIST_6."' style='padding: 5px; margin: 2px; border: 1px solid #c1c1c1' /></a></div>";
                }
                $author = ($wdata['author_email'] ? "<a href='mailto:{$wdata['author_email']}'>" : "<a href='#' onclick='alert(\"".CLW_LANLIST_50."\"); return false;'>")."{$wdata['author']}</a>";
                $web = $wdata['author_website'] ? "<a href='http://{$wdata['author_website']}'>[".CLW_LANLIST_3."]</a>": '';

                //-1 === update required
                $ver1 = clw_helper::format_version($ver);
                $ver2 = clw_helper::format_version($wdata['version']);

                $update_check = version_compare($ver1, $ver2);
                //var_dump($ver1, $ver2, $update_check);

                $update_btn = '';
                if($update_check == -1) {
                	$update_btn = "<div style='clear: both; padding-top: 5px;'><input type='button' class='button' value='".CLW_LANLIST_7."' onclick=\"location.href='".CLW_APP_ABS.e_PAGE."?update.{$w}'\"  /></div>";
                } elseif ($update_check == 1) {
                	//$CLW_SYSMSG[] = '<strong>'.$title.' '.LAN_ERROR.'!</strong> '.CLW_LANLIST_10;
                	$emessage->add('<strong>'.$title.' '.LAN_ERROR.'!</strong> '.CLW_LANLIST_10, E_MESSAGE_ERROR);
                }

                $description = $license = $license_url = '';

                if($wdata['description'])
                	$description = '<p>'.$wdata['description'].'</p>';

                if($wdata['license_url'])
                	$license_url = "[<a href='{$wdata['license_url']}'>".CLW_LANLIST_9."</a>]";

                if($wdata['license'] || $license_url)
                	$license = '<p><strong>'.CLW_LANLIST_8.':</strong> '.($wdata['license'] ? $wdata['license'].'<br />' : '').''.$license_url.'</p>';

                $widget_installed .= "

            	<tr>
                    <td class='forumheader3' style='text-align: left; vertical-align: middle; width: 15%;'>
                        <table cellpadding='0' cellspacing='3' style='margin-left: 0px'>
                        <tr>
                        <td style='text-align: left; width: 32px'>{$icon}</td>
                        <td style='text-align: left; white-space: nowrap'><strong>{$title}</strong><br />".CLW_LANLIST_2.": {$ver}</td>
                        </tr>
                        </table>
                    </td>
            		<td class='forumheader3' style='text-align: left; width: 70%;'>
            		{$configure}
                    <strong>".CLW_LANLIST_1.":</strong> {$author} {$web}
                     {$description}{$license}
                    </td>
            		<td class='forumheader3' style='text-align: center; vertical-align: middle; width: 15%;'>
                        <input type='button' class='button' value='".CLW_LANLIST_5."' onclick=\"if(jsconfirm('".CLW_LANSYSMSG_CONFIRM."')) { location.href='".CLW_APP_ABS.e_PAGE."?uninstall.{$w}'; }; return false;\"  />
                        {$update_btn}
                    </td>
            	</tr>

                ";

            } else {
                $widget_missing_list[] = $w;
            }
        }

        if(!$widget_installed) {
            $widget_installed = "
        	<tr>
        		<td class='forumheader3' colspan='3' style='text-align: center'>".CLW_LANSYSMSG_5."</td>
        	</tr>
            ";
        }

        if($widget_missing_list) {
            $msg = 'Missing widget(s) - '.implode(', ', $widget_missing_list).'&nbsp; clean up button';
            $widget_installed = "
        	<tr>
        		<td class='forumheader3' colspan='3' style='text-align: center'>{$msg}</td>
        	</tr>
            ".$widget_installed;
        }

        //render
        $text = "

            <table class='fborder' style='width: 98%'>
            	<tr>
            		<td class='fcaption' colspan='3' style='text-align: left'><h3>".CLW_LANLIST_INSTALLED."</h3></td>
            	</tr>

                $widget_installed

        	</table>

        ";

        return $text;
    }

    function render_notinstalled() {
        global $CLW_SYSMSG, $pref;

        $widget_list = clw_utils_getall_wdata();
        $widget_installed_list = clw_widget::getInstalled();

        foreach ($widget_installed_list as $value) 
        {
        	unset($widget_list[$value]);
        }

        $widget_notinstalled = '';

        //not installed
        foreach ($widget_list as $wid=>$wdata) {
            $icon = $wdata['icon'] ? $wdata['icon'] : CLW_APP.'images/icon_32.png';
            $author = ($wdata['author_email'] ? "<a href='mailto:{$wdata['author_email']}'>" : "<a href='#' onclick='alert(\"".CLW_LANLIST_50."\"); return false;'>")."{$wdata['author']}</a>";
            $web = $wdata['author_website'] ? "<a href='http://{$wdata['author_website']}'>[".CLW_LANLIST_3."]</a>": '';
            
            $description = $license = $license_url = '';

            if($wdata['description'])
            	$description = '<p>'.$wdata['description'].'</p>';
            
            if($wdata['license_url'])
            	$license_url = "[<a href='{$wdata['license_url']}'>".CLW_LANLIST_9."</a>]";
            
            if($wdata['license'] || $license_url)
            	$license = '<p><strong>'.CLW_LANLIST_8.':</strong> '.($wdata['license'] ? $wdata['license'].' ' : '').''.$license_url.'</p>';
            
            
            $widget_notinstalled .= "
        	<tr>
                <td class='forumheader3' style='text-align: left; width: 15%;'>
                    <table cellpadding='0' cellspacing='3' style=' width: 170px; margin-left: 0px'>
                    <tr>
                    <td style='text-align: left; width: 32px'><img src='{$icon}' style='border: 0 none' alt='{$wdata['title']}' /></td>
                    <td style='text-align: left;'><strong>{$wdata['title']}</strong><br />".CLW_LANLIST_2.":{$wdata['version']}</td>
                    </tr>
                    </table>
                </td>
        		<td class='forumheader3' style='text-align: left; width: 70%;'>
                <strong>".CLW_LANLIST_1.":</strong> {$author} {$web}<br /><br />
					{$description}{$license}
                </td>
        		<td class='forumheader3' style='text-align: center; width: 15%;'>
                    <input type='button' class='button' value='".CLW_LANLIST_4."' onclick=\"location.href='".CLW_APP_ABS.e_PAGE."?install.{$wid}'\"  />
                </td>
        	</tr>
            ";
        }

        if(!$widget_notinstalled) {
            $widget_notinstalled = "
        	<tr>
        		<td class='forumheader3' colspan='3' style='text-align: center'>".CLW_LANSYSMSG_6."</td>
        	</tr>
            ";
        }

        //render
        $text = "

            <table class='fborder' style='width: 98%'>
            	<tr>
            		<td class='fcaption' colspan='3' style='text-align: left'><h3>".CLW_LANLIST_NOTINSTALLED."</h3></td>
            	</tr>

                $widget_notinstalled

        	</table>

        ";

        return $text;
    }

    function install_widget($id) {
        global $CLW_SYSMSG, $pref;

        $emessage = &eMessage::getInstance();

        //missing widget
        if(!$wdata = clw_utils_get_wdata($id)) {
            //$CLW_SYSMSG[] = CLW_LANMANAGE_2.' '.CLW_LANMANAGE_9;
            $emessage->add(CLW_LANMANAGE_2.' '.CLW_LANMANAGE_9, E_MESSAGE_ERROR);
            return false;
        }

        //installed list
        $widget_installed_list = clw_widget::getInstalled(true);

        //check if not already installed
        if(clw_widget::isInstalled($id)) {
            //$CLW_SYSMSG[] = CLW_LANMANAGE_1.' '.CLW_LANMANAGE_9;
            $emessage->add(CLW_LANMANAGE_1.' '.CLW_LANMANAGE_9, E_MESSAGE_ERROR);
            return false;
        }

        //pre-install
        $check = true;
        if($tmp = varset($wdata['install'])) {
        	$pt = CLW_WIDGETS.$id.'/'.varsettrue($wdata['install']['file'], 'null');
            if(is_readable($pt) && varsettrue($wdata['install']['class']) && varsettrue($wdata['install']['method'])) {
				require_once($pt);
                $check = call_user_func(array($wdata['install']['class'], $wdata['install']['method']), $wdata['version']);
            } elseif(is_readable($pt) && varsettrue($wdata['install']['function'])) {
				require_once($pt);
                $check = call_user_func($wdata['install']['function'], $wdata['version']);

            }
        }

        //pre-install error
        if(!$check) {
            //$CLW_SYSMSG[] = CLW_LANMANAGE_3.' '.CLW_LANMANAGE_20.' '.CLW_LANMANAGE_9;
            $emessage->add(CLW_LANMANAGE_3.' '.CLW_LANMANAGE_20.' '.CLW_LANMANAGE_9, E_MESSAGE_ERROR);
            return false;
        }

        /* ISNTALLATION */

        //add widget prefs
        if($wdata['settings']) {

            $pref['cl_widget_prefs'][$id] = $wdata['settings'];
        }

        //add to installed list
        $widget_installed_list[$id] = $wdata['version'];
        $pref['cl_widget_list'] = $widget_installed_list;

        //install bbcode - copy bb codes to the plugin root
        if(varset($wdata['bb']) && is_array($wdata['bb'])) {

        	clw_helper::install_bb_widget($id, $wdata, false);
        }

        //more to be done - TODO

        //save it
        clw_widget::savePrefs();

        //success msg
        //clw_sessmgs('<strong>'.$wdata['title'].'</strong> '.CLW_LANMANAGE_4);
        $emessage->addSession('<strong>'.$wdata['title'].'</strong> '.CLW_LANMANAGE_4, E_MESSAGE_SUCCESS);
        session_write_close();
        header('Location: '.CLW_APP_ABS.e_PAGE);
        exit;

    }

    function update_widget($id) {
        global $CLW_SYSMSG, $pref;

        $emessage = &eMessage::getInstance();

        //missing widget
        if(!$wdata = clw_utils_get_wdata($id)) {
            //$CLW_SYSMSG[] = CLW_LANMANAGE_16.' '.CLW_LANMANAGE_18;
            $emessage->add(CLW_LANMANAGE_16.' '.CLW_LANMANAGE_18, E_MESSAGE_ERROR);
            return false;
        }

        //installed list
        $widget_installed_list = clw_widget::getInstalled(true);

        //check if already installed
        if(!clw_widget::isInstalled($id)) {
            //$CLW_SYSMSG[] = CLW_LANMANAGE_1.' '.CLW_LANMANAGE_18;
            $emessage->add(CLW_LANMANAGE_1.' '.CLW_LANMANAGE_18, E_MESSAGE_ERROR);
            return false;
        }

        //pre-update
        $check = true;
        if($tmp = varset($wdata['update'])) {
        	$pt = CLW_WIDGETS.$id.'/'.varsettrue($wdata['update']['file'], 'null');
            if(is_readable($pt) && varsettrue($wdata['update']['class']) && varsettrue($wdata['update']['method'])) {

				require_once($pt);
                $check = call_user_func(array($wdata['update']['class'], $wdata['update']['method']), $wdata['version'], varsettrue($widget_installed_list[$id], 0));
            } elseif(is_readable($pt) && varsettrue($wdata['update']['function'])) {

				require_once($pt);
                $check = call_user_func($wdata['update']['function'], $wdata['version']);
            }
        }

        //pre-update error
        if(!$check) {
            //$CLW_SYSMSG[] = CLW_LANMANAGE_19.' '.CLW_LANMANAGE_20.' '.CLW_LANMANAGE_18;
            $emessage->add(CLW_LANMANAGE_19.' '.CLW_LANMANAGE_20.' '.CLW_LANMANAGE_18, E_MESSAGE_ERROR);
            return false;
        }

        /* UPGRADE */

        //merge widget prefs
        if(is_array($wdata['settings'])) {

        	//add new
        	foreach ($wdata['settings'] as $skey => $sval) {
        		if(!isset($pref['cl_widget_prefs'][$id][$skey])) {
        			$pref['cl_widget_prefs'][$id][$skey] = $sval;
        		}
        	}

        	//remove old
            foreach ($pref['cl_widget_prefs'][$id] as $skey => $sval) {
        		if(!isset($wdata['settings'][$skey])) {

        			$pref['cl_widget_prefs'][$id][$skey] = '';
        			unset($pref['cl_widget_prefs'][$id][$skey]);
        		}
        	}
        }

        //update installed list
        $widget_installed_list[$id] = $wdata['version'];
        $pref['cl_widget_list'] = $widget_installed_list;

        //update bbcode - copy bb codes to the plugin root
        if(varset($wdata['bb']) && is_array($wdata['bb'])) {

        	clw_helper::install_bb_widget($id, $wdata, true);
        }

        //more to be done - TODO

        //save it
        clw_widget::savePrefs();

        //success msg
        //clw_sessmgs('<strong>'.$wdata['title'].'</strong> '.CLW_LANMANAGE_17);
        $emessage->addSession('<strong>'.$wdata['title'].'</strong> '.CLW_LANMANAGE_17, E_MESSAGE_SUCCESS);
        session_write_close();
        header('Location: '.CLW_APP_ABS.e_PAGE);
        exit;
    }

    function uninstall_widget($id) {
        global $CLW_SYSMSG, $pref;

        $emessage = &eMessage::getInstance();

        //missing widget
        if(!$wdata = clw_utils_get_wdata($id)) {
            //$CLW_SYSMSG[] = CLW_LANMANAGE_5.' '.CLW_LANMANAGE_8;
            $emessage->add(CLW_LANMANAGE_5.' '.CLW_LANMANAGE_8, E_MESSAGE_ERROR);
            return false;
        }

        //installed list
        $widget_installed_list = clw_widget::getInstalled(true);

        //check if is installed
        if(!clw_widget::isInstalled($id)) {
            //$CLW_SYSMSG[] = CLW_LANMANAGE_1.' '.CLW_LANMANAGE_8;
            $emessage->add(CLW_LANMANAGE_1.' '.CLW_LANMANAGE_8, E_MESSAGE_ERROR);
            return false;
        }

        //pre-uninstall
        $check = true;
        if($tmp = varset($wdata['uninstall'])) {
        	$pt = CLW_WIDGETS.$id.'/'.varsettrue($wdata['uninstall']['file'], 'null');
            if(is_readable($pt) && varsettrue($wdata['uninstall']['class']) && varsettrue($wdata['uninstall']['method'])) {

				require_once($pt);
				$UI = call_user_func(array($wdata['uninstall']['class'], $wdata['uninstall']['method_ui']), $wdata['version']);
				//Check for UI callback data
				if(!empty($UI)) 
					return $UI;
				
                $check = call_user_func(array($wdata['uninstall']['class'], $wdata['uninstall']['method']), $wdata['version']);
            } elseif(is_readable($pt) && varsettrue($wdata['uninstall']['function'])) {

				require_once($pt);
				$UI = call_user_func($wdata['uninstall']['function_ui'], $wdata['version']);
				//Check for UI callback data
				if(!empty($UI)) 
					return $UI;
					
                $check = call_user_func($wdata['uninstall']['function'], $wdata['version']);
            }
        }

        //pre-uninstall error
        if(!$check) {
            //clw_sessmgs(CLW_LANMANAGE_6.' '.CLW_LANMANAGE_20);
            $emessage->addSession(CLW_LANMANAGE_6.' '.CLW_LANMANAGE_20, E_MESSAGE_ERROR);

        }

        /* UNISNTALLATION */

        //remove widget prefs
        if(isset($pref['cl_widget_prefs'][$id])) {
            $pref['cl_widget_prefs'][$id] = '';
            unset($pref['cl_widget_prefs'][$id]);
        }

        //remove from installed list
        unset($widget_installed_list[$id]);

        $pref['cl_widget_list'] = $widget_installed_list;

        //uninstall bbcode - delete bbcodes from the plugin root
        if(varset($wdata['bb']) && is_array($wdata['bb'])) {

        	clw_helper::uninstall_bb_widget($wdata);
        }
        //TODO more to be done

        //save it
        clw_widget::savePrefs();

        /* UNISNTALLATION END */


        //success msg
        //clw_sessmgs('<strong>'.$wdata['title'].'</strong> '.CLW_LANMANAGE_7);
        $emessage->addSession('<strong>'.$wdata['title'].'</strong> '.CLW_LANMANAGE_7, E_MESSAGE_SUCCESS);
        session_write_close();
        header('Location: '.CLW_APP_ABS.e_PAGE);
        exit;

    }

    function install_bb_widget($id, &$data, $overw=true) {

    	$emessage = &eMessage::getInstance();

    	$failed = array();
    	if(!is_writable(CLW_APP)) {
    		//$msg[] = CLW_APP_ABS.' '.LAN_NOTWRITABLE;
    		$emessage->addSession(CLW_APP_ABS.' '.LAN_NOTWRITABLE, E_MESSAGE_WARNING);
    	}

    	if(!$msg) {
			foreach ($data['bb'] as $bb) {
        		$bb = trim($bb, ' /');
				$bbpath = CLW_WIDGETS.$id.'/'.$bb;
        		$bbf = basename('/'.$bb);

				if(!is_readable($bbpath)) {
		    		//$msg[] = "<strong>{$bbf}</strong> - ".CLW_LANMANAGE_12c;
		    		$emessage->addSession("<strong>{$bbf}</strong> - ".CLW_LANMANAGE_12c, E_MESSAGE_WARNING);
		    		$failed[$bbf] = $bb;
		    		continue;
		    	}

		    	if(is_file(CLW_APP.$bbf)) {
		    		if(!$overw) {
		    			//$msg[] = "<strong>{$bbf}</strong> - ".CLW_LANMANAGE_12d;
		    			$emessage->addSession("<strong>{$bbf}</strong> - ".CLW_LANMANAGE_12d, E_MESSAGE_WARNING);
		    			$failed[$bbf] = $bb;
		    			continue;
		    		}

		    		@unlink(CLW_APP.$bbf);
		    	}

	    		if(!copy($bbpath, CLW_APP.$bbf)) {
	    			//$msg[] = "<strong>{$bbf}</strong> - ".CLW_LANMANAGE_12e;
	    			$emessage->addSession("<strong>{$bbf}</strong> - ".CLW_LANMANAGE_12e, E_MESSAGE_WARNING);
	    			$failed[$bbf] = $bb;
	    			continue;
	    		}

	    		@chmod(CLW_APP.$bb, 0755);
        	}
    	}

    	if($msg) {
    		//error or warning
    		//$msg = '<br />'.CLW_LANMANAGE_11.' '.CLW_LANMANAGE_12.'<br />'.implode('<br />', $msg);
    		$emessage->addSession(CLW_LANMANAGE_11.' '.CLW_LANMANAGE_12, E_MESSAGE_WARNING);

    		if($failed) {
    			$msg = CLW_LANMANAGE_13."<ul class='emessage-list'>";

    			foreach ($failed as $k => $v) {
    				$msg .= "<li>".CLW_LANMANAGE_12a.": <strong>".CLW_WIDGETS_ABS."$v</strong> =&gt; ".CLW_LANMANAGE_12b.": <strong>".CLW_APP_ABS.$k."</strong></li>";
    			}

    			$msg .= "</ul>";
    			$emessage->addSession($msg, E_MESSAGE_WARNING);
    		}

    		clw_sessmgs($msg.'<br />');
    		return false;
    	}

    	//update core routine!
		require_once(e_HANDLER."plugin_class.php");

		$p = new e107plugin;
		$p->update_plugins_table();
		$p->save_addon_prefs();

    	return true;
    }

	function uninstall_bb_widget(&$data) {

		$emessage = &eMessage::getInstance();
    	$failed = array();

    	if(!$msg) {
			foreach ($data['bb'] as $bb) {
        		$bb = trim($bb, ' /');
        		$bbf = basename('/'.$bb);
				$delpath = CLW_APP.$bbf;

				if(!is_readable($delpath)) {
		    		//$msg[] = "<strong>{$bbf}</strong> - ".CLW_LANMANAGE_12c;
		    		$emessage->addSession("<strong>{$bbf}</strong> - ".CLW_LANMANAGE_12c, E_MESSAGE_WARNING);
		    		$failed[] = $bbf;
		    		continue;
		    	}

		    	if(!unlink($delpath)) {
					//$msg[] = "<strong>{$bbf}</strong> - ".CLW_LANMANAGE_12f;
					$emessage->addSession("<strong>{$bbf}</strong> - ".CLW_LANMANAGE_12f, E_MESSAGE_WARNING);
					$failed[] = $bbf;
		    	}
        	}
    	}

    	if($msg) {
    		//error or warning
    		//$msg = '<br />'.CLW_LANMANAGE_14.'<br />'.implode('<br />', $msg);
    		$emessage->addSession(CLW_LANMANAGE_14, E_MESSAGE_WARNING);

    		if($failed) {
    			$msg = CLW_LANMANAGE_15."<ul class='emessage-list'>";

    			foreach ($failed as $v) {
    				$msg .= "<li>".CLW_LANMANAGE_12a.": <strong>".CLW_WIDGETS_ABS."$v</strong></li>";
    			}

    			$msg .= "</ul>";
    			$emessage->addSession($msg, E_MESSAGE_WARNING);
    		}

    		clw_sessmgs($msg.'<br />');
    		return false;
    	}

    	//update core routine!
		require_once(e_HANDLER."plugin_class.php");

		$p = new e107plugin;
		$p->update_plugins_table();
		$p->save_addon_prefs();

    	return true;
	}

	function render_config() {
    	global $pref;

    	$text = "
    		<div style='margin-left: auto; margin-right: auto'>
    		<table class='fborder' style='width: 98%'>
            	<tr>
            		<td class='fcaption' colspan='2' style='text-align: left'><h3>".CLW_LANCONFIG_1."</h3></td>
            	</tr>
    	";

        // Cache  ----------------------
       	$text .= "
				<tr>
					<td style='width:40%; text-align: left;' class='forumheader3'>".CLW_LANCONFIG_2."</td>
					<td style='width:60%; text-align: left' class='forumheader3'>
						<input type='radio' name='cl_widget_cache' value='1' id='cache_activate'".($pref['cl_widget_cache'] ? ' checked="checked"' : '')." />
						<label for='cache_activate'>".LAN_ENABLED."</label>
						&nbsp;&nbsp;&nbsp;
						<input type='radio' name='cl_widget_cache' value='0' id='cache_deactivate'".(!$pref['cl_widget_cache'] ? ' checked="checked"' : '')." />
						<label for='cache_deactivate'>".LAN_DISABLED."</label>
					</td>
				</tr>
        ";
       	
        // JS Compression  ----------------------
       	$text .= "
				<tr>
					<td style='width:40%; text-align: left;' class='forumheader3'>".CLW_LANCONFIG_10."</td>
					<td style='width:60%; text-align: left' class='forumheader3'>
						<input type='radio' name='cl_widget_jscompression' value='1' id='jscompress_activate'".($pref['cl_widget_jscompression'] ? ' checked="checked"' : '')." />
						<label for='jscompress_activate'>".LAN_ENABLED."</label>
						&nbsp;&nbsp;&nbsp;
						<input type='radio' name='cl_widget_jscompression' value='0' id='jscompress_deactivate'".(!$pref['cl_widget_jscompression'] ? ' checked="checked"' : '')." />
						<label for='jscompress_deactivate'>".LAN_DISABLED."</label>
					</td>
				</tr>
        ";

        // Debug (under construction) ----------------------
       	$text .= "
				<tr>
        			<td style='text-align: left;' class='forumheader3'>".CLW_LANCONFIG_3."</td>
         			<td style='text-align: left' class='forumheader3'>
						<input type='radio' name='cl_widget_debug' value='1' id='debug_activate'".($pref['cl_widget_debug'] ? ' checked="checked"' : '')." />
						<label for='debug_activate'>".LAN_ENABLED."</label>
						&nbsp;&nbsp;&nbsp;
						<input type='radio' name='cl_widget_debug' value='0' id='debug_deactivate'".(!$pref['cl_widget_debug'] ? ' checked="checked"' : '')." />
						<label for='debug_deactivate'>".LAN_DISABLED."</label>
         			</td>
         		</tr>
        ";

        // e107 v0.8 API ----------------------
       	$text .= "
				<tr>
        			<td style='text-align: left;' class='forumheader3'>".CLW_LANCONFIG_5."</td>
         			<td style='text-align: left' class='forumheader3'>
						<input type='radio' name='cl_08compat' value='1' id='cl_08compat_activate'".($pref['cl_08compat'] ? ' checked="checked"' : '')." />
						<label for='cl_08compat_activate'>".LAN_ENABLED."</label>
						&nbsp;&nbsp;&nbsp;
						<input type='radio' name='cl_08compat' value='0' id='cl_08compat_deactivate'".(!$pref['cl_08compat'] ? ' checked="checked"' : '')." />
						<label for='cl_08compat_deactivate'>".LAN_DISABLED."</label>
         			</td>
         		</tr>
        ";
       	
       	$text .= "
				<tr>
        			<td style='text-align: left;' class='forumheader3'>".CLW_LANCONFIG_6."</td>
         			<td style='text-align: left' class='forumheader3'>
						<input type='radio' name='cl_08compat_style' value='1' id='cl_08compat_style_activate'".($pref['cl_08compat_style'] ? ' checked="checked"' : '')." />
						<label for='cl_08compat_style_activate'>".LAN_ENABLED."</label>
						&nbsp;&nbsp;&nbsp;
						<input type='radio' name='cl_08compat_style' value='0' id='cl_08compat_style_deactivate'".(!$pref['cl_08compat_style'] ? ' checked="checked"' : '')." />
						<label for='cl_08compat_style_deactivate'>".LAN_DISABLED."</label>
         			</td>
         		</tr>
        ";
       	
       	$text .= "
				<tr>
        			<td style='text-align: left;' class='forumheader3'>".CLW_LANCONFIG_7."</td>
         			<td style='text-align: left' class='forumheader3'>
						<input type='radio' name='cl_08compat_style_admin' value='1' id='cl_08compat_style_admin_activate'".($pref['cl_08compat_style_admin'] ? ' checked="checked"' : '')." />
						<label for='cl_08compat_style_admin_activate'>".LAN_ENABLED."</label>
						&nbsp;&nbsp;&nbsp;
						<input type='radio' name='cl_08compat_style_admin' value='0' id='cl_08compat_style_admin_deactivate'".(!$pref['cl_08compat_style_admin'] ? ' checked="checked"' : '')." />
						<label for='cl_08compat_style_admin_deactivate'>".LAN_DISABLED."</label>
         			</td>
         		</tr>
        ";

        $text .= "
				<tr>
					<td style='text-align:center' colspan='3' class='forumheader'>
						<div class='f-right'>
							<input class='button' type='submit' name='submit_clear_cache' id='submit_clear_cache' value='".CLW_LANCONFIG_11."' />
							<input class='button' type='submit' name='submit_clear_allcache' id='submit_clear_allcache' value='".CLW_LANCONFIG_12."' />
						</div>
						<input class='button' type='submit' name='submit_config' id='submit_config' value='".LAN_SAVE."' />
					</td>
				</tr>
        ";

		$text .= "
            </table>
            </div>
    	";

		return $text;
	}

	/**
	 * Format version string for using it with version_compare()
	 *
	 * @param string $ver version string
	 * @return string formatted version string
	 */
	function format_version($ver) {

		$ver = str_replace(' ', '', strtolower($ver));

		return $ver = str_replace(array('rc', 'stable'), array('RC', 'pl'), $ver);
	}

}
?>