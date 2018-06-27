<?php
/*
+ ----------------------------------------------------------------------------------------------------+
|        e107 website system
|        Email: office@clabteam.com
|        Organization: Corllete (R) Lab Copyright 2007 Corllete ltd. - www.clabteam.com
|        $Id: widgets_admin_handler.php 841 2010-01-20 12:26:25Z secretr $
|        License: GNU GENERAL PUBLIC LICENSE - http://www.gnu.org/licenses/gpl.txt
+----------------------------------------------------------------------------------------------------+
*/

if (!defined('e107_INIT')) { exit; }

    require_once(CLW_APP.'includes/widgets_utils.php');
    require_once(CLW_APP.'includes/widgets_admin_helper.php');

    /* List Installed Widgets */

    function clw_page_list($rel=array()) {
        global $pref, $tp, $rs, $sql, $CLW_SYSMSG;

        $text = "
        	<form method='post' action='".e_SELF.(e_QUERY ? "?".e_QUERY : '')."' id='clw_module_data'>

        ";

        //no cache warning
        if(!is_writable(CLW_APP.'cache'))
        $text .= "
			<div style='clear: both; text-align: left; margin: 5px auto'>
			<div class='indent'>
				<span style='font-weight: bold'>".CLW_APP_ABS.'cache/'.CLW_LANSYSMSG_CACHE_WARN."</span>
			</div>
			</div>
			<div style='clear: both; height: 10px;'><!-- --></div>
        ";

        $text .= clw_helper::render_installed();

        $text .= "<div style='clear: both; height: 30px;'><!-- --></div>";

        $text .= clw_helper::render_notinstalled();

        $text .= "</form>";

        clw_out(CLW_LANADM, $text, $CLW_SYSMSG);
    }

    /* Manage */

    function clw_page_manage($rel=array()) {
        global $pref, $tp, $rs, $sql, $CLW_SYSMSG;

        $text = 'Manage Installed Plugins';

        clw_out(CLW_LANADM, $text, $CLW_SYSMSG);
    }

    /* Settings */

    function clw_page_config($rel=array()) {
        global $pref, $tp, $rs, $sql, $CLW_SYSMSG;

        $text = "
        	<form method='post' action='".e_SELF.(e_QUERY ? "?".e_QUERY : '')."' id='clw_module_data'>
        ";

		$text .= clw_helper::render_config();

		$text .= "</form>";

		clw_out(CLW_LANADM, $text, $CLW_SYSMSG);
    }

    /*  PLUGIN HELP  */

    function clw_page_help($rel=array())
    {

        $text = "
        	<table class='fborder' style='width: 98%'>
            	<tr>
            		<td class='fcaption' colspan='2' style='text-align: left'><h3>".CLW_LANHELP."</h3></td>
            	</tr>
            	<tr>
            		<td class='forumheader' style='width: 5%; text-align: right; vertical-align: top'><strong>".CLW_LANHELP_QUESTION."</strong>&nbsp;</td>
            		<td class='forumheader3' style='width:95%; text-align: left'><strong>".CLW_LANHELP_1."</strong></td>
            	</tr>
            	<tr>
            		<td class='forumheader' style='width:5%; text-align: right; vertical-align: top'><strong>".CLW_LANHELP_ANSWER."</strong>&nbsp;</td>
            		<td class='forumheader3' style='width:95%; text-align: left'>".CLW_LANHELP_1a."&nbsp;&nbsp;<a href='http://www.free-source.net'>free-source.net</a></td>
            	</tr>
            	<tr>
            		<td class='fcaption' colspan='2' style='text-align: center'>&nbsp;</td>
            	</tr>

            	<tr>
            		<td class='forumheader' style='width: 5%; text-align: right; vertical-align: top'><strong>".CLW_LANHELP_QUESTION."</strong>&nbsp;</td>
            		<td class='forumheader3' style='width:95%; text-align: left'><strong>".CLW_LANHELP_2."</strong></td>
            	</tr>
            	<tr>
            		<td class='forumheader' style='width:5%; text-align: right; vertical-align: top'><strong>".CLW_LANHELP_ANSWER."</strong>&nbsp;</td>
            		<td class='forumheader3' style='width:95%; text-align: left'>".CLW_LANHELP_2a."&nbsp;&nbsp;<a href='http://www.free-source.net'>free-source.net</a></td>
            	</tr>
            	<tr>
            		<td class='fcaption' colspan='2' style='text-align: center'>&nbsp;</td>
            	</tr>

            	<tr>
            		<td class='forumheader' style='width: 5%; text-align: right; vertical-align: top'><strong>".CLW_LANHELP_QUESTION."</strong>&nbsp;</td>
            		<td class='forumheader3' style='width:95%; text-align: left'><strong>".CLW_LANHELP_3."</strong></td>
            	</tr>
            	<tr>
            		<td class='forumheader' style='width:5%; text-align: right; vertical-align: top'><strong>".CLW_LANHELP_ANSWER."</strong>&nbsp;</td>
            		<td class='forumheader3' style='width:95%; text-align: left'>".str_replace("%s%", "&nbsp;<a href='http://www.free-source.net'>free-source.net</a>&nbsp;", CLW_LANHELP_3a)."<br />".CLW_LANHELP_3b."</td>
            	</tr>
        	</table>
        ";

        clw_out(CLW_LANADM, $text, $CLW_SYSMSG);

    }

    function clw_event_config($event, $qry) {
    	global $pref, $CLW_SYSMSG;

    	$emessage = eMessage::getInstance();
    	
    	//submit_config
    	if(isset($_POST['submit_config'])) {
    		$pref['cl_widget_cache'] = $_POST['cl_widget_cache'] ? '1' : '0';
    		$pref['cl_widget_jscompression'] = $_POST['cl_widget_jscompression'] ? '1' : '0';
    		$pref['cl_widget_debug'] = $_POST['cl_widget_debug'] ? '1' : '0';
    		$pref['cl_08compat'] = $_POST['cl_08compat'] ? '1' : '0';
    		$pref['cl_08compat_style'] = $_POST['cl_08compat_style'] ? '1' : '0';
    		$pref['cl_08compat_style_admin'] = $_POST['cl_08compat_style_admin'] ? '1' : '0';
    		
    		if(!$pref['cl_08compat'])
    		{
    			$wdata = clw_utils_getall_wdata();
	    		foreach (clw_widget::getInstalled() as $widget) 
	    		{
	    			if(!clw_widget::getInstance()->initWidget($widget)->allow_compat_disable())
	    			{
	    				//TODO - loop through all (?) and show which widget exactly is requiring compat mod?
	    				$pref['cl_08compat'] = $_POST['cl_08compat'] = 1;
	    				$compat_check = false;
						$emessage->add(sprintf(CLW_LANCONFIG_9, $wdata[$widget]['title']), E_MESSAGE_WARNING);
						
	    			}
	    		}
	    		if(!$compat_check) $emessage->add(CLW_LANCONFIG_8, E_MESSAGE_WARNING);
    		}

    		$emessage->add(CLW_LANCONFIG_4, E_MESSAGE_SUCCESS);
    		clw_widget::savePrefs();
    	}
    	elseif(isset($_POST['submit_clear_cache']))
    	{
    		$emessage->add(CLW_LANCONFIG_11a, E_MESSAGE_SUCCESS);
    		clw_widget::clear_jslib_cache();
    	}
        elseif(isset($_POST['submit_clear_allcache']))
    	{
    		$emessage->add(CLW_LANCONFIG_12a, E_MESSAGE_SUCCESS);
    		// renew cl_widget_cachelm pref and clear server cache
    		clw_widget::savePrefs();
    	}
    }


    /* MANAGE WIDGET PAGES */

    function clw_event_install($event, $qry) {

        if($event == 'install') {
            $id = $qry[1];
            clw_helper::install_widget($id);
        }
    }

    function clw_page_install($event, $qry) {
        global $CLW_SYSMSG;
        clw_out(CLW_LANADM, '', $CLW_SYSMSG);
    }

    function clw_event_update($event, $qry) {

        if($event == 'update') {
            $id = $qry[1];
            clw_helper::update_widget($id);
        }
    }

    function clw_page_update() {
        global $CLW_SYSMSG;
        clw_out(CLW_LANADM, '', $CLW_SYSMSG);
    }

    function clw_event_uninstall() {
	
    }

    function clw_page_uninstall($event) {
        global $CLW_SYSMSG;

        $text = '';
        if($event[0] == 'uninstall') {
            $text = clw_helper::uninstall_widget($event[1]);
        }
        
        clw_out(CLW_LANADM, $text, $CLW_SYSMSG);
    }
?>