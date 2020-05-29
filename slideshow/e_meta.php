<?php
if (!defined('e107_INIT')) { exit; }
$slide_show_js = '
	<script type="text/javascript" src="'.e_PLUGIN_ABS.'slideshow/js/jquery-1.8.2.js" ></script>
	<script type="text/javascript" src="'.e_PLUGIN_ABS.'slideshow/js/jquery-ui-1.9.0.custom.min.js" ></script>
	<script type="text/javascript" src="'.e_PLUGIN_ABS.'slideshow/js/jquery-ui-tabs-rotate.js" ></script>
	';
echo $slide_show_js;
?>