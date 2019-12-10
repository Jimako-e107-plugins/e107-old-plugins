<?php
if (!defined('e107_INIT'))
{
    exit;
}
include_lan(e_PLUGIN . "creative_writer/languages/" . e_LANGUAGE . ".php");
 
 
class creative_writer_notify extends notify // plugin-folder + '_notify' 
{		
	function config()
	{		
		$config = array();
	
		$config[] = array(
			'name'			=> CWRITER_A69, //  "Message posted"
			'function'		=> "notify_creativewriternew",
			'category'		=> CWRITER_A1
		);	
		
		return $config;
	}	
	function notify_creativewriternew($data) 
	{	
				$message = "<strong>" . CWRITER_A70 . ': </strong>' . $data['user'] . '<br />';
        $message .= "<strong>" . CWRITER_A71 . ':</strong> ' . $data['itemtitle'] . "<br /><br />"  ;
        $message .= " " . CWRITER_A72 . " " . $data['catid'] . "<br /><br />";
        $this->send('creativewriternew', CWRITER_A69, $message);
	}	
}
?>