<?php

if (!defined('e107_INIT'))
{
	require_once("../../class2.php");
}

$template =  'chapter_list';
 
$chapter = e107::getSingleton('chapter_writer',e_PLUGIN.'creative_writer/includes/chapter.class.php');
 
$chapter->init();

if($parms['limit']) {
  $chapter->setLimit($parms['limit']);
}
else $chapter->setLimit(4);

require_once(HEADERF); 
$chapter->render('list', $template);
require_once(FOOTERF);

?>