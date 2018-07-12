<?php
/*
+ ----------------------------------------------------------------------------------------------------+
|        e107 website system 
|        Plugin BBcode file: e107_plugins/sgallery/e_bb.php.php
|        Email: m.yovchev@clabteam.com
|        $Revision: 328 $
|        $Date: 2007-03-12 03:15:20 +0200 (Mon, 12 Mar 2007) $
|        $Author: secretr $
|	     Copyright Corllete Lab ( http://www.clabteam.com )
|        Free Support: http://dev.e107bg.org/
+----------------------------------------------------------------------------------------------------+
*/
if (!defined('e107_INIT')) { exit; }
//
$bb['name']		= 'highSlide';
$bb['onclick']		= '';
$bb['onclick_var']	= "[highslide][/highslide]";

$bb['icon']		= e_PLUGIN."my_gallery/images/bb.png";
$bb['helptext']		= "[highslide]html://host.domain/image.jpg[/highslide]";
//$bb['function']		= 'mygallBBcode';
$bb['function']		= '';
$bb['function_var']     = '';

// append the bbcode to the default templates:

$BBCODE_TEMPLATE .= "{BB=highSlide}";
$BBCODE_TEMPLATE_NEWSPOST .= "{BB=highSlide}";
$BBCODE_TEMPLATE_ADMIN .= "{BB=highSlide}";
$BBCODE_TEMPLATE_CPAGE .= "{BB=highSlide}";

$eplug_bb[] = $bb;  // add to the global list - Very Important!

?>