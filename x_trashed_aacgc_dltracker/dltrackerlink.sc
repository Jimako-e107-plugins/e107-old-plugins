global $dl;

$dlusers = "";
$dlusers_id = "";

$url = $_SERVER["REQUEST_URI"];
$dlusers = explode(".", $url);
if ($dlusers[1] == 'php?view') 
{$dlusers = $dlusers[2];}

$dlusers_id = $dlusers;
//------------------------------------------------------

$dltrackerlink .= " [<a href='".e_PLUGIN."aacgc_dltracker/DLTracker_Details.php?det.".$dlusers_id."'>View Downloaders</a>]";

//------------------------------------------------------

return $dltrackerlink;

//------------------------------------------------------


