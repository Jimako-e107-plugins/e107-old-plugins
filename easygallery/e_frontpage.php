<?php
if (!defined('e107_INIT')) { exit(); }
@include_once(e_PLUGIN.'easygallery/languages/'.e_LANGUAGE.'.php');
$front_page['easygallery'] = array('page' => $PLUGINS_DIRECTORY.'easygallery/gallery.php', 'title' => EG_NAME);
?>