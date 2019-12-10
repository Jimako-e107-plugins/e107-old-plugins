<?php

if (!defined('e107_INIT'))
{
	require_once("../../class2.php");
}
   
$challenge = e107::getSingleton('challenge_writer',e_PLUGIN.'creative_writer/includes/challenge.class.php');
$book     = e107::getSingleton('creative_writer',e_PLUGIN.'creative_writer/includes/creative_writer.class.php');   
$challenge->init();
require_once(HEADERF);

/* renders paginated list of challenges or one challenge */
$challenge->render();   

/* if one challenge is displayed, display all related books */ 
if (array_key_exists('challenge_id', $_GET)) {
	$book->render('challenge'); 
} 
    
require_once(FOOTERF);
 
 



?>