<?php
/**
 * Corllete Lab Gallery
 * 
 * Copyright (C) 2006-2009 Corllete ltd (clabteam.com)
 * Support and updates at http://www.free-source.net/
 * Released under the terms and conditions of the
 * GNU General Public License (http://www.gnu.org/licenses/gpl.txt)
 * 
 * SGallery Categories Navigation Template File
 * 
 * $Id: sgallery_one_tmpl.php 859 2011-03-28 14:42:23Z berckoff $
 */

$SGALLERY_NAV['default']['navi|main']['pre']				= '
		<!-- BoF SGallery Navi Code -->';
$SGALLERY_NAV['default']['navi|main']['post']				= '
		<script>
			$(\'sgal-navi-cat-{SGAL_NAV_CAT_ID}\').observe(\'mouseover\', function(e){
				$(\'sgal-navi-cat-sub-{SGAL_NAV_CAT_ID}\').toggle();
			});
		</script>
		<!-- EoF SGallery Navi Code -->';

$SGALLERY_NAV['default']['navi|main']['item']				= '
		<a id="sgal-navi-cat-{SGAL_NAV_CAT_ID}" href="'.SITEURL.'website/pro_modules/sgallery/sgallery.php">{SGAL_NAV_CAT_NAME}</a>';

$SGALLERY_NAV['default']['navi|main']['separator']			= '';


$SGALLERY_NAV['default']['navi|sub']['pre']					= '
		<ul id="sgal-navi-cat-sub-{SGAL_NAV_CAT_ID}" style="display: none">';
$SGALLERY_NAV['default']['navi|sub']['post']				= '
		</ul>';

$SGALLERY_NAV['default']['navi|sub']['item']				= '
			<li>
				<a href="'.SITEURL.'website/pro_modules/sgallery/sgallery.php?album={SGAL_NAV_ALBUM_ID}" title="{SGAL_NAV_ALBUM_NAME}">
					{SGAL_NAV_ALBUM_NAME}
				</a>
			</li>';

$SGALLERY_NAV['default']['navi|sub']['separator']			= '';