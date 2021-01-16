<?php

global $prototype_obj;
if (!is_object($prototype_obj)) {
    require_once(e_PLUGIN . "prototype/includes/prototype_class.php");
    $prototype_obj = new prototype;
}
if ($prototype_obj->prototype_active) {
    /*
   echo 'SCRIPT language="JavaScript">
	<!--
	pic1= new Image(32,32);
	pic1.src="http://pss-development/e1077/plugins/prototype/images/validation.png";
//-->
</SCRIPT>';
*/

    if ($prototype_obj->prototype_mini == 2) {
    	#$header_js[]=e_PLUGIN.'prototype/includes/minicombi/prototype.js';
        echo'<script type="text/javascript" src="' . SITEURL . $PLUGINS_DIRECTORY . 'prototype/includes/minicombi/prototype.js" ></script>';
    } elseif ($prototype_obj->prototype_mini == 1) {
    	#$header_js[]=e_PLUGIN.'prototype/includes/minijs/prototype.js';
    	#$header_js[]=e_PLUGIN.'prototype/includes/minijs/scriptaculous.js';
        echo'<script type="text/javascript" src="' . SITEURL . $PLUGINS_DIRECTORY . 'prototype/includes/minijs/prototype.js" ></script>';
        echo'<script type="text/javascript" src="' . SITEURL . $PLUGINS_DIRECTORY . 'prototype/includes/minijs/scriptaculous.js" ></script>';
    } else {
    	#   	$header_js[]=e_PLUGIN.'prototype/includes/js/prototype.js';
    	#   	$header_js[]=e_PLUGIN.'prototype/includes/js/scriptaculous.js';
        echo'<script type="text/javascript" src="' . SITEURL . $PLUGINS_DIRECTORY . 'prototype/includes/js/prototype.js" ></script>';
        echo'<script type="text/javascript" src="' . SITEURL . $PLUGINS_DIRECTORY . 'prototype/includes/js/scriptaculous.js" ></script>';
        echo'<script type="text/javascript" src="' . SITEURL . $PLUGINS_DIRECTORY . 'prototype/includes/js/controls.js" ></script>';
    }
   # echo'<script type="text/javascript" src="' . SITEURL . $PLUGINS_DIRECTORY . 'prototype/includes/fb_prototype.js" ></script>';
    // push out the css for this
}
    $url = SITEURL . $PLUGINS_DIRECTORY . 'prototype/images/';
    echo"
	<style type='text/css' >";
    require(e_PLUGIN . 'prototype/includes/prototype_css.php');
    echo"
	</style>";



echo '
<script type="text/javascript">
var prototype_lb= '.(int)$PROTOTYPE_PREF['prototype_lb'] .';
var j_PLUGIN="' . SITEURL . $PLUGINS_DIRECTORY . '";
var bartleme_interval=' . $PROTOTYPE_PREF['prototype_newsdelay'] * 1000 . ';
</script>';
echo'<script type="text/javascript" src="' . SITEURL . $PLUGINS_DIRECTORY . 'prototype/includes/fb_prototype.js" ></script>';
#echo $test->create();



#echo'<script type="text/javascript" src="' . SITEURL . $PLUGINS_DIRECTORY . 'prototype/includes/lightbox.js" ></script>';
#echo"<link rel='stylesheet' href='" . SITEURL . $PLUGINS_DIRECTORY . "prototype/includes/lightbox.css' type='text/css' media='screen' />";