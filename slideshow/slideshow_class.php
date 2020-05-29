<?php
/*
+---------------------------------------------------------------+
|	For e107 website system
|	Slideshow plugin
|	© nlstart
+---------------------------------------------------------------+
*/
if (!defined('e107_INIT')) { exit(); }
include_lan(e_PLUGIN.'slideshow/languages/'.e_LANGUAGE.'.php');

// Some necessary javascripts for this plugin are included in the head section of the generated HTML page via e_meta.php

function gallery_js($p_gallery_name)
{
	global $pref;
	// Get slideshow settings
	$gallery_settings 			= '';
	//$slideshow_timed			= intval($pref['slideshow_timed']); // 0 = change by hand, 1 change on time
	$slideshow_delay			= intval($pref['slideshow_delay']); // 5000 equals 5 seconds (default)
	//$slideshow_arrows			= intval($pref['slideshow_arrows']); // 0 = hide arrouws, 1 = show arrows (NOTE: $slideshow_timed=0 and $slideshow_arrows=0 will be static on last news item!)
	//$slideshow_carousel			= intval($pref['slideshow_carousel']); // 0 = hide carousel; 1 = show carousel [Close carousel not working when Lightbox plugin is used]
	//$slideshow_infopane			= intval($pref['slideshow_infopane']); // 0 = hide info panel; 1 = show info panel
	//$slideshow_carousel_tab_txt	= trim($pref['slideshow_carousel_tab_txt']); // Defaults to 'Pictures' when empty
	//$slideshow_transition		= intval($pref['slideshow_transition']); // 0 = fade-in (default); 1 = transition [OPTION NOT SUPPORTED!]
	//$slideshow_width			= intval($pref['slideshow_width']); // default is 460px
	//$slideshow_height			= intval($pref['slideshow_height']); // default is 345px
	//$slideshow_border			= intval($pref['slideshow_border']); // default is 1px
	//$slideshow_border_color		= trim($pref['slideshow_border_color']); // default is black #000
	//$slideshow_background		= trim($pref['slideshow_background']); // default is transparant
	//$slideshow_align			= intval($pref['slideshow_align']); // default is left

	/*
	if ($slideshow_timed == 1)
	{	// Automatically move to next slide based on time
		$gallery_settings .= "timed: true,";
	}
	if ($slideshow_delay > 0)
	{
		$gallery_settings .= "delay: ".$slideshow_delay.",";
	}
	if ($slideshow_arrows == 1)
	{	// Hide the side arrows on left and right side
		$gallery_settings .= "showArrows: false,";
	}
	if ($slideshow_carousel == 1)
	{	// Hide the carousel
		$gallery_settings .= "showCarousel: false,";
	}
	if ($slideshow_infopane == 1)
	{	// Hide the info panel
		$gallery_settings .= "showInfopane: false,";
	}
	if (strlen($slideshow_carousel_tab_txt) > 0)
	{	// Hide the info panel
		$gallery_settings .= "textShowCarousel: '".$slideshow_carousel_tab_txt."',";
	}
	if ($slideshow_transition == 1)
	{	// Slide transition in stead of fade-in [OPTION NOT SUPPORTED!]
		$gallery_settings .= "defaultTransition: 'fadeslideleft',";
	}
	if ($slideshow_width == 0)
	{	// Slide width default is 460px
		$slideshow_width = 460;
	}
	if ($slideshow_height == 0)
	{	// Slide height default is 250px
		$slideshow_height = 250;
	}
	if ($slideshow_border == '')
	{	// Slide default border is 1px
		$slideshow_border = 1;
	}
	if ($slideshow_border_color == '')
	{	// Slide default border color is grey
		$slideshow_border_color = '#fff';
	}
	if ($slideshow_background == '')
	{	// Slide default background color is transparant
		$slideshow_background = 'trans';
	}
	if ($slideshow_align == 1)
	{
		$slideshow_align = 'right';
	}
	else
	{	// Slide default text alignment is left
		$slideshow_align = 'left';
	}
	$gallery_settings = substr($gallery_settings, 0, -1); // To fix behavior in IE browsers the last comma must disappear!
	*/

	if (file_exists(THEME.$p_gallery_name.'.css'))
	{
		$f_text = "<link rel='stylesheet' type='text/css' href='".SITEURL.THEME.$p_gallery_name.".css' />";
	}
	else
	{
		$f_text = "<link rel='stylesheet' type='text/css' href='".e_PLUGIN_ABS."slideshow/css/".$p_gallery_name.".css' />";
	}
	
	$f_text .= "		
	<script type='text/javascript'>
	jQuery.noConflict();
	jQuery(document).ready(
	function(){
		jQuery('#".$p_gallery_name."').tabs({fx:{opacity: 'toggle'}}).tabs('rotate', ".$slideshow_delay.", true);
	});
	</script>
	";
	return $f_text;
	
	/*
	$f_text = "
			<style>
			#".$p_gallery_name."
			{
				text-align: ".$slideshow_align.";
				margin: 0 auto;
				width: ".$slideshow_width."px;
				height: ".$slideshow_height."px;
				z-index:5;
				border: ".$slideshow_border."px solid ".$slideshow_border_color.";
			}
			#".$p_gallery_name." img.thumbnail
			{
				display: none;
			}
			.jdGallery .slideElement
			{
				".(($slideshow_background == 'trans')?'#':'')."background-color: ".$slideshow_background.";
			}
			.jdGallery .loadingElement
			{
				".(($slideshow_background == 'trans')?'#':'')."background-color: ".$slideshow_background.";
			}			
			</style>
			<script type='text/javascript'>
				function startGallery() {
					var ".$p_gallery_name." = new gallery($('".$p_gallery_name."'), {
						".$gallery_settings."
					});
				}
				window.addEvent('domready',startGallery);
			</script>";
	*/
}

function gallery_element($p_counter, $p_href, $p_id, $p_title, $p_summary, $p_img_path, $p_image, $p_thumb_path, $p_thumbnail)
{	// Function to display each gallery image element
	/*
		<div class='imageElement'>
			<h3><a href='".$p_href.$p_id."' alt=''>".$p_title."</a></h3>
			<p><a href='".$p_href.$p_id."' alt=''>".$p_summary."</a></p>
			<a href='".$p_href.$p_id."' title='".$p_title."' class='open'></a>
			<a href='#' title='open image' class='open'></a>
			<img src='".$p_img_path.$p_image."' class='full' />
			<img src='".$p_thumb_path.$p_thumbnail."' class='thumbnail' />
		</div>
	*/
	($p_counter == 1)?$p_class="ui-tabs-panel":$p_class="ui-tabs-panel ui-tabs-hide";
	// 			<h2><a href="'.$p_href.$p_id.'" >'.$p_title.'</a></h2>
	$f_text = '		
	    <div id="fragment-'.$p_counter.'" class="'.$p_class.'" style="">
			<img src="'.$p_img_path.$p_image.'" alt="" />
			 <div class="info" >
				<h2><a href="'.$p_href.$p_id.'" >'.$p_title.'</a></h2>
				<p>'.$p_summary.'...&nbsp;<a href="'.$p_href.$p_id.'" >'.SS_CONF_MORE.'</a></p>
			 </div>
	    </div>';
	return $f_text;
}

function gallery_nav($p_counter, $p_thumb_path, $p_thumbnail, $p_title)
{
	$f_text = '
			<li class="ui-tabs-nav-item" id="nav-fragment-'.$p_counter.'"><a href="#fragment-'.$p_counter.'"><img src="'.$p_thumb_path.$p_thumbnail.'" style="max-height:50px;" alt="" /><span>'.$p_title.'</span></a></li>';
	return $f_text;
}

function test_output()
{
	$f_text = '
	<div id="slideshow_featured" >
		<ul class="ui-tabs-nav">
			<li class="ui-tabs-nav-item" id="nav-fragment-1"><a href="#fragment-1"><img src="'.e_PLUGIN_ABS.'slideshow/images/image1-small.jpg" alt="" /><span>15+ Excellent High Speed Photographs</span></a></li>
			<li class="ui-tabs-nav-item" id="nav-fragment-2"><a href="#fragment-2"><img src="'.e_PLUGIN_ABS.'slideshow/images/image2-small.jpg" alt="" /><span>20 Beautiful Long Exposure Photographs</span></a></li>
			<li class="ui-tabs-nav-item" id="nav-fragment-3"><a href="#fragment-3"><img src="'.e_PLUGIN_ABS.'slideshow/images/image3-small.jpg" alt="" /><span>35 Amazing Logo Designs</span></a></li>
			<li class="ui-tabs-nav-item" id="nav-fragment-4"><a href="#fragment-4"><img src="'.e_PLUGIN_ABS.'slideshow/images/image4-small.jpg" alt="" /><span>Create a Vintage Photograph in Photoshop</span></a></li>
		</ul>

	    <!-- First Content -->
	    <div id="fragment-1" class="ui-tabs-panel" style="">
			<img src="'.e_PLUGIN_ABS.'slideshow/images/image1.jpg" alt="" />
			 <div class="info" >
				<h2><a href="#" >15+ Excellent High Speed Photographs</a></h2>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla tincidunt condimentum lacus. Pellentesque ut diam....<a href="#" >read more</a></p>
			 </div>
	    </div>

	    <!-- Second Content -->
	    <div id="fragment-2" class="ui-tabs-panel ui-tabs-hide" style="">
			<img src="'.e_PLUGIN_ABS.'slideshow/images/image2.jpg" alt="" />
			 <div class="info" >
				<h2><a href="#" >20 Beautiful Long Exposure Photographs</a></h2>
				<p>Vestibulum leo quam, accumsan nec porttitor a, euismod ac tortor. Sed ipsum lorem, sagittis non egestas id, suscipit....<a href="#" >read more</a></p>
			 </div>
	    </div>

	    <!-- Third Content -->
	    <div id="fragment-3" class="ui-tabs-panel ui-tabs-hide" style="">
			<img src="'.e_PLUGIN_ABS.'slideshow/images/image3.jpg" alt="" />
			 <div class="info" >
				<h2><a href="#" >35 Amazing Logo Designs</a></h2>
				<p>liquam erat volutpat. Proin id volutpat nisi. Nulla facilisi. Curabitur facilisis sollicitudin ornare....<a href="#" >read more</a></p>
	         </div>
	    </div>

	    <!-- Fourth Content -->
	    <div id="fragment-4" class="ui-tabs-panel ui-tabs-hide" style="">
			<img src="'.e_PLUGIN_ABS.'slideshow/images/image4.jpg" alt="" />
			 <div class="info" >
				<h2><a href="#" >Create a Vintage Photograph in Photoshop</a></h2>
				<p>Quisque sed orci ut lacus viverra interdum ornare sed est. Donec porta, erat eu pretium luctus, leo augue sodales....<a href="#" >read more</a></p>
	         </div>
	    </div>
	</div>	
	';
	return $f_text;
}
?>