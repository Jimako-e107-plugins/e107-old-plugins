<?php

if (!defined('e107_INIT')) { exit; }

class eversion_menu
{
	function __construct()
	{
		// e107::lan('_blank','menu',true); // English_menu.php or {LANGUAGE}_menu.php
	}

	
	public function config($menu='')
	{

		$fields = array();
		$fields['eversionCaption']     = array('title'=> "Caption", 'type'=>'text', 'multilan'=>true, 'writeParms'=>array('size'=>'xxlarge') );
		$fields['eversionLimit']       = array('title'=> "Number of Items to Display", 'type'=>'number', 'writeParms'=>array('pattern'=>'[0-9]*', 'default'=>4));
    return $fields;

	}

} 

?>