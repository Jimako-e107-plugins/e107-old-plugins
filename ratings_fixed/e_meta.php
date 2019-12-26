<?php
if (!defined('e107_INIT')) { exit; }

echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"".e_PLUGIN."ratings/css/rating.css\" />";

if ( !defined('JQUERY') ) {

define('JQUERY','<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>');

echo JQUERY;

}

echo "<script id='ratings_js' type=\"text/javascript\" src=\"".e_PLUGIN."ratings/js/ratings.js\"></script>
<script type=\"text/javascript\" src=\"".e_PLUGIN."ratings/js/global.js\"></script> 
";

if ( eregi ( "ratings" , e_SELF ) ) {

echo "

<link rel=\"stylesheet\" type=\"text/css\" href=\"".e_PLUGIN."ratings/css/rt_style.css\" />

";

}


//$footer_js[] = e_PLUGIN."ratings/js/ratings.js";

?>