<?php
if (!defined('e107_INIT'))
{
    exit;
}
include_lan(e_PLUGIN . "creative_writer/languages/" . e_LANGUAGE . ".php");
$config_category = CWRITER_A1;
$config_events = array('creativewriternew' => CWRITER_A69);

if (!function_exists('notify_creativewriternew'))
{
    function notify_creativewriternew($data)
    {
        global $nt;
        $message = "<strong>" . CWRITER_A70 . ': </strong>' . $data['user'] . '<br />';
        $message .= "<strong>" . CWRITER_A71 . ':</strong> ' . $data['itemtitle'] . "<br /><br />"  ;
        $message .= " " . CWRITER_A72 . " " . $data['catid'] . "<br /><br />";
        $nt->send('creativewriternew', CWRITER_A69, $message);
    }
}

?>