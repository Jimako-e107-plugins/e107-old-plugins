<?php
if (!defined('e107_INIT')) { exit; }
if (e_LANGUAGE != "English" && file_exists(e_PLUGIN . "e_classifieds/languages/admin/" . e_LANGUAGE . ".php"))
{
    include_once(e_PLUGIN . "e_classifieds/languages/admin/" . e_LANGUAGE . ".php");
} 
else
{
    include_once(e_PLUGIN . "e_classifieds/languages/admin/English.php");
} 
$config_category = ECLASSF_A43;
$config_events = array('eclassfpost' => ECLASSF_A44);

if (!function_exists('notify_eclassfpost'))
{
    function notify_eclassfpost($data)
    {
        global $nt;

        if ($data['action'] = "update")
        {
            $message = "<strong>" . ECLASSF_A49 . ': </strong>' . $data['user'] . '<br />';
        } 
        else
        {
            $message = "<strong>" . ECLASSF_A45 . ': </strong>' . $data['user'] . '<br />';
        } 
        $message .= "<strong>" . ECLASSF_A46 . ':</strong> ' . $data['itemtitle'] . "<br /><br />" . ECLASSF_A48 ;
        $message .= " " . ECLASSF_A47 . " " . $data['catid'] . "<br /><br />";
        $nt->send('eclassfpost', ECLASSF_A44, $message);
    } 
} 

?>