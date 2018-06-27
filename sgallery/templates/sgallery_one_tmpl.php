<?php
/**
 * Corllete Lab Gallery
 * 
 * Copyright (C) 2006-2009 Corllete ltd (clabteam.com)
 * Support and updates at http://www.free-source.net/
 * Released under the terms and conditions of the
 * GNU General Public License (http://www.gnu.org/licenses/gpl.txt)
 * 
 * SGallery 1 Template File
 * 
 * $Id: sgallery_one_tmpl.php 859 2011-03-28 14:42:23Z berckoff $
 */

$SGALLERY_ONE['default']['start']							= '
		<!-- BoF SGallery One Code -->
			<div id="sgal1-{SGAL1_TMPL}">';

$SGALLERY_ONE['default']['end']								= '
			</div>
			{SGAL1_JS_LOADER}
		<!-- EoF SGallery One Code -->';

$SGALLERY_ONE['default']['navi_cat']['start']				= '
				<div id="sgal1-{SGAL1_TMPL}-navi-ca">';

$SGALLERY_ONE['default']['navi_cat']['separator']			= '';

$SGALLERY_ONE['default']['navi_cat']['item']				= '
						<a href="{SGAL1_CAT_URL}">{SGAL1_CAT_NAME}</a> : {SGAL1_CAT_ALBUMS}';

$SGALLERY_ONE['default']['navi_cat']['end']					= '
				</div>';

$SGALLERY_ONE['default']['main']['start']					= '
				<div id="sgal1-{SGAL1_TMPL}-pic-container">';

$SGALLERY_ONE['default']['main']['end']						= '
				</div>';

$SGALLERY_ONE['default']['main']['separator']				= '';

$SGALLERY_ONE['default']['main']['item']					= '
					<img id="sgal1-{SGAL1_TMPL}-main-pic-{SGAL1_CURRENT_PIC_ID}" src="{SGAL1_CURRENT_PIC_PATH}" alt="{SGAL1_CURRENT_PIC_ID}" style="{SGAL1_CURRENT_PIC_DISPLAY}" />';

$SGALLERY_ONE['default']['navi_pics']['start']				= '
				<div id="sgal1-{SGAL1_TMPL}-navi-thumbs">
					<div id="sgal1-{SGAL1_TMPL}-navi-thumbs-left">
						<img class="{SGAL1_NAVI_LEFT_CLASS}" src="'.e_PLUGIN.'sgallery/images/nav_left.png" alt="&lt;" {SGAL1_NAVI_LEFT} />
					</div>
					<div id="sgal1-{SGAL1_TMPL}-navi-thumbs-container">';

$SGALLERY_ONE['default']['navi_pics']['separator']			= '';

$SGALLERY_ONE['default']['navi_pics']['item']				= '
							<img id="sgal1-{SGAL1_TMPL}-thumb-{SGAL1_NAVI_IMG_ID}" src="{SGAL1_NAVI_IMG}" alt="CLab SGallery Thumbnail {SGAL1_NAVI_IMG_ID}" />
							<script type="text/javascript">$(sgal1-{SGAL1_TMPL}-thumb-{SGAL1_NAVI_IMG_ID}).observe(\'onclick\', showPic({SGAL1_NAVI_IMG_ID});</script>';


$SGALLERY_ONE['default']['navi_pics']['shbox_item']			= '
							<a href="{SGAL1_CURRENT_PIC_PATH}" {SGAL1_NAVI_IMG_SHADOWBOX}>
								<img id="sgal1-{SGAL1_TMPL}-thumb-{SGAL1_NAVI_IMG_ID}" src="{SGAL1_NAVI_IMG}" alt="CLab SGallery Thumbnail {SGAL1_NAVI_IMG_ID}" />
							</a>';

$SGALLERY_ONE['default']['navi_pics']['end']				= '
					</div>
					<div id="sgal1-{SGAL1_TMPL}-navi-thumbs-right">
						<img class="{SGAL1_NAVI_RIGHT_CLASS}" src="'.e_PLUGIN.'sgallery/images/nav_right.png" alt="&gt;" {SGAL1_NAVI_RIGHT} />
					</div>
				</div>';