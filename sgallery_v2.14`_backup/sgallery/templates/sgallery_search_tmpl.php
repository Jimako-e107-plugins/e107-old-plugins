<?php
/*
+ ----------------------------------------------------------------------------------------------------+
|        e107 website system 
|        Template File: e107_plugins/sgallery/templates/sgallery_rand_tmpl.php
|        Email: m.yovchev@clabteam.com
|        $Revision: 776 $
|        $Date: 2009-01-20 12:05:00 +0200 (Tue, 20 Jan 2009) $
|        $Author: secretr $
|	     Copyright Corllete Lab ( http://www.clabteam.com ) under GNU GPL License (http://gnu.org)
|        Free Support: http://dev.e107bg.org/
+----------------------------------------------------------------------------------------------------+
*/
if (!defined('e107_INIT')) { exit; }
//override from theme.php!
    if(!$SGAL_SEARCH_TEMPLATE) {
        $SGAL_SEARCH_TEMPLATE = "
            <div style='clear: both; padding: 0px 0px'><!-- --></div>
            
            <table style='width: 100%; text-align: left; margin-left: 0px'>
            <tr>
            <td class='forumheader3' style='text-align: left; width: 65%; vertical-align: top'>
                <div style='float: left; padding: 2px; margin: 5px; border: 1px solid #c0c0c0;'>{SGAL_ALBUM_MAINIMG=120,90,C}</div>
                <p style='padding: 5px;'>{SGAL_ALBUM_DESCRIPTION= %% %% %%<em>".SGAL_LANSRCH_7."</em>}</p>
            </td>
            <td class='forumheader3' style='text-align: left; width: 35%; vertical-align: top'>
				   <p><span style='text-decoration: underline;'>".SGAL_LANSRCH_4."</span>: <a href='{SGAL_GAL_LINK}'>{SGAL_GAL_TITLE}</a></p>
                   
				   <p style='text-decoration: underline;'>".SGAL_LANSRCH_3."</p>
                   <p>".SGAL_LAN_13.": {SGAL_ALBUM_VIEWCNT}<br />
				   ".SGAL_LANSRCH_6.": {SGAL_ALBUM_FILES}<br />
				   ".SGAL_LANSRCH_5.": {SGAL_ALBUM_DATE=long}
				   </p>
            </td>
            </tr>
            </table>

            <div style='clear: both; padding: 0px 0px'><!-- --></div>
        ";
    }
    
	if(!$SGAL_SEARCH_START) {
    	$SGAL_SEARCH_START = "{SGAL_ALBUM_USERDATA=profile%%<div style='clear: both; padding-left: 5px; text-align: left' class='smalltext'><strong>".SGAL_LAN_15."</strong>:&nbsp;%%</div>}";
    }
    
	if(!$SGAL_SEARCH_END) {
    	$SGAL_SEARCH_END = "";
    }
?>