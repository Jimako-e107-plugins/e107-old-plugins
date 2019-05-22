<?php

$TOP_DOWNLOADS_MENU_TEMPLATE['start']				= '
	<!-- BoF Top Downloads Menu -->
	<div id="top-downloads-menu">';

$TOP_DOWNLOADS_MENU_TEMPLATE['end']					= '
	</div>
	<!-- EoF Top Downloads Menu -->';

$TOP_DOWNLOADS_MENU_TEMPLATE['item']['item']		= '
		<div id="top-download-{DOWNLOAD_POSITION}">
			<h3>{DOWNLOAD_NAME}</h3>
			'.LAN_TOPDOWNLOADS_IN_CATEGORY.'{DOWNLOAD_CATEGORY=field=name&link}<br />
			'.LAN_TOPDOWNLOADS_IN_PERIOD.'{DOWNLOAD_PERIOD}: {DOWNLOAD_THIS_PERIOD_COUNT}<br />
			'.LAN_TOPDOWNLOADS_IN_PERIOD_LAST.' {DOWNLOAD_PERIOD}: {DOWNLOAD_LAST_PERIOD_COUNT} <br />
			'.LAN_TOPDOWNLOADS_TOTAL_DL.'{DOWNLOAD_TOTAL}<br />
			'.LAN_TOPDOWNLOADS_FILESIZE.'{DOWNLOAD_FILESIZE=format=mb}<br />
			'.LAN_TOPDOWNLOADS_GETIT.'{DOWNLOAD_NAME=link}
		</div>';

$TOP_DOWNLOADS_MENU_TEMPLATE['item']['separator']	= '
		<div class="separator"><!-- --></div>';