<?php
global $prototype_obj, $eplug_css, $eplug_js, $footer_js;
if ( !is_object( $prototype_obj ) ) {
    require_once( e_PLUGIN . "prototype/includes/prototype_class.php" );
    $prototype_obj = new prototype;
}

if ( $prototype_obj->prototype_mini == 2 ) {
    // $header_js[]=e_PLUGIN.'prototype/includes/minicombi/prototype.js';
    // echo'<script type="text/javascript" src="' . SITEURL . $PLUGINS_DIRECTORY . 'prototype/includes/minicombi/prototype.js" ></script>';
 #   $eplug_js[] = e_PLUGIN . "prototype/includes/minicombi/prototype.js";
} elseif ( $prototype_obj->prototype_mini == 1 ) {
  #  $eplug_js[] = e_PLUGIN . 'prototype/includes/minijs/prototype.js';
   # $eplug_js[] = e_PLUGIN . 'prototype/includes/minijs/scriptaculous.js';
   # $eplug_js[] = e_PLUGIN . 'prototype/includes/minijs/effects.js';
   # $eplug_js[] = e_PLUGIN . 'prototype/includes/minijs/controls.js';
   # $eplug_js[] = e_PLUGIN . 'prototype/includes/minijs/builder.js';
    // echo'<script type="text/javascript" src="' . SITEURL . $PLUGINS_DIRECTORY . 'prototype/includes/minijs/prototype.js" ></script>';
    // echo'<script type="text/javascript" src="' . SITEURL . $PLUGINS_DIRECTORY . 'prototype/includes/minijs/scriptaculous.js" ></script>';
} else {
   # $eplug_js[] = e_PLUGIN . 'prototype/includes/js/prototype.js';
   # $eplug_js[] = e_PLUGIN . 'prototype/includes/js/scriptaculous.js';
   # $eplug_js[] = e_PLUGIN . 'prototype/includes/js/effects.js';
   # $eplug_js[] = e_PLUGIN . 'prototype/includes/js/controls.js';
   # $eplug_js[] = e_PLUGIN . 'prototype/includes/js/builder.js';
    // echo'<script type="text/javascript" src="' . SITEURL . $PLUGINS_DIRECTORY . 'prototype/includes/js/prototype.js" ></script>';
    // echo'<script type="text/javascript" src="' . SITEURL . $PLUGINS_DIRECTORY . 'prototype/includes/js/scriptaculous.js" ></script>';
    // echo'<script type="text/javascript" src="' . SITEURL . $PLUGINS_DIRECTORY . 'prototype/includes/js/controls.js" ></script>';
}

if ( !is_object( $prototype_obj ) ) {
    require_once( e_PLUGIN . "prototype/includes/prototype_class.php" );
    $prototype_obj = new prototype;
}
if ( 1 == 1 || $prototype_obj->prototype_active ) {
    #$footer_js[] = e_PLUGIN . 'prototype/includes/fb_prototype.js';
    // $footer_js[] = SITEURL . $PLUGINS_DIRECTORY . 'prototype/includes/lightbox.js';
}