<?php
/*
+---------------------------------------------------------------+
|        e107 website system
|
|        ©Steve Dunstan 2001-2002
|        http://e107.org
|        jalist@e107.org
|
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
|
|		$Source: ../e107_plugins/sport_league_e107/league_stats_count.php $
|		$Revision: 0.84 $
|		$Date: 2010/02/04 $
|		$Author: ***RuSsE*** $
+---------------------------------------------------------------+
*/
function points_count($game,$teamH,$teamG)
{
global $sql;
$sql -> db_Select("league_points_value", "*", "points_value_id > 2 ORDER BY points_value_id");
$count=0;
while($row = $sql-> db_Fetch())
 	{$count=$row['points_value_id'];
 	$strafen_wert[$count]['points_value_name']=$row['points_value_name'];
 	$strafen_wert[$count]['points_value_typ']=$row['points_value_typ'];
 	$strafen_wert[$count]['points_value_mat']=$row['points_value_mat'];
 	}

$sql -> db_Select("league_points", "*", "points_game_id=".$game." AND points_team_id='".$teamH."' AND points_value=1 ORDER BY points_time");
$goals_count=0;
while($row = $sql-> db_Fetch())
 	{
 	$GOAL[$goals_count]['points_time']=$row['points_time'];
 	$goals_count++;
 	}
//////+++++++++++++++++++
$sql -> db_Select("league_points", "*", "points_game_id=".$game." AND points_team_id='".$teamG."' AND points_value > 2 ORDER BY points_time");
$StarfeG_count=0;
while($row = $sql-> db_Fetch())
 	{
 	$STRAFE_FLAG=$strafen_wert[$row['points_value']]['points_value_typ'];
 	if($STRAFE_FLAG==2)
 		{
 		$StarfeG[$StarfeG_count]['von']=$row['points_time'];
 		$StarfeG[$StarfeG_count]['bis']= time_math($StarfeG[$StarfeG_count]['von'],$strafen_wert[$row['points_value']]['points_value_mat']);}
 		$StarfeG_count++;
 	}
/////++++++++++++++++++++
$sql -> db_Select("league_points", "*", "points_game_id=".$game." AND points_team_id='".$teamH."' AND points_value > 2 ORDER BY points_time");
$StarfeH_count=0;
while($row = $sql-> db_Fetch())
 	{
 	$STRAFE_FLAG=$strafen_wert[$row['points_value']]['points_value_typ'];
 	if($STRAFE_FLAG==2)
 		{
 		$StarfeH[$StarfeH_count]['von']=$row['points_time'];
 		$StarfeH[$StarfeH_count]['bis']= time_math($StarfeH[$StarfeH_count]['von'],$strafen_wert[$row['points_value']]['points_value_mat']);}
 		$StarfeH_count++;
 	}
/////++++++++++++++++++++
for($i=0; $i < $goals_count ;$i++)
	{$GOAL[$i]['GS']=0;
	 $GOAL[$i]['HS']=0;
	for($j=0; $j < $StarfeG_count ;$j++)
		{
		if($StarfeG[$j]['von'] < $GOAL[$i]['points_time'] && $StarfeG[$j]['bis'] > $GOAL[$i]['points_time'] )
			{
			$GOAL[$i]['GS']++;
			}
		} 
	for($j=0; $j < $StarfeH_count ;$j++)
		{
		if($StarfeH[$j]['von'] < $GOAL[$i]['points_time'] && $StarfeH[$j]['bis'] > $GOAL[$i]['points_time'] )
			{
			$GOAL[$i]['HS']++;
			}
		} 
	 }
return $GOAL;
}
///////////////////////////////##################################################//////////////////////////
function time_math($wert1,$wert2)
{
list($min, $sek) = explode(":", $wert1);
$min = intval($min);
$NewMin=$min+$wert2;
if($NewMin < 10)
	{$Ausgabe="0";}
$Ausgabe.="".$NewMin.":".$sek."";
return $Ausgabe;
}

?>