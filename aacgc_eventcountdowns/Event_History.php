<?php

/*
#######################################
#     AACGC Event Countdowns          #                
#     by M@CH!N3                      #
#     http://www.AACGC.com            #
#######################################
*/

global $tp;

require_once("../../class2.php");
require_once(HEADERF);

require_once(e_HANDLER."form_handler.php"); 
require_once(e_HANDLER."file_class.php");
$rs = new form;
$fl = new e_file;
include_lan(e_PLUGIN."aacgc_eventcountdowns/languages/".e_LANGUAGE.".php");

if (e_QUERY) {
        $tmp = explode('.', e_QUERY);
        $action = $tmp[0];
        $sub_action = $tmp[1];
        $id = $tmp[2];
        unset($tmp);
}

if($pref['ecds_theme'] == "1"){
$themea = "forumheader3";
$themeb = "indent";}
else
{$themea = "";
$themeb = "";}

//-------------------# Title #--------------------

$title .= "".ECDS_02."";

//--- # Order #-----
$order = "ecds_date DESC";
$idlink = $action.".".$sub_action.".iddesc";
$titlelink = $action.".".$sub_action.".titleasc";
$datelink = $action.".".$sub_action.".dateasc";

$view = "<img src='".e_PLUGIN."aacgc_eventcountdowns/images/view.png' alt='' />";

if($id == "idasc")
{$order = "ecds_id ASC";
$idlink = $action.".".$sub_action.".iddesc";}
if($id == "iddesc")
{$order = "ecds_id DESC";
$idlink = $action.".".$sub_action.".idasc";}

if($id == "titleasc")
{$order = "ecds_title ASC";
$titlelink = $action.".".$sub_action.".titledesc";}
if($id == "titledesc")
{$order = "ecds_title DESC";
$titlelink = $action.".".$sub_action.".titleasc";}

if($id == "dateasc")
{$order = "ecds_date ASC";
$datelink = $action.".".$sub_action.".datedesc";}
if($id == "datedesc")
{$order = "ecds_date DESC";
$datelink = $action.".".$sub_action.".dateasc";}

//--------------# Multipage Script #---------------------------

if($action == ""){$action = "1";}
if($sub_action == ""){$sub_action = "10";}

$rowsPerPage = intval($sub_action);
$pageNum = 1;
$pageNum = intval($action);
$offset = ($pageNum - 1) * $rowsPerPage;

$query = @mysql_query("SELECT ecds_id FROM ".MPREFIX."aacgc_eventcountdowns");
$numrows = mysql_num_rows($query);

$maxPage = ceil($numrows/$rowsPerPage);
$history = e_PLUGIN."aacgc_eventcountdowns/Event_History.php";
$nav = '';

for($page = 1; $page <= $maxPage; $page++) {
if ($page == $pageNum) 
{$nav .= " ".$page." ";} 
else 
{$nav .= " <a href='".$history."?".$page.".".$rowsPerPage.".".$id."'>".$page."</a> ";}}

if ($pageNum > 1) 
{$page  = $pageNum - 1;
$prev  = " <a href='".$history."?".$page.".".$rowsPerPage.".".$id."'><<</a> ";} 
else 
{$prev  = "";}

if ($pageNum < $maxPage) 
{$page = $pageNum + 1;
$next = " <a href='".$history."?".$page.".".$rowsPerPage.".".$id."'>>></a> ";} 
else 
{$next = "";}

$eventsperpage = "".ECDS_07."<br><a href='".e_SELF."?".$action.".10.".$id."'>10</a> | <a href='".e_SELF."?".$action.".20.".$id."'>20</a> | <a href='".e_SELF."?".$action.".50.".$id."'>50</a>";

//---------------------------------------------------------------

$limit = "LIMIT ".$offset.",".$rowsPerPage."";

//----------------------# Events #------------------------------------------------
$backlink = "<a href='".e_PLUGIN."aacgc_eventcountdowns/Events.php'><img width='16px' height='16px' src='".e_PLUGIN."aacgc_eventcountdowns/images/back.png' align='left' /></a>";
if(ADMIN){$adminadd = "<a href='".e_PLUGIN."aacgc_eventcountdowns/admin_events.php'><img width='16px' height='16px' src='".e_PLUGIN."aacgc_eventcountdowns/images/add.png' align='right' /></a>";}

$text .= "".$backlink." ".$adminadd."
<table style='width:100%' class='".$themea."'>";

$text .= "
	  <tr>
      <td class='".$themea."' style='text-align:center' colspan='4'><font size='3'><b>".ECDS_02."</b></font></td>
      </tr>
	  <tr>
 	  <td colspan='4' style='text-align:center' class=''>".$eventsperpage."</td>
	  </tr>
	  <tr>
 	  <td colspan='4' style='text-align:center' class=''><br><i>(".ECDS_06.")</i><br></td>
	  </tr>";

$text .= "
	  <tr>          
	  <td style='width:0%' class='".$themea."'><a href='".e_PLUGIN."aacgc_eventcountdowns/Event_History.php?".$idlink."'>".ECDS_03."</a></td>
	  <td style='width:50%' class='".$themea."'><a href='".e_PLUGIN."aacgc_eventcountdowns/Event_History.php?".$titlelink."'>".ECDS_04."</a></td>
      <td style='width:50%' class='".$themea."' colspan='2'><a href='".e_PLUGIN."aacgc_eventcountdowns/Event_History.php?".$datelink."'>".ECDS_05."</a></td>
	  </tr>
";


$sql->db_Select("aacgc_eventcountdowns", "*", "order by ".$order." ".$limit."", "");
while($row = $sql->db_Fetch()){
	
$ecdsid = $row['ecds_id'];
$ecdstitle = "<a href='".e_PLUGIN."aacgc_eventcountdowns/Event_Details.php?".$ecdsid."'>".$tp -> toHTML($row['ecds_title'], TRUE)."</a>";
$ecdsdate = date($pref['ecds_dateformat'], $row['ecds_date'])." ".$row['ecds_tzone'];
$ecdsview = "<a href='".e_PLUGIN."aacgc_eventcountdowns/Event_Details.php?".$ecdsid."'><img src='".e_PLUGIN."aacgc_eventcountdowns/images/view.png' alt='' /></a>";

$text .= "<tr>          
	  <td style='width:0%' class='".$themeb."'>".$ecdsid."</td>
	  <td style='width:50%' class='".$themeb."'>".$ecdstitle."</td>
      <td style='width:50%' class='".$themeb."'>".$ecdsdate."</td>
      <td style='width:0%' class='".$themeb."'>".$ecdsview."</td>
	  </tr>
";}


$text .= "</table>";




//----#AACGC Plugin Copyright&reg; - DO NOT REMOVE BELOW THIS LINE! - #-------+
require(e_PLUGIN . 'aacgc_eventcountdowns/plugin.php');
$copyright .= "<br/><br/><br/><br/><br/><br/><br/>
<a href='http://www.aacgc.com' target='_blank'><font color='808080' size='1'>".$eplug_name." V".$eplug_version."  &reg;</font></a>";
$ns -> tablerender($title, $text."<br><br><center>".$prev.$nav.$next."</center>".$copyright);
require_once(FOOTERF);
?>