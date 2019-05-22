<?php
$css = e_PLUGIN_ABS."css_online/css/online".$pref['css_online_file'].".css";

if(!ereg ("log/stats.php", e_SELF)){
	function core_head(){
		global $css;
		echo "\n<!-- eplug_css -->\n";
		echo "<link rel='stylesheet' href='{$css}' type='text/css' />\n";
}	}
	
/*
Consider the use of $eplug_css = e_PLUGIN_ABS."css_online/css/online".$pref['css_online_file'].".css";
rather then the used function. The problem is to put the eplug_css call after the call for the normal css file, else normal css will get used rather then the plugin.
*/
?>