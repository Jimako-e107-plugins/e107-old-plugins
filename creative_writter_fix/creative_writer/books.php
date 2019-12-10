<?php

if (!defined('e107_INIT'))
{
	require_once("../../class2.php");
}
   
$book = e107::getSingleton('book_writer',e_PLUGIN.'creative_writer/includes/book.class.php');
$chapter = e107::getSingleton('chapter_writer',e_PLUGIN.'creative_writer/includes/chapter.class.php');
  
$book->init();
require_once(HEADERF);
$book->render();
 
/* if one book is displayed, display first chapter too */ 
if (array_key_exists('book_id', $_GET)) { 
	$text = $chapter->showChapter(1, 'book_detail');
  e107::getRender()->tablerender('',  $text, 'chapter-show');
} 

require_once(FOOTERF);
exit;          

 



?>