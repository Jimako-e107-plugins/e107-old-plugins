<?php
 
// If not a valid call to the script then leave it
if (!defined('e107_INIT'))
{   
   	require_once('../../class2.php');
}

e107::lan('creative_writer');

$pref = e107::pref('creative_writer');


require_once(e_PLUGIN . "creative_writer/includes/mybooks.class.php");

$my_books = new mybooks;
$my_books->init();
 
require_once(HEADERF);
 
 
$my_books->render($action);	
 
 
e107::getRender()->tablerender(CWRITER_01, $cwriter_text);
require_once(FOOTERF);
 
?>