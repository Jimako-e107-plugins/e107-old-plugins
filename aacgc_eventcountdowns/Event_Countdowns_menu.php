<?php
global $tp;	
if($pref['ecds_theme'] == "1"){
$themea = "forumheader3";
$themeb = "indent";}
else
{$themea = "";
$themeb = "";}
include_lan(e_PLUGIN."aacgc_eventcountdowns/languages/".e_LANGUAGE.".php");

//-------------------------# Menu Title #--------------------------------------------------------------------+
$ecds_title .= $pref['ecds_menutitle'];
	
//----------------# gather events #---------------+		
$offset = $pref['ecds_dateoffset'];
$now = time() + ($offset * 60);

$ecds_text .= "<table style='width:100%' class=''>";

$sql->db_Select("aacgc_eventcountdowns", "*", "ecds_date > ".$now." order by ecds_date asc limit 0,1");
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
$ecds_text .= $counterscript;

//----------------# show events and countdowns #-----------------+

if($pref['ecds_countercolor'] == "black"){$color = "#000000";}
if($pref['ecds_countercolor'] == "white"){$color = "#ffffff";}
if($pref['ecds_countercolor'] == "red"){$color = "#ff0000";}
if($pref['ecds_countercolor'] == "yellow"){$color = "#ffff00";}
if($pref['ecds_countercolor'] == "green"){$color = "#00ff00";}
if($pref['ecds_countercolor'] == "blue"){$color = "#0000ff";}

$ecds_text .= "
	<tr>
		<td style='text-align:center;' class='".$themea."' colspan='2'>
			<a href='".e_PLUGIN."aacgc_eventcountdowns/Event_Details.php?".$nexteventid."'>".$tp -> toHTML($row['ecds_title'], TRUE)."</a>
			<br/>
			<small>(".date($pref['ecds_dateformat'], $row['ecds_date'])." ".$row['ecds_tzone'].")</small>
			<br/>
			<div id='currcountbox".$nexteventid."' style='width:95%; text-align:center; color:".$color."; font-size:".$pref['ecds_countersize']."px' class='".$themeb."' align='center'></div>
		</td>
	</tr>
";

$ecds_text .= "</table>";

//----------------# More Events #---------------------------------+
if($pref['ecds_showfuturemenu'] == "1"){
$ecds_text .= "
<table style='width:100%' class=''>
	<tr>
		<td style='text-align:center;' class='".$themea."'><a href='".e_PLUGIN."aacgc_eventcountdowns/Events.php'><b>".ECDS_01."</b></a></td>
	</tr>
</table>
";

if($pref['ecds_menuheight'] != "auto")
{$ecds_text .= "<div style='width:100%; height:".$pref['ecds_menuheight']."; overflow:auto'>";}

$ecds_text .= "<table style='width:100%' class=''>";

$sql2 = new db;
$sql2->db_Select("aacgc_eventcountdowns", "*", "ecds_date > ".$now." order by ecds_date asc limit 1,".$pref['ecds_maxevents']."");
while($row2 = $sql2->db_Fetch()){
	
$ecds_text .= "
	<tr>
		<td style='text-align:center; width:50%;' class='".$themea."'><a href='".e_PLUGIN."aacgc_eventcountdowns/Event_Details.php?".$row2['ecds_id']."'>".$tp -> toHTML($row2['ecds_title'], TRUE)."</a></td>
		<td style='text-align:center; width:50%;' class='".$themea."'>".date($pref['ecds_dateformat'], $row2['ecds_date'])." ".$row2['ecds_tzone']."</td>
	</tr>
";	
	
}

$ecds_text .= "</table>";
}
if($pref['ecds_menuheight'] != "auto")
{$ecds_text .= "</div>";}

//-----------------------------------------------------------------------------------------------------------+
//$ns -> tablerender($ecds_title, $ecds_text);
if ((e_PAGE != "Events.php") AND (e_PAGE != "Event_Details.php")){$ns -> tablerender($ecds_title, $ecds_text);}

?>