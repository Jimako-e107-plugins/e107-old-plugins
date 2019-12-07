<?php
/*
 * e107Slider Plugin v0.1
 *
 * Copyright (C) 2007-2012 Xen Themes (xenthemes.com)
 *
 * Dual licensed under the MIT (http://www.opensource.org/licenses/mit-license.php) or 
 * GPL Version 2 (http://www.gnu.org/licenses/gpl-2.0.txt) licenses
 *
 * $Source: 
 * $Revision: 1 $
 * $Date: 25/05/2012 $
 * $Author: leonlloyd $
 *
*/

if(basename($_SERVER['PHP_SELF'])=='admin_slider_settings.php' || basename($_SERVER['PHP_SELF'])=='admin_news_slider_settings.php' || basename($_SERVER['PHP_SELF'])=='admin_config.php' ) {
echo '<link rel="stylesheet" type="text/css" href="'.e_PLUGIN_ABS.'e107slider/style.css" />';
}

if(basename($_SERVER['PHP_SELF'])=='admin_slider.php' ) {
echo '<link rel="stylesheet" type="text/css" href="'.e_PLUGIN_ABS.'e107slider/style.css" />
<script type="text/javascript">
    function addtext(sc) {
      	document.forms.dataform.es_image.value=sc;
    }
</script>';
}

global $pref;

echo "
	<link rel='stylesheet' type='text/css' href='".e_PLUGIN."e107slider/css/responsiveslides.css' media='screen' />
	<script src='".e_PLUGIN."e107slider/scripts/jquery-1.9.1.min.js'></script>
	<script src='".e_PLUGIN."e107slider/scripts/responsiveslides.min.js'></script>
	<script type='text/javascript'>
		$(function () {

      		$(\".rslides1\").responsiveSlides({
      			auto: ".$pref['es_slider_auto'].",
  				speed: ".$pref['es_slider_speed'].",
  				timeout: ".$pref['es_slider_timeout'].",
  				pager: ".$pref['es_slider_pager'].",
  				nav: ".$pref['es_slider_nav'].",
  				random: ".$pref['es_slider_random'].",
  				pause: ".$pref['es_slider_pause'].",
  				pauseControls: ".$pref['es_slider_pauseControls']."
      		});
      		
      		$(\".rslides2\").responsiveSlides({
        		auto: ".$pref['es_slider_news_auto'].",
  				speed: ".$pref['es_slider_news_speed'].",
  				timeout: ".$pref['es_slider_news_timeout'].",
  				pager: ".$pref['es_slider_news_pager'].",
  				nav: ".$pref['es_slider_news_nav'].",
  				random: ".$pref['es_slider_news_random'].",
  				pause: ".$pref['es_slider_news_pause'].",
  				pauseControls: ".$pref['es_slider_news_pauseControls']."
      		});

    	});
	</script>";


