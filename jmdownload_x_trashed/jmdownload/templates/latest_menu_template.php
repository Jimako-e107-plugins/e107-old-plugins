<?php
/*
 * e107 website system
 *
 * Copyright (C) 2008-2009 e107 Inc (e107.org)
 * Released under the terms and conditions of the
 * GNU General Public License (http://www.gnu.org/licenses/gpl.txt)
 *
 *
 *
 * $Source: /cvs_backup/e107_0.8/e107_plugins/download/templates/download_template.php,v $
 * $Revision$
 * $Date$
 * $Author$
 */

if (!defined('e107_INIT')) { exit; }

$LATEST_MENU_WRAPPER['item']['JMDOWNLOAD_CATEGORY'] 		= LAN_JMD_DOWNLOADS_IN_CATEGORY."<span>{---}</span><br />";
$LATEST_MENU_WRAPPER['item']['JMDOWNLOAD_SIZE'] 			= LAN_JMD_DOWNLOADS_FILESIZE."<span>{---}</span><br />";
$LATEST_MENU_WRAPPER['item']['JMDOWNLOAD_AUTHOR'] 			= LAN_JMD_DOWNLOADS_AUTHOR."<span>{---}</span><br />";

$LATEST_MENU_TEMPLATE['caption'] = '<h2 class="section-title">{MENU_CAPTION}</h2>';
$LATEST_MENU_TEMPLATE['start'] = '<div class="row">';
 
 
$LATEST_MENU_TEMPLATE['item']['item'] = '
<div class="col-md-4 col-sm-6  ">
    <div id="top-download-{DOWNLOAD_POSITION}">
			<a href="{JMDOWNLOAD_VIEW_LINK}"><h3 class="contenttitle">{JMDOWNLOAD_NAME}</h3></a> 
			{JMDOWNLOAD_CATEGORY} 
			{JMDOWNLOAD_SIZE}
            {JMDOWNLOAD_DESCRIPTION}
            {JMDOWNLOAD_AUTHOR}
            {JMDOWNLOAD_ADMIN_EDIT}
            {JMDOWNLOAD_VIEW_DATE_SHORT}
    </div>
 </div> 
 ';
$LATEST_MENU_TEMPLATE['item']['separator'] = '';
$LATEST_MENU_TEMPLATE['end'] = '</div> ';  