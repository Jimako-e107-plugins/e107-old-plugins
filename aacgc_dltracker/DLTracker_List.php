<?php

/*
#######################################
#     AACGC Download Tracker          #                
#     by M@CH!N3                      #
#     http://www.AACGC.com            #
#######################################
*/


require_once("../../class2.php");
require_once(HEADERF);

if ($pref['dltracker_enable_gold'] == "1"){$gold_obj = new gold();}

//---------------------------------------------------------------------------------
$title .= "".$pref['dltracker_pagetitle'].""; 
//---------------------------------------------------------------------------------
//--------------# Multipage Script #---------------------------
if ($pref['dltracker_rendperpage'] != '') 
{$rowsPerPage = $pref['dltracker_rendperpage'];} 
else 
{$rowsPerPage = "25";}

if(isset($_GET['rowspp']))
{$rowsPerPage = intval($_GET['rowspp']);}

$pageNum = 1;
if(isset($_GET['page']))
{$pageNum = intval($_GET['page']);}

$offset = ($pageNum - 1) * $rowsPerPage;


$query = @mysql_query("SELECT download_id FROM ".MPREFIX."download");
$numrows = mysql_num_rows($query);

if(isset($_POST['page'])) 
{$rowsPerPage = intval($_POST['page']);}

$maxPage = ceil($numrows/$rowsPerPage);
$self = $_SERVER['PHP_SELF'];
$nav  = '';

for($page = 1; $page <= $maxPage; $page++) {
if ($page == $pageNum) 
{$nav .= " $page ";} 
else 
{$nav .= " <a href=\"$self?page=".$page."&rowspp=".$rowsPerPage."\">$page</a> ";}}

if ($pageNum > 1) 
{$page  = $pageNum - 1;
$prev  = " <a href=\"$self?page=$page&rowspp=$rowsPerPage\">Previous</a> ";} 
else 
{$prev  = "";}

if ($pageNum < $maxPage) 
{$page = $pageNum + 1;
$next = " <a href=\"$self?page=$page&rowspp=$rowsPerPage\">Next Page</a> ";} 
else 
{$next = "";}

$limit = "LIMIT ".$offset.", ".$rowsPerPage."";

//--------------------------------------------------------------

$text .= "<table style='width:100%' class=''>
<tr>
<td style='width:75%'><u>Download Name</u></td>
<td style='width:25%'><u>Times Downloaded</u></td>
</tr>";

if ($pref['dltracker_order'] == "Name/ASC")
{$order = "ORDER BY download_name ASC ";}
if ($pref['dltracker_order'] == "Name/DESC")
{$order = "ORDER BY download_name DESC ";}
if ($pref['dltracker_order'] == "Times Downloaded/ASC")
{$order = "ORDER BY download_requested ASC ";}
if ($pref['dltracker_order'] == "Times Downloaded/DESC")
{$order = "ORDER BY download_requested DESC ";}
if ($pref['dltracker_order'] == "")
{$order = "ORDER BY download_requested DESC ";}

$sql ->db_Select("download", "*", "$order $limit","");
while($row = $sql->db_Fetch()){


$text .= "
<tr>
<td class='forumheader3'><a href='".e_PLUGIN."aacgc_dltracker/DLTracker_Details.php?det.".$row['download_id']."'>".$row['download_name']."</a></td>
<td class='forumheader3'>".$row['download_requested']."</td>
</tr>";}




$text .= "</table>";


//---------------------------------------------------------------------------------



//----#AACGC Plugin Copyright&reg; - DO NOT REMOVE BELOW THIS LINE! - #-------+
require(e_PLUGIN . 'aacgc_dltracker/plugin.php');
$copyright .= "<br><br><br><br><br><br><br>
<a href='http://www.aacgc.com' target='_blank'>
<font color='808080' size='1'>".$eplug_name." V".$eplug_version."  &reg;</font>
</a>";
//------------------------------------------------------------------------+




$ns -> tablerender($title, $text."<br><br>".$prev.$nav.$next.$copyright);



//----------------------------------------------------------------------------------

require_once(FOOTERF);


