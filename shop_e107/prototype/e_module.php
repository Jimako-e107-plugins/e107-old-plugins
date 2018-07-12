<?php
global $prototype_obj;
if (!is_object($prototype_obj)) {
    require_once(e_PLUGIN . "prototype/includes/prototype_class.php");
    $prototype_obj = new prototype;
    if ($prototype_obj->prototype_active) {
        $footer_js[] = SITEURL . $PLUGINS_DIRECTORY . 'prototype/includes/fb_prototype.js';
        #$footer_js[] = SITEURL . $PLUGINS_DIRECTORY . 'prototype/includes/lightbox.js';
    }
}