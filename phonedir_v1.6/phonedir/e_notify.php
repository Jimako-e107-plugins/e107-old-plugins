<?php
#if (e_LANGUAGE != "English" && file_exists(e_PLUGIN . "phonedir/languages/admin/" . e_LANGUAGE . ".php"))
#{
#    include_once(e_PLUGIN . "phonedir/languages/admin/" . e_LANGUAGE . ".php");
#}
#else
#{
   include_once(e_PLUGIN . "phonedir/languages/admin/English.php");
#}
$config_category = phonedir_ADLAN_116;
$config_events = array('phonedir' => phonedir_ADLAN_115);

if (!function_exists('notify_phonedir'))
{
    function notify_phonedir($data)
    {
        global $nt;
        $message = "<strong>" . phonedir_ADLAN_117 . ': </strong>' . $data['user'] . '<br />';
        $message .= phonedir_ADLAN_118 . " " . $data['pdirchange'] . "<br />";
		$nt->send('phonedir', phonedir_ADLAN_115, $message);
    }
}
?>