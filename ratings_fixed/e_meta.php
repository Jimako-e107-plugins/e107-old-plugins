<?php
if (!defined('e107_INIT')) { exit; }
           /*
echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"".e_PLUGIN."ratings/css/rating.css\" />";
      
if ( !defined('JQUERY') ) {

define('JQUERY','<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>');

echo JQUERY;

}  */
         /*
echo "<script id='ratings_js' type=\"text/javascript\" src=\"".e_PLUGIN."ratings/js/ratings.js\"></script>
<script type=\"text/javascript\" src=\"".e_PLUGIN."ratings/js/global.js\"></script> 
";
       */
if(USER_AREA) {
    e107::css("ratings", "css/rating.css");

    $jsSettings = [
			'js_path' => e_PLUGIN_ABS."ratings/js/ratings.js",
 
	];

	// Footer - settings + script
	e107::js('settings', ['ratings' => $jsSettings]);
    
    
  // e107::js("footer", e_PLUGIN."ratings/js/global.js", "jquery");        
   e107::js("footer", "{e_PLUGIN}ratings/js/ratings.js", "jquery");

}
else { 
  //if ( erexgi ( "ratings" , e_SELF ) ) {
  if ( preg_match ( "#ratings#i" , e_SELF ) ) {
      e107::css("ratings", "css/rt_style.css");
  }
}

//$footer_js[] = e_PLUGIN."ratings/js/ratings.js";

?>