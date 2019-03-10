<?php
/*
+ ----------------------------------------------------------------------------------------------------+
|        e107 website system 
|        Plugin Meta File :  e107_plugins/resizer/e_meta.php
|        Email: support@naja7host.com
+----------------------------------------------------------------------------------------------------+
*/
if (!defined('e107_INIT')) { exit; }

$ir_path = e_PLUGIN_ABS.'resizer/';
include_lan($ir_path."languages/".e_LANGUAGE.".php");
if($pref['ncode_imageresizer_enabled']){ 

echo '
	<!-- nCode Image Resizer -->
	<script type="text/javascript" src="' . $ir_path . 'js/ncode_imageresizer.js?v=1.0.1"></script>  
	';

	if ($pref['ncode_imageresizer_resizemode']=='tinybox') 
		echo ' 
		<script type="text/javascript" src="' . $ir_path . 'js/tinybox.js?v=1.0"></script>
		';
	if ($pref['ncode_imageresizer_resizemode']=='tinybox2') 
		echo ' 
		<script type="text/javascript" src="' . $ir_path . 'js/tinybox2.js"></script>
		';		

	if ($pref['ncode_imageresizer_resizemode']=='fancybox') 
	{
		if (!isset($pref['plug_installed']['fancybox'])) 
		{
			echo " 
			<script type='text/javascript'>
				!window.jQuery && document.write('<script src=\"" . $ir_path . "js/jquery-1.4.3.min.js\"><\/script>');
			</script>
			<script type='text/javascript' src='" . $ir_path . "js/fancybox/jquery.fancybox-1.3.4.pack.js'></script>
			<link rel='stylesheet' type='text/css' href='" . $ir_path . "js/fancybox/jquery.fancybox-1.3.4.css' media='screen' />
			";
		}
		echo " 
			<script type='text/javascript'>
			function fancybox(elem)
			{ 
				elem = $(elem);
				if (!elem.data('fancybox')) 
				{
					elem.data('fancybox', true);
					elem.fancybox({
						'overlayShow'	: false,
						'transitionIn'	: 'elastic',
						'transitionOut'	: 'elastic',
						'overlayColor'	: '#000',
						'overlayOpacity': 0.9				
					});
					elem.fancybox().trigger('click'); 
				}
				return false;
			}		
			</script>
			";		
		
	}
		
echo '
	<style type="text/css">
	<!--
	table.ncode_imageresizer_warning, table.ncode_imageresizer_warning td
	{
		background-color: #fefee1; /* the bgcolor behind the text and image */
	}
	table.ncode_imageresizer_warning {
		color: #000000; /* the font color */
		border: 1px solid #CCCDCD; /* the border around the whole thing */
		cursor: pointer;
	}
	table.ncode_imageresizer_warning td {
		vertical-align: middle;
		text-decoration: none;
	}

	table.ncode_imageresizer_warning td.td1 {
		padding: 5px;
	}';
	if ($pref['ncode_imageresizer_resizemode']=='tinybox') 	
		echo ' 
		#tinybox {
			position:absolute; 
			display:none; 
			padding:10px; 
			background:#fff url("' . $ir_path . '"images/preload.gif) no-repeat 50% 50%; 
			border:10px solid #e3e3e3; 
			z-index:2000
		}
		#tinymask {
			position:absolute; display:none; 
			top:0; 
			left:0; height:100%; 
			width:100%; 
			background:#000; 
			z-index:1500
		}
		#tinycontent {
			background:#fff
		}';
	if ($pref['ncode_imageresizer_resizemode']=='tinybox2') 	
		echo ' 
		.tbox1 {position:absolute; display:none; padding:14px 17px; z-index:900}
		.tinner {padding:15px; -moz-border-radius:5px; border-radius:5px; background:#fff url(' . $ir_path . 'images/preload.gif) no-repeat 50% 50%; border-right:1px solid #333; border-bottom:1px solid #333}
		.tmask {position:absolute; display:none; top:0px; left:0px; height:100%; width:100%; background:#000; z-index:800}
		.tclose {position:absolute; top:0px; right:0px; width:30px; height:30px; cursor:pointer; background:url(' . $ir_path . 'images/close.png) no-repeat}
		.tclose:hover {background-position:0 -30px}

		#error {background:#ff6969; color:#fff; text-shadow:1px 1px #cf5454; border-right:1px solid #000; border-bottom:1px solid #000; padding:0}
		#error .tcontent {padding:10px 14px 11px; border:1px solid #ffb8b8; -moz-border-radius:5px; border-radius:5px}
		#success {background:#2ea125; color:#fff; text-shadow:1px 1px #1b6116; border-right:1px solid #000; border-bottom:1px solid #000; padding:10; -moz-border-radius:0; border-radius:0}
		#bluemask {background:#4195aa}
		#frameless {padding:0}
		#frameless .tclose {left:6px}
		';

if($pref['ncode_imageresizer_maxwidth']=='') 
	$maxwidth = '400'; 
else 
	$maxwidth = $pref['ncode_imageresizer_maxwidth'];
	
if($pref['ncode_imageresizer_maxheight']=='') 
	$maxheight = '1200'; 
else 
	$maxheight =  $pref['ncode_imageresizer_maxheight'];	
	
echo " 
	-->
	</style>
	<script type='text/javascript'>
	NcodeImageResizer.MODE = '".$pref['ncode_imageresizer_resizemode']."';
	NcodeImageResizer.MAXWIDTH = " .$maxwidth . " ;
	NcodeImageResizer.MAXHEIGHT = " .$maxheight .";
	NcodeImageResizer.BBURL = '" . $ir_path . "images/uyari.gif';
	var vbphrase=new Array;
	vbphrase['ncode_imageresizer_warning_small'] = '" . $tp->toJS(ncode_imageresizer_warning_small) . "';
	vbphrase['ncode_imageresizer_warning_filesize'] = '" . $tp->toJS(ncode_imageresizer_warning_filesize) ."';
	vbphrase['ncode_imageresizer_warning_no_filesize'] = '" . $tp->toJS(ncode_imageresizer_warning_no_filesize) ."';
	vbphrase['ncode_imageresizer_warning_fullsize'] = '" . $tp->toJS(ncode_imageresizer_warning_fullsize) ."';
	</script>";		
}
?>