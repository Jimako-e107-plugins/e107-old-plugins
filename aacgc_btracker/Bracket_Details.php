<?php

/*
#######################################
#     AACGC Bracket Tracker           #                
#     by M@CH!N3                      #
#     http://www.AACGC.com            #
#######################################
*/


require_once("../../class2.php");
require_once(HEADERF);

if (e_QUERY) {
        $tmp = explode('.', e_QUERY);
        $action = $tmp[0];
        $sub_action = $tmp[1];
        $id = $tmp[2];
        unset($tmp);
}


//---------------------------------------------------------------------------------

$title .= "".$pref['aacgc_bt_pagetitle'].""; 

//---------------------------------------------------------------------------------

$text .= "
<STYLE TYPE='text/css'>
<!--
.block, .block TD, .block TH
{background-color:".$pref['aacgc_bt_barcolor'].";}
-->
</STYLE>";

$sql->db_Select("aacgc_bt_cat", "*", "cat_id='".intval($sub_action)."'");
$row = $sql->db_Fetch();


$text .= "<br><center>[ <a href='".e_PLUGIN."aacgc_btracker/Bracket_List.php'>Back To Bracket List</a> ]</center><br><br>";

$text .= "<table style='width:100%' class=''>
          <tr><td><center><font size='4'><b><u>".$row['cat_name']."</u></b></font></center></td></tr>
          </table><br><br>";



$text .= "<br><br>
          <table style='width:100%' class='indent'><tr>
          <td class='forumheader3'><b><u>Round 1</u></b></td>
          <td class=''></td>
          <td class='forumheader3'><b><u>Round 2</u></b></td>
          <td class=''></td>
          <td class='forumheader3'><b><u>Round 3</u></b></td>
          <td class=''></td>
          <td class='forumheader3'><b><u>Round 4</u></b></td>
          <td class=''></td>
          <td class='forumheader3'><b><u>Round 5</u></b></td>
          </tr>";


$sql2 = new db;
$sql2->db_Select("aacgc_bt_members", "*", "user_cat='".intval($row['cat_id'])."'");
while($row2 = $sql2->db_Fetch()){
$sql3 = new db;
$sql3->db_Select("user", "*", "user_id='".intval($row2['user_id'])."'");
$row3 = $sql3->db_Fetch();
$sql6 = new db;
$sql6->db_Select("aacgc_bt_teams", "*", "team_id='".intval($row2['user_team'])."'");
$row6 = $sql6->db_Fetch();

if ($row6['team_color'] == "Red"){
$teamcolor = "#FF0000";}
if ($row6['team_color'] == "Blue"){
$teamcolor = "#0000FF";}
if ($row6['team_color'] == "Green"){
$teamcolor = "#00FF00";}
if ($row6['team_color'] == "Yellow"){
$teamcolor = "#FFFF00";}
if ($row6['team_color'] == "Purple"){
$teamcolor = "#800080";}
if ($row6['team_color'] == "White"){
$teamcolor = "#FFFFFF";}
if ($row6['team_color'] == "Orange"){
$teamcolor = "#FF8040";}

if ($row2[''] == ""){}

if ($row2['user_place'] == "1"){$place1 = "<b>".$row3['user_name']."</b><br>(<font color='".$teamcolor."'>".$row6['team_name']."</font>)";}
if ($row2['user_place'] == "2"){$place2 = "<b>".$row3['user_name']."</b><br>(<font color='".$teamcolor."'>".$row6['team_name']."</font>)";}
if ($row2['user_place'] == "3"){$place3 = "<b>".$row3['user_name']."</b><br>(<font color='".$teamcolor."'>".$row6['team_name']."</font>)";}
if ($row2['user_place'] == "4"){$place4 = "<b>".$row3['user_name']."</b><br>(<font color='".$teamcolor."'>".$row6['team_name']."</font>)";}
if ($row2['user_place'] == "5"){$place5 = "<b>".$row3['user_name']."</b><br>(<font color='".$teamcolor."'>".$row6['team_name']."</font>)";}
if ($row2['user_place'] == "6"){$place6 = "<b>".$row3['user_name']."</b><br>(<font color='".$teamcolor."'>".$row6['team_name']."</font>)";}
if ($row2['user_place'] == "7"){$place7 = "<b>".$row3['user_name']."</b><br>(<font color='".$teamcolor."'>".$row6['team_name']."</font>)";}
if ($row2['user_place'] == "8"){$place8 = "<b>".$row3['user_name']."</b><br>(<font color='".$teamcolor."'>".$row6['team_name']."</font>)";}
if ($row2['user_place'] == "9"){$place9 = "<b>".$row3['user_name']."</b><br>(<font color='".$teamcolor."'>".$row6['team_name']."</font>)";}
if ($row2['user_place'] == "10"){$place10 = "<b>".$row3['user_name']."</b><br>(<font color='".$teamcolor."'>".$row6['team_name']."</font>)";}
if ($row2['user_place'] == "11"){$place11 = "<b>".$row3['user_name']."</b><br>(<font color='".$teamcolor."'>".$row6['team_name']."</font>)";}
if ($row2['user_place'] == "12"){$place12 = "<b>".$row3['user_name']."</b><br>(<font color='".$teamcolor."'>".$row6['team_name']."</font>)";}
if ($row2['user_place'] == "13"){$place13 = "<b>".$row3['user_name']."</b><br>(<font color='".$teamcolor."'>".$row6['team_name']."</font>)";}
if ($row2['user_place'] == "14"){$place14 = "<b>".$row3['user_name']."</b><br>(<font color='".$teamcolor."'>".$row6['team_name']."</font>)";}
if ($row2['user_place'] == "15"){$place15 = "<b>".$row3['user_name']."</b><br>(<font color='".$teamcolor."'>".$row6['team_name']."</font>)";}
if ($row2['user_place'] == "16"){$place16 = "<b>".$row3['user_name']."</b><br>(<font color='".$teamcolor."'>".$row6['team_name']."</font>)";}}


$sql4 = new db;
$sql4->db_Select("aacgc_bt_place", "*", "place_cat='".intval($row['cat_id'])."'");
while($row4 = $sql4->db_Fetch()){
$sql5 = new db;
$sql5->db_Select("user", "*", "user_id='".intval($row4['user'])."'");
$row5 = $sql5->db_Fetch();
$sql8 = new db;
$sql8->db_Select("aacgc_bt_members", "*", "user_id='".intval($row5['user_id'])."'");
$row8 = $sql8->db_Fetch();
$sql7 = new db;
$sql7->db_Select("aacgc_bt_teams", "*", "team_id='".intval($row8['user_team'])."'");
$row7 = $sql7->db_Fetch();

if ($row7['team_color'] == "Red"){
$teamcolor = "#FF0000";}
if ($row7['team_color'] == "Blue"){
$teamcolor = "#0000FF";}
if ($row7['team_color'] == "Green"){
$teamcolor = "#00FF00";}
if ($row7['team_color'] == "Yellow"){
$teamcolor = "#FFFF00";}
if ($row7['team_color'] == "Purple"){
$teamcolor = "#800080";}
if ($row7['team_color'] == "White"){
$teamcolor = "#FFFFFF";}
if ($row7['team_color'] == "Orange"){
$teamcolor = "#FF8040";}

if ($row4['place'] == "1"){$splace1 = "<b>".$row5['user_name']."</b><br>(<font color='".$teamcolor."'>".$row7['team_name']."</font>)";}
if ($row4['place'] == "2"){$splace2 = "<b>".$row5['user_name']."</b><br>(<font color='".$teamcolor."'>".$row7['team_name']."</font>)";}
if ($row4['place'] == "3"){$splace3 = "<b>".$row5['user_name']."</b><br>(<font color='".$teamcolor."'>".$row7['team_name']."</font>)";}
if ($row4['place'] == "4"){$splace4 = "<b>".$row5['user_name']."</b><br>(<font color='".$teamcolor."'>".$row7['team_name']."</font>)";}
if ($row4['place'] == "5"){$splace5 = "<b>".$row5['user_name']."</b><br>(<font color='".$teamcolor."'>".$row7['team_name']."</font>)";}
if ($row4['place'] == "6"){$splace6 = "<b>".$row5['user_name']."</b><br>(<font color='".$teamcolor."'>".$row7['team_name']."</font>)";}
if ($row4['place'] == "7"){$splace7 = "<b>".$row5['user_name']."</b><br>(<font color='".$teamcolor."'>".$row7['team_name']."</font>)";}
if ($row4['place'] == "8"){$splace8 = "<b>".$row5['user_name']."</b><br>(<font color='".$teamcolor."'>".$row7['team_name']."</font>)";}
if ($row4['place'] == "9"){$splace9 = "<b>".$row5['user_name']."</b><br>(<font color='".$teamcolor."'>".$row7['team_name']."</font>)";}
if ($row4['place'] == "10"){$splace10 = "<b>".$row5['user_name']."</b><br>(<font color='".$teamcolor."'>".$row7['team_name']."</font>)";}
if ($row4['place'] == "11"){$splace11 = "<b>".$row5['user_name']."</b><br>(<font color='".$teamcolor."'>".$row7['team_name']."</font>)";}
if ($row4['place'] == "12"){$splace12 = "<b>".$row5['user_name']."</b><br>(<font color='".$teamcolor."'>".$row7['team_name']."</font>)";}
if ($row4['place'] == "13"){$splace13 = "<b>".$row5['user_name']."</b><br>(<font color='".$teamcolor."'>".$row7['team_name']."</font>)";}
if ($row4['place'] == "14"){$splace14 = "<b>".$row5['user_name']."</b><br>(<font color='".$teamcolor."'>".$row7['team_name']."</font>)";}
if ($row4['place'] == "15"){$splace15 = "<b>".$row5['user_name']."</b><br>(<font color='".$teamcolor."'>".$row7['team_name']."</font>)";}}

//1
$text .= "
<tr>
<td style='width:20%' class='forumheader3'>".$place1."</td>
<td style='width:1%' class='block'></td>
<td style='width:20%'></td>
<td style='width:0%'></td>
<td style='width:20%'></td>
<td style='width:0%'></td>
<td style='width:20%'></td>
<td style='width:0%'></td>
<td style='width:20%'></td>
</tr>";
//2
$text .= "
<tr>
<td style='width:20%'></td>
<td style='width:1%' class='block'></td>
<td style='width:20%' class='forumheader3'>".$splace1."</td>
<td style='width:1%' class='block'></td>
<td style='width:20%'></td>
<td style='width:0%'></td>
<td style='width:20%'></td>
<td style='width:0%'></td>
<td style='width:20%'></td>
</tr>";
//3
$text .= "
<tr>
<td style='width:20%' class='forumheader3'>".$place2."</td>
<td style='width:1%' class='block'></td>
<td style='width:20%'></td>
<td style='width:1%' class='block'></td>
<td style='width:20%'></td>
<td style='width:0%'></td>
<td style='width:20%'></td>
<td style='width:0%'></td>
<td style='width:20%'></td>
</tr>";
//4
$text .= "
<tr>
<td style='width:20%'></td>
<td style='width:0%'></td>
<td style='width:20%'></td>
<td style='width:1%' class='block'></td>
<td style='width:20%' class='forumheader3'>".$splace9."</td>
<td style='width:1%' class='block'></td>
<td style='width:20%'></td>
<td style='width:0%'></td>
<td style='width:20%'></td>
</tr>";
//5
$text .= "
<tr>
<td style='width:20%' class='forumheader3'>".$place3."</td>
<td style='width:1%' class='block'></td>
<td style='width:20%'></td>
<td style='width:1%' class='block'></td>
<td style='width:20%'></td>
<td style='width:1%' class='block'></td>
<td style='width:20%'></td>
<td style='width:0%'></td>
<td style='width:20%'></td>
</tr>";
//6
$text .= "
<tr>
<td style='width:20%'></td>
<td style='width:1%' class='block'></td>
<td style='width:20%' class='forumheader3'>".$splace2."</td>
<td style='width:1%' class='block'></td>
<td style='width:20%'></td>
<td style='width:1%' class='block'></td>
<td style='width:20%'></td>
<td style='width:0%'></td>
<td style='width:20%'></td>
</tr>";
//7
$text .= "
<tr>
<td style='width:20%' class='forumheader3'>".$place4."</td>
<td style='width:1%' class='block'></td>
<td style='width:20%'></td>
<td style='width:0%'></td>
<td style='width:20%'></td>
<td style='width:1%' class='block'></td>
<td style='width:20%'></td>
<td style='width:0%'></td>
<td style='width:20%'></td>
</tr>";
//8
$text .= "
<tr>
<td style='width:20%'></td>
<td style='width:0%'></td>
<td style='width:20%'></td>
<td style='width:0%'></td>
<td style='width:20%'></td>
<td style='width:1%' class='block'></td>
<td style='width:20%' class='forumheader3'>".$splace13."</td>
<td style='width:1%' class='block'></td>
<td style='width:20%'></td>
</tr>";
//9
$text .= "
<tr>
<td style='width:20%' class='forumheader3'>".$place5."</td>
<td style='width:1%' class='block'></td>
<td style='width:20%'></td>
<td style='width:0%'></td>
<td style='width:20%'></td>
<td style='width:1%' class='block'></td>
<td style='width:20%'></td>
<td style='width:1%' class='block'></td>
<td style='width:20%'></td>
</tr>";
//10
$text .= "
<tr>
<td style='width:20%'></td>
<td style='width:1%' class='block'></td>
<td style='width:20%' class='forumheader3'>".$splace3."</td>
<td style='width:1%' class='block'></td>
<td style='width:20%'></td>
<td style='width:1%' class='block'></td>
<td style='width:20%'></td>
<td style='width:1%' class='block'></td>
<td style='width:20%'></td>
</tr>";
//11
$text .= "
<tr>
<td style='width:20%' class='forumheader3'>".$place6."</td>
<td style='width:1%' class='block'></td>
<td style='width:20%'></td>
<td style='width:1%' class='block'></td>
<td style='width:20%'></td>
<td style='width:1%' class='block'></td>
<td style='width:20%'></td>
<td style='width:1%' class='block'></td>
<td style='width:20%'></td>
</tr>";
//12
$text .= "
<tr>
<td style='width:20%'></td>
<td style='width:0%'></td>
<td style='width:20%'></td>
<td style='width:1%' class='block'></td>
<td style='width:20%' class='forumheader3'>".$splace10."</td>
<td style='width:1%' class='block'></td>
<td style='width:20%'></td>
<td style='width:1%' class='block'></td>
<td style='width:20%'></td>
</tr>";
//13
$text .= "
<tr>
<td style='width:20%' class='forumheader3'>".$place7."</td>
<td style='width:1%' class='block'></td>
<td style='width:20%'></td>
<td style='width:1%' class='block'></td>
<td style='width:20%'></td>
<td style='width:0%'></td>
<td style='width:20%'></td>
<td style='width:1%' class='block'></td>
<td style='width:20%'></td>
</tr>";
//14
$text .= "
<tr>
<td style='width:20%'></td>
<td style='width:1%' class='block'></td>
<td style='width:20%' class='forumheader3'>".$splace4."</td>
<td style='width:1%' class='block'></td>
<td style='width:20%'></td>
<td style='width:0%'></td>
<td style='width:20%'></td>
<td style='width:1%' class='block'></td>
<td style='width:20%'></td>
</tr>";
//15
$text .= "
<tr>
<td style='width:20%' class='forumheader3'>".$place8."</td>
<td style='width:1%' class='block'></td>
<td style='width:20%'></td>
<td style='width:0%'></td>
<td style='width:20%'></td>
<td style='width:0%'></td>
<td style='width:20%'></td>
<td style='width:1%' class='block'></td>
<td style='width:20%'></td>
</tr>";
//16
$text .= "
<tr>
<td style='width:20%'></td>
<td style='width:0%'></td>
<td style='width:20%'></td>
<td style='width:0%'></td>
<td style='width:20%'></td>
<td style='width:0%'></td>
<td style='width:20%'></td>
<td style='width:1%' class='block'></td>
<td style='width:20%' class='forumheader3'>".$splace15."</td>
</tr>";
//17
$text .= "
<tr>
<td style='width:20%' class='forumheader3'>".$place9."</td>
<td style='width:1%' class='block'></td>
<td style='width:20%'></td>
<td style='width:0%'></td>
<td style='width:20%'></td>
<td style='width:0%'></td>
<td style='width:20%'></td>
<td style='width:1%' class='block'></td>
<td style='width:20%'></td>
</tr>";
//18
$text .= "
<tr>
<td style='width:20%'></td>
<td style='width:1%' class='block'></td>
<td style='width:20%' class='forumheader3'>".$splace5."</td>
<td style='width:1%' class='block'></td>
<td style='width:20%'></td>
<td style='width:0%'></td>
<td style='width:20%'></td>
<td style='width:1%' class='block'></td>
<td style='width:20%'></td>
</tr>";
//19
$text .= "
<tr>
<td style='width:20%' class='forumheader3'>".$place10."</td>
<td style='width:1%' class='block'></td>
<td style='width:20%'></td>
<td style='width:1%' class='block'></td>
<td style='width:20%'></td>
<td style='width:0%'></td>
<td style='width:20%'></td>
<td style='width:1%' class='block'></td>
<td style='width:20%'></td>
</tr>";
//20
$text .= "
<tr>
<td style='width:20%'></td>
<td style='width:0%'></td>
<td style='width:20%'></td>
<td style='width:1%' class='block'></td>
<td style='width:20%' class='forumheader3'>".$splace11."</td>
<td style='width:1%' class='block'></td>
<td style='width:20%'></td>
<td style='width:1%' class='block'></td>
<td style='width:20%'></td>
</tr>";
//21
$text .= "
<tr>
<td style='width:20%' class='forumheader3'>".$place11."</td>
<td style='width:1%' class='block'></td>
<td style='width:20%'></td>
<td style='width:1%' class='block'></td>
<td style='width:20%'></td>
<td style='width:1%' class='block'></td>
<td style='width:20%'></td>
<td style='width:1%' class='block'></td>
<td style='width:20%'></td>
</tr>";
//22
$text .= "
<tr>
<td style='width:20%'></td>
<td style='width:1%' class='block'></td>
<td style='width:20%' class='forumheader3'>".$splace6."</td>
<td style='width:1%' class='block'></td>
<td style='width:20%'></td>
<td style='width:1%' class='block'></td>
<td style='width:20%'></td>
<td style='width:1%' class='block'></td>
<td style='width:20%'></td>
</tr>";
//23
$text .= "
<tr>
<td style='width:20%' class='forumheader3'>".$place12."</td>
<td style='width:1%' class='block'></td>
<td style='width:20%'></td>
<td style='width:0%'></td>
<td style='width:20%'></td>
<td style='width:1%' class='block'></td>
<td style='width:20%'></td>
<td style='width:1%' class='block'></td>
<td style='width:20%'></td>
</tr>";
//24
$text .= "
<tr>
<td style='width:20%'></td>
<td style='width:0%'></td>
<td style='width:20%'></td>
<td style='width:0%'></td>
<td style='width:20%'></td>
<td style='width:1%' class='block'></td>
<td style='width:20%' class='forumheader3'>".$splace14."</td>
<td style='width:1%' class='block'></td>
<td style='width:20%'></td>
</tr>";
//25
$text .= "
<tr>
<td style='width:20%' class='forumheader3'>".$place13."</td>
<td style='width:1%' class='block'></td>
<td style='width:20%'></td>
<td style='width:0%'></td>
<td style='width:20%'></td>
<td style='width:1%' class='block'></td>
<td style='width:20%'></td>
<td style='width:0%'></td>
<td style='width:20%'></td>
</tr>";
//26
$text .= "
<tr>
<td style='width:20%'></td>
<td style='width:1%' class='block'></td>
<td style='width:20%' class='forumheader3'>".$splace7."</td>
<td style='width:1%' class='block'></td>
<td style='width:20%'></td>
<td style='width:1%' class='block'></td>
<td style='width:20%'></td>
<td style='width:0%'></td>
<td style='width:20%'></td>
</tr>";
//27
$text .= "
<tr>
<td style='width:20%' class='forumheader3'>".$place14."</td>
<td style='width:1%' class='block'></td>
<td style='width:20%'></td>
<td style='width:1%' class='block'></td>
<td style='width:20%'></td>
<td style='width:1%' class='block'></td>
<td style='width:20%'></td>
<td style='width:0%'></td>
<td style='width:20%'></td>
</tr>";
//28
$text .= "
<tr>
<td style='width:20%'></td>
<td style='width:0%'></td>
<td style='width:20%'></td>
<td style='width:1%' class='block'></td>
<td style='width:20%' class='forumheader3'>".$splace12."</td>
<td style='width:1%' class='block'></td>
<td style='width:20%'></td>
<td style='width:0%'></td>
<td style='width:20%'></td>
</tr>";
//29
$text .= "
<tr>
<td style='width:20%' class='forumheader3'>".$place15."</td>
<td style='width:1%' class='block'></td>
<td style='width:20%'></td>
<td style='width:1%' class='block'></td>
<td style='width:20%'></td>
<td style='width:0%'></td>
<td style='width:20%'></td>
<td style='width:0%'></td>
<td style='width:20%'></td>
</tr>";
//30
$text .= "
<tr>
<td style='width:20%'></td>
<td style='width:1%' class='block'></td>
<td style='width:20%' class='forumheader3'>".$splace8."</td>
<td style='width:1%' class='block'></td>
<td style='width:20%'></td>
<td style='width:0%'></td>
<td style='width:20%'></td>
<td style='width:0%'></td>
<td style='width:20%'></td>
</tr>";
//31
$text .= "
<tr>
<td style='width:20%' class='forumheader3'>".$place16."</td>
<td style='width:1%' class='block'></td>
<td style='width:20%'></td>
<td style='width:0%'></td>
<td style='width:20%'></td>
<td style='width:0%'></td>
<td style='width:20%'></td>
<td style='width:0%'></td>
<td style='width:20%'></td>
</tr>";





$text .= "</table>";



//----#AACGC Plugin Copyright&reg; - DO NOT REMOVE BELOW THIS LINE! - #-------+
require(e_PLUGIN . 'aacgc_btracker/plugin.php');
$text .= "<br><br><br><br><br><br><br>
<a href='http://www.aacgc.com' target='_blank'>
<font color='808080' size='1'>".$eplug_name." V".$eplug_version."  &reg;</font>
</a>";
//------------------------------------------------------------------------+





$ns -> tablerender($title, $text);



//----------------------------------------------------------------------------------

require_once(FOOTERF);

