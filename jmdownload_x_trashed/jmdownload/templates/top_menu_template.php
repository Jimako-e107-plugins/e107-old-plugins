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

$TOP_MENU_WRAPPER['item']['JMDOWNLOAD_CATEGORY'] 		= LAN_JMD_DOWNLOADS_IN_CATEGORY."<span>{---}</span><br />";
$TOP_MENU_WRAPPER['item']['JMDOWNLOAD_SIZE'] 			= LAN_JMD_DOWNLOADS_FILESIZE."<span>{---}</span><br />";
$TOP_MENU_WRAPPER['item']['JMDOWNLOAD_AUTHOR'] 			= LAN_JMD_DOWNLOADS_AUTHOR."<span>{---}</span><br />";

$TOP_MENU_TEMPLATE['caption'] = '
<h2 class="section-title">{MENU_CAPTION}</h2>';

$TOP_MENU_TEMPLATE['start'] = '<div id="latest-downloads-menu"><div class="row">';
$TOP_MENU_TEMPLATE['end'] = '</div></div>  ';  
 
$TOP_MENU_TEMPLATE['item']['item'] = '
<div class="col-md-4 col-sm-6  ">	 
		<div id="top-download-{DOWNLOAD_POSITION}">
			<h3>{JMDOWNLOAD_NAME}</h3> {JMDOWNLOAD_ADMIN_EDIT}
			{JMDOWNLOAD_CATEGORY}
            {JMDOWNLOAD_AUTHOR}           
			'.LAN_JMD_TOPDOWNLOADS_IN_PERIOD.'{DOWNLOAD_PERIOD}: {JMDOWNLOAD_LAST_PERIOD_COUNT} <br />
			{JMDOWNLOAD_SIZE}
			'.LAN_JMD_TOPDOWNLOADS_GETIT.'<a href="{JMDOWNLOAD_VIEW_LINK}">{JMDOWNLOAD_NAME}</a><br />
            {JMDOWNLOAD_DESCRIPTION}
		</div> 
  
 </div> 
 ';
$TOP_MENU_TEMPLATE['item']['separator'] = '<div class="separator"><!-- --></div>';
 