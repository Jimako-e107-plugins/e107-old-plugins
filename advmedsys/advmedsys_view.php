<?php

/*
#######################################
#     e107 website system plguin     	 #
#     Advanced Medal System V1.2     	 #
#     by Marc Peppler                 	#
#     http://www.marc-peppler.at 	#
#     mail@marc-peppler.at            	#
#    Updated version 1.3, 1.4 by garyt  #
#######################################
*/
require_once("../../class2.php");
require_once(HEADERF);
//-----------------------------------------------------------------------------------------------------------+
//-----------------------------------------------------------------------------------------------------------+
if (e_QUERY) {
        $tmp = explode('.', e_QUERY);
        $action = $tmp[0];
        $sub_action = $tmp[1];
        $id = $tmp[2];
        unset($tmp);
}
$lan_file = e_PLUGIN."advmedsys/languages/".e_LANGUAGE.".php";
require_once(file_exists($lan_file) ? $lan_file :  e_PLUGIN."advmedsys/languages/English.php");
//-----------------------------------------------------------------------------------------------------------+
if ($action == "main" || $action == "") {

$text .= "
        <div>
        <table style='width:100%;' class='fborder' cellspacing='0' cellpadding='0'>
        <tr>
        <td style='width:30%' class='forumheader3'><center>".AMS_VIEW_S1."</td>
        <td style='width:60%;' class='forumheader3'>".AMS_VIEW_S2."</td>
        <td style='width:10%;' class='forumheader3'><center>".AMS_VIEW_S3."</td>
        </tr>";
        
		$sql->db_Select("advmedsys_medals", "*", "ORDER BY medal_name","");
        while($row = $sql->db_Fetch()){
$text .= "
        <tr>
        <td class='forumheader3'><center><img src='medalimg/".$row['medal_pic']."' alt = '".AMS_VIEW_S1."'></img></center></td>
        <td style='vertical-align:middle' class='forumheader3'>".$row['medal_name']."</td>
        <td style='vertical-align:middle' class='forumheader3'><center><a href='advmedsys_view.php?det.".$row['medal_id']."'>[ ".AMS_VIEW_S3." ]</a></td>
        </tr>";
        }
$text .= "
		</table>
        </div>";
	    $ns -> tablerender(AMS_VIEW_S1, $text);
			
// ---------------------------------------------Medal Statistics------------------------------------------+
	$medcounter = $sql -> db_Count("advmedsys_awarded");
		$medlast = 0;
		$currentunixtime = time();
		$threedaysagounix = $currentunixtime - (60*60*24*3);
	$sql->db_Select("advmedsys_awarded", "*", "", "");
		while($row = $sql->db_Fetch()){
		$dateindb = $row['awarded_date'];
		$dateexp = explode(".",$dateindb);
		$dateunix = mktime(0,0,0,$dateexp[0],$dateexp[1],$dateexp[2]);
		if ($dateunix > $threedaysagounix) {
		$medlast = $medlast + 1;
		}
	}

//----------- Bargraph code ----------------------

		if ($medcounter==0){
	$text2 .= AMS_MENU_S5;
		}
	else
	
	$medalnames = array();
	$medalid = array();
	
	$sql->db_Select("advmedsys_medals", "*", "ORDER BY medal_name", "");
		while($row = $sql->db_Fetch()){
		$medalnames[] = $row['medal_name'];
		$medalid[] = $row['medal_id'];
		}
// ---------- Count the medal awarded the most for $barmax  ------------------------------------
	for($i=0; $i < count($medalnames); $i++)
		{
			$sql->db_Select("advmedsys_awarded", "*", "awarded_medal_id like ".$medalid[$i]);
				$countermed = 0;
				while($row = $sql->db_Fetch()){
				$countermed++;
				}
				if ($counterhigh < $countermed) {
				$counterhigh=$countermed;
				}
			}
//------------ Done -------------
	
$text2 .= "
    <div>
	<table style='width:100%' class='fborder' cellspacing='0' cellpadding='0'>
	<tr>
	<td style='width:30%' class='forumheader3'><center>".AMS_VIEW_S2."</td>
	<td class='forumheader3'>".AMS_VIEW_S13."</td>
	<td class='forumheader3'><center><img src='" . e_PLUGIN . "advmedsys/images/".'piechart.png'."' vertical-align='middle'></img></td>
	</tr>";
	
	for($i=0; $i < count($medalnames); $i++)
		{
			$sql->db_Select("advmedsys_awarded", "*", "awarded_medal_id like ".$medalid[$i]);
				$counter1 = 0;
				while($row = $sql->db_Fetch()){
				$counter1++;
				}
				
//------------ calculate and set bargraph data ---------------------
		$graphWidthMax = 300;
		$barHeight = 8;
		$barMax = ($counterhigh);
		$barWidth = intval($graphWidthMax * $counter1/$barMax);
		$medalpercent = $counter1/$medcounter*100;

$text2 .= "
		<tr>
		<td style='width:30%; vertical-align:middle; padding-right:10px; text-align:right' class='forumheader3'>".$medalnames[$i]."</td>
		<td style='width:60%; vertical-align:middle' class='forumheader3'>
			<img src='" . e_PLUGIN . "advmedsys/images/".'reddot.png'."' width='$barWidth' height='$barHeight' vertical-align='middle'> ".$counter1."</img></td>
		<td style='width:10%; vertical-align:middle; padding-right:10px; text-align:right' class='forumheader3'>".number_format($medalpercent,1)." %</td>
		</tr>";
		}

$text2 .= "
</table></div>";

// Bargraph code end

$text2 .= "
        <div style='text-align:center'>
        <table style='width:60%' class='fborder' cellspacing='0' cellpadding='0'>
        <tr>
		<td style='width:60%; text-align:right' class='forumheader3'>".AMS_VIEW_S11.":</td>
		<td style='width:40%' class='forumheader3'>".$medcounter."</td>
        </tr>
		<tr>
		<td style='width:60%; text-align:right' class='forumheader3'>".AMS_VIEW_S12.":</td>
		<td style='width:40%' class='forumheader3'>".$medlast."</td>
        </tr>
        </table>
        </div>";
	    $ns -> tablerender(AMS_VIEW_S10, $text2);        
		require_once(FOOTERF);
}

if ($action == "det")
{
        $width = "width:100%";
           $text .= "
        <div style='text-align:center'>
	<br><a href='advmedsys_view.php'><center>[ ".AMS_VIEW_S9." ]</center></a><br>
        <table style='".$width."' class='fborder' cellspacing='0' cellpadding='0'>
        <tr>
        <td style='width:80px' class='forumheader3'><center>".AMS_VIEW_S1."</td>
        <td style='width:100%' class='forumheader3'>".AMS_VIEW_S2."</td>
        </tr>";
        $sql->db_Select("advmedsys_medals", "*", "WHERE medal_id = $sub_action","");
        $row = $sql->db_Fetch();
        $text .= "
        <tr>
        <td style='width:80px' class='forumheader3'><img src='medalimg/".$row['medal_pic']."' alt = '".AMS_VIEW_S1."'></img></td>
        <td style='width:100%; vertical-align:middle' class='forumheader3'>".$row['medal_name']."</td>
        </tr>
        </table>
        <br></br>
        <table style='".$width."' class='fborder' cellspacing='0' cellpadding='0'>
        <tr>
        <td style='width:100%' class='forumheader3'>".AMS_VIEW_S5."</td>
        </tr>
        <tr>
        <td style='width:100%' class='forumheader3'>".$row['medal_txt']."</td>
        </tr>
        </table>";
        $text .= "
        <br></br>
        <table style='".$width."' class='fborder' cellspacing='0' cellpadding='0'>
        <tr>
        <td style='width:40%' class='forumheader3'>".AMS_VIEW_S6."</td>
        <td style='width:60%' class='forumheader3'>".AMS_VIEW_S7."</td>
        </tr>";
        $sql->db_Select("advmedsys_awarded", "*", "WHERE awarded_medal_id=$sub_action ORDER BY awarded_date DESC","");
        while($row = $sql->db_Fetch()){
        $sql2->db_Select("user", "*", "WHERE user_id = '".$row['awarded_user_id']."'","");
        $row2 = $sql2->db_Fetch();
        $text .= "
        <tr>
        <td style='width:80px' class='forumheader3'><a href='".e_BASE."user.php?id.".$row['awarded_user_id']."'>".$row2['user_name']."</a></td>
        <td style='width:100%' class='forumheader3'>".$row['awarded_date']."</td>
        </tr>";
        }
        $text .= "</table>
	<br><a href='advmedsys_view.php'><center>[ ".AMS_VIEW_S9." ]</center></a><br>
	</div>";
	      $ns -> tablerender(AMS_VIEW_S1, $text);
  require_once(FOOTERF);
}
if ($action == "profile") {
        $width = "width:100%";
           $text .= "
        <div style='text-align:center'>
	<br><a href='advmedsys_view.php'><center>[ ".AMS_VIEW_S9." ]</center></a><br>
        <table style='".$width."' class='fborder' cellspacing='0' cellpadding='0'>
        <tr>
        <td style='width:80px' class='forumheader3'>".AMS_VIEW_S1."</td>
        <td style='width:100%' class='forumheader3'>".AMS_VIEW_S2."</td>
        <td style='width:80px' class='forumheader3'>".AMS_VIEW_S7."</td>
        </tr>";
        $sql->db_Select("advmedsys_awarded", "*", "WHERE awarded_user_id = $sub_action","");
        while($row = $sql->db_Fetch()){
        $sql2->db_Select("advmedsys_medals", "*", "WHERE medal_id = '".$row['medal_id']."'","");
        $row2 = $sql2->db_Fetch();
        $text .= "
        <tr>
        <td style='width:80px' class='forumheader3'><img src='images/".$row2['medal_pic']."' alt = 'Medal'></img></td>
        <td style='width:100%' class='forumheader3'><a href='advmedsys_view.php?details.".$row2['medal_id']."'>".$row2['medal_name']."</a></td>
        <td style='width:80px' class='forumheader3'>".$row['awarded_date']."</td>
        </tr>";
        }
        $text .= "</table>
	<br><a href='advmedsys_view.php'><center>[ ".AMS_VIEW_S9." ]</center></a><br>
        </div>";
        $sql->db_Select("user", "*", "WHERE user_id = $sub_action","");
        $row = $sql->db_Fetch();
	      $ns -> tablerender("".$row['user_name']." ".AMS_VIEW_S4, $text);
  require_once(FOOTERF);
  }
?>