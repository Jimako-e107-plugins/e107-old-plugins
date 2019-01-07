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
include_lan(e_PLUGIN."aacgc_eventcountdowns/languages/".e_LANGUAGE.".php");

//-----------------------------------------------------------------------------------------------------------+

$sql->db_Select("aacgc_eventcountdowns", "*", "ecds_id = '".$action."'");
$row = $sql->db_Fetch();

	$nexteventid = $row['ecds_id'];
	$nexteventtimestamp = $row['ecds_date'];
	
	$nextdateyear = "Y";
	$nextdatemonth = "n";
	$nextdateday = "j";
	$nextdatehour = "H";
	$nextdatemin = "i";

	$nextdateyearshow = date($nextdateyear, $nexteventtimestamp);
	$nextdatemonthshow = date($nextdatemonth, $nexteventtimestamp);
	$nextdatedayshow = date($nextdateday, $nexteventtimestamp);
	$nextdatehourshow = date($nextdatehour, $nexteventtimestamp);
	$nextdateminshow = date($nextdatemin, $nexteventtimestamp);
	$nextdatemonthfixed = $nextdatemonthshow - 1;
	$nextshowcounter = "".$nextdateyearshow.",".$nextdatemonthfixed.",".$nextdatedayshow.",".$nextdatehourshow.",".$nextdateminshow."";

require_once("".e_PLUGIN."aacgc_eventcountdowns/counter.php");
$text .= $counterscript;

//----------------# show event and countdown #-----------------+

if($pref['ecds_countercolor'] == "black"){$color = "#000000";}
if($pref['ecds_countercolor'] == "white"){$color = "#ffffff";}
if($pref['ecds_countercolor'] == "red"){$color = "#ff0000";}
if($pref['ecds_countercolor'] == "yellow"){$color = "#ffff00";}
if($pref['ecds_countercolor'] == "green"){$color = "#00ff00";}
if($pref['ecds_countercolor'] == "blue"){$color = "#0000ff";}

$backlink = "<a href='".e_PLUGIN."aacgc_eventcountdowns/Events.php'><img width='16px' height='16px' src='".e_PLUGIN."aacgc_eventcountdowns/images/back.png' align='left' /></a>";
if(ADMIN){$adminedit = "<a href='".e_PLUGIN."aacgc_eventcountdowns/admin_events.php?edit.".$row['ecds_id']."'><img width='16px' height='16px' src='".e_PLUGIN."aacgc_eventcountdowns/images/edit.png' align='right' /></a>";}

$text .= "".$backlink." ".$adminedit."
<table style='width:100%' class='".$themea."'>
	<tr>
		<td style='text-align:center' class='".$themea."'>".$tp -> toHTML($row['ecds_title'], TRUE)."</td>
	</tr>
	<tr>
		<td style='text-align:center;' class=''>
			".date($pref['ecds_dateformat'], $row['ecds_date'])." ".$row['ecds_tzone']."
		</td>
	</tr>	
	<tr>
		<td style='text-align:center;' class='".$themeb."'>
			<div id='currcountbox".$nexteventid."' style='width:100%; text-align:center; color:".$color."; font-size:".$pref['ecds_countersize']."px' align='center'></div>
		</td>
	<tr>
		<td style='' class=''>".$tp -> toHTML($row['ecds_detail'], TRUE)."</td>
	</tr>
</table>";

//-------------------------# Page Title #--------------------------------------------------------------------+

$title .= "".ACR_28."";

//----#AACGC Plugin Copyright&reg; - DO NOT REMOVE BELOW THIS LINE! - #-------+
require(e_PLUGIN . 'aacgc_eventcountdowns/plugin.php');
$text .= "<br/><br/><br/><br/><br/><br/><br/>
<a href='http://www.aacgc.com' target='_blank'><font color='808080' size='1'>".$eplug_name." V".$eplug_version."  &reg;</font></a>";
//------------------------------------------------------------------------+
$ns -> tablerender($title, $text);
require_once(FOOTERF);
?>