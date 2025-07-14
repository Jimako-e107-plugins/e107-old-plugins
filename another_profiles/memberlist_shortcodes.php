<?php
if (!defined('e107_INIT')) { exit; }
include_once(e_HANDLER.'shortcode_handler.php');
$ml_shortcodes = $tp -> e_sc -> parse_scbatch(__FILE__);
?>