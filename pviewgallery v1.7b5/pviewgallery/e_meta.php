<?php
/*
+---------------------------------------------------------------+
|        e107 website system
|        http://e107.org
|
|        PView Gallery by R.F. Carter
|        ronald.fuchs@hhweb.de
+---------------------------------------------------------------+
*/

if (!defined('e107_INIT')) { exit; }

if ($pviewactive = $sql->db_Select("plugin", "*", "plugin_path = 'pviewgallery' AND plugin_installflag = 1")) {
    // pviewgallery is installed
    //require_once("../../class2.php");
    require_once(e_PLUGIN."pviewgallery/pview.class.php");
    $PView = new PView;

    if ($PView -> getPView_config('img_Link_extJS_pview')) {
        // use pview scripts
        if ($PView -> getPView_config('img_Link_extJS') == "lightbox") {
            // internal lightbox
            echo "\n<script type='text/javascript'>\n";
            echo "<!--\n";
            echo "var lb_closeimage='".e_PLUGIN_ABS."pviewgallery/ext_js/lightbox/images/close.gif';";
            echo "var lb_loadimage='".e_PLUGIN_ABS."pviewgallery/ext_js/lightbox/images/loading.gif';";
            echo "// -->\n";
            echo "</script>\n";		
			if (file_exists(e_PLUGIN . "pviewgallery/ext_js/lightbox/lan/".e_LANGUAGE."_lightbox-lan.js")){
				echo "<script type='text/javascript' src='".e_PLUGIN_ABS."pviewgallery/ext_js/lightbox/lan/".e_LANGUAGE."_lightbox-lan.js' charset='utf-8'></script>\n";
			}else {
				echo "<script type='text/javascript' src='".e_PLUGIN_ABS."pviewgallery/ext_js/lightbox/lan/English_lightbox-lan.js' charset='utf-8'></script>\n";
			}
            echo "<script type='text/javascript' src='".e_PLUGIN_ABS."pviewgallery/ext_js/lightbox/js/prototype.js'></script>
            <script type='text/javascript' src='".e_PLUGIN_ABS."pviewgallery/ext_js/lightbox/js/scriptaculous.js?load=effects,builder' charset='utf-8'></script>
            <script type='text/javascript' src='".e_PLUGIN_ABS."pviewgallery/ext_js/lightbox/js/lightbox.js' charset='utf-8'></script>
            <link rel='stylesheet' type='text/css' media='screen' href='".e_PLUGIN_ABS."pviewgallery/ext_js/lightbox/css/lightbox.css' />
            \n";
        }
        if ($PView -> getPView_config('img_Link_extJS') == "shadowbox") {
            // internal shadowbox
            echo "<link rel='stylesheet' type='text/css' href='".e_PLUGIN_ABS."pviewgallery/ext_js/shadowbox/shadowbox.css'>\n";
            if (file_exists(e_PLUGIN . "pviewgallery/ext_js/shadowbox/lan/".e_LANGUAGE."_shadowbox-lan.js")){
				echo "<script type='text/javascript' src='".e_PLUGIN_ABS."pviewgallery/ext_js/shadowbox/lan/".e_LANGUAGE."_shadowbox-lan.js' charset='utf-8'></script>\n";
			}else {
				echo "<script type='text/javascript' src='".e_PLUGIN_ABS."pviewgallery/ext_js/shadowbox/lan/English_shadowbox-lan.js' charset='utf-8'></script>\n";
			}
			echo "<script type='text/javascript' src='".e_PLUGIN_ABS."pviewgallery/ext_js/shadowbox/shadowbox.js'></script>\n";
            echo "<script type='text/javascript'>
            Shadowbox.init();
            </script>\n";
        }
        if ($PView -> getPView_config('img_Link_extJS') == "highslide") {
            // internal highslide
            echo "<script type='text/javascript' src='".e_PLUGIN_ABS."pviewgallery/ext_js/highslide/highslide-full.packed.js'></script>\n";
            echo "<script type='text/javascript' src='".e_PLUGIN_ABS."pviewgallery/ext_js/highslide/highslide.config.js' charset='utf-8'></script>\n";
			if (file_exists(e_PLUGIN . "pviewgallery/ext_js/highslide/lan/".e_LANGUAGE."_highslide-lan.js")){
				echo "<script type='text/javascript' src='".e_PLUGIN_ABS."pviewgallery/ext_js/highslide/lan/".e_LANGUAGE."_highslide-lan.js' charset='utf-8'></script>\n";
			}else {
				echo "<script type='text/javascript' src='".e_PLUGIN_ABS."pviewgallery/ext_js/highslide/lan/English_highslide-lan.js' charset='utf-8'></script>\n";
			}
			echo "<link rel='stylesheet' type='text/css' href='".e_PLUGIN_ABS."pviewgallery/ext_js/highslide/highslide.css' />\n";
            echo "<script type='text/javascript'>
                // override Highslide settings here
                // instead of editing the highslide.js file
                hs.graphicsDir = '".e_PLUGIN_ABS."pviewgallery/ext_js/highslide/graphics/';
            </script>\n";
        }
        if ($PView -> getPView_config('img_Link_extJS') == "lightbox26") {
            // internal lightbox (new jquery version)
            echo "<script type='text/javascript' src='".e_PLUGIN_ABS."pviewgallery/ext_js/lightbox26/js/jquery-1.10.2.min.js'></script>
            <script type='text/javascript' src='".e_PLUGIN_ABS."pviewgallery/ext_js/lightbox26/js/lightbox-2.6.min.js' charset='utf-8'></script>
            <link rel='stylesheet' type='text/css' media='screen' href='".e_PLUGIN_ABS."pviewgallery/ext_js/lightbox26/css/lightbox.css' />
            \n";
        }		
    }
}
?>