if ($pref['dltracker_enable_profile'] == "1"){
global $sql,$sql2,$user; 

$suser = "";
$USER_ID = "";

$url = $_SERVER["REQUEST_URI"];
$suser = explode(".", $url);
if ($suser[1] == 'php?id') 
{$suser = $suser[2];}

$SUSER_ID = $suser;

if (USER){

//------------------------------------------------------

$dltuser .= "<tr><td class='forumheader3' colspan='2'>
<b><u>Download Tracker:</u></b><br><br>
<div style='height:200px; width:100%; overflow:auto'>
<table style='width:100%'>";

//------------------------------------------------------

$sql->db_Select("download_requests", "*", "download_request_userid='".intval($SUSER_ID)."' ORDER BY download_request_datestamp DESC");
while($row = $sql->db_Fetch()){

$sql2->db_Select("download", "*", "download_id='".intval($row['download_request_download_id'])."'");
$row2 = $sql2->db_Fetch();

$gen = new convert;
$updated = $gen -> computeLapse($row['download_request_datestamp'], false, false, true, 'short');       
$when = ($updated ? $updated : "1 ".LANDT_09)." ".LANDT_AGO; 
$date = date("M d, Y",$row['download_request_datestamp']);

//------------------------------------------------------

if ($row['download_request_userid'] == "")
{$dltuser .= "
<tr>
<td colspan='2'><i>No Files Downloaded</i></td>
</tr>";}
else
{
//------------------------------------------------------

if ($row2['download_name'] == ""){}
else
{
//------------------------------------------------------

$dltuser .= "
<tr>
<td style='width:40%' class='indent'><a href='".e_BASE."download.php?view.".$row2['download_id']."'>".$row2['download_name']."</a></td>
<td style='width:60%' class='indent'>".$date." (".$when.")</td>
</tr>
";

//------------------------------------------------------
}}
}

$dltuser .= "</table></div></td></tr>";

//------------------------------------------------------

return "".$dltuser."";

//------------------------------------------------------
}}


