<?php

if (!defined('e107_INIT'))
{
	require_once("../../class2.php");
}
   
$chapter = e107::getSingleton('chapter_writer',e_PLUGIN.'creative_writer/includes/chapter.class.php');
   
$chapter->init();
require_once(HEADERF);
/* renders paginated list of chapters or one chapter */
$chapter->render();
require_once(FOOTERF);
exit;          

 



?>