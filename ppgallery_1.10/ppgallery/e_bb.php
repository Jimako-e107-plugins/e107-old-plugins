<?php
$bb['name']			= 'ppimg'; 
$bb['onclick']		= "javascript:open_window('http://".$_SERVER['SERVER_NAME'].e_PLUGIN_ABS."/ppgallery/choose.php',800,600)"; 
$bb['onclick_var']	= ""; 
$bb['icon']			= e_PLUGIN."ppgallery/stuff/ppimg.png"; 
$bb['helptext']		= "";
$bb['function']		= '';   
$bb['function_var']	= '';  

// append the bbcode to the default templates:
 
$BBCODE_TEMPLATE			.= "{BB=ppimg}"; 
$BBCODE_TEMPLATE_NEWSPOST	.= "{BB=ppimg}";
$BBCODE_TEMPLATE_ADMIN		.= "{BB=ppimg}";
$BBCODE_TEMPLATE_CPAGE		.= "{BB=ppimg}"; 

$eplug_bb[] = $bb;  // add to the global list - Very Important!    

?>